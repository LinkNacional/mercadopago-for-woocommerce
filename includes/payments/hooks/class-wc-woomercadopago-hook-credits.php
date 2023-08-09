<?php
/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class WC_WooMercadoPago_Hook_Credits
 */
class WC_WooMercadoPago_Hook_Credits extends WC_WooMercadoPago_Hook_Abstract {
    /**
     * Load hooks
     *
     * @param bool $is_instance Check is instance call.
     */
    public function load_hooks( $is_instance = false ): void {
        parent::load_hooks();

        if ( ! empty( $this->payment->settings['enabled'] ) && 'yes' === $this->payment->settings['enabled'] ) {
            add_action( 'wp_enqueue_scripts', array($this, 'add_checkout_scripts_basic') );
            add_action( 'woocommerce_after_checkout_form', array($this, 'add_mp_settings_script_basic') );
            add_action( 'woocommerce_thankyou', array($this, 'update_mp_settings_script_basic') );
        }

        add_action(
            'woocommerce_receipt_' . $this->payment->id,
            function ( $order ): void {
                // phpcs:ignore WordPress.Security.EscapeOutput
                echo $this->render_order_form( $order );
            }
        );

        add_action(
            'wp_head',
            function (): void {
                if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.1', '>=' ) ) {
                    $page_id = wc_get_page_id( 'checkout' );
                } else {
                    $page_id = woocommerce_get_page_id( 'checkout' );
                }
                if ( is_page( $page_id ) ) {
                    echo '<style type="text/css">#MP-Checkout-dialog { z-index: 9999 !important; }</style>' . \PHP_EOL;
                }
            }
        );
    }

    /**
     * Get Order Form
     *
     * @param string $order_id Order Id.
     *
     * @return string
     */
    public function render_order_form( $order_id ) {
        $order = wc_get_order( $order_id );
        $url = $this->payment->create_preference( $order );

        if ( 'modal' === $this->payment->method && $url ) {
            $this->payment->log->write_log( __FUNCTION__, 'rendering Mercado Pago lightbox (modal window).' );

            $html = '<style type="text/css">
            #MP-Checkout-dialog #MP-Checkout-IFrame { bottom: 0px !important; top:50%!important; margin-top: -280px !important; height: 590px !important; }
            </style>';
            // @todo use wp_enqueue_script
            // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript
            $html .= '<script type="text/javascript" src="https://secure.mlstatic.com/mptools/render.js"></script>';
            $html .= '<script type="text/javascript">
						(function() { $MPC.openCheckout({ url: "' . esc_url( $url ) . '", mode: "modal" }); })();
					</script>';
            $html .= '<a id="submit-payment" href="' . esc_url( $url ) . '" name="MP-Checkout" class="button alt" mp-mode="modal">' .
            	__( 'Pay with Mercado Pago', WC_MERCADOPAGO_TEXT_DOMAIN ) .
            	'</a> <a class="button cancel" href="' . esc_url( $order->get_cancel_order_url() ) . '">' .
            	__( 'Cancel &amp; Clear Cart', WC_MERCADOPAGO_TEXT_DOMAIN ) .
            	'</a>';
            return $html;
        } else {
            $this->payment->log->write_log( __FUNCTION__, 'unable to build Checkout Pro URL.' );
            $html = '<p>' .
            	__( 'There was an error processing your payment. Please try again or contact us for Assistance.', WC_MERCADOPAGO_TEXT_DOMAIN ) .
            	'</p>' .
            	'<a class="button" href="' . esc_url( $order->get_checkout_payment_url() ) . '">' .
            	__( 'Click to try again', WC_MERCADOPAGO_TEXT_DOMAIN ) .
            	'</a>
			';
            return $html;
        }
    }

    /**
     * Add Checkout Scripts
     */
    public function add_checkout_scripts_basic(): void {
        if ( is_checkout() && $this->payment->is_available() && ! get_query_var( 'order-received' ) ) {
            $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

            wp_enqueue_script(
                'woocommerce-mercadopago-narciso-scripts',
                plugins_url( '../../assets/js/mp-plugins-components.js', plugin_dir_path( __FILE__ ) ),
                array('jquery'),
                WC_WooMercadoPago_Constants::VERSION,
                true
            );
        }
    }

    /**
     * Scripts to basic
     */
    public function add_mp_settings_script_basic(): void {
        parent::add_mp_settings_script();
    }

    /**
     * Update settings script basic
     *
     * @param string $order_id Order Id.
     */
    public function update_mp_settings_script_basic( $order_id ): void {
        parent::update_mp_settings_script( $order_id );

        $payments_id = array();
        $collection_id = sanitize_text_field($_GET['collection_id'] ?? ''); // phpcs:ignore

        if ( ! empty( $collection_id ) ) {
            $collection_id = explode( ',', $collection_id );
            foreach ( $collection_id as $payment_id ) {
                $payments_id[] = preg_replace( '/\D/', '', $payment_id );
            }
        }

        $this->update_mp_order_payments_metadata( $order_id, $payments_id );
    }

    /**
     *  Discount not apply
     */
    public function add_discount(): void {
        // Do nothing.
    }
}

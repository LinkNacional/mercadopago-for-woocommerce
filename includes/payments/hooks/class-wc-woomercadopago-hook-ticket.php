<?php
/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class WC_WooMercadoPago_Hook_Ticket
 */
class WC_WooMercadoPago_Hook_Ticket extends WC_WooMercadoPago_Hook_Abstract {
    /**
     * Load Hooks
     */
    public function load_hooks(): void {
        parent::load_hooks();

        if ( ! empty( $this->payment->settings['enabled'] ) && 'yes' === $this->payment->settings['enabled'] ) {
            add_action( 'wp_enqueue_scripts', array($this, 'add_checkout_scripts_ticket') );
            add_action( 'woocommerce_after_checkout_form', array($this, 'add_mp_settings_script_ticket') );
            add_action( 'woocommerce_thankyou_' . $this->payment->id, array($this, 'update_mp_settings_script_ticket') );
        }
    }

    /**
     *  Add Discount
     */
    public function add_discount(): void {
        // phpcs:ignore WordPress.Security.NonceVerification
        if ( ! isset( $_POST['mercadopago_ticket'] ) ) {
            return;
        }
        if ( is_admin() && ! defined( 'DOING_AJAX' ) || is_cart() ) {
            return;
        }
        // phpcs:ignore WordPress.Security.NonceVerification
        $ticket_checkout = map_deep($_POST['mercadopago_ticket'], 'sanitize_text_field');
        parent::add_discount_abst( $ticket_checkout );
    }

    /**
     * Add Checkout Scripts
     */
    public function add_checkout_scripts_ticket(): void {
        if ( is_checkout() && $this->payment->is_available() && ! get_query_var( 'order-received' ) ) {
            $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

            wp_enqueue_script(
                'woocommerce-mercadopago-ticket-checkout',
                plugins_url( '../../assets/js/ticket' . $suffix . '.js', plugin_dir_path( __FILE__ ) ),
                array('jquery'),
                WC_WooMercadoPago_Constants::VERSION,
                true
            );

            wp_enqueue_script(
                'woocommerce-mercadopago-narciso-scripts',
                plugins_url( '../../assets/js/mp-plugins-components.js', plugin_dir_path( __FILE__ ) ),
                array('jquery'),
                WC_WooMercadoPago_Constants::VERSION,
                true
            );

            wp_localize_script(
                'woocommerce-mercadopago-ticket-checkout',
                'wc_mercadopago_ticket_params',
                array(
                    'site_id' => strtolower(get_option( '_site_id_v1' )),
                    'coupon_mode' => isset( $this->payment->logged_user_email ) ? $this->payment->coupon_mode : 'no',
                    'discount_action_url' => $this->payment->discount_action_url,
                    'payer_email' => esc_js( $this->payment->logged_user_email ),
                    'apply' => __( 'Apply', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'remove' => __( 'Remove', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'coupon_empty' => __( 'Please, inform your coupon code', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'choose' => __( 'To choose', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'other_bank' => __( 'Other bank', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'discount_info1' => __( 'You will save', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'discount_info2' => __( 'with discount of', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'discount_info3' => __( 'Total of your purchase:', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'discount_info4' => __( 'Total of your purchase with discount:', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'discount_info5' => __( '*After payment approval', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'discount_info6' => __( 'Terms and conditions of use', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'loading' => plugins_url( '../../assets/images/', plugin_dir_path( __FILE__ ) ) . 'loading.gif',
                    'check' => plugins_url( '../../assets/images/', plugin_dir_path( __FILE__ ) ) . 'check.png',
                    'error' => plugins_url( '../../assets/images/', plugin_dir_path( __FILE__ ) ) . 'error.png',
                )
            );
        }
    }

    /**
     * MP Settings Ticket
     */
    public function add_mp_settings_script_ticket(): void {
        parent::add_mp_settings_script();
    }

    /**
     * Update settings script ticket
     *
     * @param string $order_id Order Id.
     */
    public function update_mp_settings_script_ticket( $order_id ): void {
        parent::update_mp_settings_script( $order_id );
        $order = wc_get_order( $order_id );
        $transaction_details = $order->get_meta( '_transaction_details_ticket' );

        if ( empty( $transaction_details ) ) {
            return;
        }

        wc_get_template(
            'order-received/show-ticket.php',
            array('transaction_details' => $transaction_details),
            'woo/mercado/pago/module/',
            WC_WooMercadoPago_Module::get_templates_path()
        );
    }
}

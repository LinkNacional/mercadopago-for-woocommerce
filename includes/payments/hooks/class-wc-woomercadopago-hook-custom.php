<?php
/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class WC_WooMercadoPago_Hook_Custom
 */
class WC_WooMercadoPago_Hook_Custom extends WC_WooMercadoPago_Hook_Abstract {
    /**
     * Load Hooks
     */
    public function load_hooks(): void {
        parent::load_hooks();

        if ( ! empty( $this->payment->settings['enabled'] ) && 'yes' === $this->payment->settings['enabled'] ) {
            add_action( 'wp_enqueue_scripts', array($this, 'add_checkout_scripts_custom') );
            add_action( 'woocommerce_after_checkout_form', array($this, 'add_mp_settings_script_custom') );
            add_action( 'woocommerce_thankyou_' . $this->payment->id, array($this, 'update_mp_settings_script_custom') );
            add_action( 'woocommerce_order_details_after_order_table', array($this, 'update_mp_settings_script_custom') );
            add_action( 'woocommerce_review_order_before_payment', array($this, 'add_init_cardform_checkout'));
            add_action( 'woocommerce_admin_order_totals_after_total', function( $order_id ): void {
                $this->payment->display_installment_fee_order( $order_id );
            });
        }

        add_action(
            'woocommerce_receipt_' . $this->payment->id,
            function ( $order ): void {
                $this->render_order_form( $order );
            }
        );
    }

    /**
     *  Add Init Cardform on Checkout Page
     */
    public function add_init_cardform_checkout(): void {
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
        wp_enqueue_script(
            'woocommerce-mercadopago-checkout-init-cardform',
            plugins_url( '../../assets/js/securityFields/checkoutSecurityFields' . $suffix . '.js', plugin_dir_path( __FILE__ ) ),
            array(),
            WC_WooMercadoPago_Constants::VERSION,
            true
        );
    }

    /**
     *  Add Discount
     */
    public function add_discount(): void {
        // phpcs:ignore WordPress.Security.NonceVerification
        if ( ! isset( $_POST['mercadopago_custom'] ) ) {
            return;
        }
        if ( ( is_admin() && ! defined( 'DOING_AJAX' ) ) || is_cart() ) {
            return;
        }

        // phpcs:ignore WordPress.Security.NonceVerification
        $custom_checkout = map_deep($_POST['mercadopago_custom'], 'sanitize_text_field');
        parent::add_discount_abst( $custom_checkout );
    }

    /**
     * Add Checkout Scripts
     */
    public function add_checkout_scripts_custom(): void {
        if ( is_checkout() && $this->payment->is_available() && ! get_query_var( 'order-received' ) ) {
            global $woocommerce;

            $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

            wp_enqueue_script(
                'woocommerce-mercadopago-sdk',
                'https://sdk.mercadopago.com/js/v2',
                array(),
                WC_WooMercadoPago_Constants::VERSION,
                true
            );

            wp_enqueue_script(
                'woocommerce-mercadopago-checkout',
                plugins_url( '../../assets/js/securityFields/securityFields' . $suffix . '.js', plugin_dir_path( __FILE__ ) ),
                array(),
                WC_WooMercadoPago_Constants::VERSION,
                true
            );

            wp_enqueue_script(
                'woocommerce-mercadopago-security-session',
                plugins_url( '../../assets/js/securityFields/session' . $suffix . '.js', plugin_dir_path( __FILE__ ) ),
                array(),
                WC_WooMercadoPago_Constants::VERSION,
                true
            );

            wp_enqueue_script(
                'woocommerce-mercadopago-checkout-page',
                plugins_url( '../../assets/js/securityFields/pageObjects/checkoutPage' . $suffix . '.js', plugin_dir_path( __FILE__ ) ),
                array(),
                WC_WooMercadoPago_Constants::VERSION,
                true
            );

            wp_enqueue_script(
                'woocommerce-mercadopago-checkout-elements',
                plugins_url( '../../assets/js/securityFields/elements/checkoutElements' . $suffix . '.js', plugin_dir_path( __FILE__ ) ),
                array(),
                WC_WooMercadoPago_Constants::VERSION,
                true
            );

            wp_enqueue_script(
                'woocommerce-mercadopago-narciso-scripts',
                plugins_url( '../../assets/js/mp-plugins-components.js', plugin_dir_path( __FILE__ ) ),
                array(),
                WC_WooMercadoPago_Constants::VERSION,
                true
            );

            wp_localize_script(
                'woocommerce-mercadopago-checkout',
                'wc_mercadopago_params',
                array(
                    'site_id' => strtolower(get_option( '_site_id_v1' )),
                    'public_key' => $this->payment->get_public_key(),
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
                    'rate_text' => __( 'No fee', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'more_installments_text' => __( 'More options', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'loading' => plugins_url( '../../assets/images/', plugin_dir_path( __FILE__ ) ) . 'loading.gif',
                    'check' => plugins_url( '../../assets/images/', plugin_dir_path( __FILE__ ) ) . 'check.png',
                    'error' => plugins_url( '../../assets/images/', plugin_dir_path( __FILE__ ) ) . 'error.png',
                    'plugin_version' => WC_WooMercadoPago_Constants::VERSION,
                    'currency' => $this->payment->site_data['currency'],
                    'intl' => $this->payment->site_data['intl'],
                    'placeholders' => array(
                        'cardExpirationDate' => __( 'mm/yy', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                        'issuer' => __( 'Issuer', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                        'installments' => __( 'Installments', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    ),
                    'cvvHint' => array(
                        'back' => __( 'on the back', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                        'front' => __( 'on the front', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    ),
                    'cvvText' => __( 'digits', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'installmentObsFee' => __( 'No fee', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'installmentButton' => __( 'More options', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'bankInterestText' => __( 'If interest is applicable, it will be charged by your bank.', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'interestText' => __( 'Interest', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                    'input_helper_message' => array(
                        'cardNumber' => array(
                            'invalid_type' => __( 'Card number is required', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                            'invalid_length' => __( 'Card number invalid', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                        ),
                        'cardholderName' => array(
                            '221' => __( 'Holder name is required', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                            '316' => __( 'Holder name invalid', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                        ),
                        'expirationDate' => array(
                            'invalid_type' => __( 'Expiration date invalid', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                            'invalid_length' => __( 'Expiration date incomplete', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                            'invalid_value' => __( 'Expiration date invalid', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                        ),
                        'securityCode' => array(
                            'invalid_type' => __( 'Security code is required', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                            'invalid_length' => __( 'Security code incomplete', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                        )
                    ),
                    'theme' => get_stylesheet(),
                    'location' => '/checkout',
                    'plugin_version' => WC_WooMercadoPago_Constants::VERSION,
                    'platform_version' => $woocommerce->version,
                )
            );
        }
    }

    /**
     * Add custom script
     */
    public function add_mp_settings_script_custom(): void {
        parent::add_mp_settings_script();
    }

    /**
     * Add script custom
     *
     * @param string $order_id Order Id.
     */
    public function update_mp_settings_script_custom( $order_id ): void {
        parent::update_mp_settings_script( $order_id );

        $order = wc_get_order( $order_id );
        $order->get_meta_data();
        $installments = $order->get_meta('mp_installments');
        $installment_amount = $order->get_meta('mp_transaction_details');
        $transaction_amount = $order->get_meta('mp_transaction_amount');
        $total_paid_amount = $order->get_meta('mp_total_paid_amount');
        $currency_symbol = WC_WooMercadoPago_Configs::get_country_configs();
        $total_diff_cost = (float) $total_paid_amount - (float) $transaction_amount;

        if ( $total_diff_cost > 0 ) {
            $parameters_custom = array(
                'title_installment_cost' => __( 'Cost of installments', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                'title_installment_total' => __( 'Total with installments', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                'text_installments' => __( 'installments of', LKN_WC_MERCADOPAGO_TEXT_DOMAIN ),
                'currency' => $currency_symbol[ strtolower(get_option( '_site_id_v1' )) ]['currency_symbol'],
                'total_paid_amount' => number_format( (float) $total_paid_amount, 2, ',', '.' ),
                'transaction_amount' => number_format( (float) $transaction_amount, 2, ',', '.' ),
                'total_diff_cost' => number_format( (float) $total_diff_cost, 2, ',', '.' ),
                'installment_amount' => number_format( (float) $installment_amount, 2, ',', '.' ),
                'installments' => number_format( (float) $installments ),
            );

            wc_get_template(
                'order-received/show-custom.php',
                $parameters_custom,
                'woo/mercado/pago/module/',
                WC_WooMercadoPago_Module::get_templates_path()
            );
        }
    }

    /**
     * Render wallet button page
     *
     * @param $order_id
     */
    public function render_order_form( $order_id ): void {
        $isWallet = get_query_var('wallet_button', false);

        if ( $isWallet ) {
            /**
             * WooCommerce Order
             *
             * @var WC_Order $order
             */
            $order = wc_get_order( $order_id );
            $preference = $this->payment->create_preference_wallet_button( $order );

            wc_get_template(
                'receipt/custom-checkout.php',
                array(
                    'preference_id' => $preference['id'],
                    'cancel_url' => $order->get_cancel_order_url(),
                    'public_key' => $this->payment->get_public_key(),
                ),
                'woo/mercado/pago/module/',
                WC_WooMercadoPago_Module::get_templates_path()
            );
        }
    }
}

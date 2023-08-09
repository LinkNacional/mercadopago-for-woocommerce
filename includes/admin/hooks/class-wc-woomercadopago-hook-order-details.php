<?php
/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class WC_WooMercadoPago_Hook_Order_Details
 */
class WC_WooMercadoPago_Hook_Order_Details {
    public const NONCE_ID = 'mp_hook_order_details_nonce';

    /**
     * WC_Order
     *
     * @var WC_Order
     */
    protected $order;

    /**
     * Nonce
     *
     * @var WC_WooMercadoPago_Helper_Nonce
     */
    protected $nonce;

    /**
     * Current User
     *
     * @var WC_WooMercadoPago_Helper_Current_User
     */
    protected $current_user;

    /**
     * Gateway
     *
     * @var string
     */
    protected $gateway;

    public function __construct() {
        $this->nonce = WC_WooMercadoPago_Helper_Nonce::get_instance();
        $this->current_user = WC_WooMercadoPago_Helper_Current_User::get_instance();

        $this->load_hooks();
    }

    /**
     * Load Hooks
     *
     * @return void
     */
    public function load_hooks(): void {
        //hook for post
        add_action( 'add_meta_boxes_shop_order', array($this, 'payment_status_metabox') );

        //hook for order
        add_action( 'add_meta_boxes_woocommerce_page_wc-orders', array($this, 'payment_status_metabox') );
        add_action( 'wp_ajax_mp_sync_payment_status', array($this, 'mercadopago_sync_payment_status') );
    }

    /**
     * Load Scripts
     *
     * @return void
     */
    public function load_scripts( $order ): void {
        $suffix = $this->get_suffix();
        $script_name = 'mp_payment_status_metabox';

        if ( is_admin() ) {
            wp_enqueue_script(
                $script_name,
                plugins_url( '../../assets/js/payment_status_metabox' . $suffix . '.js', plugin_dir_path( __FILE__ ) ),
                array(),
                WC_WooMercadoPago_Constants::VERSION,
                false
            );

            wp_localize_script($script_name, $script_name . '_vars', array(
                'order_id' => $order->get_id(),
                'nonce' => $this->nonce->generate_nonce(self::NONCE_ID),
            ));
        }
    }

    /**
     * Get suffix to static files
     */
    public function get_suffix() {
        return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
    }

    /**
     * Get Alert Description
     *
     * @param $payment_status_detail
     * @param $is_credit_card
     *
     * @return array
     */
    public function get_alert_description( $payment_status_detail, $is_credit_card ) {
        $all_status_detail = array(
            'accredited' => array(
                'alert_title' => __( 'Payment made', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Payment made by the buyer and already credited in the account.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'settled' => array(
                'alert_title' => __( 'Call resolved', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Please contact Mercado Pago for further details.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'reimbursed' => array(
                'alert_title' => __( 'Payment refunded', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Your refund request has been made. Please contact Mercado Pago for further details.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'refunded' => array(
                'alert_title' => __( 'Payment returned', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The payment has been returned to the client.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'partially_refunded' => array(
                'alert_title' => __( 'Payment returned', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The payment has been partially returned to the client.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'by_collector' => array(
                'alert_title' => __( 'Payment canceled', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The payment has been successfully canceled.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'by_payer' => array(
                'alert_title' => __( 'Purchase canceled', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The payment has been canceled by the customer.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'pending' => array(
                'alert_title' => __( 'Pending payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Awaiting payment from the buyer.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'pending_waiting_payment' => array(
                'alert_title' => __( 'Pending payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Awaiting payment from the buyer.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'pending_waiting_for_remedy' => array(
                'alert_title' => __( 'Pending payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Awaiting payment from the buyer.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'pending_waiting_transfer' => array(
                'alert_title' => __( 'Pending payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Awaiting payment from the buyer.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'pending_review_manual' => array(
                'alert_title' => __( 'Pending payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'We are veryfing the payment. We will notify you by email in up to 6 hours if everything is fine so that you can deliver the product or provide the service.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'waiting_bank_confirmation' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The card-issuing bank declined the payment. Please ask your client to use another card or to get in touch with the bank.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'pending_capture' => array(
                'alert_title' => __( 'Payment authorized. Awaiting capture.', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( "The payment has been authorized on the client's card. Please capture the payment.", WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'in_process' => array(
                'alert_title' => __( 'Payment in process', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Please wait or contact Mercado Pago for further details', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'pending_contingency' => array(
                'alert_title' => __( 'Pending payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The bank is reviewing the payment. As soon as we have their confirmation, we will notify you via email so that you can deliver the product or provide the service.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'pending_card_validation' => array(
                'alert_title' => __( 'Pending payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Awaiting payment information validation.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'pending_online_validation' => array(
                'alert_title' => __( 'Pending payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Awaiting payment information validation.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'pending_additional_info' => array(
                'alert_title' => __( 'Pending payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Awaiting payment information validation.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'offline_process' => array(
                'alert_title' => __( 'Pending payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Please wait or contact Mercado Pago for further details', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'pending_challenge' => array(
                'alert_title' => __( 'Pending payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Waiting for the buyer.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'pending_provider_response' => array(
                'alert_title' => __( 'Pending payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Waiting for the card issuer.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'bank_rejected' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The payment could not be processed. Please ask your client to use another card or to get in touch with the bank.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'rejected_by_bank' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The card-issuing bank declined the payment. Please ask your client to use another card or to get in touch with the bank.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'rejected_insufficient_data' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The card-issuing bank declined the payment. Please ask your client to use another card or to get in touch with the bank.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'bank_error' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The card-issuing bank declined the payment. Please ask your client to use another card or to get in touch with the bank.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'by_admin' => array(
                'alert_title' => __( 'Mercado Pago did not process the payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Please contact Mercado Pago for further details.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'expired' => array(
                'alert_title' => __( 'Expired payment deadline', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The client did not pay within the time limit.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_rejected_bad_filled_card_number' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The card-issuing bank declined the payment. Please ask your client to use another card or to get in touch with the bank.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_rejected_bad_filled_security_code' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The CVV is invalid. Please ask your client to review the details or use another card.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_rejected_bad_filled_date' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The card is expired. Please ask your client to use another card or to contact the bank.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_rejected_high_risk' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'This payment was declined because it did not pass Mercado Pago security controls. Please ask your client to use another card.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_rejected_fraud' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The buyer is suspended in our platform. Your client must contact us to check what happened.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_rejected_blacklist' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The card-issuing bank declined the payment. Please ask your client to use another card or to get in touch with the bank.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_rejected_insufficient_amount' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => $is_credit_card
                	? __( 'The card does not have enough limit. Please ask your client to use another card or to get in touch with the bank.', WC_MERCADOPAGO_TEXT_DOMAIN )
                	: __( 'The card does not have sufficient balance. Please ask your client to use another card or to get in touch with the bank.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_rejected_other_reason' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The card-issuing bank declined the payment. Please ask your client to use another card or to get in touch with the bank.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_rejected_max_attempts' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The CVV was entered incorrectly several times. Please ask your client to use another card or to get in touch with the bank.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_rejected_invalid_installments' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The card does not allow the number of installments entered. Please ask your client to choose another installment plan or to use another card.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_rejected_call_for_authorize' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The card-issuing bank declined the payment. Please instruct your client to ask the bank to authotize it or to use another card.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_rejected_duplicated_payment' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'From Mercado Pago we have detected that this payment has already been made before. If that is not the case, your client may try to pay again.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_rejected_card_disabled' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The card is not active yet. Please ask your client to use another card or to get in touch with the bank to activate it.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'payer_unavailable' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The buyer is suspended in our platform. Your client must contact us to check what happened.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'rejected_high_risk' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'This payment was declined because it did not pass Mercado Pago security controls. Please ask your client to use another card.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'rejected_by_regulations' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'This payment was declined because it did not pass Mercado Pago security controls. Please ask your client to use another card.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'rejected_cap_exceeded' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The amount exceeded the card limit. Please ask your client to use another card or to get in touch with the bank.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_rejected_3ds_challenge' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Please ask your client to use another card or to get in touch with the card issuer.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'rejected_other_reason' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Please ask your client to use another card or to get in touch with the card issuer.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'authorization_revoked' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'Please ask your client to use another card or to get in touch with the card issuer.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_amount_rate_limit_exceeded' => array(
                'alert_title' => __( 'Pending payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( "The amount exceeded the card's limit. Please ask your client to use another card or to get in touch with the bank.", WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_rejected_expired_operation' => array(
                'alert_title' => __( 'Expired payment deadline', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The client did not pay within the time limit.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'cc_rejected_bad_filled_other' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => $is_credit_card
                	? __( 'The credit function is not enabled for the card. Please tell your client that it is possible to pay with debit or to use another one.', WC_MERCADOPAGO_TEXT_DOMAIN )
                	: __( 'The debit function is not enabled for the card. Please tell your client that it is possible to pay with credit or to use another one.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'rejected_call_for_authorize' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The card-issuing bank declined the payment. Please instruct your client to ask the bank to authorize it.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'am_insufficient_amount' => array(
                'alert_title' => __( 'Declined payment', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The buyer does not have enough balance to make the purchase. Please ask your client to deposit money to the Mercado Pago Account or to use a different payment method.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
            'generic' => array(
                'alert_title' => __( 'There was an error', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'description' => __( 'The transaction could not be completed.', WC_MERCADOPAGO_TEXT_DOMAIN ),
            ),
        );

        return array_key_exists($payment_status_detail, $all_status_detail)
        	? $all_status_detail[$payment_status_detail]
        	: $all_status_detail['generic'];
    }

    /**
     * Get Alert Status
     *
     * @param $payment_status
     *
     * @return string 'success' | 'pending' | 'rejected' | 'refunded' | 'charged_back'
     */
    public function get_alert_status( $payment_status ) {
        $all_payment_status = array(
            'approved' => 'success',
            'authorized' => 'success',
            'pending' => 'pending',
            'in_process' => 'pending',
            'in_mediation' => 'pending',
            'rejected' => 'rejected',
            'canceled' => 'rejected',
            'refunded' => 'refunded',
            'charged_back' => 'charged_back',
            'generic' => 'rejected'
        );

        return array_key_exists($payment_status, $all_payment_status) ? $all_payment_status[$payment_status] : $all_payment_status['generic'];
    }

    /**
     * Get Order from Post
     *
     * @param $post
     *
     * @return bool|WC_Order|WC_Order_Refund
     */
    private function get_order( $post ) {
        if ( $this->order instanceof WC_Order ) {
            return $this->order;
        }

        if ( is_null($post->ID) ) {
            return false;
        }

        $this->order = wc_get_order($post->ID);

        if ( ! $this->order ) {
            return false;
        }

        return $this->order;
    }

    /**
     * Create payment status metabox
     *
     * @param WP_Post $post
     *
     * @return void
     */
    public function payment_status_metabox( $post_or_order_object ): void {
        $order = ( $post_or_order_object instanceof WP_Post ) ? wc_get_order( $post_or_order_object->ID ) : $post_or_order_object;

        $this->load_scripts($order);

        if ( ! $order ) {
            return;
        }

        $payment_method = $order->get_payment_method();
        $is_mercadopago_payment_method = in_array($payment_method, WC_WooMercadoPago_Constants::GATEWAYS_IDS, true);

        if ( ! $is_mercadopago_payment_method ) {
            return;
        }

        add_meta_box(
            'mp-payment-status-metabox',
            __( 'Payment status on Mercado Pago', WC_MERCADOPAGO_TEXT_DOMAIN ),
            array($this, 'payment_status_metabox_content')
        );
    }

    /**
     * Payment Status Metabox Content
     *
     * @param wc_get_order $order
     *
     * @return void
     * @throws WC_WooMercadoPago_Exception
     */
    public function payment_status_metabox_content( $order ): void {
        $payment = $this->get_payment($order);

        if ( ! $payment ) {
            return;
        }

        $payment_status = $payment['response']['status'];
        $payment_status_details = $payment['response']['status_detail'];

        if ( ! $payment['response']['payment_type_id'] && (
            'cc_rejected_bad_filled_other' === $payment_status_details ||
            'cc_rejected_insufficient_amount' === $payment_status_details
        ) ) {
            return;
        }

        $is_credit_card = 'credit_card' === $payment['response']['payment_type_id'];
        $alert_status = $this->get_alert_status($payment_status);
        $alert_description = $this->get_alert_description($payment_status_details, $is_credit_card);
        $metabox_data = $this->get_metabox_data($alert_status, $alert_description);

        wc_get_template(
            'order/payment-status-metabox-content.php',
            $metabox_data,
            'woo/mercado/pago/module/',
            WC_WooMercadoPago_Module::get_templates_path()
        );
    }

    /**
     * Metabolic Data
     *
     * @param $alert_status
     * @param $alert
     * @return Array
     */
    public function get_metabox_data( $alert_status, $alert ) {
        $country = strtolower(get_option( 'checkout_country', '' ));

        if ( 'success' === $alert_status ) {
            return array(
                'img_src' => esc_url( plugins_url( '../../assets/images/generics/circle-green-check.png', plugin_dir_path( __FILE__ ) ) ),
                'alert_title' => $alert['alert_title'],
                'alert_description' => $alert['description'],
                'link' => $this->get_mp_home_link($country),
                'border_left_color' => '#00A650',
                'link_description' => __( 'View purchase details at Mercado Pago', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'sync_button_text' => __( 'Sync order status', WC_MERCADOPAGO_TEXT_DOMAIN ),
            );
        }

        if ( 'pending' === $alert_status ) {
            return array(
                'img_src' => esc_url( plugins_url( '../../assets/images/generics/circle-alert.png', plugin_dir_path( __FILE__ ) ) ),
                'alert_title' => $alert['alert_title'],
                'alert_description' => $alert['description'],
                'link' => $this->get_mp_home_link($country),
                'border_left_color' => '#f73',
                'link_description' => __( 'View purchase details at Mercado Pago', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'sync_button_text' => __( 'Sync order status', WC_MERCADOPAGO_TEXT_DOMAIN ),
            );
        }

        if ( 'rejected' === $alert_status || 'refunded' === $alert_status || 'charged_back' === $alert_status ) {
            return array(
                'img_src' => esc_url( plugins_url( '../../assets/images/generics/circle-red-alert.png', plugin_dir_path( __FILE__ ) ) ),
                'alert_title' => $alert['alert_title'],
                'alert_description' => $alert['description'],
                'link' => $this->get_mp_devsite_link($country),
                'border_left_color' => '#F23D4F',
                'link_description' => __( 'Check the reasons why the purchase was declined.', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'sync_button_text' => __( 'Sync order status', WC_MERCADOPAGO_TEXT_DOMAIN ),
            );
        }
    }

    /**
     * Get Mercado Pago Home Link
     *
     * @param String $country Country Acronym
     *
     * @return String
     */
    public function get_mp_home_link( $country ) {
        $country_links = array(
            'mla' => 'https://www.mercadopago.com.ar/home',
            'mlb' => 'https://www.mercadopago.com.br/home',
            'mlc' => 'https://www.mercadopago.cl/home',
            'mco' => 'https://www.mercadopago.com.co/home',
            'mlm' => 'https://www.mercadopago.com.mx/home',
            'mpe' => 'https://www.mercadopago.com.pe/home',
            'mlu' => 'https://www.mercadopago.com.uy/home',
        );

        return array_key_exists($country, $country_links) ? $country_links[$country] : $country_links['mla'];
    }

    /**
     * Get Mercado Pago Devsite Page Link
     *
     * @param String $country Country Acronym
     *
     * @return String
     */
    public function get_mp_devsite_link( $country ) {
        $country_links = array(
            'mla' => 'https://www.mercadopago.com.ar/developers/es/guides/plugins/woocommerce/sales-processing#bookmark_motivos_de_las_recusas',
            'mlb' => 'https://www.mercadopago.com.br/developers/pt/guides/plugins/woocommerce/sales-processing#bookmark_motivos_de_recusas',
            'mlc' => 'https://www.mercadopago.cl/developers/es/guides/plugins/woocommerce/sales-processing#bookmark_motivos_de_las_recusas',
            'mco' => 'https://www.mercadopago.com.co/developers/es/guides/plugins/woocommerce/sales-processing#bookmark_motivos_de_las_recusas',
            'mlm' => 'https://www.mercadopago.com.mx/developers/es/guides/plugins/woocommerce/sales-processing#bookmark_motivos_de_las_recusas',
            'mpe' => 'https://www.mercadopago.com.pe/developers/es/guides/plugins/woocommerce/sales-processing#bookmark_motivos_de_las_recusas',
            'mlu' => 'https://www.mercadopago.com.uy/developers/es/guides/plugins/woocommerce/sales-processing#bookmark_motivos_de_las_recusas',
        );

        return array_key_exists($country, $country_links) ? $country_links[$country] : $country_links['mla'];
    }

    /**
     * Get payment
     *
     * @return array|null
     * @throws WC_WooMercadoPago_Exception
     */
    public function get_payment( $post_or_order_object ) {
        $order = ( $post_or_order_object instanceof WP_Post ) ? wc_get_order( $post_or_order_object->ID ) : $post_or_order_object;

        if ( ! $order ) {
            return null;
        }

        $payment_ids = explode(',', $order->get_meta( '_Mercado_Pago_Payment_IDs' ));

        if ( empty( $payment_ids ) ) {
            return null;
        }

        $last_payment_id = end($payment_ids);
        $is_production_mode = $order->get_meta( 'is_production_mode' );
        $access_token = 'no' === $is_production_mode || ! $is_production_mode
        	? get_option( '_mp_access_token_test' )
        	: get_option( '_mp_access_token_prod' );

        $mp = new MP($access_token);
        $payment = $mp->search_payment_v1(trim($last_payment_id), $access_token);

        if ( ! $payment || 200 !== $payment['status'] ) {
            return null;
        }

        return $payment;
    }

    /**
     * Sync order status
     *
     * @return void
     */
    public function mercadopago_sync_payment_status(): void {
        try {
            $this->current_user->validate_user_needed_permissions();
            $this->nonce->validate_nonce(
                self::NONCE_ID,
                WC_WooMercadoPago_Helper_Filter::get_sanitize_text_from_post( 'nonce' )
            );

            $order = wc_get_order( (int) WC_WooMercadoPago_Helper_Filter::get_sanitize_text_from_post( 'order_id' ) );
            $payment = $this->get_payment( $order );
            $status = $payment['response']['status'];

            $gateway = $order->get_payment_method();
            $used_gateway = $this->get_wc_gateway_name_for_class_name($gateway);

            ( new WC_WooMercadoPago_Order() )->process_status($status, $payment, $order, $used_gateway);

            wp_send_json_success(
                __( 'Order update successfully. This page will be reloaded...', WC_MERCADOPAGO_TEXT_DOMAIN )
            );
        } catch ( Exception $e ) {
            wp_send_json_error(
                __( 'Unable to update order: ', WC_MERCADOPAGO_TEXT_DOMAIN ) . $e->getMessage(),
                500
            );
        }
    }

    /**
     * Convert mercadopago gateway name for class name
     *
     * @param $gateway
     *
     * @return string|null
     */
    public function get_wc_gateway_name_for_class_name( $gateway ) {
        $classes_name = array(
            'woo-mercado-pago-pix' => 'WC_WooMercadoPago_Pix_Gateway',
            'woo-mercado-pago-basic' => 'WC_WooMercadoPago_Basic_Gateway',
            'woo-mercado-pago-ticket' => 'WC_WooMercadoPago_Ticket_Gateway',
            'woo-mercado-pago-custom' => 'WC_WooMercadoPago_Custom_Gateway',
            'woo-mercado-pago-credits' => 'WC_WooMercadoPago_Credits_Gateway',
        );

        return array_key_exists ( $gateway, $classes_name ) ? $classes_name[ $gateway ] : null;
    }
}

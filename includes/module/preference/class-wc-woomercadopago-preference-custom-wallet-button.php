<?php
/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class WC_WooMercadoPago_Preference_Basic
 */
class WC_WooMercadoPago_Preference_Custom_Wallet_Button extends WC_WooMercadoPago_Preference_Basic {
    /**
     * WC_WooMercadoPago_Preference_Custom_Wallet_Button constructor.
     *
     * @param $payment
     * @param $order
     */
    public function __construct( $payment, $order ) {
        parent::__construct( $payment, $order );
        $this->transaction->__set('purpose', 'wallet_purchase');
    }

    /**
     * Overwrite the default method to set Wallet Button Data
     *
     * @return string[]
     */
    public function get_internal_metadata() {
        $metadata = parent::get_internal_metadata();
        $metadata['checkout'] = 'pro';
        $metadata['checkout_type'] = 'wallet_button';
        return $metadata;
    }
}

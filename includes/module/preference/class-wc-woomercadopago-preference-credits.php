<?php
/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class WC_WooMercadoPago_Preference_Credits
 */
class WC_WooMercadoPago_Preference_Credits extends WC_WooMercadoPago_Preference_Basic {
    /**
     * WC_WooMercadoPago_Preference_Credits constructor.
     *
     * @param $payment
     * @param $order
     */
    public function __construct( $payment, $order ) {
        parent::__construct( $payment, $order );
        $this->transaction->__set('purpose', 'onboarding_credits');
    }

    /**
     * Overwrite the default method to set Wallet Button Data
     *
     * @return string[]
     */
    public function get_internal_metadata() {
        $metadata = parent::get_internal_metadata();
        $metadata['checkout'] = 'pro';
        $metadata['checkout_type'] = 'credits';
        return $metadata;
    }
}

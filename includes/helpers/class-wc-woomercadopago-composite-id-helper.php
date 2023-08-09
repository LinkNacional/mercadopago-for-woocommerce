<?php
/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class WC_WooMercadoPago_Composite_Id_Helper
 */
class WC_WooMercadoPago_Composite_Id_Helper {
    public const SEPARATOR = '|';

    public function generateIdFromPlace( $paymentMethodId, $paymentPlaceId ) {
        return $paymentMethodId . self::SEPARATOR . $paymentPlaceId;
    }

    private function parse( $compositeId ) {
        $exploded = explode(self::SEPARATOR, $compositeId);

        return array(
            'payment_method_id' => $exploded[0],
            'payment_place_id' => isset($exploded[1]) ? $exploded[1] : null,
        );
    }

    public function getPaymentMethodId( $compositeId ) {
        return $this->parse($compositeId)['payment_method_id'];
    }

    public function getPaymentPlaceId( $compositeId ) {
        return $this->parse($compositeId)['payment_place_id'];
    }
}

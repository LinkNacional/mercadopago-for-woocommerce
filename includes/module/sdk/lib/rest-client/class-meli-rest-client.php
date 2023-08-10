<?php
/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class MeliRestClient
 */
class Meli_Rest_Client extends Mp_Rest_Client_Abstract {
    public const API_MELI_BASE_URL = 'https://api.mercadolibre.com';

    /**
     * Get method
     *
     * @param array $request Request.
     * @return array|null
     * @throws WC_WooMercadoPago_Exception Get exception.
     */
    public static function get( $request ) {
        $request['method'] = 'GET';
        return self::exec_abs( $request, self::API_MELI_BASE_URL );
    }

    /**
     * Post method
     *
     * @param array $request Request.
     * @return array|null
     * @throws WC_WooMercadoPago_Exception Post exception.
     */
    public static function post( $request ) {
        $request['method'] = 'POST';
        return self::exec_abs( $request, self::API_MELI_BASE_URL );
    }

    /**
     * Put method
     *
     * @param array $request Request.
     * @return array|null
     * @throws WC_WooMercadoPago_Exception Put exception.
     */
    public static function put( $request ) {
        $request['method'] = 'PUT';
        return self::exec_abs( $request, self::API_MELI_BASE_URL );
    }

    /**
     * Delete method
     *
     * @param array $request Request.
     * @return array|null
     * @throws WC_WooMercadoPago_Exception Delete exception.
     */
    public static function delete( $request ) {
        $request['method'] = 'DELETE';
        return self::exec_abs( $request, self::API_MELI_BASE_URL );
    }
}

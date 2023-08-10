<?php
/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class WC_WooMercadoPago_Constants
 */
class WC_WooMercadoPago_Constants {
    public const PRODUCT_ID_DESKTOP = 'BT7OF5FEOO6G01NJK3QG';

    public const PRODUCT_ID_MOBILE = 'BT7OFH09QS3001K5A0H0';

    public const PLATAFORM_ID = 'bo2hnr2ic4p001kbgpt0';

    public const VERSION = '6.9.3';

    public const MIN_PHP = 7.0;

    public const API_MP_BASE_URL = 'https://api.mercadopago.com';

    public const DATE_EXPIRATION = 3;

    public const PAYMENT_GATEWAYS = array(
        'WC_WooMercadoPago_Basic_Gateway',
        'WC_WooMercadoPago_Credits_Gateway',
        'WC_WooMercadoPago_Custom_Gateway',
        'WC_WooMercadoPago_Ticket_Gateway',
        'WC_WooMercadoPago_Pix_Gateway',
    );

    public const GATEWAYS_IDS = array(
        'woo-mercado-pago-ticket',
        'woo-mercado-pago-custom',
        'woo-mercado-pago-basic',
        'woo-mercado-pago-pix',
        'woo-mercado-pago-credits',
    );
}

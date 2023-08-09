<?php
/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class WC_WooMercadoPago_Helper_Filter
 */
class WC_WooMercadoPago_Helper_Filter {
    /**
     * Get data from $_POST method with sanitize for text field
     *
     * @param $key
     *
     * @return string
     */
    public static function get_sanitize_text_from_post( $key ) {
        return sanitize_text_field($_POST[$key] ?? ''); // phpcs:ignore
    }
}

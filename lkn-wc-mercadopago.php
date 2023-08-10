<?php
/**
 * Plugin Name: Link Nacional Mercado Pago payments for WooCommerce
 * Plugin URI: https://www.linknacional.com.br/wordpress/plugins/
 * Description: Configure the payment options and accept payments with cards, ticket and money of Mercado Pago account.
 * Version: 6.9.3
 * Author: Link Nacional
 * Author URI: https://www.linknacional.com.br/wordpress/plugins/
 * Text Domain: lkn-wc-mercadopago
 * Domain Path: /i18n/languages/
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! defined('LKN_WC_MERCADOPAGO_TEXT_DOMAIN')) {
    define('LKN_WC_MERCADOPAGO_TEXT_DOMAIN', 'lkn-wc-mercadopago');
}

if ( ! defined( 'LKN_WC_MERCADOPAGO_BASENAME' ) ) {
    define( 'LKN_WC_MERCADOPAGO_BASENAME', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'LKN_WC_MERCADOPAGO_FILE' ) ) {
    define( 'LKN_WC_MERCADOPAGO_FILE', __FILE__ );
}

if ( ! function_exists( 'is_plugin_active' ) ) {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
}
add_action( 'before_woocommerce_init', function(): void {
    if ( class_exists( 'Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
    }
} );
if ( ! class_exists( 'WC_WooMercadoPago_Init' ) ) {
    include_once __DIR__ . '/includes/module/class-wc-woomercadopago-init.php';

    register_activation_hook( __FILE__, array('WC_WooMercadoPago_Init', 'mercadopago_plugin_activation') );
    register_activation_hook( __FILE__, array('WC_WooMercadoPago_Init', 'mercadopago_handle_saved_cards_notice') );
    add_action( 'plugins_loaded', array('WC_WooMercadoPago_Init', 'woocommerce_mercadopago_init') );
}

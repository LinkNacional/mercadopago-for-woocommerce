<?php

/**
 * Plugin Name: Mercado Pago by Link Nacional
 * Plugin URI: https://github.com/mercadopago/cart-woocommerce
 * Description: Configure as opções de pagamento e aceite pagamentos com cartões, boleto e dinheiro da conta Mercado Pago.
 * Version: 7.3.6
 * Author: Mercado Pago
 * Author URI: https://developers.mercadopago.com/
 * Text Domain: lkn-woocommerce-mercadopago
 * Domain Path: /i18n/languages/
 * WC requires at least: 5.5.2
 * WC tested up to: 8.1.0
 * Requires PHP: 7.4
 *
 * @package MercadoPago
 */

if (!defined('ABSPATH')) {
    exit;
}

include_once dirname(__FILE__) . '/src/Autoloader.php';

use Automattic\WooCommerce\Utilities\FeaturesUtil;
use MercadoPago\Woocommerce\Autoloader;
use MercadoPago\Woocommerce\Packages;
use MercadoPago\Woocommerce\WoocommerceMercadoPago;

if (!Autoloader::init()) {
    return false;
}

if (!Packages::init()) {
    return false;
}

add_action('before_woocommerce_init', function () {
    if (class_exists(FeaturesUtil::class)) {
        FeaturesUtil::declare_compatibility('custom_order_tables', __FILE__);
    }

    if (class_exists(FeaturesUtil::class)) {
        FeaturesUtil::declare_compatibility('cart_checkout_blocks', __FILE__);
    }
});

if (!class_exists('WoocommerceMercadoPago')) {
    $GLOBALS['mercadopago'] = new WoocommerceMercadoPago();
}

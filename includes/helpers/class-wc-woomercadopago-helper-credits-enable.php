<?php
/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined('ABSPATH') ) {
    exit;
}

/**
 * Class WC_WooMercadoPago_Helper_Credits_Enable)
 */
class WC_WooMercadoPago_Helper_Credits_Enable {
    public const CREDITS_ACTIVATION_NEEDED = 'mercadopago_credits_activation_needed';

    public const ALREADY_ENABLE_BY_DEFAULT = 'mercadopago_already_enabled_by_default';

    public const ENABLE_CREDITS_ACTION = 'mp_enable_credits_action';

    /**
     * Register the options needed to control de credits auto enable feature.
     *
     * @since 6.9.3
     */
    public static function register_enable_credits_action(): void {
        if ( is_admin() ) {
            add_option(self::CREDITS_ACTIVATION_NEEDED, 'yes');
            add_option(self::ALREADY_ENABLE_BY_DEFAULT, 'no');
            add_action(self::ENABLE_CREDITS_ACTION, array('WC_WooMercadoPago_Helper_Credits_Enable', 'execute_enable_credits_action'));
        }
    }

    /**
     * Activate credits by default, if the seller has cho pro enabled
     * and it was not previously enabled by default.
     *
     * @since 6.9.3
     */
    public static function execute_enable_credits_action(): void {
        try {
            if ( is_admin() && get_option(self::CREDITS_ACTIVATION_NEEDED) === 'yes' ) {
                update_option(self::CREDITS_ACTIVATION_NEEDED, 'no');

                $basicGateway = new WC_WooMercadoPago_Basic_Gateway();
                $creditsGateway = new WC_WooMercadoPago_Credits_Gateway();

                if ( get_option(self::ALREADY_ENABLE_BY_DEFAULT) === 'no' ) {
                    if ( isset($creditsGateway->settings['already_enabled_by_default']) && $creditsGateway->get_option('already_enabled_by_default') ) {
                        return;
                    }

                    if ( isset($basicGateway->settings['enabled']) && $basicGateway->get_option('enabled') === 'yes' ) {
                        $creditsGateway->active_by_default();
                        update_option(self::ALREADY_ENABLE_BY_DEFAULT, 'yes');
                    }
                }
            }
        } catch ( Exception $ex ) {
            wc_get_logger()->error($ex->getMessage(), array('source' => __CLASS__));
        }
    }
}

<?php
/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Class WC_WooMercadoPago_Products_Hook_Credits
 */
class WC_WooMercadoPago_Products_Hook_Credits {
    /**
     * Site Id
     *
     * @var string
     */
    public $site_id;

    /**
     * Checkout Credits Enabled
     *
     * @var boolean
     */
    public $credits_enabled;

    /**
     * Credits Banner Enabled
     *
     * @var boolean
     */
    public $credits_banner;

    /**
     * Credits Helper Class
     *
     * @var WC_WooMercadoPago_Helper_Credits
     */
    public $credits_helper;

    /**
     * Options
     *
     * @var WC_WooMercadoPago_Options
     */
    public $mp_options;

    /**
     * WC_WooMercadoPago_Products_Hook_Credits constructor.
     *
     */
    public function __construct() {
        $this->credits_helper = new WC_WooMercadoPago_Helper_Credits();
        $this->mp_options = WC_WooMercadoPago_Options::get_instance();

        if ( ! is_admin() ) {
            $credits_configs = get_option( 'woocommerce_woo-mercado-pago-credits_settings', '' );
            $this->credits_enabled = 'no';
            $this->site_id = strtolower(get_option( '_site_id_v1' ));
            $is_credits = $this->credits_helper->is_credits();

            if ( isset( $credits_configs['enabled'] ) && isset( $credits_configs['credits_banner'] ) ) {
                $this->credits_enabled = $credits_configs['enabled'];
                $this->credits_banner = $credits_configs['credits_banner'];
            }

            if ( 'yes' === $this->credits_enabled && 'yes' === $this->credits_banner ) {
                if ( $is_credits ) {
                    $this->load_hooks();
                }
            }
        }
    }

    /**
     * Get sufix to static files
     */
    private function get_suffix() {
        return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
    }

    /**
     * Load Hooks
     */
    public function load_hooks(): void {
        add_action( 'woocommerce_before_add_to_cart_form', array($this, 'before_add_to_cart_form') );
    }

    public function before_add_to_cart_form(): void {
        $site = strtolower($this->mp_options->get_site_id());
        $links = WC_WooMercadoPago_Helper_Links::get_mc_blog_link($site);
        global $woocommerce;
        $suffix = $this->get_suffix();

        wp_enqueue_style(
            'mp-credits-modal-style',
            plugins_url( '../../assets/css/credits/modal' . $suffix . '.css', plugin_dir_path( __FILE__ ) ),
            array(),
            WC_WooMercadoPago_Constants::VERSION
        );

        wc_get_template(
            'credits/mp-credits-modal.php',
            array (
                'banner_title' => __( 'Pay in', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'banner_title_bold' => __('installments', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'banner_title_end' => __('with Mercado Pago', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'banner_link' => __( 'Read more', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'modal_title' => __( 'Buy now and pay in installments with no card later!', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'modal_subtitle' => __( '100% online,', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'modal_subtitle_2' => __( 'without paperwork or monthly fees', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'modal_step_1' => __( 'When paying, choose', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'modal_step_1_end' => __('. Login to your account or create one in a few steps.', WC_MERCADOPAGO_TEXT_DOMAIN),
                'modal_step_2' => __( 'Search for', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'modal_step_2_end' => __('among the options, select it and choose in how many installments you would like to pay.', WC_MERCADOPAGO_TEXT_DOMAIN),
                'modal_step_3' => __( 'Pay your installments monthly as you wish, in the Mercado Pago app.', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'modal_footer' => __( 'Questions? ', WC_MERCADOPAGO_TEXT_DOMAIN ),
                'modal_footer_help_link' => $links['FAQ_link'],
                'modal_footer_link' => __('Check our FAQ', WC_MERCADOPAGO_TEXT_DOMAIN),
                'modal_footer_end' => __('. Credit subject to approval.', WC_MERCADOPAGO_TEXT_DOMAIN)
            ),
            '',
            WC_WooMercadoPago_Module::get_templates_path()
        );

        wp_enqueue_script(
            'mp-credits-modal-js',
            plugins_url( '../../assets/js/credits/script' . $suffix . '.js', plugin_dir_path( __FILE__ ) ),
            array(),
            WC_WooMercadoPago_Constants::VERSION,
            false
        );

        wp_enqueue_script(
            'mercadopago_melidata',
            plugins_url( '../../assets/js/melidata/melidata-client' . $suffix . '.js', plugin_dir_path( __FILE__ ) ),
            array(),
            WC_WooMercadoPago_Constants::VERSION,
            true
        );

        wp_localize_script(
            'mercadopago_melidata',
            'wc_melidata_params',
            array(
                'type' => 'buyer',
                'site_id' => $this->site_id ? strtoupper( $this->site_id ) : 'MLA',
                'location' => '/products',
                'payment_method' => null,
                'plugin_version' => WC_WooMercadoPago_Constants::VERSION,
                'platform_version' => $woocommerce->version,
            )
        );
    }
}

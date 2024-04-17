<?php

namespace MercadoPago\Woocommerce\Translations;

use MercadoPago\Woocommerce\Helpers\Links;

if (!defined('ABSPATH')) {
    exit;
}

class AdminTranslations
{
    /**
     * @var array
     */
    public $notices = [];

    /**
     * @var array
     */
    public $plugin = [];

    /**
     * @var array
     */
    public $order = [];

    /**
     * @var array
     */
    public $headerSettings = [];

    /**
     * @var array
     */
    public $credentialsSettings = [];

    /**
     * @var array
     */
    public $supportSettings = [];

    /**
     * @var array
     */
    public $storeSettings = [];

    /**
     * @var array
     */
    public $gatewaysSettings = [];

    /**
     * @var array
     */
    public $basicGatewaySettings = [];

    /**
     * @var array
     */
    public $creditsGatewaySettings = [];

    /**
     * @var array
     */
    public $customGatewaySettings = [];

    /**
     * @var array
     */
    public $ticketGatewaySettings = [];

    /**
     * @var array
     */
    public $pseGatewaySettings = [];

    /**
     * @var array
     */
    public $pixGatewaySettings = [];

    /**
     * @var array
     */
    public $testModeSettings = [];

    /**
     * @var array
     */
    public $configurationTips = [];

    /**
     * @var array
     */
    public $validateCredentials = [];

    /**
     * @var array
     */
    public $updateCredentials = [];

    /**
     * @var array
     */
    public $updateStore = [];

    /**
     * @var array
     */
    public $currency = [];

    /**
     * @var array
     */
    public $statusSync = [];

    /**
     * @var array
     */
    public $links;

    /**
     * Translations constructor
     *
     * @param Links $links
     */
    public function __construct(Links $links)
    {
        $this->links = $links->getLinks();

        $this->setNoticesTranslations();
        $this->setPluginSettingsTranslations();
        $this->setHeaderSettingsTranslations();
        $this->setCredentialsSettingsTranslations();
        $this->setSupportSettingsTranslations();
        $this->setStoreSettingsTranslations();
        $this->setOrderSettingsTranslations();
        $this->setGatewaysSettingsTranslations();
        $this->setBasicGatewaySettingsTranslations();
        $this->setCreditsGatewaySettingsTranslations();
        $this->setCustomGatewaySettingsTranslations();
        $this->setTicketGatewaySettingsTranslations();
        $this->setPseGatewaySettingsTranslations();
        $this->setPixGatewaySettingsTranslations();
        $this->setTestModeSettingsTranslations();
        $this->setConfigurationTipsTranslations();
        $this->setUpdateCredentialsTranslations();
        $this->setValidateCredentialsTranslations();
        $this->setUpdateStoreTranslations();
        $this->setCurrencyTranslations();
        $this->setStatusSyncTranslations();
    }

    /**
     * Set notices translations
     *
     * @return void
     */
    private function setNoticesTranslations(): void
    {
        $missWoocommerce = sprintf(
            __('The Mercado Pago module needs an active version of %s in order to work!', 'lkn-woocommerce-mercadopago'),
            '<a target="_blank" href="https://wordpress.org/extend/plugins/woocommerce/">WooCommerce</a>'
        );

        $this->notices = [
            'miss_woocommerce'          => $missWoocommerce,
            'php_wrong_version'         => __('Mercado Pago payments for WooCommerce requires PHP version 7.4 or later. Please update your PHP version.', 'lkn-woocommerce-mercadopago'),
            'missing_curl'              => __('Mercado Pago Error: PHP Extension CURL is not installed.', 'lkn-woocommerce-mercadopago'),
            'missing_gd_extensions'     => __('Mercado Pago Error: PHP Extension GD is not installed. Installation of GD extension is required to send QR Code Pix by email.', 'lkn-woocommerce-mercadopago'),
            'activate_woocommerce'      => __('Activate WooCommerce', 'lkn-woocommerce-mercadopago'),
            'install_woocommerce'       => __('Install WooCommerce', 'lkn-woocommerce-mercadopago'),
            'see_woocommerce'           => __('See WooCommerce', 'lkn-woocommerce-mercadopago'),
            'miss_pix_text'             => __('Please note that to receive payments via Pix at our checkout, you must have a Pix key registered in your Mercado Pago account.', 'lkn-woocommerce-mercadopago'),
            'miss_pix_link'             => __('Register your Pix key at Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'dismissed_review_title'    => sprintf(__('%s, help us improve the experience we offer', 'lkn-woocommerce-mercadopago'), wp_get_current_user()->display_name),
            'dismissed_review_subtitle' => __('Share your opinion with us so that we improve our product and offer the best payment solution.', 'lkn-woocommerce-mercadopago'),
            'dismissed_review_button'   => __('Rate the plugin', 'lkn-woocommerce-mercadopago'),
            'saved_cards_title'         => __('Enable payments via Mercado Pago account', 'lkn-woocommerce-mercadopago'),
            'saved_cards_subtitle'      => __('When you enable this function, your customers pay faster using their Mercado Pago accounts.</br>The approval rate of these payments in your store can be 25% higher compared to other payment methods.', 'lkn-woocommerce-mercadopago'),
            'saved_cards_button'        => __('Activate', 'lkn-woocommerce-mercadopago'),
            'missing_translation'       => __("Our plugin does not support the language you've chosen, so we've switched it to the English default. If you prefer, you can also select Spanish or Portuguese (Brazilian).", 'lkn-woocommerce-mercadopago'),
            'action_feedback_title'     => __('You activated Mercado Pago’s plug-in', 'lkn-woocommerce-mercadopago'),
            'action_feedback_subtitle'  => __('Follow the instructions below to integrate your store with Mercado Pago and start to sell.', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set plugin settings translations
     *
     * @return void
     */
    private function setPluginSettingsTranslations(): void
    {
        $this->plugin = [
            'set_plugin'     => __('Set plugin', 'lkn-woocommerce-mercadopago'),
            'payment_method' => __('Payment methods', 'lkn-woocommerce-mercadopago'),
            'plugin_manual'  => __('Plugin manual', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set order settings translations
     *
     * @return void
     */
    private function setOrderSettingsTranslations(): void
    {
        $this->order = [
            'cancel_order'                       => __('Cancel order', 'lkn-woocommerce-mercadopago'),
            'order_note_commission_title'        => __('Mercado Pago commission:', 'lkn-woocommerce-mercadopago'),
            'order_note_commission_tip'          => __('Represents the commission configured on plugin settings.', 'lkn-woocommerce-mercadopago'),
            'order_note_discount_title'          => __('Mercado Pago discount:', 'lkn-woocommerce-mercadopago'),
            'order_note_discount_tip'            => __('Represents the discount configured on plugin settings.', 'lkn-woocommerce-mercadopago'),
            'order_note_installments_fee_tip'    => __('Represents the installment fee charged by Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'order_note_installments_fee_title'  => __('Mercado Pago Installment Fee:', 'lkn-woocommerce-mercadopago'),
            'order_note_total_paid_amount_tip'   => __('Represents the total purchase plus the installment fee charged by Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'order_note_total_paid_amount_title' => __('Mercado Pago Total:', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set headers settings translations
     *
     * @return void
     */
    private function setHeaderSettingsTranslations(): void
    {
        $titleHeader = sprintf(
            '%s %s %s <br/> %s %s',
            __('Accept', 'lkn-woocommerce-mercadopago'),
            __('payments', 'lkn-woocommerce-mercadopago'),
            __('safely', 'lkn-woocommerce-mercadopago'),
            __('with', 'lkn-woocommerce-mercadopago'),
            __('Mercado Pago', 'lkn-woocommerce-mercadopago')
        );

        $installmentsDescription = sprintf(
            '%s <b>%s</b> %s <b>%s</b> %s',
            __('Choose', 'lkn-woocommerce-mercadopago'),
            __('when you want to receive the money', 'lkn-woocommerce-mercadopago'),
            __('from your sales and if you want to offer', 'lkn-woocommerce-mercadopago'),
            __('interest-free installments', 'lkn-woocommerce-mercadopago'),
            __('to your clients.', 'lkn-woocommerce-mercadopago')
        );



        $this->headerSettings = [
            'ssl'                      => __('SSL', 'lkn-woocommerce-mercadopago'),
            'curl'                     => __('Curl', 'lkn-woocommerce-mercadopago'),
            'gd_extension'             => __('GD Extensions', 'lkn-woocommerce-mercadopago'),
            'title_header'             => $titleHeader,
            'title_requirements'       => __('Technical requirements', 'lkn-woocommerce-mercadopago'),
            'title_installments'       => __('Collections and installments', 'lkn-woocommerce-mercadopago'),
            'title_questions'          => __('More information', 'lkn-woocommerce-mercadopago'),
            'description_ssl'          => __('Implementation responsible for transmitting data to Mercado Pago in a secure and encrypted way.', 'lkn-woocommerce-mercadopago'),
            'description_curl'         => __('It is an extension responsible for making payments via requests from the plugin to Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'description_gd_extension' => __('These extensions are responsible for the implementation and operation of Pix in your store.', 'lkn-woocommerce-mercadopago'),
            'description_installments' => $installmentsDescription,
            'description_questions'    => __('Check our documentation to learn more about integrating our plug-in.', 'lkn-woocommerce-mercadopago'),
            'button_installments'      => __('Set deadlines and fees', 'lkn-woocommerce-mercadopago'),
            'button_questions'         => __('Go to documentation', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set credentials settings translations
     *
     * @return void
     */
    private function setCredentialsSettingsTranslations(): void
    {

        $this->credentialsSettings = [
            'public_key'                        => __('Public Key', 'lkn-woocommerce-mercadopago'),
            'access_token'                      => __('Access Token', 'lkn-woocommerce-mercadopago'),
            'title_credentials'                 => __('1. Enter your credentials to integrate your store with Mercado Pago', 'lkn-woocommerce-mercadopago'),
            'title_credentials_prod'            => __('Production credentials', 'lkn-woocommerce-mercadopago'),
            'title_credentials_test'            => __('Test credentials', 'lkn-woocommerce-mercadopago'),
            'first_text_subtitle_credentials'   => __('To start selling, ', 'lkn-woocommerce-mercadopago'),
            'second_text_subtitle_credentials'  => __('in the fields below. If you don’t have credentials yet, you’ll have to create them from this link.', 'lkn-woocommerce-mercadopago'),
            'subtitle_credentials_test'         => __('Enable Mercado Pago checkouts for test purchases in the store.', 'lkn-woocommerce-mercadopago'),
            'subtitle_credentials_prod'         => __('Enable Mercado Pago checkouts to receive real payments in the store.', 'lkn-woocommerce-mercadopago'),
            'placeholder_public_key'            => __('Paste your Public Key here', 'lkn-woocommerce-mercadopago'),
            'placeholder_access_token'          => __('Paste your Access Token here', 'lkn-woocommerce-mercadopago'),
            'button_credentials'                => __('Save and continue', 'lkn-woocommerce-mercadopago'),
            'card_info_subtitle'                => __('You have to enter your production credentials to start selling with Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'card_info_button_text'             => __('Enter credentials', 'lkn-woocommerce-mercadopago'),
            'card_homolog_title'                => __('Activate your credentials to be able to sell', 'lkn-woocommerce-mercadopago'),
            'card_homolog_subtitle'             => __('Credentials are codes that you must enter to enable sales. Go below on Activate Credentials. On the next screen, use again the Activate Credentials button and fill in the fields with the requested information.', 'lkn-woocommerce-mercadopago'),
            'card_homolog_button_text'          => __('Activate credentials', 'lkn-woocommerce-mercadopago'),
            'text_link_credentials'             => __('copy and paste your production credentials ', 'lkn-woocommerce-mercadopago')
        ];
    }

    /**
     * Set store settings translations
     *
     * @return void
     */
    private function setStoreSettingsTranslations(): void
    {
        $helperUrl = sprintf(
            '%s %s <a class="mp-settings-blue-text" target="_blank" href="%s">%s</a>.',
            __('Add the URL to receive payments notifications.', 'lkn-woocommerce-mercadopago'),
            __('Find out more information in the', 'lkn-woocommerce-mercadopago'),
            $this->links['docs_ipn_notification'],
            __('guides', 'lkn-woocommerce-mercadopago')
        );

        $helperIntegrator = sprintf(
            '%s %s <a class="mp-settings-blue-text" target="_blank" href="%s">%s</a>.',
            __('If you are a Mercado Pago Certified Partner, make sure to add your integrator_id.', 'lkn-woocommerce-mercadopago'),
            __('If you do not have the code, please', 'lkn-woocommerce-mercadopago'),
            $this->links['docs_developers_program'],
            __('request it now', 'lkn-woocommerce-mercadopago')
        );

        $this->storeSettings = [
            'title_store'                   => __('2. Customize your business’ information', 'lkn-woocommerce-mercadopago'),
            'title_info_store'              => __('Your store information', 'lkn-woocommerce-mercadopago'),
            'title_advanced_store'          => __('Advanced integration options (optional)', 'lkn-woocommerce-mercadopago'),
            'title_debug'                   => __('Debug and Log Mode', 'lkn-woocommerce-mercadopago'),
            'subtitle_store'                => __('Fill out the following details to have a better experience and offer your customers more information.', 'lkn-woocommerce-mercadopago'),
            'subtitle_name_store'           => __('Name of your store in your client\'s invoice', 'lkn-woocommerce-mercadopago'),
            'subtitle_activities_store'     => __('Identification in Activities of Mercado Pago', 'lkn-woocommerce-mercadopago'),
            'subtitle_advanced_store'       => __('For further integration of your store with Mercado Pago (IPN, Certified Partners, Debug Mode)', 'lkn-woocommerce-mercadopago'),
            'subtitle_category_store'       => __('Store category', 'lkn-woocommerce-mercadopago'),
            'subtitle_url'                  => __('URL for IPN', 'lkn-woocommerce-mercadopago'),
            'subtitle_integrator'           => __('Integrator ID', 'lkn-woocommerce-mercadopago'),
            'subtitle_debug'                => __('We record your store\'s actions in order to provide a better assistance.', 'lkn-woocommerce-mercadopago'),
            'placeholder_name_store'        => __('Ex: Mary\'s Store', 'lkn-woocommerce-mercadopago'),
            'placeholder_activities_store'  => __('Ex: Mary Store', 'lkn-woocommerce-mercadopago'),
            'placeholder_category_store'    => __('Select', 'lkn-woocommerce-mercadopago'),
            'placeholder_url'               => __('Ex: https://examples.com/my-custom-ipn-url', 'lkn-woocommerce-mercadopago'),
            'options_url'                   => __('Add plugin default params', 'lkn-woocommerce-mercadopago'),
            'placeholder_integrator'        => __('Ex: 14987126498', 'lkn-woocommerce-mercadopago'),
            'accordion_advanced_store_show' => __('Show advanced options', 'lkn-woocommerce-mercadopago'),
            'accordion_advanced_store_hide' => __('Hide advanced options', 'lkn-woocommerce-mercadopago'),
            'button_store'                  => __('Save and continue', 'lkn-woocommerce-mercadopago'),
            'helper_name_store'             => __('If this field is empty, the purchase will be identified as Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'helper_activities_store'       => __('In Activities, you will view this term before the order number', 'lkn-woocommerce-mercadopago'),
            'helper_category_store'         => __('Select "Other categories" if you do not find the appropriate category.', 'lkn-woocommerce-mercadopago'),
            'helper_integrator_link'        => __('request it now.', 'lkn-woocommerce-mercadopago'),
            'helper_url'                    => $helperUrl,
            'helper_integrator'             => $helperIntegrator
        ];
    }

    /**
     * Set gateway settings translations
     *
     * @return void
     */
    private function setGatewaysSettingsTranslations(): void
    {
        $this->gatewaysSettings = [
            'title_payments'    => __('3. Activate and set up payment methods', 'lkn-woocommerce-mercadopago'),
            'subtitle_payments' => __('Select the payment method you want to appear in your store to activate and set it up.', 'lkn-woocommerce-mercadopago'),
            'settings_payment'  => __('Settings', 'lkn-woocommerce-mercadopago'),
            'button_payment'    => __('Continue', 'lkn-woocommerce-mercadopago'),
            'enabled'           => __('Enabled', 'lkn-woocommerce-mercadopago'),
            'disabled'          => __('Disabled', 'lkn-woocommerce-mercadopago'),
            'empty_credentials' => __('Configure your credentials to enable Mercado Pago payment methods.', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set basic settings translations
     *
     * @return void
     */
    private function setBasicGatewaySettingsTranslations(): void
    {
        $enabledDescriptionsEnabled = sprintf(
            '%s <b>%s</b>.',
            __('The checkout is', 'lkn-woocommerce-mercadopago'),
            __('enabled', 'lkn-woocommerce-mercadopago')
        );

        $enabledDescriptionsDisabled = sprintf(
            '%s <b>%s</b>.',
            __('The checkout is', 'lkn-woocommerce-mercadopago'),
            __('disabled', 'lkn-woocommerce-mercadopago')
        );

        $currencyConversionDescriptionsEnabled = sprintf(
            '%s <b>%s</b>.',
            __('Currency conversion is', 'lkn-woocommerce-mercadopago'),
            __('enabled', 'lkn-woocommerce-mercadopago')
        );

        $currencyConversionDescriptionsDisabled = sprintf(
            '%s <b>%s</b>.',
            __('Currency conversion is', 'lkn-woocommerce-mercadopago'),
            __('disabled', 'lkn-woocommerce-mercadopago')
        );

        $autoReturnDescriptionsEnabled = sprintf(
            '%s <b>%s</b>.',
            __('The buyer', 'lkn-woocommerce-mercadopago'),
            __('will be automatically redirected to the store', 'lkn-woocommerce-mercadopago')
        );

        $autoReturnDescriptionsDisabled = sprintf(
            '%s <b>%s</b>.',
            __('The buyer', 'lkn-woocommerce-mercadopago'),
            __('will not be automatically redirected to the store', 'lkn-woocommerce-mercadopago')
        );


        $binaryModeDescriptionsEnabled = sprintf(
            '%s <b>%s</b>.',
            __('Pending payments', 'lkn-woocommerce-mercadopago'),
            __('will be automatically declined', 'lkn-woocommerce-mercadopago')
        );

        $binaryModeDescriptionsDisabled = sprintf(
            '%s <b>%s</b>.',
            __('Pending payments', 'lkn-woocommerce-mercadopago'),
            __('will not be automatically declined', 'lkn-woocommerce-mercadopago')
        );

        $this->basicGatewaySettings = [
            'gateway_title'                             => __('Your saved cards or money available in Mercado Pago', 'lkn-woocommerce-mercadopago'),
            'gateway_description'                       => __('Your clients finalize their payments in Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'gateway_method_title'                      => __('Mercado Pago - Checkout Pro', 'lkn-woocommerce-mercadopago'),
            'gateway_method_description'                => __('Your clients finalize their payments in Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'header_title'                              => __('Checkout Pro', 'lkn-woocommerce-mercadopago'),
            'header_description'                        => __('With Checkout Pro you sell with all the safety inside Mercado Pago environment.', 'lkn-woocommerce-mercadopago'),
            'card_settings_title'                       => __('Mercado Pago plugin general settings', 'lkn-woocommerce-mercadopago'),
            'card_settings_subtitle'                    => __('Set the deadlines and fees, test your store or access the Plugin manual.', 'lkn-woocommerce-mercadopago'),
            'card_settings_button_text'                 => __('Go to Settings', 'lkn-woocommerce-mercadopago'),
            'enabled_title'                             => __('Enable the checkout', 'lkn-woocommerce-mercadopago'),
            'enabled_subtitle'                          => __('By disabling it, you will disable all payments from Mercado Pago Checkout at Mercado Pago website by redirect.', 'lkn-woocommerce-mercadopago'),
            'enabled_descriptions_enabled'              => $enabledDescriptionsEnabled,
            'enabled_descriptions_disabled'             => $enabledDescriptionsDisabled,
            'title_title'                               => __('Title in the store Checkout', 'lkn-woocommerce-mercadopago'),
            'title_description'                         => __('Change the display text in Checkout, maximum characters: 85', 'lkn-woocommerce-mercadopago'),
            'title_default'                             => __('Your saved cards or money available in Mercado Pago', 'lkn-woocommerce-mercadopago'),
            'title_desc_tip'                            => __('The text inserted here will not be translated to other languages', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_title'                 => __('Convert Currency', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_subtitle'              => __('Activate this option so that the value of the currency set in WooCommerce is compatible with the value of the currency you use in Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_descriptions_enabled'  => $currencyConversionDescriptionsEnabled,
            'currency_conversion_descriptions_disabled' => $currencyConversionDescriptionsDisabled,
            'ex_payments_title'                         => __('Choose the payment methods you accept in your store', 'lkn-woocommerce-mercadopago'),
            'ex_payments_description'                   => __('Enable the payment methods available to your clients.', 'lkn-woocommerce-mercadopago'),
            'ex_payments_type_credit_card_label'        => __('Credit Cards', 'lkn-woocommerce-mercadopago'),
            'ex_payments_type_debit_card_label'         => __('Debit Cards', 'lkn-woocommerce-mercadopago'),
            'ex_payments_type_other_label'              => __('Other Payment Methods', 'lkn-woocommerce-mercadopago'),
            'installments_title'                        => __('Maximum number of installments', 'lkn-woocommerce-mercadopago'),
            'installments_description'                  => __('What is the maximum quota with which a customer can buy?', 'lkn-woocommerce-mercadopago'),
            'installments_options_1'                    => __('1 installment', 'lkn-woocommerce-mercadopago'),
            'installments_options_2'                    => __('2 installments', 'lkn-woocommerce-mercadopago'),
            'installments_options_3'                    => __('3 installments', 'lkn-woocommerce-mercadopago'),
            'installments_options_4'                    => __('4 installments', 'lkn-woocommerce-mercadopago'),
            'installments_options_5'                    => __('5 installments', 'lkn-woocommerce-mercadopago'),
            'installments_options_6'                    => __('6 installments', 'lkn-woocommerce-mercadopago'),
            'installments_options_10'                   => __('10 installments', 'lkn-woocommerce-mercadopago'),
            'installments_options_12'                   => __('12 installments', 'lkn-woocommerce-mercadopago'),
            'installments_options_15'                   => __('15 installments', 'lkn-woocommerce-mercadopago'),
            'installments_options_18'                   => __('18 installments', 'lkn-woocommerce-mercadopago'),
            'installments_options_24'                   => __('24 installments', 'lkn-woocommerce-mercadopago'),
            'advanced_configuration_title'              => __('Advanced settings', 'lkn-woocommerce-mercadopago'),
            'advanced_configuration_description'        => __('Edit these advanced fields only when you want to modify the preset values.', 'lkn-woocommerce-mercadopago'),
            'method_title'                              => __('Payment experience', 'lkn-woocommerce-mercadopago'),
            'method_description'                        => __('Define what payment experience your customers will have, whether inside or outside your store.', 'lkn-woocommerce-mercadopago'),
            'method_options_redirect'                   => __('Redirect', 'lkn-woocommerce-mercadopago'),
            'method_options_modal'                      => __('Modal', 'lkn-woocommerce-mercadopago'),
            'auto_return_title'                         => __('Return to the store', 'lkn-woocommerce-mercadopago'),
            'auto_return_subtitle'                      => __('Do you want your customer to automatically return to the store after payment?', 'lkn-woocommerce-mercadopago'),
            'auto_return_descriptions_enabled'          => $autoReturnDescriptionsEnabled,
            'auto_return_descriptions_disabled'         => $autoReturnDescriptionsDisabled,
            'success_url_title'                         => __('Success URL', 'lkn-woocommerce-mercadopago'),
            'success_url_description'                   => __('Choose the URL that we will show your customers when they finish their purchase.', 'lkn-woocommerce-mercadopago'),
            'failure_url_title'                         => __('Payment URL rejected', 'lkn-woocommerce-mercadopago'),
            'failure_url_description'                   => __('Choose the URL that we will show to your customers when we refuse their purchase. Make sure it includes a message appropriate to the situation and give them useful information so they can solve it.', 'lkn-woocommerce-mercadopago'),
            'pending_url_title'                         => __('Payment URL pending', 'lkn-woocommerce-mercadopago'),
            'pending_url_description'                   => __('Choose the URL that we will show to your customers when they have a payment pending approval.', 'lkn-woocommerce-mercadopago'),
            'binary_mode_title'                         => __('Automatic decline of payments without instant approval', 'lkn-woocommerce-mercadopago'),
            'binary_mode_subtitle'                      => __('Enable it if you want to automatically decline payments that are not instantly approved by banks or other institutions.', 'lkn-woocommerce-mercadopago'),
            'binary_mode_default'                       => __('Debit, Credit and Invoice in Mercado Pago environment.', 'lkn-woocommerce-mercadopago'),
            'binary_mode_descriptions_enabled'          => $binaryModeDescriptionsEnabled,
            'binary_mode_descriptions_disabled'         => $binaryModeDescriptionsDisabled,
            'discount_title'                            => __('Discount in Mercado Pago Checkouts', 'lkn-woocommerce-mercadopago'),
            'discount_description'                      => __('Choose a percentage value that you want to discount your customers for paying with Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'discount_checkbox_label'                   => __('Activate and show this information on Mercado Pago Checkout', 'lkn-woocommerce-mercadopago'),
            'commission_title'                          => __('Commission in Mercado Pago Checkouts', 'lkn-woocommerce-mercadopago'),
            'commission_description'                    => __('Choose an additional percentage value that you want to charge as commission to your customers for paying with Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'commission_checkbox_label'                 => __('Activate and show this information on Mercado Pago Checkout', 'lkn-woocommerce-mercadopago'),
            'invalid_back_url'                          => __('This seems to be an invalid URL', 'lkn-woocommerce-mercadopago'),
        ];
        $this->basicGatewaySettings  = array_merge($this->basicGatewaySettings, $this->setSupportLinkTranslations());
    }

    /**
     * Set credits settings translations
     *
     * @return void
     */
    private function setCreditsGatewaySettingsTranslations(): void
    {
        $enabledDescriptionsEnabled = sprintf(
            '%s <b>%s</b>.',
            __('Payment in installments without card in the store checkout is', 'lkn-woocommerce-mercadopago'),
            __('enabled', 'lkn-woocommerce-mercadopago')
        );

        $enabledDescriptionsDisabled = sprintf(
            '%s <b>%s</b>.',
            __('Payment in installments without card in the store checkout is', 'lkn-woocommerce-mercadopago'),
            __('disabled', 'lkn-woocommerce-mercadopago')
        );

        $currencyConversionDescriptionsEnabled = sprintf(
            '%s <b>%s</b>.',
            __('Currency conversion is', 'lkn-woocommerce-mercadopago'),
            __('enabled', 'lkn-woocommerce-mercadopago')
        );

        $currencyConversionDescriptionsDisabled = sprintf(
            '%s <b>%s</b>.',
            __('Currency conversion is', 'lkn-woocommerce-mercadopago'),
            __('disabled', 'lkn-woocommerce-mercadopago')
        );

        $creditsBannerDescriptionsEnabled = sprintf(
            '%s <b>%s</b>.',
            __('The installments without card component is', 'lkn-woocommerce-mercadopago'),
            __('enabled', 'lkn-woocommerce-mercadopago')
        );

        $creditsBannerDescriptionsDisabled = sprintf(
            '%s <b>%s</b>.',
            __('The installments without card component is', 'lkn-woocommerce-mercadopago'),
            __('disabled', 'lkn-woocommerce-mercadopago')
        );

        $this->creditsGatewaySettings = [
            'gateway_title'                             => __('Installments without card', 'lkn-woocommerce-mercadopago'),
            'gateway_description'                       => __('Customers who buy on spot and pay later in up to 12 installments', 'lkn-woocommerce-mercadopago'),
            'gateway_method_title'                      => __('Mercado Pago - Installments without card', 'lkn-woocommerce-mercadopago'),
            'gateway_method_description'                => __('Customers who buy on spot and pay later in up to 12 installments', 'lkn-woocommerce-mercadopago'),
            'header_title'                              => __('Installments without card', 'lkn-woocommerce-mercadopago'),
            'header_description'                        => __('Reach millions of buyers by offering Mercado Credito as a payment method. Our flexible payment options give your customers the possibility to buy today whatever they want in up to 12 installments without the need to use a credit card. For your business, the approval of the purchase is immediate and guaranteed.', 'lkn-woocommerce-mercadopago'),
            'card_settings_title'                       => __('Mercado Pago plugin general settings', 'lkn-woocommerce-mercadopago'),
            'card_settings_subtitle'                    => __('Set the deadlines and fees, test your store or access the Plugin manual.', 'lkn-woocommerce-mercadopago'),
            'card_settings_button_text'                 => __('Go to Settings', 'lkn-woocommerce-mercadopago'),
            'enabled_title'                             => __('Activate installments without card in your store checkout', 'lkn-woocommerce-mercadopago'),
            'enabled_subtitle'                          => __('Offer the option to pay in installments without card directly from your store\'s checkout.', 'lkn-woocommerce-mercadopago'),
            'enabled_descriptions_enabled'              => $enabledDescriptionsEnabled,
            'enabled_descriptions_disabled'             => $enabledDescriptionsDisabled,
            'enabled_toggle_title'                      => __('Checkout visualization', 'lkn-woocommerce-mercadopago'),
            'enabled_toggle_subtitle'                   => __('Check below how this feature will be displayed to your customers:', 'lkn-woocommerce-mercadopago'),
            'enabled_toggle_footer'                     => __('Checkout Preview', 'lkn-woocommerce-mercadopago'),
            'enabled_toggle_pill_text'                  => __('PREVIEW', 'lkn-woocommerce-mercadopago'),
            'title_title'                               => __('Title in the store Checkout', 'lkn-woocommerce-mercadopago'),
            'title_description'                         => __('It is possible to edit the title. Maximum of 85 characters.', 'lkn-woocommerce-mercadopago'),
            'title_default'                             => __('Checkout without card', 'lkn-woocommerce-mercadopago'),
            'title_desc_tip'                            => __('The text inserted here will not be translated to other languages', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_title'                 => __('Convert Currency', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_subtitle'              => __('Activate this option so that the value of the currency set in WooCommerce is compatible with the value of the currency you use in Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_descriptions_enabled'  => $currencyConversionDescriptionsEnabled,
            'currency_conversion_descriptions_disabled' => $currencyConversionDescriptionsDisabled,
            'credits_banner_title'                      => __('Inform your customers about the option of paying in installments without card', 'lkn-woocommerce-mercadopago'),
            'credits_banner_subtitle'                   => __('By activating the installments without card component, you increase your chances of selling.', 'lkn-woocommerce-mercadopago'),
            'credits_banner_descriptions_enabled'       => $creditsBannerDescriptionsEnabled,
            'credits_banner_descriptions_disabled'      => $creditsBannerDescriptionsDisabled,
            'credits_banner_desktop'                    => __('Banner on the product page | Computer version', 'lkn-woocommerce-mercadopago'),
            'credits_banner_cellphone'                  => __('Banner on the product page | Cellphone version', 'lkn-woocommerce-mercadopago'),
            'credits_banner_toggle_computer'            => __('Computer', 'lkn-woocommerce-mercadopago'),
            'credits_banner_toggle_mobile'              => __('Mobile', 'lkn-woocommerce-mercadopago'),
            'credits_banner_toggle_title'               => __('Component visualization', 'lkn-woocommerce-mercadopago'),
            'credits_banner_toggle_subtitle'            => __('Check below how this feature will be displayed to your customers:', 'lkn-woocommerce-mercadopago'),
            'advanced_configuration_title'              => __('Advanced settings', 'lkn-woocommerce-mercadopago'),
            'advanced_configuration_description'        => __('Edit these advanced fields only when you want to modify the preset values.', 'lkn-woocommerce-mercadopago'),
            'discount_title'                            => __('Discount in Mercado Pago Checkouts', 'lkn-woocommerce-mercadopago'),
            'discount_description'                      => __('Choose a percentage value that you want to discount your customers for paying with Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'discount_checkbox_label'                   => __('Activate and show this information on Mercado Pago Checkout', 'lkn-woocommerce-mercadopago'),
            'commission_title'                          => __('Commission in Mercado Pago Checkouts', 'lkn-woocommerce-mercadopago'),
            'commission_description'                    => __('Choose an additional percentage value that you want to charge as commission to your customers for paying with Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'commission_checkbox_label'                 => __('Activate and show this information on Mercado Pago Checkout', 'lkn-woocommerce-mercadopago'),
        ];
        $this->creditsGatewaySettings  = array_merge($this->creditsGatewaySettings, $this->setSupportLinkTranslations());
    }

    /**
     * Set custom settings translations
     *
     * @return void
     */
    private function setCustomGatewaySettingsTranslations(): void
    {
        $enabledDescriptionsEnabled = sprintf(
            '%s <b>%s</b>.',
            __('Transparent Checkout for credit cards is', 'lkn-woocommerce-mercadopago'),
            __('enabled', 'lkn-woocommerce-mercadopago')
        );

        $enabledDescriptionsDisabled = sprintf(
            '%s <b>%s</b>.',
            __('Transparent Checkout for credit cards is', 'lkn-woocommerce-mercadopago'),
            __('disabled', 'lkn-woocommerce-mercadopago')
        );

        $currencyConversionDescriptionsEnabled = sprintf(
            '%s <b>%s</b>.',
            __('Currency conversion is', 'lkn-woocommerce-mercadopago'),
            __('enabled', 'lkn-woocommerce-mercadopago')
        );

        $currencyConversionDescriptionsDisabled = sprintf(
            '%s <b>%s</b>.',
            __('Currency conversion is', 'lkn-woocommerce-mercadopago'),
            __('disabled', 'lkn-woocommerce-mercadopago')
        );

        $walletButtonDescriptionsEnabled = sprintf(
            '%s <b>%s</b>.',
            __('Payments via Mercado Pago accounts are', 'lkn-woocommerce-mercadopago'),
            __('enabled', 'lkn-woocommerce-mercadopago')
        );

        $walletButtonDescriptionsDisabled = sprintf(
            '%s <b>%s</b>.',
            __('Payments via Mercado Pago accounts are', 'lkn-woocommerce-mercadopago'),
            __('disabled', 'lkn-woocommerce-mercadopago')
        );

        $binaryModeDescriptionsEnabled = sprintf(
            '%s <b>%s</b>.',
            __('Pending payments', 'lkn-woocommerce-mercadopago'),
            __('will be automatically declined', 'lkn-woocommerce-mercadopago')
        );

        $binaryModeDescriptionsDisabled = sprintf(
            '%s <b>%s</b>.',
            __('Pending payments', 'lkn-woocommerce-mercadopago'),
            __('will not be automatically declined', 'lkn-woocommerce-mercadopago')
        );

        $this->customGatewaySettings = [
            'gateway_title'                             => __('Credit and debit cards', 'lkn-woocommerce-mercadopago'),
            'gateway_description'                       => __('Payments without leaving your store with our customizable checkout', 'lkn-woocommerce-mercadopago'),
            'gateway_method_title'                      => __('Mercado Pago - Checkout API', 'lkn-woocommerce-mercadopago'),
            'gateway_method_description'                => __('Payments without leaving your store with our customizable checkout', 'lkn-woocommerce-mercadopago'),
            'header_title'                              => __('Transparent Checkout | Credit card', 'lkn-woocommerce-mercadopago'),
            'header_description'                        => __('With the Transparent Checkout, you can sell inside your store environment, without redirection and with the security from Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'card_settings_title'                       => __('Mercado Pago Plugin general settings', 'lkn-woocommerce-mercadopago'),
            'card_settings_subtitle'                    => __('Set the deadlines and fees, test your store or access the Plugin manual.', 'lkn-woocommerce-mercadopago'),
            'card_settings_button_text'                 => __('Go to Settings', 'lkn-woocommerce-mercadopago'),
            'enabled_title'                             => __('Enable the checkout', 'lkn-woocommerce-mercadopago'),
            'enabled_subtitle'                          => __('By disabling it, you will disable all credit cards payments from Mercado Pago Transparent Checkout.', 'lkn-woocommerce-mercadopago'),
            'enabled_descriptions_enabled'              => $enabledDescriptionsEnabled,
            'enabled_descriptions_disabled'             => $enabledDescriptionsDisabled,
            'title_title'                               => __('Title in the store Checkout', 'lkn-woocommerce-mercadopago'),
            'title_description'                         => __('Change the display text in Checkout, maximum characters: 85', 'lkn-woocommerce-mercadopago'),
            'title_default'                             => __('Credit and debit cards', 'lkn-woocommerce-mercadopago'),
            'title_desc_tip'                            => __('The text inserted here will not be translated to other languages', 'lkn-woocommerce-mercadopago'),
            'card_info_fees_title'                      => __('Installments Fees', 'lkn-woocommerce-mercadopago'),
            'card_info_fees_subtitle'                   => __('Set installment fees and whether they will be charged from the store or from the buyer.', 'lkn-woocommerce-mercadopago'),
            'card_info_fees_button_url'                 => __('Set fees', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_title'                 => __('Convert Currency', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_subtitle'              => __('Activate this option so that the value of the currency set in WooCommerce is compatible with the value of the currency you use in Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_descriptions_enabled'  => $currencyConversionDescriptionsEnabled,
            'currency_conversion_descriptions_disabled' => $currencyConversionDescriptionsDisabled,
            'wallet_button_title'                       => __('Payments via Mercado Pago account', 'lkn-woocommerce-mercadopago'),
            'wallet_button_subtitle'                    => __('Your customers pay faster with saved cards, money balance or other available methods in their Mercado Pago accounts.', 'lkn-woocommerce-mercadopago'),
            'wallet_button_descriptions_enabled'        => $walletButtonDescriptionsEnabled,
            'wallet_button_descriptions_disabled'       => $walletButtonDescriptionsDisabled,
            'wallet_button_preview_description'         => __('Check an example of how it will appear in your store:', 'lkn-woocommerce-mercadopago'),
            'advanced_configuration_title'              => __('Advanced configuration of the personalized payment experience', 'lkn-woocommerce-mercadopago'),
            'advanced_configuration_subtitle'           => __('Edit these advanced fields only when you want to modify the preset values.', 'lkn-woocommerce-mercadopago'),
            'binary_mode_title'                         => __('Automatic decline of payments without instant approval', 'lkn-woocommerce-mercadopago'),
            'binary_mode_subtitle'                      => __('Enable it if you want to automatically decline payments that are not instantly approved by banks or other institutions.', 'lkn-woocommerce-mercadopago'),
            'binary_mode_descriptions_enabled'          => $binaryModeDescriptionsEnabled,
            'binary_mode_descriptions_disabled'         => $binaryModeDescriptionsDisabled,
            'discount_title'                            => __('Discount in Mercado Pago Checkouts', 'lkn-woocommerce-mercadopago'),
            'discount_description'                      => __('Choose a percentage value that you want to discount your customers for paying with Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'discount_checkbox_label'                   => __('Activate and show this information on Mercado Pago Checkout', 'lkn-woocommerce-mercadopago'),
            'commission_title'                          => __('Commission in Mercado Pago Checkouts', 'lkn-woocommerce-mercadopago'),
            'commission_description'                    => __('Choose an additional percentage value that you want to charge as commission to your customers for paying with Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'commission_checkbox_label'                 => __('Activate and show this information on Mercado Pago Checkout', 'lkn-woocommerce-mercadopago'),
        ];
        $this->customGatewaySettings  = array_merge($this->customGatewaySettings, $this->setSupportLinkTranslations());
    }

    /**
     * Set ticket settings translations
     *
     * @return void
     */
    private function setTicketGatewaySettingsTranslations(): void
    {
        $currencyConversionDescriptionsEnabled = sprintf(
            '%s <b>%s</b>.',
            __('Currency conversion is', 'lkn-woocommerce-mercadopago'),
            __('enabled', 'lkn-woocommerce-mercadopago')
        );

        $currencyConversionDescriptionsDisabled = sprintf(
            '%s <b>%s</b>.',
            __('Currency conversion is', 'lkn-woocommerce-mercadopago'),
            __('disabled', 'lkn-woocommerce-mercadopago')
        );

        $this->ticketGatewaySettings = [
            'gateway_title'                => __('Invoice', 'lkn-woocommerce-mercadopago'),
            'gateway_description'          => __('Payments without leaving your store with our customizable checkout', 'lkn-woocommerce-mercadopago'),
            'method_title'                 => __('Mercado Pago - Checkout API', 'lkn-woocommerce-mercadopago'),
            'header_title'                 => __('Transparent Checkout | Invoice or Loterica', 'lkn-woocommerce-mercadopago'),
            'header_description'           => __('With the Transparent Checkout, you can sell inside your store environment, without redirection and all the safety from Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'card_settings_title'          => __('Mercado Pago plugin general settings', 'lkn-woocommerce-mercadopago'),
            'card_settings_subtitle'       => __('Set the deadlines and fees, test your store or access the Plugin manual.', 'lkn-woocommerce-mercadopago'),
            'card_settings_button_text'    => __('Go to Settings', 'lkn-woocommerce-mercadopago'),
            'enabled_title'                => __('Enable the Checkout', 'lkn-woocommerce-mercadopago'),
            'enabled_subtitle'             => __('By disabling it, you will disable all invoice payments from Mercado Pago Transparent Checkout.', 'lkn-woocommerce-mercadopago'),
            'enabled_enabled'              => __('The transparent checkout for tickets is <b>enabled</b>.', 'lkn-woocommerce-mercadopago'),
            'enabled_disabled'             => __('The transparent checkout for tickets is <b>disabled</b>.', 'lkn-woocommerce-mercadopago'),
            'title_title'                  => __('Title in the store Checkout', 'lkn-woocommerce-mercadopago'),
            'title_description'            => __('Change the display text in Checkout, maximum characters: 85', 'lkn-woocommerce-mercadopago'),
            'title_default'                => __('Invoice', 'lkn-woocommerce-mercadopago'),
            'title_desc_tip'               => __('The text inserted here will not be translated to other languages', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_title'    => __('Convert Currency', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_subtitle' => __('Activate this option so that the value of the currency set in WooCommerce is compatible with the value of the currency you use in Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_enabled'  => $currencyConversionDescriptionsEnabled,
            'currency_conversion_disabled' => $currencyConversionDescriptionsDisabled,
            'date_expiration_title'        => __('Payment Due', 'lkn-woocommerce-mercadopago'),
            'date_expiration_description'  => __('In how many days will cash payments expire.', 'lkn-woocommerce-mercadopago'),
            'advanced_title_title'         => __('Advanced configuration of the cash payment experience', 'lkn-woocommerce-mercadopago'),
            'advanced_description_title'   => __('Edit these advanced fields only when you want to modify the preset values.', 'lkn-woocommerce-mercadopago'),
            'stock_reduce_title'           => __('Reduce inventory', 'lkn-woocommerce-mercadopago'),
            'stock_reduce_subtitle'        => __('Activates inventory reduction during the creation of an order, whether or not the final payment is credited. Disable this option to reduce it only when payments are approved.', 'lkn-woocommerce-mercadopago'),
            'stock_reduce_enabled'         => __('Reduce inventory is <b>enabled</b>.', 'lkn-woocommerce-mercadopago'),
            'stock_reduce_disabled'        => __('Reduce inventory is <b>disabled</b>.', 'lkn-woocommerce-mercadopago'),
            'type_payments_title'          => __('Payment methods', 'lkn-woocommerce-mercadopago'),
            'type_payments_description'    => __('Enable the available payment methods', 'lkn-woocommerce-mercadopago'),
            'type_payments_desctip'        => __('Choose the available payment methods in your store.', 'lkn-woocommerce-mercadopago'),
            'type_payments_label'          => __('All payment methods', 'lkn-woocommerce-mercadopago'),
            'discount_title'               => __('Discount in Mercado Pago Checkouts', 'lkn-woocommerce-mercadopago'),
            'discount_description'         => __('Choose a percentage value that you want to discount your customers for paying with Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'discount_checkbox_label'      => __('Activate and show this information on Mercado Pago Checkout', 'lkn-woocommerce-mercadopago'),
            'commission_title'             => __('Commission in Mercado Pago Checkouts', 'lkn-woocommerce-mercadopago'),
            'commission_description'       => __('Choose an additional percentage value that you want to charge as commission to your customers for paying with Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'commission_checkbox_label'    => __('Activate and show this information on Mercado Pago Checkout', 'lkn-woocommerce-mercadopago'),
        ];
        $this->ticketGatewaySettings  = array_merge($this->ticketGatewaySettings, $this->setSupportLinkTranslations());
    }

    /**
     * Set PSE settings translations
     *
     * @return void
     */
    private function setPseGatewaySettingsTranslations(): void
    {
        $currencyConversionDescriptionsEnabled = sprintf(
            '%s <b>%s</b>.',
            __('Currency conversion is', 'lkn-woocommerce-mercadopago'),
            __('enabled', 'lkn-woocommerce-mercadopago')
        );

        $currencyConversionDescriptionsDisabled = sprintf(
            '%s <b>%s</b>.',
            __('Currency conversion is', 'lkn-woocommerce-mercadopago'),
            __('disabled', 'lkn-woocommerce-mercadopago')
        );

        $this->pseGatewaySettings = [
            'gateway_title'                => __('PSE', 'lkn-woocommerce-mercadopago'),
            'gateway_description'          => __('Payments without leaving your store with our customizable checkout', 'lkn-woocommerce-mercadopago'),
            'method_title'                 => __('Mercado Pago - Checkout API', 'lkn-woocommerce-mercadopago'),
            'header_title'                 => __('Transparent Checkout PSE', 'lkn-woocommerce-mercadopago'),
            'header_description'           => __('With the Transparent Checkout, you can sell inside your store environment, without redirection and all the safety from Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'card_settings_title'          => __('Mercado Pago plugin general settings', 'lkn-woocommerce-mercadopago'),
            'card_settings_subtitle'       => __('Set the deadlines and fees, test your store or access the Plugin manual.', 'lkn-woocommerce-mercadopago'),
            'card_settings_button_text'    => __('Go to Settings', 'lkn-woocommerce-mercadopago'),
            'enabled_title'                => __('Enable the Checkout', 'lkn-woocommerce-mercadopago'),
            'enabled_subtitle'             => __('By deactivating it, you will disable PSE payments from Mercado Pago Transparent Checkout.', 'lkn-woocommerce-mercadopago'),
            'enabled_enabled'              => __('The transparent checkout for PSE is <b>enabled</b>.', 'lkn-woocommerce-mercadopago'),
            'enabled_disabled'             => __('The transparent checkout for PSE is <b>disabled</b>.', 'lkn-woocommerce-mercadopago'),
            'title_title'                  => __('Title in the store Checkout', 'lkn-woocommerce-mercadopago'),
            'title_description'            => __('Change the display text in Checkout, maximum characters: 85', 'lkn-woocommerce-mercadopago'),
            'title_default'                => __('PSE', 'lkn-woocommerce-mercadopago'),
            'title_desc_tip'               => __('The text inserted here will not be translated to other languages', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_title'    => __('Convert Currency', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_subtitle' => __('Activate this option so that the value of the currency set in WooCommerce is compatible with the value of the currency you use in Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_enabled'  => $currencyConversionDescriptionsEnabled,
            'currency_conversion_disabled' => $currencyConversionDescriptionsDisabled,
            'advanced_title_title'         => __('Advanced configuration of the PSE payment experience', 'lkn-woocommerce-mercadopago'),
            'advanced_description_title'   => __('Edit these advanced fields only when you want to modify the preset values.', 'lkn-woocommerce-mercadopago'),
            'stock_reduce_title'           => __('Reduce inventory', 'lkn-woocommerce-mercadopago'),
            'stock_reduce_subtitle'        => __('Activates inventory reduction during the creation of an order, whether or not the final payment is credited. Disable this option to reduce it only when payments are approved.', 'lkn-woocommerce-mercadopago'),
            'stock_reduce_enabled'         => __('Reduce inventory is <b>enabled</b>.', 'lkn-woocommerce-mercadopago'),
            'stock_reduce_disabled'        => __('Reduce inventory is <b>disabled</b>.', 'lkn-woocommerce-mercadopago'),
            'type_payments_title'          => __('Payment methods', 'lkn-woocommerce-mercadopago'),
            'type_payments_description'    => __('Enable the available payment methods', 'lkn-woocommerce-mercadopago'),
            'type_payments_desctip'        => __('Choose the available payment methods in your store.', 'lkn-woocommerce-mercadopago'),
            'type_payments_label'          => __('All payment methods', 'lkn-woocommerce-mercadopago'),
            'discount_title'               => __('Discount in Mercado Pago Checkouts', 'lkn-woocommerce-mercadopago'),
            'discount_description'         => __('Choose a percentage value that you want to discount your customers for paying with Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'discount_checkbox_label'      => __('Activate and show this information on Mercado Pago Checkout', 'lkn-woocommerce-mercadopago'),
            'commission_title'             => __('Commission in Mercado Pago Checkouts', 'lkn-woocommerce-mercadopago'),
            'commission_description'       => __('Choose an additional percentage value that you want to charge as commission to your customers for paying with Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'commission_checkbox_label'    => __('Activate and show this information on Mercado Pago Checkout', 'lkn-woocommerce-mercadopago'),
        ];
        $this->pseGatewaySettings  = array_merge($this->pseGatewaySettings, $this->setSupportLinkTranslations());
    }

    /**
     * Set pix settings translations
     *
     * @return void
     */
    private function setPixGatewaySettingsTranslations(): void
    {
        $enabledDescriptionsEnabled = sprintf(
            '%s <b>%s</b>.',
            __('The transparent checkout for Pix payment is', 'lkn-woocommerce-mercadopago'),
            __('enabled', 'lkn-woocommerce-mercadopago')
        );

        $enabledDescriptionsDisabled = sprintf(
            '%s <b>%s</b>.',
            __('The transparent checkout for Pix payment is', 'lkn-woocommerce-mercadopago'),
            __('disabled', 'lkn-woocommerce-mercadopago')
        );

        $currencyConversionDescriptionsEnabled = sprintf(
            '%s <b>%s</b>.',
            __('Currency conversion is', 'lkn-woocommerce-mercadopago'),
            __('enabled', 'lkn-woocommerce-mercadopago')
        );

        $currencyConversionDescriptionsDisabled = sprintf(
            '%s <b>%s</b>.',
            __('Currency conversion is', 'lkn-woocommerce-mercadopago'),
            __('disabled', 'lkn-woocommerce-mercadopago')
        );

        $stepsStepTwoText = sprintf(
            '%s <b>%s</b> %s <b>%s</b>.',
            __('Go to the', 'lkn-woocommerce-mercadopago'),
            __('Your Profile', 'lkn-woocommerce-mercadopago'),
            __('area and choose the', 'lkn-woocommerce-mercadopago'),
            __('Your Pix Keys section', 'lkn-woocommerce-mercadopago')
        );

        $this->pixGatewaySettings = [
            'gateway_title'                             => __('Pix', 'lkn-woocommerce-mercadopago'),
            'gateway_description'                       => __('Payments without leaving your store with our customizable checkout', 'lkn-woocommerce-mercadopago'),
            'gateway_method_title'                      => __('Mercado Pago - Checkout API', 'lkn-woocommerce-mercadopago'),
            'gateway_method_description'                => __('Payments without leaving your store with our customizable checkout', 'lkn-woocommerce-mercadopago'),
            'header_title'                              => __('Transparent Checkout | Pix', 'lkn-woocommerce-mercadopago'),
            'header_description'                        => __('With the Transparent Checkout, you can sell inside your store environment, without redirection and all the safety from Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'card_settings_title'                       => __('Mercado Pago plugin general settings', 'lkn-woocommerce-mercadopago'),
            'card_settings_subtitle'                    => __('Set the deadlines and fees, test your store or access the Plugin manual.', 'lkn-woocommerce-mercadopago'),
            'card_settings_button_text'                 => __('Go to Settings', 'lkn-woocommerce-mercadopago'),
            'enabled_title'                             => __('Enable the checkout', 'lkn-woocommerce-mercadopago'),
            'enabled_subtitle'                          => __('By disabling it, you will disable all Pix payments from Mercado Pago Transparent Checkout.', 'lkn-woocommerce-mercadopago'),
            'enabled_descriptions_enabled'              => $enabledDescriptionsEnabled,
            'enabled_descriptions_disabled'             => $enabledDescriptionsDisabled,
            'title_title'                               => __('Title in the store Checkout', 'lkn-woocommerce-mercadopago'),
            'title_description'                         => __('Change the display text in Checkout, maximum characters: 85', 'lkn-woocommerce-mercadopago'),
            'title_default'                             => __('Pix', 'lkn-woocommerce-mercadopago'),
            'title_desc_tip'                            => __('The text inserted here will not be translated to other languages', 'lkn-woocommerce-mercadopago'),
            'expiration_date_title'                     => __('Expiration for payments via Pix', 'lkn-woocommerce-mercadopago'),
            'expiration_date_description'               => __('Set the limit in minutes for your clients to pay via Pix.', 'lkn-woocommerce-mercadopago'),
            'expiration_date_options_15_minutes'        => __('15 minutes', 'lkn-woocommerce-mercadopago'),
            'expiration_date_options_30_minutes'        => __('30 minutes (recommended)', 'lkn-woocommerce-mercadopago'),
            'expiration_date_options_60_minutes'        => __('60 minutes', 'lkn-woocommerce-mercadopago'),
            'expiration_date_options_12_hours'          => __('12 hours', 'lkn-woocommerce-mercadopago'),
            'expiration_date_options_24_hours'          => __('24 hours', 'lkn-woocommerce-mercadopago'),
            'expiration_date_options_2_days'            => __('2 days', 'lkn-woocommerce-mercadopago'),
            'expiration_date_options_3_days'            => __('3 days', 'lkn-woocommerce-mercadopago'),
            'expiration_date_options_4_days'            => __('4 days', 'lkn-woocommerce-mercadopago'),
            'expiration_date_options_5_days'            => __('5 days', 'lkn-woocommerce-mercadopago'),
            'expiration_date_options_6_days'            => __('6 days', 'lkn-woocommerce-mercadopago'),
            'expiration_date_options_7_days'            => __('7 days', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_title'                 => __('Convert Currency', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_subtitle'              => __('Activate this option so that the value of the currency set in WooCommerce is compatible with the value of the currency you use in Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'currency_conversion_descriptions_enabled'  => $currencyConversionDescriptionsEnabled,
            'currency_conversion_descriptions_disabled' => $currencyConversionDescriptionsDisabled,
            'card_info_title'                           => __('Would you like to know how Pix works?', 'lkn-woocommerce-mercadopago'),
            'card_info_subtitle'                        => __('We have a dedicated page where we explain how it works and its advantages.', 'lkn-woocommerce-mercadopago'),
            'card_info_button_text'                     => __('Find out more about Pix', 'lkn-woocommerce-mercadopago'),
            'advanced_configuration_title'              => __('Advanced configuration of the Pix experience', 'lkn-woocommerce-mercadopago'),
            'advanced_configuration_subtitle'           => __('Edit these advanced fields only when you want to modify the preset values.', 'lkn-woocommerce-mercadopago'),
            'discount_title'                            => __('Discount in Mercado Pago Checkouts', 'lkn-woocommerce-mercadopago'),
            'discount_description'                      => __('Choose a percentage value that you want to discount your customers for paying with Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'discount_checkbox_label'                   => __('Activate and show this information on Mercado Pago Checkout', 'lkn-woocommerce-mercadopago'),
            'commission_title'                          => __('Commission in Mercado Pago Checkouts', 'lkn-woocommerce-mercadopago'),
            'commission_description'                    => __('Choose an additional percentage value that you want to charge as commission to your customers for paying with Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'commission_checkbox_label'                 => __('Activate and show this information on Mercado Pago Checkout', 'lkn-woocommerce-mercadopago'),
            'steps_title'                               => __('To activate Pix, you must have a key registered in Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'steps_step_one_text'                       => __('Download the Mercado Pago app on your cell phone.', 'lkn-woocommerce-mercadopago'),
            'steps_step_two_text'                       => $stepsStepTwoText,
            'steps_step_three_text'                     => __('Choose which data to register as Pix keys. After registering, you can set up Pix in your checkout.', 'lkn-woocommerce-mercadopago'),
            'steps_observation_one'                     => __('Remember that, for the time being, the Central Bank of Brazil is open Monday through Friday, from 9am to 6pm.', 'lkn-woocommerce-mercadopago'),
            'steps_observation_two'                     => __('If you requested your registration outside these hours, we will confirm it within the next business day.', 'lkn-woocommerce-mercadopago'),
            'steps_button_about_pix'                    => __('Learn more about Pix', 'lkn-woocommerce-mercadopago'),
            'steps_observation_three'                   => __('If you have already registered a Pix key at Mercado Pago and cannot activate Pix in the checkout, ', 'lkn-woocommerce-mercadopago'),
            'steps_link_title_one'                      => __('click here.', 'lkn-woocommerce-mercadopago'),
        ];
        $this->pixGatewaySettings  = array_merge($this->pixGatewaySettings, $this->setSupportLinkTranslations());
    }

    /**
     * Set test mode settings translations
     *
     * @return void
     */
    private function setTestModeSettingsTranslations(): void
    {
        $testCredentialsHelper = sprintf(
            '%s, <a class="mp-settings-blue-text" id="mp-testmode-credentials-link" target="_blank" href="%s">%s</a> %s.',
            __('To enable test mode', 'lkn-woocommerce-mercadopago'),
            $this->links['mercadopago_credentials'],
            __('copy your test credentials', 'lkn-woocommerce-mercadopago'),
            __('and paste them above in section 1 of this page', 'lkn-woocommerce-mercadopago')
        );

        $testSubtitleOne = sprintf(
            '1. %s <a class="mp-settings-blue-text" id="mp-testmode-testuser-link" target="_blank" href="%s">%s</a>, %s.',
            __('Create your', 'lkn-woocommerce-mercadopago'),
            $this->links['mercadopago_test_user'],
            __('test user', 'lkn-woocommerce-mercadopago'),
            __('(Optional. Can be used in Production Mode and Test Mode, to test payments)', 'lkn-woocommerce-mercadopago')
        );

        $testSubtitleTwo = sprintf(
            '2. <a class="mp-settings-blue-text" id="mp-testmode-cardtest-link" target="_blank" href="%s">%s</a>, %s.',
            $this->links['docs_test_cards'],
            __('Use our test cards', 'lkn-woocommerce-mercadopago'),
            __('never use real cards', 'lkn-woocommerce-mercadopago')
        );

        $testSubtitleThree = sprintf(
            '3. <a class="mp-settings-blue-text" id="mp-testmode-store-link" target="_blank" href="%s">%s</a> %s.',
            $this->links['store_visit'],
            __('Visit your store', 'lkn-woocommerce-mercadopago'),
            __('to test purchases', 'lkn-woocommerce-mercadopago')
        );

        $this->testModeSettings = [
            'title_test_mode'         => __('4. Test your store before you start to sell', 'lkn-woocommerce-mercadopago'),
            'title_mode'              => __('Choose how you want to operate your store:', 'lkn-woocommerce-mercadopago'),
            'title_test'              => __('Test Mode', 'lkn-woocommerce-mercadopago'),
            'title_prod'              => __('Sale Mode (Production)', 'lkn-woocommerce-mercadopago'),
            'title_message_prod'      => __('Mercado Pago payment methods in Production Mode', 'lkn-woocommerce-mercadopago'),
            'title_message_test'      => __('Mercado Pago payment methods in Test Mode', 'lkn-woocommerce-mercadopago'),
            'title_alert_test'        => __('Enter test credentials', 'lkn-woocommerce-mercadopago'),
            'subtitle_test_mode'      => __('Select “Test Mode” if you want to try the payment experience before you start to sell or “Sales Mode” (Production) to start now.', 'lkn-woocommerce-mercadopago'),
            'subtitle_test'           => __('Mercado Pago Checkouts disabled for real collections.', 'lkn-woocommerce-mercadopago'),
            'subtitle_test_link'      => __('Test Mode rules.', 'lkn-woocommerce-mercadopago'),
            'subtitle_prod'           => __('Mercado Pago Checkouts enabled for real collections.', 'lkn-woocommerce-mercadopago'),
            'subtitle_message_prod'   => __('The clients can make real purchases in your store.', 'lkn-woocommerce-mercadopago'),
            'subtitle_test_one'       => $testSubtitleOne,
            'subtitle_test_two'       => $testSubtitleTwo,
            'subtitle_test_three'     => $testSubtitleThree,
            'test_credentials_helper' => $testCredentialsHelper,
            'badge_mode'              => __('Store in sale mode (Production)', 'lkn-woocommerce-mercadopago'),
            'badge_test'              => __('Store under test', 'lkn-woocommerce-mercadopago'),
            'button_test_mode'        => __('Save changes', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set configuration tips translations
     *
     * @return void
     */
    private function setConfigurationTipsTranslations(): void
    {
        $this->configurationTips = [
            'valid_store_tips'         => __('Store business fields are valid', 'lkn-woocommerce-mercadopago'),
            'invalid_store_tips'       => __('Store business fields could not be validated', 'lkn-woocommerce-mercadopago'),
            'valid_payment_tips'       => __('At least one payment method is enabled', 'lkn-woocommerce-mercadopago'),
            'invalid_payment_tips'     => __('No payment method enabled', 'lkn-woocommerce-mercadopago'),
            'valid_credentials_tips'   => __('Credentials fields are valid', 'lkn-woocommerce-mercadopago'),
            'invalid_credentials_tips' => __('Credentials fields could not be validated', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set validate credentials translations
     *
     * @return void
     */
    private function setValidateCredentialsTranslations(): void
    {
        $this->validateCredentials = [
            'valid_public_key'     => __('Valid Public Key', 'lkn-woocommerce-mercadopago'),
            'invalid_public_key'   => __('Invalid Public Key', 'lkn-woocommerce-mercadopago'),
            'valid_access_token'   => __('Valid Access Token', 'lkn-woocommerce-mercadopago'),
            'invalid_access_token' => __('Invalid Access Token', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set update credentials translations
     *
     * @return void
     */
    private function setUpdateCredentialsTranslations(): void
    {
        $this->updateCredentials = [
            'credentials_updated'              => __('Credentials were updated', 'lkn-woocommerce-mercadopago'),
            'no_test_mode_title'               => __('Your store has exited Test Mode and is making real sales in Production Mode.', 'lkn-woocommerce-mercadopago'),
            'no_test_mode_subtitle'            => __('To test the store, re-enter both test credentials.', 'lkn-woocommerce-mercadopago'),
            'invalid_credentials_title'        => __('Invalid credentials', 'lkn-woocommerce-mercadopago'),
            'invalid_credentials_subtitle'     => __('See our manual to learn', 'lkn-woocommerce-mercadopago'),
            'invalid_credentials_link_message' => __('how to enter the credentials the right way.', 'lkn-woocommerce-mercadopago'),
            'for_test_mode'                    => __(' for test mode', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set update store translations
     *
     * @return void
     */
    private function setUpdateStoreTranslations(): void
    {
        $this->updateStore = [
            'valid_configuration' => __('Store information is valid', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set currency translations
     *
     * @return void
     */
    private function setCurrencyTranslations(): void
    {
        $notCompatibleCurrencyConversion = sprintf(
            '<b>%s</b> %s',
            __('Attention:', 'lkn-woocommerce-mercadopago'),
            __('The currency settings you have in WooCommerce are not compatible with the currency you use in your Mercado Pago account. Please activate the currency conversion.', 'lkn-woocommerce-mercadopago')
        );

        $baseConversionMessage = __('We are converting your currency from: ', 'lkn-woocommerce-mercadopago');
        $this->currency = [
            'not_compatible_currency_conversion' => $notCompatibleCurrencyConversion,
            'now_we_convert'     => $this->generateConversionMessage($baseConversionMessage),
        ];
    }

    /**
     * Generate conversion message
     *
     * @param string $baseMessage
     *
     * @return string
     */
    private function generateConversionMessage(string $baseMessage): string
    {
        return sprintf('%s %s %s ', $baseMessage, get_woocommerce_currency(), __("to ", 'lkn-woocommerce-mercadopago'));
    }

    /**
     * Set status sync metabox translations
     *
     * @return void
     */
    private function setStatusSyncTranslations(): void
    {
        $this->statusSync = [
            'metabox_title'                                    => __('Payment status on Mercado Pago', 'lkn-woocommerce-mercadopago'),
            'card_title'                                       => __('This is the payment status of your Mercado Pago Activities. To check the order status, please refer to Order details.', 'lkn-woocommerce-mercadopago'),
            'link_description_success'                         => __('View purchase details at Mercado Pago', 'lkn-woocommerce-mercadopago'),
            'sync_button_success'                              => __('Sync order status', 'lkn-woocommerce-mercadopago'),
            'link_description_pending'                         => __('View purchase details at Mercado Pago', 'lkn-woocommerce-mercadopago'),
            'sync_button_pending'                              => __('Sync order status', 'lkn-woocommerce-mercadopago'),
            'link_description_failure'                         => __('Consult the reasons for refusal', 'lkn-woocommerce-mercadopago'),
            'sync_button_failure'                              => __('Sync order status', 'lkn-woocommerce-mercadopago'),
            'response_success'                                 => __('Order update successfully. This page will be reloaded...', 'lkn-woocommerce-mercadopago'),
            'response_error'                                   => __('Unable to update order:', 'lkn-woocommerce-mercadopago'),
            'alert_title_accredited'                           => __('Payment made', 'lkn-woocommerce-mercadopago'),
            'description_accredited'                           => __('Payment made by the buyer and already credited in the account.', 'lkn-woocommerce-mercadopago'),
            'alert_title_settled'                              => __('Call resolved', 'lkn-woocommerce-mercadopago'),
            'description_settled'                              => __('Please contact Mercado Pago for further details.', 'lkn-woocommerce-mercadopago'),
            'alert_title_reimbursed'                           => __('Payment refunded', 'lkn-woocommerce-mercadopago'),
            'description_reimbursed'                           => __('Your refund request has been made. Please contact Mercado Pago for further details.', 'lkn-woocommerce-mercadopago'),
            'alert_title_refunded'                             => __('Payment returned', 'lkn-woocommerce-mercadopago'),
            'description_refunded'                             => __('The payment has been returned to the client.', 'lkn-woocommerce-mercadopago'),
            'alert_title_partially_refunded'                   => __('Payment returned', 'lkn-woocommerce-mercadopago'),
            'description_partially_refunded'                   => __('The payment has been partially returned to the client.', 'lkn-woocommerce-mercadopago'),
            'alert_title_by_collector'                         => __('Payment canceled', 'lkn-woocommerce-mercadopago'),
            'description_by_collector'                         => __('The payment has been successfully canceled.', 'lkn-woocommerce-mercadopago'),
            'alert_title_by_payer'                             => __('Purchase canceled', 'lkn-woocommerce-mercadopago'),
            'description_by_payer'                             => __('The payment has been canceled by the customer.', 'lkn-woocommerce-mercadopago'),
            'alert_title_pending'                              => __('Pending payment', 'lkn-woocommerce-mercadopago'),
            'description_pending'                              => __('Awaiting payment from the buyer.', 'lkn-woocommerce-mercadopago'),
            'alert_title_pending_waiting_payment'              => __('Pending payment', 'lkn-woocommerce-mercadopago'),
            'description_pending_waiting_payment'              => __('Awaiting payment from the buyer.', 'lkn-woocommerce-mercadopago'),
            'alert_title_pending_waiting_for_remedy'           => __('Pending payment', 'lkn-woocommerce-mercadopago'),
            'description_pending_waiting_for_remedy'           => __('Awaiting payment from the buyer.', 'lkn-woocommerce-mercadopago'),
            'alert_title_pending_waiting_transfer'             => __('Pending payment', 'lkn-woocommerce-mercadopago'),
            'description_pending_waiting_transfer'             => __('Awaiting payment from the buyer.', 'lkn-woocommerce-mercadopago'),
            'alert_title_pending_review_manual'                => __('Pending payment', 'lkn-woocommerce-mercadopago'),
            'description_pending_review_manual'                => __('We are veryfing the payment. We will notify you by email in up to 6 hours if everything is fine so that you can deliver the product or provide the service.', 'lkn-woocommerce-mercadopago'),
            'alert_title_waiting_bank_confirmation'            => __('Declined payment', 'lkn-woocommerce-mercadopago'),
            'description_waiting_bank_confirmation'            => __('The card-issuing bank declined the payment. Please ask your client to use another card or to get in touch with the bank.', 'lkn-woocommerce-mercadopago'),
            'alert_title_pending_capture'                      => __('Payment authorized. Awaiting capture.', 'lkn-woocommerce-mercadopago'),
            'description_pending_capture'                      => __("The payment has been authorized on the client's card. Please capture the payment.", 'lkn-woocommerce-mercadopago'),
            'alert_title_in_process'                           => __('Payment in process', 'lkn-woocommerce-mercadopago'),
            'description_in_process'                           => __('Please wait or contact Mercado Pago for further details', 'lkn-woocommerce-mercadopago'),
            'alert_title_pending_contingency'                  => __('Pending payment', 'lkn-woocommerce-mercadopago'),
            'description_pending_contingency'                  => __('The bank is reviewing the payment. As soon as we have their confirmation, we will notify you via email so that you can deliver the product or provide the service.', 'lkn-woocommerce-mercadopago'),
            'alert_title_pending_card_validation'              => __('Pending payment', 'lkn-woocommerce-mercadopago'),
            'description_pending_card_validation'              => __('Awaiting payment information validation.', 'lkn-woocommerce-mercadopago'),
            'alert_title_pending_online_validation'            => __('Pending payment', 'lkn-woocommerce-mercadopago'),
            'description_pending_online_validation'            => __('Awaiting payment information validation.', 'lkn-woocommerce-mercadopago'),
            'alert_title_pending_additional_info'              => __('Pending payment', 'lkn-woocommerce-mercadopago'),
            'description_pending_additional_info'              => __('Awaiting payment information validation.', 'lkn-woocommerce-mercadopago'),
            'alert_title_offline_process'                      => __('Pending payment', 'lkn-woocommerce-mercadopago'),
            'description_offline_process'                      => __('Please wait or contact Mercado Pago for further details', 'lkn-woocommerce-mercadopago'),
            'alert_title_pending_challenge'                    => __('Pending payment', 'lkn-woocommerce-mercadopago'),
            'description_pending_challenge'                    => __('Waiting for the buyer.', 'lkn-woocommerce-mercadopago'),
            'alert_title_pending_provider_response'            => __('Pending payment', 'lkn-woocommerce-mercadopago'),
            'description_pending_provider_response'            => __('Waiting for the card issuer.', 'lkn-woocommerce-mercadopago'),
            'alert_title_bank_rejected'                        => __('The card issuing bank declined the payment', 'lkn-woocommerce-mercadopago'),
            'description_bank_rejected'                        => __('Please recommend your customer to pay with another payment method or to contact their bank.', 'lkn-woocommerce-mercadopago'),
            'alert_title_rejected_by_bank'                     => __('The card issuing bank declined the payment', 'lkn-woocommerce-mercadopago'),
            'description_rejected_by_bank'                     => __('Please recommend your customer to pay with another payment method or to contact their bank.', 'lkn-woocommerce-mercadopago'),
            'alert_title_rejected_insufficient_data'           => __('Declined payment', 'lkn-woocommerce-mercadopago'),
            'description_rejected_insufficient_data'           => __('The card-issuing bank declined the payment. Please ask your client to use another card or to get in touch with the bank.', 'lkn-woocommerce-mercadopago'),
            'alert_title_bank_error'                           => __('The card issuing bank declined the payment', 'lkn-woocommerce-mercadopago'),
            'description_bank_error'                           => __('Please recommend your customer to pay with another payment method or to contact their bank.', 'lkn-woocommerce-mercadopago'),
            'alert_title_by_admin'                             => __('Mercado Pago did not process the payment', 'lkn-woocommerce-mercadopago'),
            'description_by_admin'                             => __('Please contact Mercado Pago for further details.', 'lkn-woocommerce-mercadopago'),
            'alert_title_expired'                              => __('Expired payment deadline', 'lkn-woocommerce-mercadopago'),
            'description_expired'                              => __('The client did not pay within the time limit.', 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_rejected_bad_filled_card_number'   => __('Your customer entered one or more incorrect card details', 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_bad_filled_card_number'   => __('Please ask them to enter to enter them again exactly as they appear on the card or on their bank app to complete the payment.', 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_rejected_bad_filled_security_code' => __('Your customer entered one or more incorrect card details', 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_bad_filled_security_code' => __('Please ask them to enter to enter them again exactly as they appear on the card or on their bank app to complete the payment.', 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_rejected_bad_filled_date'          => __('Your customer entered one or more incorrect card details', 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_bad_filled_date'          => __('Please ask them to enter to enter them again exactly as they appear on the card or on their bank app to complete the payment.', 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_rejected_high_risk'                => __('We protected you from a suspicious payment', 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_high_risk'                => __('For safety reasons, this transaction cannot be completed.', 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_rejected_fraud'                    => __('Declined payment', 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_fraud'                    => __('The buyer is suspended in our platform. Your client must contact us to check what happened.', 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_rejected_blacklist'                => __('For safety reasons, the card issuing bank declined the payment', 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_blacklist'                => __('Recommend your customer to pay with their usual payment method and device for online purchases.', 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_rejected_insufficient_amount'      => __("Your customer's credit card has no available limit", 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_insufficient_amount'      => __('Please ask them to pay with another card or to choose another payment method.', 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_insufficient_amount_cc'   => __('Please ask them to pay with another card or to choose another payment method.', 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_rejected_other_reason'             => __('The card issuing bank declined the payment', 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_other_reason'             => __('Please recommend your customer to pay with another payment method or to contact their bank.', 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_rejected_max_attempts'             => __('Your customer reached the limit of payment attempts with this card', 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_max_attempts'             => __('Please ask them to pay with another card or to choose another payment method.', 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_rejected_invalid_installments'     => __("Your customer's card  does not accept the number of installments selected", 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_invalid_installments'     => __('Please ask them to choose a different number of installments or to pay with another method.', 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_rejected_call_for_authorize'       => __('Your customer needs to authorize the payment through their bank', 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_call_for_authorize'       => __('Please ask them to call the telephone number on their card or to pay with another method.', 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_rejected_duplicated_payment'       => __('The payment was declined because your customer already paid for this purchase', 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_duplicated_payment'       => __('Check your approved payments to verify it.', 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_rejected_card_disabled'            => __("Your customer's card was is not activated yet", 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_card_disabled'            => __('Please ask them to contact their bank by calling the number on the back of their card or to pay with another method.', 'lkn-woocommerce-mercadopago'),
            'alert_title_payer_unavailable'                    => __('Declined payment', 'lkn-woocommerce-mercadopago'),
            'description_payer_unavailable'                    => __('The buyer is suspended in our platform. Your client must contact us to check what happened.', 'lkn-woocommerce-mercadopago'),
            'alert_title_rejected_high_risk'                   => __('We protected you from a suspicious payment', 'lkn-woocommerce-mercadopago'),
            'description_rejected_high_risk'                   => __('Recommend your customer to pay with their usual payment method and device for online purchases.', 'lkn-woocommerce-mercadopago'),
            'alert_title_rejected_by_regulations'              => __('Declined payment', 'lkn-woocommerce-mercadopago'),
            'description_rejected_by_regulations'              => __('This payment was declined because it did not pass Mercado Pago security controls. Please ask your client to use another card.', 'lkn-woocommerce-mercadopago'),
            'alert_title_rejected_cap_exceeded'                => __('Declined payment', 'lkn-woocommerce-mercadopago'),
            'description_rejected_cap_exceeded'                => __('The amount exceeded the card limit. Please ask your client to use another card or to get in touch with the bank.', 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_rejected_3ds_challenge'            => __('Declined payment', 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_3ds_challenge'            => __('Please ask your client to use another card or to get in touch with the card issuer.', 'lkn-woocommerce-mercadopago'),
            'alert_title_rejected_other_reason'                => __('The card issuing bank declined the payment', 'lkn-woocommerce-mercadopago'),
            'description_rejected_other_reason'                => __('Please recommend your customer to pay with another payment method or to contact their bank.', 'lkn-woocommerce-mercadopago'),
            'alert_title_authorization_revoked'                => __('Declined payment', 'lkn-woocommerce-mercadopago'),
            'description_authorization_revoked'                => __('Please ask your client to use another card or to get in touch with the card issuer.', 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_amount_rate_limit_exceeded'        => __('Pending payment', 'lkn-woocommerce-mercadopago'),
            'description_cc_amount_rate_limit_exceeded'        => __("The amount exceeded the card's limit. Please ask your client to use another card or to get in touch with the bank.", 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_rejected_expired_operation'        => __('Expired payment deadline', 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_expired_operation'        => __('The client did not pay within the time limit.', 'lkn-woocommerce-mercadopago'),
            'alert_title_cc_rejected_bad_filled_other'         => __('Your customer entered one or more incorrect card details', 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_bad_filled_other'         => __('Please ask them to enter to enter them again exactly as they appear on the card or on their bank app to complete the payment.', 'lkn-woocommerce-mercadopago'),
            'description_cc_rejected_bad_filled_other_cc'      => __('Please ask them to enter to enter them again exactly as they appear on the card or on their bank app to complete the payment.', 'lkn-woocommerce-mercadopago'),
            'alert_title_rejected_call_for_authorize'          => __('Your customer needs to authorize the payment through their bank', 'lkn-woocommerce-mercadopago'),
            'description_rejected_call_for_authorize'          => __('Please ask them to call the telephone number on their card or to pay with another method.', 'lkn-woocommerce-mercadopago'),
            'alert_title_am_insufficient_amount'               => __("Your customer's debit card has insufficient funds", 'lkn-woocommerce-mercadopago'),
            'description_am_insufficient_amount'               => __('Please recommend your customer to pay with another card or to choose another payment method.', 'lkn-woocommerce-mercadopago'),
            'alert_title_generic'                              => __('Something went wrong and the payment was declined', 'lkn-woocommerce-mercadopago'),
            'description_generic'                              => __('Please recommend you customer to try again or to pay with another payment method.', 'lkn-woocommerce-mercadopago'),
        ];
    }


     /**
     * Set support link translations
     *
     * @return array with new translations
     */
    private function setSupportLinkTranslations(): array
    {
        return [
        'support_link_bold_text'                    => __('Any questions?', 'lkn-woocommerce-mercadopago'),
            'support_link_text_before_link'         => __('Please check the', 'lkn-woocommerce-mercadopago'),
            'support_link_text_with_link'           => __('FAQs', 'lkn-woocommerce-mercadopago'),
            'support_link_text_after_link'          => __('on the dev website.', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set support settings translations
     *
     * @return void
     */
    private function setSupportSettingsTranslations(): void
    {
        $faqsUrl = sprintf(
            '%s <a id="mp-settings-support-faq-url" class="mp-settings-blue-text" target="_blank" href="%s">%s</a> %s',
            __('Check our', 'lkn-woocommerce-mercadopago'),
            $this->links['docs_support_faq'],
            __('FAQs', 'lkn-woocommerce-mercadopago'),
            __('or open a ticket to contact the Mercado Pago team.', 'lkn-woocommerce-mercadopago')
        );

        $stepOne = sprintf(
            '%s <a id="mp-settings-support-ticket-link" class="mp-settings-blue-text" target="_blank" href="%s">%s</a> %s',
            __('1. Go to the dev website and open a', 'lkn-woocommerce-mercadopago'),
            $this->links['mercadopago_support'],
            __('ticket', 'lkn-woocommerce-mercadopago'),
            __('in the Support section.', 'lkn-woocommerce-mercadopago')
        );

        $stepFour = sprintf(
            '%s <span id="support-modal-trigger" class="mp-settings-blue-text" onclick="openSupportModal()">%s</span> %s',
            __('4. Download the', 'lkn-woocommerce-mercadopago'),
            __('error history', 'lkn-woocommerce-mercadopago'),
            __('and share it with the Mercado Pago team when asked for it.', 'lkn-woocommerce-mercadopago')
        );

        $this->supportSettings = [
            'support_title'           => __('Do you need help?', 'lkn-woocommerce-mercadopago'),
            'support_how_to'          => __('How to open a ticket:', 'lkn-woocommerce-mercadopago'),
            'support_step_one'        => $stepOne,
            'support_step_two'        => __('2. Fill out the form with your store details.', 'lkn-woocommerce-mercadopago'),
            'support_step_three'      => __('3. Copy and paste the following details when asked for the the technical information:', 'lkn-woocommerce-mercadopago'),
            'support_step_four'       =>  $stepFour,
            'support_faqs_url'        => $faqsUrl,
            'support_version'         => __('Version:', 'lkn-woocommerce-mercadopago'),
            'support_modal_title'     =>  __('History of errors', 'lkn-woocommerce-mercadopago'),
            'support_modal_desc'      => __('Select the files you want to share with our team and click on Download. This information will be requested by e-mail if necessary.', 'lkn-woocommerce-mercadopago'),

            'support_modal_table_header_1'     =>  __('Select', 'lkn-woocommerce-mercadopago'),
            'support_modal_table_header_2'     =>  __('Source', 'lkn-woocommerce-mercadopago'),
            'support_modal_table_header_3'     =>  __('File date', 'lkn-woocommerce-mercadopago'),
            'support_modal_download_btn'       =>  __('Download', 'lkn-woocommerce-mercadopago'),
            'support_modal_next_page'          =>  __('Next Page', 'lkn-woocommerce-mercadopago'),
            'support_modal_prev_page'          =>  __('Previous page', 'lkn-woocommerce-mercadopago'),
            'support_modal_no_content'         =>  __('The plugin has not yet recorded any logs in your store.', 'lkn-woocommerce-mercadopago'),
        ];
    }
}

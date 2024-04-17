<?php

namespace MercadoPago\Woocommerce\Translations;

use MercadoPago\Woocommerce\Helpers\Links;

if (!defined('ABSPATH')) {
    exit;
}

class StoreTranslations
{
    /**
     * @var array
     */
    public $commonCheckout = [];

    /**
     * @var array
     */
    public $basicCheckout = [];

    /**
     * @var array
     */
    public $creditsCheckout = [];

    /**
     * @var array
     */
    public $customCheckout = [];

    /**
     * @var array
     */
    public $pixCheckout = [];

    /**
     * @var array
     */
    public $ticketCheckout = [];

    /**
     * @var array
     */
    public $pseCheckout = [];

    /**
     * @var array
     */
    public $orderStatus = [];

    /**
     * @var array
     */
    public $commonMessages = [];

    /**
     * @var array
     */
    public $buyerRefusedMessages = [];

    /**
     * @var array
     */
    public $threeDsTranslations;

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

        $this->setCommonCheckoutTranslations();
        $this->setBasicCheckoutTranslations();
        $this->setCreditsCheckoutTranslations();
        $this->setCustomCheckoutTranslations();
        $this->setTicketCheckoutTranslations();
        $this->setPixCheckoutTranslations();
        $this->setPseCheckoutTranslations();
        $this->setOrderStatusTranslations();
        $this->setCommonMessagesTranslations();
        $this->setbuyerRefusedMessagesTranslations();
        $this->set3dsTranslations();
    }

    /**
     * Set common checkout translations
     *
     * @return void
     */
    private function setCommonCheckoutTranslations(): void
    {
        $this->commonCheckout = [
            'discount_title'     => __('discount of', 'lkn-woocommerce-mercadopago'),
            'fee_title'          => __('fee of', 'lkn-woocommerce-mercadopago'),
            'text_concatenation' => __('and', 'lkn-woocommerce-mercadopago'),
            'shipping_title'     => __('Shipping service used by the store.', 'lkn-woocommerce-mercadopago'),
            'store_discount'     => __('Discount provided by store', 'lkn-woocommerce-mercadopago'),
            'cart_discount'      => __('Mercado Pago Discount', 'lkn-woocommerce-mercadopago'),
            'cart_commission'    => __('Mercado Pago Commission', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set basic checkout translations
     *
     * @return void
     */
    private function setBasicCheckoutTranslations(): void
    {
        $this->basicCheckout = [
            'test_mode_title'                                 => __('Checkout Pro in Test Mode', 'lkn-woocommerce-mercadopago'),
            'test_mode_description'                           => __('Use Mercado Pago\'s payment methods without real charges. ', 'lkn-woocommerce-mercadopago'),
            'test_mode_link_text'                             => __('See the rules for the test mode.', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_title'                         => __('Log in to Mercado Pago and earn benefits', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_title_phone'                   => __('Easy login', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_subtitle_phone'                => __('Log in with the same email and password you use in Mercado Libre.', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_alt_phone'                     => __('Blue phone image', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_title_wallet'                  => __('Quick payments', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_subtitle_wallet'               => __('Use your saved cards, Pix or available balance.', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_subtitle_wallet_2'             => __('Use your available Mercado Pago Wallet balance or saved cards.', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_subtitle_wallet_3'             => __('Use your available money or saved cards.', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_alt_wallet'                    => __('Blue wallet image', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_title_protection'              => __('Protected purchases', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_title_protection_2'            => __('Reliable purchases', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_subtitle_protection'           => __('Get your money back in case you don\'t receive your product.', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_subtitle_protection_2'         => __('Get help if you have a problem with your purchase.', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_alt_protection'                => __('Blue protection image', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_title_phone_installments'      => __('Installments option', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_subtitle_phone_installments'   => __('Pay with or without a credit card.', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_subtitle_phone_installments_2' => __('Interest-free installments with selected banks.', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_alt_phone_installments'        => __('Blue phone installments image', 'lkn-woocommerce-mercadopago'),
            'payment_methods_title'                           => __('Available payment methods', 'lkn-woocommerce-mercadopago'),
            'checkout_redirect_text'                          => __('By continuing, you will be taken to Mercado Pago to safely complete your purchase.', 'lkn-woocommerce-mercadopago'),
            'checkout_redirect_alt'                           => __('Checkout Pro redirect info image', 'lkn-woocommerce-mercadopago'),
            'terms_and_conditions_description'                => __('By continuing, you agree with our', 'lkn-woocommerce-mercadopago'),
            'terms_and_conditions_link_text'                  => __('Terms and conditions', 'lkn-woocommerce-mercadopago'),
            'pay_with_mp_title'                               => __('Pay with Mercado Pago', 'lkn-woocommerce-mercadopago'),
            'cancel_url_text'                                 => __('Cancel &amp; Clear Cart', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set credits checkout translations
     *
     * @return void
     */
    private function setCreditsCheckoutTranslations(): void
    {
        $checkoutBenefits1 = sprintf(
            '<b>%s</b> %s.',
            __('Log in', 'lkn-woocommerce-mercadopago'),
            __('or create an account in Mercado Pago. If you use Mercado Libre, you already have one!', 'lkn-woocommerce-mercadopago')
        );

        $checkoutBenefits2 = sprintf(
            '%s <b>%s</b> %s.',
            __('Know your available limit in Mercado Crédito and', 'lkn-woocommerce-mercadopago'),
            __('choose how many installments', 'lkn-woocommerce-mercadopago'),
            __('you want to pay', 'lkn-woocommerce-mercadopago')
        );

        $checkoutBenefits3 = sprintf(
            '%s <b>%s</b>.',
            __('Pay the installments as you prefer:', 'lkn-woocommerce-mercadopago'),
            __('with money in your account, card of from the Mercado Pago app', 'lkn-woocommerce-mercadopago')
        );

        $this->creditsCheckout = [
            'test_mode_title'                  => __('No card installments in Test Mode', 'lkn-woocommerce-mercadopago'),
            'test_mode_description'            => __('Use Mercado Pago\'s payment methods without real charges. ', 'lkn-woocommerce-mercadopago'),
            'test_mode_link_text'              => __('See the rules for the test mode.', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_title'          => __('How to use it?', 'lkn-woocommerce-mercadopago'),
            'checkout_benefits_1'              => $checkoutBenefits1,
            'checkout_benefits_2'              => $checkoutBenefits2,
            'checkout_benefits_3'              => $checkoutBenefits3,
            'checkout_redirect_text'           => __('By continuing, you will be taken to Mercado Pago to safely complete your purchase.', 'lkn-woocommerce-mercadopago'),
            'checkout_redirect_alt'            => __('Checkout Pro redirect info image', 'lkn-woocommerce-mercadopago'),
            'terms_and_conditions_description' => __('By continuing, you agree with our', 'lkn-woocommerce-mercadopago'),
            'terms_and_conditions_link_text'   => __('Terms and conditions', 'lkn-woocommerce-mercadopago'),
            'banner_title'                     => __('Pay in', 'lkn-woocommerce-mercadopago'),
            'banner_title_bold'                => __('installments', 'lkn-woocommerce-mercadopago'),
            'banner_title_end'                 => __('with Mercado Pago', 'lkn-woocommerce-mercadopago'),
            'banner_link'                      => __('Read more', 'lkn-woocommerce-mercadopago'),
            'modal_title'                      => __('Buy now and pay in installments with no card later!', 'lkn-woocommerce-mercadopago'),
            'modal_subtitle'                   => __('100% online, without paperwork or monthly fees', 'lkn-woocommerce-mercadopago'),
            'modal_step_1'                     => __('You can apply for your line of credit 100% online and securely.', 'lkn-woocommerce-mercadopago'),
            'modal_step_2'                     => __('Do everything from the Mercado Pago app!', 'lkn-woocommerce-mercadopago'),
            'modal_step_3'                     => __('No maintenance fees or additional costs.', 'lkn-woocommerce-mercadopago'),
            'modal_footer'                     => __('Questions? ', 'lkn-woocommerce-mercadopago'),
            'modal_footer_link'                => __('Check our FAQ', 'lkn-woocommerce-mercadopago'),
            'modal_footer_end'                 => __('. Credit subject to approval.', 'lkn-woocommerce-mercadopago')
        ];
    }

    /**
     * Set credits checkout translations
     *
     * @return void
     */
    private function setCustomCheckoutTranslations(): void
    {
        $this->customCheckout = [
            'test_mode_title'                                     => __('Checkout Custom in Test Mode', 'lkn-woocommerce-mercadopago'),
            'test_mode_description'                               => __('Use Mercado Pago\'s payment methods without real charges. ', 'lkn-woocommerce-mercadopago'),
            'test_mode_link_text'                                 => __('See the rules for the test mode.', 'lkn-woocommerce-mercadopago'),
            'wallet_button_title'                                 => __('Pay with saved cards', 'lkn-woocommerce-mercadopago'),
            'wallet_button_description'                           => __('Do you have a Mercado Libre account? Then use the same email and password to pay faster with Mercado Pago.', 'lkn-woocommerce-mercadopago'),
            'wallet_button_button_text'                           => __('Pay with Mercado Pago', 'lkn-woocommerce-mercadopago'),
            'available_payments_title'                            => __('With which card can you pay?', 'lkn-woocommerce-mercadopago'),
            'available_payments_image'                            => __('See current promotions', 'lkn-woocommerce-mercadopago'),
            'available_payments_credit_card_title'                => __('Credit cards', 'lkn-woocommerce-mercadopago'),
            'available_payments_credit_card_label'                => __('Up to 12 installments', 'lkn-woocommerce-mercadopago'),
            'available_payments_debit_card_title'                 => __('Debit cards', 'lkn-woocommerce-mercadopago'),
            'payment_methods_promotion_text'                      => __('See current promotions', 'lkn-woocommerce-mercadopago'),
            'card_form_title'                                     => __('Fill in your card details', 'lkn-woocommerce-mercadopago'),
            'card_number_input_label'                             => __('Card number', 'lkn-woocommerce-mercadopago'),
            'card_number_input_helper'                            => __('Required data', 'lkn-woocommerce-mercadopago'),
            'card_holder_name_input_label'                        => __('Holder name as it appears on the card', 'lkn-woocommerce-mercadopago'),
            'card_holder_name_input_helper'                       => __('Required data', 'lkn-woocommerce-mercadopago'),
            'card_expiration_input_label'                         => __('Expiration', 'lkn-woocommerce-mercadopago'),
            'card_expiration_input_helper'                        => __('Required data', 'lkn-woocommerce-mercadopago'),
            'card_security_code_input_label'                      => __('Security Code', 'lkn-woocommerce-mercadopago'),
            'card_security_code_input_helper'                     => __('Required data', 'lkn-woocommerce-mercadopago'),
            'card_document_input_label'                           => __('Holder document', 'lkn-woocommerce-mercadopago'),
            'card_document_input_helper'                          => __('Invalid document', 'lkn-woocommerce-mercadopago'),
            'card_installments_title'                             => __('Select the number of installments', 'lkn-woocommerce-mercadopago'),
            'card_issuer_input_label'                             => __('Issuer', 'lkn-woocommerce-mercadopago'),
            'card_installments_input_helper'                      => __('Select the number of installments', 'lkn-woocommerce-mercadopago'),
            'terms_and_conditions_description'                    => __('By continuing, you agree with our', 'lkn-woocommerce-mercadopago'),
            'terms_and_conditions_link_text'                      => __('Terms and conditions', 'lkn-woocommerce-mercadopago'),
            'placeholders_card_expiration_date'                   => __('mm/yy', 'lkn-woocommerce-mercadopago'),
            'placeholders_issuer'                                 => __('Issuer', 'lkn-woocommerce-mercadopago'),
            'placeholders_installments'                           => __('Installments', 'lkn-woocommerce-mercadopago'),
            'cvv_hint_back'                                       => __('on the back', 'lkn-woocommerce-mercadopago'),
            'cvv_hint_front'                                      => __('on the front', 'lkn-woocommerce-mercadopago'),
            'cvv_text'                                            => __('digits', 'lkn-woocommerce-mercadopago'),
            'installment_obs_fee'                                 => __('No fee', 'lkn-woocommerce-mercadopago'),
            'installment_button'                                  => __('More options', 'lkn-woocommerce-mercadopago'),
            'bank_interest_text'                                  => __('If interest is applicable, it will be charged by your bank.', 'lkn-woocommerce-mercadopago'),
            'interest_text'                                       => __('Interest', 'lkn-woocommerce-mercadopago'),
            'input_helper_message_invalid_type'                   => __('Card number is required', 'lkn-woocommerce-mercadopago'),
            'input_helper_message_invalid_length'                 => __('Card number invalid', 'lkn-woocommerce-mercadopago'),
            'input_helper_message_card_holder_name_221'           => __('Holder name is required', 'lkn-woocommerce-mercadopago'),
            'input_helper_message_card_holder_name_316'           => __('Holder name invalid', 'lkn-woocommerce-mercadopago'),
            'input_helper_message_expiration_date_invalid_type'   => __('Expiration date invalid', 'lkn-woocommerce-mercadopago'),
            'input_helper_message_expiration_date_invalid_length' => __('Expiration date incomplete', 'lkn-woocommerce-mercadopago'),
            'input_helper_message_expiration_date_invalid_value'  => __('Expiration date invalid', 'lkn-woocommerce-mercadopago'),
            'input_helper_message_security_code_invalid_type'     => __('Security code is required', 'lkn-woocommerce-mercadopago'),
            'input_helper_message_security_code_invalid_length'   => __('Security code incomplete', 'lkn-woocommerce-mercadopago'),
            'title_installment_cost'                              => __('Cost of installments', 'lkn-woocommerce-mercadopago'),
            'title_installment_total'                             => __('Total with installments', 'lkn-woocommerce-mercadopago'),
            'text_installments'                                   => __('installments of', 'lkn-woocommerce-mercadopago'),
            'wallet_button_order_receipt_title'                   => __('Pay with Mercado Pago', 'lkn-woocommerce-mercadopago'),
            'cancel_url_text'                                     => __('Cancel &amp; Clear Cart', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set pix checkout translations
     *
     * @return void
     */
    private function setPixCheckoutTranslations(): void
    {
        $this->pixCheckout = [
            'test_mode_title'                  => __('Pix in Test Mode', 'lkn-woocommerce-mercadopago'),
            'test_mode_description'            => __('You can test the flow to generate a code, but you cannot finalize the payment.', 'lkn-woocommerce-mercadopago'),
            'pix_template_title'               => __('Pay instantly', 'lkn-woocommerce-mercadopago'),
            'pix_template_subtitle'            => __('By confirming your purchase, we will show you a code to make the payment.', 'lkn-woocommerce-mercadopago'),
            'pix_template_alt'                 => __('Pix logo', 'lkn-woocommerce-mercadopago'),
            'terms_and_conditions_description' => __('By continuing, you agree with our', 'lkn-woocommerce-mercadopago'),
            'terms_and_conditions_link_text'   => __('Terms and conditions', 'lkn-woocommerce-mercadopago'),
            'expiration_date_text'             => __('Code valid for ', 'lkn-woocommerce-mercadopago'),
            'title_purchase_pix'               => __('Now you just need to pay with Pix to finalize your purchase', 'lkn-woocommerce-mercadopago'),
            'title_how_to_pay'                 => __('How to pay with Pix:', 'lkn-woocommerce-mercadopago'),
            'step_one'                         => __('Go to your bank\'s app or website', 'lkn-woocommerce-mercadopago'),
            'step_two'                         => __('Search for the option to pay with Pix', 'lkn-woocommerce-mercadopago'),
            'step_three'                       => __('Scan the QR code or Pix code', 'lkn-woocommerce-mercadopago'),
            'step_four'                        => __('Done! You will see the payment confirmation', 'lkn-woocommerce-mercadopago'),
            'text_amount'                      => __('Value: ', 'lkn-woocommerce-mercadopago'),
            'text_scan_qr'                     => __('Scan the QR code:', 'lkn-woocommerce-mercadopago'),
            'text_time_qr_one'                 => __('Code valid for ', 'lkn-woocommerce-mercadopago'),
            'text_description_qr'              => __('If you prefer, you can pay by copying and pasting the following code', 'lkn-woocommerce-mercadopago'),
            'text_button'                      => __('Copy code', 'lkn-woocommerce-mercadopago'),
            'customer_not_paid'                => __('Mercado Pago: The customer has not paid yet.', 'lkn-woocommerce-mercadopago'),
            'congrats_title'                   => __('Mercado Pago: Now you just need to pay with Pix to finalize your purchase.', 'lkn-woocommerce-mercadopago'),
            'congrats_subtitle'                => __('Scan the QR code below or copy and paste the code into your bank\'s application.', 'lkn-woocommerce-mercadopago'),
            'expiration_30_minutes'            => __('30 minutes', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set pix checkout translations
     *
     * @return void
     */
    private function setOrderStatusTranslations(): void
    {
        $this->orderStatus = [
            'payment_approved' => __('Payment approved.', 'lkn-woocommerce-mercadopago'),
            'pending_pix'      => __('Waiting for the Pix payment.', 'lkn-woocommerce-mercadopago'),
            'pending_ticket'   => __('Waiting for the ticket payment.', 'lkn-woocommerce-mercadopago'),
            'pending'          => __('The customer has not made the payment yet.', 'lkn-woocommerce-mercadopago'),
            'in_process'       => __('Payment is pending review.', 'lkn-woocommerce-mercadopago'),
            'rejected'         => __('Payment was declined. The customer can try again.', 'lkn-woocommerce-mercadopago'),
            'refunded'         => __('Payment was returned to the customer.', 'lkn-woocommerce-mercadopago'),
            'partial_refunded' => __('The payment was partially returned to the customer. the amount refunded was : ', 'lkn-woocommerce-mercadopago'),
            'cancelled'        => __('Payment was canceled.', 'lkn-woocommerce-mercadopago'),
            'in_mediation'     => __('The payment is in mediation or the purchase was unknown by the customer.', 'lkn-woocommerce-mercadopago'),
            'charged_back'     => __('The payment is in mediation or the purchase was unknown by the customer.', 'lkn-woocommerce-mercadopago'),
            'validate_order_1' => __('The payment', 'lkn-woocommerce-mercadopago'),
            'validate_order_2' => __('was notified by Mercado Pago with status', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set checkout ticket translations
     *
     * @return void
     */
    private function setTicketCheckoutTranslations(): void
    {
        $this->ticketCheckout = [
            'test_mode_title'                  => __('Offline Methods in Test Mode', 'lkn-woocommerce-mercadopago'),
            'test_mode_description'            => __('You can test the flow to generate an invoice, but you cannot finalize the payment.', 'lkn-woocommerce-mercadopago'),
            'test_mode_link_text'              => __('See the rules for the test mode.', 'lkn-woocommerce-mercadopago'),
            'input_document_label'             => __('Holder document', 'lkn-woocommerce-mercadopago'),
            'input_document_helper'            => __('Invalid document', 'lkn-woocommerce-mercadopago'),
            'ticket_text_label'                => __('Select where you want to pay', 'lkn-woocommerce-mercadopago'),
            'input_table_button'               => __('more options', 'lkn-woocommerce-mercadopago'),
            'input_helper_label'               => __('Select a payment method', 'lkn-woocommerce-mercadopago'),
            'terms_and_conditions_description' => __('By continuing, you agree with our', 'lkn-woocommerce-mercadopago'),
            'terms_and_conditions_link_text'   => __('Terms and conditions', 'lkn-woocommerce-mercadopago'),
            'print_ticket_label'               => __('Great, we processed your purchase order. Complete the payment with ticket so that we finish approving it.', 'lkn-woocommerce-mercadopago'),
            'print_ticket_link'                => __('Print ticket', 'lkn-woocommerce-mercadopago'),
            'paycash_concatenator'             => __(' and ', 'lkn-woocommerce-mercadopago'),
            'congrats_title'                   => __('To print the ticket again click', 'lkn-woocommerce-mercadopago'),
            'congrats_subtitle'                => __('here', 'lkn-woocommerce-mercadopago'),
            'customer_not_paid'                => __('Mercado Pago: The customer has not paid yet.', 'lkn-woocommerce-mercadopago'),
        ];
    }


    /**
     * Set checkout pse translations
     *
     * @return void
     */
    private function setPseCheckoutTranslations(): void
    {
        $this->pseCheckout = [
            'test_mode_title'                  => __('Checkout PSE in Test Mode', 'lkn-woocommerce-mercadopago'),
            'test_mode_description'            => __('You can test the flow to generate a payment with PSE', 'lkn-woocommerce-mercadopago'),
            'test_mode_link_text'              => __('See the rules for the test mode.', 'lkn-woocommerce-mercadopago'),
            'input_document_label'             => __('Holder document', 'lkn-woocommerce-mercadopago'),
            'input_document_helper'            => __('Invalid document', 'lkn-woocommerce-mercadopago'),
            'pse_text_label'                   => __('Select where you want to pay', 'lkn-woocommerce-mercadopago'),
            'input_table_button'               => __('more options', 'lkn-woocommerce-mercadopago'),
            'person_type_label'                => __('Person type ', 'lkn-woocommerce-mercadopago'),
            'financial_institutions_label'     => __('Financial institution', 'lkn-woocommerce-mercadopago'),
            'financial_institutions_helper'    => __('Select the financial institution', 'lkn-woocommerce-mercadopago'),
            'financial_placeholder'            => __('Select the institution', 'lkn-woocommerce-mercadopago'),
            'customer_not_paid'                => __('Mercado Pago: The customer has not paid yet.', 'lkn-woocommerce-mercadopago'),
            'terms_and_conditions_description' => __('By continuing, you agree with our', 'lkn-woocommerce-mercadopago'),
            'terms_and_conditions_link_text'   => __('Terms and conditions', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set common messages translations
     *
     * @return void
     */
    private function setCommonMessagesTranslations(): void
    {
        $this->commonMessages = [
            'cho_default_error'                        => __('A problem was occurred when processing your payment. Please, try again.', 'lkn-woocommerce-mercadopago'),
            'cho_form_error'                           => __('A problem was occurred when processing your payment. Are you sure you have correctly filled all information in the checkout form?', 'lkn-woocommerce-mercadopago'),
            'cho_see_order_form'                       => __('See your order form', 'lkn-woocommerce-mercadopago'),
            'cho_payment_declined'                     => __('Your payment was declined. You can try again.', 'lkn-woocommerce-mercadopago'),
            'cho_button_try_again'                     => __('Click to try again', 'lkn-woocommerce-mercadopago'),
            'cho_accredited'                           => __('That\'s it, payment accepted!', 'lkn-woocommerce-mercadopago'),
            'cho_pending_contingency'                  => __('We are processing your payment. In less than an hour we will send you the result by email.', 'lkn-woocommerce-mercadopago'),
            'cho_pending_review_manual'                => __('We are processing your payment. In less than 2 days we will send you by email if the payment has been approved or if additional information is needed.', 'lkn-woocommerce-mercadopago'),
            'cho_cc_rejected_bad_filled_card_number'   => __('Check the card number.', 'lkn-woocommerce-mercadopago'),
            'cho_cc_rejected_bad_filled_date'          => __('Check the expiration date.', 'lkn-woocommerce-mercadopago'),
            'cho_cc_rejected_bad_filled_other'         => __('Check the information provided.', 'lkn-woocommerce-mercadopago'),
            'cho_cc_rejected_bad_filled_security_code' => __('Check the informed security code.', 'lkn-woocommerce-mercadopago'),
            'cho_cc_rejected_card_error'               => __('Your payment cannot be processed.', 'lkn-woocommerce-mercadopago'),
            'cho_cc_rejected_blacklist'                => __('Your payment cannot be processed.', 'lkn-woocommerce-mercadopago'),
            'cho_cc_rejected_call_for_authorize'       => __('You must authorize payments for your orders.', 'lkn-woocommerce-mercadopago'),
            'cho_cc_rejected_card_disabled'            => __('Contact your card issuer to activate it. The phone is on the back of your card.', 'lkn-woocommerce-mercadopago'),
            'cho_cc_rejected_duplicated_payment'       => __('You have already made a payment of this amount. If you have to pay again, use another card or other method of payment.', 'lkn-woocommerce-mercadopago'),
            'cho_cc_rejected_high_risk'                => __('Your payment was declined. Please select another payment method. It is recommended in cash.', 'lkn-woocommerce-mercadopago'),
            'cho_cc_rejected_insufficient_amount'      => __('Your payment does not have sufficient funds.', 'lkn-woocommerce-mercadopago'),
            'cho_cc_rejected_invalid_installments'     => __('Payment cannot process the selected fee.', 'lkn-woocommerce-mercadopago'),
            'cho_cc_rejected_max_attempts'             => __('You have reached the limit of allowed attempts. Choose another card or other payment method.', 'lkn-woocommerce-mercadopago'),
            'invalid_users'                            => __('<strong>Invalid transaction attempt</strong><br>You are trying to perform a productive transaction using test credentials, or test transaction using productive credentials. Please ensure that you are using the correct environment settings for the desired action.', 'lkn-woocommerce-mercadopago'),
            'invalid_operators'                        => __('<strong>Invalid transaction attempt</strong><br>It is not possible to pay with the email address entered. Please enter another e-mail address.', 'lkn-woocommerce-mercadopago'),
            'cho_default'                              => __('This payment method cannot process your payment.', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set rejected payment messages translations for buyer
     *
     * @return void
     */
    private function setbuyerRefusedMessagesTranslations(): void
    {
        $this->buyerRefusedMessages = [
            'buyer_cc_rejected_call_for_authorize'          => __('<strong>Your bank needs you to authorize the payment</strong><br>Please call the telephone number on your card or pay with another method.', 'lkn-woocommerce-mercadopago'),
            'buyer_cc_rejected_high_risk'                   => __('<strong>For safety reasons, your payment was declined</strong><br>We recommended paying with your usual payment method and device for online purchases.', 'lkn-woocommerce-mercadopago'),
            'buyer_rejected_high_risk'                      => __('<strong>For safety reasons, your payment was declined</strong><br>We recommended paying with your usual payment method and device for online purchases.', 'lkn-woocommerce-mercadopago'),
            'buyer_cc_rejected_bad_filled_other'            => __('<strong>One or more card details were entered incorrecctly</strong><br>Please enter them again as they appear on the card to complete the payment.', 'lkn-woocommerce-mercadopago'),
            'buyer_cc_rejected_bad_filled_security_code'    => __('<strong>One or more card details were entered incorrecctly</strong><br>Please enter them again as they appear on the card to complete the payment.', 'lkn-woocommerce-mercadopago'),
            'buyer_cc_rejected_bad_filled_date'             => __('<strong>One or more card details were entered incorrecctly</strong><br>Please enter them again as they appear on the card to complete the payment.', 'lkn-woocommerce-mercadopago'),
            'buyer_cc_rejected_bad_filled_card_number'      => __('<strong>One or more card details were entered incorrecctly</strong><br>Please enter them again as they appear on the card to complete the payment.', 'lkn-woocommerce-mercadopago'),
            'buyer_cc_rejected_insufficient_amount'         => __('<strong>Your credit card has no available limit</strong><br>Please pay using another card or choose another payment method.', 'lkn-woocommerce-mercadopago'),
            'buyer_insufficient_amount'                     => __('<strong>Your debit card has insufficient founds</strong><br>Please pay using another card or choose another payment method.', 'lkn-woocommerce-mercadopago'),
            'buyer_cc_rejected_invalid_installments'        => __('<strong>Your card does not accept the number of installments selected</strong><br>Please choose a different number of installments or use a different payment method .', 'lkn-woocommerce-mercadopago'),
            'buyer_cc_rejected_card_disabled'               => __('<strong>You need to activate your card</strong><br>Please contact your bank by calling the number on the back of your card or choose another payment method.', 'lkn-woocommerce-mercadopago'),
            'buyer_cc_rejected_max_attempts'                => __('<strong>You reached the limit of payment attempts with this card</strong><br>Please pay using another card or choose another payment method.', 'lkn-woocommerce-mercadopago'),
            'buyer_cc_rejected_duplicated_payment'          => __('<strong>Your payment was declined because you already paid for this purchase</strong><br>Check your card transactions to verify it.', 'lkn-woocommerce-mercadopago'),
            'buyer_bank_error'                              => __('<strong>The card issuing bank declined the payment</strong><br>We recommended paying with another payment method or contact your bank.', 'lkn-woocommerce-mercadopago'),
            'buyer_cc_rejected_other_reason'                => __('<strong>The card issuing bank declined the payment</strong><br>We recommended paying with another payment method or contact your bank.', 'lkn-woocommerce-mercadopago'),
            'buyer_rejected_by_bank'                        => __('<strong>The card issuing bank declined the payment</strong><br>We recommended paying with another payment method or contact your bank.', 'lkn-woocommerce-mercadopago'),
            'buyer_cc_rejected_blacklist'                   => __('<strong>For safety reasons, the card issuing bank declined the payment</strong><br>We recommended paying with your usual payment method and device for online purchases.', 'lkn-woocommerce-mercadopago'),
            'buyer_default'                                 => __('<strong>Your payment was declined because something went wrong</strong><br>We recommended trying again or paying with another method.', 'lkn-woocommerce-mercadopago'),
        ];
    }

    /**
     * Set credits checkout translations
     *
     * @return void
     */
    private function set3dsTranslations(): void
    {
        $this->threeDsTranslations = [
            'title_loading_3ds_frame'    => __('We are taking you to validate the card', 'lkn-woocommerce-mercadopago'),
            'title_loading_3ds_frame2'   => __('with your bank', 'lkn-woocommerce-mercadopago'),
            'text_loading_3ds_frame'     => __('We need to confirm that you are the cardholder.', 'lkn-woocommerce-mercadopago'),
            'title_loading_3ds_response' => __('We are receiving the response from your bank', 'lkn-woocommerce-mercadopago'),
            'title_3ds_frame'            => __('Complete the bank validation so your payment can be approved', 'lkn-woocommerce-mercadopago'),
            'tooltip_3ds_frame'          => __('Please keep this page open. If you close it, you will not be able to resume the validation.', 'lkn-woocommerce-mercadopago'),
            'message_3ds_declined'       => __('<b>For safety reasons, your payment was declined</b><br>We recommend paying with your usual payment method and device for online purchases.', 'lkn-woocommerce-mercadopago'),
        ];
    }
}

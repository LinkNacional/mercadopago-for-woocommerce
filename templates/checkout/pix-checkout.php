<?php

/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div class='mp-checkout-container'>
    <div class="mp-checkout-pix-container">
        <?php if ( true === $test_mode ) : ?>
        <div class="mp-checkout-pix-test-mode">
            <test-mode
                title="<?php echo esc_html_e('Pix in Test Mode', WC_MERCADOPAGO_TEXT_DOMAIN); ?>"
                description="<?php echo esc_html_e('You can test the flow to generate a code, but you cannot finalize the payment.', WC_MERCADOPAGO_TEXT_DOMAIN); ?>">
            </test-mode>
        </div>
        <?php endif; ?>

        <pix-template
            title="<?php echo esc_html_e('Pay instantly', WC_MERCADOPAGO_TEXT_DOMAIN); ?>"
            subtitle="<?php echo esc_html_e('By confirming your purchase, we will show you a code to make the payment.', WC_MERCADOPAGO_TEXT_DOMAIN); ?>"
            alt="<?php echo esc_html_e('Pix logo', WC_MERCADOPAGO_TEXT_DOMAIN); ?>"
            src="<?php echo esc_html($pix_image); ?>">
        </pix-template>

        <div class="mp-checkout-pix-terms-and-conditions">
            <terms-and-conditions
                description="<?php echo esc_html_e('By continuing, you agree with our', WC_MERCADOPAGO_TEXT_DOMAIN); ?>"
                link-text="<?php echo esc_html_e('Terms and conditions', WC_MERCADOPAGO_TEXT_DOMAIN); ?>"
                link-src="<?php echo esc_html($link_terms_and_conditions); ?>">
            </terms-and-conditions>
        </div>
    </div>
</div>

<script type="text/javascript">
    if (document.getElementById("payment_method_woo-mercado-pago-custom")) {
        jQuery("form.checkout").on(
            "checkout_place_order_woo-mercado-pago-pix",
            function() {
                cardFormLoad();
            }
        );
    }
</script>
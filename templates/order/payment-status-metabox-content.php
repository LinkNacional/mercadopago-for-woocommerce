<?php

/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<div id="mp-payment-status-container">
    <p style="font-family: 'Lato', sans-serif; font-size: 14px;">
        <?php echo esc_html__('This is the payment status of your Mercado Pago Activities. To check the order status, please refer to Order details.', 'woocommerce-mercadopago'); ?>
    </p>

    <div id="mp-payment-status-content" class="mp-alert-checkout-test-mode"
        style="border-left: 4px solid <?php echo esc_html( $border_left_color ); ?>; min-height: 70px;">
        <div class="mp-alert-icon-checkout-test-mode" style="width: 0 !important; padding: 0 10px;">
            <img alt="alert"
                src="<?php echo esc_html( $img_src ); ?>"
                class="mp-alert-circle-img" />
        </div>

        <div class="mp-alert-texts-checkout-test-mode">
            <h2 class="mp-alert-title-checkout-test-mode"
                style="font-weight: 700; padding: 12px 0 0 0; font-family: 'Lato', sans-serif; font-size: 16px">
                <?php echo esc_html( $alert_title ); ?>
            </h2>

            <p class="mp-alert-description-checkout-test-mode" style="font-family: 'Lato', sans-serif;">
                <?php echo esc_html( $alert_description ); ?>
            </p>

            <p style="margin: 12px 0 4px; display: flex; align-items: center; justify-content: flex-start;">
                <a href="<?php echo esc_html( $link ); ?>"
                    target="__blank" class="mp-alert-description-button primary">
                    <?php echo esc_html( $link_description ); ?>
                </a>

                <button type="button" id="mp-sync-payment-status-button" class="mp-alert-description-button secondary">
                    <span><?php echo esc_html( $sync_button_text ); ?></span>
                    <div class="mp-small-loader" style="display: none"></div>
                </button>
            </p>
        </div>
    </div>
</div>
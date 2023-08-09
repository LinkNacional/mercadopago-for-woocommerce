<?php

/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>
<div class="mp-wallet-button-preview">
    <br />
    <p class="description">
        <?php echo esc_html( $img_wallet_button_description ); ?>
    </p>
    <br />
    <img src="<?php echo esc_url( $img_wallet_button_uri ); ?>">
</div>
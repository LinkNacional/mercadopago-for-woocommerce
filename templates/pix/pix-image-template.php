<?php
/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div style="text-align: center;">
    <div>
        <img style="border: none;
				display: inline-block;
				font-size: 14px;
				font-weight: bold;
				outline: none;
				text-decoration: none;
				text-transform: capitalize;
				vertical-align: middle;
				max-width: 100%;
				width: 168px;
				height: 168px;
				margin: 0 0 10px;"
            src="<?php esc_html_e( $qr_code_image, LKN_WC_MERCADOPAGO_TEXT_DOMAIN ); ?>"
            alt="pix">
    </div>

    <div style="margin: 0 0 16px;
				border: none;
				display: inline-block;
				font-size: 14px;
				font-weight: bold;
				outline: none;
				text-decoration: none;
				text-transform: capitalize;
				vertical-align: middle;
				max-width: 100%;">
        <small><?php esc_html_e( $text_expiration_date, LKN_WC_MERCADOPAGO_TEXT_DOMAIN ) . esc_html_e( $expiration_date, LKN_WC_MERCADOPAGO_TEXT_DOMAIN ); ?></small>
    </div>

    <div style="margin-left: auto;
			margin-right: auto;
			width: 320px;
			word-break: break-word;
			font-size: 10px;">
        <p>
            <?php esc_html_e( $qr_code, LKN_WC_MERCADOPAGO_TEXT_DOMAIN ); ?>
        </p>
    </div>
</div>
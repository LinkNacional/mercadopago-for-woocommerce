<?php
/**
 * Admin alert screen.
 *
 * @package Mercadopago/admin/notices
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<div id="message"
    class="notice <?php echo esc_attr( $type ); ?> is-dismissible <?php echo esc_attr( $inline ); ?> ">
    <div class="mp-alert-frame">
        <div class="mp-left-alert">
            <img src="
			<?php
			echo esc_url( plugins_url( '../../assets/images/minilogo.png', plugin_dir_path( __FILE__ ) ) );
?>
			">
        </div>
        <div class="mp-right-alert">
            <p>
                <?php
	echo esc_html( $message );
?>
            </p>
        </div>
    </div>
    <button type="button" class="notice-dismiss">
        <span class="screen-reader-text">
            <?php
esc_html_e( 'Discard', LKN_WC_MERCADOPAGO_TEXT_DOMAIN );
?>
        </span>
    </button>
</div>
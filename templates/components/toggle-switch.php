<?php

/**
 * Part of Woo Mercado Pago Module
 * Author - Mercado Pago
 * Developer
 * Copyright - Copyright(c) MercadoPago [http://www.mercadopago.com]
 * License - https://www.gnu.org/licenses/gpl.html GPL version 2 or higher
 *
 * @package MercadoPago
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?><tr valign="top">
	<th scope="row" class="titledesc">
		<label for="<?php echo esc_attr( $field_key ); ?>"><?php echo esc_html( $settings['title'] ); ?>
		<?php if ( $settings['desc_tip'] ) { ?>
			<span class="woocommerce-help-tip" data-tip="<?php echo esc_html( $settings['desc_tip'] ); ?>"></span>
		<?php } ?>
		</label>
	</th>
	<td class="forminp">
		<div class="mp-component-card">
			<label class="mp-toggle">
				<input class="mp-toggle-checkbox" type="checkbox" name="<?php echo esc_attr( $field_key ); ?>" value='yes' id="<?php echo esc_attr( $field_key ); ?>" <?php checked( $field_value, 'yes' ); ?>/>
				<div class="mp-toggle-switch"></div>
				<div class="mp-toggle-label">
					<span class="mp-toggle-label-enabled"><?php echo wp_kses( $settings['descriptions']['enabled'], 'b' ); ?></span>
					<span class="mp-toggle-label-disabled"><?php echo wp_kses( $settings['descriptions']['disabled'], 'b' ); ?></span>
				</div>
				<?php if ( $settings['subtitle'] ) { ?>
				<p class="description"><?php echo wp_kses_post( $settings['subtitle'] ); ?></p>
				<?php } ?>
			</label>
		</div>
		<?php 
		if ($settings['execute_action']) {
			do_action( 'mp_after_toggle_switch' );
		} ?>
	</td>
</tr>

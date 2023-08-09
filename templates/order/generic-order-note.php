<?php

/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<tr>
    <td class="label">
        <?php echo wc_help_tip( $tip_text ); ?>
        <?php echo esc_html( $title ); ?>
    </td>
    <td width="1%"></td>
    <td class="total">
        <?php echo wp_kses_post( $value ); ?>
    </td>
</tr>
<?php
/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<table class="form-table" id="mp_table_7">
    <tbody>
        <tr valign="top">
            <th scope="row" id="mp_field_text">
                <label><?php echo esc_html( $label ); ?></label>
            </th>
            <td class="forminp">
                <fieldset>
                    <a class="mp_general_links"
                        href="https://www.mercadopago.com/<?php echo esc_html( $country ); ?>/account/credentials"
                        target="_blank"><?php echo esc_html( $text ); ?></a>
                    <p class="description mp-fw-400 mp-mb-0"></p>
                </fieldset>
            </td>
        </tr>
    </tbody>
</table>
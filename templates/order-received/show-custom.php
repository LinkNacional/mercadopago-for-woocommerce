<?php

/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div>
    <table style="margin-top:-24px;margin-bottom:60px;">
        <tfoot>
            <tr>
                <th><?php echo esc_html($title_installment_cost); ?>
                </th>
                <td class="order_details">
                    <?php echo esc_html($currency); ?>
                    <?php echo esc_html($total_diff_cost); ?></td>
            </tr>
            <tr>
                <th style="width: 56.50%;">
                    <?php echo esc_html($title_installment_total); ?>
                </th>
                <td class="order_details">
                    <?php echo esc_html($currency); ?>
                    <?php echo esc_html($total_paid_amount); ?>
                    (<?php echo esc_html($installments); ?>
                    <?php echo esc_html($text_installments); ?>
                    <?php echo esc_html($currency); ?>
                    <?php echo esc_html($installment_amount); ?>)
                </td>
            </tr>
        </tfoot>
    </table>
</div>
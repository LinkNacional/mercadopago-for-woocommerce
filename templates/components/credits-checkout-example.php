<?php

/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined('ABSPATH') ) {
    exit;
}

?>

<div class="credits-info-example-text">
    <label><?php echo esc_html( $settings['value']['title'] ); ?></label>
    <p><?php echo esc_html( $settings['value']['subtitle'] ); ?>
    </p>
</div>
<div class="credits-info-preview-container">
    <div class="credits-info-example-image-container">
        <p class="credits-info-example-preview-pill">
            <?php echo esc_html( $settings['value']['pill_text'] ); ?>
        </p>
        <div class="credits-info-example-image">
            <img alt='example'
                src="<?php echo esc_html( $settings['value']['image'] ); ?>">
        </div>
        <p class="credits-info-example-preview-footer">
            <?php echo esc_html( $settings['value']['footer'] ); ?>
        </p>
    </div>
</div>
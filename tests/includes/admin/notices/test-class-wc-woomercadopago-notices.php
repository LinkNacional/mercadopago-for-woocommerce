<?php

class WC_WooMercadoPago_NoticesTest extends WP_UnitTestCase {
    public function setUp(): void {
        parent::setUp();
        require_once __DIR__ . '/../../../../includes/admin/notices/class-wc-woomercadopago-notices.php';
    }

    public function tearDown(): void {
        parent::tearDown();
    }

    public function test_get_alert_frame(): void {
        $notices = WC_WooMercadoPago_Notices::get_alert_frame( 'unit', 'test');
        $imgSrc = str_replace(
            '/tests',
            '',
            plugins_url( '../../assets/images/minilogo.png', plugin_dir_path( __FILE__ ) )
        );
        $assert = '<div id="message" class="notice test is-dismissible ">
                    <div class="mp-alert-frame">
                        <div class="mp-left-alert">
                            <img src="' . $imgSrc . '">
                        </div>
                        <div class="mp-right-alert">
                            <p>unit</p>
                        </div>
                    </div>
                </div>';
        $this->assertSame( $assert, $notices );
    }
}

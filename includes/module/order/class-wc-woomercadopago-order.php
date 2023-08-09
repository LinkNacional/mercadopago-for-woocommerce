<?php

/**
 * License - https://www.gnu.org/licenses/gpl-3.0.html GPLv3 or higher
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class WC_WooMercadoPago_Order
 */
class WC_WooMercadoPago_Order {
    /**
     * Process order status
     *
     * @param string $processed_status
     * @param array  $data
     * @param object $order
     * @param string $used_gateway
     *
     * @throws WC_WooMercadoPago_Exception Invalid status response.
     */
    public function process_status( $processed_status, $data, $order, $used_gateway ): void {
        switch ( $processed_status ) {
            case 'approved':
                $this->mp_rule_approved( $data, $order, $used_gateway );
                break;
            case 'pending':
                $this->mp_rule_pending( $data, $order, $used_gateway );
                break;
            case 'in_process':
                $this->mp_rule_in_process( $data, $order );
                break;
            case 'rejected':
                $this->mp_rule_rejected( $data, $order );
                break;
            case 'refunded':
                $this->mp_rule_refunded( $order );
                break;
            case 'cancelled':
                $this->mp_rule_cancelled( $data, $order );
                break;
            case 'in_mediation':
                $this->mp_rule_in_mediation( $order );
                break;
            case 'charged_back':
                $this->mp_rule_charged_back( $order );
                break;
            default:
                throw new WC_WooMercadoPago_Exception( 'Process Status - Invalid Status: ' . $processed_status );
        }
    }

    /**
     * Rule of approved payment
     *
     * @param array  $data Payment data.
     * @param object $order Order.
     * @param string $used_gateway Class of gateway.
     */
    public function mp_rule_approved( $data, $order, $used_gateway ): void {
        if ( 'partially_refunded' === $data['status_detail'] ) {
            return;
        }

        $status = $order->get_status();

        if ( 'pending' === $status || 'on-hold' === $status || 'failed' === $status ) {
            $order->add_order_note( 'Mercado Pago: ' . __( 'Payment approved.', WC_MERCADOPAGO_TEXT_DOMAIN ) );

            /**
             * Apply filters woocommerce_payment_complete_order_status.
             *
             * @since 3.0.1
             */
            $payment_completed_status = apply_filters(
                'woocommerce_payment_complete_order_status',
                $order->needs_processing() ? 'processing' : 'completed',
                $order->get_id(),
                $order
            );

            if ( method_exists( $order, 'get_status' ) && $order->get_status() !== 'completed' ) {
                switch ( $used_gateway ) {
                    case 'WC_WooMercadoPago_Ticket_Gateway':
                        if ( 'no' === get_option( 'stock_reduce_mode', 'no' ) ) {
                            $order->payment_complete();
                            if ( 'completed' !== $payment_completed_status ) {
                                $order->update_status( self::get_wc_status_for_mp_status( 'approved' ) );
                            }
                        }
                        break;

                    default:
                        $order->payment_complete();
                        if ( 'completed' !== $payment_completed_status ) {
                            $order->update_status( self::get_wc_status_for_mp_status( 'approved' ) );
                        }
                        break;
                }
            }
        }
    }

    /**
     * Rule of pending
     *
     * @param array  $data         Payment data.
     * @param object $order        Order.
     * @param string $used_gateway Gateway Class.
     */
    public function mp_rule_pending( $data, $order, $used_gateway ): void {
        if ( $this->can_update_order_status( $order ) ) {
            $order->update_status( self::get_wc_status_for_mp_status( 'pending' ) );
            switch ( $used_gateway ) {
                case 'WC_WooMercadoPago_Pix_Gateway':
                    $notes = $order->get_customer_order_notes();
                    if ( count( $notes ) > 1 ) {
                        break;
                    }

                    $order->add_order_note(
                        'Mercado Pago: ' . __( 'Waiting for the Pix payment.', WC_MERCADOPAGO_TEXT_DOMAIN )
                    );

                    $order->add_order_note(
                        'Mercado Pago: ' . __( 'Waiting for the Pix payment.', WC_MERCADOPAGO_TEXT_DOMAIN ),
                        1,
                        false
                    );
                    break;

                case 'WC_WooMercadoPago_Ticket_Gateway':
                    $notes = $order->get_customer_order_notes();
                    if ( count( $notes ) > 1 ) {
                        break;
                    }

                    $order->add_order_note(
                        'Mercado Pago: ' . __( 'Waiting for the ticket payment.', WC_MERCADOPAGO_TEXT_DOMAIN )
                    );

                    $order->add_order_note(
                        'Mercado Pago: ' . __( 'Waiting for the ticket payment.', WC_MERCADOPAGO_TEXT_DOMAIN ),
                        1,
                        false
                    );
                    break;

                default:
                    $order->add_order_note(
                        'Mercado Pago: ' . __( 'The customer has not made the payment yet.', WC_MERCADOPAGO_TEXT_DOMAIN )
                    );
                    break;
            }
        } else {
            $this->validate_order_note_type( $data, $order, 'pending' );
        }
    }

    /**
     * Rule of In Process
     *
     * @param array  $data  Payment data.
     * @param object $order Order.
     */
    public function mp_rule_in_process( $data, $order ): void {
        if ( $this->can_update_order_status( $order ) ) {
            $order->update_status(
                self::get_wc_status_for_mp_status( 'inprocess' ),
                'Mercado Pago: ' . __( 'Payment is pending review.', WC_MERCADOPAGO_TEXT_DOMAIN )
            );
        } else {
            $this->validate_order_note_type( $data, $order, 'in_process' );
        }
    }

    /**
     * Rule of Rejected
     *
     * @param array  $data  Payment data.
     * @param object $order Order.
     */
    public function mp_rule_rejected( $data, $order ): void {
        if ( $this->can_update_order_status( $order ) ) {
            $order->update_status(
                self::get_wc_status_for_mp_status( 'rejected' ),
                'Mercado Pago: ' . __( 'Payment was declined. The customer can try again.', WC_MERCADOPAGO_TEXT_DOMAIN )
            );
        } else {
            $this->validate_order_note_type( $data, $order, 'rejected' );
        }
    }

    /**
     * Rule of Refunded
     *
     * @param object $order Order.
     */
    public function mp_rule_refunded( $order ): void {
        $order->update_status(
            self::get_wc_status_for_mp_status( 'refunded' ),
            'Mercado Pago: ' . __( 'Payment was returned to the customer.', WC_MERCADOPAGO_TEXT_DOMAIN )
        );
    }

    /**
     * Rule of Cancelled
     *
     * @param array  $data  Payment data.
     * @param object $order Order.
     */
    public function mp_rule_cancelled( $data, $order ): void {
        if ( $this->can_update_order_status( $order ) ) {
            $order->update_status(
                self::get_wc_status_for_mp_status( 'cancelled' ),
                'Mercado Pago: ' . __( 'Payment was canceled.', WC_MERCADOPAGO_TEXT_DOMAIN )
            );
        } else {
            $this->validate_order_note_type( $data, $order, 'cancelled' );
        }
    }

    /**
     * Rule of In mediation
     *
     * @param object $order Order.
     */
    public function mp_rule_in_mediation( $order ): void {
        $order->update_status( self::get_wc_status_for_mp_status( 'inmediation' ) );
        $order->add_order_note(
            'Mercado Pago: ' . __( 'The payment is in mediation or the purchase was unknown by the customer.', WC_MERCADOPAGO_TEXT_DOMAIN )
        );
    }

    /**
     * Rule of Charged back
     *
     * @param object $order Order.
     */
    public function mp_rule_charged_back( $order ): void {
        $order->update_status( self::get_wc_status_for_mp_status( 'chargedback' ) );
        $order->add_order_note(
            'Mercado Pago: ' . __(
                'The payment is in mediation or the purchase was unknown by the customer.',
                WC_MERCADOPAGO_TEXT_DOMAIN
            )
        );
    }

    /**
     * Mercado Pago status
     *
     * @param string $mp_status Status.
     * @return string
     */
    public static function get_wc_status_for_mp_status( $mp_status ) {
        $defaults = array(
            'pending' => 'pending',
            'approved' => 'processing',
            'inprocess' => 'on_hold',
            'inmediation' => 'on_hold',
            'rejected' => 'failed',
            'cancelled' => 'cancelled',
            'refunded' => 'refunded',
            'chargedback' => 'refunded',
        );

        $status = $defaults[ $mp_status ];

        return str_replace( '_', '-', $status );
    }

    /**
     * Can update order status?
     *
     * @param object $order Order.
     *
     * @return bool
     */
    protected function can_update_order_status( $order ) {
        return method_exists( $order, 'get_status' ) &&
        	$order->get_status() !== 'completed' &&
        	$order->get_status() !== 'processing';
    }

    /**
     * Validate Order Note by Type
     *
     * @param array  $data Payment Data.
     * @param object $order Order.
     * @param string $status Status.
     */
    protected function validate_order_note_type( $data, $order, $status ): void {
        $payment_id = $data['id'];

        if ( isset( $data['ipn_type'] ) && 'merchant_order' === $data['ipn_type'] ) {
            $payments = array();

            foreach ( $data['payments'] as $payment ) {
                $payments[] = $payment['id'];
            }

            $payment_id = implode( ',', $payments );
        }

        $order->add_order_note(
            sprintf(
                /* translators: 1: payment_id 2: status */
                __( 'Mercado Pago: The payment %1$s was notified by Mercado Pago with status %2$s.', WC_MERCADOPAGO_TEXT_DOMAIN ),
                $payment_id,
                $status
            )
        );
    }
}

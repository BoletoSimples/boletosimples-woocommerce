<?php
/**
 * Boleto Simples for WooCommerce.
 *
 * @package   WC_BoletoSimples
 * @author    Kivanio Barbosa <kivanio@boletosimples.com.br
 * @license   GPL-2.0+
 * @copyright 2014 Boleto Simples
 *
 * @wordpress-plugin
 * Plugin Name:       Boleto Simples for WooCommerce
 * Plugin URI:        https://github.com/BoletoSimples/boletosimples-woocommerce
 * Description:       Start getting money by bank billet in your checking account using Boleto Simples
 * Version:           1.0.1
 * Author:            Boleto Simples
 * Author URI:        http://boletosimples.com.br/
 * Text Domain:       boletosimples-woocommerce
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/BoletoSimples/boletosimples-woocommerce
 */

/**
 * WooCommerce is missing notice.
 *
 * @since  1.0.0
 *
 * @return string WooCommerce is missing notice.
 */
function wc_boletosimples_woocommerce_is_missing() {
	echo '<div class="error"><p>' . sprintf( __( 'Boleto Simples for WooCommerce depends on the last version of %s to work!', 'boletosimples-woocommerce' ), '<a href="http://wordpress.org/extend/plugins/woocommerce/">' . __( 'WooCommerce', 'boletosimples-woocommerce' ) . '</a>' ) . '</p></div>';
}

/**
 * Initialize the Boleto Simples gateway.
 *
 * @since  1.0.0
 *
 * @return void
 */
function wc_boletosimples_gateway_init() {

	// Checks with WooCommerce is installed.
	if ( ! class_exists( 'WC_Payment_Gateway' ) ) {
		add_action( 'admin_notices', 'wc_boletosimples_woocommerce_is_missing' );

		return;
	}

	/**
	 * Load textdomain.
	 */
	load_plugin_textdomain( 'boletosimples-woocommerce', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	/**
	 * Add the Boleto Simples gateway to WooCommerce.
	 *
	 * @param  array $methods WooCommerce payment methods.
	 *
	 * @return array          Payment methods with Boleto Simples.
	 */
	function wc_boletosimples_add_gateway( $methods ) {
		$methods[] = 'WC_BoletoSimples_Gateway';

		return $methods;
	}

	add_filter( 'woocommerce_payment_gateways', 'wc_boletosimples_add_gateway' );

	// Include the WC_BoletoSimples_Gateway class.
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-boletosimples-gateway.php';
}

add_action( 'plugins_loaded', 'wc_boletosimples_gateway_init', 0 );

/**
 * Hides the Boleto Simples with payment method with the customer lives outside Brazil.
 *
 * @param  array $available_gateways Default Available Gateways.
 *
 * @return array                     New Available Gateways.
 */
function wc_boletosimples_hides_when_is_outside_brazil( $available_gateways ) {

	// Remove standard shipping option.
	if ( isset( $_REQUEST['country'] ) && 'BR' != $_REQUEST['country'] ) {
		unset( $available_gateways['boletosimples'] );
	}

	return $available_gateways;
}

add_filter( 'woocommerce_available_payment_gateways', 'wc_boletosimples_hides_when_is_outside_brazil' );

/**
 * Display pending payment instructions in order details.
 *
 * @param  int $order_id Order ID.
 *
 * @return string        Message HTML.
 */
function wc_boletosimples_pending_payment_instructions( $order_id ) {
	$order = new WC_Order( $order_id );

	if ( 'on-hold' === $order->status && 'boletosimples' == $order->payment_method ) {
		$html = '<div class="woocommerce-info">';
		$html .= sprintf( '<a class="button" href="%s" target="_blank">%s</a>', get_post_meta( $order->id, 'boletosimples_url', true ), __( 'Billet print', 'boletosimples-woocommerce' ) );

		$message = sprintf( __( '%sAttention!%s Not registered the billet payment for this order yet.', 'boletosimples-woocommerce' ), '<strong>', '</strong>' ) . '<br />';
		$message .= __( 'Please click the following button and pay the billet in your Internet Banking.', 'boletosimples-woocommerce' ) . '<br />';
		$message .= __( 'If you prefer, print and pay at any bank branch or home lottery.', 'boletosimples-woocommerce' ) . '<br />';
		$message .= __( 'Ignore this message if the payment has already been made​​.', 'boletosimples-woocommerce' ) . '<br />';

		$html .= apply_filters( 'woocommerce_boletosimples_pending_payment_instructions', $message, $order );

		$html .= '</div>';

		echo $html;
	}
}

add_action( 'woocommerce_view_order', 'wc_boletosimples_pending_payment_instructions' );

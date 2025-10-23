<?php
/**
 * Cart indicator for the desktop header.
 *
 * @package RedParts
 * @since 1.16.0
 */

use RedParts\Settings;

defined( 'ABSPATH' ) || exit;

$show_cart_indicator = 'no' !== Settings::instance()->get_option( 'header_show_cart_indicator', 'yes' );

?>

<?php if ( class_exists( 'WooCommerce' ) && $show_cart_indicator ) : ?>
	<?php
	$is_hidden = apply_filters( 'woocommerce_widget_cart_is_hidden', is_cart() || is_checkout() );

	$indicator_classes = array(
		'th-indicator',
		'th-indicator--cart',
	);

	if ( ! $is_hidden ) {
		$indicator_classes[] = 'th-indicator--trigger--click';
	}
	?>
	<div class="<?php echo esc_attr( implode( ' ', $indicator_classes ) ); ?>">
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="th-indicator__button">
			<span class="th-indicator__icon">
				<?php redparts_the_icon( 'cart-32' ); ?>
				<span class="th-indicator__counter">
					<?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?>
				</span>
			</span>
			<span class="th-indicator__title">
				<?php echo esc_html__( 'Shopping Cart', 'redparts' ); ?>
			</span>
			<span class="th-indicator__value">
				<?php

				$subtotal = wc_price(
					WC()->cart->display_prices_including_tax()
						? WC()->cart->get_cart_contents_total() + WC()->cart->get_cart_contents_tax()
						: WC()->cart->get_cart_contents_total()
				);

				?>

				<?php echo wp_kses( $subtotal, 'redparts_cart_total' ); ?>
			</span>
		</a>

		<?php if ( ! $is_hidden ) : ?>
			<div class="th-indicator__content">
				<?php get_template_part( 'partials/desktop-header/dropcart' ); ?>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>

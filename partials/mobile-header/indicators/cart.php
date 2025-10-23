<?php
/**
 * Cart indicator for the mobile header.
 *
 * @package RedParts
 * @since 1.16.0
 */

use RedParts\Settings;

defined( 'ABSPATH' ) || exit;

$show_cart_indicator = 'no' !== Settings::instance()->get_option( 'mobile_header_show_cart_indicator', 'yes' );

?>

<?php if ( class_exists( 'WooCommerce' ) && $show_cart_indicator ) : ?>
	<div class="th-mobile-indicator th-mobile-indicator--cart">
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="th-mobile-indicator__button">
			<span class="th-mobile-indicator__icon">
				<?php redparts_the_icon( 'cart-20' ); ?>
				<span class="th-mobile-indicator__counter">
					<?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?>
				</span>
			</span>
		</a>
	</div>
<?php endif; ?>

<?php
/**
 * Cart indicator for the mobile menu.
 *
 * @package RedParts
 * @since 1.16.0
 */

use RedParts\Settings;

defined( 'ABSPATH' ) || exit;

$indicators_show_cart = 'no' !== Settings::instance()->get_option( 'mobile_menu_indicators_show_cart' ) && class_exists( 'WooCommerce' );

if ( $indicators_show_cart ) :
	?>
	<a
		class="th-mobile-menu__indicator th-mobile-menu__indicator--cart"
		href="<?php echo esc_url( wc_get_cart_url() ); ?>"
	>
		<span class="th-mobile-menu__indicator-icon">
			<?php redparts_the_icon( 'cart-20' ); ?>
			<span class="th-mobile-menu__indicator-counter">
				<?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?>
			</span>
		</span>
		<span class="th-mobile-menu__indicator-title">
			<?php echo esc_html__( 'Cart', 'redparts' ); ?>
		</span>
	</a>
	<?php
endif;

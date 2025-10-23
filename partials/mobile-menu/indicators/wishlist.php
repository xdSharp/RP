<?php
/**
 * Wishlist indicator for the mobile menu.
 *
 * @package RedParts
 * @since 1.16.0
 */

use RedParts\Settings;

defined( 'ABSPATH' ) || exit;

$wishlist = null;

if (
	class_exists( 'RedParts\Sputnik\Wishlist' ) &&
	redparts_sputnik_version_is( '>=', '1.5.0' ) &&
	RedParts\Sputnik\Wishlist::instance()->is_enabled()
) {
	$wishlist = RedParts\Sputnik\Wishlist::instance();
}

$indicators_show_wishlist = 'no' !== Settings::instance()->get_option( 'mobile_menu_indicators_show_wishlist' ) && $wishlist;

if ( $indicators_show_wishlist ) :
	?>
	<a
		class="th-mobile-menu__indicator th-mobile-menu__indicator--wishlist"
		href="<?php echo esc_url( $wishlist->get_page_url() ); ?>"
	>
		<span class="th-mobile-menu__indicator-icon">
			<?php redparts_the_icon( 'heart-20' ); ?>
			<span class="th-mobile-menu__indicator-counter">
				<?php echo esc_html( $wishlist->get_count() ); ?>
			</span>
		</span>
		<span class="th-mobile-menu__indicator-title">
			<?php echo esc_html__( 'Wishlist', 'redparts' ); ?>
		</span>
	</a>
	<?php
endif;

<?php
/**
 * Wishlist indicator for the desktop header.
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

$show_wishlist_indicator = 'no' !== Settings::instance()->get_option( 'header_show_wishlist_indicator', 'yes' );

?>

<?php if ( $wishlist && $show_wishlist_indicator ) : ?>
	<div class="th-indicator th-indicator--wishlist">
		<a href="<?php echo esc_url( $wishlist->get_page_url() ); ?>" class="th-indicator__button">
			<span class="th-indicator__icon">
				<?php redparts_the_icon( 'heart-32' ); ?>
				<span class="th-indicator__counter">
					<?php echo esc_html( $wishlist->get_count() ); ?>
				</span>
			</span>
		</a>
	</div>
<?php endif; ?>

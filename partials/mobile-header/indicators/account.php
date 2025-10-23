<?php
/**
 * Account indicator for the mobile header.
 *
 * @package RedParts
 * @since 1.16.0
 */

use RedParts\Settings;

defined( 'ABSPATH' ) || exit;

$show_account_indicator = 'no' !== Settings::instance()->get_option( 'mobile_header_show_account_indicator', 'yes' );

?>

<?php if ( class_exists( 'WooCommerce' ) && $show_account_indicator ) : ?>
	<div class="th-mobile-indicator th-display-none th-display-md-block">
		<a
			href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>"
			class="th-mobile-indicator__button"
		>
			<span class="th-mobile-indicator__icon">
				<?php redparts_the_icon( 'person-20' ); ?>
			</span>
		</a>
	</div>
<?php endif; ?>

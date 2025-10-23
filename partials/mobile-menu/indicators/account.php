<?php
/**
 * Account indicator for the mobile menu.
 *
 * @package RedParts
 * @since 1.16.0
 */

use RedParts\Settings;

defined( 'ABSPATH' ) || exit;

$indicators_show_account = 'no' !== Settings::instance()->get_option( 'mobile_menu_indicators_show_account' ) && class_exists( 'WooCommerce' );

if ( $indicators_show_account ) :
	?>
	<a
		class="th-mobile-menu__indicator"
		href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>"
	>
		<span class="th-mobile-menu__indicator-icon">
			<?php redparts_the_icon( 'person-20' ); ?>
		</span>
		<span class="th-mobile-menu__indicator-title">
			<?php echo esc_html__( 'Account', 'redparts' ); ?>
		</span>
	</a>
	<?php
endif;

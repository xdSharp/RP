<?php
/**
 * Garage indicator for the mobile menu.
 *
 * @package RedParts
 * @since 1.16.0
 */

use RedParts\Settings;
use RedParts\Sputnik\Settings as SputnikSettings;

defined( 'ABSPATH' ) || exit;

$sputnik_settings = null;
$garage           = null;

if ( class_exists( 'RedParts\Sputnik\Garage' ) ) {
	$garage = RedParts\Sputnik\Garage::instance();
}
if ( class_exists( 'RedParts\Sputnik\Settings' ) ) {
	$sputnik_settings = SputnikSettings::instance();
}

$autoparts_features     = $sputnik_settings && 'no' !== $sputnik_settings->get( 'autoparts_features' ) && $garage;
$indicators_show_garage = 'no' !== Settings::instance()->get_option( 'mobile_menu_indicators_show_garage' ) && class_exists( 'WooCommerce' ) && $autoparts_features;

if ( $indicators_show_garage ) :
	?>
	<a
		class="th-mobile-menu__indicator"
		href="<?php echo esc_url( wc_get_account_endpoint_url( 'garage' ) ); ?>"
	>
		<span class="th-mobile-menu__indicator-icon">
			<?php redparts_the_icon( 'car-20' ); ?>
		</span>
		<span class="th-mobile-menu__indicator-title">
			<?php echo esc_html__( 'Garage', 'redparts' ); ?>
		</span>
	</a>
	<?php
endif;

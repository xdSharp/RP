<?php
/**
 * The main menu that will be displayed on desktop devices.
 *
 * @package RedParts
 * @since 1.0.0
 */

use RedParts\Settings;

defined( 'ABSPATH' ) || exit;

$lazy_loading_megamenus = 'no' !== Settings::instance()->get_option( 'lazy_loading_megamenus' );

wp_nav_menu(
	array(
		'theme_location'         => 'redparts-main',
		'container_class'        => 'th-main-menu',
		'menu_class'             => 'th-main-menu__list',
		'fallback_cb'            => '',
		'redparts_megamenu'      => true,
		'redparts_lazy_megamenu' => $lazy_loading_megamenus,
		'redparts_arrows'        => array(
			'root' => redparts_get_icon( 'arrow-down-sm-7x5', 'th-menu-item-arrow' ),
			'deep' => redparts_get_icon( 'arrow-rounded-right-6x9', 'th-menu-item-arrow' ),
		),
	)
);

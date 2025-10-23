<?php
/**
 * The header that will be displayed on desktop devices.
 *
 * @package RedParts
 * @since 1.0.0
 * @version 1.16.0
 */

use RedParts\Header;
use RedParts\Settings;

defined( 'ABSPATH' ) || exit;

$header_layout         = Header::instance()->get_layout();
$show_departments_menu = Header::instance()->show_departments_menu();
$show_topbar           = Header::instance()->show_topbar();

$classes = array( 'th-header' );

if ( ! $show_topbar ) {
	$classes[] = 'th-header--without-topbar';
}

?>
<div class="<?php redparts_the_classes( ...$classes ); ?>">
	<div class="th-header__megamenu-area th-megamenu-area"></div>

	<?php if ( $show_topbar ) : ?>
		<?php if ( 'spaceship' === $header_layout ) : ?>
			<div class="th-header__topbar-start-bg"></div>
			<div class="th-header__topbar-start">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'redparts-topbar-start',
						'menu_class'      => 'th-topbar th-topbar--start',
						'container'       => '',
						'fallback_cb'     => '',
						'depth'           => 2,
						'redparts_arrows' => array(
							'root' => redparts_get_icon( 'arrow-down-sm-7x5', 'th-menu-item-arrow' ),
							'deep' => redparts_get_icon( 'arrow-rounded-right-7x11', 'th-menu-item-arrow' ),
						),
					)
				);
				?>
			</div>
			<div class="th-header__topbar-end-bg"></div>
			<div class="th-header__topbar-end">
				<?php get_template_part( 'partials/desktop-header/topbar' ); ?>
			</div>
		<?php endif; ?>
		<?php if ( 'classic' === $header_layout ) : ?>
			<div class="th-header__topbar-classic-bg"></div>
			<div class="th-header__topbar-classic">
				<?php get_template_part( 'partials/desktop-header/topbar' ); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<div class="th-header__navbar">
		<?php if ( $show_departments_menu ) : ?>
			<div class="th-header__navbar-departments">
				<?php get_template_part( 'partials/desktop-header/departments' ); ?>
			</div>
		<?php endif; ?>
		<div class="th-header__navbar-menu">
			<?php get_template_part( 'partials/desktop-header/main-menu' ); ?>
		</div>
		<?php if ( 'classic' === $header_layout ) : ?>
			<?php

			$settings          = Settings::instance();
			$contacts_title    = $settings->get_option( 'header_contacts_title' );
			$contacts_subtitle = $settings->get_option( 'header_contacts_subtitle' );
			$contacts_url      = $settings->get_option( 'header_contacts_url' );
			$contacts_show     = 'yes' === $settings->get_option( 'header_contacts_show' );
			$contacts_show     = $contacts_show && ( ! empty( $contacts_title ) || ! empty( $contacts_subtitle ) );

			?>
			<?php if ( $contacts_show ) : ?>
				<div class="th-header__navbar-phone th-phone">
					<?php if ( ! empty( $contacts_url ) ) : ?>
						<a class="th-phone__body" href="<?php echo esc_url( $contacts_url ); ?>">
					<?php else : ?>
						<span class="th-phone__body">
					<?php endif; ?>
						<div class="th-phone__subtitle">
							<?php echo esc_html( $contacts_subtitle ); ?>
						</div>
						<div class="th-phone__title">
							<?php echo esc_html( $contacts_title ); ?>
						</div>
					<?php if ( empty( $contacts_url ) ) : ?>
						</span>
					<?php else : ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<div class="th-header__logo">
		<?php get_template_part( 'partials/desktop-header/logo' ); ?>
	</div>
	<div class="th-header__search">
		<?php
		get_search_form(
			array(
				'echo'                => true,
				'redparts_location'   => 'desktop-header',
				'redparts_search_by'  => 'product',
				'redparts_categories' => true,
			)
		);
		?>
	</div>
	<div class="th-header__indicators">
		<?php

		/**
		 * Hook: redparts_desktop_header_indicators.
		 *
		 * @since 1.16.0
		 *
		 * @hooked RedParts\Header::desktop_wishlist_indicator - 100
		 * @hooked RedParts\Header::desktop_account_indicator  - 200
		 * @hooked RedParts\Header::desktop_cart_indicator     - 300
		 */
		do_action( 'redparts_desktop_header_indicators' );

		?>
	</div>
</div>

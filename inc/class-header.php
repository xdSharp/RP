<?php
/**
 * This file contains code related to the site header.
 *
 * @package RedParts
 * @since 1.0.0
 */

namespace RedParts;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RedParts\Header' ) ) {
	/**
	 * Class Header
	 */
	class Header extends Singleton {
		const DEFAULT_LAYOUT = 'spaceship';

		const VALID_LAYOUTS = array( 'classic', 'spaceship' );

		/**
		 * Initialization.
		 */
		public function init() {
			add_filter( 'body_class', array( $this, 'body_class' ) );

			// Hook: redparts_desktop_header_indicators.
			add_action( 'redparts_desktop_header_indicators', array( $this, 'desktop_wishlist_indicator' ), 100 );
			add_action( 'redparts_desktop_header_indicators', array( $this, 'desktop_account_indicator' ), 200 );
			add_action( 'redparts_desktop_header_indicators', array( $this, 'desktop_cart_indicator' ), 300 );

			// Hook: redparts_mobile_header_indicators.
			add_action( 'redparts_mobile_header_indicators', array( $this, 'mobile_search_indicator' ), 100 );
			add_action( 'redparts_mobile_header_indicators', array( $this, 'mobile_account_indicator' ), 200 );
			add_action( 'redparts_mobile_header_indicators', array( $this, 'mobile_wishlist_indicator' ), 300 );
			add_action( 'redparts_mobile_header_indicators', array( $this, 'mobile_cart_indicator' ), 400 );

			// Hook: redparts_mobile_menu_indicators.
			add_action( 'redparts_mobile_menu_indicators', array( $this, 'mobile_menu_wishlist_indicator' ), 100 );
			add_action( 'redparts_mobile_menu_indicators', array( $this, 'mobile_menu_account_indicator' ), 200 );
			add_action( 'redparts_mobile_menu_indicators', array( $this, 'mobile_menu_cart_indicator' ), 300 );
			add_action( 'redparts_mobile_menu_indicators', array( $this, 'mobile_menu_garage_indicator' ), 400 );
		}

		/**
		 * Returns the product page layout.
		 *
		 * @return string
		 */
		public function get_layout(): string {
			$result   = self::DEFAULT_LAYOUT;
			$settings = Settings::instance()->get();

			if ( ! empty( $settings['header_layout'] ) && in_array( $settings['header_layout'], self::VALID_LAYOUTS, true ) ) {
				$result = $settings['header_layout'];
			}

			// phpcs:disable WordPress.Security.NonceVerification.Recommended
			if ( isset( $_GET['redparts_header_layout'] ) ) {
				$get_layout = sanitize_key( wp_unslash( $_GET['redparts_header_layout'] ) );

				if ( in_array( $get_layout, self::VALID_LAYOUTS, true ) ) {
					$result = $get_layout;
				}
			}
			// phpcs:enable

			return apply_filters( 'redparts_header_get_layout', $result );
		}

		/**
		 * Determines whether the topbar should be displayed.
		 *
		 * @return bool
		 */
		public function show_topbar(): bool {
			$result   = true;
			$settings = Settings::instance()->get();

			if ( ! empty( $settings['header_show_topbar'] ) ) {
				$result = 'yes' === $settings['header_show_topbar'];
			}

			return apply_filters( 'redparts_header_show_topbar', $result );
		}

		/**
		 * Determines whether the departments menu should be displayed.
		 *
		 * @return bool
		 */
		public function show_departments_menu(): bool {
			$result   = true;
			$settings = Settings::instance()->get();

			if ( ! empty( $settings['header_show_departments_menu'] ) ) {
				$result = 'yes' === $settings['header_show_departments_menu'];
			}

			$result = $result && has_nav_menu( 'redparts-departments' );

			return apply_filters( 'redparts_header_show_departments_menu', $result );
		}

		/**
		 * Determines whether the site has a special logo for mobile devices.
		 *
		 * @return bool
		 */
		public function has_mobile_logo(): bool {
			$result   = false;
			$settings = Settings::instance()->get();

			if ( isset( $settings['mobile_header_logo']['id'] ) ) {
				$image = wp_get_attachment_image( $settings['mobile_header_logo']['id'] );

				if ( $image ) {
					return true;
				}
			}

			return $result;
		}

		/**
		 * Outputs logo for mobile devices.
		 */
		public function the_mobile_logo() {
			$settings = Settings::instance()->get();

			if ( ! isset( $settings['mobile_header_logo']['id'] ) ) {
				return;
			}

			$logo_id    = $settings['mobile_header_logo']['id'];
			$logo_attrs = array();

			$image_alt = get_post_meta( $logo_id, '_wp_attachment_image_alt', true );
			if ( empty( $image_alt ) ) {
				$logo_attrs['alt'] = get_bloginfo( 'name', 'display' );
			}

			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php echo wp_get_attachment_image( $logo_id, 'full', false, $logo_attrs ); ?>
			</a>
			<?php
		}

		/**
		 * Adds the .th-var-header-layout--* CSS class to the body as needed.
		 *
		 * @param string[] $classes Array of CSS classes.
		 *
		 * @return string[]
		 */
		public function body_class( array $classes ): array {
			$classes[] = 'th-var-header-layout--' . $this->get_layout();

			return $classes;
		}

		/**
		 * Outputs the wishlist indicator in the desktop header.
		 *
		 * @since 1.16.0
		 */
		public function desktop_wishlist_indicator() {
			get_template_part( 'partials/desktop-header/indicators/wishlist' );
		}

		/**
		 * Outputs the account indicator in the desktop header.
		 *
		 * @since 1.16.0
		 */
		public function desktop_account_indicator() {
			get_template_part( 'partials/desktop-header/indicators/account' );
		}

		/**
		 * Outputs the cart indicator in the desktop header.
		 *
		 * @since 1.16.0
		 */
		public function desktop_cart_indicator() {
			get_template_part( 'partials/desktop-header/indicators/cart' );
		}

		/**
		 * Outputs the search indicator in the mobile header.
		 *
		 * @since 1.16.0
		 */
		public function mobile_search_indicator() {
			get_template_part( 'partials/mobile-header/indicators/search' );
		}

		/**
		 * Outputs the account indicator in the mobile header.
		 *
		 * @since 1.16.0
		 */
		public function mobile_account_indicator() {
			get_template_part( 'partials/mobile-header/indicators/account' );
		}

		/**
		 * Outputs the wishlist indicator in the mobile header.
		 *
		 * @since 1.16.0
		 */
		public function mobile_wishlist_indicator() {
			get_template_part( 'partials/mobile-header/indicators/wishlist' );
		}

		/**
		 * Outputs the cart indicator in the mobile header.
		 *
		 * @since 1.16.0
		 */
		public function mobile_cart_indicator() {
			get_template_part( 'partials/mobile-header/indicators/cart' );
		}

		/**
		 * Outputs the wishlist indicator in the mobile menu.
		 *
		 * @since 1.16.0
		 */
		public function mobile_menu_wishlist_indicator() {
			get_template_part( 'partials/mobile-menu/indicators/wishlist' );
		}

		/**
		 * Outputs the account indicator in the mobile menu.
		 *
		 * @since 1.16.0
		 */
		public function mobile_menu_account_indicator() {
			get_template_part( 'partials/mobile-menu/indicators/account' );
		}

		/**
		 * Outputs the cart indicator in the mobile menu.
		 *
		 * @since 1.16.0
		 */
		public function mobile_menu_cart_indicator() {
			get_template_part( 'partials/mobile-menu/indicators/cart' );
		}

		/**
		 * Outputs the garage indicator in the mobile menu.
		 *
		 * @since 1.16.0
		 */
		public function mobile_menu_garage_indicator() {
			get_template_part( 'partials/mobile-menu/indicators/garage' );
		}
	}
}

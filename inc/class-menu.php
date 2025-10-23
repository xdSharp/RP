<?php
/**
 * RedParts menu.
 *
 * @package RedParts
 * @since 1.0.0
 */

namespace RedParts;

use WP_Post;
use stdClass;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RedParts\Menu' ) ) {
	/**
	 * Class Menu
	 */
	class Menu extends Singleton {
		/**
		 * Initialization.
		 */
		public function init() {
			add_filter( 'nav_menu_item_args', array( $this, 'item_args' ), 20, 3 );
			add_filter( 'redparts_main_script_vars', array( $this, 'main_script_vars' ), 10 );
			add_action( 'wp_update_nav_menu_item', array( $this, 'delete_menu_cache_key' ), 20 );
		}

		/**
		 * Adds arrows to the menu items
		 *
		 * @noinspection PhpMissingParamTypeInspection
		 *
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param WP_Post  $item  Menu item data object.
		 * @param int      $depth Depth of menu item. Used for padding.
		 *
		 * @return stdClass
		 */
		public function item_args( stdClass $args, $item, int $depth ): stdClass {
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes = explode( ' ', implode( ' ', $classes ) );

			$has_children = in_array( 'menu-item-has-children', $classes, true );
			$has_megamenu = ! empty( $args->redparts_has_megamenu ) && $args->redparts_has_megamenu;

			if ( ! $has_children && ! $has_megamenu ) {
				return $args;
			}

			$args = (object) (array) $args;

			$arrow_type = 0 === $depth ? 'root' : 'deep';

			if ( ! empty( $args->redparts_arrows[ $arrow_type ] ) ) {
				if ( empty( $args->after ) ) {
					$args->link_after = '';
				}

				$args->link_after .= $args->redparts_arrows[ $arrow_type ];
			}

			return $args;
		}

		/**
		 * Updates main script vars.
		 *
		 * @since 1.8.0
		 *
		 * @param array $vars Array of script variables.
		 *
		 * @return array
		 */
		public function main_script_vars( array $vars ): array {
			$vars['menuCacheKey'] = $this->get_menu_cache_key();

			return $vars;
		}

		/**
		 * Returns menu cache key.
		 *
		 * @since 1.8.0
		 *
		 * @return string
		 */
		public function get_menu_cache_key(): string {
			$cache_time = get_transient( 'redparts_menu_cache_time' );

			if ( false === $cache_time ) {
				$cache_time = time();

				set_transient( 'redparts_menu_cache_time', $cache_time );
			}

			return md5( (string) $cache_time );
		}

		/**
		 * Deletes menu cache key.
		 *
		 * @since 1.8.0
		 */
		public function delete_menu_cache_key() {
			delete_transient( 'redparts_menu_cache_time' );
		}
	}
}

<?php
/**
 * The mobile header that will be displayed on desktop devices.
 *
 * @package RedParts
 * @since 1.0.0
 * @version 1.16.0
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="th-mobile-header">
	<div class="th-container">
		<div class="th-mobile-header__body">
			<button class="th-mobile-header__menu-button" type="button">
				<?php redparts_the_icon( 'menu-18x14' ); ?>
			</button>

			<?php get_template_part( 'partials/mobile-header/logo' ); ?>

			<?php
			get_search_form(
				array(
					'echo'                => true,
					'redparts_location'   => 'mobile-header',
					'redparts_search_by'  => 'product',
					'redparts_categories' => true,
					'redparts_classes'    => 'th-mobile-header__search',
				)
			);
			?>

			<div class="th-mobile-header__indicators">
				<?php

				/**
				 * Hook: redparts_mobile_header_indicators.
				 *
				 * @since 1.16.0
				 *
				 * @hooked RedParts\Header::mobile_search_indicator   - 100
				 * @hooked RedParts\Header::mobile_account_indicator  - 200
				 * @hooked RedParts\Header::mobile_wishlist_indicator - 300
				 * @hooked RedParts\Header::mobile_cart_indicator     - 400
				 */
				do_action( 'redparts_mobile_header_indicators' );

				?>
			</div>
		</div>
	</div>
</div>

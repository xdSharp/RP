<?php
/**
 * The template for displaying the mobile menu.
 *
 * @package RedParts
 * @since 1.0.0
 * @version 1.16.0
 */

use RedParts\Settings;

defined( 'ABSPATH' ) || exit;

// phpcs:disable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
global $WOOCS;

$settings = Settings::instance();

$woocs_installed  = isset( $WOOCS );
$currencies       = array();
$current_currency = array();

if ( $woocs_installed ) {
	$currencies       = $WOOCS->get_currencies();
	$current_currency = $currencies[ $WOOCS->current_currency ];
}
// phpcs:enable

$languages             = apply_filters( 'wpml_active_languages', array(), array( 'skip_missing' => true ) );
$current_language_code = apply_filters( 'wpml_current_language', null );
$current_language      = $languages[ $current_language_code ] ?? null;

$show_language_switcher = 'no' !== $settings->get_option( 'mobile_menu_show_language_switcher' ) && 1 < count( $languages ) && null !== $current_language;
$show_currency_switcher = 'no' !== $settings->get_option( 'mobile_menu_show_currency_switcher' ) && $woocs_installed && 1 < count( $currencies );

$indicators_show = 'no' !== $settings->get_option( 'mobile_menu_indicators_show' );

$contacts_title    = $settings->get_option( 'mobile_menu_contacts_title' );
$contacts_subtitle = $settings->get_option( 'mobile_menu_contacts_subtitle' );
$contacts_url      = $settings->get_option( 'mobile_menu_contacts_url' );
$contacts_show     = 'yes' === $settings->get_option( 'mobile_menu_contacts_show' );
$contacts_show     = $contacts_show && ( ! empty( $contacts_title ) || ! empty( $contacts_subtitle ) );

?>
<div class="th-mobile-menu">
	<div class="th-mobile-menu__links-panel th-mobile-menu__links-panel--template" data-mobile-menu-panel>
		<div class="th-mobile-menu__panel th-mobile-menu__panel--hidden">
			<div class="th-mobile-menu__panel-header">
				<button class="th-mobile-menu__panel-back" type="button">
					<?php redparts_the_icon( 'arrow-rounded-left-7x11' ); ?>
				</button>
				<div class="th-mobile-menu__panel-title"></div>
			</div>
			<div class="th-mobile-menu__panel-body">
				<div class="th-mobile-menu__links"></div>
			</div>
		</div>
	</div>

	<div class="th-mobile-menu__backdrop"></div>
	<div class="th-mobile-menu__body">
		<button class="th-mobile-menu__close" type="button">
			<?php redparts_the_icon( 'cross-12' ); ?>
		</button>

		<div class="th-mobile-menu__panel">
			<div class="th-mobile-menu__panel-header">
				<div class="th-mobile-menu__panel-title">
					<?php echo esc_html__( 'Menu', 'redparts' ); ?>
				</div>
			</div>
			<div class="th-mobile-menu__panel-body">

				<?php if ( $show_language_switcher || $show_currency_switcher ) : ?>
					<div class="th-mobile-menu__settings-list">
						<?php if ( $show_language_switcher ) : ?>
							<div class="th-mobile-menu__setting" data-mobile-menu-item>
								<button
									class="th-mobile-menu__setting-button"
									title="<?php echo esc_attr__( 'Language', 'redparts' ); ?>"
									data-mobile-menu-trigger
								>
									<span class="th-mobile-menu__setting-icon th-mobile-menu__setting-icon--currency">
										<?php echo esc_html( strtoupper( $current_language['language_code'] ) ); ?>
									</span>
									<span class="th-mobile-menu__setting-title">
										<?php echo esc_html__( 'Language', 'redparts' ); ?>
									</span>
									<span class="th-mobile-menu__setting-arrow">
										<?php redparts_the_icon( 'arrow-rounded-right-6x9' ); ?>
									</span>
								</button>

								<div class="th-mobile-menu__setting-panel" data-mobile-menu-panel>
									<div class="th-mobile-menu__panel th-mobile-menu__panel--hidden">
										<div class="th-mobile-menu__panel-header">
											<button class="th-mobile-menu__panel-back" type="button">
												<?php redparts_the_icon( 'arrow-rounded-left-7x11' ); ?>
											</button>
											<div class="th-mobile-menu__panel-title">
												<?php echo esc_html__( 'Language', 'redparts' ); ?>
											</div>
										</div>
										<div class="th-mobile-menu__panel-body">
											<div class="th-mobile-menu__links">
												<ul>
													<?php foreach ( $languages as $language ) : ?>
														<li>
															<a href="<?php echo esc_url( $language['url'] ); ?>">
																<?php echo esc_html( $language['native_name'] ); ?>
															</a>
														</li>
													<?php endforeach; ?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>

						<?php if ( $show_currency_switcher ) : ?>
							<div class="th-mobile-menu__setting" data-mobile-menu-item>
								<button
									class="th-mobile-menu__setting-button"
									title="<?php echo esc_attr__( 'Currency', 'redparts' ); ?>"
									data-mobile-menu-trigger
								>
									<span class="th-mobile-menu__setting-icon th-mobile-menu__setting-icon--currency">
										<?php echo esc_html( $current_currency['symbol'] ); ?>
									</span>
									<span class="th-mobile-menu__setting-title">
										<?php echo esc_html( $current_currency['description'] ); ?>
									</span>
									<span class="th-mobile-menu__setting-arrow">
										<?php redparts_the_icon( 'arrow-rounded-right-6x9' ); ?>
									</span>
								</button>

								<div class="th-mobile-menu__setting-panel" data-mobile-menu-panel>
									<div class="th-mobile-menu__panel th-mobile-menu__panel--hidden">
										<div class="th-mobile-menu__panel-header">
											<button class="th-mobile-menu__panel-back" type="button">
												<?php redparts_the_icon( 'arrow-rounded-left-7x11' ); ?>
											</button>
											<div class="th-mobile-menu__panel-title">
												<?php echo esc_html__( 'Currency', 'redparts' ); ?>
											</div>
										</div>
										<div class="th-mobile-menu__panel-body">
											<div class="th-mobile-menu__links">
												<ul>
													<?php foreach ( $currencies as $currency_code => $currency ) : ?>
														<li>
															<a href="" data-th-currency-code="<?php echo esc_attr( $currency_code ); ?>">
																<?php echo esc_html( $currency['symbol'] ); ?>
																<?php echo esc_html( $currency['description'] ); ?>
															</a>
														</li>
													<?php endforeach; ?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<div class="th-mobile-menu__divider"></div>
				<?php endif; ?>

				<?php

				if ( $indicators_show ) {
					$render_indicators = function() {
						/**
						 * Hook: redparts_mobile_menu_indicators.
						 *
						 * @since 1.16.0
						 *
						 * @hooked RedParts\Header::mobile_menu_wishlist_indicator - 100
						 * @hooked RedParts\Header::mobile_menu_account_indicator  - 200
						 * @hooked RedParts\Header::mobile_menu_cart_indicator     - 300
						 * @hooked RedParts\Header::mobile_menu_garage_indicator   - 400
						 */
						do_action( 'redparts_mobile_menu_indicators' );
					};

					$render_indicators_wrapper = function( $content ) {
						?>
						<div class="th-mobile-menu__indicators">
							<?php $content(); ?>
						</div>
						<div class="th-mobile-menu__divider"></div>
						<?php
					};

					redparts_if_content( $render_indicators_wrapper, $render_indicators );
				}

				?>

				<?php
				wp_nav_menu(
					array(
						'theme_location'         => 'redparts-mobile-menu',
						'container_class'        => 'th-mobile-menu__links',
						'fallback_cb'            => '',
						'redparts_megamenu'      => true,
						'redparts_lazy_megamenu' => false,
						'redparts_arrows'        => array(
							'root' => redparts_get_icon( 'arrow-rounded-right-6x9', 'th-menu-item-arrow' ),
							'deep' => redparts_get_icon( 'arrow-rounded-right-6x9', 'th-menu-item-arrow' ),
						),
						'redparts_megamenu_args' => array(
							'redparts_arrows' => array(
								'root' => redparts_get_icon( 'arrow-rounded-right-6x9', 'th-menu-item-arrow' ),
								'deep' => redparts_get_icon( 'arrow-rounded-right-6x9', 'th-menu-item-arrow' ),
							),
						),
					)
				);
				?>

				<?php if ( $contacts_show ) : ?>
					<div class="th-mobile-menu__spring"></div>
					<div class="th-mobile-menu__divider"></div>
					<?php if ( ! empty( $contacts_url ) ) : ?>
						<a class="th-mobile-menu__contacts" href="<?php echo esc_url( $contacts_url ); ?>">
					<?php else : ?>
						<span class="th-mobile-menu__contacts">
					<?php endif; ?>
						<div class="th-mobile-menu__contacts-subtitle">
							<?php echo esc_html( $contacts_subtitle ); ?>
						</div>
						<div class="th-mobile-menu__contacts-title">
							<?php echo esc_html( $contacts_title ); ?>
						</div>
					<?php if ( empty( $contacts_url ) ) : ?>
						</span>
					<?php else : ?>
						</a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>

	</div>
</div>

<?php
/**
 * Account indicator for the desktop header.
 *
 * @package RedParts
 * @since 1.16.0
 */

use RedParts\Settings;

defined( 'ABSPATH' ) || exit;

$show_account_indicator = 'no' !== Settings::instance()->get_option( 'header_show_account_indicator', 'yes' );

?>

<?php if ( class_exists( 'WooCommerce' ) && $show_account_indicator ) : ?>
	<?php

	$indicator_classes = array( 'th-indicator' );

	if ( is_user_logged_in() ) {
		$indicator_classes[] = 'th-indicator--trigger--click';
	}

	?>
	<div class="<?php echo esc_attr( implode( ' ', $indicator_classes ) ); ?>">
		<?php

		global $current_user;

		$account_menu_items   = wc_get_account_menu_items();
		$account_logout_title = $account_menu_items['customer-logout'];

		unset( $account_menu_items['customer-logout'] );

		?>
		<a
			href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>"
			class="th-indicator__button"
		>
			<span class="th-indicator__icon">
				<?php redparts_the_icon( 'person-32' ); ?>
			</span>
			<span class="th-indicator__title">
				<?php if ( is_user_logged_in() ) : ?>
					<?php echo esc_html( $current_user->user_email ); ?>
				<?php else : ?>
					<?php esc_html_e( 'Hello, Log In', 'redparts' ); ?>
				<?php endif; ?>
			</span>
			<span class="th-indicator__value"><?php esc_html_e( 'My Account', 'redparts' ); ?></span>
		</a>
		<?php if ( is_user_logged_in() ) : ?>
			<div class="th-indicator__content">
				<div class="th-account-menu">
					<a
						href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>"
						class="th-account-menu__user"
					>
						<div class="th-account-menu__user-avatar">
							<?php echo get_avatar( $current_user->ID, 44 ); ?>
						</div>
						<div class="th-account-menu__user-info">
							<div class="th-account-menu__user-name">
								<?php echo esc_html( $current_user->display_name ); ?>
							</div>
							<div class="th-account-menu__user-email">
								<?php echo esc_html( $current_user->user_email ); ?>
							</div>
						</div>
					</a>

					<?php if ( 0 < count( $account_menu_items ) ) : ?>
						<div class="th-account-menu__divider"></div>
						<ul class="th-account-menu__links">
							<?php foreach ( $account_menu_items as $menu_key => $menu_title ) : ?>
								<li>
									<a href="<?php echo esc_url( wc_get_account_endpoint_url( $menu_key ) ); ?>">
										<?php echo esc_html( $menu_title ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<?php if ( ! empty( $account_logout_title ) ) : ?>
						<div class="th-account-menu__divider"></div>
						<ul class="th-account-menu__links">
							<li>
								<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'customer-logout' ) ); ?>">
									<?php echo esc_html( $account_logout_title ); ?>
								</a>
							</li>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>

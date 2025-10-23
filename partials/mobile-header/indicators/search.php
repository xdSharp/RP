<?php
/**
 * Search indicator for the mobile header.
 *
 * @package RedParts
 * @since 1.16.0
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="th-mobile-indicator th-mobile-indicator--search th-display-md-none">
	<button type="button" class="th-mobile-indicator__button">
		<span class="th-mobile-indicator__icon">
			<?php redparts_the_icon( 'search-20' ); ?>
		</span>
	</button>
</div>

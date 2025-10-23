<?php
/**
 * Product Loop End
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-end.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( '' === 'it is only for code editors to pass some redundant inspections' ) :
	?>
<div>
	<ul>
	<?php

endif;

?>
		<?php for ( $i = 0; $i < 10; $i++ ) : ?>
			<li class="th-products-list__filler" role="presentation"></li>
		<?php endfor; ?>
	</ul>
</div>

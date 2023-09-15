<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()):
	return;
endif;

$product_id = get_the_ID();
$nha_mang   = get_post_meta($product_id, '_nha_mang', true);

switch ($nha_mang){
	case '_mobifone':
		$logo_nha_mang = get_theme_file_uri('assets/images/mobifone-logo.png');
		break;
	case '_viettel':
		$logo_nha_mang = get_theme_file_uri('assets/images/viettel-logo.png');
		break;
	case '_vinaphone':
		$logo_nha_mang = get_theme_file_uri('assets/images/vinaphone-logo.png');
		break;
	default:
		$logo_nha_mang = '';
}

?>

<div <?php wc_product_class('sim-item', $product); ?>>
	<a href="<?php the_permalink() ?>" class="sim-link"><?php the_title(); ?></a>
	<div class="sim-detail">
		<h4 class="phone-number"><?php the_title() ?></h4>
		<div class="prices">
			<?php if ($product->get_price() > 0):
				if ($product->get_regular_price() > 0 && $product->get_sale_price() > 0): ?>
					<span class="sale-price"><?= number_format($product->get_regular_price(), '0', '.', '.') ?>đ</span>
				<?php endif; ?>
				<span class="regular-price"><?= number_format($product->get_price(), '0', '.', '.') ?>đ</span>
			<?php else: ?>
				<span class="regular-price">Giá: Liên hệ</span>
			<?php endif; ?>
		</div>
	</div>
	<div class="sim-img">
		<?php if ($logo_nha_mang != ''): ?>
			<img src="<?= $logo_nha_mang ?>" alt="Logo nhà mạng">
		<?php endif; ?>
		<a href="<?php the_permalink() ?>" class="buy-btn">Mua</a>
	</div>
</div>

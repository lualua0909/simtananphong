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

$product_id       = get_the_ID();
$price            = get_field('_price', $product_id);
$chu_ky           = get_post_meta($product_id, '_chu_ky', true);
$data             = get_post_meta($product_id, '_data', true);
$thoai_noi_mang   = get_post_meta($product_id, '_thoai_noi_mang', true);
$thoai_ngoai_mang = get_post_meta($product_id, '_thoai_ngoai_mang', true);

$nha_mang      = get_post_meta($product_id, '_nha_mang', true);

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

<div <?php wc_product_class('sim-item-2', $product); ?>>
	<div class="item-header">
		<div class="logo">
			<?php if ($logo_nha_mang != ''): ?>
				<img src="<?= $logo_nha_mang ?>" alt="Logo nhà mạng">
			<?php endif; ?>
		</div>
		<div class="discount">
			<?php if ($product->get_regular_price() > 0 && $product->get_sale_price() > 0):
				$percent = round(100 - ((float) $product->get_sale_price() / (float) $product->get_regular_price() * 100)); ?>
				<span class="percent">-<?= $percent ?>%</span>
			<?php endif; ?>
		</div>
	</div>
	<?php the_title('<h4 class="entry-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h4>') ?>
	<div class="product-meta-wrapper">
		<ul class="product-meta">
			<?php if ($chu_ky != ''): ?>
				<li>
					<div class="icon">
						<img src="<?= get_theme_file_uri('assets/images/time-left.png') ?>" alt="">
					</div>
					<?= $chu_ky ?>
				</li>
			<?php endif; ?>

			<?php if ($data != ''): ?>
				<li>
					<div class="icon">
						<img src="<?= get_theme_file_uri('assets/images/cloud.png') ?>" alt="">
					</div>
					<?= $data ?>
				</li>
			<?php endif; ?>

			<?php if ($thoai_noi_mang != ''): ?>
				<li>
					<div class="icon">
						<img src="<?= get_theme_file_uri('assets/images/phone-1.png') ?>" alt="">
					</div>
					<?= $thoai_noi_mang ?>
				</li>
			<?php endif; ?>

			<?php if ($thoai_ngoai_mang != ''): ?>
				<li>
					<div class="icon">
						<img src="<?= get_theme_file_uri('assets/images/phone-1.png') ?>" alt="">
					</div>
					<?= $thoai_ngoai_mang ?>
				</li>
			<?php endif; ?>
		</ul>
	</div>
	<div class="item-bottom">
		<div class="prices">
			<?php if ($product->get_price() > 0): ?>
				<span class="regular-price"><?= number_format($product->get_price(), '0', ',', ',') ?>đ</span>
				<?php if ($product->get_regular_price() > 0 && $product->get_sale_price() > 0): ?>
					<span class="sale-price"><?= number_format($product->get_regular_price(), '0', ',', ',') ?>đ</span>
				<?php endif;
			else: ?>
				<span class="regular-price">Giá: Liên hệ</span>
			<?php endif; ?>
		</div>
		<div class="buy-button">
			<a href="<?= esc_url(get_permalink()) ?>">Mua ngay</a>
		</div>
	</div>
</div>

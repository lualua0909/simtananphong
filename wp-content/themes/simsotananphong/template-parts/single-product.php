<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')):
	exit; // Exit if accessed directly
endif;

?>

<section class="checkout-wrapper">
	<div class="checkout-progress-bar-wrapper">
		<div class="checkout-progress-bar step-1">
			<div class="progress-bar"></div>
			<div class="step step-1">
				<span>Chọn gói cước</span>
			</div>
			<div class="step step-2">
				<span>Thông tin KH</span>
			</div>
			<div class="step step-3">
				<span>Hoàn tất</span>
			</div>
		</div>
	</div>
	<div class="checkout-form-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-12 order-lg-1">
					<div class="product-select">
						<span>Thuê bao đang chọn: </span>
						<h1><?= the_title() ?></h1>
					</div>
				</div>
				<div class="col-lg-4 order-lg-3">
					<?php
					global $product;
					$product_id       = get_the_ID();
					$product          = wc_get_product($product_id);
					$loai_sim         = get_post_meta($product_id, '_loai_sim', true);
					$sim_type         = get_post_meta($product_id, '_type', true);
					$nha_cung_cap     = get_post_meta($product_id, '_nha_cung_cap', true);
					$phone_number     = get_post_meta($product_id, '_phone_number', true);
					$general_settings = get_field('_theme_general_settings', 'option');
					$fee              = $general_settings['_fee'];
					$van_chuyen       = $fee['_phi_van_chuyen'];
					$discount         = $general_settings['_discount'];
					$discount_amount  = $discount['_discount_amount'];
					$discount_type    = $discount['_discount_type'];
					$cart_total_val   = 0;
					$discount_val     = 0;
					$status           = 'Đang giữ số';
					$api_packages     = [];

					if ($sim_type == 'sim' && $nha_cung_cap == '_kho_chon_so'):
						$msisdn_detail = _n_api_msisdn_detail($phone_number);

						if ($msisdn_detail->code == 1):
							$status       = $msisdn_detail->data->items[0]->statusStr;
							$api_packages = $msisdn_detail->data->items[0]->packages;
						endif;
					endif;
							
					$sim_price = (float) $product->get_price();
					$subtotal  = $sim_price + (float) $van_chuyen;

					if ($discount_amount != ''):
						if ($discount_type == 'percent'):
							$cart_total_val = $sim_price - ($discount_amount * $sim_price / 100);
						else:
							$cart_total_val = $sim_price - (float) $discount_amount;
						endif;

						$discount_val = $sim_price - $cart_total_val;
					endif;

					$cart_total = $subtotal - $discount_val;

					$nha_mang = get_post_meta($product_id, '_nha_mang', true);

					switch ($nha_mang){
						case '_mobifone':
							$background_nha_mang = get_theme_file_uri('assets/images/mobifone-bg.png');
							break;
						case '_viettel':
							$background_nha_mang = get_theme_file_uri('assets/images/viettel-bg.png');
							break;
						case '_vinaphone':
							$background_nha_mang = get_theme_file_uri('assets/images/vinaphone-bg.png');
							break;
						default:
							$background_nha_mang = '';
					}

					?>
					<form action="" id="order-form" class="mb-4">
						<aside class="checkout-sidebar">
							<div class="sim-card-wrapper">
								<div class="sim-card">
									<?php if ($background_nha_mang != ''): ?>
										<img src="<?= $background_nha_mang ?>" alt="Background nhà mạng">
									<?php endif; ?>
								</div>
								<div class="sim-info">
									<h5 class="phone-number"><?php the_title() ?></h5>
									<p class="sim-type"><?= $loai_sim == '_tra_truoc' ? 'Sim trả trước' : 'Sim trả sau' ?></p>
								</div>
							</div>
							<table>
								<tbody>
								<tr>
									<td>Số thuê bao</td>
									<td class="phone-number"><?php the_title() ?></td>
								</tr>
								<?php if ($sim_type == 'sim' && $nha_cung_cap == '_kho_chon_so' && $status != ''): ?>
									<tr>
										<td>Trạng thái</td>
										<td class="status"><?= $status == 'Trong kho' ? 'Còn hàng' : 'Đã bán' ?></td>
									</tr>
								<?php endif; ?>
								<tr>
									<td>Loại thuê bao</td>
									<td class="sim-type"><?= $loai_sim == '_tra_truoc' ? 'Sim trả trước' : 'Sim trả sau' ?></td>
								</tr>
								<?php if ($product->get_price()): ?>
									<tr>
										<td>Giá sim</td>
										<td class="product-price" data-price="<?= $product->get_price() ?>"><?= number_format($product->get_price(), '0', '.', '.') ?> vnđ</td>
									</tr>
								<?php endif; ?>
								<?php if ($sim_type == 'sim_super_data'): ?>
									<tr class="sim-quantity">
										<td>Số lượng</td>
										<td>
											<input type="number" value="1" name="product_quantity" aria-label="Số lượng" min="1">
										</td>
									</tr>
								<?php endif; ?>
								<tr class="data-package">
									<td>Giá gói cước</td>
									<td class="price">0 vnđ</td>
								</tr>
								<tr class="shipping">
									<td>Phí vận chuyển <br> <span>(Miễn phí khi mua 2 sim)</span></td>
									<td><?= number_format($van_chuyen, '0', '.', '.') ?> vnđ</td>
								</tr>
								<tr class="subtotal">
									<td>Tổng cộng</td>
									<td><?= number_format($subtotal, '0', '.', '.') ?> vnđ</td>
								</tr>
								<tr class="discount">
									<td>Giảm giá</td>
									<td>-<?= number_format($discount_val, '0', '.', '.') ?> vnđ</td>
								</tr>
								<tr class="total">
									<td>Tổng thanh toán</td>
									<td class="cart-total" data-cart-subtotal="<?= $cart_total ?>" data-cart-total="<?= $cart_total ?>"><?= number_format($cart_total, '0', '.', '.') ?> vnđ</td>
								</tr>
								</tbody>
							</table>
						</aside>

						<input type="hidden" name="product_sim" value="<?= get_the_ID() ?>">
						<input type="hidden" name="product_data" value="">
						<?php if ($sim_type == 'sim' && $nha_cung_cap == '_kho_chon_so' && $status != 'Đang giữ số'): ?>
							<button type="submit" class="checkout-button">Đặt giữ số</button>
						<?php elseif ($sim_type == 'package' || $nha_cung_cap != '_kho_chon_so'): ?>
							<button type="submit" class="checkout-button">Đặt giữ số</button>
						<?php endif; ?>
						<a href="<?= esc_url(home_url('/')); ?>" class="checkout-return">Quay lại</a>
					</form>
				</div>
				<div class="col-lg-8 order-lg-2">
					<?php
					$general_settings = get_field('_theme_general_settings', 'option');
					$package_rule     = $general_settings['_package_rule'];
					$package          = get_post_meta($product_id, '_goi_cuoc', true);
					$packages         = [];
					$package_id       = 0;
					$package_ids      = [];

					if (is_array($package)):
						if (!empty($package)):
							foreach ($package as $package_item):
								$query = new WP_Query(
									[
										'post_type'              => 'product',
										'title'                  => $package_item,
										'posts_per_page'         => 1,
										'no_found_rows'          => true,
										'ignore_sticky_posts'    => true,
										'update_post_term_cache' => false,
										'update_post_meta_cache' => false,
										'meta_query'             => [
											'relation' => 'AND',
											[
												'key'     => '_type',
												'value'   => 'package',
												'compare' => '=',
											],
										]
									]
								);

								if (!empty($query->post)):
									$fetched_page = $query->post;
									$package_id   = $fetched_page->ID;
									array_push($package_ids, $package_id);
								endif;

								wp_reset_query();
							endforeach;
						endif;

						$args = [
							'post_type'      => 'product',
							'posts_per_page' => - 1,
							'post__in'       => $package_ids,
							'meta_query'     => [
								'relation' => 'AND',
								[
									'key'     => '_type',
									'value'   => 'package',
									'compare' => '=',
								],
							]
						];
					else:
						$query = new WP_Query(
							[
								'post_type'              => 'product',
								'title'                  => $package,
								'posts_per_page'         => 1,
								'no_found_rows'          => true,
								'ignore_sticky_posts'    => true,
								'update_post_term_cache' => false,
								'update_post_meta_cache' => false,
								'meta_query'             => [
									'relation' => 'AND',
									[
										'key'     => '_type',
										'value'   => 'package',
										'compare' => '=',
									],
								]
							]
						);

						if (!empty($query->post)):
							$fetched_page = $query->post;
							$package_id   = $fetched_page->ID;
						endif;

						wp_reset_query();

						if (!empty($package_rule)):
							foreach ($package_rule as $package_rule_item):
								if ($package_rule_item["_main_package"] === $package_id):
									$sub_packages = $package_rule_item["_sub_packages"];
									array_push($packages, $package_id);
									$packages = array_unique(array_merge($packages, $sub_packages));
								endif;
							endforeach;
						endif;

						if (!empty($packages) && $loai_sim == "_tra_sau"):
							$args = [
								'post_type'      => 'product',
								'posts_per_page' => - 1,
								'post__in'       => $packages,
								'meta_query'     => [
									'relation' => 'AND',
									[
										'key'     => '_type',
										'value'   => 'package',
										'compare' => '=',
									],
									[
										'key'     => '_loai_sim',
										'value'   => $loai_sim,
										'compare' => '=',
									],
								]
							];
						elseif ($nha_cung_cap === '_kho_chon_so'):
							if (!empty($api_packages)):
								$packages_name = [];
								foreach ($api_packages as $api_package):
									array_push($packages_name, $api_package->packageName);
								endforeach;

								$args = [
									'post_type'      => 'product',
									'posts_per_page' => - 1,
									'meta_query'     => [
										'relation' => 'AND',
										[
											'key'     => '_type',
											'value'   => 'package',
											'compare' => '=',
										],
										[
											'key'     => '_package_name',
											'value'   => $packages_name,
											'compare' => 'IN',
										],
										[
											'key'     => '_loai_sim',
											'value'   => $loai_sim,
											'compare' => '=',
										],
									]
								];
							endif;
						else:
							$args = [
								'post_type'      => 'product',
								'posts_per_page' => - 1,
								'meta_query'     => [
									'relation' => 'AND',
									[
										'key'     => '_type',
										'value'   => 'package',
										'compare' => '=',
									],
									[
										'key'     => '_loai_sim',
										'value'   => $loai_sim,
										'compare' => '=',
									],
								]
							];
						endif;
					endif;

					$loop = new WP_Query($args);

					if ($loop->have_posts()): ?>
						<div class="package-title">
							<?php if ($loai_sim == '_tra_sau'):
								echo 'Gói cước xài kèm sim';
							else:
								echo 'Gói cước có thể đăng ký';
							endif; ?>
						</div>
						<div class="packages-wrap">
							<?php
							while ($loop->have_posts()) : $loop->the_post();
								global $product; ?>
								<div class="package">
									<table>
										<tbody>
										<tr>
											<td class="package-name">Tên gói</td>
											<td class="package-code"><?php the_title() ?></td>
											<td rowspan="3" class="package-select">
												<label class="radio-button">
													<input type="radio" class="radio-button-input" data-id="<?= get_the_ID() ?>" name="data" value="<?= get_the_ID() ?>" data-price="<?= $product->get_price() ?>">
													<span class="radio-button-control"></span>
												</label>
											</td>
										</tr>
										<tr>
											<td>Giá gói</td>
											<td><?= number_format($product->get_price(), '0', '.', '.') ?>đ/30 ngày</td>
										</tr>
										<tr>
											<td class="endow">Ưu đãi</td>
											<td>
												<div class="entry-content">
													<?php the_content(); ?>
												</div>
											</td>
										</tr>
										</tbody>
									</table>
								</div>
							<?php endwhile;
							wp_reset_postdata(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>

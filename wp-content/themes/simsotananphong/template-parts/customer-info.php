<?php

if (isset($_GET['_wpnonce']) && isset($_GET['order_id'])):
	$nonce = $_GET['_wpnonce'];
	$order_id = $_GET['order_id'];

	if (wp_verify_nonce($nonce, 'customer_info')):
		$general_settings = get_field('_theme_general_settings', 'option');
		$branch = $general_settings['_branch'];
		?>
		<section class="checkout-wrapper">
			<div class="checkout-progress-bar-wrapper">
				<div class="checkout-progress-bar step-2">
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
			<div class="desc">
				<p>Mọi thông tin của bạn phục vụ cho mục đích hòa mạng sim, cam kết bảo mật</p>
			</div>
			<div class="shipping-form-wrapper">
				<form action="" class="shipping-form" id="shipping-form">
					<div class="container">
						<div class="row">
							<div class="col-lg-6 order-lg-1">
								<div class="form-field">
									<label class="form-label">Họ tên của bạn</label>
									<input type="text" class="form-control" name="name">
								</div>
								<div class="form-field">
									<label class="form-label">Số điện thoại</label>
									<input type="text" class="form-control" name="phone">
								</div>
								<div class="form-field">
									<h3 class="field-title">Hình thức nhận hàng</h3>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="delivery-method" id="delivery-method-1" value="delivery-method-1" checked>
										<label class="form-check-label" for="delivery-method-1">Nhận tại cửa hàng</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="delivery-method" id="delivery-method-2" value="delivery-method-2">
										<label class="form-check-label" for="delivery-method-2">Nhận hàng tại nhà</label>
									</div>
								</div>
								<div class="branch-select">
									<?php if ($branch):
										foreach ($branch as $branch_item):?>
											<label>
												<input type="radio" name="branch" value="<?= $branch_item['_branch_name'] ?>" data-lat="<?= $branch_item['_location_map']['lat'] ?>" data-lng="<?= $branch_item['_location_map']['lng'] ?>" data-branch-name="<?= $branch_item['_branch_name'] ?>">
												<div class="branch-content">
													<h3 class="branch-name"><?= $branch_item['_branch_name'] ?></h3>
													<p class="branch-address"><?= $branch_item['_branch_address'] ?></p>
												</div>
											</label>
										<?php endforeach;
									endif; ?>
								</div>
								<div class="address-input">
									<div class="form-field">
										<label class="form-label">Tỉnh/Thành Phố</label>
										<select class="form-select" aria-label="" name="province" id="province">
											<option value="" selected>Vui lòng chọn</option>
											<?php $province = _n_get_config('province');
											if ($province):
												foreach ($province as $province_item):?>
													<option value="<?= $province_item['code'] ?>"><?= $province_item['name'] ?></option>
												<?php endforeach;
											endif; ?>
										</select>
									</div>
									<div class="form-field">
										<label class="form-label">Quận huyện</label>
										<select class="form-select" aria-label="" name="district" id="district">
											<option value="" selected>Vui lòng chọn</option>
										</select>
									</div>
									<div class="form-field">
										<label class="form-label">Phường xã</label>
										<select class="form-select" aria-label="" name="wards" id="wards">
											<option value="" selected>Vui lòng chọn</option>
										</select>
									</div>
									<div class="form-field">
										<label class="form-label">Số nhà, tên đường</label>
										<input type="text" class="form-control" placeholder="Vui lòng nhập" name="address">
									</div>
								</div>
								<div class="form-field">
									<label class="form-label">Ghi chú</label>
									<input type="text" class="form-control" name="note">
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="yes" id="owner" name="owner">
									<label class="form-check-label" for="owner">
										Tôi muốn đăng ký chính chủ
									</label>
								</div>
							</div>
							<div class="col-lg-12 order-lg-3">
								<div class="buttons-wrapper">
									<a href="<?= esc_url(home_url('/')); ?>" class="checkout-return">Quay lại</a>
									<button type="submit" class="checkout-button">Đặt hàng</button>
									<input type="hidden" name="order" value="<?= $order_id ?>">
								</div>
							</div>
							<div class="col-lg-6 order-lg-2">
								<div class="maps-wrapper">
									<div id="shipping-map"></div>
									<input type="hidden" id="lat" name="lat" value="0" hidden>
									<input type="hidden" id="lng" name="lng" value="0" hidden>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</section>
	<?php else: ?>
		<div class="container pt-3 pb-3">
			<div class="alert alert-primary" role="alert">
				Bạn không được phép truy cập trang này, <a href="<?= esc_url(home_url('/')); ?>" class="alert-link">về trang chủ</a>!
			</div>
		</div>
	<?php endif;
else: ?>
	<div class="container pt-3 pb-3">
		<div class="alert alert-primary" role="alert">
			Bạn không được phép truy cập trang này, <a href="<?= esc_url(home_url('/')); ?>" class="alert-link">về trang chủ</a>!
		</div>
	</div>
<?php endif;

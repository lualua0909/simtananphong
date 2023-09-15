<?php

if (isset($_GET['_wpnonce']) && isset($_GET['order_id'])):
	$nonce = $_GET['_wpnonce'];
	$order_id = $_GET['order_id'];

	if (wp_verify_nonce($nonce, 'owner_register')): ?>
		<section class="page-wrapper register-wrapper">
			<div class="container">
				<h1 class="page-title">Đăng ký chính chủ</h1>
				<div class="desc">
					<p>Chỉ một vài thao tác giúp bạn đăng ký chính chủ nhanh chóng, thuận tiện</p>
				</div>
				<div class="link-wrapper">
					<a href="javascript:;" class="tutorial-link" data-bs-toggle="modal" data-bs-target="#tutorialModal">Xem hướng dẫn</a>
				</div>

				<div class="kyc-form-wrapper">
					<form action="" class="kyc-form" id="kyc-form">
						<div class="row">
							<div class="col-lg-6 file-upload">
								<label>
									<span class="image-remove">x</span>
									<input type="file" accept="image/*" id="id-front" name="id_front">
									<img src="#" alt="" class="preview">
									<h3 class="upload-title">Thêm CMND/CCCD mặt trước</h3>
									<p class="upload-desc">Định dạng: jpg, png.</p>
								</label>
							</div>
							<div class="col-lg-6 file-upload">
								<label>
									<span class="image-remove">x</span>
									<input type="file" accept="image/*" id="id-back" name="id_back">
									<img src="#" alt="" class="preview">
									<h3 class="upload-title">Thêm CMND/CCCD mặt sau</h3>
									<p class="upload-desc">Định dạng: jpg, png.</p>
								</label>
							</div>
							<div class="col-lg-6 file-upload">
								<label>
									<span class="image-remove">x</span>
									<input type="file" accept="image/*" id="portrait" name="portrait">
									<img src="#" alt="" class="preview">
									<h3 class="upload-title">Thêm ảnh chân dung</h3>
									<p class="upload-desc">Định dạng: jpg, png.</p>
								</label>
							</div>
							<div class="col-lg-6 file-upload">
								<label>
									<span class="image-remove">x</span>
									<input type="file" accept="video/mp4,video/x-m4v,video/*" id="short-clip" name="short_clip">
									<video width="400" controls class="preview">
										<source src="" id="video_here">
									</video>
									<h3 class="upload-title">Thêm clip ngắn (10s)</h3>
									<p class="upload-desc">Định dạng: .mp4</p>
								</label>
							</div>
						</div>
						<div class="buttons-wrapper">
							<input type="hidden" name="order" value="<?= $order_id ?>">
							<button type="submit" class="checkout-button">Đăng ký</button>
						</div>
					</form>
				</div>
			</div>
		</section>

		<div class="modal fade" id="tutorialModal" tabindex="-1" aria-labelledby="tutorialModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<h2 class="title">Để hình ảnh rõ ràng, bạn thực hiện theo hướng dẫn sau đây:</h2>
					<img src="<?= get_theme_file_uri('assets/images/tutorial-1.png') ?>" alt="">
					<img src="<?= get_theme_file_uri('assets/images/tutorial-2.png') ?>" alt="">
					<h2 class="title">Quý khách vui lòng quay video khuôn mặt như video dưới đây</h2>
					<video controls>
						<source src="<?= get_theme_file_uri('assets/images/short-clip.mp4') ?>" type="video/mp4">
						<source src="<?= get_theme_file_uri('assets/images/short-clip.mp4') ?>" type="video/ogg">
						Your browser does not support the video tag.
					</video>
					<a class="close-modal checkout-return" data-bs-dismiss="modal">Đóng lại</a>
				</div>
			</div>
		</div>
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

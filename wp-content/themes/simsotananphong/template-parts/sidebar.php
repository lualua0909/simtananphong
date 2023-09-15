<?php

$general_settings = get_field('_theme_general_settings', 'option');
$sidebar          = $general_settings['_sidebar'];

?>
<aside class="primary-sidebar">
	<div class="card">
		<div class="card-body">
			<form class="sim-filter-form" id="sim-filter-form" action="<?php echo home_url('/'); ?>">
				<input type="hidden" name="post_type" value="product">
				<input type="hidden" name="action" value="advanced_search">
				<div class="row">
					<div class="col-6">
						<input type="text" class="form-control" name="s" aria-describedby="" placeholder="Nhập số cần tìm" aria-label="Tìm kiếm sim" value="<?= $_GET['s'] ?? '' ?>">
					</div>
					<div class="col-6">
						<button type="submit" class="btn btn-primary">Tìm kiếm</button>
					</div>
					<div class="col-12">
						<div class="sidebar-note">
							<ul>
								<li>Tìm sim có số <strong>858</strong> bạn hãy gõ <strong><sup>*</sup>858<sup>*</sup></strong></li>
								<li>Tìm sim có đầu <strong>090</strong> đuôi <strong>858</strong> bạn hãy gõ <strong>090<sup>*</sup>858</strong></li>
								<li>Tìm sim bắt đầu bằng <strong>0903</strong> đuôi bất kỳ, hãy gõ <strong>0903<sup>*</sup></strong></li>
							</ul>
						</div>
					</div>
					<div class="col-6">
						<?php $nha_mang = _n_get_config('nha-mang');
						if (!empty($nha_mang)): ?>
							<select class="form-select" aria-label="Chọn nhà mạng" name="nha_mang">
								<option value="" selected>- Nhà mạng -</option>
								<?php foreach ($nha_mang as $key => $value): ?>
									<option value="<?= $key ?>" <?= isset($_GET['nha_mang']) && $_GET['nha_mang'] == $key ? 'selected' : '' ?>><?= $value['name'] ?></option>
								<?php endforeach; ?>
							</select>
						<?php endif; ?>
					</div>
					<div class="col-6">
						<?php $cam_ket = [
							"CK150" => "CK150",
							"CK250" => "CK250",
							"CK300" => "CK300",
						]; ?>
						<select class="form-select" aria-label="Mức cam kết" name="cam_ket">
							<option value="" selected>- Mức cam kết -</option>
							<?php foreach ($cam_ket as $cam_ket_key => $cam_ket_item): ?>
								<option value="<?= $cam_ket_key ?>" <?= isset($_GET['cam_ket']) && $_GET['cam_ket'] == $cam_ket_key ? 'selected' : '' ?>><?= $cam_ket_item ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-6">
						<?php $dau_so = ['09', '07', '08', '03', '090', '093', '077', '070', '079', '078', '073', '076', '089']; ?>
						<select class="form-select" aria-label="Chọn đầu số" name="dau_so">
							<option value="" selected>- Đầu số -</option>
							<?php foreach ($dau_so as $dau_so_item): ?>
								<option value="<?= $dau_so_item ?>" <?= isset($_GET['dau_so']) && $_GET['dau_so'] == $dau_so_item ? 'selected' : '' ?>>Đầu số <?= $dau_so_item ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-6">
						<?php $phan_loai = _n_get_config('phan-loai');
						if (!empty($phan_loai)): ?>
							<select class="form-select" aria-label="Chọn loại sim" name="phan_loai">
								<option value="" selected>- Loại sim -</option>
								<?php foreach ($phan_loai as $key => $value): ?>
									<option value="<?= $key ?>" <?= isset($_GET['phan_loai']) && $_GET['phan_loai'] == $key ? 'selected' : '' ?>><?= $value ?></option>
								<?php endforeach; ?>
							</select>
						<?php endif; ?>
					</div>
					<div class="col-6">
						<?php $price_range = [
							"99"     => "Sim 99k",
							"199"    => "Sim 199k",
							"299"    => "Sim 299k",
							"less-1" => "Sim < 1 triệu",
							"1-3"    => "Sim 1 triệu - 3 triệu",
							"3-5"    => "Sim 3 triệu - 5 triệu",
							"more-5" => "Sim > 5 triệu",
						]; ?>
						<select class="form-select" aria-label="Mức giá" name="gia">
							<option value="" selected>- Giá -</option>
							<?php foreach ($price_range as $price_range_key => $price_range_item): ?>
								<option value="<?= $price_range_key ?>" <?= isset($_GET['gia']) && $_GET['gia'] == $price_range_key ? 'selected' : '' ?>><?= $price_range_item ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-6">
						<select class="form-select" aria-label="Chọn tổng nút" name="tong_nut">
							<option value="-1" selected>- Tổng nút -</option>
							<?php for ($i = 0; $i <= 9; $i ++): ?>
								<option value="<?= $i ?>" <?= isset($_GET['tong_nut']) && $_GET['tong_nut'] == $i ? 'selected' : '' ?>><?= $i ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<?php $loai_sim = _n_get_config('loai-sim');
					if (!empty($loai_sim)):
						foreach ($loai_sim as $key => $value): ?>
							<div class="col-6">
								<div class="form-check form-check-inline">
									<input class="form-check-input not-contain-number" type="checkbox" value="yes" name="<?= $key ?>" id="<?= $key ?>" <?= isset($_GET[$key]) && $_GET[$key] == 'yes' ? 'checked' : '' ?>>
									<label for="<?= $key ?>" class="form-check-label"><?= $value['name'] ?></label>
								</div>
							</div>
						<?php endforeach;
					endif; ?>
					<div class="col-12">
						<h4 class="form-title">Không gồm số</h4>
					</div>
					<div class="col-lg-12 form-check-wrapper">
						<?php for ($i = 0; $i <= 9; $i ++): ?>
							<div class="form-check form-check-inline">
								<input class="form-check-input not-contain-number" type="checkbox" value="yes" name="khong_chua_so_<?= $i ?>" id="khong_chua_so_<?= $i ?>" <?= isset($_GET['khong_chua_so_' . $i]) && $_GET['khong_chua_so_' . $i] == 'yes' ? 'checked' : '' ?>>
								<label for="khong_chua_so_<?= $i ?>" class="form-check-label"><?= $i ?></label>
							</div>
						<?php endfor; ?>
					</div>
					<div class="col-12">
						<h4 class="form-title">Tìm theo dạng</h4>
					</div>
					<?php $dang_sim = _n_get_config('dang-sim');
					if (!empty($dang_sim)): ?>
						<div class="col-lg-12 form-check-2-wrapper">
							<?php foreach ($dang_sim as $key => $value): ?>
								<div class="form-check form-check-inline">
									<input class="form-check-input sim-format" type="checkbox" value="yes" name="<?= $key ?>" id="<?= $key ?>" <?= isset($_GET[$key]) && $_GET[$key] == 'yes' ? 'checked' : '' ?>>
									<label class="form-check-label" for="<?= $key ?>"><?= $value ?></label>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="row">
					<div class="col-6">
						<h4 class="form-title">Sim năm sinh</h4>
					</div>
					<div class="col-6">
						<select class="form-select" aria-label="Chọn năm" name="nam">
							<option value="" selected>- Chọn năm sinh -</option>
							<?php for ($i = 1975; $i <= 2023; $i ++): ?>
								<option value="<?= $i ?>" <?= isset($_GET['nam']) && $_GET['nam'] == $i ? 'selected' : '' ?>><?= $i ?></option>
							<?php endfor; ?>
						</select>
					</div>
				</div>
			</form>

			<div class="fb-page" data-href="<?= $sidebar['_fanpage'] ?>" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
				<blockquote cite="<?= $sidebar['_fanpage'] ?>" class="fb-xfbml-parse-ignore"><a href="<?= $sidebar['_fanpage'] ?>">Facebook</a></blockquote>
			</div>
		</div>
	</div>
</aside>

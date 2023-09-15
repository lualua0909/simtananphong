<div class="wrap">
	<h2>Báo cáo</h2>
	<form method="POST" enctype="multipart/form-data" id="sim-super-data-report-form" class="sim-report">
		<div class="datepicker-wrapper">
			<div class="datepicker-control">
				<label for="date_start">Từ ngày</label>
				<input type="date" name="date_start" aria-label="Từ ngày">
			</div>
			<div class="datepicker-control">
				<label for="date_end">Đến ngày</label>
				<input type="date" name="date_end" aria-label="Đến ngày">
			</div>
			<div class="product-filter">
				<?php $nha_mang = _n_get_config('nha-mang');
				if (!empty($nha_mang)): ?>
					<select class="form-select" aria-label="Chọn nhà mạng" name="nha_mang">
						<option value="" selected>- Nhà mạng -</option>
						<?php foreach ($nha_mang as $key => $value): ?>
							<option value="<?= $key ?>" <?= isset($_GET['nha_mang']) && $_GET['nha_mang'] == $key ? 'selected' : '' ?>><?= $value['name'] ?></option>
						<?php endforeach; ?>
					</select>
				<?php endif; ?>

				<?php $nha_cung_cap = _n_get_config('nha-cung-cap');
				if (!empty($nha_cung_cap)): ?>
					<select class="form-select" aria-label="Chọn nhà cung cấp" name="nha_cung_cap">
						<option value="" selected>- Nhà cung cấp -</option>
						<?php foreach ($nha_cung_cap as $key => $value): ?>
							<option value="<?= $key ?>" <?= isset($_GET['nha_cung_cap']) && $_GET['nha_cung_cap'] == $key ? 'selected' : '' ?>><?= $value['name'] ?></option>
						<?php endforeach; ?>
					</select>
				<?php endif; ?>
			</div>
			<div class="datepicker-button-control">
				<button type="submit" class="button">Đi</button>
			</div>
		</div>
	</form>
	<div id="sim-report-table-wrapper"></div>
</div>

<script>
	jQuery(function ($) {
		$(document).on('click', '#exportBtn', function () {
			$("#sim-report-table").table2excel({
				exclude: ".no-export",
				filename: "sim-sieu-datareport"
			});
		});
	});
</script>

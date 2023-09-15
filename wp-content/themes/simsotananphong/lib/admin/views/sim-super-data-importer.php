<div class="wrap">
	<h2>Tải file excel sim siêu data</h2>
	<form method="POST" enctype="multipart/form-data" id="sim-super-data-importer-form">
		<table class="form-table">
			<tbody>
			<tr>
				<th scope="row"><label for="file">Chọn tệp Excel:</label></th>
				<td><input type="file" id="file" name="file" accept=".xlsx,.xls"></td>
			</tr>
			<?php $nha_mang = _n_get_config('nha-mang');
			if (!empty($nha_mang)): ?>
				<tr>
					<th scope="row"><label for="nha_mang">Nhà mạng:</label></th>
					<td>
						<select name="nha_mang" id="nha_mang">
							<?php foreach ($nha_mang as $key => $value): ?>
								<option value="<?= $key ?>"><?= $value['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
			<?php endif; ?>

			<?php $nha_cung_cap = _n_get_config('nha-cung-cap');
			if (!empty($nha_cung_cap)): ?>
				<tr>
					<th scope="row"><label for="nha_cung_cap">Nhà cung cấp:</label></th>
					<td>
						<select name="nha_cung_cap" id="nha_cung_cap">
							<?php foreach ($nha_cung_cap as $key => $value): ?>
								<option value="<?= $key ?>"><?= $value['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
		<div class="statusBar-wrapper" style="display: none">
			<p>Đang thực hiện, vui lòng không đóng trang này!</p>
			<div class="statusBar"></div>
		</div>
		<p id="import-results"></p>
		<p class="submit">
			<input type="submit" name="submit" value="Nhập" class="button button-primary">
		</p>
	</form>
</div>

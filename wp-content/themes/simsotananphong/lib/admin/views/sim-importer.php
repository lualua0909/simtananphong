<div class="wrap">
	<h2>Tải file excel sim</h2>
	<form method="POST" enctype="multipart/form-data" id="sim-importer-form">
		<table class="form-table">
			<tbody>
			<tr>
				<th scope="row"><label for="file">Chọn tệp Excel:</label></th>
				<td><input type="file" id="file" name="file" accept=".xlsx,.xls"></td>
			</tr>
			<tr>
				<th scope="row"><label for="dang_file">Dạng file:</label></th>
				<td>
					<select name="dang_file" id="dang_file">
						<option value="dang_1">Dạng 1: Nhập giá bán</option>
						<option value="dang_2">Dạng 2: Đã có giá bán</option>
						<option value="dang_3">Dạng 3: Nhập chiết khấu</option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="dang_sim">Dạng sim:</label></th>
				<td>
					<select name="dang_sim" id="dang_sim">
						<option value="sim_thuong">Sim thường</option>
						<option value="sim_top">Sim top</option>
						<option value="sim_livestream">Sim LIVESTREAM</option>
						<option value="sim_tang">Tặng SIM</option>
					</select>
				</td>
			</tr>
			<?php $loai_sim = _n_get_config('loai-sim');
			if (!empty($loai_sim)): ?>
				<tr>
					<th scope="row"><label for="loai_sim">Loại sim:</label></th>
					<td>
						<select name="loai_sim" id="loai_sim">
							<?php foreach ($loai_sim as $key => $value): ?>
								<option value="<?= $key ?>"><?= $value['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
			<?php endif; ?>

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
			<tr>
				<th scope="row"><label for="gia">Giá:</label></th>
				<td><input type="number" id="gia" name="gia"></td>
			</tr>
			<tr>
				<th scope="row"><label for="chiet_khau_toan_file">Chiết khấu toàn file (%):</label></th>
				<td><input type="number" id="chiet_khau_toan_file" name="chiet_khau_toan_file" placeholder="VD: 10%"></td>
			</tr>
			<tr>
				<th scope="row"><label for="chiet_khau_toan_file_truc_tiep">Chiết khấu toàn file (VND):</label></th>
				<td><input type="number" id="chiet_khau_toan_file_truc_tiep" name="chiet_khau_toan_file_truc_tiep" placeholder="VD: 10000"></td>
			</tr>
			<tr>
				<th scope="row"><label>Chiết khấu thao khoảng giá (%):</label></th>
				<td>
					<p>
						<input type="number" id="chiet_khau_theo_khoang_gia_gia_tu[]" name="chiet_khau_theo_khoang_gia_gia_tu[]" placeholder="Giá từ" aria-label="">
						<input type="number" id="chiet_khau_theo_khoang_gia_gia_den[]" name="chiet_khau_theo_khoang_gia_gia_den[]" placeholder="Giá đến" aria-label="">
						<input type="number" id="chiet_khau_theo_khoang_gia[]" name="chiet_khau_theo_khoang_gia[]" placeholder="Mức chiết khấu (%)" aria-label="">
					</p>
					<p>
						<input type="number" id="chiet_khau_theo_khoang_gia_gia_tu[]" name="chiet_khau_theo_khoang_gia_gia_tu[]" placeholder="Giá từ" aria-label="">
						<input type="number" id="chiet_khau_theo_khoang_gia_gia_den[]" name="chiet_khau_theo_khoang_gia_gia_den[]" placeholder="Giá đến" aria-label="">
						<input type="number" id="chiet_khau_theo_khoang_gia[]" name="chiet_khau_theo_khoang_gia[]" placeholder="Mức chiết khấu (%)" aria-label="">
					</p>
					<p>
						<input type="number" id="chiet_khau_theo_khoang_gia_gia_tu[]" name="chiet_khau_theo_khoang_gia_gia_tu[]" placeholder="Giá từ" aria-label="">
						<input type="number" id="chiet_khau_theo_khoang_gia_gia_den[]" name="chiet_khau_theo_khoang_gia_gia_den[]" placeholder="Giá đến" aria-label="">
						<input type="number" id="chiet_khau_theo_khoang_gia[]" name="chiet_khau_theo_khoang_gia[]" placeholder="Mức chiết khấu (%)" aria-label="">
					</p>
					<p>
						<input type="number" id="chiet_khau_theo_khoang_gia_gia_tu[]" name="chiet_khau_theo_khoang_gia_gia_tu[]" placeholder="Giá từ" aria-label="">
						<input type="number" id="chiet_khau_theo_khoang_gia_gia_den[]" name="chiet_khau_theo_khoang_gia_gia_den[]" placeholder="Giá đến" aria-label="">
						<input type="number" id="chiet_khau_theo_khoang_gia[]" name="chiet_khau_theo_khoang_gia[]" placeholder="Mức chiết khấu (%)" aria-label="">
					</p>
					<p>
						<input type="number" id="chiet_khau_theo_khoang_gia_gia_tu[]" name="chiet_khau_theo_khoang_gia_gia_tu[]" placeholder="Giá từ" aria-label="">
						<input type="number" id="chiet_khau_theo_khoang_gia_gia_den[]" name="chiet_khau_theo_khoang_gia_gia_den[]" placeholder="Giá đến" aria-label="">
						<input type="number" id="chiet_khau_theo_khoang_gia[]" name="chiet_khau_theo_khoang_gia[]" placeholder="Mức chiết khấu (%)" aria-label="">
					</p>
					<p>
						<input type="number" id="chiet_khau_theo_khoang_gia_gia_tu[]" name="chiet_khau_theo_khoang_gia_gia_tu[]" placeholder="Giá từ" aria-label="">
						<input type="number" id="chiet_khau_theo_khoang_gia_gia_den[]" name="chiet_khau_theo_khoang_gia_gia_den[]" placeholder="Giá đến" aria-label="">
						<input type="number" id="chiet_khau_theo_khoang_gia[]" name="chiet_khau_theo_khoang_gia[]" placeholder="Mức chiết khấu (%)" aria-label="">
					</p>
				</td>
			</tr>
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

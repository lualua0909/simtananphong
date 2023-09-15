<div class="wrap">
	<h2>Nhập giá cho API</h2>
	<form method="POST" enctype="multipart/form-data" id="api-sim-importer-form">
		<table class="form-table">
			<tbody>
			<tr>
				<th scope="row"><label for="loai_sim">Loại sim:</label></th>
				<td>
					<select name="loai_sim" id="loai_sim">
						<option value="0">Trả trước</option>
						<option value="1">Trả sau</option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="api_gia_tra_truoc">Giá trả trước:</label></th>
				<td><input type="number" id="api_gia_tra_truoc" name="api_gia_tra_truoc" value="<?= get_option('_api_gia_tra_truoc') ?>"></td>
			</tr>
			<tr>
				<th scope="row"><label for="api_gia_tra_truoc_kem_goi">Giá trả trước kèm gói:</label></th>
				<td><input type="number" id="api_gia_tra_truoc_kem_goi" name="api_gia_tra_truoc_kem_goi" value="<?= get_option('_api_gia_tra_truoc_kem_goi') ?>"></td>
			</tr>
			<tr>
				<th scope="row"><label for="api_gia_tra_sau">Giá trả sau:</label></th>
				<td><input type="number" id="api_gia_tra_sau" name="api_gia_tra_sau" value="<?= get_option('_api_gia_tra_sau') ?>"></td>
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

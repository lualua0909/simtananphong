<div class="wrap">
	<h2>Tải file excel gói cước</h2>
	<form method="POST" enctype="multipart/form-data" id="package-importer-form">
		<table class="form-table">
			<tbody>
			<tr>
				<th scope="row"><label for="file">Chọn tệp Excel:</label></th>
				<td><input type="file" id="file" name="file" accept=".xlsx,.xls"></td>
			</tr>
			<tr>
				<th scope="row"><label for="loai_sim">Loại sim:</label></th>
				<td>
					<select name="loai_sim" id="loai_sim">
						<option value="_tra_truoc">Trả trước</option>
						<option value="_tra_truoc">Trả sau</option>
					</select>
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

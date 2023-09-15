<div class="sim-search-form-wrapper">
	<form action="<?php echo home_url('/'); ?>" class="sim-search-form">
		<div class="row">
			<div class="col-lg-8 col-md-9 col-7 keyword">
				<input type="text" class="form-control" name="s" aria-describedby="" placeholder="Nhập số cần tìm" aria-label="Tìm kiếm sim" value="<?= $_GET['s'] ?? '' ?>">
			</div>
			<div class="col-lg-4 col-md-3 col-5">
				<button type="submit" class="btn btn-primary">Tìm kiếm</button>
			</div>
		</div>
		<input type="hidden" name="post_type" value="product">
	</form>
</div>
<div class="sidebar-note">
	<ul>
		<li>Tìm sim có số <strong>858</strong> bạn hãy gõ <strong><sup>*</sup>858<sup>*</sup></strong></li>
		<li>Tìm sim có đầu <strong>090</strong> đuôi <strong>858</strong> bạn hãy gõ <strong>090<sup>*</sup>858</strong></li>
		<li>Tìm sim bắt đầu bằng <strong>0903</strong> đuôi bất kỳ, hãy gõ <strong>0903<sup>*</sup></strong></li>
	</ul>
</div>
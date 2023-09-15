<?php

$home_settings = get_field('_theme_home_settings', 'option');
$banners       = $home_settings['_banners'];

if ($banners): ?>

	<section class="banner-wrapper">
		<div class="container">
			<div class="row">
				<?php foreach ($banners as $banner): ?>
					<div class="col-12">
						<div class="banner">
							<div class="img-wrapper">
								<?= wp_get_attachment_image($banner['_img'], 'large') ?>
								<?php if ($banner['_button']['_title'] != ''): ?>
									<a href="<?= $banner['_button']['_url'] ?>" class="banner-button"><?= $banner['_button']['_title'] ?></a>
								<?php endif; ?>
							</div>
							<h3 class="banner-title"><a href="<?= $banner['_button']['_url'] ?>"><?= $banner['_title'] ?></a></h3>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

<?php endif;

<?php

$home_settings = get_field('_theme_home_settings', 'option');
$slider        = $home_settings['_slider'];
$blinking_text = $home_settings['_blinking_text'];

if ($slider): ?>
	<section class="slider-wrapper">
		<div class="container">
			<div class="primary-slick-slider-wrapper">
				<div class="primary-slick-slider">
					<?php foreach ($slider as $item): ?>
						<div class="slide-item-wrapper">
							<div class="slide-item">
								<a href="<?= $item['_url'] ?>">
									<?= wp_get_attachment_image($item['_img'], 'full') ?>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php if ($blinking_text['_text'] != ''): ?>
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="blinking-text-wrapper">
							<a href="<?= $blinking_text['_url'] ?>" class="blinking-text" target="_blank"><?= $blinking_text['_text'] ?></a>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</section>
<?php endif; ?>



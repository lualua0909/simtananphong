<?php $internet_slider = get_field('internet_slider', get_the_ID());
if ($internet_slider): ?>

	<section class="internet-slider-wrapper">
		<div class="container">
			<div class="internet-slider">
				<?php foreach ($internet_slider as $item): ?>
					<div class="internet-slide-wrapper">
						<div class="internet-slide">
							<?php if ($item['url'] != ''): ?>
								<a href="<?= $item['url'] ?>">
									<?= wp_get_attachment_image($item['img'], 'full') ?>
								</a>
							<?php else:
								echo wp_get_attachment_image($item['img'], 'full');
							endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

<?php endif;

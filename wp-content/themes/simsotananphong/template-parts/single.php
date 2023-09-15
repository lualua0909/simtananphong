<section class="single-wrapper">
	<div class="container">
		<div class="featured-img-wrapper">
			<?php the_post_thumbnail('full') ?>
		</div>
		<h1 class="entry-title"><?php the_title() ?></h1>
		<div class="entry-date-wrapper">
			<time class="entry-date published" datetime="<?= get_the_date('c'); ?>">Ngày đăng: <?= get_the_date('m/d/Y H:i'); ?></time>
		</div>
		<div class="entry-content">
			<?php the_content() ?>
		</div>
	</div>
</section>

<?php

$home_settings = get_field('_theme_home_settings', 'option');
$sim_top       = $home_settings['_sim_top'];

$args = [
	'post_type'      => 'product',
	'posts_per_page' => 11,
	'orderby'        => 'meta_value_num',
	'meta_key'       => '_price',
	'order'          => 'ASC',
	'meta_query'     => [
		'relation' => 'AND',
		[
			'key'     => '_type',
			'value'   => 'sim',
			'compare' => '=',
		],
		[
			'key'     => '_sim_top',
			'value'   => 'yes',
			'compare' => '=',
		],
	]
];

$loop = new WP_Query($args);

if ($loop->have_posts()): ?>

	<div class="sims-result-wrapper">
		<div class="section-title-wrapper">
			<h3 class="section-title"><?= $sim_top['_title'] ?></h3>
		</div>
		<div class="sims-wrapper">
			<div class="row">
				<?php while ($loop->have_posts()) : $loop->the_post(); ?>
					<div class="col-lg-4 col-md-4 col-6">
						<?php get_template_part('template-parts/content/content-product') ?>
					</div>
				<?php endwhile;
				wp_reset_postdata(); ?>
				<div class="col-lg-4 col-md-4 col-6">
					<div class="more-link-wrapper">
						<a href="?s=&action=archive&post_type=product&phan_loai=_sim_top" class="more-link">Xem thêm</a>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endif;

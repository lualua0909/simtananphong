<?php

$general_settings = get_field('_theme_general_settings', 'option');
$sidebar          = $general_settings['_sidebar'];

?>

<section class="archive-sim-2-wrapper sim-wrapper">
	<div class="container">
		<div class="row">
			<?php while (have_posts()): the_post(); ?>
				<div class="col-xl-3 col-lg-4 col-md-6">
					<?php get_template_part('template-parts/content/content-product-2') ?>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
</section>

<?php

$home_settings    = get_field('_theme_home_settings', 'option');
$phan_loai_sim    = $home_settings['_phan_loai_sim'];
$general_settings = get_field('_theme_general_settings', 'option');
$sidebar          = $general_settings['_sidebar'];

?>

<section class="sim-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<?php get_template_part('template-parts/sidebar') ?>
			</div>
			<div class="col-lg-8">
				<?php

				get_template_part('template-parts/sim-top');
				get_template_part('template-parts/banners');

				?>
				<div class="sims-result-wrapper">
					<?php if ($phan_loai_sim):
						foreach ($phan_loai_sim as $phan_loai_sim_item):

							if ($phan_loai_sim_item['_phan_loai'] == '_sim99k'):
								$meta_query = [
									'key'     => '_price',
									'value'   => 99000,
									'type'    => 'numeric',
									'compare' => '=',
								];
							else:
								$meta_query = [
									'key'     => $phan_loai_sim_item['_phan_loai'],
									'value'   => 'yes',
									'compare' => '=',
								];
							endif;

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
									$meta_query
								]
							];

							$loop = new WP_Query($args);
							if ($loop->have_posts()): ?>
								<div class="section-title-wrapper">
									<h3 class="section-title"><?= $phan_loai_sim_item['_title'] ?></h3>
								</div>
								<div class="sims-wrapper">
									<div class="row">
										<?php while ($loop->have_posts()) : $loop->the_post(); ?>
											<div class="col-lg-4 col-md-4 col-6">
												<?php get_template_part('template-parts/content/content-product') ?>
											</div>
										<?php endwhile; ?>
										<div class="col-lg-4 col-md-4 col-6">
											<div class="more-link-wrapper">
												<a href="?s=&action=archive&post_type=product&phan_loai=<?= $phan_loai_sim_item['_phan_loai'] ?>" class="more-link">Xem thêm</a>
											</div>
										</div>
									</div>
								</div>
								<?php wp_reset_postdata();
							endif;
						endforeach;
					endif; ?>
				</div>
				<?php

				get_template_part('template-parts/sim-super-data');

				?>
				<div class="fb-page" data-href="<?= $sidebar['_fanpage'] ?>" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
					<blockquote cite="<?= $sidebar['_fanpage'] ?>" class="fb-xfbml-parse-ignore"><a href="<?= $sidebar['_fanpage'] ?>">Facebook</a></blockquote>
				</div>
				<div class="fb-comments-wrapper">
					<div class="fb-comments" data-href="https://simsotananphong.com/" data-width="" data-numposts="5"></div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="archive-sim-wrapper sim-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<?php get_template_part('template-parts/sidebar') ?>
			</div>
			<div class="col-lg-8">
				<div class="sims-result-wrapper">
					<?php if (have_posts()) : ?>
						<div class="section-title-wrapper">
							<?php if (is_search()): ?>
								<h1 class="section-title">Tìm kiếm sim</h1>
							<?php else: ?>
								<h1 class="section-title"><?php the_archive_title(); ?></h1>
							<?php endif; ?>
						</div>

						<div class="sims-wrapper">
							<div class="row">
								<?php while (have_posts()): the_post(); ?>
									<div class="col-lg-4 col-md-4 col-6">
										<?php get_template_part('template-parts/content/content-product') ?>
									</div>
								<?php endwhile; ?>
							</div>
						</div>

					<?php else:
					if (isset($_GET['nam'])):
					$last = substr($_GET['nam'], - 2);
					$url  = "?post_type=product&action=advanced_search&s=&nam=76";
					$url  = home_url($url);
					?>
						<script>
							location.href = '<?= $url ?>';
						</script>

					<?php endif; ?>
						<div class="alert alert-danger" role="alert">
							Số thuê bao đã được sử dụng. Mời bạn chọn số thuê bao khác!
						</div>
					<?php endif; ?>
					<div class="pagination-wrapper">
						<?php _n_pagination([
							'prev' => '<',
							'next' => '>',
						]) ?>
					</div>
				</div>
				<div class="fb-page" data-href="https://www.facebook.com/profile.php?id=100075758265210" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
					<blockquote cite="https://www.facebook.com/profile.php?id=100075758265210" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/profile.php?id=100075758265210">Facebook</a></blockquote>
				</div>
				<div class="fb-comments-wrapper">
					<div class="fb-comments" data-href="https://simsotananphong.com/" data-width="" data-numposts="5"></div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php if (isset($_GET['s']) && $_GET['s'] != ''): ?>
	<script>
		jQuery(function ($) {
			$('.sims-wrapper').unhighlight().highlight('<?= str_replace('*', '', $_GET['s']) ?>');
		});
	</script>
<?php endif; ?>

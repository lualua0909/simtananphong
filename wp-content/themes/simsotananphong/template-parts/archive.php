<section class="blog-wrapper">
	<div class="container">
		<div class="row">
			<?php if (have_posts()) : ?>
				<div class="row">
					<?php while (have_posts()): the_post(); ?>
						<div class="col-lg-4 col-md-6 col-12">
							<?php get_template_part('template-parts/content/content'); ?>
						</div>
					<?php endwhile; ?>
				</div>
			<?php else: ?>
				<div class="alert alert-danger" role="alert">
					Nội dung đang được chuẩn bị!
				</div>
			<?php endif; ?>
			<div class="pagination-wrapper">
				<?php _n_pagination([
					'prev' => '<',
					'next' => '>',
				]) ?>
			</div>
		</div>
	</div>
</section>

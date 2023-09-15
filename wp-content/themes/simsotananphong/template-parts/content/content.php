<article class="post">
	<figure class="featured-media">
		<div class="featured-media-inner">
			<a href="<?php the_permalink() ?>">
				<?php the_post_thumbnail('large') ?>
			</a>
		</div>
	</figure>
	<div class="post-inner">
		<?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>') ?>
		<div class="post-excerpt">
			<?php the_excerpt() ?>
		</div>
	</div>
</article>

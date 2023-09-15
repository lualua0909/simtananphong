<?php

$title      = get_field('_recruitment_title', get_the_ID());
$desc       = get_field('_recruitment_desc', get_the_ID());
$background = get_field('_recruitment_background', get_the_ID());
$content    = get_field('_recruitment_content', get_the_ID());

?>

<section class="recruitment-wrapper">
	<div class="container">
		<div class="page-title-wrapper" style="background-image: url(<?= wp_get_attachment_image_url($background, 'full') ?>)">
			<h1 class="entry-content"><?= $title ?></h1>
			<p class="desc"><?= $desc ?></p>
		</div>
	</div>

	<div class="recruitment-content">
		<div class="container">
			<?php if ($content):
				foreach ($content as $content_item):?>

					<h2 class="recruitment-title"><?= $content_item['_title'] ?></h2>
					<?= wpautop($content_item['_content']) ?>

				<?php endforeach;
			endif; ?>
		</div>
	</div>
</section>

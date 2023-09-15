<?php

$footer_settings = get_field('_theme_footer_settings', 'option');
$branch          = $footer_settings['_branch'];

?>

<div class="footer">
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					<div class="logo-wrapper">
						<div class="logo-img">
							<?= wp_get_attachment_image($footer_settings['_logo'], 'medium') ?>
						</div>
						<div class="logo-text">
							<h6 class="title"><?= $footer_settings['_title'] ?></h6>
							<p class="subtitle"><?= $footer_settings['_subtitle'] ?></p>
						</div>
					</div>
					<?php if ($branch): ?>
						<ul class="branch-list">
							<?php foreach ($branch as $branch_key => $branch_item):
								if ($branch_key >= 2):
									break;
								endif; ?>
								<li><span><?= $branch_item['_title'] ?></span> <?= $branch_item['_content'] ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
				<div class="col-lg-4">
					<?php if ($branch): ?>
						<ul class="branch-list">
							<?php foreach ($branch as $branch_key => $branch_item):
								if ($branch_key < 2):
									continue;
								endif; ?>
								<li><span><?= $branch_item['_title'] ?></span> <?= $branch_item['_content'] ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
				<div class="col-lg-3">
					<?php if (has_nav_menu('footer-menu')): ?>
						<h6 class="menu-title"><?= wp_get_nav_menu_name('footer-menu') ?></h6>
						<?php wp_nav_menu([
							'theme_location' => 'footer-menu',
							'menu_class'     => 'footer-links',
						]);
					endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<?php if (has_nav_menu('secondary-menu')):
				wp_nav_menu([
					'theme_location' => 'secondary-menu',
					'menu_class'     => 'secondary-links',
				]);
			endif; ?>
		</div>
	</div>
</div>

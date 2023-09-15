<?php

$header_settings = get_field('_theme_header_settings', 'option');

?>

<div class="header">
	<div class="container">
		<div class="header-top">
			<div class="toggle-mobile-menu">
				<a href="#mobile-menu" id="toggle-mobile-menu-button">
					<span></span>
					<span></span>
					<span></span>
				</a>
			</div>
			<div class="header-content">
				<h1 class="site-title"><?= $header_settings['_title'] ?></h1>
				<div class="site-info">
					<p class="address"><?= $header_settings['_address'] ?></p>
					<p class="phone">Hotline: <a href="tel:<?= $header_settings['_phone'] ?>"><?= $header_settings['_phone'] ?></a></p>
					<p class="email">Email: <a href="mailto:<?= $header_settings['_email'] ?>"><?= $header_settings['_email'] ?></a></p>
				</div>
			</div>
		</div>
		<div class="navigation">
			<nav class="primary-menu-wrapper">
				<?php if (has_nav_menu('primary-menu')):
					wp_nav_menu([
						'theme_location' => 'primary-menu',
						'menu_class'     => 'navigation-menu',
					]);
				endif; ?>
			</nav>
		</div>
		<nav id="mobile-menu">
			<?php if (has_nav_menu('primary-menu')):
				wp_nav_menu([
					'theme_location' => 'primary-menu',
					'menu_class'     => 'navigation-menu',
				]);
			endif; ?>
		</nav>
	</div>
</div>
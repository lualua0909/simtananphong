<?php

$general_settings = get_field('_theme_general_settings', 'option');
$bottom_bar       = $general_settings['_bottom_bar'];

?>

<section class="bottom-bar-wrapper">
	<div class="button-bar-buttons">
		<a href="<?= $bottom_bar['_telegram'] ?>">
			<img src="<?= get_theme_file_uri('assets/images/telegram.png') ?>" alt="Telegram"><br>
			<span class="text">Telegram</span>
		</a>
		<a href="<?= $bottom_bar['_tiktok'] ?>">
			<img src="<?= get_theme_file_uri('assets/images/tiktok.png') ?>" alt="Tiktok"><br>
			<span class="text">Tiktok</span>
		</a>
		<a href="<?= $bottom_bar['_zalo'] ?>">
			<img src="<?= get_theme_file_uri('assets/images/zalo.png') ?>" alt="Chat Zalo"><br>
			<span class="text">Chat Zalo</span>
		</a>
		<a href="javascript:;" onclick="Tawk_API.showWidget();Tawk_API.maximize();">
			<img src="<?= get_theme_file_uri('assets/images/tawk-to.png') ?>" alt="Chat"><br>
			<span class="text">Chat</span>
		</a>
	</div>
</section>

<?php

$general_settings = get_field('_theme_general_settings', 'option');
$fab              = $general_settings['_fab'];

?>

<div class="fab-wrapper">
	<a href="<?= $fab['_zalo'] ?>" class="zalo" target="_blank"></a>
	<a href="<?= $fab['_tiktok'] ?>" class="tiktok" target="_blank"></a>
	<a href="<?= $fab['_messenger'] ?>" class="messenger" target="_blank"></a>
	<a href="<?= $fab['_contact'] ?>" class="call" target="_blank"></a>
	<a href="javascript:;" id="back-to-top"></a>
</div>

<a href="tel:<?= $fab['_phone'] ?>" class="action-call">
	<span class="icon"></span>
	<?= $fab['_phone'] ?>
</a>

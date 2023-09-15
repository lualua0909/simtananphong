<?php

$general_settings = get_field('_theme_general_settings', 'option');
$popup            = $general_settings['_popup'];

if (!$popup['_img']):
	return;
endif; ?>

<div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
			<div class="img-wrapper">
				<a href="<?= $popup['_url'] ?>" target="_blank">
					<?= wp_get_attachment_image($popup['_img'], 'large') ?>
				</a>
			</div>
		</div>
	</div>
</div>

<?php
/**
 * N Framework
 *
 * WARNING: This file is part of the core N Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @since      0.0.1
 * @package    N
 * @subpackage N/lib/admin/import
 */

if (!defined('ABSPATH')):
	exit; // Exit if accessed directly.
endif;

/**
 * Sim API importer with ajax
 *
 * @since 0.0.1
 */
function _n_ajax_get_product_ids(){
	if (get_option('_processing_paged') == '' || get_option('_processing_paged') == 0):
		$paged = 1;
		update_option('_processing_paged', $paged);
	else:
		$paged = get_option('_processing_paged');
	endif;

	$args = [
		'post_type'      => 'product',
		'posts_per_page' => 10000,
		'paged'          => $paged,
		'fields'         => 'ids'
	];

	$loop = new WP_Query($args);

	if ($loop->have_posts()):
		while ($loop->have_posts()) : $loop->the_post();
			$product_id   = get_the_ID();
			$product_type = get_post_meta($product_id, '_type', true);
			if ($product_type != 'sim'):
				continue;
			endif;

			delete_post_meta($product_id, 'AxA.AyA', 'yes');
			delete_post_meta($product_id, 'AxB.AyB', 'yes');
			delete_post_meta($product_id, 'Ax.Ay.Az', 'yes');
			delete_post_meta($product_id, 'Ax.Bx.Cx', 'yes');
			delete_post_meta($product_id, 'ABx.ABy', 'yes');
			delete_post_meta($product_id, 'xAB.yAB', 'yes');
			delete_post_meta($product_id, 'AxA.ByB', 'yes');
			delete_post_meta($product_id, 'AxA.BxB', 'yes');
			delete_post_meta($product_id, 'AAx.BBy', 'yes');
			delete_post_meta($product_id, 'xAA.yBB', 'yes');
			delete_post_meta($product_id, 'xAB.ABy', 'yes');
			delete_post_meta($product_id, 'AB.xy.AB', 'yes');
			delete_post_meta($product_id, 'AB.AB.Ax', 'yes');
			delete_post_meta($product_id, 'AB.AB.xB', 'yes');
			delete_post_meta($product_id, 'AB.AB.xy', 'yes');
			delete_post_meta($product_id, 'AxA.BBy', 'yes');
			delete_post_meta($product_id, 'xA.AB.yB', 'yes');
			delete_post_meta($product_id, 'Ax.xy.By', 'yes');
			delete_post_meta($product_id, 'ABCx.ABCy', 'yes');

			$phone_number = get_post_meta($product_id, '_phone_number', true);

			$post_metas = [];

			// Dạng số
			$dang_so = _n_check_dang_so($phone_number);
			if (!empty($dang_so)):
				foreach ($dang_so as $key => $value):
					$post_metas[$key] = $value;
				endforeach;
			endif;

			if (!empty($post_metas)):
				foreach ($post_metas as $meta_key => $meta_value):
					update_post_meta($product_id, $meta_key, $meta_value);
				endforeach;
			endif;
		endwhile;
		wp_reset_postdata();

		update_option('_processing_paged', (int) $paged + 1);

		$response = [
			'is_finished' => false,
			'paged'       => $paged
		];
	else:
		update_option('_processing_paged', 1);

		$response = [
			'is_finished' => true,
			'paged'       => $paged
		];
	endif;

	wp_send_json_success($response);
	wp_die();
}

add_action('wp_ajax_get_product_ids', '_n_ajax_get_product_ids');

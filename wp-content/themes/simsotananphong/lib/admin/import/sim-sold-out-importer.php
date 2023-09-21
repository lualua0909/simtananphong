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

use Shuchkin\SimpleXLSX;

/**
 * Sim importer with ajax
 *
 * @since 0.0.1
 */
function _n_ajax_sim_sold_out_importer(){
	if (!(is_array($_POST) && is_array($_FILES) && defined('DOING_AJAX') && DOING_AJAX)):
		wp_send_json_error('Lỗi');
	endif;

	$file       = $_FILES['file'] ?? null;
	$start_row  = isset($_POST['start_row']) ? intval($_POST['start_row']) : 1;
	$batch_size = 100;
	$end_row    = $start_row + $batch_size - 1;
	$status     = 'complete';
	$ids        = [];

	if ($xlsx = SimpleXLSX::parse($file['tmp_name']) && $xlsx_rows = SimpleXLSX::parse($file['tmp_name'])->rows()):
		$count = count($xlsx_rows);

		if ($start_row <= $count):
			$status = 'continue';
		endif;

		for ($row = $start_row; $row <= $end_row; $row ++):
			if (isset($xlsx_rows[$row - 1])):
				$item  = $xlsx_rows[$row - 1];
				$phone = _n_complete_phone_number($item[0]);

				$args = [
					'post_type'      => 'product',
					'posts_per_page' => - 1,
					'meta_query'     => [
						'relation' => 'AND',
						[
							'key'     => '_phone_number',
							'value'   => $phone,
							'compare' => '=',
						],
					]
				];

				$loop = new WP_Query($args);
				if ($loop->have_posts()):
					while ($loop->have_posts()) : $loop->the_post();
						$product_id = get_the_ID();
						_n_delete_product_by_id($product_id);
						array_push($ids, $product_id);
					endwhile;
					wp_reset_postdata();
				endif;
			else:
				$status = 'complete';
				break;
			endif;
		endfor;
	endif;

	$response = [
		'imported_data' => $ids,
		'end_row'       => $end_row,
		'status'        => $status
	];

	wp_send_json_success($response);
	wp_die();
}

add_action('wp_ajax_sim_sold_out_importer', '_n_ajax_sim_sold_out_importer');
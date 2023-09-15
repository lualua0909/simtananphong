<?php
/**
 * N Framework
 *
 * WARNING: This file is part of the core N Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @since      0.0.1
 * @package    N
 * @subpackage N/lib/functions
 */

if (!defined('ABSPATH')):
	exit; // Exit if accessed directly.
endif;

/**
 * Tạo cron job
 */
function _n_setup_api_cron_schedule(){
	if (!wp_next_scheduled('_n_api_cron_event')):
		wp_schedule_event(time(), 'two_minutes', '_n_api_cron_event');
	endif;

	if (!wp_next_scheduled('_n_api_delete_cron_event')):
		wp_schedule_event(time(), 'two_minutes', '_n_api_delete_cron_event');
	endif;
}

add_action('init', '_n_setup_api_cron_schedule');


/**
 * Thêm một thời gian mới (2 phút) cho hàm wp_get_schedules
 */
function _n_add_schedule($schedules){
	$schedules['two_minutes'] = [
		'interval' => 120,
		'display'  => esc_html__('Mỗi 2 phút', '_n'),
	];

	return $schedules;
}

add_filter('cron_schedules', '_n_add_schedule');

/**
 * Thực thi công việc của cron job
 */
function _n_api_cron_task(){
	$api_paged = get_option('_api_paged');

	if ($api_paged == ''):
		$api_paged = 1;
	else:
		$api_paged ++;
	endif;

	$response = _n_api_filter_msisdn([
		"types"      => [0, 1],
		"regions"    => [0, 2],
		"sizeOfPage" => 100,
		"statuss"    => [0, 1],
		"page"       => $api_paged,
	]);

	$items           = $response->data->items;
	$number_per_page = $response->data->numberPerPage;
	$code            = $response->code;

	// Nếu không còn dữ liệu thì trở lại trang 1
	if ($code == 60):
		$api_paged = 1;
	endif;

	update_option('_api_paged', $api_paged);

	if ($code == 1 && !empty($items)):
		if (!function_exists('post_exists')):
			require_once(ABSPATH . 'wp-admin/includes/post.php');
		endif;

		foreach ($items as $item):
			// Hết hàng thì xoá, còn thì update giá
			$product_id    = post_exists($item->msisdn, '', '', 'product');
			$msisdn_detail = _n_api_msisdn_detail($item->msisdn);

			if ($item->typeStr == 'Trả trước'):
				$loai_sim = '_tra_truoc';
				$price    = get_option('_api_gia_tra_truoc');
			else:
				$loai_sim = '_tra_sau';
				$price    = get_option('_api_gia_tra_sau');
			endif;

			if ($product_id):
				if ($msisdn_detail->code == 1):
					if ($msisdn_detail->data->items[0]->statusStr != 'Trong kho'):
						_n_delete_product_by_id($product_id);
					else:
						update_post_meta($product_id, '_price', $price);
					endif;
				else:
					_n_delete_product_by_id($product_id);
				endif;
				continue;
			endif;

			// Nếu sim hết hàng thì bỏ qua
			if ($msisdn_detail->code == 1 && $msisdn_detail->data->items[0]->statusStr != 'Trong kho'):
				continue;
			endif;

			$product_data = [
				'type'         => 'sim',
				'title'        => $item->msisdn,
				'phone'        => _n_complete_phone_number($item->msisdn),
				'price'        => $price,
				'cost'         => '',
				'goi_cuoc'     => '',
				'loai_sim'     => $loai_sim,
				'nha_mang'     => _n_check_nha_mang($item->msisdn),
				'nha_cung_cap' => '_kho_chon_so',
			];

			_n_create_product($product_data);
		endforeach;
	endif;
}

add_action('_n_api_cron_event', '_n_api_cron_task');

/**
 * Kiểm tra trạng thái và xoá số
 */
function _n_api_delete_cron_task(){
	$product_paged = get_option('_product_paged');

	if ($product_paged == ''):
		$product_paged = 1;
	else:
		$product_paged ++;
	endif;

	$args = [
		'post_type'      => 'product',
		'posts_per_page' => 100,
		'paged'          => $product_paged,
		'meta_query'     => [
			'relation' => 'AND',
			[
				'key'     => '_type',
				'value'   => 'sim',
				'compare' => '=',
			],
			[
				'key'     => '_nha_cung_cap',
				'value'   => '_kho_chon_so',
				'compare' => '=',
			]
		]
	];

	$loop = new WP_Query($args);

	if ($loop->have_posts()):
		while ($loop->have_posts()) : $loop->the_post();
			$product_id    = get_the_ID();
			$phone_number  = get_post_meta($product_id, '_phone_number', true);
			$msisdn_detail = _n_api_msisdn_detail($phone_number);
			if ($msisdn_detail->code == 1 && $msisdn_detail->data->items[0]->statusStr != 'Trong kho'):
				_n_delete_product_by_id($product_id);
			else:
				continue;
			endif;
		endwhile;
		wp_reset_postdata();
	else:
		$product_paged = 1;
	endif;

	update_option('_product_paged', $product_paged);
}

add_action('_n_api_delete_cron_event', '_n_api_delete_cron_task');

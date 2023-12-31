<?php
/**
 * N Framework
 *
 * WARNING: This file is part of the core N Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @since      0.0.1
 * @package    N
 * @subpackage N/lib/admin
 */

if (!defined('ABSPATH')):
	exit; // Exit if accessed directly.
endif;

/**
 * Thêm cột tuỳ chỉnh vào admin
 */
function _n_product_column_heading($columns){
	$columns['nha_cung_cap'] = 'Nhà cung cấp';
	$columns['loai_sim']     = 'Loại sim';

	return $columns;
}

add_filter('manage_edit-product_columns', '_n_product_column_heading', 10);

/**
 * Nội dung cột
 */
function _n_product_column_content($column, $post_id){
	$nha_cung_cap        = get_post_meta($post_id, '_nha_cung_cap', true);
	$loai_sim            = get_post_meta($post_id, '_loai_sim', true);
	$loai_sim_config     = _n_get_config('loai-sim');
	$nha_cung_cap_config = _n_get_config('nha-cung-cap');

	if ($column === 'nha_cung_cap' && $nha_cung_cap != ''):
		echo $nha_cung_cap_config[$nha_cung_cap]['name'];
		if (current_user_can('administrator')):
			echo '<br>' . $nha_cung_cap_config[$nha_cung_cap]['phone'];
		endif;
	endif;

	if ($column === 'loai_sim'):
		echo $loai_sim_config[$loai_sim]['name'];
	endif;
}

add_action('manage_product_posts_custom_column', '_n_product_column_content', 10, 2);

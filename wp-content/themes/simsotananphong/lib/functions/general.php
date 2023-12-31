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
 * Đếm lịch sử import
 *
 * @since 0.0.1
 */
function _n_count_import($history_id){
	$args = [
		'post_type'  => 'product',
		'meta_query' => [
			[
				'key'     => '_import_history',
				'value'   => $history_id,
				'compare' => '='
			]
		]
	];

	$query = new WP_Query($args);

	return $query->found_posts;
}

/**
 * Sim sảnh tiến lên
 *
 * @since 0.0.1
 */
function _n_check_sim_sanh_tien_len($phone){
	$phone  = preg_replace('/[^0-9]/', '', $phone);
	$n      = strlen($phone);
	$result = [];

	for ($i = 3; $i < $n; $i ++):
		if ($phone[$i] + 1 == $phone[$i + 1] && $phone[$i + 1] + 1 == $phone[$i + 2]):
			$result[] = substr($phone, $i, 3);
		endif;
	endfor;

	if (!empty($result)):
		return true;
	endif;

	return false;
}

/**
 * Sim tiến lên
 *
 * @since 0.0.1
 */
function _n_check_sim_tien_len($phone){
	$phone        = preg_replace('/[^0-9]/', '', $phone);
	$last_phone_1 = substr($phone, - 6);
	$result       = [];
	$cap_so_1     = [];
	$cap_3_so_1   = str_split($last_phone_1, 3);

	// Chia thành các cặp số
	for ($i = 0; $i < strlen($last_phone_1) - 1; $i += 2):
		$cap_so = $last_phone_1[$i] . $last_phone_1[$i + 1];
		array_push($cap_so_1, $cap_so);
	endfor;

	for ($don_vi = 1; $don_vi <= 9; $don_vi ++):
		$don_vi_new = $don_vi * 10;
		$so_moi     = intval($cap_so_1[0]) + $don_vi_new;
		$so_1       = substr($cap_so_1[1], 0, 1);
		$so_2       = substr(strval($so_moi), 0, 1);

		if ($so_1 != $so_2):
			continue;
		endif;

		if (intval($cap_so_1[2]) == intval($cap_so_1[1]) + $don_vi_new):
			array_push($result, 'Chứa cặp 2 số lớn hơn ' . $don_vi_new . ' đơn vị');
		endif;
	endfor;

	if (intval($cap_so_1[2]) == intval($cap_so_1[1]) + 1):
		array_push($result, 'Chứa cặp 2 số lớn hơn 1 đơn vị');
	endif;

	// Chia thằng các cặp 3 số
	if (intval($cap_3_so_1[1]) == intval($cap_3_so_1[0]) + 1):
		array_push($result, 'Chứa cặp 3 số lớn hơn 1 đơn vị');
	endif;

	for ($don_vi = 10; $don_vi <= 900; $don_vi += 10):
		$so_1_0 = intval(substr($cap_3_so_1[0], 0, 1));
		$so_2_0 = intval(substr($cap_3_so_1[0], 1, 1));
		$so_3_0 = intval(substr($cap_3_so_1[0], 2, 1));
		$so_1_1 = intval(substr($cap_3_so_1[1], 0, 1));
		$so_2_1 = intval(substr($cap_3_so_1[1], 1, 1));
		$so_3_1 = intval(substr($cap_3_so_1[1], 2, 1));

		if ($so_1_0 == $so_1_1 && $so_3_0 == $so_3_1 && $so_2_0 < $so_2_1):
			if (intval($cap_3_so_1[1]) == intval($cap_3_so_1[0]) + $don_vi):
				array_push($result, 'Chứa cặp 3 số lớn hơn ' . $don_vi . ' đơn vị');
			endif;
		elseif ($so_3_0 == $so_3_1 && $so_2_0 == $so_2_1 && $so_1_0 < $so_1_1):
			if (intval($cap_3_so_1[1]) == intval($cap_3_so_1[0]) + $don_vi):
				array_push($result, 'Chứa cặp 3 số lớn hơn ' . $don_vi . ' đơn vị');
			endif;
		endif;
	endfor;

	if (!empty($result)):
		return true;
	endif;

	return false;
}

/**
 * Đảm bảo tính toàn vẹn số điện thoại
 *
 * @since 0.0.1
 */
function _n_complete_phone_number($phone){
	$phone = preg_replace('/[^0-9]/', '', $phone);

	if (strlen($phone) == 9 && substr($phone, 0, 1) != 0):
		$phone = "0" . $phone;
	elseif (strlen($phone) == 11 && substr($phone, 0, 2) == 84):
		$phone = substr_replace($phone, "0", 0, 2);
	elseif (strlen($phone) == 12 && substr($phone, 0, 2) == "+84"):
		$phone = substr_replace($phone, "0", 0, 3);
	endif;

	return $phone;
}

/**
 * Phân loại sim
 *
 * @since 0.0.1
 */
function _n_get_categories($phone){
	$phone                = preg_replace('/[^0-9]/', '', $phone);
	$last_two_numbers     = substr($phone, - 2);
	$last_two_numbers_2   = substr($phone, - 4, 2);
	$last_three_numbers   = substr($phone, - 3);
	$middle_three_numbers = substr($phone, - 6, 3);
	$last_four_numbers    = substr($phone, - 4);
	$sim_cats             = [];

	// Sim Thần tài
	if (preg_match('/39|79/', $last_two_numbers)):
		array_push($sim_cats, '_sim_than_tai');
	endif;

	// Sim Thổ địa
	if (preg_match('/38|78/', $last_two_numbers)):
		array_push($sim_cats, '_sim_tho_dia');
	endif;

	// Sim Lộc phát
	if (preg_match('/68/', $last_two_numbers)):
		array_push($sim_cats, '_sim_loc_phat');
	endif;

	// Sim Phát lộc
	if (preg_match('/86/', $last_two_numbers)):
		array_push($sim_cats, '_sim_phat_loc');
	endif;

	// Sim Lục quý
	if (preg_match('/(\d)\1{5}/', $phone)):
		array_push($sim_cats, '_sim_luc_quy');
	// Sim Ngũ quý
	elseif (preg_match('/(\d)\1{4}/', $phone)):
		array_push($sim_cats, '_sim_ngu_quy');
	// Sim Tứ quý
	elseif (preg_match('/(\d)\1{3}/', $phone)):
		array_push($sim_cats, '_sim_tu_quy');
	endif;

	// Sim Tam hoa kép
	if (preg_match('/(\d)\1{2}/', $last_three_numbers) && preg_match('/(\d)\1{2}/', $middle_three_numbers)):
		array_push($sim_cats, '_sim_tam_hoa_kep');
	// Sim Tam hoa cuối
	elseif (preg_match('/(\d)\1{2}/', $last_three_numbers)):
		array_push($sim_cats, '_sim_tam_hoa_cuoi');
	// Sim Tam hoa
	elseif (preg_match('/(\d)\1{2}/', $phone)):
		array_push($sim_cats, '_sim_tam_hoa');
	endif;

	// Sim sảnh tiến lên
	if (_n_check_sim_sanh_tien_len($phone)):
		array_push($sim_cats, '_sim_sanh_tien_len');
	endif;

	// Sim tiến lên
	if (_n_check_sim_tien_len($phone)):
		array_push($sim_cats, '_sim_tien_len');
	endif;

	// Sim lặp kép
	if (preg_match('/(\d)\1{1}/', $last_two_numbers) && preg_match('/(\d)\1{1}/', $last_two_numbers_2) || $last_two_numbers == $last_two_numbers_2):
		array_push($sim_cats, '_sim_lap_kep');
	endif;

	// Sim taxi
	if ($last_three_numbers == $middle_three_numbers):
		array_push($sim_cats, '_sim_taxi');
	endif;

	// Sim năm sinh
	if ((int) $last_four_numbers >= 1900 && (int) $last_four_numbers <= (int) date('Y') + 1):
		array_push($sim_cats, '_sim_nam_sinh');
	endif;

	return $sim_cats;
}

/**
 * Kiểm tra sim thuộc nhà mạng nào
 */
function _n_check_nha_mang($phone){
	$phone = preg_replace('/[^0-9]/', '', $phone);

	$viettelPatterns   = '/^(086|096|097|098|0169|0168|0167|0166|0165|0164|0163|0162|039|038|037|036|035|034|033|032)/';
	$vinaphonePatterns = '/^(091|094|0128|0123|0124|0125|0127|0129|088|083|084|085|081|082)/';
	$mobifonePatterns  = '/^(0120|0121|0122|0126|0128|089|090|093|070|079|077|076|078)/';

	if (preg_match($viettelPatterns, $phone)):
		return '_viettel';
	elseif (preg_match($vinaphonePatterns, $phone)):
		return '_vinaphone';
	elseif (preg_match($mobifonePatterns, $phone)):
		return '_mobifone';
	else:
		return false;
	endif;
}

/**
 * Kiểm tra sim thuộc dạng nào
 */
function _n_check_dang_so($phone){
	$phone = preg_replace('/[^0-9]/', '', $phone);

	$a = substr($phone, - 8, 1);
	$b = substr($phone, - 7, 1);
	$c = substr($phone, - 6, 1);
	$d = substr($phone, - 5, 1);
	$e = substr($phone, - 4, 1);
	$f = substr($phone, - 3, 1);
	$g = substr($phone, - 2, 1);
	$h = substr($phone, - 1, 1);

	$formats = [];

	// AxA.AyA
	if ($c == $e && $f == $h && $e == $f && $d != $g && $c != $d):
		$formats['AxAAyA'] = "yes";
	endif;

	// AxB.AyB
	if ($c == $f && $e == $h && $d != $g && $c != $e):
		$formats['AxBAyB'] = "yes";
	endif;

	//Ax.Ay.Az
	if ($c == $e && $e == $g && $d != $f && $f != $h && $c != $d):
		$formats['AxAyAz'] = "yes";
	endif;

	//Ax.Bx.Cx
	if ($d == $f && $f == $h && $c != $e && $e != $g && $c != $d):
		$formats['AxBxCx'] = "yes";
	endif;

	//ABx.ABy
	if ($c == $f && $d == $g && $c != $d && $e != $h):
		$formats['ABxABy'] = "yes";
	endif;

	//xAB.yAB
	if ($c != $f && $d == $g && $e == $h && $d != $e && $c != $d && $c != $e && $f != $d && $f != $e):
		$formats['xAByAB'] = "yes";
	endif;

	//AxA.ByB
	if ($c == $e && $f == $h && $c != $f && $d != $g && $c != $d && $d != $f && $g != $f):
		$formats['AxAByB'] = "yes";
	endif;

	//AxA.BxB
	if ($c == $e && $f == $h && $c != $f && $d == $g && $c != $d):
		$formats['AxABxB'] = "yes";
	endif;

	//AAx.BBy
	if ($c == $d && $f == $g && $e != $h && $d != $f && $d != $e && $e != $f):
		$formats['AAxBBy'] = "yes";
	endif;

	//xAA.yBB
	if ($d == $e && $g == $h && $c != $f && $d != $g && $c != $d):
		$formats['xAAyBB'] = "yes";
	endif;

	//xAB.ABy
	if ($c != $h && $d == $f && $e == $g && $d != $e && $c != $d):
		$formats['xABABy'] = "yes";
	endif;

	//AB.xy.AB
	if ($c == $g && $d == $h && $e != $f && $c != $d && $c != $e && $d != $e):
		$formats['ABxyAB'] = "yes";
	endif;

	//AB.AB.Ax
	if ($c == $e && $e == $g && $d == $f && $c != $d && $c != $h && $d != $h):
		$formats['ABABAx'] = "yes";
	endif;

	//AB.AB.xB
	if ($c == $e && $d == $f && $f == $h && $g != $d && $g != $c && $d != $c):
		$formats['ABABxB'] = "yes";
	endif;

	//AB.AB.xy
	if ($c == $e && $d == $f && $g != $h && $c != $d && $c != $g && $d != $g && $c != $h && $d != $h):
		$formats['ABABxy'] = "yes";
	endif;

	//AxA.BBy
	if ($c == $e && $f == $g && $d != $h && $c != $d && $c != $f && $c != $h && $g != $h && $g != $d):
		$formats['AxABBy'] = "yes";
	endif;

	//xAA.ByB
	if ($d == $e && $f == $h && $d != $f && $c != $g && $c != $d && $c != $f && $g != $d && $g != $f):
		$formats['xAAByB'] = "yes";
	endif;

	//Axx.yBy
	if ($d == $e && $f == $h && $c != $d && $c != $f && $c != $g && $g != $d && $g != $f):
		$formats['AxxyBy'] = "yes";
	endif;

	//ABCx.ABCy
	if ($a == $e && $b == $f && $c == $g && $d != $h && $a != $b && $b != $c && $d != $a && $d != $b && $d != $c && $h != $a && $h != $b && $h != $c):
		$formats['ABCxABCy'] = "yes";
	endif;

	return $formats;
}

/**
 * Gửi tin nhắn telegram thông qua API
 */

function _n_send_telegram_message($args){
	$url = "https://phplaravel-1100866-3856926.cloudwaysapps.com/api/sim-push-telegram";

	$data = [
		'customerName'  => $args['customerName'],
		'refCode'       => $args['refCode'],
		'customerPhone' => $args['customerPhone'],
		'buySim'        => $args['buySim'],
		'requiredCode'  => $args['requiredCode'],
		'simType'       => $args['simType'],
		'address'       => $args['address'],
		'supplierName'  => $args['supplierName'],
		'simPrice'      => $args['simPrice'],
	];

	$response = wp_remote_post($url, [
		'method'  => 'POST',
		'headers' => [
			'Content-Type' => 'application/json',
		],
		'body'    => wp_json_encode($data),
	]);

	if (is_wp_error($response)):
		error_log('Telegram message sending failed: ' . $response->get_error_message());
	else:
		error_log('Telegram message sent successfully.');
	endif;
}

/**
 * Upload file
 */
function _n_upload_user_file($file = []){
	require_once(ABSPATH . 'wp-admin/includes/admin.php');
	$file_return = wp_handle_upload($file, ['test_form' => false]);

	if (isset($file_return['error']) || isset($file_return['upload_error_handler'])):
		return false;
	else:
		$filename      = $file_return['file'];
		$attachment    = [
			'post_mime_type' => $file_return['type'],
			'post_title'     => preg_replace('/\.[^.]+$/', '', basename($filename)),
			'post_content'   => '',
			'post_status'    => 'inherit',
			'guid'           => $file_return['url']
		];
		$attachment_id = wp_insert_attachment($attachment, $filename);
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		$attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);
		wp_update_attachment_metadata($attachment_id, $attachment_data);
		if (0 < intval($attachment_id)):
			return $attachment_id;
		endif;
	endif;

	return false;
}

/**
 * Affiliate cookie
 */
function _n_affiliate_set_cookie(){
	if (isset($_GET['refcode'])):
		$refcode = $_GET['refcode'];

		// Tính thời gian hết hạn sau một tháng
		$expiryTime = time() + 30 * 24 * 60 * 60;

		// Thiết lập cookie
		setcookie('refcode', $refcode, $expiryTime);
	endif;
}

_n_affiliate_set_cookie();

/**
 * Xoá sản phẩm
 */
function _n_delete_product_by_id($id){
	$post_meta_keys = get_post_custom_keys($id);

	if ($post_meta_keys):
		foreach ($post_meta_keys as $meta_key):
			delete_post_meta($id, $meta_key);
		endforeach;
	endif;

	wp_delete_post($id, true);
}

/**
 * Thêm dấu chấm vào số điện thoại
 */
function _n_add_dots_to_phone_number($title, $id = null){
	$phone = $title;
	$args  = [];

	$dang_sim = _n_get_config('dang-sim');
	if (!empty($dang_sim)):
		foreach ($dang_sim as $key => $value):
			if (isset($_GET[$key]) && $_GET[$key] == 'yes'):
				$dots_count = substr_count($value, '.');
				$str_count  = strlen($key);

				if ($dots_count == 1 && $str_count == 6):
					$args = [4, 3, 3];
				elseif ($dots_count == 2 && $str_count == 6):
					$args = [4, 2, 2, 2];
				elseif ($dots_count == 1 && $str_count == 8):
					$args = [2, 4, 4];
				endif;
			endif;
		endforeach;
	endif;

	if (empty($args)):
		return $title;
	endif;

	$phone       = preg_replace('/[^0-9]/', '', $phone);
	$replacement = '';
	$pattern     = "/^";

	foreach ($args as $key => $arg):
		$pattern .= '(\d{' . $arg . '})';

		if ($key == 0):
			$replacement .= '$' . ($key + 1);
		else:
			$replacement .= '.$' . ($key + 1);
		endif;
	endforeach;

	$pattern .= "$/";

	return preg_replace($pattern, $replacement, $phone);
}

/**
 * Thêm dấu chấm vào số điện thoại
 */
function _n_set_the_title(){
	add_filter('the_title', '_n_add_dots_to_phone_number', 10, 2);
}

add_action('loop_start', '_n_set_the_title');

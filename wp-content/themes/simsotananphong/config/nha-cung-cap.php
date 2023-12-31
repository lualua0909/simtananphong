<?php
/**
 * N Framework
 *
 * WARNING: This file is part of the core N Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @since      0.0.1
 * @package    N
 * @subpackage N/config
 */

if (!defined('ABSPATH')):
	exit; // Exit if accessed directly.
endif;

$options = get_field('_nha_cung_cap', 'option');

$config = [];

if ($options):
	foreach ($options as $option):
		$config[$option['_id']] = [
			'name'  => $option['_name'],
			'phone' => $option['_phone'],
		];
	endforeach;
endif;

return $config;

<?php
/**
 * N Framework
 *
 * @link       https://nhut.me/n-framework/
 * @since      0.0.1
 *
 * @package    N
 * @subpackage N/includes
 */

if (!defined('ABSPATH')):
	exit; // Exit if accessed directly.
endif;

/**
 * Activates default theme features.
 *
 * @since 0.0.1
 */
function _n_theme_setup(){
	add_theme_support('menus');
	add_theme_support('post-thumbnails');
	add_theme_support('title-tag');
	add_theme_support('automatic-feed-links');
	add_theme_support('body-open');

	if (class_exists('WooCommerce')):
		add_theme_support('woocommerce');
		add_theme_support('wc-product-gallery-zoom');
		add_theme_support('wc-product-gallery-lightbox');
		add_theme_support('wc-product-gallery-slider');
	endif;

	add_theme_support('html5', [
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	]);

	add_theme_support('custom-logo', [
		'height'      => 100,
		'width'       => 350,
		'flex-height' => true,
		'flex-width'  => true,
	]);
}

add_action('_n_setup', '_n_theme_setup');

/**
 * Constants
 *
 * @since 0.0.1
 */
function _n_constants(){
	define('N_PARENT_VERSION', wp_get_theme('_n')->get('Version'));
	define('N_PARENT_DIR', get_template_directory());
	define('N_CHILD_DIR', get_stylesheet_directory());
}

add_action('_n_init', '_n_constants');

/**
 * Replace archive title
 *
 * @since 0.0.1
 */
function _n_get_the_archive_title($title){
	if (is_category()):
		$title = single_cat_title('', false);
	elseif (is_tag()):
		$title = single_tag_title('', false);
	elseif (is_author()):
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	elseif (is_post_type_archive()):
		$title = post_type_archive_title('', false);
	elseif (is_tax()):
		$title = single_term_title('', false);
	endif;

	return $title;
}

add_filter('get_the_archive_title', '_n_get_the_archive_title', 11);

/**
 * Loads all the framework files and features.
 *
 * @since 0.0.1
 */
function _n_load_framework(){
	$inc_dir = trailingslashit(get_template_directory()) . 'includes/';

	// Load Functions.
	$functions_dir = $inc_dir . 'functions/';
	require_once $functions_dir . 'general.php';
	require_once $functions_dir . 'markup.php';
	require_once $functions_dir . 'template-tags.php';

	if (class_exists('WooCommerce')):
		require_once $functions_dir . 'woocommerce.php';
	endif;

	// Load Classes.
	$classes_dir = $inc_dir . 'classes/';
	require_once $classes_dir . 'class-n-framework.php';
	require_once $classes_dir . 'class-n-breadcrumbs.php';
	require_once $classes_dir . 'class-n-pagination.php';

	// Load Structure.
	$structure_dir = $inc_dir . 'structure/';
	require_once $structure_dir . 'header.php';

	// Load Admin.
	$admin_dir = $inc_dir . 'admin/';
	require_once $admin_dir . 'admin.php';
}

add_action('_n_init', '_n_load_framework');

/**
 * Fires during N initialization.
 *
 * @since 0.0.1
 */
do_action('_n_init');

/**
 * Fires after N initialization.
 *
 * @since 0.0.1
 */
do_action('_n_setup');

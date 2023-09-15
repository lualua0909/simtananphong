<?php
/**
 * N Framework
 *
 * WARNING: This file is part of the core N Framework. DO NOT edit
 * this file under any circumstances. Please do all modifications
 * in the form of a child theme.
 *
 * @link    https://nhut.me/n-framework/
 * @since   0.0.1
 * @package N
 */

if (!defined('ABSPATH')):
	exit; // Exit if accessed directly.
endif;

// Starts the engine.
require_once get_template_directory() . '/includes/init.php';

// Theme initialization
require_once get_stylesheet_directory() . '/lib/init.php';

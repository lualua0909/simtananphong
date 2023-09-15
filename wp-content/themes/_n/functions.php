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

/**
 * Calls the init.php file, but only if the child theme has not called it first.
 *
 * This method allows the child theme to load
 * the framework so it can use the framework
 * components immediately.
 */
require_once __DIR__ . '/includes/init.php';

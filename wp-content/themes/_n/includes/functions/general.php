<?php
/**
 * N Framework
 *
 * WARNING: This file is part of the core N Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @since      0.0.1
 * @package    N
 * @subpackage N/includes/functions
 */

if (!defined('ABSPATH')):
	exit; // Exit if accessed directly.
endif;

/**
 * Locate and require a config file.
 *
 * @param string $config The config file to look for (not including .php file extension).
 *
 * @return array The config data.
 * @since 0.0.1
 *
 */
function _n_get_config($config){
	$parent_file = sprintf('%s/config/%s.php', get_template_directory(), $config);
	$child_file  = sprintf('%s/config/%s.php', get_stylesheet_directory(), $config);
	$data        = [];

	if (is_readable($child_file)):
		$data = require $child_file;
	endif;

	if (empty($data) && is_readable($parent_file)):
		$data = require $parent_file;
	endif;

	return (array) $data;
}

/**
 * Display custom logo
 *
 * @since 0.0.1
 */
function _n_logo(){
	if (has_custom_logo()):
		$custom_logo_id = get_theme_mod('custom_logo');
		$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
		$custom_logo_url = $logo[0];
		?>
		<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" rel="home">
			<img width="<?= $logo[1] ?>" height="<?= $logo[2] ?>" src="<?php echo esc_url($custom_logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"/>
		</a>
	<?php else:
		echo '<div class="site-name">' . get_bloginfo('name') . '</div>';
	endif;
}
<?php
/**
 * N Framework
 *
 * @link       https://nhut.me/n-framework/
 * @since      0.0.1
 *
 * @package    N
 * @subpackage N/lib
 */

if (!defined('ABSPATH')):
	exit; // Exit if accessed directly.
endif;

/**
 * Facebook SDK
 */
add_action('wp_head', function (){
	?>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0&appId=280957452882882&autoLogAppEvents=1" nonce="UyroirE2"></script>    <?php
});

/**
 * Meta Pixel Code
 */
add_action('wp_head', function (){
	?>    <!-- Meta Pixel Code -->
	<script>
		!function (f, b, e, v, n, t, s) {
			if (f.fbq) {
				return;
			}
			n = f.fbq = function () {
				n.callMethod ?
					n.callMethod.apply(n, arguments) : n.queue.push(arguments)
			};
			if (!f._fbq) {
				f._fbq = n;
			}
			n.push = n;
			n.loaded = !0;
			n.version = '2.0';
			n.queue = [];
			t = b.createElement(e);
			t.async = !0;
			t.src = v;
			s = b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t, s)
		}(window, document, 'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '1496405804506753');
		fbq('track', 'PageView');
	</script>
	<noscript>
		<img src="https://www.facebook.com/tr?id=1496405804506753&ev=PageView&noscript=1" alt="Pixel của Viễn Thông Tài Phát" height="1" width="1" style="display:none"/>
	</noscript>    <!-- End Meta Pixel Code -->    <?php
});

/**
 * Loader
 */
add_action('_n_before_header', function (){
	get_template_part('template-parts/loader');
});

/**
 * The header for our theme
 */
add_action('_n_header', function (){
	get_template_part('template-parts/header');
});

/**
 * The front page for our theme
 */
add_action('_n_front', function (){
	get_template_part('template-parts/slider');
	get_template_part('template-parts/home');
});

/**
 * The home page for our theme
 */
add_action('_n_home', function (){
	get_template_part('template-parts/archive');
});

/**
 * The template for displaying archive product pages
 */
add_action('_n_search_product', function (){
	get_template_part('template-parts/slider');
	if (isset($_GET['phan_loai']) && $_GET['phan_loai'] == 'sim_super_data'):
		get_template_part('template-parts/archive-product-2');
	else:
		get_template_part('template-parts/archive-product');
	endif;
});

/**
 * The template for displaying all single product
 */
add_action('_n_single_product', function (){
	get_template_part('template-parts/single-product');
});

/**
 * Template cập nhật thông tin khách hàng
 */
add_action('_n_page_template_page_template_customer_info', function (){
	get_template_part('template-parts/customer-info');
});

/**
 * Template thông báo đặt hàng thành công
 */
add_action('_n_page_template_page_template_complete', function (){
	get_template_part('template-parts/complete');
});

/**
 * Template thông báo đặt hàng thành công
 */
add_action('_n_page_template_page_template_owner_register', function (){
	get_template_part('template-parts/owner-register');
});

/**
 * Template tuyển dụng
 */
add_action('_n_page_template_page_template_recruitment', function (){
	get_template_part('template-parts/recruitment');
});

/**
 * The template for displaying all single posts
 */
add_action('_n_single_post', function (){
	get_template_part('template-parts/single');
});

/**
 * The template for displaying all single posts
 */
add_action('_n_single_page', function (){
	get_template_part('template-parts/single');
});

/**
 * The template for shop page
 */
add_action('_n_shop', function (){
	get_template_part('template-parts/slider');
	get_template_part('template-parts/archive-product');
});

/**
 * The template for product category
 */
add_action('_n_product_cat', function (){
	get_template_part('template-parts/slider');
	get_template_part('template-parts/archive-product');
});

/**
 * The template for product tag
 */
add_action('_n_product_tag', function (){
	get_template_part('template-parts/slider');
	get_template_part('template-parts/archive-product');
});

/**
 * The template for category
 */
add_action('_n_category', function (){
	get_template_part('template-parts/archive');
});

/**
 * The template for tag
 */
add_action('_n_tag', function (){
	get_template_part('template-parts/archive');
});

/**
 * The template for search page
 */
add_action('_n_search', function (){
	get_template_part('template-parts/archive');
});

/**
 * The footer for our theme
 */
add_action('_n_footer', function (){
	get_template_part('template-parts/footer');
	get_template_part('template-parts/fab');
	get_template_part('template-parts/bottom-bar');
});

/**
 * The footer for our theme
 */
add_action('_n_before_footer', function (){
	get_template_part('template-parts/popup');
});

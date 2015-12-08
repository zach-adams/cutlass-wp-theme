<?php

/**
 * Theme setup
 */
function cutlass_setup()
{

	/**
	 * THEME SUPPORT
	 */
	// Allow Post Thumbnails in posts and pages
	add_theme_support('post-thumbnails');
	// Default Post Formats setup
	add_theme_support('post-formats', [
			'aside',
			'gallery',
			'link',
			'image',
			'quote',
			'video',
			'audio'
	]);
	// HTML5 all the things
	add_theme_support('html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
	]);

	/**
	 * Add theme support for new title tag (as of 4.1)
	 */
	add_theme_support( 'title-tag' );

	add_theme_support('soil-clean-up');
	add_theme_support('soil-nav-walker');
	add_theme_support('soil-relative-urls');
	add_theme_support('soil-js-to-footer');
	add_theme_support('soil-disable-trackbacks');
	add_theme_support('soil-disable-asset-versioning');

	//Register default nav menus
	register_nav_menus([
			'primary_navigation' => 'Primary Navigation'
	]);

}

add_action('after_setup_theme', 'cutlass_setup');

/**
 * Register sidebars
 */
function cutlass_widgets_init()
{

	register_sidebar([
			'name'          => 'Primary',
			'id'            => 'sidebar-primary',
			'before_widget' => '<aside class="widget %1$s %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
	]);

}

add_action('widgets_init', 'cutlass_widgets_init');

/**
 * Theme styles and scripts setup
 */
function cutlass_scripts()
{
	if(file_exists(public_path('css/app.css'))) {
		/**
		 * Queue our elixir styles
		 */
		wp_enqueue_style('all', asset('css/app.css'), ['plugins'], null, 'all');
	}
	if(file_exists(public_path('js/app.js'))) {

		/**
		 * Queue our elixir scripts
		 */
		wp_enqueue_script('all', asset('js/app.js'), [ 'jquery' ], null, true);
	}

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

}

add_action('wp_enqueue_scripts', 'cutlass_scripts');

/**
 * Adds helpful classes to our body tag
 * From Roots Sage theme: https://github.com/roots/sage/blob/master/lib/extras.php
 */
function cutlass_body_class($classes)
{
	// Add page slug if it doesn't exist
	if (is_single() || is_page() && ! is_front_page()) {
		if ( ! in_array(basename(get_permalink()), $classes)) {
			$classes[] = get_post_type() . '-' . basename(get_permalink());
		}
	}

	return $classes;
}

add_filter('body_class', 'cutlass_body_class');

/**
 * Remove Emoji support
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

/**
 * Remove Dashboard Widgets
 */
function cutlass_remove_dashboard_widgets()
{
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
	remove_meta_box('dashboard_quick_press', 'dashboard', 'normal');
	remove_meta_box('dashboard_primary', 'dashboard', 'normal');
	remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
}

add_action('admin_init', 'cutlass_remove_dashboard_widgets');
<?php

/**
 * Theme setup
 */
function cutlass_setup() {

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

	//Register default nav menus
	register_nav_menus([
		'primary_navigation' => 'Primary Navigation'
	]);

}
add_action('after_setup_theme', 'cutlass_setup');

/**
 * Register sidebars
 */
function cutlass_widgets_init() {

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
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * From Twenty Fifteen:
 * https://github.com/WordPress/WordPress/blob/81df9bffc5ffdda9cd7c16dadef21b574f9ee922/wp-content/themes/twentyfourteen/functions.php
 *
 * @param $title
 * @param $sep
 *
 * @return string
 */
function cutlass_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() ) {
		return $title;
	}
	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );
	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}
	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}
	return $title;
}
add_filter( 'wp_title', 'cutlass_wp_title', 10, 2 );

/**
 * Theme styles and scripts setup
 */
function cutlass_scripts() {

	/**
	 * Queue our elixir styles
	 */
	wp_enqueue_style( 'all', elixir('css/all.css'), array(), null, 'all' );

	/**
	 * Queue our elixir scripts
	 */
	wp_enqueue_script( 'all', elixir('js/all.js'), array(), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'cutlass_scripts' );

/**
 * Adds helpful classes to our body tag
 * From Roots Sage theme: https://github.com/roots/sage/blob/master/lib/extras.php
 */
function cutlass_body_class($classes) {
	// Add page slug if it doesn't exist
	if (is_single() || is_page() && !is_front_page()) {
		if (!in_array(basename(get_permalink()), $classes)) {
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
function cutlass_remove_dashboard_widgets() {
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
	remove_meta_box('dashboard_quick_press', 'dashboard', 'normal');
	remove_meta_box('dashboard_primary', 'dashboard', 'normal');
	remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
}
add_action('admin_init', 'cutlass_remove_dashboard_widgets');
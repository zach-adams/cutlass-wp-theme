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
 * Theme styles and scripts setup
 */
function cutlass_scripts() {

	/**
	 * Queue our elixir styles
	 */
	wp_enqueue_style( 'all', elixir('css/all.css') );

	/**
	 * Queue our elixir scripts
	 */
	wp_enqueue_script( 'all', elixir('js/all.js'), array(), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'cutlass_scripts' );
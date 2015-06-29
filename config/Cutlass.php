<?php

/**
 * BEGIN CONFIGURATION
 * -----------------------
 */

/**
 * Global variables you want to have available in all Blade views.
 *
 * * Note: This is a key value array, so your data goes from:
 *              'site_url'  =>  get_bloginfo('url),
 *                          to:
 *              @if($site_url == "http://url.com")
 *                  {{ $site_url }}
 *              @endif
 * @var array
 */
$global_view_data = array(
	//'site_url'    =>  get_bloginfo('url),
);

/**
 * Custom Directives to add to Blade
 *
 * * OPTIONAL: Add {expression} where you want the value of the directive to go
 * * e.g.   'wpquery' => '<?php $query = new WP_Query({expression}); ?>'
 * *            so that when you use:
 * *        @wpquery(['post_type' => 'page'])
 * *            it turns into this:
 * *        <?php $query = new WP_Query(['post_type' => 'page']); ?>
 *
 * @var array
 */
$custom_directives = array(
	'wploop'    =>  '<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $post = get_post(); ?>',
	'wpquery'   =>  '<?php $query = new WP_Query({expression}); if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); $post = get_post(); ?>',
	'wpempty'   =>  '<?php endwhile; else : ?>',
	'wpend'     =>  '<?php endif; wp_reset_postdata(); ?>',
);

/**
 * The directory in which you want to have your Blade template files
 * @var string
 */
$views_directory = app_path() . '/resources/views';

/**
 * The directory in which you want to have Blade store it's cached/compiled files
 * @var string
 */
$cache_directory = app_path() . '/storage/views';

/**
 * END CONFIGURATION
 * -----------------
 */

/**
 * Apply filters
 */
$global_view_data = apply_filters('cutlass_global_view_data', $global_view_data);
$custom_directives = apply_filters('cutlass_custom_directives', $custom_directives);

/**
 * Initialize Cutlass
 */

global $cutlass;
$cutlass = new Cutlass($views_directory, $cache_directory, $custom_directives, $global_view_data);
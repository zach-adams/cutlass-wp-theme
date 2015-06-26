<?php
/**
 * Cutlass functions
 *
 * This is where the magic happens
 */

/**
 * BEGIN CONFIGURATION
 * -----------------------
 */

/**
 * Global variables you want to have available in all Blade views
 * @var array
 */
$global_view_data = array(
	//'site_url'    =>  get_bloginfo('url),
);
$global_view_data = apply_filters('cutlass_global_view_data', $global_view_data);

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
	'wploop'    =>  '<?php $query = new WP_Query({expression}); if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>',
	'wpempty'   =>  '<?php endwhile; else : ?>',
	'wpend'     =>  '<?php endif; wp_reset_postdata(); ?>',
);
$global_view_data = apply_filters('cutlass_custom_directives', $global_view_data);

/**
 * The directory in which you want to have your Blade template files
 * @var string
 */
$views_directory = get_stylesheet_directory() . '/resources/views';

/**
 * The directory in which you want to have Blade store it's cached/compiled files
 * @var string
 */
$cache_directory = get_stylesheet_directory() . '/inc/cache';

/**
 * END CONFIGURATION
 * -----------------
 */

/**
 * Require the autoloader so we can start up the Blade engine
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * Initialize Cutlass
 */
global $cutlass;
$cutlass = new Cutlass($views_directory, $cache_directory, $custom_directives);
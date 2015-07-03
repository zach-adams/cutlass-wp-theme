<?php

/**
 * BEGIN CONFIGURATION
 * -----------------------
 */

/**
 * Global variables you want to have available in all Blade views.
 *
 * * Note: This is a key value array, so your data goes from:
 *              'site_url'  =>  get_bloginfo('url'),
 *                          to:
 *              {{ $site_url }}
 * @var array
 */

$global_view_data = array(

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
	'wpposts'       =>  '<?php foreach($posts as $post) : setup_postdata($post); ?>',
	'wpendposts'    =>  '<?php endforeach; ?>',
	'wploop'        =>  '<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $post = CutlassHelper::get_post(get_the_ID()); ?>',
	'wploopempty'   =>  '<?php endwhile; else : ?>',
	'wploopend'     =>  '<?php endif; wp_reset_postdata(); ?>',
	'wploopquery'   =>  '<?php $query = new WP_Query({expression}); if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); $post = CutlassHelper::get_post(get_the_ID()); ?>',
);

$misc_settings = array(
	/**
	 * Controls WP_Post returned by CutlassHelper::get_post. If true
	 * the properties beginning with "post_" will have the "post_"
	 * prefix removed. Set to false if memory or performance is an
	 * issue.
	 */
	'post_simple_properties'    =>  true,
	/**
	 * Controls WP_Post returned by CutlassHelper::get_post. If true
	 * there will be extra helpful properties available to the WP_Post
	 * object returned. Set to false if performance is an issue.
	 */
	'post_extra_properties'     =>  true,
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
$cutlass = new Cutlass($views_directory, $cache_directory, $custom_directives, $global_view_data, $misc_settings);
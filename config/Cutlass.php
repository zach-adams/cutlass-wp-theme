<?php
use Cutlass\Cutlass;
use Cutlass\CutlassSite;

/**
 * Set the default path to the directory where Blade will read for
 * views
 *
 * @param 	$views_directory string
 * 			Default: app_path() . '/resources/views'
 *
 * @return string
 */
function set_cutlass_views_directory($views_directory) {
	return app_path() . '/resources/views';
}
add_filter('cutlass_views_directory', 'set_cutlass_views_directory', 10, 1);

/**
 * Set the default path to the directory where Blade will store
 * it's cache files
 *
 * @param 	$cache_directory string
 * 			Default: app_path() . '/storage/views'
 *
 * @return string
 */
function set_cutlass_cache_directory($cache_directory) {
	return app_path() . '/storage/views';
}
add_filter('cutlass_cache_directory', 'set_cutlass_cache_directory', 10, 1);

/**
 * Global variables you want to have available in all Blade views.
 *
 * * Note: This is a key value array, so your data goes from:
 *              'site_url'  =>  get_bloginfo('url'),
 *                          to:
 *              {{ $site_url }}
 *
 * @return array
 */
function add_cutlass_global_view_data() {
	return [
		'site'=> new CutlassSite(),
	];
}
add_filter('cutlass_global_view_data', 'add_cutlass_global_view_data', 10, 1);

/**
 * Custom Directives to add to Blade
 *
 * * OPTIONAL: Add {expression} where you want the value of the directive to go
 * * e.x.   'wpquery' => '<?php $query = new WP_Query({expression}); ?>'
 * *            so that when you use:
 * *        @wpquery(['post_type' => 'page'])
 * *            it turns into this:
 * *        <?php $query = new WP_Query(['post_type' => 'page']); ?>
 *
 * @return array;
 */
function add_custom_directives() {
	return [
			'wpposts'       =>  '<?php foreach($posts as $post) : setup_postdata($post); ?>',
			'wppostsend'    =>  '<?php endforeach; wp_reset_postdata(); ?>',
			'wppostsquery'  =>  '<?php $posts = get_posts({expression}); foreach($posts as $post) : setup_postdata($post); ?>',
			'wploop'        =>  '<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $post = Cutlass\Cutlass::get_post(); ?>',
			'wploopempty'   =>  '<?php endwhile; else : ?>',
			'wploopend'     =>  '<?php endif; wp_reset_postdata(); ?>',
			'wploopquery'   =>  '<?php $query = new WP_Query({expression}); if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); $post = Cutlass\Cutlass::get_post(); ?>',
	];
}
add_filter('cutlass_custom_directives', 'add_custom_directives', 10, 1);
<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

/**
 * $custom_directives = array(
'wpposts'       =>  '<?php foreach($posts as $post) : setup_postdata($post); ?>',
'wpendposts'    =>  '<?php endforeach; wp_reset_postdata(); ?>',
'wppostsquery'  =>  '<?php $posts = get_posts({expression}); foreach($posts as $post) : setup_postdata($post); ?>',
'wploop'        =>  '<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $post = get_post(); ?>',
'wploopempty'   =>  '<?php endwhile; else : ?>',
'wploopend'     =>  '<?php endif; wp_reset_postdata(); ?>',
'wploopquery'   =>  '<?php $query = new WP_Query({expression}); if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>',
);
 */

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot()
	{
		view()->share(['site' => new \CutlassSite()]);
		Blade::directive('wpposts', function($expression) {
			return '<?php foreach($posts as $post) : setup_postdata($post); ?>';
		});
		Blade::directive('wppostsend', function($expression) {
			return '<?php endforeach; wp_reset_postdata(); ?>';
		});
	}
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}

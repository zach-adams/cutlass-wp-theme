<?php namespace Cutlass;

use Philo\Blade\Blade;
use Cutlass\CutlassPost;

class Cutlass {

    /**
     * The unique instance of the plugin.
     *
     * @var Cutlass
     */
    private static $instance;

    /**
     * The Blade class used to render our views
     *
     * @var Blade
     */
    public static $blade;

    /**
     * Gets an instance of our plugin.
     *
     * @return Cutlass
     */
    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Makes and renders the view into a cached PHP file
     * then echos and returns it.
     *
     * @param array $filenames - An array of views to render in order of precedence
     * @param array $context - An array of items to add to the view
     *
     * @return mixed
     */
    public static function render($filenames, $context = array())
    {

        /**
         * The directory in which you want to have your Blade template files
         * Filter: 'cutlass_views_directory' - Change the location of the default Blade views directory
         * @var string
         */
        $views_directory = apply_filters('cutlass_views_directory', app_path() . '/resources/views');

        /**
         * The directory in which you want to have Blade store it's cached/compiled files
         * Filter: 'cutlass_cache_directory' - Change the location of the Blade cache
         * @var string
         */
        $cache_directory = apply_filters('cutlass_cache_directory', app_path() . '/storage/views');

        /**
         * Blade Engine
         */
        self::$blade = new Blade($views_directory, $cache_directory);

        $cutlassrenderer = new CutlassRenderer($filenames, $context, self::$blade);

        $output = $cutlassrenderer->render();

        echo $output;
        return $output;

    }

    /**
     * get_title
     *
     * Returns a nice formatted title according to which page
     * we're on.
     *
     * From Root's Sage
     * https://github.com/roots/sage
     *
     * @param null|int $post_id
     *
     * @return string
     */
    public static function get_page_title( $post_id = 0 ) {

        if (is_home()) {
            if (get_option('page_for_posts', true)) {
                return get_the_title(get_option('page_for_posts', true));
            } else {
                return 'Latest Posts';
            }
        } elseif (is_archive()) {
            return get_the_archive_title();
        } elseif (is_search()) {
            return 'Search Results for ' . get_search_query();
        } elseif (is_404()) {
            return 'Not Found';
        } else {
            return get_the_title($post_id);
        }

    }

    /**
     * get_posts
     *
     * Checks global wp_query for posts and returns them,
     * otherwise runs get_posts on passed query
     *
     * @param array $query
     *
     * @return array
     */
    public static function get_posts($query = array()) {
        global $wp_query;
        global $cutlass;

        /**
         * Set return var
         */
        $posts = array();

        /**
         * If the query's empty and the global WP_Query has posts grab them
         * else just grab the posts the normal way
         */
        if( empty($query) && property_exists($wp_query, 'posts') && !empty($wp_query->posts))
            $posts = $wp_query->posts;
        else
            $posts = get_posts($query);

        /**
         * Return empty if either of those fail
         */
        if( empty($posts) )
            return array();

        /**
         * Convert WP_Posts to CutlassPosts
         */
        self::convert_posts($posts);

        /**
         * Return array of CutlassPosts
         */
        return $posts;

    }

    /**
     * get_post
     *
     * Gets the post and converts it into a CutlassPost
     * which grants us some nifty methods and properties
     *
     * @param int $postid
     *
     * @return CutlassPost
     */
    public static function get_post( $postid = null ) {

        /**
         * If postid is empty get the ID the normal way
         */
        if(empty($postid))
            $postid = get_the_ID();

        /**
         * Grab post using postid
         */
        $post = get_post($postid);

        /**
         * If it's a correct WP_Post convert it to a
         * CutlassPost
         */
        if ( is_a($post, 'WP_Post'))
            return new CutlassPost($post);

        /**
         * Return null if all else fails
         */
        return null;

    }

    /**
     * convert_posts
     *
     * Converts WP_Posts to CutlassPosts
     *
     * * Note: We use array_walk over foreach for memory conservation because
     * * the gained time is not worth the memory lost
     *
     * @param array|WP_Post $posts
     *
     * @return null|WP_Post
     */
    public static function convert_posts(&$posts) {

        /**
         * If it's already CutlassPost just return
         */
        if( is_a($posts, 'CutlassPost') )
            return null;

        /**
         * If it's a single WP_Post object convert it
         * and return
         */
        if (is_a($posts, 'WP_Post') ) {
            $posts = new CutlassPost($posts);
            return $posts;
        }

        /**
         * Convert all posts
         */
        array_walk($posts, function(&$value, $key) {
            $value = new CutlassPost($value);
        });

    }
}
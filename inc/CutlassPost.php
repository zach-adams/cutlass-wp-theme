<?php namespace Cutlass;

use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * CutlassPost Class
 *
 * Converts a WP_Post object into a much more useable
 * object that we can use to easily access common
 * wp properties and methods
 */
class CutlassPost
{

    /**
     * The posts id
     * @var int
     */
    public $ID = 0;

    /**
     * The posts link
     * @var string
     */
    public $link = '';

    public $permalink = '';

    /**
     * A human readable post date
     * * i.e. 2015-03-05 12:53:12 to 3 months ago
     *
     * @var string
     */
    public $human_date = '';

    /**
     * The post author's name
     * @var string
     */
    public $author = '';

    public $post_author = '';

    /**
     * The post slug name
     * @var string
     */
    public $name = '';

    public $post_name = '';

    /**
     * The post type
     * @var string
     */
    public $type = '';

    public $post_type = '';

    /**
     * The post title
     * @var string
     */
    public $title = '';

    public $post_title = '';

    /**
     * The post date
     * @var string
     */
    public $date = '';

    public $post_date = '';

    /**
     * The post date in GMT
     * @var string
     */
    public $date_gmt = '';

    public $post_date_gmt = '';

    /**
     * The post content
     * @var string
     */
    public $content = '';

    public $post_content = '';

    /**
     * The posts current status
     * @var string
     */
    public $status = '';

    public $post_status = '';

    /**
     * The current comment status (whether comments are enabled
     * or disabled)
     * @var string
     */
    public $comment_status = '';

    /**
     * The current ping status (whether this post can receive
     * pings or not)
     * @var string
     */
    public $ping_status = '';

    /**
     * The posts password if it has one
     * @var string
     */
    public $password = '';

    public $post_password = '';

    /**
     * When the post was last modified
     * @var string
     */
    public $modified = '';

    public $post_modified = '';

    /**
     * When the post was last modified in GMT
     * @var string
     */
    public $modified_gmt = '';

    public $post_modified_gmt = '';

    /**
     * Number of comments for this post (in string for
     * whatever reason)
     * @var string
     */
    public $comment_count = '';

    /**
     * Order of this post in the menu
     * @var string
     */
    public $menu_order = '';


    /**
     * __construct
     *
     * Accepts a WP_Post object and builds a new
     * CutlassPost object using it's properties
     *
     * @param $post WP_Post
     */
    public function __construct($post)
    {

        /**
         * If we're given an int we'll convert it to a WP_Post object
         */
        if (is_int($post)) {
            $post = get_post($post);
        }

        /**
         * Takes the original WP_Post properties and moves them to
         * this CutlassPost object
         */
        $this->set_properties($post);

        /**
         * Adds our extra simple properties to the object
         */
        $this->extra_properties($post);

    }


    /**
     * extra_properties
     *
     * Accepts a WP_Post object and sets additional helpful
     * properties to this CutlassPost object
     *
     * @param WP_Post $post
     */
    private function extra_properties($post)
    {

        /**
         * Sets the post link
         */
        $this->link      = get_permalink($post->ID);
        $this->permalink = $this->link;
        /**
         * Set human date property using Carbon
         */
        $date             = ( property_exists($this, 'date') ? $this->date : $this->post_date );
        $this->human_date = Carbon::parse($date)->diffForHumans();
        /**
         * Set author property to actual author data
         */
        $author       = ( property_exists($this, 'author') ? $this->author : $this->post_author );
        $this->author = get_userdata(intval($author));

    }


    /**
     * set_properties
     *
     * Accepts WP_Post object, takes its properties and
     * applies them to this CutlassPost object
     *
     * @param WP_Post $post
     */
    private function set_properties($post)
    {

        /**
         * Get WP_Post properties
         */
        $props = get_object_vars($post);

        /**
         * Apply WP_Post properties to this CutlassPost object
         */
        foreach ($props as $key => $prop) {
            $this->$key = $prop;
        }

        /**
         * Make "easy" properties
         * * i.e. $this->post_date to $this->date
         */
        foreach ($props as $key => $prop) {
            if (substr($key, 0, 5) === "post_") {
                $new        = substr($key, 5, strlen($key));
                $this->$new = $prop;
            }
        }

    }


    /**
     * comments
     *
     * Gets all comments for this post
     *
     * @param $args array
     *
     * @return mixed
     */
    public function comments($args = [ ])
    {

        if ( ! isset( $args['post_id'] )) {
            $args['post_id'] = $this->ID;
        }

        return get_comments($args);

    }


    public function author()
    {

        return $this->author;

    }


    /**
     * post_class
     *
     * Returns the post class
     *
     * @param bool   $echo
     * @param null $class
     *
     * @return mixed
     */
    public function post_class($echo = true, $class = null)
    {

        $class = 'class="' . join( ' ', get_post_class( $class, $this->ID ) ) . '"';

        if ($echo === true) {
            echo $class;
        } else {
            return $class;
        }

    }


    /**
     * tags
     *
     * Gets the tags for this post, accepts array of args
     *
     * @param array $args
     *
     * @return array
     */
    public function tags($args = [ ])
    {

        return wp_get_post_tags($this->ID, $args);

    }


    /**
     * terms
     *
     * Gets the terms for this post, accepts a taxonomy
     * array and an args array
     *
     * @param String|array $tax
     * @param array        $args
     *
     * @return array
     */
    public function terms($tax = 'post_tag', $args = [ ])
    {

        $terms = wp_get_post_terms($this->ID, $tax, $args);

        if (empty( $terms ) || is_a($terms, 'WP_Error')) {
            return [ ];
        }

        return $terms;

    }


    /**
     * thumbnail
     *
     * Gets the posts featured image
     *
     * @param bool $echo
     * @param String|array $size
     * @param String|array $attr
     *
     * @return String
     */
    public function thumbnail($echo = true, $size = 'thumbnail', $attr = '')
    {
        if($echo === true) {
            echo get_the_post_thumbnail($this->ID, $size, $attr);
        } else {
            return get_the_post_thumbnail($this->ID, $size, $attr);
        }

    }


    /**
     * can_edit
     *
     * Returns bool for whether the current user
     * can edit the this post
     *
     * @return bool
     */
    public function can_edit()
    {

        return current_user_can('edit_posts');

    }


    /**
     * field
     *
     * Proxy for ACF's get_field, if ACF isn't installed
     * then get this post custom meta.
     *
     * @param String $key
     * @param bool   $echo
     * @param bool   $format_value
     *
     * @return Mixed
     */
    public function field($key, $echo = false, $format_value = true)
    {

        if ( ! function_exists('get_field')) {
            return $this->meta($key, $format_value);
        }

        if ($echo) {
            $val = get_field($key, $this->ID, $format_value);
            echo $val;

            return $val;
        }

        return get_field($key, $this->ID, $format_value);

    }


    /**
     * meta
     *
     * Gets this posts meta
     *
     * @param String $key
     * @param bool   $single
     *
     * @return Mixed
     */
    public function meta($key, $single = false)
    {

        return get_post_meta($this->ID, $key, $single);

    }


    /**
     * children
     *
     * Gets this posts children
     *
     * @var array args
     *
     * @return array
     */
    public function children($args = [ 'post_type' => 'any' ])
    {
        global $cutlass;

        if (is_string($args)) {
            $args = [
                'post_type' => $args,
            ];
        }

        /**
         * Make sure essential args are set
         */
        if ( ! array_key_exists('post_parent', $args)) {
            $args['post_parent'] = $this->ID;
        }
        if ( ! array_key_exists('post_type', $args)) {
            $args['post_type'] = 'any';
        }

        $children = get_children($args);

        if (empty( $children )) {
            return [ ];
        }

        /**
         * Convert WP_Post objects to CutlassPost objects
         */
        if ($cutlass->misc_settings['enable_simple_posts'] === true) {
            CutlassHelper::convert_posts($children);
        }

        return $children;

    }


    /**
     * link
     *
     * Returns the post's permalink
     *
     * @param bool $relative
     *
     * @return String
     */
    public function link($relative = false)
    {

        if ( ! empty( $this->link )) {
            return ( $relative === true ? wp_make_link_relative($this->link) : $this->link );
        }

        if ( ! empty( $this->permalink )) {
            return ( $relative === true ? wp_make_link_relative($this->permalink) : $this->permalink );
        }

        return ( $relative === true ? wp_make_link_relative(get_permalink($this->ID)) : get_permalink($this->ID) );

    }


    /**
     * excerpt
     *
     * Returns a nicely formatted excerpt.
     *
     * @param int    $length
     * @param string $ellipsis
     *
     * @return String
     */
    public function excerpt($length = 55, $ellipsis = "...")
    {

        return sanitize_text_field(strip_shortcodes(Str::words($this->content, $length, $ellipsis)));

    }


    /**
     * title
     *
     * Returns the post title after the filters have been run on it
     *
     * @param int    $length
     * @param string $ellipsis
     *
     * @return String
     */
    public function title($length = 0, $ellipsis = "...")
    {

        $title = ( property_exists($this, 'title') ? $this->title : $this->post_title );

        $title = apply_filters('the_title', $title);

        if ( ! empty( $length ) && is_int($length)) {
            $title = Str::words($title, $length, $ellipsis);
        }

        return $title;

    }


    /**
     * content
     *
     * Returns the post content after the filters have been run on it
     *
     * @param bool   $echo
     * @param string $ellipsis
     * @param int    $length
     *
     * @return String
     */
    public function content($echo = true, $ellipsis = "...", $length = null)
    {

        $content = ( property_exists($this, 'content') ? $this->content : $this->post_content );

        /**
         * Apply filter
         */
        $content = apply_filters('the_content', $content);

        /**
         * Replace string
         * * See: https://core.trac.wor dpress.org/browser/tags/4.2.2/src/wp-includes/post-template.php#L220
         */
        $content = str_replace(']]>', ']]&gt;', $content);

        if (is_int($length)) {
            $content = Str::words($content, $length, $ellipsis);
        }

        if ($echo === true) {
            echo $content;
        } else {
            return $content;
        }

    }
}
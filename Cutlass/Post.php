<?php namespace Cutlass;

use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * Converts a WP_Post object into a much more useable object that we can
 * use to easily access common wp properties and methods
 */
class Post
{

    /**
     * The posts id
     * @var int
     */
    public $ID;

    /**
     * The posts link
     * @var string
     */
    public $link, $permalink;

    /**
     * The post author's name
     * @var string
     */
    public $author, $post_author;

    /**
     * The post slug name
     * @var string
     */
    public $name, $post_name;

    /**
     * The post type
     * @var string
     */
    public $type, $post_type;

    /**
     * The post title
     * @var string
     */
    public $title, $post_title;

    /**
     * The post date
     * @var string
     */
    public $date, $post_date, $human_date;

    /**
     * The post date in GMT
     * @var string
     */
    public $date_gmt, $post_date_gmt, $human_date_gmt;

    /**
     * The post content
     * @var string
     */
    public $content, $post_content;

    /**
     * The posts current status
     * @var string
     */
    public $status, $post_status;

    /**
     * The posts mimetype
     * @var string
     */
    public $post_mime_type, $mime_type;

    /**
     * The current comment status (whether comments are enabled
     * or disabled)
     * @var string
     */
    public $comment_status;

    /**
     * The current ping status (whether this post can receive
     * pings or not)
     * @var string
     */
    public $ping_status;

    /**
     * The posts password if it has one
     * @var string
     */
    public $password, $post_password;

    /**
     * When the post was last modified
     * @var string
     */
    public $modified, $post_modified, $human_modified;

    /**
     * When the post was last modified in GMT
     * @var string
     */
    public $modified_gmt, $post_modified_gmt, $human_modified_gmt;

    /**
     * Number of comments for this post (in string for
     * whatever reason)
     * @var string
     */
    public $comment_count;

    /**
     * Order of this post in the menu
     * @var string
     */
    public $menu_order;


    /**
     * Accepts a WP_Post object and builds a new Post object using
     * it's properties
     *
     * @param $post \WP_Post|array
     *
     * @throws \Exception
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
         * If we're given an array we'll assume it's a query
         */
        if (is_array($post)) {
            $post['posts_per_page'] = 1;
            $post                   = get_posts($post);

            if (isset( $post[0] )) {
                $post = $post[0];
            }
        }

        /**
         * If we don't have a WP_Post by now throw an Exception
         */
        if ( ! $post instanceof \WP_Post) {
            throw new \Exception('This Post was not able to convert the arguments into a valid WP_Post object.');
        }

        /**
         * Takes the original WP_Post properties and moves them to
         * this Post object
         */
        $this->set_properties($post);

    }


    /**
     * Accepts WP_Post object, takes its properties and
     * applies them to this Post object
     *
     * @param \WP_Post $post
     */
    protected function set_properties($post)
    {

        /**
         * Get WP_Post properties
         */
        $props = get_object_vars($post);

        /**
         * Apply WP_Post properties to this Post object
         */
        foreach ($props as $key => $prop) {

            $this->$key = $prop;

            if (substr($key, 0, 5) === "post_") {
                $new        = substr($key, 5, strlen($key));
                $this->$new =& $this->$key;
            }
        }

        /**
         * Sets the post link
         */
        $this->link      = get_permalink($post->ID);
        $this->permalink =& $this->link;

        /**
         * Set human dates property using Carbon
         */
        $this->human_date         = Carbon::parse($this->date)->diffForHumans();
        $this->human_date_gmt     = Carbon::parse($this->date_gmt)->diffForHumans();
        $this->human_modified     = Carbon::parse($this->modified)->diffForHumans();
        $this->human_modified_gmt = Carbon::parse($this->modified_gmt)->diffForHumans();

        if ( ! $this->author instanceof User) {
            $this->author = new User(intval($this->author));
        }

    }


    /**
     *
     * Get extended entry info (<!--more-->).
     *
     * There should not be any space after the second dash and before the word
     * 'more'. There can be text or space(s) after the word 'more', but won't be
     * referenced.
     *
     * The returned array has 'main', 'extended', and 'more_text' keys. Main has the text before
     * the `<!--more-->`. The 'extended' key has the content after the
     * `<!--more-->` comment. The 'more_text' key has the custom "Read More" text.
     *
     * @param string $return - The type of item to return, must be string and "main", "extended", or "more_text
     * @param bool   $echo   - Whether to echo or return value
     *
     * @return string|void
     */
    public function extended($return = 'main', $echo = true)
    {

        if ( ! in_array($return, [ 'main', 'extended', 'more_text' ])) {
            throw new \InvalidArgumentException('Only accepts string "main", "extended", or "more_text". Input was: ' . $return);
        }

        $extended = get_extended($this->content);

        if ($echo === false) {
            return $extended[$return];
        }

        echo $extended[$return];

    }


    /**
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


    /**
     * Simply returns the author of this post
     *
     * @return string
     */
    public function author()
    {

        return $this->author;

    }


    /**
     * Returns the post class
     *
     * @param null $class
     * @param bool $echo
     *
     * @return mixed
     */
    public function post_class($class = null, $echo = true)
    {

        $class = 'class="' . join(' ', get_post_class($class, $this->ID)) . '"';

        if ($echo === false) {
            return $class;
        }

        echo $class;

    }


    /**
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
     * Gets the categories for this post
     *
     * @param array $args Optional. Category arguments. Default empty.
     *
     * @return array Array of category objects
     */
    public function categories($args = [ ])
    {

        $category_ids = wp_get_post_categories($this->ID, $args);
        $categories   = [ ];

        foreach ($category_ids as $category_id) {
            $categories[] = get_category($category_id);
        }

        return $categories;

    }


    /**
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
     * Gets the posts featured image
     * Returns thumbnail by default
     *
     * @param String|array $size
     * @param String|array $attr
     * @param bool         $echo
     *
     * @return String|void
     */
    public function thumbnail($size = 'thumbnail', $attr = '', $echo = true)
    {

        if ($echo === false) {
            return get_the_post_thumbnail($this->ID, $size, $attr);
        }

        echo get_the_post_thumbnail($this->ID, $size, $attr);

    }


    /**
     * Gets the posts featured image (a little more verbosely)
     * Returns full size by default
     *
     * @param String|array $size
     * @param String|array $attr
     * @param bool         $echo
     *
     * @return String|void
     */
    public function featured_image($size = 'full', $attr = '', $echo = true)
    {

        if ($echo === false) {
            return get_the_post_thumbnail($this->ID, $size, $attr);
        }

        echo get_the_post_thumbnail($this->ID, $size, $attr);

    }


    /**
     * Returns whether the currenst post has a featured image
     *
     * @return Bool
     */
    public function has_thumbnail()
    {

        return has_post_thumbnail($this->ID);

    }


    /**
     * Returns whether the currenst post has a featured image
     *
     * @return Bool
     */
    public function has_featured_image()
    {

        return has_post_thumbnail($this->ID);

    }


    /**
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
     * Displays a link to edit the current post
     *
     * @param string $link   Optional. Anchor text.
     * @param string $before Optional. Display before edit link.
     * @param string $after  Optional. Display after edit link.
     *
     * @return void
     */
    public function edit_link($link = 'Edit this', $before, $after)
    {

        edit_post_link($link, $before, $after, $this->ID);

    }


    /**
     * Proxy for ACF's get_field, if ACF isn't installed
     * then get this post custom meta.
     *
     * @param String $key
     * @param bool   $format_value
     * @param bool   $echo
     *
     * @return Mixed|void
     */
    public function field($key, $format_value = true, $echo = true)
    {

        if ( ! function_exists('get_field')) {
            return $this->meta($key, $format_value);
        }

        if ($echo === false) {
            return get_field($key, $this->ID, $format_value);
        }

        echo get_field($key, $this->ID, $format_value);

    }


    /**
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
     * Check if post is sticky.
     *
     * @return bool
     */
    public function is_sticky()
    {

        return is_sticky($this->ID);

    }


    /**
     * Gets this posts children
     *
     * @var array args
     *
     * @return array
     */
    public function children($args = [ 'post_type' => 'any' ])
    {

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

        Cutlass::convert_posts($children);

        return $children;

    }


    /**
     * Returns the post's permalink
     *
     * @param bool $relative
     *
     * @return String
     */
    public function link($relative = false)
    {

        return ( $relative === true ? wp_make_link_relative($this->link) : $this->link );

    }


    /**
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
     * Returns the post title after the filters have been run on it
     *
     * @param int    $length
     * @param string $ellipsis
     * @param bool   $echo
     *
     * @return String|void
     */
    public function title($length = 0, $ellipsis = "...", $echo = true)
    {

        $title = ( property_exists($this, 'title') ? $this->title : $this->post_title );

        $title = apply_filters('the_title', $title);

        if ( ! empty( $length ) && is_int($length)) {
            $title = Str::words($title, $length, $ellipsis);
        }

        if ($echo === false) {
            return $title;
        }

        echo $title;

    }


    /**
     * Returns the post content after the filters have been run on it
     *
     * @param string $ellipsis
     * @param int    $length
     * @param bool   $echo
     *
     * @return String|void
     */
    public function content($ellipsis = "...", $length = null, $echo = true)
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

        if ($echo === false) {
            return $content;
        }

        echo $content;

    }
}
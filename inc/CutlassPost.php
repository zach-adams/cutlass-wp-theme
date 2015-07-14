<?php
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * CutlassPost Class
 *
 * Converts a WP_Post object into a much more useable
 * object that we can use to easily access common
 * wp properties and methods
 */
class CutlassPost {

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
	public function __construct( $post ) {
		global $cutlass;

		/**
		 * Takes the original WP_Post properties and moves them to
		 * this CutlassPost object
		 */
		$this->set_properties($post, $cutlass->misc_settings['enable_post_simple_properties']);

		/**
		 * Sets extra helpful properties
		 */
		if ($cutlass->misc_settings['enable_post_extra_properties'] === true) {
			$this->extra_properties($post);
		}

	}

	/**
	 * extra_properties
	 *
	 * Accepts a WP_Post object and sets additional helpful
	 * properties to this CutlassPost object
	 *
	 * @param WP_Post $post
	 */
	private function extra_properties( $post ) {

		/**
		 * Sets the post link
		 */
		$this->link     = get_permalink($post->ID);
		$this->permalink = $this->link;
		/**
		 * Set human date property using Carbon
		 */
		$date = (property_exists($this, 'date') ? $this->date : $this->post_date);
		$this->human_date = Carbon::parse( $date )->diffForHumans();
		/**
		 * Set author property to actual author data
		 */
		$author = (property_exists($this, 'author') ? $this->author : $this->post_author);
		$this->author     = get_userdata( intval($author) );

	}

	/**
	 * set_properties
	 *
	 * Accepts WP_Post object, takes its properties and
	 * applies them to this CutlassPost object
	 *
	 * @param WP_Post $post
	 * @param bool $addSimple
	 */
	private function set_properties( $post, $addSimple = false ) {

		/**
		 * Get WP_Post properties
		 */
		$props = get_object_vars($post);

		/**
		 * Apply WP_Post properties to this CutlassPost object
		 */
		foreach($props as $key => $prop) {
			$this->$key = $prop;
		}

		/**
		 * If we're adding simple properties, go through the properties
		 * and remove "post_" from any properties
		 */
		if($addSimple === true) {

			foreach($props as $key => $prop) {
				if(substr($key, 0, 5) === "post_") {
					$new = substr($key, 5, strlen($key));
					$this->$new = $prop;
				}
			}

		}

	}

	/**
	 * comments
	 *
	 * Gets all comments for this post
	 *
	 * return @mixed
	 */
	public function comments() {

		return get_comments(['post_id' => $this->ID]);

	}

	/**
	 * post_class
	 *
	 * Returns the post class
	 *
	 * @param null $class
	 * @param null $post_id
	 *
	 * @return mixed
	 */
	public function post_class( $class = null, $post_id = null) {

		return post_class($class, $post_id);

	}

	/**
	 * tags
	 *
	 * Gets the tags for this post, accepts array of args
	 *
	 * @param Array $args
	 *
	 * @return Array
	 */
	public function tags( $args = array()) {

		return wp_get_post_tags($this->ID, $args);

	}

	/**
	 * terms
	 *
	 * Gets the terms for this post, accepts a taxonomy
	 * array and an args array
	 *
	 * @param String|Array $tax
	 * @param Array $args
	 *
	 * @return Array
	 */
	public function terms( $tax = 'post_tag', $args = array()){

		$terms = wp_get_post_terms($this->ID, $tax, $args);

		if(empty($terms) || is_a($terms, 'WP_Error'))
			return array();

		return $terms;

	}

	/**
	 * thumbnail
	 *
	 * Gets the posts featured image
	 *
	 * @param String|Array $size
	 *
	 * @return String
	 */
	public function thumbnail( $size = 'thumbnail' ) {

		return get_the_post_thumbnail($this->ID, $size);

	}

	/**
	 * can_edit
	 *
	 * Returns bool for whether the current user
	 * can edit the this post
	 *
	 * @return bool
	 */
	public function can_edit() {

		return current_user_can('edit_posts');

	}

	/**
	 * field
	 *
	 * Proxy for ACF's get_field, if ACF isn't installed
	 * then get this post custom meta.
	 *
	 * @param String $key
	 * @param bool $echo
	 * @param bool $format_value
	 *
	 * @return Mixed
	 */
	public function field( $key, $echo = true,  $format_value = true){

		if(!function_exists('get_field'))
			return $this->meta($key, $format_value);

		if($echo) {
			echo get_field($key, $this->ID, $format_value);
			return;
		}

		return get_field($key, $this->ID, $format_value);

	}

	/**
	 * meta
	 *
	 * Gets this posts meta
	 *
	 * @param String $key
	 * @param bool $single
	 *
	 * @return Mixed
	 */
	public function meta( $key, $single = false ) {

		return get_post_meta($this->ID, $key, $single);

	}

	/**
	 * children
	 *
	 * Gets this posts children
	 *
	 * @var Array args
	 *
	 * @return Array
	 */
	public function children( $args = array('post_type'=>'any') ) {

		/**
		 * Make sure essential args are set
		 */
		if(!isset($args['post_parent']))
			$args['post_parent'] = $this->ID;
		if(!isset($args['post_type']))
			$args['post_type'] = 'any';

		$children = get_children($args);

		if(empty($children))
			return array();

		/**
		 * Convert WP_Post objects to CutlassPost objects
		 */
		CutlassHelper::convert_posts($children);

		return $children;

	}

	/**
	 * excerpt
	 *
	 * Returns a nicely formatted excerpt.
	 *
	 * @param int $length
	 * @param string $ellipsis
	 *
	 * @return String
	 */
	public function excerpt($length = 55, $ellipsis = "...") {

		return sanitize_text_field(strip_shortcodes(Str::words($this->content, $length, $ellipsis)));

	}

	/**
	 * title
	 *
	 * Returns the post title after the filters have been run on it
	 *
	 * @param int $length
	 * @param string $ellipsis
	 *
	 * @return String
	 */
	public function title($length = 0, $ellipsis = "...") {

		$title = (property_exists($this, 'title') ? $this->title : $this->post_title);

		$title = apply_filters('the_title', $title);

		if( !empty($length) && is_int($length) ) {
			$title = Str::words($title, $length, $ellipsis);
		}

		return $title;

	}

	/**
	 * content
	 *
	 * Returns the post content after the filters have been run on it
	 *
	 * @param int $length
	 * @param string $ellipsis
	 *
	 * @return String
	 */
	public function content($length = 0, $ellipsis = "...") {

		$content = (property_exists($this, 'content') ? $this->content : $this->post_content);

		/**
		 * Apply filter
		 */
		$content = apply_filters('the_content', $content);

		/**
		 * Replace string
		 * * See: https://core.trac.wordpress.org/browser/tags/4.2.2/src/wp-includes/post-template.php#L220
		 */
		$content = str_replace( ']]>', ']]&gt;', $content );

		if( !empty($length) && is_int($length) )
			$content = Str::words($content, $length, $ellipsis);

		echo $content;

	}
}
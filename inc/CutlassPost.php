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
	 * __construct
	 *
	 * Accepts a WP_Post object and builds a new
	 * CutlassPost object using it's properties
	 *
	 * @var $post WP_Post
	 */
	public function __construct( $post ) {
		global $cutlass;

		/**
		 * Takes the original WP_Post properties and moves them to
		 * this CutlassPost object
		 */
		$this->set_properties($post, $cutlass->misc_settings['post_simple_properties']);

		/**
		 * Sets extra helpful properties
		 */
		if ($cutlass->misc_settings['post_extra_properties'] === true) {
			$this->extra_properties($post);
		}

	}

	/**
	 * extra_properties
	 *
	 * Accepts a WP_Post object and sets additional helpful
	 * properties to this CutlassPost object
	 *
	 * @var $post WP_Post
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
	 * @var $post WP_Post
	 * @var $addSimple bool
	 */
	private function set_properties( $post, $addSimple = false ) {

		/**
		 * Get WP_Post properties
		 */
		$props = get_object_vars($post);

		/**
		 * Apply WP_Post properties to this CutlassPost object
		 */
		array_walk($props, function(&$value, $key) {
			$this->$key = $value;
		} );

		/**
		 * If we're adding simple properties, go through the properties
		 * and remove "post_" from any properties
		 */
		if($addSimple === true) {

			array_walk($props, function(&$value, $key) {
				if(substr($key, 0, 5) === "post_") {
					$new = substr($key, 5, strlen($key));
					$this->$new = $value;
				}
			} );

		}

		/**
		 * Apply common WP filters to our object
		 */
		$this->apply_filters($addSimple);

	}

	/**
	 * apply_filters
	 *
	 * Apply common WP filters to our properties
	 *
	 * @var $addSimple bool
	 */
	private function apply_filters($addSimple = false) {

		if ($addSimple)
			$this->content = apply_filters('the_content', $this->content);
		else
			$this->post_content = apply_filters('the_content', $this->post_content);

		if ($addSimple)
			$this->title = apply_filters('the_title', $this->title);
		else
			$this->post_title = apply_filters('the_title', $this->post_title);

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
	 * tags
	 *
	 * Gets the tags for this post, accepts array of args
	 *
	 * @var $args Array
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
	 * @var $tax String|Array
	 * @var $args Array
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
	 * @var $size String|Array
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
	 * @var $key String
	 * @var $format_value bool
	 *
	 * @return Mixed
	 */
	public function field( $key, $format_value = true){

		if(!function_exists('get_field'))
			return $this->meta($key, $format_value);

		return get_field($key, $this->ID, $format_value);

	}

	/**
	 * meta
	 *
	 * Gets this posts meta
	 *
	 * @var $key String
	 * @var $single bool
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
	 * @var args Array
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
	 * @var $length int
	 *
	 * @return String
	 */
	public function excerpt($length = 55) {

		return sanitize_text_field(strip_shortcodes(Str::words($this->content, $length)));

	}
}
<?php
use Carbon\Carbon;
use Illuminate\Support\Str;

class CutlassPost {

	public function __construct( $post ) {
		global $cutlass;

		$this->set_properties($post, $cutlass->misc_settings['post_simple_properties']);

		if ($cutlass->misc_settings['post_extra_properties'] === true) {
			$this->extra_properties($post);
		}

	}

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

	private function set_properties( $post, $addSimple = false ) {

		$props = get_object_vars($post);

		array_walk($props, function(&$value, $key) {
			$this->$key = $value;
		} );

		if($addSimple === true) {

			array_walk($props, function(&$value, $key) {
				if(substr($key, 0, 5) === "post_") {
					$new = substr($key, 5, strlen($key));
					$this->$new = $value;
				}
			} );

			$this->apply_simple_filters();

		}

	}

	private function apply_simple_filters() {

		$this->content = apply_filters('the_content', $this->content);
		$this->title = apply_filters('the_title', $this->title, $this->ID);

	}

	public function comments(){

		return get_comments(['post_id' => $this->ID]);

	}
	
	public function tags( $args = array()) {

		return wp_get_post_tags($this->ID, $args);
	    
	}
	
	public function terms( $tax = array(), $args = array()){
		
		$terms = wp_get_post_terms($this->ID, $tax, $args);

		if(empty($terms) || is_a($terms, 'WP_Error'))
			return array();

		return $terms;
	    
	}

	public function thumbnail( $size = 'thumbnail' ) {

		return get_the_post_thumbnail($this->ID, $size);

	}

	public function can_edit() {

		return current_user_can('edit_posts');

	}

	public function field( $key, $format_value = true){

		if(!function_exists('get_field'))
			return $this->get_meta($key, $format_value);

		return get_field($key, $this->ID, $format_value);

	}

	public function meta( $key, $single = false ) {

		return get_post_meta($this->ID, $key, $single);

	}

	public function children( $args = array('post_type'=>'any') ) {

		if(!isset($args['post_parent']))
			$args['post_parent'] = $this->ID;
		if(!isset($args['post_type']))
			$args['post_type'] = 'any';

		$children = get_children($args);
		
		if(empty($children))
			return array();

		CutlassHelper::convert_posts($children);

		return $children;
		
	}
	public function excerpt() {

		return sanitize_text_field(strip_shortcodes(Str::words($this->content, 55)));

	}
}
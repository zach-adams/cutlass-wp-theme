<?php
use Carbon\Carbon;
/**
 * The helper class
 *
 * Contains various functions and utilities to ease development
 */
class CutlassHelper {

	/**
	 * get_title
	 *
	 * Returns a nice formatted title according to which page
	 * we're on.
	 *
	 * From Root's Sage
	 * https://github.com/roots/sage
	 *
	 * return @string
	 */
	public static function get_title() {

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
			return get_the_title();
		}

	}

	/**
	 * get_posts
	 *
	 * Checks global wp_query for posts and returns them,
	 * otherwise runs get_posts on passed query
	 *
	 * @param array $query
	 * @return array
	 */
	public static function get_posts($query = array()) {

		$posts = array();

		if( empty($query) ) {
			global $wp_query;

			if( property_exists($wp_query, 'posts') && !empty($wp_query->posts) )
				$posts = $wp_query->posts;
		} else {
			$posts = get_posts($query);
		}

		return $posts;

	}

	/**
	 * get_post
	 *
	 * Gets the post. A little more fancy than WP's default get_post.
	 *
	 * @return array
	 */
	public static function get_post( $post = null ) {
		global $cutlass;

		/**
		 * Set our return var
		 */
		$_post = null;

		/**
		 * If there is no post to get or the post is not a WP_Post just
		 * run get_post like normal
		 */
		if ( empty( $post ) ) {
			$_post = get_post();
		} elseif( !is_a($post, 'WP_Post') ) {
			$_post = get_post($post);

			/**
			 * If it's still empty return null
			 */
			if( empty($_post) )
				return null;
		}

		/**
		 * Set post properties that begin with post_ without the post_
		 */
		if( $cutlass->misc_settings['post_simple_properties'] === true) {
			$props = get_object_vars($_post);
			array_walk($props, function(&$value, $key) use (&$_post) {
				if(substr($key, 0, 5) === "post_") {
					$new = substr($key, 5, strlen($key));
					$_post->$new = $value;
				}
			} );
		}

		/**
		 * Set human readable date with Carbon
		 */
		if( $cutlass->misc_settings['post_extra_properties'] === true) {
			/**
			 * Sets the post link
			 */
			$_post->link     = get_permalink($_post->ID);
			/**
			 * Set human date property using Carbon
			 */
			$date = (property_exists($_post, 'date') ? $_post->date : $_post->post_date);
			$_post->human_date = Carbon::parse( $date )->diffForHumans();
			/**
			 * Set author property to actual author data
			 */
			$author = (property_exists($_post, 'author') ? $_post->author : $_post->post_author);
			$_post->author     = get_userdata( intval($author) );
			/**
			 * Set categories to actual categories of post
			 */
			$_post->categories = get_the_category($_post->ID);
			/**
			 * Set post children
			 */
			$_post->children = get_children(['post_parent' => $_post->ID]);
			/**
			 * Set post comments
			 */
			$_post->comments = get_comments(['post_id' => $_post->ID]);
		}

		//dd($_post);

		return $_post;

	}
}
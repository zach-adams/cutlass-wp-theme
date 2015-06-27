<?php

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
}
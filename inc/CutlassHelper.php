<?php

/**
 * The helper class
 *
 * Contains various functions and utilities to ease development
 */
class CutlassHelper {

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
}
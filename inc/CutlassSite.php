<?php

/**
 * CutlassSite Class
 *
 * Allows us to quickly and easily access common WordPress
 * options and blog info.
 */
class CutlassSite {

	/**
	 * info
	 *
	 * Allows us to easily access the bloginfo wp function
	 *
	 * return @mixed
	 */
	public function info($value, $filter = 'raw') {

		return get_bloginfo($value, $filter);

	}

	/**
	 * option
	 *
	 * Allows us to easily access the option wp function
	 *
	 * return @mixed
	 */
	public function option($value) {

		return get_option($value);

	}

}
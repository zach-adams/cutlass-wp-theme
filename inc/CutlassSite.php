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
	 * title
	 *
	 * Returns the value of wp_title function
	 *
	 * @param string $sep
	 * @param bool $display
	 * @param string $seplocation
	 *
	 * @return String
	 */
	public function title( $sep = '&raquo;', $display = false, $seplocation = 'left' ) {

		return wp_title($sep, $display, $seplocation);

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
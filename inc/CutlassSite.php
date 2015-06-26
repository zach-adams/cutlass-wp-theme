<?php

/**
 * The CutlassSite Class
 *
 * Dynamic class that allows us to quickly and
 * easily access common WordPress options and blog
 * info.
 */
class CutlassSite {

	/**
	 * An array containing all the available values that
	 * bloginfo is capable of returning.
	 *
	 * @var array
	 */
	private $bloginfo_values;

	/**
	 * Initialize the class, set the arrays so we can quickly
	 * check which function to run.
	 */
	public function __construct() {

		$this->bloginfo_values = array(
			'name',
			'wpurl',
			'url',
			'charset',
			'version',
			'html_type',
			'text_direction',
			'language',
			'stylesheet_url',
			'stylesheet_directory',
			'template_url',
			'template_directory',
			'pingback_url',
			'atom_url',
			'rdf_url',
			'rss_url',
			'rss2_url',
			'comments_atom_url',
			'comments_rss2_url',
		);

	}

	/**
	 * __get
	 *
	 * Magic method so we can access common WordPress options and bloginfo
	 * in our Blade views quickly. The advantage of this is that we don't
	 * have to type out get_option and get_bloginfo every time we want to
	 * use a common WP option. We can just use the property notation:
	 *
	 * $site->url vs. get_bloginfo('url')
	 *
	 * This also allows us to not load every single WP option and bloginfo
	 * value want to use for every page load, rather now we're only loading
	 * the options and bloginfo we actually use in the theme. Plus accessing
	 * the option is stored in the object so we're not making multiple WP
	 * function calls.
	 *
	 * @param   string  $field  The name of the bloginfo, option, or property
	 * we want to retrieve
	 * @return  mixed
	 */
	public function __get( $field ) {

		/**
		 * If we already have the field as a property, load it
		 */
		if ( property_exists($this, $field ) )
			return $this->$field;

		/**
		 * If it's a bloginfo value run get_bloginfo
		 * * Note: Some bloginfo values are left out because they're only a
		 * proxy for get_option and we don't want that slowing down our
		 * get call.
		 */
		if ( isset( $this->bloginfo_values[$field] ) )
			return get_bloginfo( $field );

		/**
		 * Search WordPress options if it's not a bloginfo value and it's not
		 * already a property.
		 */
		return get_option($field);
	}

}
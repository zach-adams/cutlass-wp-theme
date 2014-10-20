<?php
/**
*
* Main plugin class
* @package Blade
*/

/**
* Main controller
*/
class WP_Blade_Main_Controller {

	/**
	 * Main model
	 */
	var $main_model;

	/**
	 * Constructor
	 */
	function __construct() {

		// Instantiate main model
		$this->main_model = new WP_Blade_Main_Model();

		// Globalize "blade_storage_path"
		//$GLOBALS[ 'blade_storage_path' ] = BLADE_STORAGE_PATH;

		// Bind to template include action
		add_action( 'template_include', array( $this->main_model, 'template_include_blade' ) );

		// Listen for index template filter
		add_filter( 'index_template', array( $this->main_model, 'get_query_template' ) );

		// Listen for page template filter
		add_filter( 'page_template', array( $this->main_model, 'get_query_template' ) );

		// Listen for Buddypress include action
		add_filter( 'bp_template_include', array( $this->main_model, 'get_query_template' ));

	}

	/**
	 * Return a new class instance.
	 * @return { obj } class instance
	 */
	public static function make() {

		return new self();
	}

}
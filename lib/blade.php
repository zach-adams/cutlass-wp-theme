<?php
//WARNING: This file has been modified from it's original version by Zach Adams on 10-19-2014. You can find the original source code here: https://github.com/MikaelMattsson/blade

/**
 * Root
 */
define( 'WP_BLADE_ROOT', dirname( __FILE__ ) . '/blade/' );

/**
* Path for the application folder inside the theme
*/
define( 'WP_BLADE_APP_PATH', WP_BLADE_ROOT . '/application/' );

/**
 * Path of assets
 */
define( 'WP_BLADE_ASSETS_PATH', WP_BLADE_ROOT . 'assets/' );

/**
* Path for the config folder
*/
define( 'WP_BLADE_CONFIG_PATH', WP_BLADE_APP_PATH . 'config/' );

/**
* Path for libraries
*/
define( 'WP_BLADE_LIBRARIES_PATH', WP_BLADE_APP_PATH . 'lib/' );


require_once ( WP_BLADE_CONFIG_PATH . '/initialize.php' );
WP_Blade_Main_Controller::make();

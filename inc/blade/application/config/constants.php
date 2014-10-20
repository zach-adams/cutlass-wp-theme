<?php
/**
* Define constants the plugin is going to be using
*
* @package Blade
*/

/*
|---------------------------------------------------------------------
| Main plugin constants
|---------------------------------------------------------------------
|
| Constants to standarize things
*/


/**
* Path for the helpers folder
*/
define( 'WP_BLADE_HELPERS_PATH', WP_BLADE_APP_PATH . 'helpers/' );

/**
* Path for the models
*/
define( 'WP_BLADE_MODELS_PATH', WP_BLADE_APP_PATH . 'models/' );

/**
* Path for the controllers
*/
define( 'WP_BLADE_CONTROLLERS_PATH', WP_BLADE_APP_PATH . 'controllers/' );

/**
* Path for views
*/
define( 'WP_BLADE_VIEWS_PATH', WP_BLADE_APP_PATH . 'views/' );

/**
 * Storage path
 */
//define( 'BLADE_STORAGE_PATH', WP_BLADE_ROOT . 'storage/views' );
$GLOBALS[ 'blade_storage_path' ] = WP_BLADE_ROOT . 'storage/views';

//------------------------------
//  General constants
//--------------------------------

// File extension
define( 'EXT', '.php' );

// Line break
define('CRLF', "\r\n");

// Blade files extension
define('BLADE_EXT', '.blade.php');

// Directory separator
if ( ! defined( 'DS' ) )
	define( 'DS', DIRECTORY_SEPARATOR );


// Default bundle
define( 'DEFAULT_BUNDLE', 'application' );

// MB String
define( 'MB_STRING', (int) function_exists( 'mb_get_info' ) );

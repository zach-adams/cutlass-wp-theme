<?php
/**
 * This file loads constants, libraries and all clases that will
 * be needed by the plugins.
 *
 * @package blade
 */

/*
|---------------------------------------------------------------------------
| Blueprint
|---------------------------------------------------------------------------
|
| These are the files initialize includes
|
| 1. Constants
| 2. Libraries
| 3. Helpers
| 4. Controllers
| 5. Models
|
*/

/*
|---------------------------------------------------------------------------
| Include Config
|---------------------------------------------------------------------------
|
| Include files in the configuration folder
|
*/

$config = array( 'constants' );

foreach ( $config	as $filename )
	require_once ( WP_BLADE_CONFIG_PATH . $filename . '.php' );


/*
|---------------------------------------------------------------------------
| Include Libraries
|---------------------------------------------------------------------------
|
| Vendor libraries
|
*/
$libraries = array( 'laravel/blade', 'laravel/section', 'laravel/view', 'laravel/event' );

foreach ( $libraries as $filename )
	require_once( WP_BLADE_LIBRARIES_PATH . $filename . '.php' );


/*
|---------------------------------------------------------------------------
| Include Helpers
|---------------------------------------------------------------------------
|
| Helpers functions and classes
|
*/

$helpers = array( 'wp-blade', 'helpers' );

foreach ( $helpers as $filename )
	require_once( WP_BLADE_HELPERS_PATH . $filename . '.php' );


/*
|---------------------------------------------------------------------------
| Include Models
|---------------------------------------------------------------------------
|
| Models are classes that hold core functions that the
| controllers call.
|
*/

$models = array( 'main-model' );

foreach ( $models as $filename )
	require_once ( WP_BLADE_MODELS_PATH . $filename . '.php' );

/*
|---------------------------------------------------------------------------
| Include Controllers
|---------------------------------------------------------------------------
|
| Controllers controll which functions to call as a callback of a
| certain hook being it an ajax request or other.
|
*/

$controllers = array( 'main-controller' );

foreach ( $controllers as $filename )
	require_once ( WP_BLADE_CONTROLLERS_PATH . $filename . '.php' );

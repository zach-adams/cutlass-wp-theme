<?php

/*
|--------------------------------------------------------------------------
| Theme Functions
|--------------------------------------------------------------------------
|
| This is where the magic happens. This is where Cutlass gets initialized
| and loaded.
|
*/

/**
 * Require the autoloader so we can get this party started
 */

require __DIR__ . '/vendor/autoload.php';

/**
 * Load our Environment file
 */
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

/**
 * Include Cutlass Configuration
 */
require config_path('Cutlass.php');

/**
 * Include Theme Setup Configuration
 */
require config_path('Theme.php');
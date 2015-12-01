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
 * Include Cutlass Configuration
 */
require config_path('Cutlass.php');

/**
 * Include Theme Setup Configuration
 */
require config_path('Theme.php');
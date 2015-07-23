<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function() use ($app) {
	$context = [
		'title' =>  CutlassHelper::get_page_title(),
		'posts' =>  CutlassHelper::get_posts()
	];
    return view('pages.home', $context);
});

<?php
use Cutlass\Cutlass;

/*
|--------------------------------------------------------------------------
| Front Page Template
|--------------------------------------------------------------------------
|
| This is the template for displaying the Static Front Page. This template
| is used when there is a static front page set in the WordPress settings.
| By default it's set to the welcome page, you can set it to whatever you
| like!
|
| https://codex.wordpress.org/Creating_a_Static_Front_Page#Theme_Development_for_Custom_Front_Page_Templates
|
*/

$post = Cutlass::get_post();

Cutlass::render('welcome', compact('post'));
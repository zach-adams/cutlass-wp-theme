<?php
use Cutlass\Cutlass;

/*
|--------------------------------------------------------------------------
| Home Template
|--------------------------------------------------------------------------
|
| This is the template for displaying the Home Page. This template is used
| for the Posts index page which is set under the WordPress settings.
|
| https://codex.wordpress.org/Creating_a_Static_Front_Page#Theme_Development_for_Custom_Front_Page_Templates
|
*/

$post = Cutlass::get_post();
$posts = Cutlass::get_posts();

Cutlass::render('pages.page', compact('post', 'posts'));
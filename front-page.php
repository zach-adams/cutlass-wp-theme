<?php
use Cutlass\Cutlass;

/*
|--------------------------------------------------------------------------
| Front Page Template
|--------------------------------------------------------------------------
|
| This is the template for displaying the Static Front Page. This template
| is used when there is a static front page set in the WordPress settings.
|
| https://codex.wordpress.org/Creating_a_Static_Front_Page#Theme_Development_for_Custom_Front_Page_Templates
|
*/

$post = Cutlass::get_post();
$posts = Cutlass::get_posts();
$title = Cutlass::get_page_title();

Cutlass::render('pages.page', compact('post', 'posts', 'title'));
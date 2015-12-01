<?php
use Cutlass\Cutlass;

/*
|--------------------------------------------------------------------------
| Index Template
|--------------------------------------------------------------------------
|
| This is the fallback template used for displaying any page that doesn't
| fall under any of the other templates.
|
*/

$post = Cutlass::get_post();
$posts = Cutlass::get_posts();
$title = Cutlass::get_page_title();

Cutlass::render(['pages.'. $post->post_name, 'pages.page'], compact('post', 'posts', 'title'));
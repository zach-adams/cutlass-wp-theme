<?php
use Cutlass\Cutlass;

/*
|--------------------------------------------------------------------------
| Page Template
|--------------------------------------------------------------------------
|
| This is the template that displays all pages by default.
|
*/

$post = Cutlass::get_post();

Cutlass::render(['pages.'. $post->post_name, 'pages.page'], compact('post'));
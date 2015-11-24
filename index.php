<?php
use Cutlass\Cutlass;

$post = Cutlass::get_post();
$title = Cutlass::get_page_title();

Cutlass::render(['pages.'. $post->post_name, 'pages.page'], compact('post', 'title'));
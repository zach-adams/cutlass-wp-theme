<?php
use Cutlass\Cutlass;

$post = Cutlass::get_post();
$title = Cutlass::get_page_title();

Cutlass::render(['posts.'. $post->post_name, 'posts.post'], compact('post', 'title'));
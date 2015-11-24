<?php
use Cutlass\Cutlass;

$context = array(
		'title'     =>  Cutlass::get_page_title(),
		'post'		=>	Cutlass::get_post(),
);

Cutlass::render(['posts.'. $post->post_name, 'posts.post'], $context);
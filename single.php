<?php
global $post;

$context = array(
	'title'     =>  CutlassHelper::get_page_title(),
);

$cutlass->render(['posts.'. $post->post_name, 'posts.post'], $context);
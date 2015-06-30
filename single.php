<?php
global $post;

$context = array(
	'title'     =>  CutlassHelper::get_title(),
);

$cutlass->render(['posts.'. $post->post_name, 'posts.post'], $context);
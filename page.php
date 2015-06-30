<?php
global $post;

$context = array(
	'title'     =>  CutlassHelper::get_title(),
);

$cutlass->render(['pages.'. $post->post_name, 'pages.page'], $context);
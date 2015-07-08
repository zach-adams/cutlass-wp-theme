<?php
global $post;

$context = array(
	'title'     =>  CutlassHelper::get_page_title(),
);

$cutlass->render(['pages.'. $post->post_name, 'pages.page'], $context);
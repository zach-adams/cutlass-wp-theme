<?php
global $wp_query;

$context = array(
	'wp_query'  =>  $wp_query,
	'title'     =>  CutlassHelper::get_title()
);

$cutlass->render('content.front-page', $context);
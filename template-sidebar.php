<?php
/*
 * Template Name: Sidebar
 */
global $post;

$context = array(
	'title'     =>  CutlassHelper::get_title(),
	'sidebar'   =>  true,
);

$cutlass->render(['pages.page'], $context);
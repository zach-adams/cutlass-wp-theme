<?php
/*
 * Template Name: Sidebar
 */
global $post;

$context = array(
	'title'     =>  CutlassHelper::get_page_title(),
	'sidebar'   =>  true,
);

$cutlass->render(['pages.page'], $context);
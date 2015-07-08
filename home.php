<?php

$context = array(
	'title'     =>  CutlassHelper::get_page_title(),
	'posts'     =>  CutlassHelper::get_posts(),
);

$cutlass->render('pages.home', $context);
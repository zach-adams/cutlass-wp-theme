<?php

$context = array(
	'title'     =>  CutlassHelper::get_title(),
	'posts'     =>  CutlassHelper::get_posts(),
);

$cutlass->render('pages.home', $context);
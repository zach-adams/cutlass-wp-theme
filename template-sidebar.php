<?php
use Cutlass\Cutlass;

/*
|--------------------------------------------------------------------------
| Sidebar Template
| Template Name: Sidebar
|--------------------------------------------------------------------------
|
| This is the template for displaying the sidebar layout
|
*/

$post = Cutlass::get_post();

Cutlass::render('pages.sidebar', compact('post'));
<?php
/**
 * Template Name: Sidebar
 */
use Cutlass\Cutlass;

$post = Cutlass::get_post();
$title = Cutlass::get_page_title();

Cutlass::render(['pages.sidebar'], compact('post', 'title', 'sidebar'));
<?php
use Cutlass\Cutlass;

/*
|--------------------------------------------------------------------------
| 404 Template
|--------------------------------------------------------------------------
|
| This is the template for displaying 404 pages (not found). We already have a base
| 404 page you can render in the "resources/views/pages" folder.
|
*/

$title = Cutlass::get_page_title();

Cutlass::render('pages.404', compact('title'));
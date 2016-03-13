<?php
use Cutlass\Cutlass;

/*
|--------------------------------------------------------------------------
| Single Post Template
|--------------------------------------------------------------------------
|
| This is the template for displaying all single posts and attachments
|
*/

$post = Cutlass::get_post();

Cutlass::render('posts.post', compact('post'));
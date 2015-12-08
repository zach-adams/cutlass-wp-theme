<?php
use Cutlass\Cutlass;
use Cutlass\Post;

/*
|--------------------------------------------------------------------------
| Single Post Template
|--------------------------------------------------------------------------
|
| This is the template for displaying all single posts and attachments
|
*/

$post = new Post(1);
var_dump($post);die();

Cutlass::render(['posts.'. $post->post_name, 'posts.post'], compact('post'));
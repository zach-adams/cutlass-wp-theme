<?php
use Cutlass\Cutlass;

$post = Cutlass::get_post();
$posts = Cutlass::get_posts();
$title = Cutlass::get_page_title();

Cutlass::render(['pages.home', 'pages.page'], compact('post', 'posts', 'title'));
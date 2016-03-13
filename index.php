<?php
use Cutlass\Cutlass;

/*
|--------------------------------------------------------------------------
| Index Template
|--------------------------------------------------------------------------
|
| This is the fallback template used for displaying any page that doesn't
| fall under any of the other templates.
|
*/

$posts = Cutlass::get_posts();

Cutlass::render(['pages.index'], compact('posts'));
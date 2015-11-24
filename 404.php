<?php
use Cutlass\Cutlass;

$title = Cutlass::get_page_title();

Cutlass::render(['pages.404'], compact('title'));
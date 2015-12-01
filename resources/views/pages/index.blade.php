@extends('layouts.full-width')

@section('content')
	<header>
		<h1>{{ $title }}</h1>
	</header>

	<section id="main-content">
		@each('posts.excerpt', $posts, 'post')
	</section>
@endsection
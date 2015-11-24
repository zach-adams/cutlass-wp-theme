@extends('layouts.full')

@section('content')
	<header>
		<h1>{{ $title }}</h1>
	</header>

	<section>
		@each('posts.excerpt', $posts, 'post')
	</section>
@endsection
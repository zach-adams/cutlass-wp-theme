@extends('base')

@section('content')
	<header>
		<h1>{{ $page->title() }}</h1>
	</header>

	<section>
		@each('posts.partials.excerpt', $posts, 'post')
	</section>
@endsection
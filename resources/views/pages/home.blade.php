@extends('layouts.master')

@section('content')
	<h1>{{ $title }}</h1>
	@wploop
	<article {{ post_class() }}>
		<header>
			<a href="{{ $post->link }}"><h2 class="entry-title">{{ $post->title }}</h2></a>
		</header>
		@include('includes.entry-meta')
		<hr/>
		<div class="entry-content">
			{{ get_the_excerpt() }}
		</div>
		<footer>
			@foreach($post->categories as $category)
				{{ $category->name }},
			@endforeach
		</footer>
	@wploopempty
		<h4>No content</h4>
	</article>
	@wploopend
@endsection
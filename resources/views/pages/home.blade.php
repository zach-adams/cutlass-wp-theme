@extends('layouts.master')

@section('content')
	<h1>{{ $title }}</h1>
	@wpposts
	<article {{ post_class() }}>
		<header>
			<a href="{{ $post->link }}"><h2 class="entry-title">{{ $post->title() }}</h2></a>
			{!! $post->thumbnail() !!}
		</header>
		@include('includes.entry-meta')
		<hr/>
		<div class="entry-content">
			{{ $post->excerpt() }}`
		</div>
		<footer>
			@if($post->can_edit())
				{{ edit_post_link() }}
			@endif
		</footer>
	</article>
	@wppostsend
@endsection
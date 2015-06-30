@extends('layouts.master')

@section('content')
	<h1>{{ $title }}</h1>
	@wploop
	<article {{ post_class() }}>
		<header>
			<a href="{{ get_permalink() }}"><h2 class="entry-title">{{ get_the_title() }}</h2></a>
		</header>
		@include('includes.entry-meta')
		<hr/>
		<div class="entry-content">
			{{ get_the_excerpt() }}
		</div>
	@wpempty
		<h4>No content</h4>
	</article>
	@wpend
@endsection
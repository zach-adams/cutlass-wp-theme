@extends('layouts.master')

@section('content')
	<article {{ post_class() }}>
		<header>
			<h2 class="entry-title">{{ $title }}</h2>
		</header>
		@wploop
			@include('includes.entry-meta')

			<hr/>
			<div class="entry-content">
				{{ the_content() }}
			</div>
		@wploopempty
			<h4>No content</h4>
		@wploopend
		<footer>
			{!! wp_link_pages([
				'echo' => '0',
				'before' => '<nav class="page-nav"><p>Pages:',
				'after' => '</p></nav>'
			]) !!}
		</footer>
	</article>
	<hr/>

	{{ comments_template() }}
@endsection
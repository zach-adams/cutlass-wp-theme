@extends('layouts.page')

@section('content')
	<article {{ $post->post_class() }}>
		<header>
			<a href="{{ $post->link }}"><h2 class="entry-title">{{ $post->title }}</h2></a>
			{!! $post->thumbnail() !!}
		</header>
		<p class="byline author vcard">
			<time class="published" datetime="{{ $post->date }}">{{ $post->human_date }}</time>
			By <a href="{{ get_author_posts_url($post->author->data->ID) }}" rel="author" class="fn">{{ $post->author->data->display_name }}</a>
		</p>
		<div class="entry-content">
			@foreach($post->categories() as $category) {{ $category->name }} @endforeach
			{{ $post->content() }}
		</div>
		<footer>
			{{ var_dump($post->comments()) }}
		</footer>
	</article>
@endsection
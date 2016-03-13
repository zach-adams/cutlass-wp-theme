@extends('base')

@section('content')
	<header>
		<h1>{{ $page->title() }}</h1>
	</header>

	<section>
		{{ $page->content() }}
	</section>

	{{ $site->comments() }}
@endsection
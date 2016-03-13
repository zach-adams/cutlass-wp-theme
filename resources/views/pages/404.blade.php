@extends('base')

@section('content')
	<header>
		<h1>{{ $page->title() }}</h1>
	</header>

	<section>
		{{ $site->search_form() }}
	</section>
@endsection
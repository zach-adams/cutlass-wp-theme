@extends('layouts.full-width')

@section('content')
	<header>
		<h1>{{ $page->title() }}</h1>
	</header>

	<section id="main-content">
		{{ $site->search_form() }}
	</section>
@endsection
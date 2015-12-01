@extends('layouts.full-width')

@section('content')
	<header>
		<h1>{{ $title }}</h1>
	</header>

	<section id="main-content">
		{{ get_search_form() }}
	</section>
@endsection
@extends('layouts.full-width')

@section('content')
	<header>
		<h1>{{ $title }}</h1>
	</header>

	<section id="main-content">
		@include('pages.partials.single')
	</section>

	{{ comments_template() }}
@endsection
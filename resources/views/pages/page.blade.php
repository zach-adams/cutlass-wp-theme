@extends('layouts.full')

@section('content')
	<header>
		<h1>{{ $title }}</h1>
	</header>

	<section>
		@include('pages.partials.single')
	</section>

	{{ comments_template() }}
@endsection
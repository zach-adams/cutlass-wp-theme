@extends('layouts.master')

@section('content')
	<div class="container">
		<h1>{{ $title }}</h1>
		{{ get_search_form() }}
	</div>
@endsection
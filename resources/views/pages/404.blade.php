@extends('layouts.master')

@section('content')
	<h1>{{ $title }}</h1>
	{{ get_search_form() }}
@endsection
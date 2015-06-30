@extends('layouts.master')

@section('content')
	<h1>{{ $title }}</h1>
	@wploop
	{{ the_content() }}
	@wpempty
	<h5>Nothing here yet</h5>
	@wpend
@endsection

@section('sidebar')
	{{ get_sidebar() }}
@endsection
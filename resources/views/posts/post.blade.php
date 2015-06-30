@extends('layouts.master')

@section('content')
	<h1>{{ $title }}</h1>
	@wploop
		@include('includes.entry-meta')

		<hr/>
		{{ the_content() }}
		<hr/>

		{{ comments_template() }}
	@wpempty
		<h5>Nothing here yet</h5>
	@wpend
@endsection
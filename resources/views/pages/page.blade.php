@extends('layouts.full')

@section('content')

	<section>
		@include('pages.partials.single')
	</section>

	{{ comments_template() }}
@endsection
@extends('layouts.full')

@section('content')

	@include('posts.partials.single')

	{{ comments_template() }}
@endsection
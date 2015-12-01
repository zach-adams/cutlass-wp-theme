@extends('layouts.full-width')

@section('content')

	@include('posts.partials.single')

	{{ comments_template() }}
@endsection
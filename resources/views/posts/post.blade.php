@extends('layouts.full-width')

@section('content')

	@include('posts.partials.single')

	{{ $site->comments() }}
@endsection
@extends('layouts.sidebar')

@section('content')
    <header>
        <h1>{{ $title }}</h1>
    </header>

    <section>
        {{ $post->content() }}
    </section>

    {{ comments_template() }}
@endsection

@section('sidebar')
    <h2>Sidebar</h2>
    {{ $site->sidebar('sidebar-primary') }}
@endsection
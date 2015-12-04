@extends('layouts.page')

@section('content')
    <header>
        <h1>{{ $page->title() }}</h1>
    </header>

    <section>
        {{ $post->content() }}
    </section>

    {{ $site->comments() }}
@endsection

@section('sidebar')
    <h2>Sidebar</h2>
    {{ $site->sidebar('sidebar-primary') }}
@endsection
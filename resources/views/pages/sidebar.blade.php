@extends('layouts.sidebar')

@section('content')
    <header>
        <h1>{{ $title }}</h1>
    </header>

    <section>
        @include('pages.partials.single')
    </section>

    {{ comments_template() }}
@endsection

@section('sidebar')
    <h2>Sidebar</h2>
    {{ get_sidebar() }}
@endsection
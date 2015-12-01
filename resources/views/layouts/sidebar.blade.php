@extends('master')

@section('main_content')
    <main id="main" role="main">
        @yield('content')
    </main>
    <aside id="sidebar">
        @section('sidebar')
            {{ $site->sidebar() }}
        @show
    </aside>
@endsection
@extends('master')

@section('main_content')
    <main id="main" role="main">
        @yield('content')
    </main>
    <aside id="sidebar">
        @section('sidebar')
            {{ get_sidebar() }}
        @show
    </aside>
@endsection
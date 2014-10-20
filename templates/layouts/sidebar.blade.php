@layout('templates.layouts.base')

@section('content')
  <main class="main sidebar" role="main">
    @yield('page-content')
  </main><!-- /.main -->
  <aside class="sidebar" role="complementary">
    <?php dynamic_sidebar('sidebar-primary'); ?>
  </aside><!-- /.sidebar -->
@endsection
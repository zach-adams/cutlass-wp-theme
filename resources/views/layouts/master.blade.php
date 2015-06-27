@include('includes.head')

<body {{ body_class() }} >
  
  @include('includes.header')

  <div class="wrap" role="document">
    <div class="content">
      @yield('content')
    </div><!-- /.content -->
  </div><!-- /.wrap -->

  @include('includes.footer')

  {{ wp_footer() }}

</body>
</html>
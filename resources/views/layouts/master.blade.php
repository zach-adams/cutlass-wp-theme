@include('includes.html-head')

<body {{ body_class() }} >
  
	@include('includes.header')

	<main id="main" class="wrap content" role="document">
		@yield('content')
	</main><!-- /.wrap -->

	@include('includes.footer')

	{{ wp_footer() }}

</body>
</html>
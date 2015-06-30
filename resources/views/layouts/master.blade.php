@include('includes.html-head')

<body {{ body_class() }} >
  
	@include('includes.header')

	<main id="main" class="wrap content" role="document">
		@if(isset($sidebar) && $sidebar === true)
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						@yield('content')
					</div>
					<div class="col-md-4">
						@yield('sidebar')
					</div>
				</div>
			</div>
		@else
			<div class="container">
				@yield('content')
			</div>
		@endif
	</main><!-- /.wrap -->

	@include('includes.footer')

	{{ wp_footer() }}

</body>
</html>
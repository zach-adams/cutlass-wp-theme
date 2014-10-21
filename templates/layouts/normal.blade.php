@layout('templates.layouts.base')

@section('content')
	<div class="container">
		<main class="main" role="main">
			@yield('page-content')
		</main><!-- /.main -->
	</div><!-- /.container -->
@endsection
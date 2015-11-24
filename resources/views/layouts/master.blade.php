<!doctype html>
<html>
<head>
	<meta charset="{{ $site->info('charset') }}" />
	<meta name="description" content="{{ $site->info('description') }}">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="pingback" href="{{ $site->info('pingback_url') }}" />

	<title>{{ wp_title() }}</title>

	{!! $wp_head !!}
</head>

<body {{ body_class() }} >
  
	@include('includes.header')

	<main id="main" class="wrap content" role="document">
		@yield('content')
	</main><!-- /.wrap -->

	@include('includes.footer')

	{{ wp_footer() }}

</body>
</html>
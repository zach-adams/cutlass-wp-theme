<!doctype html>
<!--[if lt IE 7]><html class="no-js ie ie6 lt-ie9 lt-ie8 lt-ie7" {{ $site->info('language_attributes') }}> <![endif]-->
<!--[if IE 7]><html class="no-js ie ie7 lt-ie9 lt-ie8" {{ $site->info('language_attributes') }}> <![endif]-->
<!--[if IE 8]><html class="no-js ie ie8 lt-ie9" {{ $site->info('language_attributes') }}> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" {{ $site->info('language_attributes') }}> <!--<![endif]-->
<head>
	<meta charset="{{ $site->info('charset') }}" />
	<meta name="description" content="{{ $site->info('description') }}">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="pingback" href="{{ $site->info('pingback_url') }}" />

	<title>{{ wp_title() }}</title>

	{{ wp_head() }}
</head>
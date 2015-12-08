<header class="site-header" role="banner">
	<a href="{{ $site->info('url') }}">
		{{ $site->info('title') }}
	</a>
	@if($site->has_menu('primary_navigation'))
		{{ $site->menu([
			'menu'              => 'primary_navigation',
			'theme_location'    => 'primary_navigation',
		]) }}
	@endif
</header>

<header class="banner site-header" role="banner">
	<a href="{{ $site->info('url') }}">{{ $site->info('name') }}</a>

	<nav id="primary-navigation" role="navigation">
			@if($site->has_menu('primary_navigation'))
				{{ $site->menu([
					'menu'              => 'primary_navigation',
					'theme_location'    => 'primary_navigation',
				]) }}
			@endif
	</nav>
</header>

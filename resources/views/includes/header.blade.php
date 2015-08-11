<header class="banner site-header" role="banner">
	<a href="{{ $site->info('url') }}">{{ $site->info('name') }}</a>

	<nav id="primary-navigation" role="navigation">
			@if(has_nav_menu('primary_navigation'))
				{{ wp_nav_menu([
					'menu'              => 'primary_navigation',
					'theme_location'    => 'primary_navigation',
				]) }}
			@endif
	</nav>
</header>

<header class="banner navbar navbar-default navbar-static-top" role="banner">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ $site->url }}">{{ $site->name }}</a>
		</div>

		<nav class="collapse navbar-collapse" role="navigation">
				@if(has_nav_menu('primary_navigation'))
					{{ wp_nav_menu([
						'menu'              => 'primary_navigation',
						'theme_location'    => 'primary_navigation',
						'depth'             => 2,
						'container'         => 'div',
						'container_class'   => 'collapse navbar-collapse',
						'container_id'      => 'primary',
						'menu_class'        => 'nav navbar-nav',
						'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
						'walker'            => new wp_bootstrap_navwalker()
					]) }}
				@endif
		</nav>
	</div>
</header>

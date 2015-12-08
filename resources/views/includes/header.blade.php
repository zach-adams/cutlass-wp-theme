<header class="banner site-header" role="banner">
	<nav class="navbar navbar-light" role="navigation">
		<div class="container">
			<a class="navbar-brand" href="{{ $site->info('url') }}">
				<img src="{{ asset('images/cutlass-logo-inverse-full.png') }}" alt="Cutlass Logo"> {{ $site->info('title') }}
			</a>
			@if($site->has_menu('primary_navigation'))
				<div class="toggle hidden-sm-up">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primary-nav">
						&#9776;
					</button>
				</div>
				<div class="collapse navbar-toggleable-sm" id="primary-nav">
					{{ $site->menu([
						'menu'              => 'primary_navigation',
						'theme_location'    => 'primary_navigation',
						'walker'			=>	$walker,
						'depth'             => 2,
						'container'         => false,
						'menu_id'		=>	'primary-navigation',
						'menu_class'        => 'nav navbar-nav pull-right',
					]) }}
				</div>
			@endif
		</div>
	</nav>
</header>

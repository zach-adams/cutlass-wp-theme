process.env.DISABLE_NOTIFIER = true;

var elixir = require('laravel-elixir');

var inProduction = elixir.config.production;

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

	mix.sass('app.scss');
	mix.scripts('app.js');



	if (inProduction) {

		mix.version([
			'public/css/app.css',
			'public/js/app.js'
		]);

	} else {

		mix.browserSync({
			proxy: 'blankwp.dev',
			notify: false
		});

	}

});

process.env.DISABLE_NOTIFIER = true;

var elixir = require('laravel-elixir');

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
	mix.styles('resources/assets/css/**/*.css', 'public/css/plugins.css');
	mix.scriptsIn('resources/assets/js/plugins', 'public/js/plugins.js');
	mix.scripts('app.js');

	mix.browserSync({
		proxy: 'cutlasswp.dev',
		notify: false
	});
});

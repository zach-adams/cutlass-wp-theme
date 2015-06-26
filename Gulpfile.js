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
	mix.sass("app.scss", "public/css/all.css");
	mix.scripts([
		'../bower/jquery/dist/jquery.js',
		'../bower/bootstrap-sass-official/assets/javascripts/bootstrap.min.js'
	], 'public/js/all.js');

	mix.version(["css/all.css", "js/all.js"]);
});

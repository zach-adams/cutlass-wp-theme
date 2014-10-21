Cutlass Starter Theme
=========

## Create themes with the power of Laravel's Blade

Cutlass is a Wordpress Starter Theme with the power of Laravel's Blade templating engine included, allowing you to develop Wordpress sites more quickly then you ever have before. It includes HTML5 syntax, Bootstrap and Font Awesome by default.

Designed by [Zach Adams](http://zach-adams.com), uses code from [Roots Wordpress Starter Theme](https://github.com/roots/roots) and the [Blade Wordpress Plugin](https://github.com/MikaelMattsson/blade)

Special Thanks to Mikael Mattsson and the Team at Roots for making the Blade Wordpress Plugin and the Roots Starter Theme respectively

## Features

* [Laravel's Blade](http://laravel.com/docs/4.2/templates) templating engine for even quicker Wordpress theme development
* [Gulp](http://gulpjs.com/) for SASS compiling, file concatination, image minifying, javascript uglifying, and livereload
* [Bower](http://bower.io/) for front-end package management
* [Bootstrap](http://getbootstrap.com/)
* HTML5 Ready
* Tons of useful functions and theme activation thanks to [Roots](https://github.com/roots/roots)

## Requirements

* PHP 5.5 or higher
* Apache or nginx
* Wordpress 3.0.0 or higher

## What's Blade?

To quote Laravel's website: 
> Blade is a simple, yet powerful templating engine provided with Laravel. Unlike controller layouts, Blade is driven by template inheritance and sections. All Blade templates should use the .blade.php extension.

Luckily Mikael Mattsson of the [Blade Wordpress Plugin](https://github.com/MikaelMattsson/blade) made some custom Wordpress Blade sections we can use so instead of writing:

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    	<a href="<?php the_permalink() ?>"><?php the_title() ?></a><br>
	<?php endwhile; else: ?>
    	<p>404</p>
	<?php endif; ?>

We can use:

	@wpposts
    	<a href="{{the_permalink()}}">{{the_title()}}</a><br>
	@wpempty
    	<p>404</p>
	@wpend

See more in the wiki!

## How is Blade used in this theme?

When the theme is loaded it attaches itself to the template loader and runs the template specified through the nifty Blade Engine included. If you look inside the templates folder you'll notice three folders:

* content - The content for the template pages
* includes - Various includes 
* layouts - The master layouts. Base is the default and the others pull from Base

Cutlass Starter Theme
=========

## Create themes with the power of Laravel's Blade

Cutlass is a Wordpress Starter Theme with the power of Laravel's Blade templating engine included, allowing you to develop Wordpress sites more quickly then you ever have before.

Designed by [Zach Adams](http://zach-adams.com), uses functions and code from [Roots Wordpress Starter Theme](https://github.com/roots/roots) and the [Blade Wordpress Plugin](https://github.com/MikaelMattsson/blade)

Special Thanks to Mikael Mattsson and the Team at Roots for making the Blade Wordpress Plugin and the Roots Starter Theme respectively

## What's Blade?

To quote Laravel's website: 
> Blade is a simple, yet powerful templating engine provided with Laravel. Unlike controller layouts, Blade is driven by template inheritance and sections. All Blade templates should use the .blade.php extension.

Instead of writing:

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    	<a href="<?php the_permalink() ?>"><?php the_title() ?></a><br>
	<?php endwhile; else: ?>
    	<p>404</p>
	<?php endif; ?>

Use:

	@wpposts
    	<a href="{{the_permalink()}}">{{the_title()}}</a><br>
	@wpempty
    	<p>404</p>
	@wpend





Cutlass was originally a fork of the [Roots Starter Theme](http://roots.io/starter-theme/) but evolved into what it is today. 
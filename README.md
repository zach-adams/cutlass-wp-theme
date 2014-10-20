Cutlass Starter Theme
=========

## Create themes with the power of Laravel's Blade

Cutlass is a Wordpress Starter Theme with the power of Laravel's Blade templating engine included, allowing you to develop Wordpress sites more quickly then you ever have before.

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
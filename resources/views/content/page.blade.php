@include('includes.page-header')

@wpposts
	<?php the_content(); ?>
	<?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
@wpempty
	@include('content.empty')
@wpend
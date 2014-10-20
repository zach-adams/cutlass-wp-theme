@wpposts
	{{ the_content() }}
	{{ wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')) }}
@wpempty
	<h1>It's Empty!</h1>
@wpend
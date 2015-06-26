<p class="byline author vcard">
	<time class="published" datetime="{{ get_the_time('c') }}">{{ get_the_date() }}</time>
	{{ __('By', 'cutlass') }} <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">{{ get_the_author() }}</a>
</p>

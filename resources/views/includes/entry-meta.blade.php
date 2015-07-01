@inject('carbon', 'Carbon\Carbon')

<p class="byline author vcard">
	<time class="published" datetime="{{ $carbon->now() }}">{{ $post->human_date }}</time>
	{{ __('By', 'cutlass') }} <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">{{ $post->author->data->display_name }}</a>
</p>

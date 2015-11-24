<p class="byline author vcard">
	<time class="published" datetime="{{ $post->date }}">{{ $post->human_date }}</time>
	By <a href="{{ get_author_posts_url($post->author->data->ID) }}" rel="author" class="fn">{{ $post->author->data->display_name }}</a>
</p>
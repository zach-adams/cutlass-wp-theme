@inject('carbon', 'Carbon\Carbon')
@inject('slugify', 'Cocur\Slugify\Slugify')
@inject('mobile', 'Mobile_Detect')

<hr/>
{{ $site->admin_email }}<br/>
{{ $site->comment_max_links }}
<hr/>
{{ $slugify->slugify('Hello World!') }}

@if(!$mobile->isMobile())
	<h2>Desktop</h2>
@else
	<h2>Mobile</h2>
@endif
{{ $site->admin_email }}<br/>

@wploop([
	'post_type' =>  'post',
	'posts_per_page'    =>  50,
])
	<h3>{{ get_the_title() }}</h3>
@wpempty
	<h3>Empty</h3>
@wpend
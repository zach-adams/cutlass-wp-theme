@include('templates.includes.page-header')

@wpposts
  @include('templates.content.excerpt')
@wpempty
  <div class="alert alert-warning">
    {{ _e('Sorry, no results were found.', 'cutlass') }} 
  </div>
  {{ get_search_form(false) }}
@wpend

@if ($wp_query->max_num_pages > 1)
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous">{{ next_posts_link(__('&larr; Older posts', 'cutlass')) }}</li>
      <li class="next">{{ previous_posts_link(__('Newer posts &rarr;', 'cutlass')) }}</li>
    </ul>
  </nav>
@endif
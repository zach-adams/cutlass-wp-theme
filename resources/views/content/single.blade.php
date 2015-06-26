@include('includes.page-header')

@wpposts
  <article {{ post_class() }}>
    <header>
      @include('includes.entry-meta')
    </header>
    <div class="entry-content">
      {{ the_content() }}
    </div>
    <footer>
      {{ wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'cutlass'), 'after' => '</p></nav>')) }}
    </footer>
    @include('includes.comments')
  </article>
@wpempty
  @include('content.empty')
@wpend
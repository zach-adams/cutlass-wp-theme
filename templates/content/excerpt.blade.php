<article {{ post_class() }}>
  <header>
    <h2 class="entry-title"><a href="{{ the_permalink() }}" title="{{ the_title() }}">{{ the_title() }}</a></h2>
    @include('templates.includes.entry-meta')
  </header>
  <div class="entry-summary">
    {{ the_excerpt() }}
  </div>
</article>
<article {{ post_class() }}>
  <header>
    <h2 class="entry-title"><a href="{{ the_permalink() }}">{{ the_title() }}</a></h2>
    @include('templates.includes.entry-meta')
  </header>
  <div class="entry-summary">
    {{ the_content() }}
  </div>
</article>

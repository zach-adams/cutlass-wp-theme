<header class="banner navbar navbar-default navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ esc_url(home_url('/')) }}">{{ bloginfo('name') }}</a>
    </div>

    <nav class="collapse navbar-collapse" role="navigation">
        @if(has_nav_menu('primary_navigation'))
          {{ wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav', 'walker' => new wp_bootstrap_navwalker(), 'container_class' => 'collapse navbar-collapse',)) }}
        @endif
    </nav>
  </div>
</header>

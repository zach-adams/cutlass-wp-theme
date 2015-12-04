@extends('layouts.full-width')

@section('content')
    <section id="lead">
        <div>
            <h1>WordPress & Laravel together in Harmony.</h1>
            <h2>The WordPress Starter Theme for Web Artisans</h2>
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-block">
<pre><code class="language-php line-numbers">{{ '@' . "extends('layouts.master')" }}

{{ '@' . "section('content')" }}
    {{ '@' . 'wpposts' }}
        &lt;div>
            &lt;h3>@{{ $post-&gt;title() }}&lt;/h3>
            &lt;p>@{{ $post-&gt;excerpt() }}&lt;/p>
        &lt;/div>
    {{ '@' . 'wppostsend' }}
{{ '@' . 'endsection' }}</code></pre>
                </div>
            </div>
        </div>
        <a href="#features" class="onward btn btn-secondary">Powerful, Modern Features <i class="fa fa-chevron-circle-down"></i></a>
    </section>
    <section id="features">
        <div>
            <h1>WordPress like never before</h1>
            <h2>Build themes at lightspeed</h2>
            <div class="list-group">
                <div class="list-group-item">
                    <div class="row">
                        <div class="col col-md-12 col-lg-7">
                            <h4 class="list-group-item-heading">Develop themes using Laravel's Blade</h4>
                            <p class="list-group-item-text">Blade is the simple, yet powerful templating engine provided with Laravel. Unlike other PHP templating languages Blade allows you to use plain PHP code in your views, meaning you spend less time learning and more time doing!</p>
                        </div>
                        <div class="col hidden-md-down col-lg-5">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-block">
<pre><code class="language-php line-numbers">{{ '@' . 'each' }}('posts.partials.excerpt', $posts, 'post')

{{ '@' . 'wploop' }}
    &lt;h3&gt;@{{ $post-&gt;title() }}&lt;/h3&gt;
    &lt;p&gt;@{{ $post-&gt;excerpt() }}&lt;/p&gt;
{{ '@' . 'wppostsempty' }}
    &lt;h4&gt;No Posts!&lt;/h4&gt;
{{ '@' . 'wppostsend' }}</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col col-lg-5 hidden-md-down">
                            <div class="card left">
                                <div class="card-header">
                                </div>
                                <div class="card-block">
<pre><code class="language-php">&lt;?php

$post = Cutlass::get_post();

Cutlass::render(['pages.'. $post->post_name, 'pages.page'], compact('post'));
</code></pre>
                                    </div>
                                </div>
                        </div>
                        <div class="col col-lg-7 col-md-12">
                            <h4 class="list-group-item-heading">Made to be simple</h4>
                            <p class="list-group-item-text">Cutlass comes with a range of improvements designed to integrate Blade with WordPress as smoothly and simply as possible. Start developing WordPress the way it was meant to be.</p>
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-lg-7 col-md-12">
                            <h4 class="list-group-item-heading">Modern Development Tools</h4>
                            <p class="list-group-item-text">With Composer, NPM, Laravel's Elixir (Gulp), DRY techniques, and much more you have everything you need to build modern WordPress themes.</p>
                        </div>
                        <div class="col-lg-5 hidden-md-down favorite-tools">
                             <img src="{{ asset('images/favorite-tools.png') }}" alt="Your Favorite Tools">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="#get-started" class="onward btn btn-secondary">Get Started Today <i class="fa fa-chevron-circle-down"></i></a>
    </section>
    <section id="get-started">
        <div>
            <h1>Get Started Today</h1>
            <div class="container">
                <div class="list-group">
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">1. Clone the Repo</h4>
                        <p class="list-group-item-text">Clone the repo or <a href="https://github.com/zach-adams/cutlass-wp-theme/archive/master.zip">download the zip file</a> and install it like a normal WordPress theme.</p>
                        <pre class=" language-php"><code class=" language-php">git clone git@github.com:zach-adams/cutlass-wp-theme.git your-theme</code></pre>
                    </div>
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">2. Install Composer Dependencies</h4>
                        <p class="list-group-item-text">Run composer install in your theme's directory</p>
                        <pre class=" language-php"><code class=" language-php">composer install</code></pre>
                    </div>
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">3. Install NPM Modules</h4>
                        <p class="list-group-item-text">Run npm install in the theme's directory</p>
                        <pre class=" language-php"><code class=" language-php">npm install</code></pre>
                    </div>
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">3. Setup Gulp & Elixir</h4>
                        <p class="list-group-item-text">Open your <code>Gulpfile.js</code> file and configure it to your liking, then run <code>gulp</code> to compile and concatinate your CSS. You can also run <code>gulp watch</code> to automatically watch for changed files and <code>gulp --production</code> to minify your files!</p>
                        <pre class=" language-php"><code class=" language-php">gulp
gulp watch
gulp --production</code></pre>
                    </div>
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">4. Read the Docs</h4>
                        <p class="list-group-item-text">The Docs contain all the info you'll need for working and building with this theme, go check them out!<br/><br/><a
                                    href="{{ $site->info('url') }}/docs" class="btn btn-primary">Documentation</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
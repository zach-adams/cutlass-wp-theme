@extends('layouts.page')

@section('content')

    <div class="row">

        <aside id="sidebar" class="col-md-3">
            <div class="inner-sidebar">
                <h4>Prologue</h4>
                <ul>
                    <li><a href="#about">About</a></li>
                    <li><a href="#why">Why Cutlass?</a></li>
                </ul>
                <h4>Setup</h4>
                <ul>
                    <li><a href="#installation">Installation</a></li>
                    <li><a href="#configuration">Configuration</a></li>
                </ul>
                <h4>The Basics</h4>
                <ul>
                    <li><a href="#installation">Theme Structure</a></li>
                    <li><a href="#rendering-view">Rendering a View</a></li>
                    <li><a href="#blade-templates">Blate Templates</a></li>
                </ul>
                <h4>Helper Classes</h4>
                <ul>
                    <li><a href="#cutlass">Cutlass</a></li>
                    <li><a href="#page">Page</a></li>
                    <li><a href="#post">Post</a></li>
                    <li><a href="#site">Site</a></li>
                    <li><a href="#util">Util</a></li>
                </ul>
            </div>
        </aside>

        <section class="col-md-8 col-md-offset-1" id="content">
            <section id="prologue">
                <header>
                    <a class="display-2" href="#prologue"><h2>Prologue</h2></a>
                </header>
                <ul class="header">
                    <li><a href="#prologue">Prologue</a>
                        <ul>
                            <li><a href="#about">About</a></li>
                            <li><a href="#why">Why Cutlass?</a></li>
                        </ul>
                    </li>
                </ul>
                <hr>
                <article id="about">
                    <header>
                        <a class="display-3" href="#about"><h3>About</h3></a>
                    </header>
                    <p>Cutlass is a Wordpress Starter Theme with the power of Laravel's Blade templating engine integrated into it, allowing you to develop Wordpress sites more quickly then you ever have before. It was built with the ideals of Laravel in mind, and includes several tools used by Laravel which can help speed up WordPress theme development.</p>
                    <h4>Features</h4>
                    <p>Cutlass includes the following tools & features built-in and ready for you to use:</p>
                    <ul>
                        <li><a href="http://laravel.com/docs/5.1/blade" target="_blank">Laravel's Blade Templating Engine</a></li>
                        <li><a href="http://laravel.com/docs/5.1/elixir" target="_blank">Laravel's Elixir</a> (SCSS, Browserify, Browsersync, etc.) & Gulp</li>
                        <li>Composer</li>
                        <li>NPM</li>
                        <li>Bower</li>
                    </ul>
                </article>
                <article id="why">
                    <header>
                        <a class="display-3" href="#why"><h3>Why Cutlass?</h3></a>
                    </header>
                    <p>Cutlass allows you to utilize many of the features that make Laravel a developers dream and use them when developing with WordPress.</p>
                    <blockquote>Why not just use Laravel?</blockquote>
                    <p>Unfortunately many developers are forced to use WordPress, either by clients or managers. This is an attempt to make development in WordPress a little more bearable to them!</p>
                </article>
            </section>
            <section id="setup">
                <header>
                    <a class="display-2" href="#setup"><h2>Setup</h2></a>
                </header>
                <ul class="header">
                    <li><a href="#setup">Setup</a>
                        <ul>
                            <li><a href="#installation">Installation</a></li>
                            <li><a href="#configuration">Configuration</a></li>
                        </ul>
                    </li>
                </ul>
                <hr>
                <article id="installation">
                    <header>
                        <a class="display-3" href="#installation"><h3>Installation</h3></a>
                    </header>
                    <h4>Server Requirements</h4>
                    <p>Since Cutlass is using parts of Laravel there are a few requirements that we'll need to function properly:</p>
                    <ul>
                        <li>PHP >= 5.5.9</li>
                    </ul>
                    <h4>Installing Cutlass</h4>
                    <p>Clone the repo or <a href="https://github.com/zach-adams/cutlass-wp-theme/archive/master.zip">download the zip file</a> and install it like a normal WordPress theme.</p>
                    <pre class="language-php"><code class="language-php">git clone git@github<span class="token punctuation">.</span>com<span class="token punctuation">:</span>zach<span class="token operator">-</span>adams<span class="token operator">/</span>cutlass<span class="token operator">-</span>wp<span class="token operator">-</span>theme<span class="token punctuation">.</span>git your<span class="token operator">-</span>theme</code></pre>
                    <p>Run composer install in your theme's directory</p>
                    <pre class="language-php"><code class="language-php">composer install</code></pre>
                    <p>Run npm install in the theme's directory</p>
                    <pre class="language-php"><code class="language-php">npm install</code></pre>
                    <p>Open your <code>Gulpfile.js</code> file and configure it to your liking, then run <code>gulp</code> to compile and concatinate your CSS. You can also run <code>gulp watch</code> to automatically watch for changed files and <code>gulp --production</code> to minify your files!</p>
                    <pre class="language-php"><code class="language-php">gulp
gulp watch
gulp <span class="token operator">--</span>production</code></pre>
                </article>
                <article id="configuration">
                    <header>
                        <a class="display-3" href="#configuration"><h3>Configuration</h3></a>
                    </header>
                    <h4>Configuration Files</h4>
                    <p>Cutlass includes two configuration files by default, both in the <code>config</code> directory.</p>
                    <h5>Theme.php</h5>
                    <p>This file contains regular WordPress theme management code, by default it does the following:</p>
                    <ul>
                        <li>Adds Primary Navigation menu</li>
                        <li>Adds Primary Sidebar</li>
                        <li>Enqueues App CSS & App JS</li>
                        <li>Cleans up Body Class</li>
                        <li>Removes Emoji Support</li>
                        <li>Removed most default dashboard widgets</li>
                        <li>Adds Theme Support for:
                            <ul>
                                <li>Post Thumbnails</li>
                                <li>Post Formats (aside, gallery, link, image, quote, video, audio)</li>
                                <li>HTML5 (search form, comment form, comment list, gallery, caption)</li>
                                <li><a href="https://codex.wordpress.org/Title_Tag">New WordPress Title Tag</a> (now included in wp_head)</li>
                            </ul>
                        </li>
                    </ul>
                    <p>You may add any Theme-specific code in this file, along with any which you would normally include in your <code>functions.php</code> file.</p>
                    <h5>Cutlass.php</h5>
                    <p>This file is where you can configure Cutlass. It includes several filters which allows you to change some of the options and add data to your views. Here are the filters and their options:</p>
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>cutlass_views_directory</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>If for some reason you change the default location to your views directory you can tell Cutlass where to look for the views here.</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">String</span> - $views_directory</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">String</span> - The directory where Cutlass will look for the views to render</p>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>cutlass_cache_directory</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>If for some reason you change the default location of where Blade will store it's compiled Blade views you can tell Cutlass where to look for them here.</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">String</span> - $cache_directory</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">String</span> - The directory where Cutlass will look for the compiled Blade views</p>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>cutlass_disable_cache</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Enable or disable the Blade cache. By default will check to see if WP_DEBUG is enabled, and will return true to disable the cache.</p>
                                <p><strong>Note:</strong> Be sure to disable the cache in development environments otherwise changes may not appear until you manually clear the Blade Cache directory.</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Bool</span> - $disable_cache</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">Bool</span> - True if you want to disable the Blade cache, false if you want to leave it enabled.</p>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>cutlass_global_view_data</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Global variables you want to have available in all Blade views.</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Array</span> - $global_view_data</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">Array</span> - An array of key values.</p>
                                <p><strong>Note:</strong> This is a key value array with your key being the variable name to use in your Blade views and the value being the value that will be outputted when used, so:
<pre class="language-php"><code class="language-php">'site_url'  =>  get_bloginfo('url'),
'foo'      =>  new FooBar(),</code></pre>
becomes this in your Blade views:
<pre class="language-php"><code class="language-php">@{{ $site_url }}
@{{ $foo->foobar('foobar') }}</code></pre>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>cutlass_custom_directives</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p><a href="http://laravel.com/docs/5.1/blade#extending-blade" target="_blank">Directives</a>  to add to Blade</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Array</span> - $custom_directives</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">Array</span> - An array of key values.</p>
                                <p><strong>Note:</strong> This is a key value array, with your Directive Name being the key and the PHP Directive Value being the value. Some examples:</p>
<pre class="language-php"><code class="language-php">'hello' => '&lt;?php echo "Hello world!"; ?>'</code></pre>
Then you can use it in your Blade views:
<pre class="language-php"><code class="language-php">{{ '@' }}hello</code></pre>
Which outputs:
<pre class="language-php"><code class="language-php">Hello world!</code></pre>
                                <p><strong>Optional:</strong> Add {expression} where you want the value of the directive to go:</p>
<pre class="language-php"><code class="language-php">'wpquery' => '&lt;?php $query = new WP_Query({expression}); ?>'</code></pre>
Then you can use it in your Blade views:
<pre class="language-php"><code class="language-php">{{ '@' }}wpquery(['post_type' => 'page'])</code></pre>
Which turns into:
<pre class="language-php"><code class="language-php">&lt;?php $query = new WP_Query(['post_type' => 'page']); ?></code></pre>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
            <section id="basics">
                <header>
                    <a href="#basics" class="display-2"><h2>The Basics</h2></a>
                </header>
                <ul class="header">
                    <li><a href="#basics">The Basics</a>
                        <ul>
                            <li><a href="#structure">Theme Structure</a></li>
                            <li><a href="#rendering-view">Rendering a View</a></li>
                            <li><a href="#blade-templates">Blade Templates</a></li>
                        </ul>
                    </li>
                </ul>
                <hr>
                <article id="structure">
                    <header>
                        <a href="#structure" class="display-3"><h3>Theme Structure</h3></a>
                    </header>
                    <h4>Basic Structure</h4>
                    <p>This theme is divided into several main folders, a few of which are similar Laravel:</p>
                    <pre><code><strong>config/</strong> - Contains theme & Cutlass configuration files
<strong>Cutlass/</strong> - Contains the files and helpers for the core Cutlass functionality
<strong>public/</strong> - Contains the public files, usually concatenated and minified by Elixir
<strong>resources/</strong>
    <strong>assets/</strong> - Contains the files which usually compile into the public folder (SASS, Javascript, etc.)
    <strong>views/</strong> - Contains the views with which will be rendered by Blade
<strong>storage/</strong> - Contains any cache files or other storage files
                        </code></pre>
                </article>
                <article id="rendering-view">
                    <header>
                        <a href="#rendering-view" class="display-3"><h3>Rendering a View</h3></a>
                    </header>
                    <h4>Template Files</h4>
                    <p>You'll notice in the theme that Cutlass has all the normal template files of a WordPress theme in it's main directory (index.php, page.php, home.php, etc.). These files act as "jumping off points" for Cutlass. Let's open <code>page.php</code> and see what's inside:</p>
                    <pre class="language-php"><code class="language-php">&lt;?php
use Cutlass\Cutlass;

/*
|--------------------------------------------------------------------------
| Page Template
|--------------------------------------------------------------------------
|
| This is the template that displays all pages by default.
|
*/

$post = Cutlass::get_post();

Cutlass::render(['pages.'. $post->post_name, 'pages.page'], compact('post'));</code></pre>
                    <p>You can see that the first thing we're doing is calling <code class="language-php">Cutlass::get_post()</code> which is telling our Cutlass Helper class to get the post for this page. You can read more about the Cutlass Helper class below, but for now just know that we're just getting the post that was loaded for this page (just like you would in the WordPress loop) and assigning it to the <code class="language-php">$post</code> variable.</p>
                    <p>After this you can see we're running the <code class="language-php">Cutlass::render()</code> function and passing in two variables:</p>
                    <p>The first is an array of the names of the view we want to render in order of precedence.</p>
                    <p>Next is a key/value array which contains the data we want to pass to the view. <code class="language-php">compact('post')</code> is equivalent to saying <code class="language-php">['post' => $post]</code>.</p>
                    <h4>Views</h4>
                    <p>Our views are located in <code>resources/views</code>, so in the above example when we say we want to render "pages.page" what we mean is we want to render the file <code>pages/page.blade.php</code> inside of the <code>resources/views</code> folder.</p>
                </article>
                <article id="blade-templates">
                    <header>
                        <a href="#blade-templates" class="display-3"><h3>Blade Templates</h3></a>
                    </header>
                    <p>You can read more about Blade Templates and how to work with them on the <a href="http://laravel.com/docs/5.1/blade" target="_blank">official Laravel Docs site</a>.</p>
                </article>
            </section>

            <section id="helper-classes">
                <header>
                    <a href="#helper-classes" class="display-2"><h2>Helper Classes</h2></a>
                </header>
                <ul class="header">
                    <li><a href="#helper-classes">Helper Classes</a>
                        <ul>
                            <li><a href="#cutlass">Cutlass</a></li>
                            <li><a href="#page">Page</a></li>
                            <li><a href="#post">Post</a></li>
                            <li><a href="#site">Site</a></li>
                            <li><a href="#util">Util</a></li>
                        </ul>
                    </li>
                </ul>
                <hr>
                <p>Cutlass contains a number of helper classes designed to make working with WordPress as simple as possible.</p>
                <article id="cutlass">
                    <header>
                        <a href="#cutlass" class="display-3"><h3>Cutlass</h3></a>
                    </header>
                    <p>Cutlass is the main class charged with rendering views and easily retrieving WP posts.</p>
                    <h4>Methods</h4>
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>render</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Makes and renders the view into a cached PHP file then echos and returns it.</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Array|String</span> - An array of views to render in order of precedence</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Array</span> - A key/value array of data to pass to the view</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">String</span></p>
                                <h5>Example:</h5>
<pre class="language-php"><code class="language-php">use Cutlass\Cutlass;

Cutlass::render(['pages.'. $post->post_name, 'pages.page'], compact('post'));</code></pre>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>get_post</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Gets the post and converts it into a Cutlass Post using the get_post function</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">Int|WP_Post|null</span> - Post ID or post object. Defaults to global $post.</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">String</span> - Default is Object. Accepts OBJECT, ARRAY_A, or ARRAY_N.</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">String</span> - Type of filter to apply. Accepts 'raw', 'edit', 'db', or 'display'</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">Cutlass\Post|bool|null</span></p>
                                <h5>Example:</h5>
                                <pre class="language-php"><code class="language-php">use Cutlass\Cutlass;

// Get global post
Cutlass::get_post();
// Get post by ID
Cutlass::get_post(34);</code></pre>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>get_posts</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Checks global wp_query for posts and returns them, otherwise runs get_posts on passed query.</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">Array</span> - Array of args to pass to get_posts. See <a href="https://codex.wordpress.org/Template_Tags/get_posts" target="_blank">get_posts</a>.</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">Array</span></p>
                                <h5>Example:</h5>
                                <pre class="language-php"><code class="language-php">use Cutlass\Cutlass;

// Get all posts retrieved by WordPress
Cutlass::get_posts();
// Get only 5 posts of post type page based on WP_query
Cutlass::get_posts(['num_posts' => 5, 'post_type' => 'page']);</code></pre>
                            </div>
                        </div>
                    </div>
                </article>
                <article id="page">
                    <header>
                        <a href="#page" class="display-3"><h3>Page</h3></a>
                    </header>
                    <p><strong>NOTE:</strong> This is not the same as the WP post type page.</p>
                    <p>This class is designed to allow you to easily access the object queried by WordPress and stored in the global wp_query as 'queried_object'. This allows you to access values a little more verbosely, as on it's own 'queried_object' doesn't make much sense.</p>
                    <p>You can read more about the queried_object variable <a href="https://developer.wordpress.org/reference/classes/wp_query/get_queried_object/" target="_blank">here</a>.</p>
                    <p>There is only one method, <strong>title()</strong>, which will grab a nicely formatted page title.</p>
                    <h5>Example:</h5>
<pre class="language-php"><code class="language-php">&lt;!-- home.php -->
use Cutlass\Cutlass;
use Cutlass\Page;

$page = new Page();
$posts = Cutlass::get_posts();

Cutlass::render('pages.home', compact('page','posts'));</code></pre>
                    <p><strong>Note:</strong> there's no need to instantiate a new Page class as it's included in the global view data by default. This is for example purposes only.</p>
<pre class="language-php"><code class="language-php">&lt;!-- pages/home.blade.php -->
&lt;html>
   &lt;body>
      &lt;header id="page-title">@{{ $page->title() }} &lt;!--Outputs "Blog Home" -->&lt;/header>
        {{ '@' }}foreach($posts as $post)
            &lt;article class="post">
                @{{ $post->title() }} &lt;!--Outputs the post title -->
            &lt;/article>
        {{ '@' }}endforeach
   &lt;/body>
&lt;/html></code></pre>
                    <h4>Properties</h4>
                    <div class="list-group">
                        <div class="list-group-item">
                            <span class="label label-success">Public</span> <span class="label label-pill label-default">Mixed</span> queried_object - The entire queried_object variable
                        </div>
                        <div class="list-group-item">
                            <span class="label label-success">Public</span> <span class="label label-pill label-default">Int</span> queried_object_id - Only the ID of the queried object
                        </div>
                    </div>
                    <h4>Methods</h4>
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>title</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Returns a nice formatted title according to which page we're on.</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">String</span></p>
                                <h5>Example:</h5>
                                <p>See above.</p>
                            </div>
                        </div>
                    </div>
                </article>
                <article id="post">
                    <header>
                        <a href="#post" class="display-3"><h3>Post</h3></a>
                    </header>
                    <h4>Properties</h4>
                    <p>Contains all the properties of a regular WP_Post, which you can read about <a href="https://codex.wordpress.org/Class_Reference/WP_Post#Member_Variables_of_WP_Post" target="_blank">here</a>, along with:</p>
                    <div class="list-group">
                        <div class="list-group-item">
                            <span class="label label-success">Public</span> <span class="label label-pill label-default">String</span> link - Alias for 'permalink'
                        </div>
                        <div class="list-group-item">
                            <span class="label label-success">Public</span> <span class="label label-pill label-default">String</span> human_date - A human readable post date (i.e. "2015-03-05 12:53:12" to "3 months ago")
                        </div>
                        <div class="list-group-item">
                            <span class="label label-success">WP_User</span> <span class="label label-pill label-default">String</span> author - Alias for 'post_author'
                        </div>
                        <div class="list-group-item">
                            <span class="label label-success">Public</span> <span class="label label-pill label-default">String</span> type - Alias for 'post_type'
                        </div>
                        <div class="list-group-item">
                            <span class="label label-success">Public</span> <span class="label label-pill label-default">String</span> title - Alias for 'post_title'
                        </div>
                        <div class="list-group-item">
                            <span class="label label-success">Public</span> <span class="label label-pill label-default">String</span> date - Alias for 'post_date'
                        </div>
                        <div class="list-group-item">
                            <span class="label label-success">Public</span> <span class="label label-pill label-default">String</span> date_gmt - Alias for 'post_date_gmt'
                        </div>
                        <div class="list-group-item">
                            <span class="label label-success">Public</span> <span class="label label-pill label-default">String</span> content - Alias for 'post_content' (<strong>Warning:</strong> this is straight from the database, meaning no filters have been run on it. Use the content() method if you're planning on echoing this out)
                        </div>
                        <div class="list-group-item">
                            <span class="label label-success">Public</span> <span class="label label-pill label-default">String</span> status - Alias for 'post_status'
                        </div>
                        <div class="list-group-item">
                            <span class="label label-success">Public</span> <span class="label label-pill label-default">String</span> password - Alias for 'post_password'
                        </div>
                        <div class="list-group-item">
                            <span class="label label-success">Public</span> <span class="label label-pill label-default">String</span> modified - Alias for 'post_modified'
                        </div>
                        <div class="list-group-item">
                            <span class="label label-success">Public</span> <span class="label label-pill label-default">String</span> modified_gmt - Alias for 'post_modified_gmt'
                        </div>
                    </div>
                    <hr>
                    <h5>Methods</h5>
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>author</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Simply returns the author property</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">WP_User</span></p>
                                <h5>Example PHP:</h5>
<pre class="language-php"><code class="language-php">$author = $post->author();
echo 'Author is: '. $author->data->display_name;</code></pre>
                                <h5>Example Blade:</h5>
<pre class="language-php"><code class="language-php">Posted by @{{ $post->author()->data->display_name }}</code></pre>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>can_edit</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Returns whether the current user can edit this post</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">Bool</span></p>
                                <h5>Example Blade:</h5>
                                <pre class="language-php"><code class="language-php">{{ '@' }}if($post->can_edit()
</code></pre>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>comments</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Gets all comments for this post. Proxy for <a href="https://codex.wordpress.org/Function_Reference/get_comments" target="_blank">get_comments</a></p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">Array</span> - Array of args to pass to get_comments. See  <a href="https://codex.wordpress.org/Function_Reference/get_comments" target="_blank">get_comments</a>.</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">Mixed</span></p>
                                <h5>Example PHP:</h5>
<pre class="language-php"><code class="language-php">$comments = $post->comments();
foreach($comments as $comment) {
    var_dump($comment);
    echo $comment->content;
}

object(stdClass)[112]
    public 'comment_ID' => string '1' (length=1)
    public 'comment_post_ID' => string '1' (length=1)
    public 'comment_author' => string 'Mr WordPress' (length=12)
    public 'comment_author_email' => string '' (length=0)
    public 'comment_author_url' => string 'https://wordpress.org/' (length=22)
    public 'comment_author_IP' => string '' (length=0)
    public 'comment_date' => string '2015-11-25 15:02:13' (length=19)
    public 'comment_date_gmt' => string '2015-11-25 15:02:13' (length=19)
    public 'comment_content' => string 'Hi, this is a comment. To delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.' (length=145)
    public 'comment_karma' => string '0' (length=1)
    public 'comment_approved' => string '1' (length=1)
    public 'comment_agent' => string '' (length=0)
    public 'comment_type' => string '' (length=0)
    public 'comment_parent' => string '0' (length=1)
    public 'user_id' => string '0' (length=1)

"Hi, this is a comment. To delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them."
</code></pre>
                                <h5>Example Blade:</h5>
<pre class="language-php"><code class="language-php">{{ '@' }}foreach($post->comments() as $comment)
    &lt;strong>Author:&lt;/strong> @{{ $comment->comment_author }}
    &lt;strong>Content:&lt;/strong> @{{ $comment->comment_content }}
{{ '@' }}endforeach
</code></pre>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>edit_link</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Returns whether the link to edit the post. Proxy for <a href="https://codex.wordpress.org/Function_Reference/edit_post_link" target="_blank">edit_post_link</a></p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">String</span> - The label's text</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">String</span> - Text before the link</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">String</span> - Text after the link</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">String</span></p>
                                <h5>Example Blade:</h5>
<pre class="language-php"><code class="language-php">@{{ $post->edit_link() }}
@{{ $post->edit_link('Click here to edit this post', '<', '>') }}</code></pre>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>featured_image</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Exactly the same as thumbnail method except returns full-sized image by default.</p>
                                <h5>Example Blade:</h5>
<pre class="language-php"><code class="language-php">{{ '@' }}if($post->has_featured_image())
    @{{ $post->featured_image() }}
{{ '@' }}endif</code></pre>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>field</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Proxy for ACF's get_field, if ACF isn't installed then get this post custom meta.</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">String</span> - The Field Key</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">Bool</span> - If true will echo, if false will return value. Defaults to true</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">Bool</span> - Whether or not to format the value loaded from the db. Defaults to true </p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">Mixed</span></p>
                                <h5>Example Blade:</h5>
<pre class="language-php"><code class="language-php">@{{ $post->edit_link() }}
        @{{ $post->edit_link('Click here to edit this post', '<', '>') }}</code></pre>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>has_featured_image</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Exactly the same as has_thumbnail, just allows for a little more verbosity</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">Bool</span></p>
                                <h5>Example Blade:</h5>
<pre class="language-php"><code class="language-php">{{ '@' }}if($post->has_featured_image())
    @{{ $post->featured_image() }}
{{ '@' }}endif</code></pre>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>has_thumbnail</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Returns whether the post has a featured image. Proxy for <a href="https://codex.wordpress.org/Function_Reference/has_post_thumbnail" target="_blank">has_post_thumbnail</a></p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">Bool</span></p>
                                <h5>Example Blade:</h5>
<pre class="language-php"><code class="language-php">{{ '@' }}if($post->has_thumbnail())
    @{{ $post->thumbnail(true, 'full') }}
{{ '@' }}endif</code></pre>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>post_class</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Returns the post class. Proxy for <a href="https://codex.wordpress.org/Function_Reference/get_post_class" target="_blank">get_post_class</a></p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">Bool</span> - Whether to echo the field or not</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">String|Array</span> - A string or array of classes to add to the return value</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">String</span></p>
                                <h5>Example Blade:</h5>
<pre class="language-php"><code class="language-php">&lt;article @{{ $post->post_class() }}>
    @{{ $post->content() }}
&lt;/article></code></pre>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>tags</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Returns the post's tags. Proxy for <a href="https://codex.wordpress.org/Function_Reference/wp_get_post_tags" target="_blank">wp_get_post_tags</a></p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">Array</span> - Overwrite the defaults. See defaults <a href="https://codex.wordpress.org/Function_Reference/wp_get_object_terms#Argument_Options" target="_blank">here</a>.</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">Array</span></p>
                                <h5>Example PHP:</h5>
<pre class="language-php"><code class="language-php">$tags = $post->tags();
foreach($tags as $tag) {
    var_dump($tag);
    echo $tag->name;
}

object(stdClass)[107]
    public 'term_id' => int 3
    public 'name' => string 'test1' (length=5)
    public 'slug' => string 'test1' (length=5)
    public 'term_group' => int 0
    public 'term_taxonomy_id' => int 3
    public 'taxonomy' => string 'post_tag' (length=8)
    public 'description' => string '' (length=0)
    public 'parent' => int 0
    public 'count' => int 1
    public 'filter' => string 'raw' (length=3)

"test1"</code></pre>
                                <h5>Example Blade:</h5>
<pre class="language-php"><code class="language-php">{{ '@' }}foreach($post->tags() as $tag)
    @{{ $tag->name }},
{{ '@' }}endforeach</code></pre>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>terms</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Gets the terms for this post, accepts a taxonomy. Proxy for <a href="https://codex.wordpress.org/Function_Reference/wp_get_post_terms" target="_blank">wp_get_post_terms</a></p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">String|Array</span> - The taxonomy for which to retrieve terms</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">Array</span> - Overwrite the defaults. See defaults <a href="https://codex.wordpress.org/Function_Reference/wp_get_object_terms#Argument_Options" target="_blank">here</a>.</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">Array</span></p>
                                <h5>Example:</h5>
<pre class="language-php"><code class="language-php">//Returns All Term Items for "my_taxonomy"
$term_list = $post->terms('my_taxonomy', array("fields" => "all"));
print_r($term_list);</code></pre>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="list-group-item-heading">
                                <h4>thumbnail</h4>
                            </div>
                            <div class="list-group-item-text">
                                <p>Returns the post's featured image, thumbnailed size by default. Proxy for <a href="https://codex.wordpress.org/Function_Reference/get_the_post_thumbnail" target="_blank">get_the_post_thumbnail</a></p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">Bool</span> - Whether to echo or return result</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">String|Array</span> - Size, default is 'thumbnail'</p>
                                <p><span class="label label-primary">@param</span> <span class="label label-pill label-default">Optional</span> <span class="label label-pill label-default">String|Array</span> - Attributes to add</p>
                                <p><span class="label label-success">@return</span> <span class="label label-pill label-default">String</span></p>
                                <h5>Example PHP:</h5>
<pre class="language-php"><code class="language-php">$full_featured_image = $post->thumbnail(false, 'full');
echo $full_featured_image;

"&lt;img width="1920" height="1080" src="img.jpg" class="attachment-full wp-post-image" alt="">"</code></pre>
                                <h5>Example Blade:</h5>
<pre class="language-php"><code class="language-php">{{ '@' }}if($post->has_thumbnail())
    @{{ $post->thumbnail(true, 'full') }}
{{ '@' }}endif</code></pre>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
        </section>

    </div>

@endsection
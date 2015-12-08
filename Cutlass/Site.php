<?php namespace Cutlass;

/**
 * Allows us to quickly and easily access common WordPress
 * options and blog info.
 */
class Site
{

    /**
     * Gets WordPress bloginfo using the get_bloginfo function
     *
     * Some show parameter values are deprecated and will be removed in future
     * versions. These options will trigger the {@see _deprecated_argument()}
     * function. The deprecated blog info options are listed in the function
     * contents.
     *
     * The possible values for the 'show' parameter are listed below.
     *
     * 1. url - Blog URI to homepage.
     * 2. wpurl - Blog URI path to WordPress.
     * 3. description - Secondary title
     *
     * The feed URL options can be retrieved from 'rdf_url' (RSS 0.91),
     * 'rss_url' (RSS 1.0), 'rss2_url' (RSS 2.0), or 'atom_url' (Atom feed). The
     * comment feeds can be retrieved from the 'comments_atom_url' (Atom comment
     * feed) or 'comments_rss2_url' (RSS 2.0 comment feed).
     *
     * @param string $name   - The name of the option to get
     * @param string $filter - Whether to filter the returned value
     * @param bool   $echo   - Whether to echo or return the value
     *
     * @return mixed|void
     */
    public function info($name, $filter = 'raw', $echo = true)
    {

        if ($echo === false) {
            return get_bloginfo($name, $filter);
        }

        echo get_bloginfo($name, $filter);

    }


    /**
     * Gets a WordPress sidebar using the dynamic_sidebar function
     *
     * By default this displays the default sidebar or 'sidebar-1'. If your theme specifies the 'id' or
     * 'name' parameter for its registered sidebars you can pass an id or name as the $index parameter.
     * Otherwise, you can pass in a numerical index to display the sidebar at that index.
     *
     * @param int|string $sidebar Optional, default is 1. Index, name or ID of dynamic sidebar.
     * @param bool       $echo    Whether to echo out the sidebar or not
     *
     * @return void|string
     */
    public function sidebar($sidebar = 1, $echo = true)
    {
        /**
         * We're using ob_ functions so we can reliably return
         * the correct values if dynamic_sidebar fails
         */
        ob_start();
        dynamic_sidebar($sidebar);
        $sidebar = ob_get_clean();

        if ($echo === false) {
            return $sidebar;
        }

        echo $sidebar;

    }


    /**
     * Gets a WordPress menu using the wp_nav_menu function
     *
     * @param array        $args            {
     *                                      Optional. Array of nav menu arguments.
     *
     * @type string        $menu            Desired menu. Accepts (matching in order) id, slug, name. Default empty.
     * @type string        $menu_class      CSS class to use for the ul element which forms the menu. Default 'menu'.
     * @type string        $menu_id         The ID that is applied to the ul element which forms the menu.
     *                                          Default is the menu slug, incremented.
     * @type string        $container       Whether to wrap the ul, and what to wrap it with. Default 'div'.
     * @type string        $container_class Class that is applied to the container. Default 'menu-{menu
     *       slug}-container'.
     * @type string        $container_id    The ID that is applied to the container. Default empty.
     * @type callback|bool $fallback_cb     If the menu doesn't exists, a callback function will fire.
     *                                          Default is 'wp_page_menu'. Set to false for no fallback.
     * @type string        $before          Text before the link text. Default empty.
     * @type string        $after           Text after the link text. Default empty.
     * @type string        $link_before     Text before the link. Default empty.
     * @type string        $link_after      Text after the link. Default empty.
     * @type bool          $echo            Whether to echo the menu or return it. Default true.
     * @type int           $depth           How many levels of the hierarchy are to be included. 0 means all. Default
     *       0.
     * @type object        $walker          Instance of a custom walker class. Default empty.
     * @type string        $theme_location  Theme location to be used. Must be registered with register_nav_menu()
     *                                          in order to be selectable by the user.
     * @type string        $items_wrap      How the list items should be wrapped. Default is a ul with an id and class.
     *                                          Uses printf() format with numbered placeholders.
     * }
     *
     * @return object|false|void Menu output if $echo is false, false if there are no items or no menu was found.
     */
    public function menu($args = [ ])
    {

        if (isset( $args['echo'] ) && $args['echo'] === false) {
            echo wp_nav_menu($args);
        } else {
            return wp_nav_menu($args);
        }

    }


    /**
     * Gets whether or not the location has a WordPress sidebar
     * assigned to it using the has_nav_menu function.
     *
     * @param string $location
     *
     * @return bool
     */
    public function has_menu($location)
    {

        return has_nav_menu($location);

    }


    /**
     * Gets a WordPress option using the get_option function
     *
     * If the option does not exist or does not have a value, then the return value
     * will be false. This is useful to check whether you need to install an option
     * and is commonly used during installation of plugin options and to test
     * whether upgrading is required.
     *
     * If the option was serialized then it will be unserialized when it is returned.
     *
     * @param string $option  Name of option to retrieve. Expected to not be SQL-escaped.
     * @param mixed  $default Optional. Default value to return if the option does not exist.
     *
     * @return mixed Value set for the option.
     */
    public function option($option, $default = false)
    {

        return get_option($option, $default);

    }


    /**
     * Gets the WordPress comments template using the comments_template function
     *
     * Will not display the comments template if not on single post or page, or if
     * the post does not have comments.
     *
     * Uses the WordPress database object to query for the comments. The comments
     * are passed through the 'comments_array' filter hook with the list of comments
     * and the post ID respectively.
     *
     * The $file path is passed through a filter hook called, 'comments_template'
     * which includes the TEMPLATEPATH and $file combined. Tries the $filtered path
     * first and if it fails it will require the default comment template from the
     * default theme. If either does not exist, then the WordPress process will be
     * halted. It is advised for that reason, that the default theme is not deleted.
     *
     * @param string     $file
     * @param bool|false $separate_comments
     *
     * @return void
     */
    public function comments($file = '/comments.php', $separate_comments = false)
    {

        comments_template($file, $separate_comments);

    }


    /**
     * Gets the WordPress search form using the get_search_form function
     *
     * Will first attempt to locate the searchform.php file in either the child or
     * the parent, then load it. If it doesn't exist, then the default search form
     * will be displayed. The default search form is HTML, which will be displayed.
     * There is a filter applied to the search form HTML in order to edit or replace
     * it. The filter is 'get_search_form'.
     *
     * This function is primarily used by themes which want to hardcode the search
     * form into the sidebar and also by the search widget in WordPress.
     *
     * There is also an action that is called whenever the function is run called,
     * 'pre_get_search_form'. This can be useful for outputting JavaScript that the
     * search relies on or various formatting that applies to the beginning of the
     * search. To give a few examples of what it can be used for.
     *
     * @param bool|true $echo
     *
     * @return string|void String when $echo is false.
     */
    public function search_form($echo = true)
    {

        if ($echo === false) {
            return get_search_form($echo);
        }

        echo get_search_form($echo);

    }


    /**
     * Simple proxy for wp_login_form
     *
     * Provides a simple login form for use anywhere within WordPress. By default, it echoes
     * the HTML immediately.
     *
     * @param array $args Configuration options to modify the form output.
     * @param bool  $echo Default to echo and not return the form.
     *
     * @return string|void String when retrieving.
     */
    public function login_form($args = [ ], $echo = true)
    {

        if (( isset( $args['echo'] ) && $args['echo'] === false ) || $echo === false) {
            return wp_login_form($args);
        }

        /**
         * The function will echo itself out
         */

        $args['echo'] = true;

        wp_login_form($args);

    }


    /**
     * Simple proxy for get_bloginfo('url');
     *
     * @param string $type - in case you want to get the home_url, defaults to url
     *
     * @return mixed|void
     */
    public function url($type = 'url')
    {

        return get_bloginfo($type);

    }


    /**
     * Simple proxy for get_footer function
     *
     * Load footer template.
     *
     * Includes the footer template for a theme or if a name is specified then a
     * specialised footer will be included.
     *
     * For the parameter, if the file is called "footer-special.php" then specify
     * "special".
     *
     * @param string $name The name of the specialised footer.
     *
     * @return void
     */
    public function footer($name = null)
    {

        get_footer($name);

    }


    /**
     * Simple proxy for wp_loginout
     *
     * Display the Log In/Out link.
     *
     * Displays a link, which allows users to navigate to the Log In page to log in
     * or log out depending on whether they are currently logged in.
     *
     * @param string $redirect Optional path to redirect to on login/logout.
     * @param bool   $echo     Default to echo and not return the link.
     *
     * @return string|void String when retrieving.
     */
    public function loginout($redirect = '', $echo = true)
    {

        if ($echo === false) {
            return wp_loginout($redirect, $echo);
        }

        /**
         * This function will echo itself out
         */
        wp_loginout($redirect, $echo);

    }


    /**
     * Simple proxy for wp_logout_url
     *
     * Returns the Log Out URL.
     *
     * Returns the URL that allows the user to log out of the site.
     *
     * @param string $redirect Path to redirect to on logout.
     * @param bool   $echo     Default to echo and not return the link.
     *
     * @return string A log out URL.
     */
    public function logout($redirect = '', $echo = true)
    {

        if ($echo === false) {
            return wp_logout_url($redirect);
        }

        echo wp_logout_url($redirect);

    }


    /**
     * Simple proxy for wp_login_url
     *
     * Returns the URL that allows the user to log in to the site.
     *
     * @param string $redirect     Path to redirect to on login.
     * @param bool   $force_reauth Whether to force reauthorization, even if a cookie is present. Default is false.
     * @param bool   $echo         Default to echo and not return the link.
     *
     * @return string A log in URL.
     */
    public function login($redirect = '', $force_reauth = false, $echo = true)
    {

        if ($echo === false) {
            return wp_login_url($redirect, $force_reauth);
        }

        echo wp_login_url($redirect, $force_reauth);

    }


    /**
     * Simple proxy for wp_registration_url
     *
     * Returns the URL that allows the user to register on the site.
     *
     * @param bool $echo Default to echo and not return the link.
     *
     * @return string|void User registration URL.
     */
    public function registration($echo = true)
    {

        if ($echo === false) {
            return wp_registration_url();
        }

        echo wp_registration_url();

    }


    /**
     * Simple proxy for wp_lostpassword_url
     *
     * Returns the URL that allows the user to retrieve the lost password
     *
     * @param string $redirect Path to redirect to on login.
     * @param bool   $echo     Default to echo and not return the link.
     *
     * @return string Lost password URL.
     */
    public function lostpassword($redirect = '', $echo = true)
    {

        if ($echo === false) {
            return wp_lostpassword_url($redirect);
        }

        echo wp_lostpassword_url($redirect);

    }


    /**
     * Simple proxy for get_site_icon_url
     *
     * Returns or echos the Site Icon URL.
     *
     * @param  int    $size    Size of the site icon.
     * @param  string $url     Fallback url if no site icon is found.
     * @param  int    $blog_id Id of the blog to get the site icon for.
     * @param bool    $echo    Default to echo and not return the link.
     *
     * @return string|void          Site Icon URL.
     */
    public function icon($size = 512, $url = '', $blog_id = 0, $echo = true)
    {

        if ($echo === false) {
            return get_site_icon_url($size, $url, $blog_id);
        }

        echo get_site_icon_url($size, $url, $blog_id);

    }


    /**
     * Simple proxy for has_site_icon
     *
     * Whether the site has a Site Icon.
     *
     * @param int $blog_id Optional. Blog ID. Default: Current blog.
     *
     * @return bool
     */
    public function has_icon($blog_id = 0)
    {

        return has_site_icon($blog_id);

    }


    /**
     * Simple proxy for get_calendar
     *
     * Display calendar with days that have posts as links.
     *
     * The calendar is cached, which will be retrieved, if it exists. If there are
     * no posts for the month, then it will not be displayed.
     *
     * @param bool $initial Optional, default is true. Use initial calendar names.
     * @param bool $echo    Optional, default is true. Set to false for return.
     *
     * @return string|void String when retrieving.
     */
    public function calendar($initial = true, $echo = true)
    {

        if ($echo === false) {
            return get_calendar($initial, $echo);
        }

        /**
         * Function will echo itself out
         */
        get_calendar($initial, $echo);

    }


    /**
     * Simple proxy for paginate_links
     *
     * Retrieve paginated link for archive post pages.
     *
     * Technically, the function can be used to create paginated link list for any
     * area. The 'base' argument is used to reference the url, which will be used to
     * create the paginated links. The 'format' argument is then used for replacing
     * the page number. It is however, most likely and by default, to be used on the
     * archive post pages.
     *
     * The 'type' argument controls format of the returned value. The default is
     * 'plain', which is just a string with the links separated by a newline
     * character. The other possible values are either 'array' or 'list'. The
     * 'array' value will return an array of the paginated link list to offer full
     * control of display. The 'list' value will place all of the paginated links in
     * an unordered HTML list.
     *
     * The 'total' argument is the total amount of pages and is an integer. The
     * 'current' argument is the current page number and is also an integer.
     *
     * An example of the 'base' argument is "http://example.com/all_posts.php%_%"
     * and the '%_%' is required. The '%_%' will be replaced by the contents of in
     * the 'format' argument. An example for the 'format' argument is "?page=%#%"
     * and the '%#%' is also required. The '%#%' will be replaced with the page
     * number.
     *
     * You can include the previous and next links in the list by setting the
     * 'prev_next' argument to true, which it is by default. You can set the
     * previous text, by using the 'prev_text' argument. You can set the next text
     * by setting the 'next_text' argument.
     *
     * If the 'show_all' argument is set to true, then it will show all of the pages
     * instead of a short list of the pages near the current page. By default, the
     * 'show_all' is set to false and controlled by the 'end_size' and 'mid_size'
     * arguments. The 'end_size' argument is how many numbers on either the start
     * and the end list edges, by default is 1. The 'mid_size' argument is how many
     * numbers to either side of current page, but not including current page.
     *
     * It is possible to add query vars to the link by using the 'add_args' argument
     * and see {@link add_query_arg()} for more information.
     *
     * The 'before_page_number' and 'after_page_number' arguments allow users to
     * augment the links themselves. Typically this might be to add context to the
     * numbered links so that screen reader users understand what the links are for.
     * The text strings are added before and after the page number - within the
     * anchor tag.
     *
     * @param string|array $args               {
     *                                         Optional. Array or string of arguments for generating paginated links
     *                                         for archives.
     *
     * @type string        $base               Base of the paginated url. Default empty.
     * @type string        $format             Format for the pagination structure. Default empty.
     * @type int           $total              The total amount of pages. Default is the value WP_Query's
     *                                      `max_num_pages` or 1.
     * @type int           $current            The current page number. Default is 'paged' query var or 1.
     * @type bool          $show_all           Whether to show all pages. Default false.
     * @type int           $end_size           How many numbers on either the start and the end list edges.
     *                                      Default 1.
     * @type int           $mid_size           How many numbers to either side of the current pages. Default 2.
     * @type bool          $prev_next          Whether to include the previous and next links in the list. Default
     *       true.
     * @type bool          $prev_text          The previous page text. Default '« Previous'.
     * @type bool          $next_text          The next page text. Default '« Previous'.
     * @type string        $type               Controls format of the returned value. Possible values are 'plain',
     *                                      'array' and 'list'. Default is 'plain'.
     * @type array         $add_args           An array of query args to add. Default false.
     * @type string        $add_fragment       A string to append to each link. Default empty.
     * @type string        $before_page_number A string to appear before the page number. Default empty.
     * @type string        $after_page_number  A string to append after the page number. Default empty.
     * }
     * @return array|string|void String of page links or array of page links.
     */
    public function paginate($args = [ ])
    {

        echo paginate_links($args);

    }


    /**
     * Simple proxy for get_search_query
     *
     * Retrieve the contents of the search WordPress query variable.
     *
     * The search query string is passed through {@link esc_attr()}
     * to ensure that it is safe for placing in an html attribute.
     *
     * @param bool $escaped   Whether the result is escaped. Default true.
     *                        Only use when you are later escaping it. Do not use unescaped.
     * @param bool $echo      Optional, default is true. Set to false for return.
     *
     * @return string|void
     */
    public function search_query($escaped = true, $echo = true)
    {

        if ($echo === false) {
            return get_search_query($escaped);
        }

        echo get_search_query($escaped);

    }

}
<?php namespace Cutlass;

/**
 * This is the actual Queried Object called by WordPress
 */
class Page
{

    /**
     * The object queried by WordPress
     *
     * @var mixed
     */
    public $queried_object;

    /**
     * The ID of the object queried by WordPress
     *
     * @var int
     */
    public $queried_object_id;


    /**
     * Simply loads the queried object and ID
     */
    public function __construct()
    {

        $this->queried_object    = get_queried_object();
        $this->queried_object_id = get_queried_object_id();

    }


    /**
     * Returns a nice formatted title according to which page
     * we're on.
     *
     * From Root's Sage
     * https://github.com/roots/sage
     *
     * @param bool $echo
     *
     * @return string
     */
    public function title($echo = true)
    {
        $title = '';
        if (is_home()) {
            if (get_option('page_for_posts', true)) {
                $title = get_the_title(get_option('page_for_posts', true));
            } else {
                $title = 'Latest Posts';
            }
        } elseif (is_archive()) {
            $title = get_the_archive_title();
        } elseif (is_search()) {
            $title = 'Search Results for ' . get_search_query();
        } elseif (is_404()) {
            $title = '404 - Not Found';
        } else {
            $title = get_the_title($this->queried_object_id);
        }

        if ($echo === false) {
            return $echo;
        }

        echo $title;

    }

}
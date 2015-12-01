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
    public function __construct() {

        $this->queried_object = get_queried_object();
        $this->queried_object_id = get_queried_object_id();

    }


    /**
     * Returns a nice formatted title according to which page
     * we're on.
     *
     * From Root's Sage
     * https://github.com/roots/sage
     *
     * @return string
     */
    public function title()
    {

        if (is_home()) {
            if (get_option('page_for_posts', true)) {
                return get_the_title(get_option('page_for_posts', true));
            } else {
                return 'Latest Posts';
            }
        } elseif (is_archive()) {
            return get_the_archive_title();
        } elseif (is_search()) {
            return 'Search Results for ' . get_search_query();
        } elseif (is_404()) {
            return '404 - Not Found';
        } else {
            return get_the_title($this->queried_object_id);
        }

    }


}
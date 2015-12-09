<?php namespace Cutlass;

use Carbon\Carbon;
use Exception;
use WP_User;

/**
 * Allows us to quickly and easily access common WordPress User functions
 */
class User
{

    /**
     * The user's ID.
     *
     * @var int
     */
    public $ID;

    /**
     * User data container.
     *
     * @var object
     */
    public $data;

    /**
     * The User's username (user_login)
     *
     * @var string
     */
    public $username, $user_login;

    /**
     * The User's nicename (user_nicename). Typically used
     * to create the user slug. I think.
     *
     * @var string
     */
    public $nicename, $user_nicename;

    /**
     * The User's email (user_email)
     *
     * @var string
     */
    public $email, $user_email;

    /**
     * The Users's url
     *
     * @var string
     */
    public $url, $user_url;

    /**
     * When the User registered
     *
     * @var string
     */
    public $registered, $user_registered, $human_registered;

    /**
     * The User's status
     *
     * @var string
     */
    public $status, $user_status;

    /**
     * The User's name (display_name)
     *
     * @var string
     */
    public $name, $display_name;

    /**
     * The individual capabilities the user has been given.
     *
     * @var array
     */
    public $caps;

    /**
     * User metadata option name.
     *
     * @var string
     */
    public $cap_key;

    /**
     * The roles the user is part of.
     *
     * @var array
     */
    public $roles;

    /**
     * All capabilities the user has, including individual and role based.
     *
     * @var array
     */
    public $allcaps;

    /**
     * The link to the author's posts page
     *
     * @var string
     */
    public $link;


    /**
     * Accepts a WP_User object and builds a new User object using
     * it's properties
     *
     * @param $user \WP_User|int
     *
     * @throws \Exception
     */
    public function __construct($user = null)
    {
        /**
         * There's no arguments so we'll just grab the most
         * relevant user
         */
        if ($user === null) {
            global $authordata;

            /**
             * If we're in the WP Loop we'll want to grab that User
             */
            if ( ! empty( $authordata ) && in_the_loop()) {
                global $post;
                if ((int) $post->post_author === $authordata->ID) {
                    $user = $authordata;
                }
            } else {
                /**
                 * Fallback to the currently logged in user
                 */
                $user = wp_get_current_user();
            }
        }

        /**
         * If we were passed an int use that to get the user object
         */
        if (is_int($user)) {
            $user = new WP_User($user);
        }

        /**
         * If $user is not a WP_User or is empty (can happen sometimes) throw exception
         */
        if ( ! $user instanceof WP_User || empty( (array) $user->data )) {
            throw new Exception('This User was not able to convert the arguments into a valid WP_User object.');
        }

        /**
         * Takes the original WP_User properties and moves them to this Post object
         */
        $this->set_properties($user);

    }


    /**
     * Accepts WP_User object, takes its properties and
     * applies them to this Post object
     *
     * @param \WP_User $user
     */
    protected function set_properties($user)
    {

        /**
         * Get WP_Post properties
         */
        $props = get_object_vars($user);

        /**
         * Apply WP_Post properties to this Post object
         */
        foreach ($props as $key => $prop) {
            $this->$key = $prop;
        }

        /**
         * Now take the data object and move it's properties
         * up so we can use them like normal
         */
        $props = get_object_vars($user->data);

        foreach ($props as $key => $prop) {

            $this->$key = $prop;

            if (substr($key, 0, 5) === "user_") {
                $new        = substr($key, 5, strlen($key));
                $this->$new =& $this->$key;
            }
        }
        $this->name = $this->display_name;

        /**
         * Sets the link to the users posts page
         */
        $this->link = get_author_posts_url($this->ID, $this->nicename);

        /**
         * Set human date property using Carbon
         */
        $this->human_registered = Carbon::parse($this->registered)->diffForHumans();
    }


    /**
     * Simple proxy for get_user_meta
     *
     * @param string $key    Optional. The meta key to retrieve. By default, returns data for all keys.
     * @param bool   $single Whether to return a single value.
     * @param bool   $echo   Whether to echo or return value
     *
     * @return mixed Will be an array if $single is false. Will be value of meta data field if $single is true.
     */
    public function meta($key = '', $single = false, $echo = true)
    {

        if ($echo === false) {
            return get_user_meta($this->ID, $key, $single);
        }

        echo get_user_meta($this->ID, $key, $single);

    }


    /**
     * Simple proxy for user_can
     *
     * Whether a particular user has capability or role.
     *
     * @param string $capability Capability or role name.
     *
     * @return bool
     */
    public function can($capability)
    {

        return user_can($this->data, $capability);

    }


    /**
     * Simple proxy for count_user_posts
     *
     * Number of posts user has written.
     *
     * @param array|string $post_type Optional. Single post type or array of post types to count the number of posts
     *                                for. Default 'post'.
     *
     * @return int Number of posts the user has written in this post type.
     */
    public function count($post_type = 'post')
    {

        return count_user_posts($this->ID, $post_type);

    }

}
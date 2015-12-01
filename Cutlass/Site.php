<?php namespace Cutlass;

/**
 * Allows us to quickly and easily access common WordPress
 * options and blog info.
 */
class Site
{

    /**
     * Allows us to easily access the bloginfo wp function
     *
     * @param string $name   - The name of the option to get
     * @param string $filter - Whether to filter the returned value
     *
     * @return mixed
     */
    public function info($name, $filter = 'raw')
    {

        return get_bloginfo($name, $filter);

    }


    /**
     * Returns the value of wp_title function
     *
     * @param string $sep
     * @param bool   $display
     * @param string $seplocation
     *
     * @return String
     */
    public function title($sep = '&raquo;', $display = false, $seplocation = 'left')
    {

        return wp_title($sep, $display, $seplocation);

    }


    /**
     * Simple helper to load WordPress dynamic sidebars
     *
     * @param string $sidebar
     *
     * @return void|string
     */
    public function sidebar($sidebar = '')
    {
        /**
         * We're using ob_ functions so we can reliably return
         * the correct values if dynamic_sidebar fails
         */
        ob_start();
        dynamic_sidebar($sidebar);
        $sidebar = ob_get_clean();

        if (is_string($sidebar)) {
            echo $sidebar;

            return;
        }

        return $sidebar;
    }


    /**
     * Allows us to easily access the option wp function
     *
     * @param string $name - the option name
     *
     * @return mixed
     */
    public function option($name)
    {

        return get_option($name);

    }

}
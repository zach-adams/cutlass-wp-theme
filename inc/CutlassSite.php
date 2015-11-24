<?php namespace Cutlass;

/**
 * CutlassSite Class
 *
 * Allows us to quickly and easily access common WordPress
 * options and blog info.
 */
class CutlassSite
{

    /**
     * info
     *
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
     * title
     *
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
     * option
     *
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
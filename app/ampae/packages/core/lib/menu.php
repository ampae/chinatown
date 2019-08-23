<?php
/**
 * ChinaTown - LAMP SaaS FrameWork.
 * Complete User Registration and Management. Secure, Fast, Small and Light.
 *
 * THIS CODE ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY KIND,
 * EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A PARTICULAR PURPOSE.
 *
 * PHP version 5.4
 *
 * @version    HG: <5.1.1>
 * @category   SaaS RAD LAMP FrameWork.
 * @see        https://ampae.com/chinatown/
 * @author     AMPAE <info@ampae.com>
 * @license    https://ampae.com/chinatown/license.txt
 * @copyright  2009 - 2019 AMPAE
**/

 namespace Ampae\Lib;

class Menu
{
    /**
     * constructor;
     */
    public function __construct()
    {
        global $tmpGlobalConfig;

        //$tmpGlobalConfig['menu'] = array();
        //$tmpGlobalConfig['menu']['side'] = array();
    }

    /**
     * Fetch
     *
     * @return
     */
    public function get()
    {
        global $tmpGlobalConfig;
    }

    /**
     * Add a
     *
     * @return void
     */
    public function add($loc, $name, $menu)
    {
        global $tmpGlobalConfig;
        $tmpGlobalConfig['menu'][$loc][$name] = array_replace_recursive($tmpGlobalConfig['menu'][$loc][$name], $menu);
    }
}

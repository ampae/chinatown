<?php
/**
 * ChinaTown - LAMP SaaS FrameWork.
 * Complete User Registration and Management. Secure, Fast, Small and Light.
 *
 * THIS CODE ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY KIND,
 * EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A PARTICULAR PURPOSE.
 *
 * PHP version 7.2
 *
 * @version    GIT: <14.2.4>
 * @category   SaaS RAD LAMP FrameWork.
 * @see        https://ampae.com/chinatown/
 * @author     AMPAE <info@ampae.com>
 * @license    https://ampae.com/chinatown/LICENSE
 * @copyright  2009 - 2020 AMPAE
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

    public function menus()
    {
        global $office, $tmpGlobalConfig;
        /*
        foreach ($tmpGlobalConfig['vendor'] as $tmpVendor) {
          foreach ($tmpGlobalConfig['packages'][$tmpVendor] as $tmpPack) {
            include DIR_APP.DIRECTORY_SEPARATOR.$tmpVendor.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'menus.php';
          }
        }
        */
        if (!$office->is()) {
            $tmpGlobalConfig['menu']['side']['user']['2990'] = '';
            $tmpGlobalConfig['menu']['side']['office'] = array(); // not really needed, just an extra precaution..
        }
    }
}

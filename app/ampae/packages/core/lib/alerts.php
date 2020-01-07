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

class Alerts
{
    /**
     * constructor;
     */
    public function __construct()
    {
    }

    /**
     * Fetch
     *
     * @return void
     */
    public function check()
    {
        global $session;
        return $session->isxSet('alert');
    }

    /**
     * Fetch All
     *
     * @return void
     */
    public function getAll()
    {
        global $session;

        return $session->get('alert');
    }

    /**
     * Add
     *
     * @return void
     */
    public function add($key, $value)
    {
        global $session;

        $tmp_arr = $this->getAll();

        $tmp_arr_new = array($key=>$value);

        if (is_array($tmp_arr)) {
            $merge = array_merge($tmp_arr, $tmp_arr_new);
        } else {
            $merge = array_merge($tmp_arr_new);
        }

        $session->set('alert', $merge);
    }

    /**
     * Removes option by name.
     *
     * @return void
     */
    public function deleteAll()
    {
        global $session;
        return $session->reset('alert');
    }
}

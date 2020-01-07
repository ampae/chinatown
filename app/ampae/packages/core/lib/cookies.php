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
 * @license    https://ampae.com/chinatown/license.txt
 * @copyright  2009 - 2020 AMPAE
**/

namespace Ampae\Lib;

/**
 * Cookies.
 *
 * @category Class
 *

 */
class Cookies
{
    /**
     * constructor; initialize cookies;.
     */
    public function __construct()
    {
    }

    /**
     * returns true if k has value
     *
     * @param string $k config
     *
     * @return boolen
     */
    public function isxSet($k = CCID)
    {
        return isset($_COOKIE[$k]);
    }

    /**
     * set & store v in cookie k.
     *
     * @param string $k config
     * @param string $v config
     */
    public function set($k = CCID, $v = null, $t = null, $p = null)
    {
      global $controller;
        if ($t==null) {
            $t = time() + 3600;
        } else {
            $t = time() + $t;
        }
        if ($p==null) {
            $p = "/";
        }
        //setcookie($k, $v, $t, $p,$controller->info['domain'],1);
        setcookie($k, $v, $t, $p);
    }

    /**
     * get k value from session.
     *
     * @param string $k key config
     *
     * @return string
     */
    public function get($k = CCID)
    {
        $v = false;
        if (isset($_COOKIE[$k])) {
            $v = $_COOKIE[$k];
        }
        return $v;
    }

    /**
     * get k value from cookies once, then delete it.
     *
     * @param string $k key config
     *
     * @return string
     */
    public function getOnce($k = CCID)
    {
        $v = $this->get($k);
        $this->del($k);
        return $v;
    }

    /**
     * del key.
     *
     * @param string $k key config
     */
    public function del($k = CCID)
    {
        setcookie($k, "", time() - 3600);
        unset($_COOKIE[$k]);
    }
}

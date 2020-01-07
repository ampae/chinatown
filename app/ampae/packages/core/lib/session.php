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

class Session
{
    /**
     * constructor; initialize session;.
     */
    public function __construct()
    {
        global $controller, $model;
        session_set_cookie_params(0, $controller->info['app_path']);
        ini_set('session.cookie_httponly', 1);
        ini_set('session.gc_maxlifetime', SESSION_TTL);
        ini_set('session.cookie_lifetime', SESSION_TTL);
        session_name(SESSION_NAME);
        session_start();
    }

    /**
     * kill session; manual destructor;.
     */
    public function kill()
    {
        session_regenerate_id();
        $_SESSION[CCID] = array(); // session_unset();
        session_destroy();
    }

    /**
     * store k in session.
     *
     * @param string $k config
     * @param string $v config
     */
    public function set($k, $v = null)
    {
        $_SESSION[CCID][$k] = $v;
        //if (null === $v) {
        //    unset($_SESSION[CCID][$k]);
        //}
    }

    /**
     * returns true if k has value
     *
     * @param string $k config
     *
     * @return boolen
     */
    public function isxSet($k)
    {
        return isset($_SESSION[CCID][$k]);
    }

    /**
     * get k value from session.
     *
     * @param string $k key config
     *
     * @return string
     */
    public function get($k)
    {
        $v = false;
        if (isset($_SESSION[CCID][$k])) {
            $v = $_SESSION[CCID][$k];
        }

        return $v;
    }

    /**
     * get k value from session once, then delete it.
     *
     * @param string $k key config
     *
     * @return string
     */
    public function getOnce($k)
    {
        $v = false;
        if (isset($_SESSION[CCID][$k])) {
            $v = $_SESSION[CCID][$k];
        }
        $this->del($k);

        return $v;
    }

    /**
     * wipe key.
     *
     * @param string $k key config
     */
    public function wipe($k)
    {
        // if ( isset ( $_SESSION[CCID][$k] ) ) {
        $_SESSION[CCID][$k] = md5(uniqid(rand(), true));
        // }
    }

    /**
     * del key.
     *
     * @param string $k key config
     */
    public function del($k)
    {
        // if ( isset ( $_SESSION[CCID][$k] ) ) {
        unset($_SESSION[CCID][$k]);
        // }
    }

    /**
     * reset key ()
     *
     * @param string $k key config
     *
     * @return void
     */
    public function reset($k)
    {
        //if ( isset ( $_SESSION[self::CCID][$k] ) ) {
            $_SESSION[CCID][$k] = null; //md5(uniqid(rand(), true));
        //}
    }
}

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

/**
 * Access Codes.
 *
 * @category Class
 *

 */
class Ac
{
    const RES = 'ac';
    /**
     * constructor; initialize dev;.
     */
    public function __construct()
    {
        //global $cookies, $controller, $basic;
    }

    /**
     *
     *
     * @param string $k config
     *
     * @return boolen
     */
    public function isxSet($k = CCID)
    {
    }

    /**
     * set
     *
     * @param string $k config
     * @param string $v config
     */
    public function set($i, $k, $v)
    {
        if (!DEBUG_MODE) {
            // $k = hash('sha256', $k); // never store cookie values in db !!!
        }

        // save to DB
    }

    /**
     * get k value
     *
     * @param string $k key config
     *
     * @return string
     */
    public function get($i, $k)
    {
        global $smrecb, $db;
        $res = false;
        if (!DEBUG_MODE) {
            // $k = hash('sha256', $k); // never store cookie values in db !!!
        }
        // check DB !!!
        //$res = '1234';

        //$res = $smrecb->getRecNew($db->db1, DB1_TABLE_PREFIX.self::RES, 'val', array('key'=>$k));
        $res = $smrecb->getRecNew($db->db1, DB1_TABLE_PREFIX.self::RES, 'val', array('id'=>$i,'key'=>$k));

        return $res;
    }

    /**
     * del key.
     *
     * @param string $k key config
     */
    public function del($k = CCID)
    {
        // del DEV ID
    }

    private function dbSet($v)
    {
    }
}

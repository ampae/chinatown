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
 * Office.
 *
 * @category Class
 *

 */
class Office
{
  const RES = 'office';
    /**
     * constructor; initialize dev;.
     */
    public function __construct()
    {
      global $cookies, $controller, $basic;

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
    public function set($k, $v = null)
    {
      if (!DEBUG_MODE) {
        $k = hash('sha256', $k); // never store cookie values in db !!!
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
    public function get($k)
    {
      $res = false;
      if (!DEBUG_MODE) {
        $k = hash('sha256', $k); // never store cookie values in db !!!
      }
// check DB !!!
//$res = '1234';
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
      global $db;
        $ts = time();
        //$exp = $ts + 946080000;
        $dadata = array('gl' => 1, 'uid' => $uid, 'crud' => $level, 'st' => 1, 'ts' => $ts, 'exp' => $exp); // ts, exp !!!
        $tmpPrep = "INSERT INTO `".DB1_TABLE_PREFIX.self::RES."` (`gl`,`uid`,`crud`,`st`,`ts`,`exp`) VALUES (:gl, :uid, :crud, :st, :ts, :exp)";
        $tmp_query = $db->db1->prepare($tmpPrep);
        $res = $tmp_query->execute($dadata);
        return $res;
    }
}

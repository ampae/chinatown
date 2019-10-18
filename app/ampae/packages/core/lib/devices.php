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

/**
 * Cookies.
 *
 * @category Class
 *

 */
class Devices
{
  const RES = 'devices';
    /**
     * constructor; initialize dev;.
     */
    public function __construct()
    {
      global $cookies, $controller, $basic, $db;
/*
      if ( $cookies->isxSet() ) {
        $tmpDevID = $cookies->get(CCID);

        if ($this->dbIsSet($db->db1, DB1_TABLE_PREFIX.self::RES,$tmpDevID)) {
            $tmpGetUid = $this->dbget($db->db1, DB1_TABLE_PREFIX.self::RES,$tmpDevID);
        }

      } else {
        $tmpDevID = $basic->uuid();
        $cookies->set(CCID, $tmpDevID, DEV_TTL, $controller->info['app_path']);
        $this->dbSet($db->db1, DB1_TABLE_PREFIX.self::RES, $tmpDevID);
      }


*/
    }

    // !!! 1. setDev
    // !!! 2. getDev

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
     * get k value
     *
     * @param string $k key config
     *
     * @return string
     */
    public function get($k)
    {

      global $db, $smrecb;
      $res = false;
      if (!DEBUG_MODE) {
        //$k = hash('sha256', $k); // never store cookie values in db !!!
      }

      if ( $db->db1 ) {
        return $smrecb->getRec($db->db1, DB1_TABLE_PREFIX.self::RES, 'uid', 'devid', $k, 0);

      } else {
        return false;
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

    public function set($k,$uid=0,$v=0)
    {
        global $db;
        $ts = time();
        $exp = $ts + 946080000;

        if (!DEBUG_MODE) {
//          $k = hash('sha256', $k); // never store cookie values in db !!!
        }

        $dadata = array('devid' => $k, 'uid' => $uid, 'sid' => $v, 'st' => 1, 'ts' => $ts, 'exp' => $exp); // ts, exp !!!
        $tmpPrep = "INSERT INTO `".DB1_TABLE_PREFIX.self::RES."` (`devid`,`uid`,`sid`,`st`,`ts`,`exp`) VALUES (:devid, :uid, :sid, :st, :ts, :exp)";
        $tmp_query = $db->db1->prepare($tmpPrep);
        $res = $tmp_query->execute($dadata);
        return $res;
    }
}

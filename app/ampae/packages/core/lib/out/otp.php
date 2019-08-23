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

class Otp
{
    //public $arr     = array();
    //public $va       = null;

    const RES = 'otp';

    public function __construct()
    {
    }

    public function getOtp($tmpRid)
    {
        global $db, $smrecb;
        return $smrecb->getRec($db->db1, DB1_TABLE_PREFIX.self::RES, 'otp', 'dev_rid', $tmpRid);
    }

    public function getCdata($tmpRid)
    {
        global $db, $smrecb;
        return $smrecb->getRec($db->db1, DB1_TABLE_PREFIX.self::RES, 'cdata', 'dev_rid', $tmpRid);
    }

    public function getOp($tmpRid)
    {
        global $db, $smrecb;
        return $smrecb->getRec($db->db1, DB1_TABLE_PREFIX.self::RES, 'op', 'dev_rid', $tmpRid);
    }

    public function chkStatus($tmpRid)
    {
        global $db, $smrecb;
        return $smrecb->getRec($db->db1, DB1_TABLE_PREFIX.self::RES, 'status', 'dev_rid', $tmpRid);
    }


    public function countDev($devRid)
    {
        global $db;

        $q = "SELECT COUNT(`rid`) FROM `".DB1_TABLE_PREFIX.self::RES."` WHERE `dev_rid`='$devRid' ";

        $result = $db->db1->query($q);
        $res = $result->fetchColumn();

        return $res;
    }

    public function checkRec($devRid, $cdata)
    {
        global $db;

        $q = "SELECT `rid` FROM `".DB1_TABLE_PREFIX.self::RES."` WHERE `dev_rid`='$devRid' AND `cdata`='$cdata' ";//  LIMIT 1

        $result = $db->db1->query($q);
        $res = $result->rowCount();

        return $res;
    }

    // --- insert
    public function doDo($devrid, $cdata, $tmpOp, $tmpOtp)
    {
        global $db;

        $expOtp   = OTP_CHK_LIFE;
        $tmpSt    = MAX_DEV_OTP_TRY;

        $ts = time();
        $exp = $ts + $expOtp;

        $ctype = 'e';

        //if ( $this->countDev($devrid) ) {
        $this->remPri($devrid);
        //}

        $dadata = array('dev_rid' => $devrid, 'cdata' => $cdata, 'ctype' => $ctype, 'otp' => $tmpOtp, 'op' => $tmpOp, 'status' => $tmpSt, 'ts' => $ts, 'exp' => $exp);
        $tmp_query = $db->db1->prepare('INSERT INTO `'.DB1_TABLE_PREFIX.self::RES.'` (`dev_rid`,`cdata`,`ctype`,`otp`,`op`,`status`,`ts`,`exp`) VALUES (:dev_rid, :cdata, :ctype, :otp, :op, :status, :ts, :exp)');

        $res = $tmp_query->execute($dadata);
        // echo $res." - OTP Insert Ok ";
    }

    // --- update
    private function remPri($devRid)
    {
        global $db;

        $tm = time();

        $q = "UPDATE `".DB1_TABLE_PREFIX.self::RES."` SET `prm`=0,`ts`='$tm' WHERE `dev_rid`='$devRid' ";
        $res = $db->db1->query($q);

        return $res;
    }

    public function setPri($devRid, $cdata)
    {
        global $db;

        $tm = time();

        $this->remPri($devRid);

        $q = "UPDATE `".DB1_TABLE_PREFIX.self::RES."` SET `prm`=1,`ts`='$tm' WHERE `dev_rid`='$devRid' AND `cdata`='$cdata' ";
        $res = $db->db1->query($q);

        return $res;
    }


    public function regTry($devRid)
    {
        global $db;

        $tm = time();

        $q = "UPDATE `".DB1_TABLE_PREFIX.self::RES."` SET `status`=`status`-1,`ts`='$tm' WHERE `dev_rid`='$devRid' AND `prm`='1'";
        $res = $db->db1->query($q);

        return $res;
    }

    // --- delete
    public function killDev($devRid)
    {
        global $db;

        $tm = time();

        $q = "DELETE FROM `".DB1_TABLE_PREFIX.self::RES."` WHERE `dev_rid` = $devRid ";
        $res = $db->db1->query($q);

        return $res;
    }
    // --- cleanup

    public function clearMax()
    {
        global $db;

        $tm = time();

        $q = "DELETE FROM `".DB1_TABLE_PREFIX.self::RES."` WHERE `status` < 1 ";
        $res = $db->db1->query($q);

        return $res;
    }

    public function clearExp()
    {
        global $db;

        $tm = time();

        $q = "DELETE FROM `".DB1_TABLE_PREFIX.self::RES."` WHERE `exp` < $tm ";
        $res = $db->db1->query($q);

        return $res;
    }

    // ---
    public function genNew()
    {
        $z = 10000;
        do {
            $i = rand(10101010, 98989898); // !!! length config
            if ($z < 1) {
                $i = 0;
                break;
            }
            --$z;
        } while ($this->isOtp($i) > 0);
        return $i;
    }
    public function isOtp($tmpOtp)
    {
        global $db, $smrecb;
        $res = $smrecb->getRec($db->db1, DB1_TABLE_PREFIX.self::RES, 'rid', 'otp', $tmpOtp, false, 1);
        return $res;
    }
}

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

class Activity
{
    /**
     * constructor;
     */
    public function __construct()
    {
    }

    /*
    add( $option, $value = , $autoload = 'yes' );
    delete( $option );
    get( $option, $default = false );
    update( $option, $newvalue );
    getAll();
    */

    /**
     * Fetch a
     *
     * @return
     */
    public function get($uid)
    {
        global $db;
        $out = null;
        $sql = "SELECT * FROM `".DB1_TABLE_PREFIX."activity` WHERE `uid`='$uid' ORDER BY `time` DESC LIMIT 100 ";
        $st = $db->db1->prepare($sql);
        $st->execute();
        return $st->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Fetch a
     *
     * @return
     */
    public function getScroll($uid, $limit, $offset)
    {
        global $db;
        $out = null;
        $sql = "SELECT * FROM `".DB1_TABLE_PREFIX."activity` WHERE `uid`='$uid' ORDER BY `time` DESC LIMIT $limit OFFSET $offset"; // p=1 ?
        $st = $db->db1->prepare($sql);
        $st->execute();
        return $st->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function process($array)
    {
        global $db;

        foreach ($array as $row) {
            $row['ago'] = $this->timeAgo($row['time']);
            $res[] = $row;
        }

        return $res;
    }

    /**
     * Create an
     *
     * @return
     */
    public function add($uid, $aid, $value)
    {
        global $db, $state;
        $time = time();
        $data = $state->get();
        $q = "INSERT INTO `".DB1_TABLE_PREFIX."activity` (`uid`, `aid`, `value`, `data`, `status`, `time`) VALUES ('$uid', '$aid', '$value', '$data', '2', '$time') ";
        $res = $db->db1->query($q); // data ??
        return $res;
    }


    /**
     * Removes option by name.
     *
     * @return void
     */
    public function delete($key)
    {
        global $db;
        $q = "DELETE FROM `".DB1_TABLE_PREFIX."activity` WHERE `option_name`='$key' ";
        $res = $db->db1->query($q);
        return $res;
    }

    public function timeAgo($ptime)
    {
        global $local;

        $etime = time() - $ptime;

        if ($etime < 8) {
            return $local->translate('now');
        }

        $a = array( 365 * 24 * 60 * 60  =>  'year',
                     30 * 24 * 60 * 60  =>  'month',
                          24 * 60 * 60  =>  'day',
                               60 * 60  =>  'hour',
                                    60  =>  'minute',
                                     1  =>  'second'
                    );
        $a_plural = array( 'year'   => $local->translate('years'),
                           'month'  => $local->translate('months'),
                           'day'    => $local->translate('days'),
                           'hour'   => $local->translate('hours'),
                           'minute' => $local->translate('minutes'),
                           'second' => $local->translate('seconds')
                    );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' '.$local->translate('ago');
            }
        }
    }
}

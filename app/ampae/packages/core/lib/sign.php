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

class Sign
{
    public function __construct()
    {
    }

    public function in($devRid, $uid, $newExp = HALF_LIFE)
    {
        global $activity, $devices;
        $res = $devices->logIn($devRid, $uid, $newExp);
        if ($res) {
            $activity->add($uid, 0, 'login');
        }
        return $res;
    }

    public function out($tmpRid, $tmpUid = null)
    {
        global $activity, $devices;
        $activity->add($tmpUid, 0, 'logout');
        return $devices->logOut($tmpRid, $tmpUid);
    }
};

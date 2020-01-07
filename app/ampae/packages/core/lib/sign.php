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

class Sign
{
    /**
     * constructor; initialize autologin if set;.
     */
    public function __construct()
    {
        global $session, $cookies, $devices;
        if (!$session->get('state')) {
            // !!! check session if we need to check cookie, if value ==2 !!!

            if (!$session->isxSet('dcc')) {
                $session->set('dcc', 1);

                if (REMEMBER_ME) {
                    $tmpDevID = $cookies->get(CCID);
                    if ($tmpDevID!==null) {
                        $tmpUid = $devices->get($tmpDevID);
                        if ($tmpUid) {
                            $this->in($tmpUid);
                        }
                    }
                }
            }
        }
    }

    public function check($login, $pword)
    {
        global $activity, $session;
        $tmp = 1111; // !!!
        return $tmp;
    }

    public function do($login, $pword)
    {
        global $basic, $controller, $cookies, $devices, $db;
        $tmp = $this->check($login, $pword);
        if ($tmp) {
            $this->in($tmp);
            // !!! call rememberme
        }
    }

    public function in($uid)
    {
        global $basic, $controller, $activity, $session, $cookies, $devices, $state;
        $state->set($uid);

        // !!!move to rememberme !!!
        if (!$cookies->isxSet()) {
            $tmpDevID = $basic->uuid();
            $cookies->set(CCID, $tmpDevID, DEV_TTL, $controller->info['app_path']);
            $devices->set($tmpDevID, $uid);
        } else {
            // update cookie exp date !!!
        }


        //$activity->add($uid, 0, 'login');
    }

    public function out()
    {
        global $activity, $session, $cookies, $devices, $state;
        // $activity->add($uid, 0, 'logout');
        // kill cookies !!!
        // kill device !!!
        return $state->delete();
    }
}

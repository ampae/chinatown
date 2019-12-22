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

class Checklist
{
    //public $arr     = array();
    //public $va       = null;

    public function __construct()
    {
        global $controller, $model, $state;
        $tmpRedirect = null;

        if ($state->get()) {
            $tmpUid = $state->get();

            $tmpRedirect = $this->tz($tmpUid, $tmpRedirect);
            $tmpRedirect = $this->name($tmpUid, $tmpRedirect);

            if ($tmpRedirect) {
                $tmpPath = implode('/', $controller->argv);
                if ($tmpRedirect!=$tmpPath) {
                    $model->redirect = $model->appinfo['url'].$tmpRedirect;
                }
            }
        }
    }

    private function name($uid, $tmpRedirect)
    {
        global $model, $usr;

        if (strlen($usr->get($uid, 'name')) < MIN_USERNAME_LENGTH) {
            $tmpRedirect = 'settings/at';
        }
        return $tmpRedirect;
    }

    private function tz($uid, $tmpRedirect)
    {
        global $model, $usr;
        $tmpRedirect = null;

        if (!$usr->get($uid, 'tz')) {
            $tmpRedirect = 'settings';
        }
        return $tmpRedirect;
    }
}

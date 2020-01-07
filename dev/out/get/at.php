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

namespace Ampae\Get;

class At
{
    const VENDOR = 'ampae';

    public function __construct()
    {
    }

    public function index()
    {
    }

    public function search()
    {
    }

    public function status()
    {
        global $controller, $model, $usr, $view, $sign, $state, $office;

        $tmpUidReal = $controller->argv[2];

        $newSt = null;

        $tmpAccSt = $usr->checkUid($tmpUidReal, 1);

        $err = $office->rules($tmpUidReal);

        if ($err==0) {
            if ($tmpAccSt) {
                $newSt = 0;
            } else {
                $newSt = 1;
            }

            $usr->updSt($tmpUidReal, 'ind', $newSt);
        }

        $model->redirect = $model->appinfo['url'].'at/'.$tmpUidReal;
    }


    public function del()
    {
        global $controller, $model, $usr, $view, $sign, $state, $acl, $office, $appexch;

        // $err          = 0;
        $tmpRedirect  = $model->appinfo['url'].'at';

        $tmpUidReal   = $controller->argv[2];

        $err = $office->rules($tmpUidReal);

        // get Sub account status
        $tmpAccSt = $usr->checkUid($tmpUidReal, 1);

        // active accounts can not be deleted, deactivate account first
        if ($tmpAccSt) {
            $err+=1;
        }

        // can't DELETE yourself
        if ($state->getMe($tmpUidReal)) {
            $err+=1;
        }

        // all done, take an action!
        if ($err==0) {
            $appexch->usrPurge($tmpUidReal);
            $usr->purge($tmpUidReal);
        } else {
            $tmpRedirect.='/'.$tmpUidReal;
        }

        $model->redirect = $tmpRedirect;
    }
};

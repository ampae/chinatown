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

namespace Ampae\Post;

class Signin
{
    public function index()
    {
        global $model, $loger, $html5, $form, $local;
    }

    public function process()
    {
        // print_r($controller->request); // Array ( [email] => aaa@aaa [action] => sin [submit] => Sign In )

        global $controller, $model, $options, $alerts, $pdo, $db, $smreca, $smrecb, $devices, $usr, $logger, $sign, $state, $activity, $email;

        $tmpOp = 0;
        $tmpOk = null;
        $tmpAc = null;
        $tmpAcChk = null;
        $tmpUid = 0;
        $ct_tmp_usrarr = array();
        $tmpRedirect = $model->appinfo['url'].'signin';

        if (!empty($controller->request['email'])) {
            $tmpEmail = $controller->request['email'];
            $tmpKnown = $usr->is($tmpEmail);
            $tmpUid = $state->get();
            if (!$usr->checkUid($tmpUid)) {
                $tmpUid = 0;
            }

            if ($tmpKnown) {
                // signin or set as PRI if logged in !!! ($tmpUid) or do nothing if already PRI
                if ($tmpUid) {
                    $tmpOp = '3'; // setPRI
                } else {
                    $tmpUid = $usr->getUid($tmpEmail);
                    $tmpAccSt = $usr->checkUid($tmpUid, 1);
                    if ($tmpAccSt) {
                        $tmpOp = '2'; // signin
                        $tmpAcChk = true;
                    } else {
                        $tmpOp = '5'; // redir to profile
                    }
                }
            } else {
                // signup or add email to UID if logged in
                if ($tmpUid) {
                    $tmpOp = '4'; // add2UID
                } else {
                    $tmpOp = '1'; // signup
                    $tmpAcChk = true;
                }
            }
            if ($tmpAcChk) {
                $tmp_next = 'acc';
                $tmpRedirect = $model->appinfo['url'].$tmp_next;
                if (DEBUG_MODE) {
                  // get AC  ???
                    $tmpRedirect .= '?uid='.$tmpUid.'&ac='.$tmpAc;
                }
            }
        } else {
            // alerts !!!
        }

        $model->redirect = $tmpRedirect;
    }
}

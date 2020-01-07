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

class Signup
{
    public function index()
    {
        global $model, $loger, $html5, $form, $local;
    }

    public function process()
    {
        // print_r($controller->request); // Array ( [email] => aaa@aaa [action] => sin [submit] => Sign In )

        global $controller, $model, $options, $alerts, $pdo, $db, $smreca, $smrecb;
        global $session, $ac, $devices, $usr, $logger, $sign, $auth, $activity, $email;

        $tmpOk          = null;
        $tmpAc          = null;
        $tmpAcChk       = null;
        $tmpOp          = 0;
        $tmpUid         = 0;
        $ct_tmp_usrarr  = array();
        $tmpRedirect    = $model->appinfo['url'].'signup';

        if (!empty($controller->request['email'])) {
            $tmpEmail = $controller->request['email'];
            $session->set('tmp-eml', $tmpEmail);
            $tmpKnown = $usr->is($tmpEmail);
            $tmpUid = $auth->get();
            if (!$usr->checkUid($tmpUid)) {
                $tmpUid = 0;
            }

            if (!$tmpKnown) {
                if (!$tmpUid) {
                    $tmpOp        = '1'; // unknown, signup
                    $tmp_next     = 'acc'; // !!!
                    $tmpRedirect  = $model->appinfo['url'].$tmp_next;

                    // !!! get new AC
                    // !!! mail new AC to usr
                    //$session->set('tmp-op', $tmpOp);
/*
                    $tmpPrm = 0;
                    $dt = array(
                      'id' => '1111',
                      'key' => $tmpEmail,
                      'val' => '0000',
                      'prm' => $tmpPrm,
                      'prv' => '1',
                      'grp' => '1',
                      'st' => '1',
                      'ts' => time(),
                      'exp' => '0'
                    );
                    $smrecb->addRec($db->db1, DB1_TABLE_PREFIX.'ac', $dt);
*/
                    if (DEBUG_MODE) {
                        // count users !!! if more than 20 don't do it !!!
                        $tmpAc = $ac->get($tmpUid, $tmpEmail); // !!! !!!
                        $tmpRedirect .= '?uid='.$tmpUid.'$op='.$tmpOp.'&ac='.$tmpAc;
                    }
                }
            }
            //$session->set('tmp-uid', $tmpUid);
            //$session->set('tmp-op', $tmpOp);
        } else {
            // alerts !!!
        }

        $model->redirect = $tmpRedirect;
    }
}

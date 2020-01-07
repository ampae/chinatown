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

class Acc
{
    public function index()
    {
        global $model, $loger, $html5, $form, $local;
    }

    public function cac()
    {
        global $controller, $model, $session, $options, $alerts, $pdo, $db, $smreca, $smrecb;
        global $ac, $devices, $usr, $logger, $sign, $auth, $activity, $email;

        $tmpOk          = null;
        $tmpAc          = null;
        $tmpAcChk       = null;
        $tmpOp          = 0;
        $tmpUid         = 0;
        $ct_tmp_usrarr  = array();
        $tmpRedirect    = $model->appinfo['url'].'signin';

        if (!empty($controller->request['ac'])) {
            $tmpAc = $controller->request['ac'];

            $tmpUid     = $session->getOnce('tmp-uid');
            $tmpEmail   = $session->getOnce('tmp-eml');
            $tmpRelAc   = $ac->get($tmpUid, $tmpEmail);

            if ($tmpAc == $tmpRelAc) {
                $sign->in($tmpUid);
                $tmpRedirect = $model->appinfo['url'];
            }
        }
        $model->redirect = $tmpRedirect;
    }
}

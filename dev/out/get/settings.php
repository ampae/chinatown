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

namespace Ampae\Get;

class Settings
{
    const VENDOR = 'ampae';

    public function __construct()
    {
        global $model, $theme, $sign, $auth, $view;

        if (!$auth->get()) {
            $model->redirect = $model->appinfo['url'].'login';
        }
    }

    public function index()
    {
    }

    public function at()
    {
        global $model, $theme, $view, $sign, $auth, $html;

        $val4 = $model->appinfo['url'].DIR_APP.'/'.self::VENDOR.'/packages/core/view/js/imgupnew.js';
        $html->addScript('HEAD', $val4);
    }

    public function confirm()
    {
        global $controller,$model,$usr,$devices,$email,$auth;

        $tmpOtpChk = false;
        $tmpOp = 6; // confirm added email
        $tmpRid = $devices->get();
        if (isset($controller->params['email'])) {
            $tmpEmail = $controller->params['email'];
        }
        $tmpUid = $auth->get();


        if ($usr->countKeys('email', $tmpUid, false) < MAX_EMAIL_UID) {
          /*
            $tmpOtp = $otp->genNew();
            if ($tmpOtp) {
                $email->otp('User', $tmpEmail, $tmpOtp); // email confirmation
                $otp->doDo($tmpRid, $tmpEmail, $tmpOp, $tmpOtp);
                $tmpOtpChk = true;

            }
            */
        } else {
            // echo 'NOOP 2'; // limit reached !!!
        }

        if ($tmpOtpChk) {
            $tmp_next = 'otp';
            $tmpRedirect = $tmp_next;
            if (DEBUG_MODE) {
                $tmpRedirect .= '?uid='.$tmpUid.'&otp='.$tmpOtp;
            }
        }

        $model->redirect = $model->appinfo['url'].'otp';
    }

    public function emailprim()
    {
        global $controller,$model,$usr,$devices,$auth;

        if (isset($controller->params['email'])) {
            $tmpEmail = $controller->params['email'];
        }
        $tmpUid = $auth->get();


        $usr->setPri($tmpUid, 'email', $tmpEmail);

        $model->redirect = $model->appinfo['url'].'settings/email';
    }

    public function emaildel()
    {
        global $controller,$model,$usr,$devices,$auth;

        if (isset($controller->params['email'])) {
            $tmpEmail = $controller->params['email'];
        }

        $tmpUid = $auth->get();

        $usr->delRec($tmpUid, 'email', $tmpEmail);

        $model->redirect = $model->appinfo['url'].'settings/email';
    }
};

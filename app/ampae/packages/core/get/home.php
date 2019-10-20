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

namespace Ampae\Get;

class Home
{
    public function __construct()
    {
        global $model,$state,$alerts,$local,$view,$theme,$html;

        if (!$state->get()) {
            $val3 = $model->appinfo['url'].$model->appinfo['theme_webpath'].'/css/sign.css'; // ???
            $html->addStyle($val3);
        }
    }

        // app logic route root content
        public function default()
        {
            global $controller,$alerts,$local,$view,$model,$usr,$alerts,$local,$avatar,$theme;
            $tmpFirst = null;
            if ($controller->argc > 0) {
                $tmpAt = $controller->argv[0];

                $tmpAccSt = null;
                $err = 1;
                $tmpEmailPrm = null;

                $tmpUid = $usr->getUid($tmpAt, 'name');

                $tmpAccExists = $usr->get($tmpUid, 'ind');

                if ($tmpAccExists) {
                    $err=0;
                }

                // add more checks for homepage for your app

                if ($err) {
                    //$model->redirect = '40404';
                }
            }
        }
}

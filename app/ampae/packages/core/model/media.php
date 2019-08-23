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

namespace Ampae\Model;

class Media
{
    const VENDOR = 'ampae';

    public function __construct()
    {
        global $model, $theme, $view, $sign, $auth;

        $val2 = $model->appinfo['url'].DIR_APP.'/'.self::VENDOR.'/packages/core/view/js/validate-custom.js';
        $view->addScript('HEAD', $val2);

        $val4 = $model->appinfo['url'].DIR_APP.'/'.self::VENDOR.'/packages/core/view/js/imgup.js';
        $view->addScript('HEAD', $val4);

        if (!$auth->is()) {
            $model->redirect = $model->appinfo['url'].'login';
        }
    }

    public function main()
    {
    }
};
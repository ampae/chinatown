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

namespace Ampae\Request;

class Options
{
    const VENDOR = 'ampae';

    public function __construct()
    {
        global $model, $theme, $view, $sign, $auth, $office,$html;

        $val2 = $model->appinfo['url'].DIR_APP.'/'.self::VENDOR.'/packages/core/view/js/validate-custom.js';
        $html->addScript('HEAD', $val2);

        if (!$auth->get()) {
            $model->redirect = $model->appinfo['url'].'login';
        }

        if (!$office->can()) {
            $model->redirect = $model->appinfo['url'];
        }
    }

    public function main()
    {
    }
};

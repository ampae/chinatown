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

namespace Ampae\Event;

class Login
{
    const VENDOR = 'ampae';
    const PACKAGE = 'core';

    public function index()
    {
      global $model, $theme, $view, $sign, $state, $office,$html;

      // if (!$state->get()) {
        $val3 = $model->appinfo['url'].$model->appinfo['theme_webpath'].'/css/sign.css'; // ???
        $html->addStyle($val3);
      // }

      $tmpLibJsPath = $model->appinfo['url'].DIR_APP.'/'.self::VENDOR.'/packages/'.self::PACKAGE.'/lib/js/';

      $val2 = $tmpLibJsPath . 'validate-custom.js';
      $html->addScript('HEAD', $val2);

    }
};
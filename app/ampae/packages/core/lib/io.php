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

namespace Ampae\Lib;

class Io
{

    public function __construct()
    {
        //global $controller;
    }

    public function load($file)
    {
        global $session, $sign, $controller, $model,$html,$html5,$render, $view, $local, $theme;
        $ret = false;
        $tmpPage = realpath(ABSPATH.$file);
        if (file_exists($tmpPage)) {
            include $tmpPage;
            $ret = true;
        }
        return $ret;
    }

    // TODO check functions !!!
    public function loadRaw($file)
    {
        global $session, $sign, $controller, $model, $view, $local, $theme;
        $ret = false;
        $tmpPage = realpath(ABSPATH.$file);
        if (file_exists($tmpPage)) {
            $ret = file_get_contents($tmpPage);
        }
        return $ret;
    }
}

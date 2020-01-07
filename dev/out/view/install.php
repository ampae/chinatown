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

namespace Ampae\View;

class Install
{
    /**
     * constructor;
     */
    public function __construct()
    {
        global $alerts,$local,$view,$theme,$render,$render;
        $theme->open();
        //echo '<BR><BR>';
        $theme->displayAlerts();
    }

    public function __destruct()
    {
        global $alerts,$local,$view,$theme,$render;
        $theme->close();
    }

    public function index()
    {
        global $alerts,$local,$view,$theme,$render;
        $theme->setUp();
        //$this->content();
        echo '<BR /><BR /><BR />';
        //echo '<br /><p class="text-center"><a class="align-center" rel="nofollow" href="./">'.$local->translate('home').' </a> | <a class="align-center" rel="nofollow" href="signup">'.$local->translate('signup').' </a> | <a class="align-center" rel="nofollow" href="signreq"><small>'.$local->translate('req_pass').'</small> </a></p>';
    }
};

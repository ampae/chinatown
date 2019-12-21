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

namespace Ampae\Rest;

class Home
{
    public function index()
    {
        global $model,$loger;
        //$model->setContentExt('');
        $tmp = $model->getRawPath('signin');
        $model->setExtContent($tmp);
        $model->setContent($tmp.'<h2>Yea!</h2>[[shortcode.test lname=bedouin fname=bulbul mname=10]]');
        //$model->redirect = $model->appinfo['url'].'login';
      //echo $this->vendor(__CLASS__);
    }
};

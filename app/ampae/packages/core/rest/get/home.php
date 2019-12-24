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
    public function index()
    {
        global $model,$loger, $html5, $local;
        //$model->setContentExt('');
        //$tmp = $model->getRaw('signin');
        //$model->addExtContent($tmp);
        //$model->add('html-main', $tmp.' <h2>Yea!</h2>[[shortcode.test lname=bedouin fname=bulbul mname=10]]');

        $model->add('html-main', '[[htmlrender.logIn]]');

        //$model->add('html-main', $html5->article('a1', null, 'https://placeimg.com/640/480/any'));
        //$model->add('html-main', $html5->article('a2', null, 'https://placeimg.com/640/480/any'));

        //$model->redirect = $model->appinfo['url'].'login';
      //echo $this->vendor(__CLASS__);
    }
};

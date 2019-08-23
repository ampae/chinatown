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

 namespace Ampae\View;

class Acc
{
    const VENDOR = 'ampae';

    /**
     * constructor;
     */
    public function __construct()
    {
        global $model,$auth,$alerts,$local,$view,$theme;
        //if (!$auth->is()) {

        $val2 = $model->appinfo['url'].DIR_APP.'/'.self::VENDOR.'/packages/core/view/js/validate-custom.js';
        $view->addScript('HEAD', $val2);

        $val3 = $model->appinfo['url'].$model->appinfo['theme_webpath'].'/css/sign.css';
        $view->addStyle($val3);
        //}
        $view->open();
        echo '<BR><BR>';
        //$theme->displayAlerts();
    }

    public function __destruct()
    {
        global $alerts,$local,$view,$theme;
        $view->close();
    }

    public function index()
    {
        global $model, $controller, $nonce, $sign, $auth, $html, $alerts, $local, $view, $theme; ?>
       <div class="container">
         <div class="row">
           <div class="col offset4 span4">
       <?php

       $tmpThisPage = 'acc';
        $tmpNonce = '';
        if ($nonce) {
            $tmpNonce = '?nonce='.$nonce->gen();
        }

        echo $html->formOpen(
           $model->appinfo['url'].'acc/process'.$tmpNonce,
           'POST',
           $tmpThisPage.'-form',
           'co-form',
           '',
           '',
           ''
               );
        echo '<legend><strong>'.$local->translate($tmpThisPage).'</strong></legend>';

        echo $html->formField('text', 'ac', 'form-control', 'fa fa-envelope-o', $local->translate('ac'), '', 'autocomplete="off"');

        echo $html->formFieldHidden('action', $tmpThisPage);

        //echo $html->formFieldHidden('uid', $controller->params['uid']);

        echo $html->formClose(
           $local->translate('login'),
           'btn btn-primary btn-lg btn-block'
       ); ?>
       <br />
                 <center>
                 <small>
                 <a rel="nofollow" href="./"><?php echo $local->translate('home'); ?> </a> |
                 <a rel="nofollow" href="./signin"><?php echo $local->translate('login'); ?> </a>
                 </small>
                 </center>
           </div>
         </div>
       </div>
       <?php
    }
};

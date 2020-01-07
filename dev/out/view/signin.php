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

class Signin
{
    const VENDOR = 'ampae';

    /**
     * constructor;
     */
    public function __construct()
    {
        global $model,$state,$alerts,$local,$view,$theme,$html,$render;

        $model->getTheme();

        if (!$state->get()) {
            $val3 = $model->appinfo['url'].$model->appinfo['theme_webpath'].'/css/sign.css';
            $html->addStyle($val3);
        }
        $theme->open();
        echo '<BR><BR>';
        //$theme->displayAlerts();
    }

    public function __destruct()
    {
        global $alerts,$local,$view,$theme,$render;
        $theme->close();
    }

    public function index()
    {
        global $model, $controller, $nonce, $sign, $state, $html, $alerts, $local, $view, $theme, $render, $options; ?>
       <div class="container">

         <div class="row">
           <div class="col offset4 span4">
             <?php
             if (!$options->get('signup')) {
                 $theme->alert('Y', 'signup', $local->translate('signup_unavailable'));
             } ?>
       <?php

       $tmpThisPage = 'login';
        $tmpNonce = '';
        if ($nonce) {
            $tmpNonce = '?nonce='.$nonce->gen();
        }

        echo $html->formOpen(
            $model->appinfo['url'].'signin/process'.$tmpNonce,
            'POST',
            $tmpThisPage.'-form',
            'co-form',
            '',
            '',
            ''
               );
        echo '<legend><strong>'.$local->translate('login').'</strong></legend>';

        echo $html->formField('email', 'email', 'form-control', 'fa fa-envelope-o', $local->translate('email'), ''); // , 'autocomplete="off"'

        echo $html->formFieldHidden('action', $tmpThisPage);

        echo $html->formClose(
            $local->translate('signin'),
            'btn btn-primary btn-lg btn-block'
       ); ?>
       <br />
                 <center>
                 <small>
                 <a rel="nofollow" href="./"><?php echo $local->translate('home'); ?> </a>
                 </small>
                 </center>
           </div>
         </div>
       </div>
       <?php
    }
};

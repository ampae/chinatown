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

 namespace Ampae\View\Aside\Right;

 class Home
 {
     /**
      * constructor;
      */
     public function __construct()
     {
       global $model,$auth,$alerts,$local,$view,$theme;
       if ($auth->get()) {
         $theme->asideRightOpen();
       }
     }

     public function __destruct()
     {
       global $alerts,$local,$view,$theme,$auth;
       if ($auth->get()) {
         $theme->asideRightClose();
       }
     }

     public function index()
     {

       global $sign, $auth, $usr, $db, $html, $view, $local;

        if ( $auth->get() ) {

          $uid = $auth->get();

          echo "<BR />".$local->translate('hello')." ".$usr->get($uid, 'name')."<BR /><BR />";

          echo $html->h5('<i class="fa fa-user col-blue"></i> '.$local->translate('customer').' ID <span class="badge bg-default">'.$uid.'</span>');
          echo $html->h5('<i class="fa fa-globe col-blue"></i> '.$local->translate('timezone').' <span class="badge bg-default">'.$view->getTz($uid).'</span>');
          // echo '<h5><i class="fa fa-envelope col-blue"></i> EMAIL <span class="badge bg-default">'.$usr->get($uid, 'email').'</span></h5>';

        }

     }

};

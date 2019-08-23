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

 namespace Ampae\View\Aside\Right;

 class Settings
 {
     /**
      * constructor;
      */
      public function __construct()
      {
        global $model,$auth,$alerts,$local,$view,$theme;
        if ($auth->is()) {
          $theme->asideRightOpen();
        }
      }

      public function __destruct()
      {
        global $alerts,$local,$view,$theme,$auth;
        if ($auth->is()) {
          $theme->asideRightClose();
        }
      }

      public function default()
      {
        $this->getUser();

      }


     public function index()
     {
       $this->getUser();
     }


     private function getUser()
     {
       global $sign, $auth, $usr, $db, $html, $view, $local;
         //echo 'Home EVENTS GET Plugin Method MAIN (& default) >> ';
         if ( $auth->is() ) {
           $uid = $auth->is();
           echo "<BR />".$local->translate('hello')." ".$usr->get($uid, 'name')."<BR /><BR />";
           echo $html->h5('<i class="fa fa-user col-blue"></i> '.$local->translate('customer').' ID <span class="badge bg-default">'.$uid.'</span>');
           echo $html->h5('<i class="fa fa-globe col-blue"></i> '.$local->translate('timezone').' <span class="badge bg-default">'.$view->getTz($uid).'</span>');
                    }
     }

};

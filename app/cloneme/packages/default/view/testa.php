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

 namespace Cloneme\View;

 class Testa
 {

   /**
    * constructor;
    */
   public function __construct()
   {
     global $controller,$model,$sign,$state,$options,$alerts,$local,$view,$theme,$html,$usr,$db,$nonce,$email;

     $view->open();

     //echo '<BR><BR>';
     //$theme->displayAlerts();

   }

   public function index() {

      global $controller,$model,$sign,$state,$options,$alerts,$local,$view,$theme,$html,$usr,$db,$nonce,$email;

     echo $html->formOpen(
         $model->appinfo['url'].'testa/process',
         'POST',
         'account-form',
         'co-form',
         '',
         '',
         ''
     );

     echo $html->formText('opt_eee', 'pencil', 'eee', '3', 'value');

     echo $html->formClose('lalala', 'btn');
   }

   public function __destruct()
   {
     global $alerts,$local,$view,$theme;
     $view->close();
   }


};

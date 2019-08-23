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

namespace Ampae\Post;

class Acc
{

  function __construct()
  {
    global $logger, $session, $alerts, $controller, $view;
    $model->appinfo['page_type'] = 'com';
  }

  public function process()
  {
    global $controller, $model, $alerts, $pdo, $db, $smreca, $smrecb, $devices, $usr, $logger, $sign, $auth, $activity;

    $tmpOk = null;

    $tmpRedirect = $model->appinfo['url'].'acc';
//    $tmpRedirect .= '?uid='.$controller->post['uid'];
//    $tmpRedirect .= '&otp='.$controller->post['otp'];

    $ct_tmp_usrarr = array();

    if ( !empty($controller->post['ac']) ) {

      $tmpAc = $controller->post['ac'];

      // check AC

      // if correct login uid !!!

// print_r(  array_map('strtolower',explode('\\', __CLASS__))  );

echo $tmpAc;
exit;


      $tmpRedirect = $model->appinfo['url'];
    }
    $model->redirect = $tmpRedirect;
    //die();
  }


};

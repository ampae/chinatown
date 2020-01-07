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

namespace Ampae\Post;

class Acc
{

  const RES = 'ac';

  function __construct()
  {
    global $logger, $session, $alerts, $controller, $view;
    $model->appinfo['page_type'] = 'com';
  }

  public function process()
  {
    global $controller, $model, $alerts, $pdo, $db, $smreca, $smrecb, $devices, $usr, $logger, $sign, $state, $activity;

    $tmpOk = null;

    $tmpRedirect = $model->appinfo['url'].'acc';
//    $tmpRedirect .= '?uid='.$controller->request['uid'];
//    $tmpRedirect .= '&otp='.$controller->request['otp'];

    $ct_tmp_usrarr = array();

    if ( !empty($controller->request['ac']) ) {

      $tmpAc = $controller->request['ac'];

      // check AC

      // if correct login uid !!!

// print_r(  array_map('strtolower',explode('\\', __CLASS__))  );

// echo $tmpAc;

$res = null;
$adata = array(
'val' => $tmpAc,
'prm' => 1,
);
if ($db->db1) {
    $res = $smreca->select($db->db1, DB1_TABLE_PREFIX.self::RES, 'id', $adata); // 'key' => "'".$k."'",
}


if ($res) {
  $sign->in($res);
}

      $tmpRedirect = $model->appinfo['url'];
    }
    $model->redirect = $tmpRedirect;
    //die();
  }


};

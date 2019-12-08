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

class Options
{

  function __construct()
  {
    global $logger, $session, $alerts, $controller, $view, $office;
    $model->appinfo['page_type'] = 'com';

    if ( !$office->can() ) {
      exit;
    }

  }

  public function process()
  {
    global $controller, $state, $model, $session, $alerts, $pdo, $db, $usr, $logger, $sign, $local, $options;



//print_r($controller->request);
//exit;

foreach ($controller->request as $k => $v) {
    if (is_array($v)) {
        continue;
    }
    $rex = substr($k, 0, 4);
    if ($rex!='opt_') {
        continue;
    }
    $key = substr($k, 4);

//                        echo $key.' {} '.$v.'||';

    $options->update($key, $v);
}

      $tmpGroup = '';

      if (isset($controller->request['group'])) {
        $tmpGroup = '/'.$controller->request['group'];
      }

      $model->redirect = $model->appinfo['url'].'options'.$tmpGroup;
  }


};

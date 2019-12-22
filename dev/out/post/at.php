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

class At
{
    public function __construct()
    {
        global $logger, $session, $alerts, $controller, $model, $office, $view;
        $model->appinfo['page_type'] = 'com';

        if (!$office->can()) {
            $model->redirect = $model->appinfo['url'];
        }
    }

    public function add()
    {
        global $controller, $model, $session, $alerts, $pdo, $db, $usr, $logger, $sign, $state, $local;

        // !!! check for admin !!!
        $tmpRedirect = $model->appinfo['url'].'at/add';
        if (isset($controller->request['email']) && $controller->request['email']!='') {
            $usr->add($controller->request['name'], $controller->request['email']);
            $tmpRedirect = $model->appinfo['url'].'at';
        }
        $model->redirect = $tmpRedirect;
    }

    public function choff()
    {
        global $controller, $model, $activity, $session, $alerts, $pdo, $db, $usr, $logger, $sign, $state, $local, $office;

        //if (isset($controller->request['email']) && $controller->request['email']!='') {
        //$usr->add($controller->request['name'], $controller->request['email']);
        //print_r($controller->request);
        //exit;
        //}


        $level = $controller->request['level'];
        $uid = $controller->request['uid'];

        $err = $office->rules($uid);

        if ($err==0) {
            $ret = $office->set($uid, $level);
        }

        $aValue = 'new level '.$level; // translate

        $activity->add($uid, 0, $aValue);

        $tmpRedirect = $model->appinfo['url'].'at/'.$controller->request['uid'];
        $model->redirect = $tmpRedirect;
    }

    /*
      public function process()
      {
        global $controller, $model, $session, $alerts, $pdo, $db, $usr, $logger, $sign, $state, $local;
    
        $tmpOk = null;
    
        $ct_tmp_usrarr = array();
    
    // Array ( [country] => XX [city] => [address] => [pobox] =>
    // [tz] => US/Samoa [xuid] => 3812177858 [action] => address [submit] => update )
    
        if ( !empty($controller->request['xuid']) ) {
    
          $uid           = $controller->request['xuid'];
          $tmp_country    = $controller->request['country'];
          $tmp_city       = $controller->request['city'];
          $tmp_address    = $controller->request['address'];
          $tmp_po         = $controller->request['pobox'];
          $tmp_tz         = $controller->request['tz'];
    
          if (!empty($tmp_country) && $tmp_country!='XX') {
              $ct->usrUpdate($uid, 'country', $tmp_country);
          }
          $ct->usrUpdate($uid, 'city', $tmp_city);
          $ct->usrUpdate($uid, 'address', $tmp_address);
          $ct->usrUpdate($uid, 'pobox', $tmp_po);
          $ct->usrUpdate($uid, 'tz', $tmp_tz);
    
          $model->redirect = $model->appinfo['url'].'account';
    
                //$alerts->add('signup','user_exists');
                $model->redirect = $model->appinfo['url'].'account';
          } else {
    
              //$alerts->add('signup','email_mandatory');
              //$logger->info("User ".$controller->request['email']." attempt to SignUp, FAILED.");
    
              $model->redirect = $model->appinfo['url'].'account';
          }
    
        }
    */
};

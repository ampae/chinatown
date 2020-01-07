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

namespace Ampae\Get;

class Install
{
    /**
     * constructor; nothing here to constructs.
     */
    public function __construct()
    {
        global $db, $model, $view;
        if ($db->db1) {
            $model->redirect = $model->appinfo['url'].'welcome';
        }
    }

    public function index()
    {
      global $session, $alerts;

      $tmpReqWritableConf = array('db','cookies'); // config install !!!

      $i=0;
      foreach ($tmpReqWritableConf as $tmpReqWritableConfFile) {
        $tmpReqWritableConfFilePath = DIR_APP.DIRECTORY_SEPARATOR.DEF_VENDOR.DIRECTORY_SEPARATOR.DIR_PACKS.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.$tmpReqWritableConfFile.'.php';
        if (file_exists($tmpReqWritableConfFilePath)) {
          if (!is_writable($tmpReqWritableConfFilePath)) {
            $i++;
            $alerts->add('ERROR_'.$i,'File '.$tmpReqWritableConfFilePath.' is not writable!');
          }
        }
      }

      $this->callCookies();

    }

    private function callCookies()
    {
      // check if install is permitted

      // 1. check if file exist and is_writeable
      // check if all already defined
      // if defined == default go ahead !!!
    }

    private function callDb()
    {
      // check if install is permitted

      // 1. check if file exist and is_writeable
      // check if can connect
    }

    private function callAdmin()
    {
      // check if install is permitted
      // 1. check if db has at least 1 admin, if not go ahead!!!
    }
}

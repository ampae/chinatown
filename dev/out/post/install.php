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
 * @license    https://ampae.com/chinatown/license.txt
 * @copyright  2009 - 2020 AMPAE
**/

namespace Ampae\Post;

class Install
{
    const VENDOR = 'ampae';

    public function __construct()
    {
        global $model;
        //$model->appinfo['page_type'] = 'com';
    }

    public function process()
    {
        global $tmpGlobalConfig, $controller, $model, $session, $usr, $office, $alerts, $logger;

        // $this->callCookies()
        // $this->callDb()
        // $this->callAdmin()

        $tmpOk = null;
        $tmpRedr = 'install';

        $tmp_db_host = $controller->request['dbhost'];
        $tmp_db_name = $controller->request['dbname'];
        $tmp_db_user = $controller->request['dbuser'];
        $tmp_db_pwrd = $controller->request['dbpass'];
        $tmp_db_pref = $controller->request['dbprefix'];
        $tmp_db_chrs = 'utf8mb4';

        try {
            $tmpDb = new \PDO('mysql:host='.$tmp_db_host.';dbname='.$tmp_db_name.';charset='.$tmp_db_chrs, $tmp_db_user, $tmp_db_pwrd);
            $tmpDb->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $tmpDb->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $tmpOk = true;
        } catch (\PDOException $Exception) {
            $tmpOk = false;
            switch ($Exception->getCode()) {
                 case 2005:
                  $alerts->add('setup', 'MODEL / PDO DB ERROR 2005: Unknown HOST - '.$tmp_db_host);
                   //echo ('MODEL / PDO DB ERROR 2005: Unknown HOST - '.$tmp_db_host);
                 break;
                 case 2003:
                   $alerts->add('setup', 'MODEL / PDO DB ERROR 2003: Unknown HOST - '.$tmp_db_host);
                   //echo ('MODEL / PDO DB ERROR 2003: Can Not Connect to the HOST - '.$tmp_db_host);
                 break;
                 case 1049:
                   $alerts->add('setup', 'MODEL / PDO DB ERROR 1049: DATABASE - '.$tmp_db_name.' does not exist on HOST - '.$tmp_db_host);
                   //echo ('MODEL / PDO DB ERROR 1049: DATABASE - '.$tmp_db_name.' does not exist on HOST - '.$tmp_db_host);
                 break;
                 case 1045:
                  $alerts->add('setup', 'MODEL / PDO DB ERROR 1045: AUTH USER - '.$tmp_db_user.' PASSWORD - '.$tmp_db_pwrd);
                   //echo ('MODEL / PDO DB ERROR 1045: AUTH USER - '.$tmp_db_user.' PASSWORD - '.$tmp_db_pwrd);
                 break;
                 default:
                  $alerts->add('setup', 'MODEL / PDO DB ERROR: UNKNOWN');
                   //echo ('MODEL / PDO DB ERROR: UNKNOWN');
                 break;
            }
        }

        if ($tmpOk) {
            $sql = '';

foreach ($tmpGlobalConfig['packages'] as $tmpVendor => $tmpPack) {
  foreach ($tmpPack as $tmpPackItem) {
    $tmpVendorPath = DIR_APP.DIRECTORY_SEPARATOR.$tmpVendor.DIRECTORY_SEPARATOR;
    $tmpInstallPath = $tmpVendorPath.DIR_PACKS.DIRECTORY_SEPARATOR.$tmpPackItem.DIRECTORY_SEPARATOR.'install'.DIRECTORY_SEPARATOR;

    $tmpAutoDiscoveredSqls = array_map( 'basename', glob($tmpInstallPath.'*.sql' , GLOB_BRACE) );

    foreach ($tmpAutoDiscoveredSqls as $tmpAutoDiscoveredSqlFile) {
      $tmpSqlToInstall = $tmpInstallPath.$tmpAutoDiscoveredSqlFile;
      if (file_exists($tmpSqlToInstall)) {
          $sql .= file_get_contents($tmpSqlToInstall);
      }
    }
  }
}

            $sql = str_replace("___", $tmp_db_pref, $sql);

            if (!empty($sql)) {
              try {
                $tmpDb->exec($sql);
              } catch (PDOException $e) {
                echo $e->getMessage();
                die();
              }
            }

            $aValid = array('_','-');
            $err_uname = 0;
            $tmp_sup_ul = 16;
            $t = time();

            $tmpReqWritableConf = array('db','cookies'); // config install !!!

            $tmpReqWritableConfData['db']['define'] = array(
            'DB1_CHARSET' => $tmp_db_chrs,

            'DB1_HOST' => $tmp_db_host,
            'DB1_USER' => $tmp_db_user,
            'DB1_PASSWORD' => $tmp_db_pwrd,
            'DB1_NAME' => $tmp_db_name,
            'DB1_TABLE_PREFIX' => $tmp_db_pref,
            );

            $tmpReqWritableConfData['cookies']['define'] = array(
            'CCID' => APP_COOKIE_PREFIX.'9a3f'.rand(12121212, 89898989),
            );

            foreach ($tmpReqWritableConf as $tmpReqWritableConfFile) {
              $tmpReqWritableConfFilePath = DIR_APP.DIRECTORY_SEPARATOR.DEF_VENDOR.DIRECTORY_SEPARATOR.DIR_PACKS.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.$tmpReqWritableConfFile.'.php';
              //if (file_exists($tmpReqWritableConfFilePath)) {
                //if (is_writable($tmpReqWritableConfFilePath)) {

                  createConfig($tmpReqWritableConfFilePath, $tmpReqWritableConfData[$tmpReqWritableConfFile]);

                //}
              //}
            }


            if (!empty($controller->request['email'])) {

                //$tmp_uname = $controller->request['uname'];
                $tmp_email = $controller->request['email'];
                //$tmp_opass = $controller->request['pword'];

                $tmpUid = $this->addAdmin($tmpDb, $tmp_db_pref, 'usr', 'Admin', $tmp_email);

                $tmpAc = rand(11111111,99999999);

                // !!! add AC to the table !!!

                if ($tmpUid) {
                    $this->addOffice($tmpDb, $tmp_db_pref, 'office', $tmpUid, $tmp_sup_ul); // !!! use class !!!
                    $this->addAc($tmpDb, $tmp_db_pref, 'ac', $tmpUid, $tmp_email, $tmpAc); // !!! use class !!!

                    $tmpRedr = 'welcome/AccessCode='.$tmpAc;
                }
                // $model->redirect = '111';

            } else {
              $alerts->add('setup_admin','ERROR: No Admin eMail Specified');
            }
        }
        $model->redirect = $model->appinfo['url'].$tmpRedr;
    }

    private function addOffice($tmpDb, $tmp_db_pref, $tbl, $uid, $level)
    {
        $ts = time();
        $exp = $ts + 946080000; // !!! config
        $dadata = array('gl' => 1, 'uid' => $uid, 'crud' => $level, 'st' => 1, 'ts' => $ts, 'exp' => $exp); // ts, exp !!!
        $tmpPrep = "INSERT INTO `".$tmp_db_pref.$tbl."` (`gl`,`uid`,`crud`,`st`,`ts`,`exp`) VALUES (:gl, :uid, :crud, :st, :ts, :exp)";
        $tmp_query = $tmpDb->prepare($tmpPrep);
        $res = $tmp_query->execute($dadata);
        return $res;
    }

    private function addAc($tmpDb, $tmp_db_pref, $tbl, $uid, $email, $ac)
    {
        global $smreca;

        //$ts = time();
        //$exp = $ts + 96000; // !!! config

        $adata = array(
          'id' => $uid,
          'key' => $email,
          'val' => $ac,
          'prv' => '0',
          'grp' => '1',
          'st' => '1'
        );
        return $smreca->insert($tmpDb, $tmp_db_pref.$tbl, $adata); // !!! add expiration !!!

        /*
        $dadata = array('ac' => $ac, 'uid' => $uid, 'val' => $val, 'st' => 6, 'ts' => $ts, 'exp' => $exp); // ts, exp !!!
        $tmpPrep = "INSERT INTO `".$tmp_db_pref.$tbl."` (`ac`,`uid`,`val`,`st`,`ts`,`exp`) VALUES (:ac, :uid, :val, :st, :ts, :exp)";
        $tmp_query = $tmpDb->prepare($tmpPrep);
        $res = $tmp_query->execute($dadata);
        return $res;
        */

    }




    private function addAdmin($tmpDb, $tmp_db_pref, $tbl, $name, $email)
    {
        global $smreca, $usr;

        $i = false;

        $adata = array('key' => 'ind');
        $tmpUsrs = $smreca->count($tmpDb, $tmp_db_pref.$tbl, $adata);

        if ($tmpUsrs<1) {
            $i = $smreca->addInd($tmpDb, $tmp_db_pref.$tbl);
        }

        if ($i) {
            $adata = array(
              'id' => $i,
              'key' => 'email',
              'val' => $email,
              'prv' => '0',
              'grp' => '1',
              'st' => '1'
            );
            $smreca->insert($tmpDb, $tmp_db_pref.$tbl, $adata);

            $adata = array(
              'id' => $i,
              'key' => 'name',
              'val' => $name,
              'prv' => '0',
              'grp' => '1',
              'st' => '1'
            );
            $smreca->insert($tmpDb, $tmp_db_pref.$tbl, $adata);

            $adata = array(
              'id' => $i,
              'key' => 'since',
              'val' => date('F Y', time()),
              'grp' => '1',
              'st' => '1'
            );
            $smreca->insert($tmpDb, $tmp_db_pref.$tbl, $adata);
        }
        return $i;
    }

    private function etc()
    {

// --- Setup Admin -------------------------------------------------------------


//$model->redirect = $model->appinfo['url'];
    }
};

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

        $tmpOk = null;

        $tmp_db_host = $controller->post['dbhost'];
        $tmp_db_name = $controller->post['dbname'];
        $tmp_db_user = $controller->post['dbuser'];
        $tmp_db_pwrd = $controller->post['dbpass'];
        $tmp_db_pref = $controller->post['dbprefix'];
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

            //foreach ($tmpGlobalConfig[DIR_APP] as $tmpVendor => $tmpClasses) {
            foreach ($tmpGlobalConfig['vendor'] as $tmpVendor) {
                $tmpSql = DIR_APP.DIRECTORY_SEPARATOR.$tmpVendor.DIRECTORY_SEPARATOR.'install'.DIRECTORY_SEPARATOR.'install'.'.sql';

                if (file_exists($tmpSql)) {
                    $sql .= file_get_contents($tmpSql);
                }
            }

            $sql = str_replace("___", $tmp_db_pref, $sql);

            try {
                $tmpDb->exec($sql);
            } catch (PDOException $e) {
                echo $e->getMessage();
                die();
            }

            // $this->createAutoConfig();

            //$xdata->redirect = '';
            $aValid = array('_','-');
            $err_uname = 0;
            $tmp_sup_ul = 32;
            $t = time();

            $bbb = array(
            'DB1_CHARSET' => $tmp_db_chrs,

            'DB1_HOST' => $tmp_db_host,
            'DB1_USER' => $tmp_db_user,
            'DB1_PASSWORD' => $tmp_db_pwrd,
            'DB1_NAME' => $tmp_db_name,
            'DB1_TABLE_PREFIX' => $tmp_db_pref,
            );

            $ccc = array(
            'CCID' => APP_COOKIE_PREFIX.'9a3f'.rand(12121212, 89898989),
            );

            $cococo = '<?php';
            $cococo .= "\n";

            $cococo .= "/** Auto-generated base configuration */\n";

            foreach ($bbb as $ccc => $ddd) {
                $cococo .= "define('$ccc', '$ddd');\n";
            }

//            $cococo .= "";
//            $cococo .= "\n";

            $tmpConfig = ABSPATH.DIR_CONFIG.DIRECTORY_SEPARATOR.'config-auto.php';

            if (is_writable(ABSPATH.DIR_CONFIG)) {
                $res = file_put_contents($tmpConfig, $cococo);
            } else {
                //echo 'Config File can not be written, make it writable or..'; // !!!
                //die();
                $alerts->add('setup', 'CONFIG FILE / DIRECTORY IS NOT WRITABLE');
            }

            

            if (!empty($controller->post['email'])) {

                //$tmp_uname = $controller->post['uname'];
                $tmp_email = $controller->post['email'];
                //$tmp_opass = $controller->post['pword'];

                $tmpUid = $this->addAdmin($tmpDb, $tmp_db_pref, 'usr', 'Admin', $tmp_email);

                if ($tmpUid) {
                    $this->addOffice($tmpDb, $tmp_db_pref, 'office', $tmpUid, $tmp_sup_ul);
                }
                // $model->redirect = '111';
            } else {

// $alerts->add('setup2','ERROR: UNKNOWN'); // !!!
// $model->redirect = 'x';
            }
        }
    }
/*
    private function addOffice($tmpDb, $tmp_db_pref, $tbl, $uid, $level)
    {
        $ts = time();
        $exp = $ts + 946080000;
        $dadata = array('uid' => $uid, 'level' => $level, 'st' => 1, 'ts' => $ts, 'exp' => $exp); // ts, exp !!!
        $tmpPrep = "INSERT INTO `".$tmp_db_pref.$tbl."` (`uid`,`level`,`st`,`ts`,`exp`) VALUES (:uid, :level, :st, :ts, :exp)";
        $tmp_query = $tmpDb->prepare($tmpPrep);
        $res = $tmp_query->execute($dadata);
        return $res;
    }
*/

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

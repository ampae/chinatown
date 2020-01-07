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

namespace Ampae\Lib;

class Db
{
    public $db1;
    public $db2;

    /**
     * constructor.
     */
    public function __construct()
    {
        global $controller, $logger, $model, $session;

        if (!$this->db1) {
            $this->dbcon();
        }

    }

    private function dbcon()
    {
        global $pdo, $tmpGlobalConfig;

        $tmpGlobalConfig['db'] = array(
          'dbhost' => DB1_HOST,
          'dbname' => DB1_NAME,
          'dbuser' => DB1_USER,
          'dbpass' => DB1_PASSWORD,
          'dbprefix' => DB1_TABLE_PREFIX,
          'dbcs' => DB1_CHARSET,
        );

        $tmp_db1_host = DB1_HOST;
        $tmp_db1_name = DB1_NAME;
        $tmp_db1_user = DB1_USER;
        $tmp_db1_pwrd = DB1_PASSWORD;
        $tmp_db1_chrs = DB1_CHARSET;

        $this->db1 = $pdo->connect($tmp_db1_host, $tmp_db1_name, $tmp_db1_user, $tmp_db1_pwrd, $tmp_db1_chrs);
    }
    /*
        public function dbset()
        {
            $result = null;

            $tmp_db1_host = DB1_HOST;
            $tmp_db1_name = DB1_NAME;
            $tmp_db1_user = DB1_USER;
            $tmp_db1_pwrd = DB1_PASSWORD;
            $tmp_db1_chrs = DB1_CHARSET;

            try {
                $tmpDb = new \PDO('mysql:host='.$tmp_db1_host, $tmp_db1_user, $tmp_db1_pwrd);
                $tmpDb->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                //$tmp_db1_name = "`".str_replace("`","``",$tmp_db1_name)."`";

                $tmpDb->query("CREATE DATABASE IF NOT EXISTS $tmp_db1_name CHARACTER SET $tmp_db1_chrs"); // COLLATE utf8mb4_unicode_ci;
                //$tmpDb->query("USE $tmp_db1_name");
            } catch (\PDOException $Exception) {
                $result = $Exception->getCode();
            }
            return $result;
        }
    */
};

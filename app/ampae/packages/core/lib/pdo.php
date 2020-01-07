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

namespace Ampae\Lib;

class Pdo
{
    private $dbh = null;

    /**
     * constructor.
     */
    public function __construct()
    {
    }

    public function connect($tmp_db_host, $tmp_db_name, $tmp_db_user, $tmp_db_pwrd, $tmp_db_chrs)
    {
        global $logger;

        try {
            $this->dbh = new \PDO('mysql:host='.$tmp_db_host.';dbname='.$tmp_db_name.';charset='.$tmp_db_chrs, $tmp_db_user, $tmp_db_pwrd);
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            if ($logger) {
                $logger->debug('MODEL / CONNECTED PDO DB: '.$tmp_db_name.'');
            }
        } catch (\PDOException $Exception) {
            $this->dbh = false;
            if ($logger) {
                switch ($Exception->getCode()) {
                case 2005:
                    $logger->warning('MODEL / PDO DB ERROR 2005: Unknown HOST - '.$tmp_db_host);
                    break;
                case 2003:
                    $logger->warning('MODEL / PDO DB ERROR 2003: Can Not Connect to the HOST - '.$tmp_db_host);
                    break;
                case 1049:
                    $logger->warning('MODEL / PDO DB ERROR 1049: DATABASE - '.$tmp_db_name.' does not exist on HOST - '.$tmp_db_host);
                    break;
                case 1045:
                    $logger->warning('MODEL / PDO DB ERROR 1045: AUTH USER - '.$tmp_db_user.' PASSWORD - ****'); // $tmp_db_pwrd
                    break;
                default:
                if ($logger) {
                    $logger->warning('MODEL / PDO DB ERROR: UNKNOWN');
                }
//                    break;

            }
            }
        }
        return $this->dbh;
    }
};

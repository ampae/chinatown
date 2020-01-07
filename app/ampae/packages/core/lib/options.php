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

class Options
{
    /**
     * constructor;
     */
    public function __construct()
    {
    }

    /*
    As a rule of thumb, if your options are needed by the public part of the app, save them with autoload. If they are only needed in the admin area, save them without autoload.
    */

    /**
     * Fetch a saved option
     *
     * @return void
     */
    public function get($option, $default = null)
    {
        global $db;
        $out = $default;
        $sql = "SELECT `option_value` FROM `".DB1_TABLE_PREFIX."options` WHERE `option_name`='$option' LIMIT 1";

        if ($db->db1) {
//            $db->db1->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING );
            $st = $db->db1->prepare($sql);
            $st->execute();
            if ($st->rowCount() > 0) {
                if ($row = $st->fetch(\PDO::FETCH_ASSOC)) {
                    $out = $row['option_value'];
                }
            }
        }

        return $out;
    }

    /**
     * Fetch all options as an array
     *
     * @return void
     */
    public function getAll()
    {
        global $db;
        $sql = "SELECT * FROM `".DB1_TABLE_PREFIX."options` ORDER BY `option_id` ASC";
        $st = $db->db1->prepare($sql);
        $st->execute();
        $res = $st->fetchAll(\PDO::FETCH_ASSOC);
        return $res;
    }

    /**
     * Fetch all options as an array
     *
     * @return void
     */
    public function getGroup($group)
    {
        global $db;
        $sql = "SELECT * FROM `".DB1_TABLE_PREFIX."options` WHERE `option_group`='$group' ORDER BY `option_id` ASC";
        $st = $db->db1->prepare($sql);
        $st->execute();
        $res = $st->fetchAll(\PDO::FETCH_ASSOC);
        return $res;
    }


    public function getGrops()
    {
        global $db;
        $sql = "SELECT `option_group` FROM `".DB1_TABLE_PREFIX."options` GROUP BY `option_group` ORDER BY `option_id` ASC";
        $st = $db->db1->prepare($sql);
        $st->execute();
        $res = $st->fetchAll(\PDO::FETCH_ASSOC);
        return $res;
    }

    /**
     * Create an option to the database
     *
     * @return void
     */
    public function add($key, $value)
    {
        global $db;
        $q = "INSERT INTO `".DB1_TABLE_PREFIX."options` (`option_name`, `option_value`) VALUES ('$key', '$value') ON DUPLICATE KEY UPDATE `option_value` = '$value' ";
        $res = $db->db1->query($q);
        return $res;
    }

    /**
     * Create an option to the database
     *
     * @return void
     */
    public function addGroup($group, $key, $value)
    {
        global $db;
        $q = "INSERT INTO `".DB1_TABLE_PREFIX."options` (`option_group`, `option_name`, `option_value`) VALUES ('$group','$key', '$value') ON DUPLICATE KEY UPDATE `option_value` = '$value' ";
        $res = $db->db1->query($q);
        return $res;
    }

    /**
     * Update the value of an option that was already added.
     *
     * @return void
     */
    public function update($key, $value)
    {
        global $db;
        $q = "UPDATE `".DB1_TABLE_PREFIX."options` SET `option_value`='$value' WHERE `option_name`='$key' ";
        $res = $db->db1->query($q);
        return $res;
    }

    /**
     * Removes option by name.
     *
     * @return void
     */
    public function delete($key)
    {
        global $db;
        $q = "DELETE FROM `".DB1_TABLE_PREFIX."options` WHERE `option_name`='$key' ";
        $res = $db->db1->query($q);
        return $res;
    }
}

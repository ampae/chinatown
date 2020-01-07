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


class Smrecb
{
    /**
     * constructor; initialize cookies;.
     */
    public function __construct()
    {

    }

    public function getRec($db,$r,$sel,$rec,$dt,$prm=true,$limit=1) {
      $q = "SELECT `".$sel."` FROM `".$r."` WHERE `".$rec."`='$dt' ";
      if ($prm) {
        $q .= "AND `prm`='1' ";
      }
      if ($limit) {
        $q .= "LIMIT ".$limit." ";
      }
      $sth = $db->prepare($q);
      $sth->execute();
      $result = $sth->fetch(\PDO::FETCH_ASSOC);
      $res = $result[$sel];
      return $res;
    }

    public function delRec($db,$r,$k,$v,$prm=false) {
      $q = "DELETE FROM `".$r."` WHERE `".$k."`='$v' ";
      if ($prm) {
        $q .= "AND `prm`='1' ";
      }
      $sth = $db->prepare($q);
      $sth->execute();
      return $res;
    }

}

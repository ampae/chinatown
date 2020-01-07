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

class Smrecb
{
    /**
     * constructor; initialize cookies;.
     */
    public function __construct()
    {
    }

    public function addRec($db, $r, $dt)
    {

        /*

        $dt = array(
          'id' => $i,
          'key' => 'email',
          'val' => $email,
          'prv' => '0',
          'grp' => '1',
          'st' => '1'
        );

        $statement = $link->prepare('INSERT INTO testtable (name, lastname, age)
            VALUES (:fname, :sname, :age)');

        $statement->execute([
            'fname' => 'Bob',
            'sname' => 'Desaunois',
            'age' => '18',
        ]);

        $bdata    = array('key' => $dt['key'], 'id' => $dt['id']);
        if ($this->count($db, $r, $bdata)) {
            $dt['prm'] = 0;
        } else {
            $dt['prm'] = 1;
        }
*/

        $res      = null;
        $tmpKeys  = array_keys($dt);
        $tmpK     = implode('`, `', $tmpKeys);
        $tmpK     = '`'.$tmpK.'`';
        $tmpV     = implode(', :', $tmpKeys);
        $tmpV     = ':'.$tmpV.'';
        $sql      = 'INSERT INTO `'.$r.'` ('.$tmpK.') VALUES ('.$tmpV.') ';
        $tmpQ     = $db->prepare($sql);
        $res      = $tmpQ->execute($dt);

        return $res;
    }

    public function getRecNew($db, $r, $sel, $dt, $prm = true, $limit = 1)
    {
        $i = 0;
        $q = "SELECT `".$sel."` FROM `".$r."` WHERE ";

        foreach ($dt as $dtk => $dtv) {
            $i+=1;
            if ($i>1) {
                $q.="AND ";
            }
            $q .="`".$dtk."`='$dtv' ";
        }

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

    public function getRec($db, $r, $sel, $rec, $dt, $prm = true, $limit = 1)
    {
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

    public function delRec($db, $r, $k, $v, $prm = false)
    {
        $q = "DELETE FROM `".$r."` WHERE `".$k."`='$v' ";
        if ($prm) {
            $q .= "AND `prm`='1' ";
        }
        $sth = $db->prepare($q);
        $sth->execute();
        return $res;
    }
}

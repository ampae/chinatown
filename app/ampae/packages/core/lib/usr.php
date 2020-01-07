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

class Usr
{
    //    RES       -    name of the res / table

    //    global    -    1 = unique value across all r(table); 0 = unique value across i(record id);
    //    hidden    -    hidden field
    //    expired   -    record expired / days

    const RES = 'usr';
    // -- userlevel -> acl1

    //    decode raw config
    public function __construct()
    {
    }

    //    create table; reserved;
    /*
    public function create($db)
    {
        global $smreca;
        $result = $smreca->create($db, self::RES);

        return $result;
    }
    */

    public function cutUsername($tmp_at)
    {
        $tmp_at = strtolower($tmp_at);
        $tmp_at = preg_replace('/[^\da-z]/i', '', $tmp_at);
        $tmp_at = preg_replace('#^\d+#', '', $tmp_at);
        $tmp_at = substr($tmp_at, 0, MAX_USERNAME_LENGTH);
        return $tmp_at;
    }


    //    Add User sequence;
    //    Usage: $usr->add( USER_NAME, USER_EMAIL, USER_LEVEL(optional) );
    // ??? rbac !!!
    public function add($name, $email)
    {
        global $db,  $smreca;
        $i = null;


        // make sure we don't have same email already
        $bdata = array(
          'key' => 'email',
          'val' => $email,
        );
        if ($smreca->count($db->db1, DB1_TABLE_PREFIX.self::RES, $bdata) < 1) {
            $i = $smreca->addInd($db->db1, DB1_TABLE_PREFIX.self::RES);

            if ($i) {
                $adata = array(
              'id' => $i,
              'key' => 'email',
              'val' => $email,
              'prv' => '0',
              'grp' => '1',
              'st' => '1'
            );
                $smreca->insert($db->db1, DB1_TABLE_PREFIX.self::RES, $adata);

                $adata = array(
              'id' => $i,
              'key' => 'since',
              'val' => date('F Y', time()),
              'grp' => '1',
              'st' => '1'
            );
                $smreca->insert($db->db1, DB1_TABLE_PREFIX.self::RES, $adata);

                $name = $this->cutUsername($name);

                if ($this->getUid($name, 'name')) {
                    $name = 'auto'.rand(1010, 89898989); // !!!
    // add error username taken !!!
                }

                if ($name) {
                    $adata = array(
              'id' => $i,
              'key' => 'name',
              'val' => $name,
              'prv' => '0',
              'grp' => '1',
              'st' => '1'
            );
                    $smreca->insert($db->db1, DB1_TABLE_PREFIX.self::RES, $adata);
                }

                /*
                            $adata = array(
                              'id' => $i,
                              'key' => 'tz',
                              'val' => 'UTC',
                              'st' => '1'
                            );
                            $smreca->insert($db->db1, DB1_TABLE_PREFIX.self::RES,$adata);
                */
            } else {
                // echo 'err - db full!';
            }
        }

        return $i;
    }

    public function del($i)
    {
        global $db,  $smreca, $office, $sign,$auth;
        // check $i ???
        $adata = array(
        'id' => $i,
        'grp' => 0
      );
        $smreca->delete($db->db1, DB1_TABLE_PREFIX.self::RES, $adata);
    }

    public function purge($i)
    {
        global $db,  $smreca, $office, $sign,$auth;
        // check $i ???

        $adata = array(
        'id' => $i,
      );
        $smreca->delete($db->db1, DB1_TABLE_PREFIX.self::RES, $adata);
    }

    public function set($i, $k, $v)
    {
        global $db, $smreca, $office, $sign, $auth;
        // check $i ???

        return $smreca->set($db->db1, DB1_TABLE_PREFIX.self::RES, $i, $k, $v);
    }

    public function addRec($i, $k, $v, $st = 0)
    {
        global $db, $smreca, $office, $sign, $auth;
        // check $i ???

        $idata = array(
        'id' => $i,
        'key' => $k,
        'val' => $v
      );
        if ($st) {
            $idata['st'] = 1;
        }
        $res = $smreca->insert($db->db1, DB1_TABLE_PREFIX.self::RES, $idata);
        return $res;
    }

    public function updRec($i, $k, $v)
    {
        global $db,  $smreca, $office, $sign, $auth;
        // check $i ???

        $udata = array(
        'SET' => array(
          'val' => $v
         ),
        'WHERE' => array(
          'id' => $i,
          'key' => $k,
        )
      );
        $res = $smreca->update($db->db1, DB1_TABLE_PREFIX.self::RES, $udata);
        return $res;
    }

    public function updSt($i, $k, $v)
    {
        global $db,  $smreca, $office, $sign, $auth;
        // check $i ???

        $udata = array(
        'SET' => array(
          'st' => $v
         ),
        'WHERE' => array(
          'id' => $i,
          'key' => $k,
          'prm' => 1,
        )
      );
        $res = $smreca->update($db->db1, DB1_TABLE_PREFIX.self::RES, $udata);
        return $res;
    }

    public function updStFull($i, $k, $v, $stv)
    {
        global $db,  $smreca, $office, $sign, $auth;
        // check $i ???

        $udata = array(
        'SET' => array(
          'st' => $stv
         ),
        'WHERE' => array(
          'id' => $i,
          'key' => $k,
          'val' => $v,
        )
      );
        $res = $smreca->update($db->db1, DB1_TABLE_PREFIX.self::RES, $udata);
        return $res;
    }

    public function delRecNs($k, $v)
    {
        global $db,  $smreca;
        $adata = array(
        'key' => $k,
        'val' => $v,
        'st' => 0
      );
        $smreca->delete($db->db1, DB1_TABLE_PREFIX.self::RES, $adata);
    }

    public function delRec($i, $k, $v)
    {
        global $db,  $smreca, $office, $auth;
        // check $i ???

        $adata = array(
        'id' => $i,
        'key' => $k,
        'val' => $v,
      );
        $smreca->delete($db->db1, DB1_TABLE_PREFIX.self::RES, $adata);
    }

    public function setPri($i, $k, $v)
    {
        global $db,  $smreca, $office, $sign, $auth;
        // check $i ???

        return $smreca->setPri($db->db1, DB1_TABLE_PREFIX.self::RES, $i, $k, $v);
    }

    public function is($v, $k = null, $i = null, $prm = false, $st = true)
    {
        global $db,  $smreca, $office, $sign, $auth;

        // check $i ???


        $adata = array(
        'val' => $v,
        );
        if ($k) {
            $adata['key'] = $k;
        }
        if ($i) {
            $adata['id'] = $i;
        }
        if ($prm) {
            $adata['prm'] = 1;
        }
        if ($st) {
            $adata['st'] = 1;
        }
        return $smreca->count($db->db1, DB1_TABLE_PREFIX.self::RES, $adata);
    }

    public function countUsrs($st=null)
    {
        global $db,  $smreca, $office;
        // rbac ADM ??? careful
        $adata = array(
        'key' => 'ind',
      );
        if ($st) {
            $adata['st'] = 1;
        }
        return $smreca->count($db->db1, DB1_TABLE_PREFIX.self::RES, $adata);
    }

    public function countKeys($k, $i=null, $st=null)
    {
        global $db,  $smreca, $sign, $office;
        // check $i ???

        $adata = array(
        'key' => $k,
      );
        if ($i>=0) {
            $adata['id'] = $i;
        }
        if ($st) {
            $adata['st'] = 1;
        }
        return $smreca->count($db->db1, DB1_TABLE_PREFIX.self::RES, $adata);
    }

    public function get($i, $k)
    {
        global $db,  $smreca, $office, $sign, $auth;

        $res = null;
        $adata = array(
        'id' => $i,
        'key' => $k,
        'prm' => 1,
      );
        if ($db->db1) {
            $res = $smreca->select($db->db1, DB1_TABLE_PREFIX.self::RES, 'val', $adata); // 'key' => "'".$k."'",
        }
        return $res;
    }

    public function getArr($i, $k, $st=1)
    {
        global $db,  $smreca, $office, $sign, $auth;
        // check $i ???

        $res = null;
        $adata = array(
        'id' => $i,
        'key' => $k,
      );
        if ($st) {
            $adata['st'] = 1;
        }
        if ($db->db1) {
            $res = $smreca->selectArr($db->db1, DB1_TABLE_PREFIX.self::RES, 'val', $adata);
        }
        return $res;
    }

    public function getFullArr($i, $k, $order=null)
    {
        global $db,  $smreca, $office, $sign, $auth;
        // check $i ???

        $res = null;
        $adata = array(
        'id' => $i,
        'key' => $k,
      );
        $adatb = array(
        'val', 'prm', 'prv', 'st'
      );
        if ($db->db1) {
            $res = $smreca->selectFullArr($db->db1, DB1_TABLE_PREFIX.self::RES, $adatb, $adata, $order);
        }
        return $res;
    }

    public function checkUid($i, $st=null)
    {
        global $db,  $smreca, $sign;
        // check $i ???

        $adata = array(
        'id' => $i,
        'key' => 'ind'
      );
        if ($st) {
            $adata['st'] = 1;
        }
        return $smreca->count($db->db1, DB1_TABLE_PREFIX.self::RES, $adata);
    }

    public function getUid($v, $k=null, $st=null)
    {
        global $db, $smreca, $office, $sign;
        $adata = array(
        'val' => $v,
      );
        if ($k) {
            $adata['key'] = $k;
        }
        if ($st) {
            $adata['st'] = 1;
        }
        $tmpres = $smreca->select($db->db1, DB1_TABLE_PREFIX.self::RES, 'id', $adata);
        /*
              if (!$office->can()) {
                if ( $tmpres != $auth->get() ) {
                  $tmpres = null;
                }
              }
        */
        return $tmpres;
    }

    public function getSt($i, $k)
    {
        global $db, $smreca, $office, $sign;
        $adata = array(
        'id' => $i,
        'key' => $k
      );
        $tmpres = $smreca->select($db->db1, DB1_TABLE_PREFIX.self::RES, 'st', $adata);
        /*
              if (!$office->can()) {
                if ( $tmpres != $auth->get() ) {
                  $tmpres = null;
                }
              }
        */
        return $tmpres;
    }
}

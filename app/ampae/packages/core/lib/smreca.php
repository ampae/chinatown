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


class Smreca
{
    /*
    x - auto-incremental index
    id - record ID (unique for each record, not unique for table)
    key - record key
    val - record value
    pri - primary record flag (reserved for future use, in this class should always be 1 for all records)
    grp - record group (optional)
    st - record status / confirmation (default - 0 - not confirmed; confirmed value defined by CONFIRMED)
    ts - record creation timestamp
    expwrn - record expiration warning timestamp
    expsft - record expiration soft timestamp
    exphrd - record expiration hard timestamp
    */

    //    Constructor; define class parameters
    public function __construct()
    {
        define('DEF_X_FROM', '112001');     // Auto-incremental index starting point

        define('ID_TRY', '2000');            // max number of attempts to obtain new ID
        define('ID_MIN', '5101010101');     // 1010101010 5101010101
        define('ID_MAX', '9898989898');     // 4294967289 9898989898

        define('CONFIRMED', '1');               // confirmed status value
    }

    // smart record: if k within given i not exist it will be inserted, else it will be updated
    // should be used when k is unique to the i
    // multiple k should be always inserted !
    public function set($db, $r, $i, $k, $v)
    {
        $res = false;
        $cdata = array (
          'id' => $i,
          'key' => $k
        );
        if ($this->count($db, $r, $cdata) < 1) {
            $idata = array (
              'id' => $i,
              'key' => $k,
              'val' => $v
            );
            $res = $this->insert($db, $r, $idata);
        } else {
            $udata = array (
              'SET' => array(
                'val' => $v
               ),
              'WHERE' => array(
                'id' => $i,
                'key' => $k,
              )
            );
            $res = $this->update($db, $r, $udata);
        }
        return $res;
    }

    //
    public function count($db, $r, $kvdata)
    {
        $tmpKeys  = array_keys($kvdata);
        $tmpK     = implode('`=? AND `',$tmpKeys);
        $tmpK     = '`'.$tmpK.'`=?';

        $tmpVal   = array_values($kvdata);

        $sql = 'SELECT COUNT(`x`) FROM `'.$r.'` WHERE '.$tmpK.' ';
        //echo $sql."<BR>";
        $tmpQ = $db->prepare($sql);
        $tmpQ->execute($tmpVal);

        return $tmpQ->fetchColumn();
    }

    public function select($db, $r, $sel, $kvdata)
    {
        //$res          = null;
        $tmpKeys      = array_keys($kvdata);
        $tmpK         = implode('`=? AND `',$tmpKeys);
        $tmpK         = '`'.$tmpK.'`=?';

        $tmpVal   = array_values($kvdata);

        $sql = 'SELECT `'.$sel.'` FROM `'.$r.'` WHERE '.$tmpK.' LIMIT 1 '; // create another one for arr return
        $sth = $db->prepare($sql);
        $sth->execute($tmpVal);

        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        $res = $result[$sel];

        return $res;
    }

    public function selectArr($db, $r, $sel, $kvdata)
    {
        //$res          = null;
        $tmpKeys      = array_keys($kvdata);
        $tmpK         = implode('`=? AND `',$tmpKeys);
        $tmpK         = '`'.$tmpK.'`=?';

        $tmpVal   = array_values($kvdata);

        $sql = 'SELECT `'.$sel.'` FROM `'.$r.'` WHERE '.$tmpK.' ';
        $sth = $db->prepare($sql);
        $sth->execute($tmpVal);

        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
//        $res = array_map(function($a) {  return array_pop($a); }, $result);
        $res = array_map('array_pop',$result); // current array_pop

        return $res;
    }

    public function selectFullArr($db, $r, $seldata, $kvdata, $order=null)
    {
        //$res        = null;
        $tmpKeys  = array();
        $tmpK     = '';
        $tmpS     = '*';
        $tmpVal   = array();

        if (!empty($kvdata)) {
          $tmpKeys    = array_keys($kvdata);
          $tmpK       = implode('`=? AND `',$tmpKeys);
          $tmpK       = '`'.$tmpK.'`=?';
          $tmpVal     = array_values($kvdata);
        }

        if (!empty($seldata)) {
          $tmpS       = implode("`,`",$seldata);
          $tmpS       = "`".$tmpS."`";
        }

        $sql = 'SELECT '.$tmpS.' FROM `'.$r.'` ';

        if (!empty($kvdata)) {
          $sql.= 'WHERE '.$tmpK.' ';
        }

        if ($order) {
          $sql.= 'ORDER BY `'.$order.'` DESC ';
        }

        $sth = $db->prepare($sql);
        $sth->execute($tmpVal);

        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
//        $res = array_map(function($a) {  return array_pop($a); }, $result);
        //$res = array_map('array_pop',$result); // current array_pop

        return $result;
    }


    public function update($db, $r, $tmpUpd)
    {
        $res                    = null;
        $tmpUpd['SET']['ts']   = time();

        $tmpSet         = $tmpUpd['SET'];
        $tmpWhere       = $tmpUpd['WHERE'];

        $tmpKeysSet     = array_keys($tmpSet);
        $tmpKs          = implode('`=? , `',$tmpKeysSet);
        $tmpKs          = '`'.$tmpKs.'`=?';

        $tmpKeysWhere   = array_keys($tmpWhere);
        $tmpKw          = implode('`=? AND `',$tmpKeysWhere);
        $tmpKw          = '`'.$tmpKw.'`=?';

        $tmpArr   = array_merge($tmpSet,$tmpWhere);
        $tmpVal   = array_values($tmpArr);

        $sql      = 'UPDATE `'.$r.'` SET '.$tmpKs.' WHERE '.$tmpKw.' '; // create another one for arr return
        $sth      = $db->prepare($sql);
        $res      = $sth->execute($tmpVal);

        return $res;
    }

    //  create record k/v to the r with given i
    public function insert($db, $r, $kvdata)
    {
        $t        = time();
        $res      = null;

        $bdata    = array ('key' => $kvdata['key'], 'id' => $kvdata['id']);

        if ($this->count($db, $r, $bdata)) {
          $kvdata['prm'] = 0;
        } else {
          $kvdata['prm'] = 1;
        }
        $kvdata['ts']   = time();

        $tmpKeys  = array_keys($kvdata);
        $tmpK     = implode('`, `',$tmpKeys);
        $tmpK     = '`'.$tmpK.'`';
        $tmpV     = implode(', :',$tmpKeys);
        $tmpV     = ':'.$tmpV.'';
        $sql      = 'INSERT INTO `'.$r.'` ('.$tmpK.') VALUES ('.$tmpV.') ';
        $tmpQ     = $db->prepare($sql);
        $res      = $tmpQ->execute($kvdata);

        return $res;
    }


    public function delete($db, $r, $kvdata)
    {
        $res      = null;
        $tmpKeys  = array_keys($kvdata);
        $tmpK     = implode('`=? AND `',$tmpKeys);
        $tmpK     = '`'.$tmpK.'`=?';

        $tmpVal   = array_values($kvdata);

        $sql = 'DELETE FROM `'.$r.'` WHERE '.$tmpK.' '; // create another one for arr return
        $sth = $db->prepare($sql);
        $sth->execute($tmpVal);

        return $res; // !!! ???
    }


    //     add new i record
    public function addInd($db, $r)
    {
        $i = $this->newid($db, $r);
        $adata = array(
          'id' => $i,
          'key' => 'ind',
          'val' => '1',
          'grp' => '1',
          'st' => '1'
        );
        if ($i) {
          $this->insert($db, $r, $adata);
        }
        return $i;
    }

    public function setPri($db, $r, $i, $k, $v) {
      $res = false;
      // only confirmed records can become primary
      $kvdata = array(
        'id' => $i,
        'key' => $k,
        'val' => $v,
        'st' => 1,
      );
      if ( $this->count($db, $r, $kvdata) ) {
          $this->remPri($db, $r, $i, $k);
          $tmpUpd = array(
            'SET' => array(
              'prm' => 1,
              'grp' => 1
             ),
            'WHERE' => array(
              'id' => $i,
              'key' => $k,
              'val' => $v
            )
          );
          $res = $this->update($db, $r, $tmpUpd);
      }
      return $res;
    }

    // --- PRIVATE SERVICE ---


    //    generate unique record id - i
    private function newid($db, $r)
    {
      $i = null;
      for ($j=1;$j<ID_TRY;$j++) {
        $ic = rand(ID_MIN, ID_MAX);
        $tmpai = array('id'=>$ic);
        if ($this->count($db, $r, $tmpai) < 1) {
          $i = $ic;
          break;
        }
      }
      return $i;
    }

    private function remPri($db, $r, $i, $k) {
      $tmpUpd = array(
        'SET' => array(
          'prm' => 0,
          'grp' => 0
         ),
        'WHERE' => array(
          'id' => $i,
          'key' => $k,
        )
      );
      return $this->update($db, $r, $tmpUpd);
    }



    // --- --- RESERVED FOR FUTURE USE ---
    /*
    //    part of record confirmation
        public function pin($v,$l=8) {
            $combi    = $v.CONF_SALT;
            $comhx    = md5($combi);
            $pured    = preg_replace('/[^0-9]/', "", $comhx);
            $purel    = preg_replace('/[^a-f]/', "", $comhx);
            $cutl    = base_convert($purel,16,9);
            $dmix    = $pured.$cutl;
            $res    = substr($dmix,0,$l);
        return $res; }
    */

    // --- DB ---

    //    create new table r
    public function create($db, $r, $x = DEF_X_FROM, $enc = 'utf8', $eng = 'InnoDB')
    {
        // $t = time();
        $q = "CREATE TABLE IF NOT EXISTS `".$r."` (";
        $q.= "`x` bigint(19) unsigned NOT NULL AUTO_INCREMENT, ";
        $q.= "`id` bigint(19) unsigned NOT NULL DEFAULT '0', ";
        $q.= "`key` varchar(32) NOT NULL DEFAULT '0', ";
        $q.= "`val` varchar(255) NOT NULL DEFAULT '', ";
        $q.= "`prm` tinyint(1) unsigned NOT NULL DEFAULT '0', ";
        $q.= "`prv` tinyint(1) unsigned NOT NULL DEFAULT '1', ";
        $q.= "`grp` tinyint(3) unsigned NOT NULL DEFAULT '0', ";
        $q.= "`st` tinyint(3) NOT NULL DEFAULT '0', ";
        $q.= "`ts` bigint(19) unsigned NOT NULL DEFAULT '0', ";
        $q.= "`exp` int(10) unsigned NOT NULL DEFAULT '0', ";
        $q.= "PRIMARY KEY (`x`)) ";
        $q.= "ENGINE=".$eng." ";
        $q.= "DEFAULT CHARSET=".$enc." ";
        $q.= "AUTO_INCREMENT=".$x." ;";

        $result = $db->query($q);

        return $result;
    }

    //    destroy table r
    public function destroy($db, $r)
    {
        $q = 'DROP TABLE `'.$r.'` ';
        $result = $db->query($q);

        return $result;
    }
}

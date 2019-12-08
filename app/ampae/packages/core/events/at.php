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

namespace Ampae\Event;

class At
{
    const VENDOR = 'ampae';

    public function index()
    {
        global $model, $view, $sign, $state, $office, $html;

        //if ($office->can()) {
        $val2 = $model->appinfo['url'].DIR_APP.'/'.self::VENDOR.'/packages/core/view/js/admusrlst.js'; // argc == 1
        $html->addScript('HEAD', $val2);
        $val5 = $model->appinfo['url'].DIR_LIBS.'/jquery/jquery.flot.min.js';
        $html->addScript('HEAD', $val5);
        $val4 = $model->appinfo['url'].DIR_APP.'/'.self::VENDOR.'/packages/core/view/js/admchart.js';
        $html->addScript('HEAD', $val4);
        //}
    }

    public function search()
    {
        global $model, $view, $sign, $state, $office,$html;

        //if ($office->can()) {
        $val2 = $model->appinfo['url'].DIR_APP.'/'.self::VENDOR.'/packages/core/view/js/admusearch.js'; // argc == 1
        $html->addScript('HEAD', $val2);

        if (!$state->get()) {
            $model->redirect = $model->appinfo['url'].'login';
        }
        //}
    }

    // --- raw ---

    public function chart()
    {
        global $controller, $model, $sign, $state, $db, $usr, $local;//, $http, $html;
        $model->appinfo['page_type'] = 'json';


        $results    = array(); //clean up
        $i          = 0;

        $aa = strtotime('-1 month');

        /*
        $q = "SELECT
        ANY_VALUE(`ts`) as `tts`,
        DATE(FROM_UNIXTIME(`ts`)) as `ddt`,
        COUNT(*) AS `num_reg`
        FROM `".DB1_TABLE_PREFIX."usr`
        WHERE `key` = 'ind'
        AND `ts` > '$aa'
        GROUP BY `ddt`
        ORDER BY `ddt` DESC
        LIMIT 10";
        */

        $q = "SELECT `ts` as `tts`, COUNT(*) AS `num_reg` FROM `".DB1_TABLE_PREFIX."usr` WHERE `key` = 'ind' AND `ts` > '$aa' GROUP BY DATE(FROM_UNIXTIME(`ts`)) ORDER BY `ts` DESC LIMIT 10";

        $st = $db->db1->prepare($q);
        $st->execute();

        if ($st->rowCount() > 0) {
            while ($row = $st->fetch()) {
                //$t = strtotime($row['ddt']);
                $t = $row['tts'];
                $n = $row['num_reg'];
                $results['dataLine'][$i][0] = $t * 1000;
                $results['dataLine'][$i][1] = intval($n);
                $i++;
            }
        }

        $model->results = $results;
    }

    public function process()
    {
        global $controller, $model, $sign, $state, $db, $usr, $local;//, $http, $html;
        $model->appinfo['page_type'] = 'json';

        $limit      = 5;
        $offset     = 0;
        $q          = '';

        if (isset($controller->params['limit'])) {
            $limit = $controller->params['limit'];
        }

        if (isset($controller->params['offset'])) {
            $offset = $controller->params['offset'];
        }

        if (isset($controller->params['q'])) {
            $q = $controller->params['q'];
        }

        $sql = "SELECT ANY_VALUE(`ts`) as `tts`,
`id`
FROM `".DB1_TABLE_PREFIX."usr`
WHERE ( `val` LIKE '%{$q}%' OR `id` LIKE '%{$q}%' )
AND (`key` = 'name' OR `key` = 'tel' OR `key` = 'since' OR `key` = 'xid' OR `key` = 'email' )
GROUP BY `id`
ORDER BY `tts` DESC
LIMIT $limit OFFSET $offset"; // p=1 ?


        $sql = "SELECT
`ts` as `tts`,
`id`
FROM `".DB1_TABLE_PREFIX."usr`
WHERE ( `val` LIKE '%{$q}%' OR `id` LIKE '%{$q}%' )
AND (`key` = 'name' OR `key` = 'tel' OR `key` = 'since' OR `key` = 'xid' OR `key` = 'email' )
GROUP BY `id`
ORDER BY `tts` DESC
LIMIT $limit OFFSET $offset"; // p=1 ?

        //echo $sql;

        $row        = array(); //clean up
        $results    = array();
        $i          = 0;

        $st         = $db->db1->prepare($sql);
        $st->execute();

        $res = $st->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($res as $a => $b) {
            $mid = $b['id'];
            $results[] = $this->getUserData($b['id'], $b['tts']);
        }

        $model->results = $results;
    }

    public function getusrlst()
    {
        global $controller, $model, $sign, $state, $db, $usr, $local;//, $http, $html;
        $model->appinfo['page_type'] = 'json';

        $limit      = 5;
        $offset     = 0;
        $q          = '';

        if (isset($controller->params['limit'])) {
            $limit = $controller->params['limit'];
        }

        if (isset($controller->params['offset'])) {
            $offset = $controller->params['offset'];
        }

        $sql = "SELECT
`ts` as `tts`,
`id`
FROM `".DB1_TABLE_PREFIX."usr`
GROUP BY `id`
ORDER BY `tts` DESC
LIMIT $limit OFFSET $offset";

        // echo $sql;

        $row        = array(); //clean up
        $results    = array();
        $i          = 0;

        $st         = $db->db1->prepare($sql);
        $st->execute();

        $res        = $st->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($res as $a => $b) {
            $mid = $b['id'];
            $results[] = $this->getUserData($b['id'], $b['tts']);
        }

        $model->results = $results;
    }


    private function getUserData($uid, $tts)
    {
        global $controller, $model, $sign, $usr, $local, $avatar, $db, $basic;//, $http, $html;


        $row['id'] = $uid;
        $row['at'] = $usr->get($uid, 'name');
        $row['avatar'] = $avatar->get($uid);
        $row['ago'] = $basic->timeAgo($tts);
        $row['email'] = $usr->get($uid, 'email');

        return $row;
    }
};

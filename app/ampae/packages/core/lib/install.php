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

class Install
{
    public function __construct()
    {
        global $logger, $controller, $model, $pdo, $db, $view;

        $tmpAuth = false;

        if (!$db->db1) {
            if ($controller->argc == 1 && $controller->argv[0] == 'install') {
                // Ok
            } else {
              if (INSTALL && INSTALL_AUTO_REDIRECT) {
                $model->redirect = $model->appinfo['url'].'install';
              }
            }
        }
    }
};

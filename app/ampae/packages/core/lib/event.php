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

namespace Ampae\Lib;

class Event
{
    /**
     * constructor.
     */
    public function __construct()
    {
        $this->go();
    }

    public function go()
    {
        global $controller, $model, $state, $appRequest, $appController;
        global $appView, $appModel, $tmpGlobalConfig, $theme;

        $tmpEvent     = TMP_EVENT_HOME;
        $tmpMethod    = TMP_METHOD; // DEFAULT CLASS METHOD !!!

        $tmpC = 0;
        if (!empty($controller->argc) && $controller->argc >= 1) {
            $tmpEvent     = TMP_EVENT_HOME; // 404
            $tmpC = $controller->argc;
        }

        if ($tmpC > 0) {
            $tmpEvent = $controller->argv[0];
        }

        if ($tmpC > 1) {
            $tmpMethod = $controller->argv[1];
        }

        // $tmpCmethod = strtolower($controller->method);

        //$tmpFireController = false;
        $tmpFireControllerMethod = false;

        if (isset($tmpGlobalConfig['mvc'][$tmpEvent])) {

          // $model->appinfo['app_real_event'] = $tmpEvent;

            $tmpRealEvent = $tmpEvent;
            $tmpRealMethod = $tmpMethod;
        /*
                  if (isset($tmpGlobalConfig['mvc'][$tmpEvent]['controller'])) {
                    $tmpFireController = true;
                  }

                  if (isset($tmpGlobalConfig['mvc'][$tmpEvent][$tmpCmethod])) {
                    $tmpFireControllerMethod = true;
                  }
        */
        } else {
            $tmpRealEvent = TMP_EVENT_HOME;

            //$tmpPack      = DEF_PACK;
          $tmpRealMethod    = TMP_METHOD; // DEFAULT CLASS METHOD !!!

          //$tmpFireController = true;

          //$tmpFireControllerMethod = true;
        }

        // $model->appinfo['page_type']
        /*
                switch ($tmpRealMethod) {
                    case 'index':
                        $model->appinfo['page_type'] = 'html'; // !!!
                        break;
                    case 'default':
                        $model->appinfo['page_type'] = 'html'; // !!!
                        break;
                    case 'create':
                        $model->appinfo['page_type'] = 'com'; // !!!
                        break;
                    case 'read':
                        $model->appinfo['page_type'] = 'com'; // !!!
                        break;
                    case 'update':
                        $model->appinfo['page_type'] = 'com'; // !!!
                        break;
                    case 'delete':
                        $model->appinfo['page_type'] = 'com'; // !!!
                        break;
                    case 'check':
                        $model->appinfo['page_type'] = 'json'; // !!!
                        break;
                    default:
                        $model->appinfo['page_type'] = DEFAULT_PAGE_TYPE; // !!! http prep head !!!
                        break;
                }
        */
        $model->appinfo['app'] = $tmpRealEvent;
        $model->appinfo['app_mtd'] = $tmpRealMethod;





        $tmpMeMe = 'events';
        $tmpFireMe = true;
        if (isset($tmpGlobalConfig['mvc'][$tmpRealEvent])) {
            if (!isset($tmpGlobalConfig['mvc'][$tmpRealEvent][$tmpMeMe])) {
                $tmpFireMe = false;
            }
        }

        if ($tmpFireMe) {

//            if (isset($tmpGlobalConfig['mvc'][$tmpRealEvent]['model'])) {
            $tmpVendor  = $tmpGlobalConfig['mvc'][$tmpRealEvent]['events']['vendor'];
            $tmpPack    = $tmpGlobalConfig['mvc'][$tmpRealEvent]['events']['pack'];
//            }

            $tmpVendorPath = DIR_APP.DIRECTORY_SEPARATOR.$tmpVendor.DIRECTORY_SEPARATOR;

            $tmpPt = $tmpVendorPath.DIR_PACKS.DIRECTORY_SEPARATOR.$tmpPack.DIRECTORY_SEPARATOR.$tmpMeMe.DIRECTORY_SEPARATOR;
            $tmpNs = ucfirst($tmpVendor).'\\'.ucfirst('event').'\\';

            $tmpGlobalConfig['autoload']['main']['psr-4'][$tmpNs] = $tmpPt;
            $tmpCls = '\\'.$tmpNs.ucfirst($tmpRealEvent);

            if (class_exists($tmpCls)) {
                $appRequest = new $tmpCls();
                if ($tmpRealMethod && method_exists($appRequest, $tmpRealMethod)) {
                    $appRequest->$tmpRealMethod();
                } else {
                    if (method_exists($appRequest, 'default')) {
                        $appRequest->default();
                    }
                }
            }
        }
    }
}

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
 * @version    HG: <7.1.1>
 * @category   SaaS RAD LAMP FrameWork.
 * @see        https://ampae.com/chinatown/
 * @author     AMPAE <info@ampae.com>
 * @license    https://ampae.com/chinatown/license.txt
 * @copyright  2009 - 2019 AMPAE
**/

namespace Ampae\Lib;

class Mvc
{
//    const VENDOR = 'ampae';

    public function __construct()
    {
        //$this->controller();
    }

    public function controller()
    {
        global $controller, $model, $appRequest, $appController, $tmpGlobalConfig;

        $tmpEvent     = TMP_EVENT;
        $tmpMethod    = TMP_METHOD; // DEFAULT CLASS METHOD !!!

        $tmpC = 0;
        if (!empty($controller->argc) && $controller->argc >= 1) {
            $tmpC = $controller->argc;
        }

        if ($tmpC > 0) {
            $tmpEvent = $controller->argv[0];
        }

        if ($tmpC > 1) {
            $tmpMethod = $controller->argv[1];
        }

        $tmpCmethod = strtolower($controller->method);

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
*/
          if (isset($tmpGlobalConfig['mvc'][$tmpEvent][$tmpCmethod])) {
            $tmpFireControllerMethod = true;
          }

        } else {
          $tmpRealEvent = TMP_EVENT;

          //$tmpPack      = DEF_PACK;
          $tmpRealMethod    = TMP_METHOD; // DEFAULT CLASS METHOD !!!

          //$tmpFireController = true;
          $tmpFireControllerMethod = true;
        }


        if (isset($tmpGlobalConfig['mvc'][$tmpRealEvent][$tmpCmethod])) {
          $tmpVendor  = $tmpGlobalConfig['mvc'][$tmpRealEvent][$tmpCmethod]['vendor'];
          $tmpPack    = $tmpGlobalConfig['mvc'][$tmpRealEvent][$tmpCmethod]['pack'];
          $tmpVendorPath = DIR_APP.DIRECTORY_SEPARATOR.$tmpVendor.DIRECTORY_SEPARATOR;
          $tmpPt = $tmpVendorPath.DIR_PACKS.DIRECTORY_SEPARATOR.$tmpPack.DIRECTORY_SEPARATOR.$tmpCmethod.DIRECTORY_SEPARATOR;
          $tmpNs = ucfirst($tmpVendor).'\\'.ucfirst($tmpCmethod).'\\';
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
        $model->appinfo['app'] = $tmpRealEvent;
        $model->appinfo['app_mtd'] = $tmpRealMethod;
    }

    public function model()
    {
        global $controller, $model, $state, $appRequest, $appController, $appView, $appModel, $tmpGlobalConfig, $theme;

        $tmpRealEvent = $model->appinfo['app'];
        $tmpMethod    = $model->appinfo['app_mtd'];

        $tmpMeMe = 'request';
        $tmpFireMe = true;
        if (isset($tmpGlobalConfig['mvc'][$tmpRealEvent])) {
          if (!isset($tmpGlobalConfig['mvc'][$tmpRealEvent][$tmpMeMe])) {
            $tmpFireMe = false;
          }
        }

        if ($tmpFireMe) {

//            if (isset($tmpGlobalConfig['mvc'][$tmpRealEvent]['model'])) {
                $tmpVendor  = $tmpGlobalConfig['mvc'][$tmpRealEvent]['request']['vendor'];
                $tmpPack    = $tmpGlobalConfig['mvc'][$tmpRealEvent]['request']['pack'];
//            }

            $tmpVendorPath = DIR_APP.DIRECTORY_SEPARATOR.$tmpVendor.DIRECTORY_SEPARATOR;

            $tmpPt = $tmpVendorPath.DIR_PACKS.DIRECTORY_SEPARATOR.$tmpPack.DIRECTORY_SEPARATOR.'request'.DIRECTORY_SEPARATOR;
            $tmpNs = ucfirst($tmpVendor).'\\'.ucfirst('request').'\\';

            $tmpGlobalConfig['autoload']['main']['psr-4'][$tmpNs] = $tmpPt;
            $tmpCls = '\\'.$tmpNs.ucfirst($tmpRealEvent);

            if (class_exists($tmpCls)) {
                $appRequest = new $tmpCls();
                if ($tmpMethod && method_exists($appRequest, $tmpMethod)) {
                    $appRequest->$tmpMethod();
                } else {
                    if (method_exists($appRequest, 'default')) {
                        $appRequest->default();
                    }
                }
            }

          }
    }

    public function view()
    {
        global $controller, $model, $state, $appRequest, $appController, $appView, $appModel, $tmpGlobalConfig, $theme;

        $tmpRealEvent = $model->appinfo['app'];
        $tmpMethod    = $model->appinfo['app_mtd'];

        $tmpMeMe = 'view';
        $tmpFireMe = true;
        if (isset($tmpGlobalConfig['mvc'][$tmpRealEvent])) {
          if (!isset($tmpGlobalConfig['mvc'][$tmpRealEvent][$tmpMeMe])) {
            $tmpFireMe = false;
          }
        }

        if ($tmpFireMe) {

//        if (isset($tmpGlobalConfig['mvc'][$tmpRealEvent]['view'])) {
            $tmpVendor  = $tmpGlobalConfig['mvc'][$tmpRealEvent]['view']['vendor'];
            $tmpPack    = $tmpGlobalConfig['mvc'][$tmpRealEvent]['view']['pack'];
//        }

            $tmpVendorPath = DIR_APP.DIRECTORY_SEPARATOR.$tmpVendor.DIRECTORY_SEPARATOR;

            $tmpPt = $tmpVendorPath.DIR_PACKS.DIRECTORY_SEPARATOR.$tmpPack.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR;
            $tmpNs = ucfirst($tmpVendor).'\\'.ucfirst('view').'\\';

            $tmpGlobalConfig['autoload']['main']['psr-4'][$tmpNs] = $tmpPt;
            $tmpCls = '\\'.$tmpNs.ucfirst($tmpRealEvent);

            if (class_exists($tmpCls)) {
                $appRequest = new $tmpCls();
                if ($tmpMethod && method_exists($appRequest, $tmpMethod)) {
                    $appRequest->$tmpMethod();
                } else {
                    if (method_exists($appRequest, 'default')) {
                        $appRequest->default();
                    }
                }
            }

        if ($model->appinfo['page_type']=='html') {

// --- load view aside ---
// $tmpViewExists = true; // ??? !!!
// --- Left (menu) ---
            $tmpView = 'view';
            $tmpPt = DIR_APP.DIRECTORY_SEPARATOR.$tmpVendor.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'aside'.DIRECTORY_SEPARATOR.'left';
            $tmpNs = ucwords($tmpVendor).'\\'.ucwords('view').'\\'.ucwords('aside').'\\'.ucwords('left').'\\';
            $tmpGlobalConfig['autoload']['main']['psr-4'][$tmpNs] = $tmpPt;

            $tmpCls = '\\'.$tmpNs.ucfirst($tmpView);

            if (class_exists($tmpCls)) {
                $appViewAsideLeft = new $tmpCls();
                if ($tmpMethod && method_exists($appViewAsideLeft, $tmpMethod)) {
                    $appViewAsideLeft->$tmpMethod();
                } else {
                    if (method_exists($appViewAsideLeft, 'default')) {
                        $appViewAsideLeft->default();
                    }
                }
/*
            } else {
              // tmpViewExists
                if ($state->get()) {
                  // !!! !!! !!!
                  //  $theme->asideleft(); // default menu
                }
*/                
            }

            // --- Right ---

            $tmpPt = DIR_APP.DIRECTORY_SEPARATOR.$tmpVendor.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'aside'.DIRECTORY_SEPARATOR.'right';
            $tmpNs = ucwords($tmpVendor).'\\'.ucwords('view').'\\'.ucwords('aside').'\\'.ucwords('right').'\\';
            $tmpGlobalConfig['autoload']['main']['psr-4'][$tmpNs] = $tmpPt;

            //$tmpView = $model->appinfo['app'];

            $tmpCls = '\\'.$tmpNs.ucfirst($tmpView);

            if (class_exists($tmpCls)) {
                $appViewAsideRight = new $tmpCls();
                if ($tmpMethod && method_exists($appViewAsideRight, $tmpMethod)) {
                    $appViewAsideRight->$tmpMethod();
                } else {
                    if (method_exists($appViewAsideRight, 'default')) {
                        $appViewAsideRight->default();
                    }
                }
            } else {
            }
        }
        // ---


//print_r($model->appinfo); // !!! fix this
    }

  }

};

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
 * @version    GIT: <7.1.1>
 * @category   SaaS RAD LAMP FrameWork.
 * @see        https://ampae.com/chinatown/
 * @author     AMPAE <info@ampae.com>
 * @license    https://ampae.com/chinatown/LICENSE
 * @copyright  2009 - 2020 AMPAE
**/

namespace Ampae\Lib;

class Events
{
    /**
     * constructor.
     */
    public function __construct()
    {
    }

    public function view2()
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

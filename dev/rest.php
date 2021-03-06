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

class Rest
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
        global $logger, $controller, $model, $auth, $appRequest, $appController;
        global $appView, $appModel, $tmpGlobalConfig, $theme;

        $tmpEvent     = TMP_EVENT_HOME;
        $tmpMethod    = TMP_METHOD; // DEFAULT CLASS METHOD !!!

        $tmpC = 0;
        if (!empty($controller->argc) && $controller->argc >= 1) {
            $tmpEvent     = TMP_EVENT_HOME; // 404 !!!
            $tmpC = $controller->argc;
        }

        if ($tmpC > 0) {
            $tmpEvent = $controller->argv[0];
        }

        if ($tmpC > 1) {
            $tmpMethod = $controller->argv[1];
        }

        $tmpCmethod = strtolower($controller->method);
        $tmpFireControllerMethod = false;
        $tmpFireMe = false;

        //$tmpFireController = false;
        //$tmpPack      = DEF_PACK;

        if (isset($tmpGlobalConfig['mvc'][$tmpEvent])) {
            $tmpRealEvent = $tmpEvent;
            $tmpRealMethod = $tmpMethod;

            // $model->appinfo['app_real_event'] = $tmpEvent;

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
            $tmpRealMethod    = TMP_METHOD; // DEFAULT CLASS METHOD !!!
            //$tmpFireController = true;
            //$tmpFireControllerMethod = true;
        }

        $model->appinfo['app'] = $tmpRealEvent;
        $model->appinfo['app_mtd'] = $tmpRealMethod;

        //print_r($tmpGlobalConfig['mvc']);
        //echo $tmpRealEvent.' = '.$tmpRealMethod;

        if (isset($tmpGlobalConfig['mvc'][$tmpRealEvent])) {
            $model->appinfo['curr_vendor'] = $tmpGlobalConfig['mvc'][$tmpRealEvent][$tmpCmethod]['vendor'];
            $model->appinfo['curr_pack'] = $tmpGlobalConfig['mvc'][$tmpRealEvent][$tmpCmethod]['pack'];
            $logger->debug('CURRENT: '.$model->appinfo['curr_vendor'].'/'.$model->appinfo['curr_pack']);
            $tmpFireMe = true;
        }

        //print_r($model->appinfo);
        //echo $tmpGlobalConfig['mvc'][$tmpRealEvent][DIR_REST].' --';

        if ($tmpFireMe) {

//            if (isset($tmpGlobalConfig['mvc'][$tmpRealEvent]['model'])) {
            //$tmpVendor  = $tmpGlobalConfig['mvc'][$tmpRealEvent]['vendor'];
            //$tmpPack    = $tmpGlobalConfig['mvc'][$tmpRealEvent]['pack'];
//            }

            $tmpVendor  = $tmpGlobalConfig['mvc'][$tmpRealEvent][$tmpCmethod]['vendor'];
            $tmpPack    = $tmpGlobalConfig['mvc'][$tmpRealEvent][$tmpCmethod]['pack'];

            $tmpVendorPath = DIR_APP.DIRECTORY_SEPARATOR.$tmpVendor.DIRECTORY_SEPARATOR;

            //$tmpPt = $tmpVendorPath.DIR_PACKS.DIRECTORY_SEPARATOR.$tmpPack.DIRECTORY_SEPARATOR.DIR_REST.DIRECTORY_SEPARATOR;
            //$tmpNs = ucfirst($tmpVendor).'\\'.ucfirst('rest').'\\';

            $tmpPt = $tmpVendorPath.DIR_PACKS.DIRECTORY_SEPARATOR.$tmpPack.DIRECTORY_SEPARATOR.DIR_REST.DIRECTORY_SEPARATOR.$tmpCmethod.DIRECTORY_SEPARATOR;
            $tmpNs = ucfirst($tmpVendor).'\\'.ucfirst($tmpCmethod).'\\';

            $tmpGlobalConfig['autoload']['main']['psr-4'][$tmpNs] = $tmpPt;
            $tmpCls = '\\'.$tmpNs.ucfirst($tmpRealEvent);

            //echo $tmpCls.' ==';

            if (class_exists($tmpCls)) {
                $appRequest = new $tmpCls();
                if ($tmpRealMethod && method_exists($appRequest, $tmpRealMethod)) {
                    $appRequest->$tmpRealMethod();
                    $logger->debug('REST: '.$tmpRealMethod);
                } else {
                    if (method_exists($appRequest, 'default')) {
                        $appRequest->default();
                        $logger->debug('EVENT: Default');
                    }
                }
            }
        }
    }
}

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
        global $logger, $controller, $model, $state;
        global $appRequest, $appRequestR, $tmpGlobalConfig;

        $tmpEvent           = TMP_EVENT_HOME;
        $tmpClassRealMethod = TMP_METHOD; // DEFAULT CLASS METHOD !!!

        $tmpC = 0;
        if (!empty($controller->argc) && $controller->argc >= 1) {
            $tmpEvent     = TMP_EVENT_HOME; // 404 !!!
            $tmpC = $controller->argc;
        }

        if ($tmpC > 0) {
            $tmpEvent = $controller->argv[0];
        }

        if ($tmpC > 1) {
            $tmpClassRealMethod = $controller->argv[1];
        }

        $serverRequestMethod = strtolower($controller->method);
        $tmpFireMe = false;

        if (isset($tmpGlobalConfig['mvc'][$tmpEvent])) {
            $tmpRealEvent = $tmpEvent;
            $tmpClassMethod = $tmpClassRealMethod;
        } else {
            $tmpRealEvent = TMP_EVENT_HOME;
            $tmpClassMethod    = TMP_METHOD; // DEFAULT CLASS METHOD !!!
        }

        $model->appinfo['app'] = $tmpRealEvent;
        $model->appinfo['app_mtd'] = $tmpClassMethod;

        $model->appinfo['rest_vendor'] = null;
        $model->appinfo['rest_pack'] = null;

        if (isset($tmpGlobalConfig['mvc'][$tmpRealEvent])) {
            $tmpMvcPreIndex = $tmpGlobalConfig['rest'];
            foreach ($tmpMvcPreIndex as $tmpMvcPreIndexTmp) {
                if (isset($tmpGlobalConfig['mvc'][$tmpRealEvent][$tmpMvcPreIndexTmp])) {
                    $model->appinfo['rest_vendor'] = $tmpGlobalConfig['mvc'][$tmpRealEvent][$tmpMvcPreIndexTmp]['vendor'];
                    $model->appinfo['rest_pack'] = $tmpGlobalConfig['mvc'][$tmpRealEvent][$tmpMvcPreIndexTmp]['pack'];
                }
            }

            if ($serverRequestMethod=='get' || $serverRequestMethod=='post') {
                $tmpCls = $this->prepare($tmpRealEvent, $serverRequestMethod);
                $this->load($tmpCls, $tmpClassMethod);
            }

            $tmpCls = $this->prepare($tmpRealEvent, 'request');
            $this->load($tmpCls, $tmpClassMethod);
        }
    }

    private function prepare($tmpRealEvent, $serverRequestMethod)
    {
        global $tmpGlobalConfig;

        if (!isset($tmpGlobalConfig['mvc'][$tmpRealEvent][$serverRequestMethod])) {
            return;
        }
        $tmpVendor  = $tmpGlobalConfig['mvc'][$tmpRealEvent][$serverRequestMethod]['vendor'];
        $tmpPack    = $tmpGlobalConfig['mvc'][$tmpRealEvent][$serverRequestMethod]['pack'];
        $tmpVendorPath = DIR_APP.DIRECTORY_SEPARATOR.$tmpVendor.DIRECTORY_SEPARATOR;
        $tmpPt = $tmpVendorPath.DIR_PACKS.DIRECTORY_SEPARATOR.$tmpPack.DIRECTORY_SEPARATOR.DIR_REST.DIRECTORY_SEPARATOR.$serverRequestMethod.DIRECTORY_SEPARATOR;
        if ($serverRequestMethod=='request') {
            $tmpPt = $tmpVendorPath.DIR_PACKS.DIRECTORY_SEPARATOR.$tmpPack.DIRECTORY_SEPARATOR.DIR_REST.DIRECTORY_SEPARATOR;
        }
        $tmpNs = ucfirst($tmpVendor).'\\'.ucfirst($serverRequestMethod).'\\';
        $tmpGlobalConfig['autoload']['main']['psr-4'][$tmpNs] = $tmpPt;
        $tmpCls = '\\'.$tmpNs.ucfirst($tmpRealEvent);

        return $tmpCls;
    }

    public function load($tmpCls, $tmpClassMethod)
    {
        global $logger;
        if (class_exists($tmpCls)) {
            $appRequest = lcfirst(stripslashes($tmpCls));

            global $$appRequest;

            $$appRequest = new $tmpCls();
            if ($tmpClassMethod && method_exists($$appRequest, $tmpClassMethod)) {
                $$appRequest->$tmpClassMethod();
            } else {
                if (method_exists($$appRequest, 'default')) {
                    $$appRequest->default();
                }
            }
            $logger->debug('REST:EVENT CLASS INSTANCE ACTIVATED: $'.$appRequest);
        }
    }
}

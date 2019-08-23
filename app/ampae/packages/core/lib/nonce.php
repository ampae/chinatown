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

class Nonce
{
    public function __construct()
    {
        global $controller, $session, $model;

        $nonceParams = null;
        if (isset($controller->params['nonce'])) {
            $nonceParams = $controller->params['nonce'];
        }

        if ($controller->method=='POST' && isset($controller->post['nonce']) && $nonceParams===null) {
            $nonceParams = $controller->post['nonce'];
        }

        if ($nonceParams) {
            $nonceSession = $session->getOnce('nonce');

            if ($nonceParams == $nonceSession) {
                $model->appinfo['nonce'] = $nonceSession;
            } else {
                if (isset($model->appinfo['nonce'])) {
                    unset($model->appinfo['nonce']);
                }
                if (NONCE_WRONG_EXIT) {
                    exit;
                }
            }
        }
    }

    /**
     * gen nonce value; form security.
     */
    public function gen()
    {
        global $session;

        $nonce = md5(uniqid(rand(1112111, 9998999), true));
        $session->set('nonce', $nonce);

        return $nonce;
    }
}

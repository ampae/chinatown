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

class View
{
    /**
     * constructor;.
     */
    public function __construct()
    {
        //global $alerts,$local,$view,$theme;
    }

    public function __destruct()
    {
        //global $alerts,$local,$view,$theme;
    }

    public function headers()
    {
        global $http;
        $this->prepareHeaders();
        $http->sendHeaders();
    }

    public function prepareHeaders()
    {
        global $model, $content;
        if (!isset($model->redirect)) {
            if (isset($model->appinfo['page_type']) && 'com' == $model->appinfo['page_type']) {
                // ok, we can log here !!!
              exit; // it's a com page, silently exiting before headers set or sent
            }
            if (isset($model->appinfo['page_type']) && 'jpeg' == $model->appinfo['page_type']) {
                // ok, we can log here !!!
            }
            if (!isset($model->appinfo['page_type'])) {
                $model->appinfo['page_type'] = DEFAULT_PAGE_TYPE; // works for both html & json
            }

            $model->appinfo['full_content_type'] = $this->prepare($model->appinfo['page_type']);
        }
    }

    // --- PRIVATE ---

    private function prepare($pageType)
    {
        global $model, $controller;

        // $this->setTz();

        // - set content_type & tmpl based on page_type
        switch ($pageType) {
            case 'html':
                $tmpContentType = 'text/html';
                break;
            case 'json':
                $tmpContentType = 'text/json';
                break;
            case 'jpeg':
                $tmpContentType = 'image/jpeg';
                break;
            case 'png':
                $tmpContentType = 'image/png';
                break;
            default:
                $tmpContentType = 'text/'.DEFAULT_PAGE_TYPE; // !!!
                break;
        }
        if (!isset($model->appinfo['charset'])) {
            $model->appinfo['charset'] = DEFAULT_CHARSET;
        }
        return $tmpContentType.'; charset='.$model->appinfo['charset'];
    }

};

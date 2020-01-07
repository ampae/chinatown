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


class Http
{
    /**
     * constructor;.
     */
    public function __construct()
    {
        $this->prepareHeaders();
        $this->sendHeaders();
    }

    public function prepareHeaders()
    {
        global $controller, $model, $content, $html;

        if (!isset($model->redirect)) {
          if (!isset($model->appinfo['page_type'])) {
            if ($controller->method == 'POST') {
              $tmpPageType = DEFAULT_PAGE_TYPE_POST;
            } else {
              $tmpPageType = DEFAULT_PAGE_TYPE_GET;
            }
              $model->appinfo['page_type'] = $tmpPageType;
          }

            if ('com' != $model->appinfo['page_type']) {
              $model->appinfo['full_content_type'] = $this->prepare($tmpRes = $model->appinfo['page_type']);
            }
        }
    }

    // --- PRIVATE ---

    private function prepare($pageType)
    {
        global $model, $controller;

        $tmpContentType = NULL;

        switch ($pageType) {
            case 'html':
                $tmpContentType = 'text/html';
                break;
            case 'json':
                $tmpContentType = 'application/json';
                break;
            case 'jpeg':
                $tmpContentType = 'image/jpeg';
                break;
            case 'png':
                $tmpContentType = 'image/png';
                break;
        }
        if (!isset($model->appinfo['charset'])) {
            $model->appinfo['charset'] = DEFAULT_CHARSET;
        }
        if ($tmpContentType) {
          $tmpContentType = $tmpContentType.'; charset='.$model->appinfo['charset'];
        }
        return $tmpContentType;
    }


    /**
     * send headers;.
     */
    public function sendHeaders()
    {
        global $model,$logger;

        /*
         * executing redirect, there is nothing to process if redirect has been set
         */
        if (isset($model->redirect)) {
            $logger->debug('Redirecting to '.$model->redirect);
            header('Location: '.$model->redirect);
            exit;
        }

        if ('com' == $model->appinfo['page_type']) {
          exit; // com exit before header send!
        }

        header('Pragma: no-cache');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);

        // header ( 'Date: ' . gmdate( 'D, d M Y H:i:s', strtotime(PGDT)) . ' GMT' ); // set to GMT

        if (isset($model->appinfo['full_content_type'])) {
          header('Content-Type: '.$model->appinfo['full_content_type']);  // MIME content type
        }
    }
}

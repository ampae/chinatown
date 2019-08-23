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


class Http
{
    /**
     * constructor;.
     */
    public function __construct()
    {
    }

    /**
     * send headers;.
     */
    public function sendHeaders()
    {
        global $model;
        /*
         * executing redirect, there is nothing to process if redirect has been set
         */
        if (isset($model->redirect)) {
            header('Location: '.$model->redirect);
            exit;
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

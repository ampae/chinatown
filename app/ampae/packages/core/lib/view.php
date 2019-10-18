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


//---

    public function theme()
    {
        global $model, $http, $local;
        if ($model->appinfo['page_type']=='html') {
            $this->loadTheme();
        }
    }

    public function loadTheme()
    {
        global $tmpGlobalConfig, $model, $theme, $logger, $local, $sign, $state;

        $tmpThemesNs = ucfirst($model->appinfo['theme_vendor']).'\\'.ucfirst('themes').'\\'; // 'Vendor\\Theme\\';
        $tmpRealThemePath = DIR_APP.DIRECTORY_SEPARATOR.$model->appinfo['theme_vendor'].DIRECTORY_SEPARATOR.DIR_THEMES.DIRECTORY_SEPARATOR.$model->appinfo['theme_directory']; //DIR_THEMES.DIRECTORY_SEPARATOR.$model->appinfo['theme_vendor'].DIRECTORY_SEPARATOR.$model->appinfo['theme_directory'];
        $tmpGlobalConfig['autoload']['main']['psr-4'][$tmpThemesNs] = $tmpRealThemePath;

        $tmp_themes = '\\'.$tmpThemesNs.ucfirst('theme');
        $theme = new $tmp_themes();

        // $logger->info('VIEW / THEME - '.$tmp_themes);
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






//---






    public function menus()
    {
        global $office, $tmpGlobalConfig;
        /*
        foreach ($tmpGlobalConfig['vendor'] as $tmpVendor) {
          foreach ($tmpGlobalConfig['packages'][$tmpVendor] as $tmpPack) {
            include DIR_APP.DIRECTORY_SEPARATOR.$tmpVendor.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'menus.php';
          }
        }
        */
        if (!$office->is()) {
            $tmpGlobalConfig['menu']['side']['user']['2990'] = '';
            $tmpGlobalConfig['menu']['side']['office'] = array(); // not really needed, just an extra precaution..
        }
    }
    /**
     * load sidebar.
     */
    public function aside($path)
    {
        global $model;
        if (isset($path)) {
            $model->load($path);
        }
    }

    public function open()
    {
        global $model;
        if ($model->appinfo['page_type']=='html') {
            $headerFile = ABSPATH.$model->appinfo['theme_path'].DIRECTORY_SEPARATOR.'header.php';
            $model->load($headerFile);
        }
    }

    public function close()
    {
        global $model;
        if ($model->appinfo['page_type']=='html') {
            $footerFile = ABSPATH.$model->appinfo['theme_path'].DIRECTORY_SEPARATOR.'footer.php';
            $model->load($footerFile);
        }
    }

    // --- ex xTheme ---

    public function addTitle($title)
    {
        global $model;
        $model->appinfo['title'] = $title;
    }

    public function getTitle()
    {
        global $model, $options;
        if (!isset($model->appinfo['title'])) {
            $model->appinfo['title'] = DEFAULT_TITLE;
        }
        return $model->appinfo['title'];
    }

    /**
     * add meta tag; marked for depreciation;.
     *
     * @param string $k config
     * @param string $v config
     */
    public function addMeta($k, $v)
    {
        global $model;
        $model->results['EX']['META'][] = '<meta name="'.$k.'" content="'.$v.'" />';
    }



    // -- scripts ---
    public function addScript($level, $val)
    {
        global $model;
        $model->results['EX']['SCRIPT'][$level][] = $val;
    }

    public function addSmallScript($level, $val)
    {
        global $model;
        $model->results['EX']['SCRIPT_SMALL'][$level][] = $val;
    }

    // -- styles ---
    public function addStyle($val)
    {
        global $model;
        $model->results['EX']['STYLE'][] = $val;
    }

    public function addSmallStyle($val)
    {
        global $model;
        $model->results['EX']['STYLE_SMALL'][] = $val;
    }




};

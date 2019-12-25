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
     * constructor.
     */
    public function __construct()
    {
        global $model,$alerts,$local; //$state,$view
        if ($model->appinfo['page_type']=='html') {
            $this->loadTheme();
            $this->open();
        }
        $this->raw();
        //$this->close();
    }

    public function __destruct()
    {
        global $model,$alerts,$local;
        if ($model->appinfo['page_type']=='html') {
            $this->close();
        }
    }

    public function loadTheme()
    {
        global $tmpGlobalConfig, $model, $theme, $logger, $local, $sign, $html, $state;
        $tmpThemesNs = ucfirst($model->appinfo['theme_vendor']).'\\'.ucfirst('themes').'\\'; // 'Vendor\\Theme\\';
        $tmpRealThemePath = DIR_APP.DIRECTORY_SEPARATOR.$model->appinfo['theme_vendor'].DIRECTORY_SEPARATOR.DIR_THEMES.DIRECTORY_SEPARATOR.$model->appinfo['theme_directory']; //DIR_THEMES.DIRECTORY_SEPARATOR.$model->appinfo['theme_vendor'].DIRECTORY_SEPARATOR.$model->appinfo['theme_directory'];
        $tmpGlobalConfig['autoload']['main']['psr-4'][$tmpThemesNs] = $tmpRealThemePath;

        $tmp_themes = '\\'.$tmpThemesNs.ucfirst('theme');
        $theme = new $tmp_themes();
        $logger->debug('VIEW / THEME - '.$tmp_themes);
    }

    public function open()
    {
        global $model,$io;
        if ($model->appinfo['page_type']=='html') {
            $headerFile = $model->appinfo['theme_path'].DIRECTORY_SEPARATOR.'header.php';
            $io->load($headerFile);
        }
    }

    public function close()
    {
        global $model,$io;
        if ($model->appinfo['page_type']=='html') {
            $footerFile = $model->appinfo['theme_path'].DIRECTORY_SEPARATOR.'footer.php';
            $io->load($footerFile);
        }
    }

    public function raw($pos = 'html-main')
    {
        global $model,$shortcode;
        echo $model->getTmpl();
        echo $shortcode->do($model->get($pos));
    }
}

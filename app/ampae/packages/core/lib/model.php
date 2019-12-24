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

class Model
{
    public $results   = array(); // Used to store results generated by Models
    public $config    = array(); // Used to store configuration data
    public $appinfo   = array(); // Used to store application info
    public $redirect  = null;

    /**
     * constructor.
     */
    public function __construct()
    {
        global $controller;
//        $this->appinfo['domain'] = $controller->info['domain'];
        $this->appinfo['url'] = $controller->info['url'];
        if ($controller->argc > APP_URL_MAX_LEVEL) {
            $this->redirect = $this->appinfo['url'];
        } else {
            $this->getTheme();
        }
    }

    public function getTheme()
    {
        //TODO: to database !!!
        $this->appinfo['theme_vendor']      = DEF_VENDOR;
        $this->appinfo['theme_directory']   = DEF_THEME;
        $this->appinfo['theme_path']        = DIR_APP.DIRECTORY_SEPARATOR.$this->appinfo['theme_vendor'].DIRECTORY_SEPARATOR.DIR_THEMES.DIRECTORY_SEPARATOR.$this->appinfo['theme_directory'];
        $this->appinfo['theme_webpath']     = DIR_APP.'/'.$this->appinfo['theme_vendor'].'/'.DIR_THEMES.'/'.$this->appinfo['theme_directory'];
    }

    public function addExtContent($file, $pos = 'main')
    {
        $this->results['raw-file'][$pos][]=$file;
    }

    public function getExtContent($pos = 'main')
    {
        global $io;
        $allowed = ALLOWED_HTML; // view config !
        $ret = null;
        if (isset($this->results['raw-file'][$pos])) {
            foreach ($this->results['raw-file'][$pos] as $tmp) {
                $tmp2 = strip_tags($io->loadRaw($tmp), $allowed);
                //$ret = strip_tags($ret, $allowed);
                //$ret = htmlentities($ret, ENT_QUOTES, 'UTF-8');
                $ret.= $tmp2;
            }
        }
        return $ret;
    }

    // TODO 1. add raw to config, 2 add raw file ext to config. !!!
    public function getRawPath($file)
    {
        $ret = DIR_APP.DIRECTORY_SEPARATOR.$this->appinfo['curr_vendor'].DIRECTORY_SEPARATOR.DIR_PACKS.DIRECTORY_SEPARATOR.$this->appinfo['curr_pack'].DIRECTORY_SEPARATOR.'raw'.DIRECTORY_SEPARATOR.$file.'.txt';
        return $ret;
    }

    /**
     * Set data to eXchange; allows multiple keys
     * Usage: $model->add( KEY, VALUE );
     * Get: $value = $model->results[KEY];.
     *
     * @param string $k config
     * @param string $v config
     */
    public function add($k, $v)
    {
        $this->results[$k][] = $v;
    }

    public function get($k)
    {
        $res = null;
        if ($this->results[$k]) {
            foreach ($this->results[$k] as $tmp) {
                $res.= $tmp;
            }
        }
        return $res;
    }
}

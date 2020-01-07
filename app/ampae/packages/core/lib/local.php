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

class Local
{
    public $lang = array();
    public $data = array();

    //    Constructor; define class parameters
    public function __construct()
    {
        $this->go();
    }

    public function go()
    {
        global $model;
        $ct_lng = $this->getUsrLocale();
        $this->load($ct_lng);
        $model->appinfo['language'] = $ct_lng;
        $model->appinfo['text_direction'] = $this->getData('lang_dir');
    }

    /**
     * attempt to translate slog.
     *
     * @param string $word config
     */
    public function translate($word)
    {
        $res = $word;
        if (!empty($this->lang[$word])) {
            $res = $this->lang[$word];
        }
        return $res;
    }

    private function getUsrLocale()
    {
        $browser_lang = !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtok(strip_tags($_SERVER['HTTP_ACCEPT_LANGUAGE']), ',') : '';
        //$browser_lang = 'nl'; // easy way to test different locale
        return $browser_lang;
    }

    /**
     * attempt to get lang data.
     *
     * @param string $lang config
     * @param string $k    config
     *
     * @return string
     */
    private function getData($k)
    {
        $res = $k;
        if (!empty($this->data[$k])) {
            $res = $this->data[$k];
        }

        return $res;
    }

    private function load($ct_lng)
    {
        global $tmpGlobalConfig;

        $tmpArr = array();
        $err    = 0;

        foreach ($tmpGlobalConfig['vendor'] as $tmpVendor) {
            $tmpVendorPrePath = DIR_APP.DIRECTORY_SEPARATOR.$tmpVendor.DIRECTORY_SEPARATOR.'packages'.DIRECTORY_SEPARATOR;

            foreach ($tmpGlobalConfig['packages'][$tmpVendor] as $tmpPack) {
                $ct_tmp_def = $tmpVendorPrePath.$tmpPack.DIRECTORY_SEPARATOR.'loc'.DIRECTORY_SEPARATOR.DEFAULT_LANG.'.php';
                $ct_tmp_lpf = $tmpVendorPrePath.$tmpPack.DIRECTORY_SEPARATOR.'loc'.DIRECTORY_SEPARATOR.$ct_lng.'.php';


                if (file_exists($ct_tmp_lpf)) {
                    $tmpRes = readConfig($ct_tmp_lpf);
                } elseif (file_exists($ct_tmp_def)) {
                    $tmpRes = readConfig($ct_tmp_def);
                } else {
                    $err+=1;
                }
                if (!$err) {
                    $tmpArr = array_replace_recursive($tmpArr, $tmpRes);
                    $err = 0;
                }
            }
            $this->lang = $tmpArr['lang'];
            $this->data = $tmpArr['data'];
        }
    }
}

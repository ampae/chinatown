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

class Local
{
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
    public static function translate($word)
    {
        global $model;
        $res = $word;
        if (!empty($model->results['local']['lang'][$word])) {
            $res = $model->results['local']['lang'][$word];
        }
        return $res;
    }

    private function getUsrLocale()
    {
        global $model;

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
        global $model;
        $res = $k;
        if (!empty($model->results['local']['data'][$k])) {
            $res = $model->results['local']['data'][$k];
        }

        return $res;
    }

    private function load($ct_lng)
    {
        global $tmpGlobalConfig, $model;

        $model->results['local'] = array();
        $err = 0;

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
                  $model->results['local'] = array_replace_recursive($model->results['local'], $tmpRes);
                  $err = 0;
              }

          }

        }
    }
}

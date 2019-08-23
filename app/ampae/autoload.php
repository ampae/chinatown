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

if (!strcasecmp(basename($_SERVER['SCRIPT_NAME']), basename(__FILE__))) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

/**
 * PSR AutoLoad
 *
 * @package     ChinaTown
 * @category    Declaration
 * @author      V Bugroff <bugroff@protonmail.com>
 * @author      M Karodine <usr04@protonmail.com>
 * @see         NOTHING HERE
 *
 * @since       0.3.1
 * @deprecated  NO
**/

function ampae_autoload($tmp_config)
{
    global $tmpGlobalConfig;

    $ampae_arr = array();
    $ct_raw_config = file_get_contents($tmp_config);
    $ct_raw_config = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $ct_raw_config);
    $ct_raw_config = str_replace('\\', '\\\\', $ct_raw_config);
    $ct_raw_config = stripslashes($ct_raw_config);
    $ampae_arr = array_replace_recursive($ampae_arr, json_decode($ct_raw_config, true));
    //  $ampae_arr = json_decode($ct_raw_config, true);
  $ct_raw_config = ''; // cleaning up;
  return $ampae_arr;
}

function ampae_globrecursive($pattern)
{
    $flags = GLOB_ONLYDIR | GLOB_NOSORT;
    $files = glob($pattern, $flags);
    $dirs = glob(dirname($pattern).'/*', $flags);

    foreach ($dirs as $dir) {
        $files = array_merge($files, ampae_globrecursive($dir.'/'.basename($pattern), $flags));
    }

    return $files;
}
/*
 * PSR-4 AutoLoad
 */
spl_autoload_register(
    function ($class) {
        global $tmpGlobalConfig;
        $bns_class_prefix = substr($class, 0, strrpos($class, '\\'));
        if ('' === $bns_class_prefix) {
            return; // PSR require class prefix, moving on;
        }
        $bns_class_prefix .= '\\';

        $bns_class_rel_path = $tmpGlobalConfig['autoload']['main']['psr-4'][$bns_class_prefix];

        $bns_class_full_path = realpath(ABSPATH.$bns_class_rel_path);

        $bns_class_name = substr(strrchr($class, '\\'), 1);

        $bns_class_file = $bns_class_full_path.DIRECTORY_SEPARATOR.strtolower($bns_class_name).'.php';


        if (file_exists($bns_class_file)) {
            @include_once $bns_class_file;
        } else {
            $bns_class_file = $bns_class_full_path.DIRECTORY_SEPARATOR.$bns_class_name.'.php';
            @include_once $bns_class_file;
        }
    }
);

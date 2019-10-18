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
 * @version    HG: <7.1.1>
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
 * PHP main package file
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

$initialMemory = memory_get_usage();

$tmpGlobalConfig['instances']['success'] = array();
$tmpGlobalConfig['instances']['failure'] = array();
$tmpGlobalConfig['mvc'] = array();

// trying to load all libs around all packages
// also trying to prepare all mvc calls

// get all vendors
$tmpGlobalConfig['vendor'] = array_map( 'basename', glob(ABSPATH.DIR_APP.DIRECTORY_SEPARATOR.'*' , GLOB_ONLYDIR) );

// sort vendors
$tmpDefVendorKey = array_search(DEF_VENDOR, $tmpGlobalConfig['vendor']);
if (false !== $tmpDefVendorKey) {
    unset($tmpGlobalConfig['vendor'][$tmpDefVendorKey]);
}
$tmpGlobalConfig['vendor'] = array_values($tmpGlobalConfig['vendor']);
array_unshift($tmpGlobalConfig['vendor'] , DEF_VENDOR);

// loop all vendors
foreach ($tmpGlobalConfig['vendor'] as $tmpVendor) {
  $tmpVendorPath = DIR_APP.DIRECTORY_SEPARATOR.$tmpVendor.DIRECTORY_SEPARATOR;
  include $tmpVendorPath.'autoload.php';

  // get all vendors packages
  $tmpGlobalConfig['packages'][$tmpVendor] = array_map( 'basename', glob($tmpVendorPath.DIR_PACKS.DIRECTORY_SEPARATOR.'*' , GLOB_ONLYDIR) );

  // loop inside each vendor package
  foreach ($tmpGlobalConfig['packages'][$tmpVendor] as $tmpPack) {

    // premap mvc
    $tmpMvcPreIndex = $tmpGlobalConfig['mvcpm'];

    foreach ($tmpMvcPreIndex as $tmpMvcPreIndexTmp) {
      $tmpMvcPreMap = $tmpVendorPath.DIR_PACKS.DIRECTORY_SEPARATOR.$tmpPack.DIRECTORY_SEPARATOR.$tmpMvcPreIndexTmp.DIRECTORY_SEPARATOR;
      if ($tmpMvcPreIndexTmp=='get' || $tmpMvcPreIndexTmp=='post') {
        $tmpMvcPreMap = $tmpVendorPath.DIR_PACKS.DIRECTORY_SEPARATOR.$tmpPack.DIRECTORY_SEPARATOR.$tmpMvcPreIndexTmp.DIRECTORY_SEPARATOR;
      }
      $tmpMvcPreArr = array_map( 'basename', glob($tmpMvcPreMap.'*.php' , GLOB_BRACE) );
      $tmpMvcPreArr = array_map(function($e){return pathinfo($e, PATHINFO_FILENAME);},$tmpMvcPreArr);
      $tmpMvcPreRes = array_flip($tmpMvcPreArr);
      $tmpMvcPreRes = array_map(function(){global $tmpMvcPreIndexTmp,$tmpVendor,$tmpPack; return array($tmpMvcPreIndexTmp=>array('vendor'=>$tmpVendor,'pack'=>$tmpPack));}, $tmpMvcPreRes);
      $tmpGlobalConfig['mvc'] = array_merge_recursive($tmpGlobalConfig['mvc'],$tmpMvcPreRes);
    }
    // end premap mvc

    // dealing with libraries..
    $tmp_psr4_ns = ucfirst($tmpVendor).'\\'.ucfirst('lib').'\\';

    $tmp_psr4_pt = $tmpVendorPath.DIR_PACKS.DIRECTORY_SEPARATOR.$tmpPack.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR;
    $tmpGlobalConfig['autoload']['main']['psr-4'][$tmp_psr4_ns] = $tmp_psr4_pt;

    $tmpAutoDiscoveredLibs = array_map( 'basename', glob($tmp_psr4_pt.'*.php' , GLOB_BRACE) );

    $tmpAutoDiscoveredLibs = array_map(
      function($e) {
        return pathinfo($e, PATHINFO_FILENAME);
      }
    , $tmpAutoDiscoveredLibs);

    $tmpMyUglyTmp2 = $tmpVendorPath.DIR_PACKS.DIRECTORY_SEPARATOR.$tmpPack.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';
    if (file_exists($tmpMyUglyTmp2)) {
      $tmpGlobalConfig[DIR_LIB] = readConfig($tmpMyUglyTmp2);
    }
    if (isset($tmpGlobalConfig[DIR_LIB][$tmpVendor])) {
      $tmpClasses = $tmpGlobalConfig[DIR_LIB][$tmpVendor];
      foreach ($tmpAutoDiscoveredLibs as $keyTmp2 => $tmpLibsLibs) {
        if (!in_array($tmpLibsLibs, $tmpClasses)) {
          $tmpClasses[] = $tmpLibsLibs;
        }
      }
    } else {
      $tmpClasses = $tmpAutoDiscoveredLibs;
    }

    foreach ($tmpClasses as $tmpClass) {
        $tmp_psr4_cls = '\\'.$tmp_psr4_ns.ucfirst($tmpClass);
        $tmp_conf = $tmpVendorPath.DIR_PACKS.DIRECTORY_SEPARATOR.$tmpPack.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.$tmpClass.'.php';
        if (file_exists($tmp_conf)) {
            //include $tmp_conf;
            $tmpGlobalConfig[$tmpVendor][$tmpPack][$tmpClass] = readConfig($tmp_conf);
        }

        $tmpLoadStatus = 'failure';
        $tmpLogRes = $tmpClass;
        if ($tmpVendor!=DEF_VENDOR) {
          $tmpLogRes = $tmpVendor.'->'.$tmpPack.'->'.$tmpClass;
        }

        if (class_exists($tmp_psr4_cls)) {
            if ($tmpVendor==DEF_VENDOR) {
              $$tmpClass = new $tmp_psr4_cls();
            } else {
              if (!isset($$tmpVendor)) {
                $$tmpVendor = (object)array();
              }
              if (!isset($$tmpVendor->$tmpPack)) {
                $$tmpVendor->$tmpPack = (object)array();
              }
              $$tmpVendor->$tmpPack->$tmpClass = new $tmp_psr4_cls();
            }
            $tmpLoadStatus = 'success';
        }
        $tmpGlobalConfig['instances'][$tmpLoadStatus][] = $tmpLogRes;
    }
  }
}

foreach ($tmpGlobalConfig['instances']['success'] as $tmpSuccessLog) {
    $logger->debug('CLASS INSTANCE ACTIVATED: $'.$tmpSuccessLog.'');
}

if (isset($logger)) {
    $time_start = $logger->getMicrotime();
    $logger->info('MAIN - All libs are loaded; Starting..');
}

$mvc->controller();

$model->getTheme();

$local->go();
$mvc->model();

$view->headers();
//$view->menus();
$view->theme();
$mvc->view();

if (isset($logger)) {
    $finalMemory = memory_get_usage();
    $memUsage = ($finalMemory - $initialMemory)/1024;
    $time_end = $logger->getMicrotime();
    $time_res = number_format($time_end - $time_start, 4, ',', ' ');

    $logger->info('MAIN - All done in '.$time_res.' sec. '.number_format($memUsage, 2, ',', ' ')." KB of RAM used; Exiting..\n\r\n\r");
}

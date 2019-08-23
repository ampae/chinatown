<?php
/**
 * ChinaTown - RAD LAMP SaaS FrameWork.
 * Complete User Registration and Management. Secure, Fast, Small and Light.
 *
 * THIS CODE ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY KIND,
 * EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A PARTICULAR PURPOSE.
 *
 * PHP version 5.4
 *
 * @package     ChinaTown
 * @category    LAMP SaaS FrameWork
 * @see         https://ampae.com/chinatown/
 * @license     https://ampae.com/chinatown/license.txt
 * @version     HG: <7.1.1>
 * @author      AMPAE <info@ampae.com>
 * @copyright   2009 - 2019 AMPAE
**/

/**
 * index
 *
 * @category    Declaration
 * @author      V Bugroff <bugroff@protonmail.com>
 * @author      M Karodine <usr04@protonmail.com>
 * @since       0.1.1
 * @deprecated  NO
**/

/* Absolute path to the application directory. */
define('ABSPATH', __DIR__.DIRECTORY_SEPARATOR);

/* Default path to the main Application Configuration directory. */
define('DIR_CONFIG', 'config');

$tmpGlobalConfig = array();

include ABSPATH.DIR_CONFIG.DIRECTORY_SEPARATOR.'config.php';

/* Set Encoding. */
if (extension_loaded('mbstring')) {
  mb_internal_encoding(APP_ENCODING);
}

/*
 * Basic PHP environment setup
 *
 */
ini_set('magic_quotes_runtime', 'off');
ini_set('register_globals', 'off');
ini_set('memory_limit', '64M');
ini_set('max_execution_time', 300);
set_time_limit(0);

/*
 * Error display mode
 *
 */
if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}

if ( DEBUG_MODE && !in_array('mod_rewrite', apache_get_modules()) ) {
  die('Error: mod_rewrite required! Exiting.');
}

/**
 * Load main that does it all like load libraries and classes etc.
 */
include 'boot.php';

/*
 * All done, exiting
 *
 */
exit(0);

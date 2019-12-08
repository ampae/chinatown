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
 * @package     CT_CORE
 * @category    Declaration
 * @author      V Bugroff <bugroff@protonmail.com>
 * @author      M Karodine <usr04@protonmail.com>
 *
 * @since       0.1.1
**/

/* Absolute path to the application directory. */
define('ABSPATH', __DIR__.DIRECTORY_SEPARATOR);

define('DIR_CONFIG', 'config');
define('DIR_LIBS', 'libs');

include ABSPATH.DIR_LIBS.DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR.'functions.php';

$tmpConfigFile = ABSPATH.DIR_CONFIG.DIRECTORY_SEPARATOR.'config.php';

$tmpGlobalConfig = readConfig($tmpConfigFile);

/* Set Encoding. */
if (extension_loaded('mbstring')) {
    mb_internal_encoding(APP_ENCODING);
}

/* Error display mode */
if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    set_time_limit(30);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
    set_time_limit(0);
}

/* Load main that does it all like load libraries and classes etc. */
include 'core.php';

/* All done, exiting */
exit(0);

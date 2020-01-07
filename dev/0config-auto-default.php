<?php
/**
 * ChinaTown - RAD LAMP SaaS FrameWork.
 * Complete User Registration and Management. Secure, Fast, Small and Light.
 *
 * THIS CODE ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY KIND,
 * EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A PARTICULAR PURPOSE.
 *
 * PHP version 7.2
 *
 * @package     ChinaTown
 * @category    LAMP SaaS FrameWork
 * @see         https://ampae.com/chinatown/
 * @license     https://ampae.com/chinatown/LICENSE
 * @version     HG: <5.1.1>
 * @author      AMPAE <info@ampae.com>
 * @copyright   2009 - 2019 AMPAE
**/

/**
 * Default base configuration used for fail-safe.
 *
 * @category    Declaration
 * @author      V Bugroff <bugroff@protonmail.com>
 * @author      M Karodine <usr04@protonmail.com>
 * @since       0.1.1
 * @deprecated  NO
**/
define('CCID', 'ct709a3f1111');

$tmpGlobalConfig['db'] = array(
  'dbhost' => 'localhost',
  'dbname' => 'ct',
  'dbuser' => 'root',
  'dbpass' => '',
  'dbprefix' => 'ct_',
  'email' => 'admin@example.com',
);

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
 * @version     HG: <5.1.1>
 * @author      AMPAE <info@ampae.com>
 * @copyright   2009 - 2019 AMPAE
**/

/**
 * PHP File
 *
 * @category    Declaration
 * @author      V Bugroff <bugroff@protonmail.com>
 * @author      M Karodine <usr04@protonmail.com>
 * @since       0.1.1
 * @deprecated  NO
**/

if (!strcasecmp(basename($_SERVER['SCRIPT_NAME']), basename(__FILE__))) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

$timezones = array(
    'US/Samoa'             => "(GMT-11:00 US Samoa, Midway Island)",
    'US/Hawaii'            => "(GMT-10:00) US Hawaii, FR Polynesia",
    'US/Alaska'            => "(GMT-09:00) US Alaska",
    'US/Pacific'           => "(GMT-08:00) US Pacific Time",
    'US/Mountain'          => "(GMT-07:00) US Mountain Time",
    'US/Central'           => "(GMT-06:00) US Central Time, Mexico City",
    'US/Eastern'           => "(GMT-05:00) US Eastern Time, Bogota, Lima",
    'Canada/Atlantic'      => "(GMT-04:00) CA Atlantic Time, Santiago, La Paz",
    'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
    'Atlantic/Stanley'     => "(GMT-02:00) Mid-Atlantic, St. Helena",
    'Atlantic/Azores'      => "(GMT-01:00) Azores, Cape Verde Islands",
    'Europe/London'        => "(GMT) Dublin, London, Lisbon",
    'Europe/Brussels'      => "(GMT+01:00) Amsterdam, Berlin, Brussels, Copenhagen, Madrid, Paris",
    'Europe/Athens'        => "(GMT+02:00) Athens",
    'Asia/Kuwait'          => "(GMT+03:00) Kuwait",
    'Europe/Moscow'        => "(GMT+04:00) Moscow",
    'Asia/Karachi'         => "(GMT+05:00) Karachi",
    'Asia/Dhaka'           => "(GMT+06:00) Dhaka",
    'Asia/Bangkok'         => "(GMT+07:00) Bangkok, Jakarta, Phnom Penh",
    'Asia/Hong_Kong'       => "(GMT+08:00) Hong_Kong, Kuala Lumpur, Singapore, Perch ",
    'Asia/Tokyo'           => "(GMT+09:00) Tokyo, Seoul, Taipei",
    'Australia/Sydney'     => "(GMT+10:00) Sydney",
    'Asia/Vladivostok'     => "(GMT+11:00) Vladivostok",
    'Pacific/Auckland'     => "(GMT+12:00) Auckland, Fiji",
);

$timezones_fb = array(
    '-11' => 'US/Samoa',
    '-10' => 'US/Hawaii',
    '-9' => 'US/Alaska',
    '-8' => 'US/Pacific',
    '-7' => 'US/Mountain',
    '-6' => 'US/Central',
    '-5' => 'US/Eastern',
    '-4' => 'Canada/Atlantic',
    '-3' => 'America/Buenos_Aires',
    '-2' => 'Atlantic/Stanley',
    '-1' => 'Atlantic/Azores',
    '0' => 'Europe/London',
    '1' => 'Europe/Brussels',
    '2' => 'Europe/Athens',
    '3' => 'Asia/Kuwait',
    '4' => 'Europe/Moscow',
    '5' => 'Asia/Karachi',
    '6' => 'Asia/Dhaka',
    '7' => 'Asia/Bangkok',
    '8' => 'Asia/Hong_Kong',
    '9' => 'Asia/Tokyo',
    '10' => 'Australia/Sydney',
    '11' => 'Asia/Vladivostok',
    '12' => 'Pacific/Auckland',
);

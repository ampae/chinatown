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

global $tmpGlobalConfig;

$tmpGlobalConfig['menu']['side']['all'] = array(
  '1110' => array('#','dashboard','fas fa-tachometer-alt'),
);

$tmpGlobalConfig['menu']['side']['user'] = array(
  '2120' => array('activity','activity','fas fa-hiking'),
  '2990' => 'User',

  '3630' => array('media','media','fas fa-compact-disc'),
/*
  '3730' => array ('devices','devices','fas fa-mobile'),
*/

  '3850' => array('','settings','fas fa-sliders-h'),
  '3851' => array('settings','account'),
  '3852' => array('settings/at','at'),
  '3853' => array('settings/email','email'),

);

$tmpGlobalConfig['menu']['side']['office'] = array(

  '2010' => 'office',

  '2380' => array('','at','fas fa-users'),
  '2381' => array('at','dashboard'),
  '2382' => array('at/search','search'),
  '2383' => array('at/add','add'),


  '2860' => array('','options','fas fa-sliders-h'),
  '2862' => array('options/main','main'),
  '2864' => array('options/home','home'),
  '2867' => array('options/email','email'),
);

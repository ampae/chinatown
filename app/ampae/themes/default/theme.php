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

namespace Ampae\Themes;

/**
 * Theme
 *
 * @package     ChinaTown Theme
 * @see         https://ampae.com/chinatown/themes/
 * @category    Class
 * @author      V Bugroff <bugroff@protonmail.com>
 * @author      M Karodine <usr04@protonmail.com>
 * @since       0.3.1
 * @deprecated  NO
**/

class Theme
{

  /**
   * constructor;
   */
  public function __construct()
  {
      global $model,$state,$alerts,$local,$view,$theme,$htmlrender;
//      $htmlrender->open();
  }

  public function __destruct()
  {
      global $alerts,$local,$view,$theme,$htmlrender;
      //$htmlrender->close();
  }

};

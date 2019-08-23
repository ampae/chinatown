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

 define('MAX_DEV_OTP_TRY', '6');
 define('OTP_CHK_LIFE', '360'); // 60 * 6 = 6 minutes

 define('MAX_DEV_FULL_LIFE', '9'); // ?? params???
 define('MAX_DEV_HALF_LIFE', '16');
 define('MAX_DEV_NO_LIFE', '20');

 define('FULL_LIFE', '63072000'); // 60 * 60 * 24 * 365 * 2 = 63072000 = 2 years
 define('HALF_LIFE', '172800'); // 60 * 60 * 24 * 2 = 172800 = 2 days
 define('NO_LIFE', '7200'); //  60 * 60 * 2 = 7200 = 2 hours

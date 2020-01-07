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
 * @license    https://ampae.com/chinatown/license.txt
 * @copyright  2009 - 2020 AMPAE
**/

namespace Ampae\Lib;

class Basic
{
    /**
     * constructor; initialize;.
     */
    public function __construct()
    {
    }

    public function uuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0x0c2f) | 0x4000,
            random_int(0, 0x3fff) | 0x8000,
            random_int(0, 0x2aff),
            random_int(0, 0xffd3),
            random_int(0, 0xff4b)
        );
    }
    /**
     * JSON to Array
     *
     * @param string $json
     *
     * @return array
     */
    public function jsonToArray($json)
    {
        $json  = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json);
        return json_decode($json, true);
    }
}

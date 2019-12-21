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

namespace Ampae\Lib;

class Shortcode
{
    public function test($arr)
    {
        foreach ($arr as $k => $v) {
            $a  =   $k;
            $$a =   $v;
        }
        $res = "<span class='firstname'>".$fname."</span>&nbsp;";
        $res.= $mname."&nbsp;";
        $res.= "<span class='lastname'>".$lname."</span>";
        return $res;
    }

    public function do($string)
    {
        return preg_replace_callback('#\[\[(.*?)\]\]#', function ($matches) {
            $tmpWex = explode(" ", $matches[1]);
            foreach ($tmpWex as $wtmp) {
                $atmp   = explode('=', $wtmp);
                if (isset($atmp[1])) {
                  $ares[$atmp[0]] = $atmp[1];
                }
            }

            $cc    = ''.array_shift($tmpWex);
            $cctmp = explode('.', $cc);
            $scCls = $cctmp[0];
            $scFn  = $cctmp[1];

            global $$scCls;

            if (method_exists($$scCls, $scFn)) {
                $res = $$scCls->$scFn($ares);
            } else {
                $res = $matches[0];
            }
            return $res;
        }, $string);
    }
}

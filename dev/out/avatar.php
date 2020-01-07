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

namespace Ampae\Lib;

class Avatar
{
    public function __construct()
    {
    }

    public function set($xuid=null, $code=null, $mode=null)
    {
        global $state, $model, $usr, $logger;

        //$model->appinfo['page_type']='png';

        $tmp_font = 'lato.ttf'; // NotoSans-Regular.ttf DejaVuSansMono-Bold.ttf

        if (!$xuid) {
            $xuid = $state->get();
        } else {
            // check office !!!
        }

        if (!$code) {
            $code = $usr->get($xuid, 'name');
        }

        $code = substr($code, 0, 1);
        $code = ucfirst($code);

        $fname = ABSPATH.''.DIR_UPLOADS;
        $rfname = $fname.'/'.$xuid.'.png';

        $image_width   = 100;
        $image_height  = 100;

        $ttf_file      = ABSPATH.''.DIR_ASSETS.'/fonts/'.$tmp_font;

        putenv('GDFONTPATH=' . $ttf_file);

        $font_size     = 32;

        $text_box = imagettfbbox($font_size, 0, $ttf_file, $code);

        $text_width = $text_box[2]-$text_box[0];
        $text_height = $text_box[7]-$text_box[1];

        $x = ($image_width/2) - ($text_width/2);
        $y = ($image_height/2) - ($text_height/2);

        // images background color
        $image_bg_color                 = array("red" => rand(32, 200), "green" => rand(16, 128), "blue" => rand(16, 128));

        // the color of the text
        $text_color                     = array("red" => 255, "green" => 255, "blue" => 255);


        $im         = imagecreate($image_width, $image_height);
        $bgcolor    = imagecolorallocate($im, $image_bg_color['red'], $image_bg_color['green'], $image_bg_color['blue']);
        $font_color = imagecolorallocate($im, $text_color['red'], $text_color['green'], $text_color['blue']);



        imagettftext($im, $font_size, 0, $x, $y, $font_color, $ttf_file, $code);

//         imagejpeg($im);
        imagepng($im, $rfname, 9);

        //$usr->set($model->db1, $xuid, 'avatar', 't_'.$rfname);

 //imagedestroy($im);
    }

    public function get($uid)
    {
        global $model;
        $tmpAvaFile = ABSPATH.''.DIR_UPLOADS.'/'.$uid.'.png';
        if (file_exists($tmpAvaFile)) {
            $tmpAvaFileUrl = $model->appinfo['url'].''.DIR_UPLOADS.'/'.$uid.'.png';
        } else {
            $tmpAvaFileUrl = $model->appinfo['url'].''.DIR_ASSETS.'/img/user.png';
        }
        return $tmpAvaFileUrl;
    }

    public function display($uid, $size=null)
    {
        global $model,$html;
        $tmpAvaFile = ABSPATH.''.DIR_UPLOADS.'/'.$uid.'.png';
        if (file_exists($tmpAvaFile)) {
            $tmpAvaFileUrl = $model->appinfo['url'].''.DIR_UPLOADS.'/'.$uid.'.png';
        } else {
            $tmpAvaFileUrl = $model->appinfo['url'].''.DIR_ASSETS.'/img/user.png';
        }
        echo $html->img($tmpAvaFileUrl, 'avatar', $size, $size);
    }

    /*
         public function view()
         {
             global $xdata, $session, $state, $model, $local, $system, $logger;

             $tmp_title = $local->translate('home');
     //        $tmp_description = $local->translate('home') . ' ' . $local->translate('adm');
             $system->addTitle($tmp_title);
             $logger->debug('Load Home Page View'); // info, warning, critical, emergency
         }
    */
/*
     private function locSplit($code) {
         $ret = '';
         foreach (explode(' ', $code) as $word)
             $ret .= $word[0];
         return substr($ret,0,2);
     }
*/
}

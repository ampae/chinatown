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

class Media
{
    /**
     * constructor;
     */
    public function __construct()
    {
    }

    public function createThumb($img, $iname, $pref, $sz, $pppp)
    {
        $maxwidth = $sz;
        $maxheight = $sz;
        list($width, $height, $type) = @getimagesize($img);
        if ($maxwidth < $width && $width >= $height) {
            $thumbwidth = $maxwidth;
            $thumbheight = ($thumbwidth / $width) * $height;
        } elseif ($maxheight < $height && $height >= $width) {
            $thumbheight = $maxheight;
            $thumbwidth = ($thumbheight /$height) * $width;
        } else {
            $thumbheight = $height;
            $thumbwidth = $width;
        }
        $imgbuffer = imagecreatetruecolor($thumbwidth, $thumbheight);
        switch ($type) {
            case 1:
                $image = imagecreatefromgif($img);
                break;
            case 2:
                $image = imagecreatefromjpeg($img);
                break;
            case 3:
                $image = imagecreatefrompng($img);
                imagealphablending($imgbuffer, false);
                imagesavealpha($imgbuffer, true);
                $transparent = imagecolorallocatealpha($imgbuffer, 255, 255, 255, 127);
                imagefilledrectangle($imgbuffer, 0, 0, $thumbwidth, $thumbheight, $transparent);

                break;
            default:
                return "Failed to create thumbnail from $img: not a valid image";
        }
        if (!$image) {
            return "Image creation from $img failed for an unknown reason. Probably not a valid image.";
        } else {
            imagecopyresampled($imgbuffer, $image, 0, 0, 0, 0, $thumbwidth, $thumbheight, $width, $height);
            imageinterlace($imgbuffer);
            switch ($type) {
                case 3:
                    $output = imagepng($imgbuffer, $pppp.$pref.$iname);
                    break;
                default:
                    $output = imagejpeg($imgbuffer, $pppp.$pref.$iname, 89);
            }
            imagedestroy($imgbuffer);
            return $output;
        }
    }

    public function createThumbPng($img, $iname, $pref, $sz, $pppp)
    {
        $maxwidth = $sz;
        $maxheight = $sz;

        list($width, $height, $type) = @getimagesize($img);

        if ($maxwidth < $width && $width >= $height) {
            $thumbwidth = $maxwidth;
            $thumbheight = ($thumbwidth / $width) * $height;
        } elseif ($maxheight < $height && $height >= $width) {
            $thumbheight = $maxheight;
            $thumbwidth = ($thumbheight /$height) * $width;
        } else {
            $thumbheight = $height;
            $thumbwidth = $width;
        }
        $imgbuffer = imagecreatetruecolor($thumbwidth, $thumbheight);
        switch ($type) {
            case 1:
                $image = imagecreatefromgif($img);
                break;
            case 2:
                $image = imagecreatefromjpeg($img);
                break;
            case 3:
                $image = imagecreatefrompng($img);
                imagealphablending($imgbuffer, false);
                imagesavealpha($imgbuffer, true);
                $transparent = imagecolorallocatealpha($imgbuffer, 255, 255, 255, 127);
                imagefilledrectangle($imgbuffer, 0, 0, $thumbwidth, $thumbheight, $transparent);

                break;
            default:
                return "Failed to create thumbnail from $img: not a valid image";
        }
        if (!$image) {
            return "Image creation from $img failed for an unknown reason. Probably not a valid image.";
        } else {
            imagecopyresampled($imgbuffer, $image, 0, 0, 0, 0, $thumbwidth, $thumbheight, $width, $height);
            imageinterlace($imgbuffer);

            if (file_exists($pppp.$pref.$iname)) {
                unlink($pppp.$pref.$iname);
            }

            $output = imagepng($imgbuffer, $pppp.$pref.$iname);

            imagedestroy($imgbuffer);
            return $output;
        }
    }
}

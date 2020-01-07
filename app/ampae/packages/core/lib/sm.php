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

class Sm
{
    /**
     * trims text to a space then adds ellipses if desired
     * @param string $input text to trim
     * @param int $length in characters to trim to
     * @param bool $ellipses if ellipses (...) are to be added
     * @param bool $strip_html if html tags are to be stripped
     * @return string
     */
    public function trimText($input, $length, $ellipses = true, $strip_html = true)
    {
        //strip tags, if desired
        if ($strip_html) {
            $input = strip_tags($input);
        }

        //no need to trim, already shorter than trim length
        if (strlen($input) <= $length) {
            return $input;
        }

        //find last space within length
        $last_space = strrpos(substr($input, 0, $length), ' ');
        $trimmed_text = substr($input, 0, $last_space);

        //add ellipses (...)
        if ($ellipses) {
            $trimmed_text .= '...';
        }

        return $trimmed_text;
    }

    public function getHashtags($string)
    {
        preg_match_all('/#(\w+)/u', $string, $matches);
        return $matches[1];
    }

    public function getAttags($string)
    {
        preg_match_all('/@(\w+)/u', $string, $matches);
        return $matches[1];
    }


    /**
     * change text to clickable
     *
     * @return void
     */
    public function cliCli($data, $path)
    {
        $data = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a class=\"mmsgl\" target=\"_blank\" href=\"$1\">$1</a>", $data);
        //        $data = preg_replace("/#([A-Za-z0-9\/\.]*)/", "<a href=\"search?q=$1\">#$1</a>", $data);
        //        $data = preg_replace("/@([A-Za-z0-9\/\.]*)/", "<a href=\"profile?@=$1\">@$1</a>", $data);
        $data = preg_replace('~(\#)([^\s!,. /()"\'?]+)~', ' <a class="mmsgs" href="'.$path.'hashtag/$2">#$2</a>', $data);
        $data = preg_replace('~(\@)([^\s!,. /()"\'?]+)~', ' <a class="mmsgm" href="'.$path.'$2">@$2</a>', $data);
        return $data;
    }

    public function timeAgo($ptime)
    {
        global $local;

        $etime = time() - $ptime;

        if ($etime < 8) {
            return 'Now';
        }

        $a = array( 365 * 24 * 60 * 60  =>  'year',
                         30 * 24 * 60 * 60  =>  'month',
                              24 * 60 * 60  =>  'day',
                                   60 * 60  =>  'hour',
                                        60  =>  'minute',
                                         1  =>  'second'
                        );
        $a_plural = array( 'year'   => $local->translate('years'),
                               'month'  => $local->translate('months'),
                               'day'    => $local->translate('days'),
                               'hour'   => $local->translate('hours'),
                               'minute' => $local->translate('minutes'),
                               'second' => $local->translate('seconds')
                        );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' '.$local->translate('ago');
            }
        }
    }
}

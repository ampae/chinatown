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

class Html5 extends Html
{
    public function setup()
    {
        global $model, $html, $render;
        // TODO !!! css, js
        $html->metaAdd(array(
        'charset'=>$model->appinfo['charset']
        ));
        $html->metaAdd(array(
        'name'=>'viewport',
        'content'=>'width=device-width, initial-scale=1',
        ));
        $html->linkAdd(array(
        'rel'=>'shortcut icon',
        'type'=>'image/x-icon',
        'href'=>$model->appinfo['url'].DIR_ASSETS.'/img/favicon.ico',
        ));
        $html->linkAdd(array(
        'rel'=>'stylesheet',
        'type'=>'text/css',
        'href'=>$model->appinfo['url'].DIR_LIBS.'/fa-5/css/fontawesome-all.min.css',
        ));
        $html->linkAdd(array(
        'rel'=>'stylesheet',
        'type'=>'text/css',
        'href'=>$model->appinfo['url'].$model->appinfo['theme_webpath'].'/css/styles.css',
        ));
    }
    public function open()
    {
        return '';
    }

    public function close()
    {
        return '';
    }

    public function asideLeftOpen()
    {
        $ret = '<aside id="asideLeft" role="complementary" aria-label="aside left">';
        $ret.= '<nav role="navigation" id="leftside-navigation" class="nano" aria-label="aside left navigation">';
        return $ret;
    }

    public function asideLeftClose()
    {
        $ret = '</nav>';
        $ret.= '</aside>';
        return $ret;
    }

    public function asideRightOpen()
    {
        $ret = '<aside id="asideRight" role="complementary" aria-label="aside right">';
        $ret.= '<div class="container">';
        return $ret;
    }
    public function asideRightClose()
    {
        $ret = '<nav id="asideRightNavigation" role="navigation" aria-label="aside right navigation">';
        $ret.= '</nav>';
        $ret.= '</div>';
        $ret.= '</aside>';
        return $ret;
    }

    public function article($id, $class, $img = null, $title = null, $desc = null)
    {
        $res = null;
        $res.= $this->tagOpen('article', array('id'=>$id,'class'=>$class));
        if ($img) {
            $res.= $this->tagOpen('figure');
            $res.= $this->div(array('class'=>'panel-thumbnail'));
            $res.= $this->span(array('class'=>'qt-lightbox', 'data-source'=>$img, 'title'=>$title, 'desc'=>$desc));
            $res.= $this->a(array('href'=>$img));
            $res.= $this->img($img, null, $title, "250", "250");
            $res.= $this->tagClose('a');
            $res.= $this->tagClose('span');
            $res.= $this->tagClose('div');
            $res.= $this->tagClose('figure');
        }

        $res.= $this->tagOpen('header', array('class'=>'entry-header'));

        $res.= '<section class="author">';
        $res.= '<a class="author vcard" href="#"><img alt="" src="https://placeimg.com/640/480/any" class="avatar avatar-50 photo" height="50" width="50" /> &bull; avatar</a>';
        $res.= '</section>';

        $res.= '<section class="time-loc">';
        $res.= '<time class="updated" datetime="2019-05-18">May 18, 2019</time>';
        $res.= '</section>';

        $res.= '</header>';
        $res.= '<!-- .entry-header -->';

        $res.= $this->tagOpen('section', array('class'=>'entry-content'));
        $res.= '<h2 class="entry-title"><a href="#" rel="bookmark">Hello World</a></h2>';
        $res.= $this->p('Hello World X');
        $res.= $this->br();
        $res.= $this->tagClose('section');
        $res.= $this->rem('.entry-content');

        $res.= $this->tagOpen('footer', array('class'=>'entry-footer'));
        $res.= '<div class="pull-right">';
        $res.= '<a class="btn btn-small btn-orange-inverse" href="#">read | comment</a>';
        $res.= '</div>';
        $res.= '<p class="">';
        $res.= '<a href="#">comments</a>';
        $res.= '</p>';
        $res.= '<a href="#" rel="category tag">HTML</a>';
        $res.= '<br /> # <a href="#" rel="tag">css</a>';
        $res.= '</footer>';
        $res.= $this->rem('.entry-footer');
        $res.= '</article>';
        return $res;
    }

    /*
     * --- ALETS ---
     */

    //    Usage: $theme->alert( COLOR, TITLE, DESCRIPTION );
    //    COLOR: R= Red, G= Green, B= Blue, Y= Yellow
    public function alert($type, $title, $desc = '')
    {
        global $local;
        $type = strtoupper(substr($type, 0, 1));

        switch ($type) {
            case 'R':
                $ct_bs_type = 'danger';
                $fa = 'minus-circle';
                break;

            case 'Y':
                $ct_bs_type = 'warning';
                $fa = 'exclamation-triangle';
                break;

            case 'G':
                $ct_bs_type = '';
                $fa = '';
                break;

            default:
                $ct_bs_type = 'info';
                $fa = 'info';
                break;
        }

        $ret = '<div data-alert class="alert alert-'.$ct_bs_type.'" tabindex="0" aria-live="assertive" role="alertdialog">';
        $ret.= '<button type="button" tabindex="0" class="close" data-dismiss="alert" aria-label="Close Alert">&times;</button>';
        $ret.= '<i class="fa fa-'.$fa.' "></i> <strong>'.$local->translate($title).'</strong> <br />'.$local->translate($desc);

        $ret.= '</div>';
        return $ret;
    }

    //    Usage: $theme->alert( COLOR, TITLE, DESCRIPTION, FLAG, BUTTON_TITLE, BUTTON_ICON, LINK );
    //    COLOR: R= Red, G= Green, B= Blue, Y= Yellow
    //    FLAG: 1= Show Button
    //    BUTTON_ICON = Font Awesome Icon name (without fa-)
    public function alertLink($type, $title, $desc, $butf, $but, $bico, $link)
    {
        $type = strtoupper(substr($type, 0, 1));
        switch ($type) {
            case 'R':
                $ct_bs_type = 'danger';
                $fa = 'minus-circle';
                break;

            case 'Y':
                $ct_bs_type = 'warning';
                $fa = 'exclamation-triangle';
                break;

            case 'G':
                $ct_bs_type = '';
                $fa = '';
                break;

            default:
                $ct_bs_type = 'info';
                $fa = 'info';
                break;
        }
        $ret = '<div class="alert alert-block alert-'.$ct_bs_type.' fade in text-center">';
        $ret.= '<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-close"></i></button>';
        $ret.= '<i class="fa fa-'.$fa.' "></i> <strong>'.$title.'</strong> <br />'.$desc.'<br />';
        if ($butf == 1) {
            $ret.= '<a href="'.$link.'"><button type="button" class="btn btn-'.$ct_bs_type.'"><i class="fa fa-'.$bico.'"></i> '.$but.'</button></a>';
        }
        $ret.= '</div>';
        return $ret;
    }
}

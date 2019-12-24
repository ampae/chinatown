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
    public function open()
    {
        return '';
    }

    public function close()
    {
        return '';
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
}

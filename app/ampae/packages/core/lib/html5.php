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

class Html5
{
    public function article($id, $class)
    {
        $res.= '<article id="'.$id.'" class="'.$class.'">';
        /*
                  <figure>
                      <div class="panel-thumbnail">
                        <span class="qt-lightbox" data-source="https://placeimg.com/640/480/any" title="Image Title" desc="Image Description">
                          <a href="https://placeimg.com/640/480/any">
                            <img width="250" height="250" src="https://placeimg.com/640/480/any" class="" alt="Hello World" />
                          </a>
                        </span>
                      </div>
                  </figure>

                  <header class="entry-header">

                      <section class="author">
                          <a class="author vcard" href="#"><img alt='' src='https://placeimg.com/640/480/any' class='avatar avatar-50 photo' height='50' width='50' /> &bull; avatar</a>
                      </section>

                      <section class="time-loc">
                          <time class="updated" datetime="2019-05-18">May 18, 2019</time>
                      </section>

                  </header>
                  <!-- .entry-header -->

                  <section class="entry-content">
                      <h2 class="entry-title"><a href="#" rel="bookmark">Hello World</a></h2>
                      <p>Hello World X</p>
                      <br />
                  </section>
                  <!-- .entry-content -->

                  <footer class="entry-footer">
                      <div class="pull-right">
                          <a class="btn btn-small btn-orange-inverse" href="#">read | comment</a>
                      </div>
                      <p class="">
                          <a href="#">comments</a>
                      </p>
                      <a href="#" rel="category tag">HTML</a>
                      <br /> # <a href="#" rel="tag">css</a>
                  </footer>
                  <!-- .entry-footer -->
              </article>
        */
        return $res;
    }
}

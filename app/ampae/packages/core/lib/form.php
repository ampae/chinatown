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

class Form
{
    public function set($atts)
    {
        global $model, $html;
        $model->add('form-open-'.$atts['id'], $html->form($atts));
    }

    public function get($id)
    {
        global $model, $html;
        $ret = $model->get('form-open-'.$id);
        $ret.= $model->get('form-'.$id);
        $ret.= $html->formCloseNew();
        return $ret;
    }

    public function add($id, $atts)
    {
        global $model, $html;
        $model->add('form-'.$id, $html->formFieldNew($atts));
    }
}

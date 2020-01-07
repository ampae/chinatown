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

namespace Ampae\Get;

class Signin
{
    public function index()
    {
        global $model, $loger, $html5, $form, $local;
        //$form->set(array('id'=>'kkk','action'=>'fff'));
        //$form->add('kkk', array('name'=>'aaa','value'=>'zzz'));
        //$form->add('kkk', array('name'=>'bbb','value'=>'uuuuu'));

        //$tmp = '<h2>HOME</h2>';

        //$tmp.= $form->get('kkk');

        //$tmp.= '<p>home</p>';
        //$model->add('html-main', $tmp);

        $model->addTmpl($model->findTmpl('signin'));
        //$model->add('html-main', '[[render.logIn]]');
        //$model->add('html-main', $html5->article('a1', null, 'https://placeimg.com/640/480/any'));
    }
};

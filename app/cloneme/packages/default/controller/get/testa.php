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

namespace Cloneme\Get;

class Testa
{
    const VENDOR = 'cloneme';

    public function __construct()
    {
//      echo ' testA Constructor ';
    }

    public function index()
    {
//      echo ' testA Index ';
    }

    public function eee()
    {
      global $cloneme,$mylib, $model;
      echo $model->appinfo['url']." - ";
      //echo 'Random UUID: EEE ' . $mylib->aaa();
      echo 'Random UUID: EEE ' . $cloneme->default->mylib->aaa();
//      echo 'Random UUID: EEE ' . $cloneme->default->mylibx->xxx();

    }

    public function default()
    {
      global $mylib;
      echo 'Random UUID: DEFAULT ' . $mylib->aaa();
    }

};

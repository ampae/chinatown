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

class Htmlset
{

    /**
     * constructor.
     */
    public function __construct()
    {
    }

    public function addTitle($title)
    {
        global $model;
        $model->appinfo['title'] = $title;
    }

    public function getTitle()
    {
        global $model, $options;
        if (!isset($model->appinfo['title'])) {
            $model->appinfo['title'] = DEFAULT_TITLE;
        }
        return $model->appinfo['title'];
    }

    /**
     * add meta tag; marked for depreciation;.
     *
     * @param string $k config
     * @param string $v config
     */
    public function addMeta($k, $v)
    {
        global $model;
        $model->results['EX']['META'][] = '<meta name="'.$k.'" content="'.$v.'" />';
    }



    // -- scripts ---
    public function addScript($level, $val)
    {
        global $model;
        $model->results['EX']['SCRIPT'][$level][] = $val;
    }

    public function addSmallScript($level, $val)
    {
        global $model;
        $model->results['EX']['SCRIPT_SMALL'][$level][] = $val;
    }

    // -- styles ---
    public function addStyle($val)
    {
        global $model;
        $model->results['EX']['STYLE'][] = $val;
    }

    public function addSmallStyle($val)
    {
        global $model;
        $model->results['EX']['STYLE_SMALL'][] = $val;
    }



}

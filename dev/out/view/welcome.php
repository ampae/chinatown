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

 namespace Ampae\View;

class Welcome
{
    /**
     * constructor; nothing here to constructs.
     */
    public function __construct()
    {
        global $alerts,$local,$view,$theme,$view,$render;

        $theme->open();

//       echo '<BR><BR>';
//       $theme->displayAlerts();
    }

    public function default()
    {
        global $controller,$model,$alerts,$local,$view,$theme,$render;

        $tmpMsg2='';
        if (isset($controller->argv[1])) {
            //$tmpMsg2=$local->translate($controller->argv[1]);
         $tmpMsg2=$controller->argv[1]; // clean up, capitalize !!!
        } ?>


       <div class="container">
       <div class="well">
       <?php
       echo '<h1 style="text-align:center;">'.$local->translate('welcome').'</h1>';
        echo '<p><center>'.$tmpMsg2.'<center></p>';
        //echo '<p><center>'.$options->get('welcome').'<center></p>';
        echo '<a href="'.$model->appinfo['url'].'signin" class="btn btn-welcome btn-lg btn-block">'.$local->translate('continue').'</a>';
        echo '<br /><br /><br />';
        echo '<p><small><a class="align-center" href="./">'.$local->translate('home').' </a></p>'; ?>
       </div>
       </div>

       <?php


       $theme->close();



        // echo 'CORE EVENTS GET Install Plugin MTD index >> ';
         //		print_r($params);
    }
};

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

class Home
{
    /**
     * constructor;
     */
    public function __construct()
    {
        global $model,$auth,$alerts,$local,$view,$theme,$render;
        $theme->open();
        //echo '<BR><BR>';
       //$theme->displayAlerts();

       //echo '>> '.$options->get('signup');
    }

    public function __destruct()
    {
        global $alerts,$local,$view,$theme,$render;
        $theme->close();
    }

    // app logic route root content
    public function default()
    {
        global $controller,$alerts,$local,$view,$theme;
        $tmpFirst = null;
        if ($controller->argc > 0) {
            $tmpFirst = $controller->argv[0];
            $this->ifProfile($tmpFirst);
        }
    }


    private function ifProfile($tmpAt)
    {
        global $controller,$model,$usr,$alerts,$local,$view,$avatar,$theme;

        $tmpAccSt = null;
        $err = 0;
        $tmpEmailPrm = null;

        $tmpUid = $usr->getUid($tmpAt, 'name');

        $tmpAccExists = $usr->get($tmpUid, 'ind');

        if ($tmpAccExists) {

//            $tmpEmailPrm = $usr->get($tmpUid, 'email');
            // check if private or public !!!

            $tmpAccSt = $usr->checkUid($tmpUid, 1);
        } else {
            $tmpUid = 0;
            $tmpAt = '';
            $tmpAccSt = -1;
        }

        if ($tmpUid) {
            if ($tmpAccSt) {
                $tmpAccStWord = $local->translate('active');
            } else {
                $tmpAccStWord = $local->translate('suspended');
                //$tmpUid = 0;
             //$tmpAt = $tmpAccStWord;
            }
        } else {
            $tmpAccStWord = $local->translate('not_exist');
        } ?>
                     <div class="container">
                     <div class="well">
                    <?php

                   echo '<h1 style="text-align:center;">'.$avatar->display($tmpUid, 120).'</h1>';
        echo '<p><center>@'.$tmpAt.'<center></p>';
        // id ??? !!!
        echo '<p><center>'.$tmpEmailPrm.'<center></p>';

        if ($tmpAccSt<0) {
            echo '<h3><center>ACCOUNT NOT EXISTS<center></h3>';
        } elseif ($tmpAccSt==0) {
            echo '<h3><center>ACCOUNT SUSPENDED<center></h3>';
        }

        echo '<br /><br /><br />';
        echo '<p><small><a class="align-center" href="'.$model->appinfo['url'].'">'.$local->translate('home').' </a></p>'; ?>
                     </div>
                     </div>
         <?php
    }
};

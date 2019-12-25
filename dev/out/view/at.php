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

 namespace Ampae\View;

class At
{

   /**
    * constructor;
    */
    public function __construct()
    {
        global $controller, $model, $db, $usr, $avatar, $html, $smrecb, $alerts,$local,$view,$state,$theme,$render;
        $theme->open();
        //echo '<BR><BR>';
     //$theme->displayAlerts();
    }

    public function __destruct()
    {
        global $alerts,$local,$state,$view,$theme,$render;
        $theme->close();
    }

    public function default()
    {
        global $controller, $model, $db, $usr, $avatar, $html, $smrecb, $alerts,$local,$view,$state,$theme;

        $tmpAt = '';
        $tmpUid = 0;
        $tmpAccSt = null;
        $err = 0;

        if ($controller->argc==2) {
            // !!! check admin, else check if public !!!
            // call private method !!!
            $tmpAt = $controller->argv[1];
            if ($tmpAt!='search' && $tmpAt!='add') {
                $tmpAccExists = $usr->get($tmpAt, 'ind');

                if ($tmpAccExists) {
                    $tmpUid = $tmpAt;
                    $tmpAt = $usr->get($tmpUid, 'name');
                    $tmpEmailPrm = $usr->get($tmpUid, 'email');

                    //$tmpUid = $usr->getUid($tmpAt, 'name');
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
                echo '<p><center><a href="'.$model->appinfo['url'].$tmpAt.'">@'.$tmpAt.'</a><center></p>';
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
        }
    }

    public function index()
    {
        global $sign,$state,$alerts,$local,$view,$html,$theme;

        echo ' <div class="container"> ';
        echo ' <br />';
        echo ' <div id="usr_chart"></div>';
        echo ' <br />';

        echo $html->h5($local->translate('users'));

        echo $html->div('', 'results_usrlst');
        echo $html->div('', 'loader_usrlst');


        echo ' </div>';
    }

    public function search()
    {
        global $sign,$state,$alerts,$local,$view,$theme,$html,$usr,$db,$nonce; ?>

       <div class="container">
       <div class="row">

                     <div class="col">
                       <div id="results"></div>
       <!--
                       <div id="qrq" style="display:none"></div>
       -->

                       <div id="loader_message"></div>
                     </div>



       </div>
       </div>

       <?php
    }

    public function add()
    {
        global $sign,$state,$alerts,$local,$view,$theme,$model,$html; ?>

       <div class="container">
         <br />

<?php
$id = 'adm-usr-add';
        echo $html->formOpen(
            $model->appinfo['url'].'at/add',
//                    $model->appinfo['url'].'login/process',
            'POST',
            $id.'-form',
            'co-form',
            '',
            '',
            ''
        );
        echo '<br />';
        echo '<legend><strong>'.$local->translate('add_usr').'</strong></legend>';
        echo '<br />';

        echo $html->formField('text', 'name', 'form-control', 'fa fa-user', $local->translate('name'), '');

        echo $html->formField('email', 'email', 'form-control', 'fa fa-envelope', $local->translate('email'), ''); // , 'autocomplete="off"'

//        echo $html->formFieldHidden('mix', '');

        echo $html->formFieldHidden('action', $id);
        //echo $html->formFieldHidden('fid', 'sin');

        //$view->setTx($id);


        echo $html->formClose(
            $local->translate('signin'),
            'btn btn-primary btn-lg btn-block'
); ?>
       </div>

       <?php
    }

    // --- raw ---


    public function chart()
    {
        global $model;//global $controller, $model, $sign, $state, $db, $usr, $local;//, $http, $html;
        echo json_encode($model->results);
    }

    public function process()
    {
        global $model;//global $controller, $model, $sign, $state, $db, $usr, $local;//, $http, $html;
        echo json_encode($model->results);
    }

    public function getusrlst()
    {
        global $model;//, $http, $html;, $sign, $controller, $state, $db, $usr, $local
        echo json_encode($model->results);
    }
};

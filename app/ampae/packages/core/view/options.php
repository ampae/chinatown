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

 class Options
 {

   /**
    * constructor;
    */
   public function __construct()
   {
     global $controller,$model,$sign,$state,$options,$alerts,$local,$view,$theme,$html,$usr,$db,$nonce,$email;

     $view->open();

     //echo '<BR><BR>';
     //$theme->displayAlerts();

?>

<div class="container">
                          <div class="row">
              <div class="col">


<?php

              $uid       = $state->get();
              $xg         = 'options';

//echo ' [[]] '.$controller->argv[1].' [[]] ';

              if (isset($controller->argv[1])) {
                  $tmp_group = $controller->argv[1];
                  $opts = $options->getGroup($tmp_group);
                  $tmp_mpre = '../';
              } else {
                  $tmp_group = '';
                  $opts = $options->getAll();
                  $tmp_mpre = './';
              }

                          $id = 'acc';
                          $tmpNonce = '';
                          if ($nonce) {
                            $tmpNonce = '?nonce='.$nonce->gen();
                          }

                              echo $html->formOpen(
                                  $model->appinfo['url'].'options/process'.$tmpNonce,
                                  'POST',
                                  'account-form',
                                  'co-form',
                                  '',
                                  '',
                                  ''
                              );

                              foreach ($opts as $fk) {

                                  switch ($fk['type']) {
                                      case 'text':
                                          echo $html->formText('opt_'.$fk['option_name'], 'pencil', $local->translate($fk['option_name']), '3', $fk['option_value']);
                                          break;
                                      case 'check':
                                          echo $html->formCheck('opt_'.$fk['option_name'], '<strong>'.$local->translate($fk['option_name']).'</strong>', $fk['option_value']);
                                          break;
                                  }


                              }

                              echo $html->formFieldHidden('xuid', $uid);
                              echo $html->formFieldHidden('group', $tmp_group);
                              echo $html->formFieldHidden('action', $xg);

                              echo $html->formClose($local->translate('update'), 'btn btn-primary btn-lg btn-block');

                              echo '<a class="btn pull-right btn-theme" href="'.$model->appinfo['url'].'">'.$local->translate('cancel').'</a>';

?>
              <br /><br /><br />


              </div>



              </div>
              </div>

<?php

   }

   public function __destruct()
   {
     global $alerts,$local,$view,$theme;
     $view->close();
   }


};

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

 class Settings
 {
   const VENDOR = 'ampae';

   /**
    * constructor;
    */
   public function __construct()
   {
     global $controller,$model,$sign,$auth,$options,$alerts,$local,$view,$theme,$html,$usr,$db,$nonce;

     $val2 = $model->appinfo['url'].DIR_APP.'/'.self::VENDOR.'/packages/core/view/js/validate-custom.js';
     $view->addScript('HEAD', $val2);

     // $val4 = $model->appinfo['url'].DIR_APP.'/'.self::VENDOR.'/packages/core/view/js/imgup.js';
     // $view->addScript('HEAD', $val4);

     $view->open();

     //echo '<BR><BR>';
     //$theme->displayAlerts();

?>

<?php

   }

   public function __destruct()
   {
     global $alerts,$local,$view,$theme;
     $view->close();
   }


   public function index()
   {
     global $controller,$model,$sign,$auth,$options,$alerts,$local,$view,$theme,$html,$usr,$db,$nonce;
     $tmpLibPath = ABSPATH.PATH_LIBS.DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR;
     require_once realpath($tmpLibPath . 'iso3166.php');
     require_once realpath($tmpLibPath . 'timezones.php');
?>

<div class="container">
                          <div class="row">
              <div class="col">


              <?php

              $uid       = $auth->is();

              if(!$usr->get($uid,'tz')){
                $theme->alert('Y', 'set timezone', 'TimeZone not set !');
              }

              $ar_ar      = array('name');

              $xg         = '';

                          $id = 'acc';
                          $tmpNonce = '';
                          if ($nonce) {
                            $tmpNonce = '?nonce='.$nonce->gen();
                          }

                              echo $html->formOpen(
                                  $model->appinfo['url'].'settings/process'.$xg.$tmpNonce,
                                  'POST',
                                  'account-form',
                                  'co-form',
                                  '',
                                  '',
                                  ''
                              );

                              echo $html->cgOpen('tz', '<i class="fa fa-asterisk"></i> '.$local->translate('timezone'), '');
                              echo "<select name='tz' class='form-control'>";
                              $utz = $usr->get($uid, 'tz');

                              foreach ($timezones as $k => $v) {
                                  $selected = "";
                                  if ($k == $utz) {
                                      $selected = " selected='selected'";
                                  }
                                  echo "<option value='".$k."'".$selected.">".$v."</option>\n";
                              }
                                              echo "</select><br />";
                                          echo $html->cgClose();
echo '<BR>';


                                          $xcc = $usr->get($uid, 'country');



                                          echo $html->cgOpen('country', '<i class="fa fa-asterisk"></i> '.$local->translate('country_billing'), '');
                                              echo "<select name='country' class='form-control'>";
                              if ($xcc == '') {
                                  echo "<option value='XX'>".$local->translate('select_country')."</option>\n";
                              }
                              foreach ($countries as $k => $v) {
                                  $selected = "";
                                  if ($k == $xcc) {
                                      $selected = " selected='selected'";
                                  }
                                  echo "<option value='".$k."'".$selected.">".$v."</option>\n";
                              }
                                              echo "</select>";
                                          echo $html->cgClose();
                              echo "<br />";

                                          //echo $html->formField('text', 'uname', 'form-control', 'fa fa-user', $local->translate('at'), $usr->get($uid, 'name'), 'disabled');
                                          //echo $html->formField('text', 'email', 'form-control', 'fa fa-email', $local->translate('email'), $usr->get($uid, 'email'), 'disabled');

                                                      echo $html->formField('text', 'city', 'form-control', 'fa fa-pencil', $local->translate('city'), $usr->get($uid, 'city'));
                                                      echo $html->formField('text', 'address', 'form-control', 'fa fa-pencil', $local->translate('address'), $usr->get($uid, 'address'));
                                                      echo $html->formField('text', 'pobox', 'form-control', 'fa fa-envelope', $local->translate('pobox'), $usr->get($uid, 'pobox'));



                              echo $html->formFieldHidden('xuid', $uid);
                              echo $html->formFieldHidden('action', $xg);

                              echo $html->formClose($local->translate('update'), 'btn btn-primary btn-lg btn-block');

                              echo '<a class="btn pull-right btn-theme" href="'.$model->appinfo['url'].'">'.$local->translate('cancel').'</a>';

//                              echo $html->h5('<i class="fa fa-user col-blue"></i> CUSTOMER ID <span class="badge bg-default">'.$uid.'</span>');
//                              echo $html->h5('<i class="fa fa-globe col-blue"></i> TIME-ZONE <span class="badge bg-default">'.date_default_timezone_get().'</span>');
//                              echo '<h5><i class="fa fa-envelope col-blue"></i> EMAIL <span class="badge bg-default">'.$usr->get($db->db1, DB1_TABLE_PREFIX, $uid, 'email').'</span></h5>';

              ?>
              <br /><br /><br />


              </div>



              </div>
              </div>

<?php

   }


   public function email()
   {
     global $controller,$model,$sign,$auth,$options,$alerts,$local,$view,$theme,$html,$usr,$db,$nonce;

?>

<div class="container">
                          <div class="row">
              <div class="col">


              <?php

              $uid       = $auth->is();
              $ar_ar     = array('name');
              $xg        = 'email';

                          $id = 'acc';
                          $tmpNonce = '';
                          if ($nonce) {
                            $tmpNonce = '?nonce='.$nonce->gen();
                          }

                              echo $html->formOpen(
                                  $model->appinfo['url'].'settings/process'.$xg.$tmpNonce,
                                  'POST',
                                  'account-form',
                                  'co-form',
                                  '',
                                  '',
                                  ''
                              );

$emails = $usr->getFullArr($uid, 'email','prm');

                             echo $html->cgOpen('emails', '<i class="fa fa-envelope"></i> '.$local->translate('emails'), '');

//print_r($emails);
echo "<BR />";
                              foreach ($emails as $k => $v) {

// Array ( [val] => admin@example.com [prm] => 1 [prv] => 0 [st] => 1 )
// Array ( [val] => bogus@bogus.bog [prm] => 0 [prv] => 1 [st] => 0 )
// print_r($v);
$kx = $k+1;
echo $kx.'. '.$v['val'].'';

if ($v['st']<1) {
  echo ' | <a href="confirm?email='.$v['val'].'">'.$local->translate('confirm').'</a>';
} else {

  if ($v['prm']<1) {
    echo ' | <a href="emailprim?email='.$v['val'].'">'.$local->translate('make_primary').'</a>';
  } else {
    echo ' | '.$local->translate('primary').'';

  }
//  echo ' TGL PRIVACY '.$v['prv'].' '; // !!!

}

if ($v['prm']<1) {
  echo ' | <a href="emaildel?email='.$v['val'].'">'.$local->translate('delete').'</a>';
}

//echo $v['val'].' ';
//echo $v['prm'].' ';
//echo $v['prv'].' ';
//echo $v['st'].' ';

/*
echo ' CONFIRM '; // chk status

echo ' PRIM '; //chk prim
echo ' DEL ';
*/
echo "<BR />";
                              }

                              echo $html->br();
                              echo $html->h4('Add Email');
                              echo $html->formField('email', 'email', 'form-control', 'fa fa-envelope', $local->translate('email'), '');



                              echo $html->formFieldHidden('xuid', $uid);
                              echo $html->formFieldHidden('action', $xg);

                              echo $html->formClose($local->translate('add'), 'btn btn-primary btn-lg btn-block');

                              echo '<a class="btn pull-right btn-theme" href="'.$model->appinfo['url'].'">'.$local->translate('cancel').'</a>';


              ?>
              <br /><br /><br />


              </div>



              </div>
              </div>

<?php

   }

   public function at()
   {
     global $controller,$model,$avatar,$sign,$auth,$options,$alerts,$local,$view,$theme,$html,$usr,$db,$nonce;
?>

<div class="container">
                          <div class="row">
              <div class="col">


              <?php

              $uid        = $auth->is();
              $ar_ar      = array('name');
              $xg         = 'at';

              echo $html->br(1);

              if( strlen($usr->get($uid, 'name')) < MIN_USERNAME_LENGTH ) {
                $theme->alert('Y', $local->translate('add_username'), 'UserName not set !');
              }

// ##############
$tmpNonce = '';
echo $html->formOpen(
    $model->appinfo['url'].'settings/avatar'.$tmpNonce,
    'POST',
    'imageform',
    'form-horizontal',
    'multipart/form-data',
    'role="form" ',
    ''
);

echo $html->formFfield('photoimg', '');
$lenn       = 25;
$tmp_iid    = $uid;//md5(uniqid(rand(12121212,8989898989), true)); // getUuid !!!
echo $html->formFieldHidden("iid", $tmp_iid);

// echo $html->formCloseEnd(); // !!!

?>

<div class="co-update-top">
  <div id="preview" class="co-cursor" align="center" onclick="javascript:getFfile()">
  <?php //$avatar->display($uid,120); ?>
  </div>
</div>

<?php
echo $html->formClose('', 'btn-invisible');


// ##############

// $avatar->display($uid,60);


                          $id = 'acc';
                          $tmpNonce = '';
                          if ($nonce) {
                            $tmpNonce = '?nonce='.$nonce->gen();
                          }

                              echo $html->formOpen(
                                  $model->appinfo['url'].'settings/process'.$xg.$tmpNonce,
                                  'POST',
                                  'account-form',
                                  'co-form',
                                  '',
                                  '',
                                  ''
                              );

//$tmpAt = $usr->getArr($uid, 'name');
//echo $html->h4($usr->get($uid, 'name'));
                             echo $html->cgOpen('at', '<i class="fa fa-user"></i> '.$local->translate('update').' '.$local->translate('username'), '');
echo $html->br();
echo $html->p('@'.$usr->get($uid, 'name'));



//                              foreach ($tmpAt as $k) {
//echo $k .' - '.' - '."<BR>";
//                              }

                              //echo $html->br();
                              //echo $html->h4($local->translate('at'));
                              echo $html->formField('text', 'at', 'form-control', 'fa fa-envelope', $local->translate('at'), '');



                              echo $html->formFieldHidden('xuid', $uid);
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

};

<?php
// echo $controller->argv[0].' = '.$controller->argv[1].'<BR>';

?>
<div class="container">

  <div class="row">
    <div class="col offset4 span4">
      <?php
      if (!$options->get('signup')) {
          $theme->alert('Y', 'signup', $local->translate('signup_unavailable'));
      } ?>
<?php

$tmpThisPage = 'login';
 $tmpNonce = '';
 if ($nonce) {
     $tmpNonce = '?nonce='.$nonce->gen();
 }

 echo $html->formOpen(
     $model->appinfo['url'].'sign/process'.$tmpNonce,
     'POST',
     $tmpThisPage.'-form',
     'co-form',
     '',
     '',
     ''
        );
 echo '<legend><strong>'.$local->translate('login').'</strong></legend>';

 echo $html->formField('email', 'email', 'form-control', 'fa fa-envelope-o', $local->translate('email'), ''); // , 'autocomplete="off"'

 echo $html->formFieldHidden('action', $tmpThisPage);

 echo $html->formClose(
     $local->translate('signin'),
     'btn btn-primary btn-lg btn-block'
); ?>
<br />
          <center>
          <small>
          <a rel="nofollow" href="./"><?php echo $local->translate('home'); ?> </a>
          </small>
          </center>
    </div>
  </div>
</div>

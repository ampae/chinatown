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

class Media
{
    /**
     * constructor;
     */
    public function __construct()
    {
        global $alerts,$local,$view,$theme,$render;
        $theme->open();
        echo '<BR><BR>';
        //$theme->displayAlerts();
    }

    public function __destruct()
    {
        global $alerts,$local,$view,$theme,$render;
        $theme->close();
    }

    public function index()
    {
        global $sign,$state,$alerts,$local,$view,$theme,$nonce,$html,$model; ?>


       <div class="container">
                                 <div class="row">
                     <div class="col">


                     <?php

                     $uid       = $state->get();

        $ar_ar      = array('name');

        $id = 'media';
        $tmpNonce = '';
        if ($nonce) {
            //$tmpNonce = '?nonce='.$nonce->gen();
        }


        $tmp_path = ABSPATH;//$model->appinfo['url'];//.DIR_UPLOADS.'/'; //.'/'.$uid;

        $uid       = $state->get();

        $xg = 'background';

        $tmp_ximg = '';

        switch ($xg) {
                                     case "avatar":
                                         $tmp_ximg = '';//$colibri->getAvatar($tmp_path, $uid);

                                         break;

                                     case "background":
                                         $tmp_ximg = '';//$colibri->getBackground($tmp_path, $uid);


                                         break;

                                     default:
                                 }


        echo $html->formOpen(
            $model->appinfo['url'].'media/process'.$tmpNonce,
            'POST',
            'imageform',
            'form-horizontal',
            'multipart/form-data',
            'role="form" ',
            ''
                                     );

        echo $html->formFfield('photoimg', '');
        $lenn       = 25;
        $tmp_iid    = md5(uniqid(rand(12121212, 8989898989), true)); // getUuid !!!
        echo $html->formFieldHidden("iid", $tmp_iid);
        echo $html->formFieldHidden("wpath", $model->appinfo['url']);

        echo $html->formFieldHidden("type", $xg);

        // echo $html->formCloseEnd(); // !!!?>

                     <div class="co-update-top">
                         <div id="preview" align="center"><img src="<?php echo $tmp_ximg; ?>" width="200"/></div><br />
                     </div>
                     <div class="co-update-bottom">
                         <ul class="list-inline">
                             <li><span id="co-img" class="co-cursor" onclick="javascript:getFfile()" > <i class="fa fa-camera fa-2x"></i></span></li>
                         </ul>
                     </div>

                     <?php
                     echo $html->formClose($local->translate('upload'), 'btn btn-primary btn-lg btn-block');
        echo '<a class="btn pull-right btn-theme" href="'.$model->appinfo['url'].'">'.$local->translate('cancel').'</a>'; ?>
                     <br /><br /><br />


                     </div>



                     </div>
                     </div>

       <?php
    }
};

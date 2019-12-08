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

class Htmlrender
{

    /**
     * constructor.
     */
    public function __construct()
    {
    }


        public function renderMeta()
        {
            global $model,$html;

            if (!empty($html->meta)) {
                foreach ($html->meta as $v) {
                    echo $v."\n";
                }
            }
        }


        public function renderScripts($pos)
        {
            global $model,$html;
            if (!empty($html->script[$pos])) {
                foreach ($html->script[$pos] as $k) {
                    //              $tmp_head_script = $model->appinfo['url'].DIR_LIBS.'/js/'.$k;
                    //                $tmp_head_script = $this->getThemePath().'/'.$k;
                    //                if (file_exists($tmp_head_script)) {
                    echo "<script type='text/javascript' src='".$k."'></script>\n";
                    //                }
                }
            }
            if (!empty($html->scriptSmall[$pos])) {
                foreach ($html->scriptSmall[$pos] as $v) {
                    echo "<script type='text/javascript'>".$v."</script>\n";
                }
            }
            $html->script[$pos] = array();
            $html->scriptSmall[$pos] = array();
        }


        public function renderStyles()
        {
            global $model,$html;
            if (!empty($html->style)) {
                foreach ($html->style as $k) {
                    //                $tmp_head_style = $model->appinfo['url'].DIR_LIBS.'/css/'.$k;
                    //                if (file_exists($tmp_head_style)) {
                    echo "<link rel='stylesheet' type='text/css' href='".$k."' />\n";
                    //                }
                }
            }
            if (!empty($html->styleSmall)) {
                foreach ($html->styleSmall as $v) {
                    echo "<style>".$v."</style>\n";
                }
            }
            $html->style = array();
            $html->styleSmall = array();
        }



    // -----------------------------------------------------------------------------
    // not reusable but theme dependant objects
    // -----------------------------------------------------------------------------

    public function logIn()
    {
        global $model, $controller, $sign, $state, $html, $local, $view;

        $id = 'sin';
        $tmpNonce = '';
        if ($nonce) {
            $tmpNonce = '?nonce='.$nonce->gen();
        }

        echo $html->formOpen(
                            $model->appinfo['url'].'signin/process'.$tmpNonce,
                //                    $model->appinfo['url'].'login/process',
                                    'POST',
                            $id.'-form',
                            'co-form',
                            '',
                            '',
                            ''
                        );
        echo '<br />';
        echo '<legend><strong>'.$local->translate('signin').'</strong></legend>';
        echo '<br />';

        echo $html->formField('email', 'email', 'form-control', 'fa fa-envelope-o', $local->translate('email'), ''); // , 'autocomplete="off"'

        // echo $html->formField('password', 'pword', 'form-control', 'fa fa-key', $local->translate('password'), '');

        // echo $html->formFieldHidden('mix', '');

        echo $html->formFieldHidden('action', $id);
        //echo $html->formFieldHidden('fid', 'sin');

        //$view->setTx($id);

        echo $html->formClose(
                            $local->translate('signin'),
                            'btn btn-primary btn-lg btn-block'
                        );
    }

    public function setUp()
    {
        global $tmpGlobalConfig, $model, $controller, $session, $nonce, $sign, $state, $html, $local, $view;

        //echo '<legend><i class="fa fa-sign-in icon-large"></i> <strong>'.$local->translate('').'</strong></legend>';
        //echo '<div id="facebook" class="btn btn-lg btn-block btn-fb"> Enter <span> with Facebook </span> </div><hr>';

        $id = 'sup';

        echo '<div class="container"><div class="row">';

        echo $html->formOpen(
                            // $model->appinfo['url'].'install/process?nonce='.$nonce->gen(),
                            $model->appinfo['url'].'install/process',
                            'POST',
                            $id.'-form',
                            'co-form',
                            '',
                            '',
                            ''
                        );

        echo '<legend><i class="fa fa-sign-in icon-large"></i> <strong>'.$local->translate('install').'</strong></legend><br />';

        foreach ($tmpGlobalConfig['db'] as $tmpKey => $tmpVal) {
            $tmpFtype = 'text';
            if ($tmpKey=='email') {
                $tmpFtype = 'email';
            }
            echo $html->formField($tmpFtype, $tmpKey, 'form-control', 'envelope-o', $local->translate($tmpKey), $tmpVal);
        }

        echo $html->formField('email', 'email', 'form-control', 'user-o', $local->translate('admin'), '');

        echo $html->formClose(
                            $local->translate('setup'),
                            'btn btn-primary btn-lg btn-block'
                        );
        echo '</div></div>';
    }
}

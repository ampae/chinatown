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
 * @license    https://ampae.com/chinatown/license.txt
 * @copyright  2009 - 2020 AMPAE
**/

namespace Ampae\Lib;

class Render
{
    public function html($dir, $lang)
    {
        global $model, $html;
        echo $html->open($dir, $lang);
    }

    public function meta()
    {
        global $model,$html;
        if (!empty($html->meta)) {
            foreach ($html->meta as $v) {
                echo $v;
            }
        }
    }

    public function link()
    {
        global $model,$html;
        if (!empty($html->link)) {
            foreach ($html->link as $v) {
                echo $v;
            }
        }
    }

    public function script($pos)
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

    public function displayAlerts()
    {
        global $local, $alerts, $html5;
        if ($alerts && $alerts->check()) {
            $tmp_alert = $alerts->getAll();
            echo '<div class="container">';
            foreach ($tmp_alert as $k => $v) {
                echo $html5->alert('Y', $local->translate($k), $local->translate($v));
            }
            echo '</div>';
            $alerts->deleteAll();
        }
    }

    // --- MENU's ----------------------------------------------------------------

    public function navAside($menu, $path)
    {
        global $controller, $model, $local;

        $sort = true;
        $tmpSubFlag = false;
        $tmpActive = '';
        $tmpActive2 = '';

        if ($sort) {
            ksort($menu);
        }

        echo "<ul>\r\n";
        foreach ($menu as $level1 => $level2) {
            if (is_array($level2)) {
                if (count($level2)==3) {
                    if ($tmpSubFlag) {
                        echo "</ul>\r\n";
                        echo "</li>\r\n";
                        $tmpSubFlag = false;
                    }

                    if ($level2[0]=='') {
                        // head-menu

                        if (isset($controller->argv[0]) && $controller->argv[0]==$level2[1]) {
                            $tmpActive = 'active';
                        } else {
                            $tmpActive = ' ';
                        }

                        echo'<li class="sub-menu '.$tmpActive.'"><a href="javascript:void(0);"><i class="'.$level2[2].'"></i><span>'.$local->translate($level2[1]).'</span><i class="arrow fa fa-angle-right pull-right"></i></a>';
                        echo "\r\n";
                        echo "<ul>\r\n";
                        $tmpSubFlag = true;
                    } else {
                        // main menu with link
                        if ($level2[0]=='#') {
                            $level2[0] = '';
                        }
                        echo'<li><a href="'.$path.$level2[0].'"><i class="'.$level2[2].'"></i><span>'.$local->translate($level2[1]).'</span></a></li>';
                        echo "\r\n";
                    }
                } else {
                    // sub-menu

                    if (isset($controller->argv[1]) && $controller->argv[1]==$level2[1]) {
                        $tmpActive2 = 'active';
                    } else {
                        $tmpActive2 = '';
                    }

                    echo '   <li class="'.$tmpActive2.'"><a href="'.$path.$level2[0].'">'.$local->translate($level2[1]).'</a></li>';
                    echo "\r\n";
                }
            } else {
                if ($tmpSubFlag) {
                    echo "</ul>\r\n";
                    echo "</li>\r\n";
                    $tmpSubFlag = false;
                }
                echo '   <li><strong>'.$level2.'</strong></li>';
                echo "\r\n";
            }
        }

        if ($tmpSubFlag) {
            echo "</ul>\r\n";
            echo "</li>\r\n";
            $tmpSubFlag = false;
        }

        echo "</ul>\r\n";
    }

    // -----------------------------------------------------------------------------



    public function asideLeft()
    {
        global $model, $html5, $tmpGlobalConfig, $office;

        echo $html5->asideLeftOpen();

        $this->navAside($tmpGlobalConfig['menu']['side']['all'], $model->appinfo['url']);

        if ($office->is()) {
            $this->navAside($tmpGlobalConfig['menu']['side']['office'], $model->appinfo['url']);
        }

        $this->navAside($tmpGlobalConfig['menu']['side']['user'], $model->appinfo['url']);

        echo $html5->asideLeftClose();
    }

    /*
    public function asideRight() {
    global $html5;
      echo $html5->asideRightOpen();
      echo 'Theme Aside Right';
      echo $html5->asideRightClose();
    }
    */

    // -----------------------------------------------------------------------------
    // not reusable but theme dependant objects
    // -----------------------------------------------------------------------------

    public function logIn()
    {
        global $model, $controller, $sign, $state, $html, $local, $view, $nonce;

        $id = 'sin';
        $tmpNonce = '';
        if ($nonce) {
            $tmpNonce = '?nonce='.$nonce->gen();
        }

        echo $html->formOpen(
            $model->appinfo['url'].'signin/process'.$tmpNonce,
            //$model->appinfo['url'].'login/process',
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

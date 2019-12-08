<?php
/**
 * ChinaTown - RAD LAMP SaaS FrameWork.
 * Complete User Registration and Management. Secure, Fast, Small and Light.
 *
 * THIS CODE ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY KIND,
 * EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A PARTICULAR PURPOSE.
 *
 * PHP version 5.4
 *
 * @package     ChinaTown
 * @category    LAMP SaaS FrameWork
 * @see         https://ampae.com/chinatown/
 * @license     https://ampae.com/chinatown/license.txt
 * @version     HG: <5.1.1>
 * @author      AMPAE <info@ampae.com>
 * @copyright   2009 - 2019 AMPAE
**/

namespace Ampae\Themes;

/**
 * Theme
 *
 * @package     ChinaTown Theme
 * @see         https://ampae.com/chinatown/themes/
 * @category    Class
 * @author      V Bugroff <bugroff@protonmail.com>
 * @author      M Karodine <usr04@protonmail.com>
 * @since       0.3.1
 * @deprecated  NO
**/

class Theme
{

  /**
   * constructor;
   */
    public function __construct()
    {
        global $model,$state,$alerts,$local,$view;
        $this->open();
        $this->asm();
    }

    public function __destruct()
    {
        global $alerts,$local,$view;
        $this->close();
    }


    public function open()
    {
        global $model;
        if ($model->appinfo['page_type']=='html') {
            $headerFile = ABSPATH.$model->appinfo['theme_path'].DIRECTORY_SEPARATOR.'header.php';
            $model->load($headerFile);
        }
    }

    public function close()
    {
        global $model;
        if ($model->appinfo['page_type']=='html') {
            $footerFile = ABSPATH.$model->appinfo['theme_path'].DIRECTORY_SEPARATOR.'footer.php';
            $model->load($footerFile);
        }
    }

    public function asm()
    {
        global $model;
        // load main
        // load asideLeft
        // load asideRight
        // load dialog
    }


    /**
     * load sidebar.
     */
    public function aside($path)
    {
        global $model;
        if (isset($path)) {
            $model->load($path);
        }
    }


    /*
     * --- TABLES ---
     */

    /*
    Usage:

    $theme->table_open( ARRAY( {TABLE_HEADERS} ) );
    $theme->table_data( ARRAY( {TABLE_DATA_2D} ) );
    $theme->table_close();

    */
    public function tableOpen($arr)
    {
        global $html;
        echo"<div class=\"table-responsive\">\n";
        echo"<table class=\"table\">\n";
        echo $html->to($arr);
    }

    public function tableData($arr)
    {
        global $html;
        echo $html->ta($arr);
    }

    public function tableClose()
    {
        global $html;
        echo $html->tc();
        echo"</table>\n";
        echo"</div>\n";
    }

    /*
     * --- ALETS ---
     */

    //    Usage: $theme->alert( COLOR, TITLE, DESCRIPTION );
    //    COLOR: R= Red, G= Green, B= Blue, Y= Yellow
    public function alert($type, $title, $desc = '')
    {
        global $local;
        $type = strtoupper(substr($type, 0, 1));

        switch ($type) {
            case 'R':
                $ct_bs_type = 'danger';
                              $fa = 'minus-circle';
                              break;

                          case 'Y':
                              $ct_bs_type = 'warning';
                              $fa = 'exclamation-triangle';
                              break;

                          case 'G':
                              $ct_bs_type = '';
                              $fa = '';
                              break;

                          default:
                              $ct_bs_type = 'info';
                              $fa = 'info';
                              break;
                      }

        echo '<div data-alert class="alert alert-'.$ct_bs_type.'" tabindex="0" aria-live="assertive" role="alertdialog">';
        echo '<button type="button" tabindex="0" class="close" data-dismiss="alert" aria-label="Close Alert">&times;</button>';
        echo '<i class="fa fa-'.$fa.' "></i> <strong>'.$local->translate($title).'</strong> <br />'.$local->translate($desc);

        echo '</div>';
    }

    //    Usage: $theme->alert( COLOR, TITLE, DESCRIPTION, FLAG, BUTTON_TITLE, BUTTON_ICON, LINK );
    //    COLOR: R= Red, G= Green, B= Blue, Y= Yellow
    //    FLAG: 1= Show Button
    //    BUTTON_ICON = Font Awesome Icon name (without fa-)
    public function alertLink($type, $title, $desc, $butf, $but, $bico, $link)
    {
        $type = strtoupper(substr($type, 0, 1));
        switch ($type) {
                          case 'R':
                              $ct_bs_type = 'danger';
                              $fa = 'minus-circle';
                              break;

                          case 'Y':
                              $ct_bs_type = 'warning';
                              $fa = 'exclamation-triangle';
                              break;

                          case 'G':
                              $ct_bs_type = '';
                              $fa = '';
                              break;

                          default:
                              $ct_bs_type = 'info';
                              $fa = 'info';
                              break;
                      }
        echo '<div class="alert alert-block alert-'.$ct_bs_type.' fade in text-center">';
        echo '<button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-close"></i></button>';
        echo '<i class="fa fa-'.$fa.' "></i> <strong>'.$title.'</strong> <br />'.$desc.'<br />';
        if ($butf == 1) {
            echo '<a href="'.$link.'"><button type="button" class="btn btn-'.$ct_bs_type.'"><i class="fa fa-'.$bico.'"></i> '.$but.'</button></a>';
        }
        echo '</div>';
    }

    public function displayAlerts()
    {
        global $local, $alerts;
        if ($alerts && $alerts->check()) {
            $tmp_alert = $alerts->getAll();
            echo '<div class="container">';
            foreach ($tmp_alert as $k => $v) {
                $this->alert('Y', $local->translate($k), $local->translate($v));
            }
            echo '</div>';
            $alerts->deleteAll();
        }
    }

    /*
                        public function grid($val)
                        {
                            echo '<div class="col span'.$val.'">';
                        }
                        public function close($val)
                        {
                            echo '</div><!--'.$val.'-->';
                        }
    */

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

    public function asideLeftOpen()
    {
        echo'<aside id="asideLeft" role="complementary" aria-label="aside left">';
        echo'<nav role="navigation" id="leftside-navigation" class="nano" aria-label="aside left navigation">';
    }
    public function asideLeftClose()
    {
        echo'</nav>';
        echo'</aside>';
    }

    public function asideLeft()
    {
        global $model, $tmpGlobalConfig, $office;

        $this->asideLeftOpen();

        $this->navAside($tmpGlobalConfig['menu']['side']['all'], $model->appinfo['url']);

        if ($office->is()) {
            $this->navAside($tmpGlobalConfig['menu']['side']['office'], $model->appinfo['url']);
        }

        $this->navAside($tmpGlobalConfig['menu']['side']['user'], $model->appinfo['url']);

        $this->asideLeftClose();
    }

    public function asideRightOpen()
    {
        echo'<aside id="asideRight" role="complementary" aria-label="aside right">';
        echo'<div class="container">';
    }
    public function asideRightClose()
    {
        echo'<nav id="asideRightNavigation" role="navigation" aria-label="aside right navigation">';
        echo'</nav>';
        echo'</div>';
        echo'</aside>';
    }
    /*
    public function asideRight() {
      $this->asideRightOpen();
      echo 'Theme Aside Right';
      $this->asideRightClose();
    }
    */
                      // -----------------------------------------------------------------------------
};

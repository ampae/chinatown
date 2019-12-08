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

 namespace Ampae\View\Aside\Right;

class At
{
    /**
     * constructor;
     */
    public function __construct()
    {
        global $model,$state,$alerts,$local,$view,$theme;
        if ($state->get()) {
            $theme->asideRightOpen();
        }
    }

    public function __destruct()
    {
        global $alerts,$local,$view,$theme,$state;
        if ($state->get()) {
            $theme->asideRightClose();
        }
    }

    public function default()
    {
        global $controller, $model, $db, $usr, $bal, $avatar, $html, $acl, $office, $smrecb, $alerts,$local,$view,$state,$theme;


        $tmpAt = '';
        $tmpUid = 0;
        $tmpAccSt = null;
        $err = 0;
        $tmpOfficeLevel = 0;

        if ($controller->argc==2) {
            // !!! check admin, else check if public !!!
            // call private method !!!
            $tmpAt = $controller->argv[1];

            if ($tmpAt!='search' && $tmpAt!='add') {
                $tmpAccExists = $usr->get($tmpAt, 'ind');

                if ($tmpAccExists) {
                    $tmpUid = $tmpAt;
                    $tmpAt = $usr->get($tmpUid, 'name');
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
                }

                $tmpCurr = array('btc','usd','eur'); // !!!

                //print_r($acl->getAll());

                if ($office->is($tmpUid)) {
                    $tmpOfficeLevel = $office->get($tmpUid);
                    $tmpOfficeStatus = $office->getSt($tmpUid);
                    $tmpOfficerRole = $acl->getRole($tmpOfficeLevel);

                    $tmpLineOff2 = ''.$local->translate('level').': '.$tmpOfficeLevel.' | '.$local->translate('role').': '.$local->translate($tmpOfficerRole);
                    echo $html->h5($local->translate('officer'));
                    echo $html->h5($tmpLineOff2);
                } else {
                    echo $html->h5($local->translate('user'));
                }

                echo $html->h5($local->translate('account'));

                if ($state->getMe($tmpUid)) {
                    echo '<p>'.$local->translate('its_you').'</p>';
                } else {
                    if ($office->can()) {
                        echo '<p>'.$local->translate('status').': '.$tmpAccStWord.' <a href="../at/status/'.$tmpUid.'"><i class="fa fa-user"></i> SWITCH</a></p>';
                        if (!$tmpAccSt) {
                            echo '<p>'.$local->translate('delete').': <a href="../at/del/'.$tmpUid.'"><i class="fa fa-trash"></i> (X)</a></p>';
                        }
                        $this->chOff($tmpUid, $acl->getAll(), $tmpOfficeLevel);
                    }
                }
            }
        }
    }


    public function index()
    {
        global $local, $office, $usr;
        echo '<h5>'.$local->translate('users').': '.$usr->countUsrs().'</h5>';
        echo '<h5>'.$local->translate('staff').': '.$office->countStaff().'</h5>';
    }

    public function search()
    {
    }

    public function add()
    {
    }


    private function chOff($uid, $list, $tmpOfficeLevel)
    {
        global $sign,$state,$alerts,$local,$view,$theme,$model,$html; ?>

       <div class="container">
         <br />

<?php
$id = 'adm-off-ch';
        echo $html->formOpen(
            $model->appinfo['url'].'at/choff',
//                    $model->appinfo['url'].'login/process',
            'POST',
            $id.'-form',
            'co-form',
            '',
            '',
            ''
        );
        echo '<br />';
        echo '<legend><strong>'.$local->translate('office').'</strong></legend>';
        echo '<br />';

//    echo $html->formField('text', 'name', 'form-control', 'fa fa-user', $local->translate('name'), '');
//    echo $html->formField('email', 'email', 'form-control', 'fa fa-envelope', $local->translate('email'), ''); // , 'autocomplete="off"'
        // echo $html->formFieldHidden('fid', 'sin');
        // $view->setTx($id);

        echo $html->formFieldHidden('uid', $uid);
        echo $html->dropDown($list, $tmpOfficeLevel, 'level');
        echo $html->formFieldHidden('action', $id);

        echo $html->formClose(
            $local->translate('update'),
            'btn btn-primary btn-lg btn-block'
); ?>
       </div>

       <?php
    }


};

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

namespace Ampae\Post;

class Settings
{
    public function __construct()
    {
        global $logger, $session, $alerts, $controller, $view;
        $model->appinfo['page_type'] = 'com';
    }

    public function process()
    {
        global $controller, $state, $model, $office, $alerts, $pdo, $db, $usr, $logger, $sign, $local, $options, $view;

        if (!$office->can()) {
            $controller->request['xuid'] = $state->get();
        }

        if (!empty($controller->request['xuid'])) {
            $uid           = $controller->request['xuid'];
            $tmp_country    = $controller->request['country'];
            $tmp_city       = $controller->request['city'];
            $tmp_address    = $controller->request['address'];
            $tmp_po         = $controller->request['pobox'];
            $tmp_tz         = $controller->request['tz'];

            if (!empty($tmp_country) && $tmp_country!='XX') {
                $usr->set($uid, 'country', $tmp_country);
            }


            $usr->set($uid, 'city', $tmp_city);
            $usr->set($uid, 'address', $tmp_address);
            $usr->set($uid, 'pobox', $tmp_po);
            $usr->set($uid, 'tz', $tmp_tz);

            // $view->setTz($tmp_tz);
        }

        $tmpRedirect ='';
        if ($controller->request['action']) {
            $tmpRedirect = '/'.$controller->request['action'];
        }

        $model->redirect = $model->appinfo['url'].'settings'.$tmpRedirect;

//    $model->redirect = $model->appinfo['url'].'settings/'.$controller->request['action'];
    }

    public function processat()
    {
        global $controller, $state, $model, $avatar, $office, $alerts, $pdo, $db, $usr, $logger, $sign, $local, $options;

        if (!$office->can()) {
            $controller->request['xuid'] = $state->get();
        }

        if (!empty($controller->request['xuid'])) {
            $uid    = $controller->request['xuid'];
            $tmp_at = strtolower($controller->request['at']);

            $tmp_at = $usr->cutUsername($tmp_at);

            // check if username available !!!
            if ($usr->getUid($tmp_at, 'name')) {
                $tmp_at = '';
                // add error username taken !!!
            }

            if (strlen($tmp_at) >= MIN_USERNAME_LENGTH) {
                $usr->set($uid, 'name', $tmp_at);
                $usr->updSt($uid, 'name', 1);
                $avatar->set($uid, $tmp_at);
            }
        }

        if ($controller->request['action']) {
            $tmpRedirect = '/'.$controller->request['action'];
        }

        $model->redirect = $model->appinfo['url'].'settings'.$tmpRedirect;

//    $model->redirect = $model->appinfo['url'].'settings/'.$controller->request['action'];
    }

    public function processemail()
    {
        global $controller, $state, $model, $office, $alerts, $email, $pdo, $db, $usr, $devices, $logger, $sign, $local, $options;

        if (!$office->can()) {
            $controller->request['xuid'] = $state->get();
        }

        if (!empty($controller->request['xuid'])) {
            $tmpOtpChk   = false;
            $tmpUid      = $controller->request['xuid'];
            $tmpEmail    = $controller->request['email'];
            $tmpRid      = $devices->get();
            $tmpOp       = 4;


            if ($usr->countKeys('email', $tmpUid, false) < MAX_EMAIL_UID) {
              /*
                $tmpEmailPrm = $usr->get($tmpUid, 'email');
                if ($tmpEmailPrm!=DEMO_MOD_EMAIL) {
                    $tmpOtp = $otp->genNew();
                }
                if ($tmpOtp) {
                    $email->otp('User', $tmpEmail, $tmpOtp); // email confirmation
                    $otp->doDo($tmpRid, $tmpEmail, $tmpOp, $tmpOtp);
                    $tmpOtpChk = true;
                }
                */
            } else {
                // echo 'NOOP 2'; // limit reached !!!
            }
        }

        if ($controller->request['action']) {
            $tmpRedirect = 'settings/'.$controller->request['action'];
        }

        if ($tmpOtpChk) {
            $tmp_next = 'otp';
            $tmpRedirect = $tmp_next;
            if (DEBUG_MODE) {
                $tmpRedirect .= '?uid='.$tmpUid.'&otp='.$tmpOtp;
            }
        }

        $model->redirect = $model->appinfo['url'].$tmpRedirect;

//    $model->redirect = $model->appinfo['url'].'settings/'.$controller->request['action'];
    }


    public function avatar()
    {
        global $controller, $state, $model, $session, $alerts, $pdo, $db, $usr, $logger, $sign, $media, $local;

        $uid   = $state->get();

        $iid    = $controller->request['iid'];

        $path = "uploads/";

        $wpath = $model->appinfo['url'].$path;



        $filename = $_FILES['photoimg']['tmp_name']; //get the temporary uploaded image name
            $valid_formats = array("jpg", "png", "jpeg","JPG","JPEG","PNG"); //add the formats you want to upload

            define('MAX_SIZE_IMG', 4194304); // !!!
            //define('MAX_SIZE_A', 1280); // 2048
            define('MAX_SIZE_T', 400); // 300

            $tmpPref = '';

        $name = $_FILES['photoimg']['name']; //get the name of the image
            $size = $_FILES['photoimg']['size']; //get the size of the image

            if (strlen($name)) {
                //			$name = substr($name, 0, strpos($name, ".")); // cut all after first dot
                list($txt, $ext) = explode(".", $name); //extract the name and extension of the image
                str_replace('.', '-', $txt);
                if (in_array($ext, $valid_formats)) {
                    if ($size < MAX_SIZE_IMG) {
                        $tmp = $_FILES['photoimg']['tmp_name'];

                        $actual_image_name = $iid.'.'.$ext;
                        $new_image_name = $iid.'.'.'png';

                        if (move_uploaded_file($tmp, $path.$actual_image_name)) {
                            //$media->createThumb($path.$actual_image_name, $actual_image_name, 'a_', MAX_SIZE_A, $path);
                            $media->createThumbPng($path.$actual_image_name, $new_image_name, $tmpPref, MAX_SIZE_T, $path);

                            //$usr->set($uid, 'avatar', 't_'.$actual_image_name);

                            unlink($path.$actual_image_name);
                            echo "<img src='".$wpath.$tmpPref.$new_image_name."' width='120' class='preview'> <input type='hidden' name='actual_image_name' id='actual_image_name' value='$actual_image_name' /><span id='co-post-img-fn'>".$actual_image_name."</span>";
                        } else {
                            echo "failed"; // failed image !!!
                        }
                    } else {
                        echo "Image file size max 2 MB";
                    }
                } else {
                    echo "Invalid file format..";
                }
            } else {
                echo "Please select image..!";
            }


        exit;
    }
};

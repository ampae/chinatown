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

class Media
{

  function __construct()
  {
    global $logger, $session, $alerts, $controller, $view;
    $model->appinfo['page_type'] = 'com';
  }

  public function process()
  {
    global $controller, $auth, $model, $session, $alerts, $pdo, $db, $usr, $logger, $sign, $media, $local;

            $uid   = $auth->get();

            $iid    = $controller->request['iid'];

            if (isset($controller->request['type'])) {
                $tmp_type   = $controller->request['type'];
            } else {
                $tmp_type = '';
            }

            $path = "uploads/";

            $wpath = $path;

            if (isset($controller->request['wpath'])) {
                $wpath = $controller->request['wpath'].$wpath;
            }


            $filename = $_FILES['photoimg']['tmp_name']; //get the temporary uploaded image name
            $valid_formats = array("jpg", "png", "jpeg","JPG","JPEG","PNG"); //add the formats you want to upload

            define('MAX_SIZE_IMG', 4194304); // !!!
            define('MAX_SIZE_A', 1280); // 2048
            define('MAX_SIZE_T', 400); // 300

            $name = $_FILES['photoimg']['name']; //get the name of the image
            $size = $_FILES['photoimg']['size']; //get the size of the image

            if (strlen($name)) {

    //			$name = substr($name, 0, strpos($name, ".")); // cut all after first dot

                list($txt, $ext) = explode(".", $name); //extract the name and extension of the image
                str_replace('.', '-', $txt);
                if (in_array($ext, $valid_formats)) {
                    if ($size < MAX_SIZE_IMG) {
                        $tmp = $_FILES['photoimg']['tmp_name'];

                        $actual_image_name = $iid.'.'.$ext; //md5(uniqid(rand(12121212,8989898989), true)).'.'.$ext;


                        if (move_uploaded_file($tmp, $path.$actual_image_name)) {
                            $media->createThumb($path.$actual_image_name, $actual_image_name, 'a_', MAX_SIZE_A, $path);
                            $media->createThumb($path.$actual_image_name, $actual_image_name, 't_', MAX_SIZE_T, $path);

                            if ($tmp_type=='avatar') {
                                $usr->set($uid, 'avatar', 't_'.$actual_image_name);
                            }

                            if ($tmp_type=='background') {
                                $usr->set($uid, 'background', 'a_'.$actual_image_name);
                            }

                            unlink($path.$actual_image_name);
                            echo "<img src='".$wpath."t_".$actual_image_name."' width='200' class='preview'> <input type='hidden' name='actual_image_name' id='actual_image_name' value='$actual_image_name' /><span id='co-post-img-fn'>".$actual_image_name."</span>";
                        } else {
                            echo "failed";
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

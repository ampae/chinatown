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

class Controller
{
    public $get     = array(); // User input after purification
    public $post    = array(); // User input after purification
    public $request = array(); // User input after purification
    public $info    = array(); // Application data like path etc.
    public $params  = array(); //
    public $argv    = array(); //
    public $argc    = 0;
    public $method  = null;
    public $ts      = null; // trail slash

    public function __construct()
    {
      // https://tools.ietf.org/html/rfc7231#section-4
      // GET, POST, HEAD, PUT, PATCH, DELETE, CONNECT, OPTIONS, TRACE
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $this->post = $_POST;
                $this->request = $_POST;
                $this->method = 'POST';
                break;

            case 'GET':
                $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
                $this->get = $_GET;
                $this->request = $_GET;
                $this->method = 'GET';
                break;

            // default: exit;
        }
        $this->argX();
    }

    private function argX()
    {
        if (!empty($_SERVER['QUERY_STRING'])) {
            parse_str($_SERVER['QUERY_STRING'], $this->params);
        }

        $tmp_ind = 'index.php';
        $this->info['app_path'] = chop($_SERVER['SCRIPT_NAME'], $tmp_ind);

        if (!isset($this->info['app_path']) || empty($this->info['app_path']) || $this->info['app_path']=='') {
          $this->info['app_path'] = '/';
        }
        $tmp_last = str_replace($this->info['app_path'], '', urldecode($_SERVER['REQUEST_URI']));

        $tmp_str_arr = explode('?', $tmp_last);

        if (isset($tmp_str_arr[0])) {
            $this->argv = array_filter(explode('/', $tmp_str_arr[0]));
        }

        $this->argc = count($this->argv);

        $this->info['schema'] = ('on' == @$_SERVER['HTTPS']) ? 'https://' : 'http://';
        $this->info['domain'] = $_SERVER['SERVER_NAME'];
        $this->info['url'] = $this->info['schema'].$this->info['domain'].$this->info['app_path'];
    }
}

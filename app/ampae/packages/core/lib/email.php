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

class Email
{
    /**
     * constructor;
     */
    public function __construct()
    {

/*
      global $tmpGlobalConfig, $theme;

//    include ABSPATH.DIR_LIBS.'autoload.php';

      $tmpLibNs = 'PHPMailer\\PHPMailer\\';
      $tmpGlobalConfig['autoload']['main']['psr-4'][$tmpLibNs] = DIR_LIBS.'/php/PHPmailer/';


      $tmp_lib = '\\'.$tmpLibNs.'PHPMailer';
      $tmpMail = new $tmp_lib();

      require realpath(ABSPATH.DIR_LIBS.'/php/PHPmailer/SMTP.php');

      $tmpMail->IsSMTP();
*/
/*
      require realpath(ABSPATH.DIR_LIBS.'/php/PHPmailer/PHPMailer.php');
      require realpath(ABSPATH.DIR_LIBS.'/php/PHPmailer/SMTP.php');
      $tmpMail = new PHPMailer\PHPMailer\PHPMailer();
      $tmpMail->IsSMTP();
*/
    }

    /**
     * attempt to send an email
     *
     * @param string $from config
     * @param string $to   config
     * @param string $subj config
     * @param string $body config
     *
     * @return bool
     */
    public function it($from, $to, $subj, $body)
    {
        global $tmpGlobalConfig, $model, $options;

        // we going to use external SMTP server (such as gmail, zoho, etc) with remote auth
        // if ($model->config['email']['SENDMAIL_LOCAL'] == 0) {

        if ($options->get('smtp')) {

// php-mailer without autoload !!!

            $tmpLibNs = 'PHPMailer\\PHPMailer\\';
            $tmpGlobalConfig['autoload']['main']['psr-4'][$tmpLibNs] = DIR_LIBS.'/php/PHPmailer/';


            $tmp_lib = '\\'.$tmpLibNs.'PHPMailer';
            $tmpMail = new $tmp_lib();

            require realpath(ABSPATH.DIR_LIBS.'/php/PHPmailer/SMTP.php');

            $tmpMail->IsSMTP();


            // debugging: 1 = errors and messages, 2 = messages only
            $tmpMail->SMTPDebug    = 0;//$options->get('SMTP_DEBUG');

            // enable SMTP authentication
            $tmpMail->SMTPAuth     = 1;//$options->get('SMTP_AUTH');

            // Sets SMTP server ex. smtp.gmail.com smtp.zoho.com
            $tmpMail->Host         = $options->get('SMTP_HOST');

            // Secure conection ex. tls - gmail , ssl - zoho mail
            $tmpMail->SMTPSecure   = $options->get('SMTP_SEC');

            // Set the SMTP port ex. 587 - gmail , 465 - zoho
            $tmpMail->Port         = $options->get('SMTP_PORT');

            // SMTP account username
            $tmpMail->Username     = $options->get('SMTP_NAME');
            // SMTP account password
            $tmpMail->Password     = $options->get('SMTP_PASS');

            // $tmpMail->AuthType     = 'password'; !!! !!! ???
            // $tmpMail->oauth     = null; !!! !!! ???


            $tmpMail->From         = $options->get('SMTP_NAME');//$options->get('SMTP_FROM');
            $tmpMail->FromName     = $options->get('SMTP_NAME');//$options->get('SELF_NAME');

            // Email priority (1 = High, 3 = Normal, 5 = low)
            $tmpMail->Priority     = 3;
            $tmpMail->CharSet      = 'UTF-8';
            $tmpMail->Encoding     = '8bit';
            $tmpMail->ContentType  = 'text/html; charset=utf-8\r\n';
            // RFC 2822 Compliant for Max 998 characters per line
            $tmpMail->WordWrap     = 900;

            $tmpMail->AddAddress($to);

            $tmpMail->Subject      = $subj;

            // $tmpMail->isHTML( TRUE );

            $tmpMail->Body         = $body;
            $tmpMail->AltBody      = $body;
            $tmpMail->Send();
            $tmpMail->SmtpClose();

            if ($tmpMail->IsError()) {
                return false;
            } else {
                return true;
            }
        } else {
            // we going to use local sendmail
            ini_set("sendmail_from", $from);

            if ($from == '' || $to == '' || $subj == '' || $body == '') {
                return;
            }

            $mx = false;

            $headers = "";

            $headers .= "Mime-Version: 1.0\n";
            $headers .= "Content-type: text/plain; charset=iso-8559-1\n";
            $headers .= "Content-Transfer-Encoding: 8bit\n";
            $headers .= "X-Priority: 3\n";

            $headers .= "From: $from\n";
            $headers .= "Reply-To: $from\n";
            $headers .= "X-Mailer: ChinaTown simple mailer\n";

            $extras = "-f ".$from;

            $headers .= "Date:".date("D, d M Y H:i:s O")." \n";

            $body   = strip_tags($body);

            if (!DEBUG_MODE) {
                $mx = mail($to, $subj, $body, $headers, $extras);
            }
            return $mx;
        }
    }

    public function otp($tmp_name, $tmp_email, $tmp_opass)
    {
        global $options, $model;
        $ct_br = '<br>';
        $ct_org = $options->get('copyright');
        $ct_org_url = $model->appinfo['url'].'';
        $ct_signin_url = $model->appinfo['url'].'/otp'; // !!!

        $json_tmpl = $options->get('tmpl_otp');



        $json_tmpl = str_replace("&#34;", '"', $json_tmpl);
//    $json_tmpl = str_replace( "&#39;", "'", $json_tmpl);
        $json_tmpl = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json_tmpl);

        $co_arr_tmpl = json_decode($json_tmpl, true);

        $co_arr_tmpl = str_replace(array('{{ct_br}}', '{{ct_name}}', '{{ct_email}}', '{{ct_org}}', '{{ct_org_url}}', '{{ct_signin_url}}', '{{ct_opass}}'), array($ct_br, $tmp_name, $tmp_email, $ct_org, $ct_org_url, $ct_signin_url, $tmp_opass), $co_arr_tmpl);

        $subj = $co_arr_tmpl['subject'];
        $body = $co_arr_tmpl['body'];
        $from = $options->get('SMTP_NAME');

        $this->it($from, $tmp_email, $subj, $body);
    }
}

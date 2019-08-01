<?php
/**
 * 邮件工具类
 *
 * - 基于PHPMailer的邮件发送
 *
 *  配置
 *
 * 'PHPMailer' => array(
 *   'email' => array(
 *       'host' => 'smtp.gmail.com',
 *       'username' => 'XXX@gmail.com',
 *       'password' => '******',
 *       'from' => 'XXX@gmail.com',
 *       'fromName' => 'PhalApi团队',
 *       'sign' => '<br/><br/>请不要回复此邮件，谢谢！<br/><br/>-- PhalApi团队敬上 ',
 *   ),
 * ),
 *
 * 示例
 *
 * $mailer = new PHPMailer_Lite(true);
 * $mailer->send('chanzonghuang@gmail.com', 'Test PHPMailer Lite', 'something here ...');
 *
 * @author dogstar <chanzonghuang@gmail.com> 2015-2-14
 */

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'PHPMailer' . DIRECTORY_SEPARATOR . 'PHPMailerAutoload.php';

class PHPMailer_Lite
{
    protected $debug;

    protected $config;

    public function __construct($config, $debug = FALSE) {
        $this->debug = $debug;
    
        $this->config = $config;
    
        //[email_addr] => 23213@qq.com
        //[email_debug] => 1
        //[email_fromname] => 站点名称
        //[email_host] => smtp.qq.com
        //[email_id] => 23213
        //[email_pass] =>
        //[email_port] => 465
        //[email_secure] => ssl
        //[email_test] =>
    }

    /**
     * 发送邮件
     * @param array/string $addresses 待发送的邮箱地址
     * @param sting $title 标题
     * @param string $content 内容
     * @param boolean $isHtml 是否使用HTML格式，默认是
     * @return boolean 是否成功
     */
    public function send($addresses, $title, $content, $isHtml = TRUE)
    {
        $mail = new PHPMailer;
        $cfg = $this->config;
    
        
        $mail->isSMTP();
        $mail->Host = $cfg['email_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $cfg['email_id'];
        $mail->Password = $cfg['email_pass'];
        $mail->CharSet = 'utf-8';
    
        if ($cfg['email_secure'])
        {
            $mail->SMTPSecure = $cfg['email_secure']; // Enable TLS encryption, `ssl` also accepted
        }
        
        $mail->Port = $cfg['email_port'];
        
        $mail->From = $cfg['email_addr'];
        $mail->FromName = $cfg['email_fromname'];
        $addresses = is_array($addresses) ? $addresses : array($addresses);
        foreach ($addresses as $address) {
            $mail->addAddress($address);
        }

        $mail->WordWrap = 50;
        $mail->isHTML($isHtml);

        $mail->Subject = trim($title);
        $mail->Body = $content;

        if (isset($cfg['email_sign']))
        {
            $mail->Body = $mail->Body . $content;
        }
        
        if (!$mail->send()) {
            if ($this->debug) {
                Zero_Log::log('Fail to send email with error: ' . $mail->ErrorInfo, 'email');
            }

            return false;
        }

        if ($this->debug) {
            Zero_Log::log('Succeed to send email : ' . encode_json(array('addresses' => $addresses, 'title' => $title)), 'email');
        }

        return true;
    }
}


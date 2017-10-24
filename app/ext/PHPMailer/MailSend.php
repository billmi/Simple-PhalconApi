<?php
namespace Marser\App\Ext\PHPMailer;

use PHPMailer\Exception,
     PHPMailer\PHPMailer;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

class MailSend
{

    private $_send;

    private $_host = "smtp.qq.com";

    private $_SMTPAuth = true;

    private $_Username = "297876771@qq.com";

    private $_Password = "123123";   //这里我已经修改了

    // Enable TLS encryption, `ssl` also accepted
    private $_SMTPSecure = 'tls';

    private $_Port = 587;

    private $_errMsg;

    /**
     * @return mixed
     */
    public function getErrMsg()
    {
        return $this->_errMsg;
    }

    /**
     * SMTP class debug output mode.
     * Debug output level.
     * Options:
     * * `0` No output
     * * `1` Commands
     * * `2` Data and commands
     * * `3` As 2 plus connection status
     * * `4` Low-level data output.
     *
     * @see SMTP::$do_debug
     *
     * @var int
     * 默认为0即可
     */
    private $_debug = 0;

    /**
     * not important
     * @var
     */
    private $_altBody = null;

    public function __construct()
    {
        $mail = new PHPMailer(true);
//        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = $this->_host;
        $mail->SMTPAuth = $this->_SMTPAuth;
        $mail->Username = $this->_Username;
        $mail->Password = $this->_Password;
        $mail->SMTPSecure = $this->_SMTPSecure;
        $mail->Port = $this->_Port;
//        $mail->setLanguage('zh_cn');
        $this->_send = $mail;
    }

    public function getSend()
    {
        return $this->_send;
    }

    public function setSendFrom($fromAddr = '', $name = '')
    {
        if (!empty($name)) {
            $this->_send->setFrom($fromAddr, $name);
        } else {
            $this->_send->setFrom($fromAddr);
        }
    }

    public function setSendto($toAddr = '', $name = '')
    {
        if (!empty($name)) {
            $this->_send->addAddress($toAddr, $name);
        } else {
            $this->_send->addAddress($toAddr);
        }
    }

    public function addReplyTo($replyTo = '', $name = '')
    {
        if (!empty($name)) {
            $this->_send->addReplyTo($replyTo, $name);
        } else {
            $this->_send->addReplyTo($replyTo);
        }
    }

    public function addAttachment($filePath = '', $extName = '')
    {
        if (!empty($name)) {
            $this->_send->addAttachment($filePath, $name);
        } else {
            $this->_send->addAttachment($filePath);
        }
    }


    public function sendHtml($subject = '',$content = '')
    {
        $this->_send->isHTML(true);
        $this->_send->Subject = $subject;
        $this->_send->Body = $content;
        $this->_send->AltBody = empty($this->getAltBody()) ? '' : $this->_altBody;
        return $this->_send->send();
    }

    /**
     * @return mixed
     */
    public function getAltBody()
    {
        return $this->_altBody;
    }

    /**
     * @param mixed $altBody
     */
    public function setAltBody($altBody)
    {
        $this->_altBody = $altBody;
    }

    /**
     * @return int
     */
    public function getDebug()
    {
        return  $this->_debug;
    }

    /**
     * @param int $debug
     */
    public function setDebug($debug)
    {
        $this->_debug = $debug;
    }
}


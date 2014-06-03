<?php
/**
 * User: zhangchao
 * Date: 14-5-25
 * Time: 上午10:36
 */

class MailService
{
   protected $_mailModel;
   public $erroeInfo;

    public function __construct()
    {
        $this->_mailModel = new PHPMailer();
        $this->_mailModel->CharSet =  'UTF-8';
        $this->_mailModel->isSMTP();
        $this->_mailModel->Host = 'smtp.163.com';
        $this->_mailModel->From = 'meipin2309@163.com';
        $this->_mailModel->FromName = '美品网';
        $this->_mailModel->isHTML(true);
        $this->_mailModel->SMTPAuth = true;
        $this->_mailModel->Username = 'meipin2309@163.com';
        $this->_mailModel->Password = 'soho2309';
    }

    /**
     * @param $body 邮件正文
     * @param $subject 邮件标题
     * @param $toEmail 接收人
     */
    public function sendMail($body,$subject,$toEmail)
    {
        $this->_mailModel->Body = $body;
        $this->_mailModel->Subject = $subject;
        $this->_mailModel->addAddress($toEmail);
        if (!$this->_mailModel->send()) {
            //记录下发送失败的log
            Yii::log($this->_mailModel->ErrorInfo,CLogger::LEVEL_ERROR);
            $this->erroeInfo = $this->_mailModel->ErrorInfo;

            return false;
        } else {
            return true;
        }

    }
}

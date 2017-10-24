<?php

namespace  Marser\App\Frontend\Controllers;


use Marser\App\Common\Base\BaseController;
use Marser\App\Helpers\EncryptHelper;
use PHPMailer\Exception;

class ApiController extends  BaseController{

    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 使用框架自带的response对象操作
     * sendSmsAction
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     * @author Bill
     */
    public function sendSmsAction(){
        $result = [
            'code' => 1,
            'mess' => "请求成功",
            'data' => [
                'title' => "完成"
            ]
        ];
        return $this->response->setJsonContent($result)->send();
    }

    /**
     * http请求返回封装
     * sendEmailAction
     * @author Bill
     */
    public function sendEmailAction(){
        $data = $this->request->get('data');
        $data = EncryptHelper::smsDecodeEncrypt($data);
        $result = false;
        try{
            $this->email->setSendFrom($data->sendFrom);
            $this->email->setSendto($data->sendTo);
            $result = $this->email->sendHtml($data->title,$data->content);
        }catch (Exception $e) {
            $_error = 'Mailer Error: ' . $e->getMessage();
            saveLog("emaiSendService","{ erro : ".$_error."  }",'error');
        }
        if(!$result)
            $this->httpError("发送失败!");
        $this->httpSuccess("发送成功!");
    }

}
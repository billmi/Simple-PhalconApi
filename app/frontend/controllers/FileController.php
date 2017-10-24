<?php


namespace  Marser\App\Frontend\Controllers;


use Marser\App\Common\Base\BaseController;
use Marser\App\Libs\Upload;
use Phalcon\Exception;

class FileController extends  BaseController{


    public function initialize()
    {
        parent::initialize();

    }

    //文件上传已封装好，可以做适当修改
    public function uploadPictureAction(){

        $file_savepath = "upload/picture/";
        $file_size = 50 * 1024 * 1024;
        $file_type = array('jpg','png','gif');
        $result = null;
        try{
            $upload = new Upload($this->request , $file_savepath  , $file_size , $file_type);
            if(!$upload->uploadfile())
                return $this->httpError($upload->getError());
            $fileInfos = $upload->getFileRealPath();
            $fileRepository = $this->get_repository("File");
            $result = $fileRepository->saveFile($fileInfos);

        }catch (Exception $e){
            saveLog("saveUploadPic","{ error : 文件数据保存错误! data : ".json_encode($this->request->getUploadedFiles(),JSON_UNESCAPED_UNICODE)."}",'saveError');
            return $this->httpError("文件上传失败!");
        }

        if(empty($result))
            return $this->httpError("文件上传失败!");
        return $this->httpSuccess("文件上传成功!",$result);

    }

}

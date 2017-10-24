<?php

namespace Marser\App\Libs;

class Upload
{

    private $request;

    private $autoMkdir = true;

    private $savePath;

    private $limitSize;

    // 上传文件的格式限制
    private $allowType;

    private $_files;

    private $_errMsg;

    private $_realpath = array();

    const PIC_TYPE = 1;

    const DS = '/';

    public function __construct($request, $savePath, $limitSize, $allowType)
    {
        $this->request = $request;
        $this->savePath = $savePath . $this->_getDate() . self::DS;
        $this->limitSize = $limitSize;
        $this->allowType = $allowType;
    }

    private function _getDate(){
        return date("Ymd",time());
    }

    /**
     * getFileRealPath
     * @return array
     * @author Bill
     */
    public function getFileRealPath()
    {
        return $this->_realpath;
    }

    /**
     * uploadfile
     * @author Bill
     */
    public function uploadfile()
    {
        if ($this->request->hasFiles() == true) {
            $this->_files = $this->request->getUploadedFiles();
            if (!$this->checkFiles())
                return false;

            return $this->moveFiles();
        } else {
            $this->_errMsg = 'Not Files!';
            return false;
        }
    }

    /**
     * random_code
     * @param $length
     * @param int $numeric
     * @return string
     * @author Bill
     */
    public function random_code($length, $numeric = 0)
    {
        $seed = base_convert(md5(microtime() . $this->_rendomKey), 16, $numeric ? 10 : 35);
        $seed = $numeric ? (str_replace('0', '', $seed) . '012340567890') : ($seed . 'zZ' . strtoupper($seed));
        if ($numeric) {
            $hash = '';
        } else {
            $hash = chr(rand(1, 26) + rand(0, 1) * 32 + 64);
            $length--;
        }
        $max = strlen($seed) - 1;
        for ($i = 0; $i < $length; $i++) {
            $hash .= $seed{mt_rand(0, $max)};
        }
        return $hash;
    }

    /**
     * 文件检测
     * @return bool
     * @author Bill
     */
    private function checkFiles()
    {
        foreach ($this->_files as $file) {
            if (!$this->_checkSize($file))
                return false;
            if (!$this->_checkType($file))
                return false;
        }
        return true;
    }

    /**
     * 大小检测
     * _checkSize
     * @param $file
     * @return bool
     * @author Bill
     */
    private function _checkSize($file)
    {
        if ($file->getSize() > $this->limitSize) {
            $this->_errMsg = $file->getName() . ",文件过大!";
            return false;
        }
        return true;
    }

    /**
     * 类型检测
     * _checkType
     * @param $file
     * @return bool
     * @author Bill
     */
    private function _checkType($file)
    {
        if (is_array($this->allowType)) {
            if (!in_array($file->getExtension(), array_map('strtolower', $this->allowType))) {
                $this->_errMsg = $file->getName() . ",文件类型不允许上传!";
                return false;
            }
        } else if (is_string($this->allowType)) {
            if (strtolower($file->getExtension()) != strtolower($this->allowType)) {
                $this->_errMsg = $file->getName() . ",文件类型不允许上传!";
                return false;
            }
        } else {
            $this->_errMsg = $file->getName() . ",不允许上传的文件类型!";
            return false;
        }
        return true;
    }

    /**
     * mkdir
     * @param $dir
     * @return bool
     * @author Bill
     */
    private function mkdir($dir)
    {
        if (!is_dir($dir)) {
            if (!$this->mkdir(dirname($dir))) {
                $this->failLog('uploadFile',"{error:'目录创建失败!',DirName:".dirname($dir)."}",'fail');
                $this->_errMsg = "文件上传失败!";
                return false;
            }
            if (!mkdir($dir, 0775)) {
                $this->_errMsg = "文件上传失败!";
                $this->failLog('uploadFile',"{error:'文件上传失败!',DirName:".dirname($dir)."}",'fail');

                return false;
            }
        }
        return true;
    }

    /**
     * checkDir
     * @author Bill
     */
    private function _checkDir()
    {
        if (!is_dir($this->savePath)) {
            if ($this->autoMkdir) {
                if (!$this->mkdir($this->savePath)) {
                    $this->_errMsg = "目录创建失败!";
                    return false;
                }
            } else {
                $this->_errMsg = "上传目录不存在!";
                return false;
            }
        }
        return true;
    }


    /**
     * 移动文件
     * moveFiles
     * @return bool
     * @author Bill
     */
    private function moveFiles()
    {
        if(!$this->_checkDir())
            return false;

        $filepath = trim($this->savePath, '/') . '/';
        foreach ($this->_files as $file){
            $filename = date('YmdHis') . uniqid() . '.' . $file->getExtension();
            if (!$file->moveTo($filepath . $filename)) {
                $this->failLog('uploadFile',"{error:'文件上传失败!',FileName:".$this->getFileName()."}",'fail');   //这里错误日志按目录结构存放
		return false;
            } else {
                $this->_realpath[] = [
                    'fileName' => $file->getName(),
                    'savePath' => $filepath . $filename,
                    'sha1' => sha1($filename),
                    'type' => self::PIC_TYPE,
                    'size' => $file->getSize(),
                    'ext'  => $file->getExtension()
                ];
            }
        }
        return true;
    }

    private function failLog($fileName, $text , $level = 0)
    {
        $text ='[' . date('Y-m-d h:i:s',time()) . '][' . $level .']'. $text . "\n";
        file_put_contents(ROOT_PATH . '/log/file/'.$fileName.'_'.date('Ymd').'.log', $text, FILE_APPEND);
    }

    /**
     * getError
     * @return mixed
     * @author Bill
     */
    public function getError()
    {
        return $this->_errMsg;
    }

}

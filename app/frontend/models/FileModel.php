<?php

namespace Marser\App\Frontend\Models;

class FileModel extends BaseModel{

    const TABLE_NAME = 'file';

    public $id;
    public $file_name;
    public $file_path;
    public $file_ext;
    public $file_size;
    public $type;
    public $upload_ip;
    public $status;
    public $create_at;
    public $update_at;
    public $file_shal;


    public function getSource()
    {
        return self::TABLE_NAME;
    }


}
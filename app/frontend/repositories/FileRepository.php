<?php


namespace Marser\App\Frontend\Repositories;
use Marser\App\Response\HttpResponse;
use Phalcon\DiInterface;
use PHPMailer\Exception;

class FileRepository extends BaseRepository
{

    public function __construct(DiInterface $di = null)
    {
        parent::__construct($di);
    }

    //TODO::需要优化
    public function saveFile($files = []){
        $phql = "INSERT INTO Frontend:FileModel (id, file_name, file_path, file_ext, file_size, type,upload_ip, status, create_at, file_shal) "
            . "VALUES (NULL, :file_name:, :file_path:, :file_ext:, :file_size:, :type:, :upload_ip:, :status:, :create_at:, :file_shal:)";

        $data = [];
        foreach ($files as $file){
            $query = $this->modelsManager->createQuery($phql);
            $bindParam = [
                "file_name" => $file['fileName'],
                "file_path" => $file['savePath'],
                "file_ext" => $file['ext'],
                "file_size" => $file['size'],
                "type" => $file['type'],
                "upload_ip" => get_client_ip(),
                "status" => ENABLED_STATUS,
                "create_at" => get_datetime(),
                "file_shal" => $file['sha1'],
            ];
            $result = $query->execute($bindParam);
            if($result)
                $data[] = [
                    "file_name" => $file['fileName'],
                    "file_path" => $file['savePath'],
                    "file_ext" => $file['ext'],
                    "file_size" => $file['size'],
                ];
        }
        return $data;
    }

}
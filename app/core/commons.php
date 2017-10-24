<?php


$loadCommons = array_merge(['common'],array_keys($modules));
$functionDir = 'common';
$functionFileName = 'functions.php';

try{
    for($i = 0;$i < count($loadCommons);$i++){
        $currModule = $loadCommons[$i];
        $path = APP_PATH.DIRECTORY_SEPARATOR.$currModule.DIRECTORY_SEPARATOR.$functionDir.DIRECTORY_SEPARATOR.$functionFileName;
        if(file_exists($path))
            include $path;
    }
}catch (Exception $e){
    throw new \Exception("File not found!");
}


?>


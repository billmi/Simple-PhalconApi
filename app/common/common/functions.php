<?php

/**
 * get_config
 * @param string $first
 * @param string $sec
 * @param string $configName
 * @return mixed
 * @author Bill
 */
function get_config($first = '',$sec = '',$configName = 'systemConfig'){
    $config = \Phalcon\Di::getDefault()->get($configName)->toArray();
    if(!empty($sec))
        return $config[$first][$sec];
    return $config[$first];
}

/**
 * get_mu_model
 * @param string $tableName
 * @param string $prefix
 * @param string $db
 * @return mixed
 * @author Bill
 */
function get_mu_model($tableName = '', $prefix = '', $db = 'db')
{
    static $diStatic = [];
    $modelSource = $prefix . $tableName;
    if (isset($diStatic[$db][$modelSource]) && !empty($diStatic[$db][$modelSource]))
        return $diStatic[$db][$modelSource];
    $custModel = new \Marser\App\Frontend\Models\CustomerModel();
    $diStatic[$db][$modelSource] = $custModel->getCustSource($tableName,$prefix,$db);
    return $diStatic[$db][$modelSource];
}

/**
 * get_share
 * @param string $server
 * @return mixed
 * @author Bill
 */
function get_share($server = ''){
    $factoryDefault = new Phalcon\Di\FactoryDefault();
    return $factoryDefault->getShared($server);
}

/**
 * arr2str
 * @param $arr
 * @param string $sep
 * @return string
 * @author Bill
 */
function arr2str($arr, $sep = ',')
{
    return implode($sep, $arr);
}

/**
 * arr2str
 * @param $arr
 * @param string $sep
 * @return string
 * @author Bill
 */
function str2arr($str, $sep = ',')
{
    return explode($sep, $str);
}

function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
{
    $tree = array();

    if (is_array($list)) {
        $refer = array();

        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = &$list[$key];
        }

        foreach ($list as $key => $data) {
            $parentId = $data[$pid];

            if ($root == $parentId) {
                $tree[] = &$list[$key];
            }
            else if (isset($refer[$parentId])) {
                $parent = &$refer[$parentId];
                $parent[$child][] = &$list[$key];
            }
        }
    }

    return $tree;
}

function tree_to_list($tree, $child = '_child', $order = 'id', &$list = array())
{
    if (is_array($tree)) {
        $refer = array();

        foreach ($tree as $key => $value) {
            $reffer = $value;

            if (isset($reffer[$child])) {
                unset($reffer[$child]);
                tree_to_list($value[$child], $child, $order, $list);
            }

            $list[] = $reffer;
        }

        $list = list_sort_by($list, $order, $sortby = 'asc');
    }

    return $list;
}

function list_sort_by($list, $field, $sortby = 'asc')
{
    if (is_array($list)) {
        $refer = $resultSet = array();

        foreach ($list as $i => $data) {
            $refer[$i] = &$data[$field];
        }

        switch ($sortby) {
            case 'asc':
                asort($refer);
                break;

            case 'desc':
                arsort($refer);
                break;

            case 'nat':
                natcasesort($refer);
        }

        foreach ($refer as $key => $val) {
            $resultSet[] = &$list[$key];
        }

        return $resultSet;
    }

    return false;
}

function list_search($list, $condition)
{
    if (is_string($condition)) {
        parse_str($condition, $condition);
    }

    $resultSet = array();

    foreach ($list as $key => $data) {
        $find = false;

        foreach ($condition as $field => $value) {
            if (isset($data[$field])) {
                if (0 === strpos($value, '/')) {
                    $find = preg_match($value, $data[$field]);
                }
                else if ($data[$field] == $value) {
                    $find = true;
                }
            }
        }

        if ($find) {
            $resultSet[] = &$list[$key];
        }
    }

    return $resultSet;
}

/**
 * 文件下载
 * DownloadFile
 * @param $fileName
 * @author Bill
 */
function DownloadFile($fileName)
{
    ob_end_clean();
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Length: ' . filesize($fileName));
    header('Content-Disposition: attachment; filename=' . basename($fileName));
    readfile($fileName);
}

/**
 * 身份证检测
 * is_idcard
 * @param $id
 * @return bool
 * @author Bill
 */
function is_idcard( $id )
{
    $id = strtoupper($id);
    $regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/";
    $arr_split = array();
    if(!preg_match($regx, $id))
    {
        return FALSE;
    }
    if(15==strlen($id)) //检查15位
    {
        $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";

        @preg_match($regx, $id, $arr_split);
        //检查生日日期是否正确
        $dtm_birth = "19".$arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];
        if(!strtotime($dtm_birth))
        {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    else      //检查18位
    {
        $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/";
        @preg_match($regx, $id, $arr_split);
        $dtm_birth = $arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];
        if(!strtotime($dtm_birth)) //检查生日日期是否正确
        {
            return FALSE;
        }
        else
        {
            //检验18位身份证的校验码是否正确。
            //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
            $arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
            $arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
            $sign = 0;
            for ( $i = 0; $i < 17; $i++ )
            {
                $b = (int) $id{$i};
                $w = $arr_int[$i];
                $sign += $b * $w;
            }
            $n = $sign % 11;
            $val_num = $arr_ch[$n];
            if ($val_num != substr($id,17, 1))
            {
                return FALSE;
            } //phpfensi.com
            else
            {
                return TRUE;
            }
        }
    }

}

/**
 * 填充
 * @param string $name
 */
function get_fill_name($name = '',$contentFill = "****"){
    $length   = strlen($name);
    $fillName = '';
    if($length >= 2){
        $fillName = $name[0] . $contentFill . $name[$length-1];
    }else{
        $fillName = $name . $contentFill;
    }
    return $fillName;
}

/**
 * 获取短信操作验证key
 * get_message_action_code
 * @param int $code
 * @return mixed
 * @author Bill
 */
function get_message_action_code($code = 0){
    $actionCodeMap = [
        '1' => "pwd",         //找回密码
        '2' => "tx",          //提现
        '3' => "paypwd",      //找回支付密码
        '4' => "repaypwd",    //修改交易密码
        '5' => "zc",          //转出币
        '11'=> "login",        //登录操作
        '12'=> "register",     //注册
        '13'=> "moblebind"     //手机绑定
    ];
    return $actionCodeMap[$code];
}

/**
 * 检测是否手机号码
 * @param string $mobileCode
 * @return bool
 * @author Bill
 */
function is_mobile_code($mobileCode = ''){
    if(empty($mobileCode))
        return false;
    if(!preg_match('/^1[34578]{1}\d{9}$/',$mobileCode))
        return false;
    return true;

}


/**
 * 身份证填充
 * @param $idcard
 * @return string
 * @author Bill
 */
function idcard_mbstring($idcard){
    return substr($idcard,0,4) . "********" .substr($idcard,strlen($idcard)-4);
}

/**
 * 转换
 * @author:Bill
 */
if(!function_exists('array_column_flip')){
    function array_column_flip($data = [],$key = 'id'){
        if(empty($data))
            return false;
        $newData = [];
        foreach ($data AS $index => $row){
            $currKey = $row[$key];
            $newData[$currKey] = $row;
        }
        return $newData;
    }
}

/**
 * 手机号码填充
 * @param $moble
 * @return string
 * @author Bill
 */
function star_fill_moble($moble){
    if(strlen($moble) == 11)
        return substr($moble,0,3) . " **** " . substr($moble,strlen($moble)-4);
    return $moble;
}

/**
 * 变量调试
 *
 * @return string
 */
function dump($var, $echo = true, $label = null, $strict = true) {
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace("/\]\=\>\n(\s+)/m", '] => ', $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    } else {
        return $output;
    }
}

/**
 * 加密解密字符串
 *
 * @param string $string        需要加密解密的字符串
 * @param string $key           加密的钥匙(密匙)
 * @param string $operation     判断是加密还是解密      decode:解密  encode:加密
 * @example
 * <pre>
 *    加密 :encrypt('str','nowamagic','encode');
 *    解密 :encrypt('被加密过的字符串','nowamagic','decode');
 * </pre>
 * @return string
 */
function encrypt($string = '', $key = '', $operation = 'decode') {
    $key = md5($key);
    $key_length = strlen($key);
    $string = $operation == 'decode' ? base64_decode($string) : substr(md5($string . $key), 0, 8) . $string;
    $string_length = strlen($string);
    $rndkey = $box = array();
    $result = '';
    for ($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($key[$i % $key_length]);
        $box[$i] = $i;
    }
    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for ($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result.=chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if ($operation == 'decode') {
        if (substr($result, 0, 8) == substr(md5(substr($result, 8) . $key), 0, 8)) {
            return substr($result, 8);
        } else {
            return'';
        }
    } else {
        return str_replace('=', '', base64_encode($result));
    }
}

/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv 是否进行高级模式获取（有可能被伪装）
 * @return mixed
 */
function get_client_ip($type = 0,$adv=false) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if($adv){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

//curl get 请求
function curlGet($url, $headers = []) {

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

function curlPost($url, $data = null, $contentType = 'json') {
    $ret = false;
    $headers = array();
    $ch = curl_init($url);
    $urlParse = parse_url($url);
    if($urlParse['scheme']=='http'){
        $port = isset($urlParse['port']) ? $urlParse['port'] : 80;
    }else{
        $port = 443;
    }
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_PORT, $port); //设置端口
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    switch ($contentType) {
        case 'json':
            $headers = array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            );
            break;
        case 'x-www-form-urlencoded':
            $headers = array(
                'Content-Type: application/x-www-form-urlencoded',
                'Content-Length: ' . strlen($data)
            );
            break;
        case 'form-data' :
            break;
    }

    if (!empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    $ret = curl_exec($ch);
    curl_close($ch); // 关闭CURL会话
    return $ret;
}

/**
 * 数据签名认证
 * @param  array $data 被认证的数据
 * @return string       签名
 */
function data_auth_sign($data)
{
    if (!is_array($data)) {
        $data = (array)$data;
    }
    ksort($data); //排序
    $code = http_build_query($data); //url编码并生成query字符串
    $sign = sha1($code); //生成签名
    return $sign;
}

/**
 * 生成唯一邀请码
 * @param $length
 * @param int $numeric
 * @return string
 * @author : Bill
 */
function random_code($length, $numeric = 0)
{
    $seed = base_convert(md5(microtime() . 'start-chain'), 16, $numeric ? 10 : 35);
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
 * session重写
 * session
 * @author Bill
 */
function session($name = '',$value = ''){
     $session = \Marser\App\Helpers\DiHelper::getSessionService();
     if($value === ''){
         return $session->get($name);
     }else if(is_null($value)){
         $session->remove($name);
     }else if(!empty($name) && !empty($value)){
         $session->set($name,$value);
     }
}



/**
 * 模型对象获取
 * @param string $modelName
 * @return \Marser\App\Core\PhalBaseModel|object
 * @author Bill
 */
function M($modelName = ''){
    if($modelName == ''){

    }else{
        return \Marser\App\Frontend\Models\ModelFactory::get_model($modelName);
    }
}

//保存日志记录
function saveLog($file, $text , $level = 0)
{
    $text ='[' . date('Y-m-d h:i:s',time()) . '][' . $level .']'. $text . "\n";
    file_put_contents(ROOT_PATH . '/log/log/'.$file.'_'.date('Ymd').'.log', $text, FILE_APPEND);
}

/**
 * get_curr_datetime
 * @author Bill
 */
function get_datetime($time = 0){
    if($time == 0)
        $time = time();
    return date("Y-m-d H:i:s",$time);
}

?>
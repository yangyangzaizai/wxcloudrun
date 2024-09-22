<?php

// 应用公共文件
use think\facade\Cache;
use think\facade\Db;
use app\admin\model\Config;
use think\facade\Request;

if (!function_exists('getAdminId')) {
    /**
     * 获取用户ID
     * @return mixed
     */
    function getAdminId()
    {
        $data = session('admin_info.admin_id');
        return $data;
    }
}

if (!function_exists('data_sign')) {
    /**
     * 数据签名认证
     * @param  array $data 被认证的数据
     * @return string       签名
     */
    function data_sign($data)
    {
        // 数据类型检测
        if (!is_array($data)) {
            $data = (array)$data;
        }
        ksort($data); // 排序
        $code = http_build_query($data); // url编码并生成query字符串
        $secretKey = Request::param('secretKey');
        if($secretKey){
            $code = $secretKey.$code.$secretKey;
        }
        $sign = sha1($code); // 生成签名
        return $sign;
    }
}

/**
 * 返回json数据，用于接口
 * @param    integer    $code
 * @param    string     $msg
 * @param    array      $data
 * @param    string     $url
 * @param    integer    $httpCode
 * @param    array      $header
 * @param    array      $options
 * @return   json
 */
function to_assign($code = 0, $msg = "操作成功", $data = [], $url = '', $httpCode = 200, $header = [], $options = [])
{
    $res = ['code' => $code];
    $res['msg'] = $msg;
    $res['url'] = $url;
    $res['time'] = time();
    if (is_object($data)) {
        $data = $data->toArray();
    }
    $res['data'] = $data;
    $response = \think\Response::create($res, "json", $httpCode, $header, $options);
    throw new \think\exception\HttpResponseException($response);
}

if (!function_exists('list_to_tree')) {
    /**
     * 把返回的数据集转换成Tree
     * @param $list 要转换的数据集
     * @param bool $disabled 渲染下拉树xmSelect时，有子类不可选择，默认可选
     * @param string $pk
     * @param string $pid
     * @param string $children 有子类时添加children数组
     * @param int $root
     * @return array
     */
    function list_to_tree($list, $disabled = false, $pk='id', $pid = 'pid', $children = 'children', $root = 0)
    {
        // 创建Tree
        $tree = array();
        if(is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }

            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId =  $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                }else{
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$children][] =& $list[$key];
                        $disabled ? $parent['disabled'] = true : '';
                    }
                }
            }
        }
        return $tree;
    }
}

//获取url参数
function get_params($key = "")
{
    return Request::instance()->param($key);
}

//密码加密
function set_password($pwd, $salt)
{
    return md5(md5($pwd . $salt) . $salt);
}

//生成一个不会重复的字符串
function make_token()
{
    $str = md5(uniqid(md5(microtime(true)), true));
    $str = sha1($str); //加密
    return $str;
}

//随机字符串，默认长度10
function set_salt($num = 10)
{
    $str = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890';
    $salt = substr(str_shuffle($str), 10, $num);
    return $salt;
}

function time_calculate($amount = '1',$type,$time = null) {
    if($type == 1){
        $time_sm = '+'.$amount.'hour';
    }elseif ($type == 2) {
        $time_sm = '+'.$amount.'week';
    }elseif ($type == 3) {
        $time_sm = '+'.$amount.'month';
    }elseif ($type == 4) {
        $time_sm = '+'.$amount.'year';
    }elseif ($type == 5) {
        $time_sm = '+30year';
    }
    if($time != ''){
        $data = date('Y-m-d H:i:s',strtotime($time_sm,$time));
    }else{
        $data = date('Y-m-d H:i:s',strtotime($time_sm));
    }
    //echo $data;
    return $data;
}

function time_kouculate($amount = '1',$type,$time = null) {
    if($type == 1){
        $time_sm = '-'.$amount.'hour';
    }elseif ($type == 2) {
        $time_sm = '-'.$amount.'week';
    }elseif ($type == 3) {
        $time_sm = '-'.$amount.'month';
    }elseif ($type == 4) {
        $time_sm = '-'.$amount.'year';
    }
    if($time != ''){
        $data = date('Y-m-d H:i:s',strtotime($time_sm,$time));
    }else{
        $data = date('Y-m-d H:i:s',strtotime($time_sm));
    }
    //echo $data;
    return $data;
}

function get_system_config($type,$assign='')
{
    $result = Db::name('config')->where('type', $type)->find();
    if ($result == true) {
        if($assign != ''){
            $data = Db::name('config')->where('type', $type)->find()['value'];
        }else{
            $data = Db::name('config')->where('type', $type)->find()['value'];
        }
        return $data;
    }
}

function get_sconfig($types,$assigns='')
{
    $data = Config::getConfigData($types);
    return $data[$assigns];
}

//设置缓存
function set_cache($key, $value, $date = 86400)
{
    Cache::set($key, $value, $date);
}

//读取缓存
function get_cache($key)
{
    return Cache::get($key);
}

function rc4 ($pwd, $data) {
    $key[] ="";
    $box[] ="";
    $pwd_length = strlen($pwd);
    $data_length = strlen($data);
    for ($i = 0; $i < 256; $i++) {
        $key[$i] = ord($pwd[$i % $pwd_length]);
        $box[$i] = $i;
    }
    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $key[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for ($a = $j = $i = 0; $i < $data_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $k = $box[(($box[$a] + $box[$j]) %256)];
        @$cipher .= chr(ord($data[$i]) ^ $k);
    }
    return $cipher;
}

function hexToStr($hex)
{
    $string="";
    for   ($i=0;$i<strlen($hex)-1;$i+=2)
        $string.=chr(hexdec($hex[$i].$hex[$i+1]));
    return   $string;
}
function strToHex($string)
{
    return substr(chunk_split(bin2hex($string)),0,-2);

}
function rc4a($key,$string)
{
    return strToHex(rc4($key,$string));
}
function rc4b($key,$string)
{
    return  @rc4($key,pack('H*',$string));
}


function curl_posts($sUrl, $aHeader){
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $sUrl);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 0);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($curl, CURLOPT_HTTPHEADER, $aHeader);
    //执行命令
    $data = curl_exec($curl);
    //关闭URL请求
    curl_close($curl);
    return $data;
}

function yc($type,$post_data = null){
    if($type == 1){
        $sm = 'versions';
    }elseif ($type == 2){
        $sm = 'wenz';
    }elseif ($type == 3){
        $sm = 'xq';
    }elseif ($type == 4){
        $sm = 'anbao';
    }elseif ($type == 5){
        $sm = 'yijian';
    }
    $urls = 'http://api.dream-kc.com/api/index/'.$sm;
    //初始化
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $urls);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
    if($post_data != null){
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    }
    $data = curl_exec($curl);
    curl_close($curl);
    //显示获得的数据
    return $data;
}



function getFile($url, $save_dir = '', $filename = '', $type = 0) {
    if (trim($url) == '') {
        return false;
    }
    if (trim($save_dir) == '') {
        $save_dir = './';
    }
    if (0 !== strrpos($save_dir, '/')) {
        $save_dir.= '/';
    }
    //创建保存目录
    if (!file_exists($save_dir) && !mkdir($save_dir, 0777, true)) {
        return false;
    }
    //获取远程文件所采用的方法
    if ($type) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $content = curl_exec($ch);
        curl_close($ch);
    } else {
        ob_start();
        readfile($url);
        $content = ob_get_contents();
        ob_end_clean();
    }
    $size = strlen($content);
    //文件大小
    $fp2 = @fopen($save_dir . $filename, 'a');
    fwrite($fp2, $content);
    fclose($fp2);
    unset($content, $url);
    return array(
        'file_name' => $filename,
        'save_path' => $save_dir . $filename
    );
}


function insert($file,$database,$name,$root,$pwd)//
{
    //将表导入数据库
    header("Content-type: text/html; charset=utf-8");
    $_sql = file_get_contents($file);//写自己的.sql文件
    $_arr = explode(';', $_sql);

    foreach ($_arr as $_value) {
        $sql = $_value.';';
        Db::query($sql);
    }

}

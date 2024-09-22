<?php

// [ 应用入口文件 ]
namespace think;

require __DIR__ . '/../vendor/autoload.php';

if (!file_exists(__DIR__ .'/../config/install.lock')) {
    header("location:/install/index.php");
    exit;
}
define('xzversion', '3.1.8');
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");

// 执行HTTP应用并响应
$http = (new App())->http;

$response = $http->run();

$response->send();

$http->end($response);

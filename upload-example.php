<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------
include "vendor/autoload.php";

$config = new Yangyao\Ftp\Config([
    'host'=>'xx.xx.xx.xx',
    'port'=>'21',
    'timeout'=>90,
    'username'=>'xx',
    'password'=>base64_decode('xxx=='),
]);
$ftp = new Yangyao\Ftp\Ftp($config);
$ftp->connect();

$fileFrom = 'C:/Users/xxx/Desktop/opcache.php';
$fileTo = '/web/xx/xx/opcache.php';

$ftp->uploadFile($fileFrom,$fileTo);
$ftp->disconnect();

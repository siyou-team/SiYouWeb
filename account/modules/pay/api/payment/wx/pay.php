<?php

ini_set('display_errors', 1);
define('DIST', 'src');
define('DS', DIRECTORY_SEPARATOR);

//是否开启runtime，如果为false，则不生成runtime缓存
define('RUNTIME', false);

//是否开启debug，如果为true，则不生成runtime缓存
define('DEBUG', true);


$_REQUEST['mdu'] = 'pay';
$_REQUEST['ctl'] = 'Index';
$_REQUEST['met'] = 'pay';


$index_page = 'account.php';
$app_name = 'account';

define('APP_DIR_NAME', $app_name);
define('ROOT_PATH', str_replace(DS, '/', substr(dirname(__FILE__), 0, -(26 + strlen(APP_DIR_NAME) + strlen(DS)*2))));
define('LIB_PATH', ROOT_PATH . '/libraries');   //ZeroPHP Framework 所在目录
define('APP_PATH', ROOT_PATH . '/' . APP_DIR_NAME);         //应用程序目录
define('MOD_PATH', APP_PATH . '/models');       //应用程序模型目录
define('INI_PATH', ROOT_PATH . '/shop/configs');      //应用程序配置文件目录

global $import_file_row;

if (!isset($import_file_row))
{
    $import_file_row = array();
}

//公用函数库
require_once LIB_PATH . '/__init__.php';
require_once '../../../../../../shop/configs/config.ini.php';

$data = trim($_SERVER['PATH_INFO'], '/');

if (false)
{
    $data = htmlspecialchars_decode($data);
}
else
{
    //参数md5, 存入cache？，
    $cache = Zero_Cache::create('verify_code');
    $data = $cache->get($data);
}

$_REQUEST = $_REQUEST + (array)decode_json($data);

Zero_App::start();
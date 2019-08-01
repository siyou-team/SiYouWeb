<?php
ob_start();

/**
 * main config
 *
 *
 * @category   Config
 * @package    Config
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
defined('VER') || define('VER', '1.02');
defined('DIST') || define('DIST', 'src');
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
//是否开启debug，如果为true，则不生成runtime缓存
defined('DEBUG') || define('DEBUG', false);

//是否开启runtime，如果为false，则不生成runtime缓存
defined('RUNTIME') || define('RUNTIME', false);

//错误显示
if (DEBUG)
{
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}
else
{
    ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
}

//定义系统路径
if (!defined('ROOT_PATH'))
{
    define('APP_DIR_NAME', 'shop');
    define('ROOT_PATH', str_replace(DS, '/', substr(dirname(__FILE__), 0, -(7 + strlen(APP_DIR_NAME) + strlen(DS)*2))));
    define('LIB_PATH', ROOT_PATH . DS . 'libraries');   //ZeroPHP Framework 所在目录
    define('APP_PATH', ROOT_PATH . DS . APP_DIR_NAME);         //应用程序目录
    define('MOD_PATH', APP_PATH . DS . 'models');       //应用程序模型目录
    define('INI_PATH', APP_PATH . '/configs');

    global $import_file_row;

    if (!isset($import_file_row))
    {
        $import_file_row = array();
    }

    //公用函数库
    require_once LIB_PATH . '/__init__.php';

    //初始化Friendly Url
    //require_once APP_PATH . '/configs/routes.ini.php';
}
else
{
}

$data_id = 1;
define('DATA_ID', $data_id);
define('DATA_PATH', APP_PATH . DS . 'data' . DS . $data_id);

define('LAN_PATH', APP_PATH  . DS . 'data' . DS . 'locales');
define('LOG_PATH',  DATA_PATH . DS . 'logs');


if (!is_dir(DATA_PATH))
{
	mkdir_r(DATA_PATH);
}

define('HLP_PATH', APP_PATH . '/helpers');
defined('TYP') || define('TYP', isset($default_typ) ? $default_typ : 'e');

//允许后台修改的设置信息, 可以考虑将所有的都设置进来. 将所有设置,都放到一个数组中,统一引入.
//$config_row = Base_ConfigModel::getInstance()->load('global');

//$config_row = require_once APP_PATH . '/configs/global.ini.php';
$config_row = Zero_Config::load('global');

//start request filed
$registry['request'] = new Zero_Request();
//end request filed

/**
 * 风格变量名称$themes_name勿修改
 *
 * @var string
 */
//启用的风格名称
$themes_name = 'test';
$themes_path =  '/' . APP_DIR_NAME . '/static/' . DIST . '/' . $themes_name;

//系统默认风格
$themes_system_name = 'default';
$themes_system_path =  '/' . APP_DIR_NAME . '/static/' . DIST . '/' . $themes_system_name;

$pro_path =  '';

if (isset($_SERVER['DOCUMENT_ROOT']) && $_SERVER['DOCUMENT_ROOT'])
{
    $pro_path_row = explode($_SERVER['DOCUMENT_ROOT'], ROOT_PATH);

    if (isset($pro_path_row[1]) && $pro_path = trim($pro_path_row[1], '/'))
    {
        $pro_path = '/' . $pro_path;
        $themes = $pro_path . $themes_path;
        $themes_system = $pro_path . $themes_system_path;
    }
    else
    {
        $themes = $themes_path;
        $themes_system = $themes_system_path;
    }
}
else
{
    $themes = $themes_path;
    $themes_system = $themes_system_path;
}

//应用程序默认视图目录
define('TPL_DEFAULT_PATH', APP_PATH . '/views/' . $themes_system_name);
define('TPL_PATH', APP_PATH . '/views/' . $themes_name);

define('STATIC_PATH', ROOT_PATH . $themes_path);
define('STATIC_DEFAULT_PATH', ROOT_PATH . $themes_system_path);


if (!array_key_exists('date_default_timezone_set', $config_row))
{
    $config_row['date_default_timezone_set'] = 'PRC';
	$registry['date_default_timezone_set'] = $config_row['date_default_timezone_set'];
}

//设置时区
if (function_exists('date_default_timezone_set'))
{
	date_default_timezone_set($config_row['date_default_timezone_set']);
}
else
{
	ini_set('date.timezone', $config_row['date_default_timezone_set']);
}

//记录错误提示
ini_set('log_errors', 1);

//设置错误日志的路径
ini_set('error_log', APP_PATH . '/data/logs/error_log_' . date('Y-m-d') . '.log');
//ini_set('error_log', 'syslog');

define('CODE_TEMPLATE_PATH', ROOT_PATH . '/build_tools/code_template');
define("CONTROLLER_CLASS_NAME", ''); //控制器class前缀
define("MODEL_CLASS_NAME", ''); //模型class前缀

define("TABLE_PREFIX", 'shop_'); //表前缀
define("TABLE_SHOP_BASE_PREFIX", 'shop_'); //基础数据表前缀
define("TABLE_SHOP_DATA_PREFIX", 'shop_'); //数据表前缀
define("TABLE_SHOP_DATA_EXT_PREFIX", 'shop_'); //扩展数据表前缀
define("TABLE_SHOP_LOG_PREFIX", 'shop_'); //日志表前缀
define("TABLE_PAY_PREFIX", 'pay_'); //支付表前缀

//初始化语言包
if (function_exists('_'))
{
    if (!isset($config_row['language_id']))
    {
        $config_row['language_id'] = 'zh_CN';
    }

    define('LANG', $config_row['language_id']);
    //init_locale(APP_PATH . '/data/locales/', LANG, 'HelloWorld');   //初始化，只需要一次即可
    //textdomain('HelloWorld');
}

$host = '';

if (isset($_SERVER['HTTP_HOST']))
{
	$host = $_SERVER['HTTP_HOST'];
}

$app_uri = $pro_path . DS . APP_DIR_NAME;
$base_url = 'http://'. $host . $pro_path . '/install';
$index_page = 'index.php';

$registry['app_uri'] = $app_uri;
$registry['base_url'] = $base_url;
$registry['index_page'] = $index_page;
$registry['url'] = $base_url . '/' . $index_page;

$registry['static_url'] = 'http://'. $host . $themes;
$registry['static_default_url'] = 'http://'. $host . $themes_system;

$registry['app_url'] = 'http://'. $host . $pro_path . '/' . APP_DIR_NAME;
$registry['static_lib_url'] = 'http://'. $host . $pro_path . '/' . APP_DIR_NAME . '/static/' . DIST . '/common';
$registry['error_url'] = $base_url . '/error.php';


if ('cli' != SAPI)
{
    set_time_limit(5); //运行时间限制一定要有的。 切记！
	
	$gzipcompress = @$config_row['gzipcompress'];

	//调用之前禁止任何输出
	//start response filed
	// Response
	$response = new Zero_Response();
	$response->addHeader('Content-Type: text/html; charset=utf-8');
	//$response->setCompression($config->get('config_compression'));
	
	$registry['response'] = $response;
	//end response filed
	
    //负载控制，理论上，不高于处理器数目*0.7，因为机器高峰负载，可以高一些。
    if (array_key_exists('loadctrl', $registry))
    {
        if (!function_exists('sys_getloadavg'))
        {
            function sys_getloadavg()
            {
                //$loadavg_file = '/proc/loadavg';
                //if (is_file($loadavg_file)) {
                //return explode(chr(32),file_get_contents($loadavg_file));
                //}

                if ('WIN' != substr(PHP_OS, 0, 3))
                {
                    if ($fp = @fopen('/proc/loadavg', 'r'))
                    {
                        $loadaverage = explode(' ', fread($fp, 6));
                        fclose($fp);

                        return $loadaverage;
                    }
                }
                else
                {
					return array(0, 0, 0);
                }
            }
        }

        $loadaverage = sys_getloadavg();
	
        if ($loadaverage[0] > $registry['loadctrl'])
        {
			$error_msg = __('Server Too busy, please try again later!');
			error_header(503,  $error_msg);

			throw new Zero_Exception_Protocol($error_msg, 503);
        }
    }
}

define('CHE', isset($config_row['cache']) ? $config_row['cache'] : 0);

if (true || CHE)
{
	//cacheType 1:file  2:memcache   3：redis
	if (extension_loaded('memcached') && class_exists('Memcached', false))
	{
		$cache_type = 2;
	}
	elseif (extension_loaded('memcache') && class_exists('Memcache', false))
	{
		$cache_type = 2;
	}
	else
	{
		$cache_type = 1;
	}
	
	//cache配置参数
	//$config_row['config_cache'] = require_once INI_INSTALL_PATH . '/cache.ini.php';
	//$config_row = Zero_Config::load('cache') + $config_row;
	Zero_Config::load('cache');

	//$config_cache = $registry['config_cache'];
	
}

//start db.ini 包含Db配置文件，如果使用DB，配置格式必须严格按照如下格式
//require_once INI_INSTALL_PATH . '/db.ini.php';
//$config_row = Zero_Config::load('db') + $config_row;
Zero_Config::load('db');


if (extension_loaded('PDO') && extension_loaded('pdo_mysql'))
{
    define('DB_DRIVE', 'Zero_Db_Pdo');
}
else
{
    define('DB_DRIVE', 'Zero_Db_Pear');
}

define('DB_DEBUG', true);

//通过这儿设置默认Db， 决定master/slave
if (isset($ccmd_rows[$_REQUEST['ctl']][$_REQUEST['met']]['db']))
{
	$registry['db_cfg']['db_write_read'] = $ccmd_rows[$_REQUEST['ctl']][$_REQUEST['met']]['db'];
}
else
{
	$registry['db_cfg']['db_write_read'] = 'master';
}

if (isset($ccmd_rows))
{
	$registry['ccmd_rows'] = $ccmd_rows;
}

$PluginManager = Zero_Plugin_Manager::getInstance(array());
$PluginManager->trigger('init', '');

$registry['hook'] = $PluginManager;

$registry['queue_key_prefix'] = sprintf('_queue_%s_', $data_id);

//特殊的cache_id ,  统一调用,不要内部命名.

$registry['cache_site_index'] = 'site_index';
?>

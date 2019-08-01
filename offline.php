<?php
/**
 * 入口文件
 *
 * 所有程序调用的入口， 此文件属于框架的一部分，任何人不允许修改！
 *
 * @category   Framework
 * @package    __init__
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
define('DIST', 'src');
define('DS', DIRECTORY_SEPARATOR);

//是否开启runtime，如果为false，则不生成runtime缓存
define('RUNTIME', false);

//是否开启debug，如果为true，则不生成runtime缓存
define('DEBUG', false);

//设置开始的时间
$mtime =  explode(' ',  microtime());
$app_starttime = $mtime[1] + $mtime[0];

//通过不同的PHP，rewrite来完成吧
if (array_key_exists('app', $_GET))
{
    $app_name = strtolower($_GET['app']);
}
else
{
    $app_name = 'account';
}
$index_page = pathinfo(__FILE__, PATHINFO_BASENAME);

define('APP_DIR_NAME', 'off');
define('ROOT_PATH',  str_replace(DS, '/', dirname(__FILE__)));
define('LIB_PATH', ROOT_PATH . '/libraries');   //ZeroPHP Framework 所在目录
define('APP_PATH', ROOT_PATH . '/' . APP_DIR_NAME);         //应用程序目录
define('MOD_PATH', APP_PATH . '/models');       //应用程序模型目录
define('INI_PATH', ROOT_PATH . '/shop/configs');      //应用程序配置文件目录

//加载协议解析文件
require_once INI_PATH . '/protocol.ini.php';
$version_row = require_once INI_PATH . '/version.ini.php';

//版本
if ($version_row)
{
	define('VER', isset($version_row['shop']) ? $version_row['shop'] : '1.01');
}
else
{
	define('VER', '1.01');
}

if (RUNTIME)
{
	/**
	 * runtime文件名称
	 *
	 * @var string
	 */
	global $runtime;
    
    if (isset($_SERVER['PATH_INFO']))
    {
        $value = $_SERVER['PATH_INFO'];
    }
    elseif (isset($_SERVER['ORIG_PATH_INFO']))
    {
        $value = $_SERVER['ORIG_PATH_INFO'];
    }
    else
    {
        $value = @getenv('PATH_INFO');
        if (empty($value))
        {
            $value = @getenv('ORIG_PATH_INFO');
        }
    }
    
    $_SERVER['PATH_INFO'] = trim($value, '/');
    
    if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'])
    {
        $path_info_get = explode('/', $_SERVER['PATH_INFO']);
        
        if (isset($path_info_get[0]))
        {
            $runtime = implode('/', explode('_', $path_info_get[0]));
        }
        else
        {
            $runtime = 'Index';
        }
    }
    else
    {
        if (isset($_REQUEST['ctl']))
        {
            $runtime = implode('/', explode('_', $_REQUEST['ctl']));
        }
        else
        {
            $runtime = 'Index';
        }
    }

	/**
	 * runtime文件路径
	 *
	 * @var string
	 */
	$runtime_file = APP_PATH . '/data/runtime/' . VER . '/' .  $runtime . '.php';
}

/**
 * 保存加载过的文件，只记录class或者记录按照顺序执行的全局文件。
 *
 * @var array
 */
global $import_file_row;

$import_file_row = array();


try
{
	/**
	 * 计算是否需要从runtime运行
	 */
	if (RUNTIME && is_file($runtime_file))
	{
		include_once $runtime_file;
	}
	else
	{
		array_push($import_file_row, LIB_PATH . '/__init__.php');
		array_push($import_file_row, APP_PATH . '/configs/config.ini.php');

		//初始化Zero
		require_once LIB_PATH . '/__init__.php';

		//引入用户配置文件
		require_once INI_PATH . '/config.ini.php';
	}

	if (RUNTIME)
	{
		Zero_Registry::set('runtime', $runtime);
		Zero_Registry::set('runtime_file', $runtime_file);
	}

	//var_dump($import_file_row);
	//程序控制器启动，计算结果

	Zero_App::start();

	$PluginManager->trigger('end', '');
}
catch(Zero_Exception_Protocol $e)
{
	if ('cli' != SAPI)
	{
		if (Zero_Registry::get('error_url') && 'e'==$_REQUEST['typ'])
		{
			$error_msg = $e->getMessage();
			$error_code = $e->getCode();
			$app_url = Zero_Registry::get('app_url');

			if (DEBUG)
			{

				$error_file = ROOT_PATH . '/error.php';

				if (is_file($error_file))
				{
					include $error_file;
				}
				else
				{
					echo $error_msg;
				}
			}
			else
			{
				location_to(sprintf('%s?msg=%s&code=%s&app_url=%s', Zero_Registry::get('error_url'), $error_msg, $error_code, urlencode($app_url)));
			}

			die();
		}

		$Data = new Zero_Data();

		$Data->setError($e->getMessage(), $e->getCode(), $e->getId());
		$d = $Data->getDataRows();

		$protocol_data = Zero_Data::encodeProtocolData($d);

		echo $protocol_data;
	}
	else
	{
		print_r($e->getMessage());
	}
}
catch(Exception $e)
{
	if ('cli' != SAPI)
	{
		if (Zero_Registry::get('error_url') && 'e'==$_REQUEST['typ'])
		{
			$error_msg = $e->getMessage();
			$error_code = $e->getCode();
			$app_url = Zero_Registry::get('app_url');

			if (DEBUG)
			{
				$error_file = ROOT_PATH . '/error.php';

				if (is_file($error_file))
				{
					include $error_file;
				}
				else
				{
					echo $error_msg;
				}
			}
			else
			{
				location_to(sprintf('%s?msg=%s&code=%s&app_url=%s', Zero_Registry::get('error_url'), $error_msg, $error_code, urlencode($app_url)));
			}

			die();
		}

		$Data = new Zero_Data();

		$Data->setError($e->getMessage(), $e->getCode());
		$d = $Data->getDataRows();

		$protocol_data = Zero_Data::encodeProtocolData($d);

		echo $protocol_data;
	}
	else
	{
		print_r($e->getMessage());
	}
}

//fb($import_file_row);
//$Zero_Registry = Zero_Registry::getInstance();
//$Zero_Registry['sss']['fsdfds'] = 2;

$mtime =  explode(' ',  microtime());
$app_endtime = $mtime[1] + $mtime[0];
fb($app_endtime - $app_starttime, 'time:');


//$Base_CrontabModel = new Base_CrontabModel();
//$rows = $Base_CrontabModel->checkTask();


?>
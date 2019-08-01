<?php
/**
 * 框架初始化文件
 *
 * 将一些处理方式固定化，例如，统一魔术引用, 此为系统函数封装, 业务逻辑函数独立
 *
 * @category   Framework
 * @package    __init__
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
if (!is_php('5.3'))
{
	die('Zero Framework runtime environment required PHP version higher than 5.3！');
}

if (!defined('LIB_PATH'))
{
	die('请先定义框架地址：LIB_PATH');
}

if (version_compare(PHP_VERSION, '5.3', '<'))
{
	spl_autoload_register('framework_autoload');
}
else
{
	spl_autoload_register('framework_autoload', true, true);
}

if (function_exists('__autoload'))
{
	// Be polite and ensure that userland autoload gets retained
	spl_autoload_register('__autoload');
}

$open_basedir_row = array('/proc/', '/tmp/', '/var/run/', ROOT_PATH);

if (defined('DATA_PATH'))
{
		$open_basedir_row[] = DATA_PATH;
}

($upload_tmp_dir = ini_get("upload_tmp_dir")) ? $open_basedir_row[]=$upload_tmp_dir : '';
($temp_dir = sys_get_temp_dir()) ? $open_basedir_row[]=$temp_dir : '';
($session_path = session_save_path()) ? $open_basedir_row[]=$session_path : '';
($open_basedir = ini_get('open_basedir')) ? $open_basedir_row[]=$open_basedir : '';

//ini_set('open_basedir', implode(PATH_SEPARATOR, $open_basedir_row));


$encode_php_file_path = LIB_PATH . '/vendor/php' . floatval(PHP_VERSION);

//跨项目读取Model,只允许读取模型！比如共用User、Pay信息等等。
//config.ini配置表前缀及数据库配置需要一样， 会导致同一个数据记录到不同项目下！
$encode_php_file_path = $encode_php_file_path  . PATH_SEPARATOR . ROOT_PATH . '/account/models'  . PATH_SEPARATOR . ROOT_PATH . '/account/modules/pay/models' . PATH_SEPARATOR . ROOT_PATH . '/shop/models' . PATH_SEPARATOR . ROOT_PATH . '/off/models';

//set_include_path(get_include_path() . PATH_SEPARATOR . LIB_PATH);
set_include_path(LIB_PATH . PATH_SEPARATOR . MOD_PATH . PATH_SEPARATOR . LIB_PATH . '/vendor' . PATH_SEPARATOR . $encode_php_file_path . PATH_SEPARATOR .  LIB_PATH . '/Api');

if (!defined('SAPI'))
{
	define('SAPI', php_sapi_name());
}

//设置转义信息
//如果<5.3,运行。
if (!is_php('5.3'))
{
	ini_set('magic_quotes_runtime', 0);
}

@ini_set('magic_quotes_sybase', 0);




$registry = Zero_Registry::getInstance();
$registry['magic_quotes_gpc'] = get_magic_quotes_gpc();
$registry['magic_quotes_runtime'] = get_magic_quotes_runtime();

function copy_dir($source, $destination)
{
	if (is_dir($source) == false)
	{
		exit("The Source Directory Is Not Exist!");
	}

	if (is_dir($source) !== false)
	{
		mkdir($destination, 0777);
	}

	$handle = opendir($source);

	while (false !== ($file = readdir($handle)))
	{
		if ($file != "." && $file != ".." && $file != ".svn")
		{
			is_dir("$source/$file") ? copy_dir("$source/$file", "$destination/$file") : copy("$source/$file", "$destination/$file");
		}
	}

	closedir($handle);
}

//国际化语言设置
/*
$path    = APP_PATH . '/data/locales/';
$domain  = 'default';
$codeset = 'UTF-8';
$lang    = 'zh_CN';

Zero_Locale::getInstance($path, $domain, $lang, $codeset);
*/
// if( !function_exists('__') ){
// 	function __($text, $domain = null)
// 	{
// 	    if (null === $domain)
// 	    {
// 	        return Zero_Locale::gettext($text);
// 	    }
// 	    else
// 	    {
// 	        return Zero_Locale::dgettext($text, $domain);
// 	    }
// 	}
// }



/**
 * Display translated text.
 *
 * @since 1.2.0
 *
 * @param string $text   Text to translate.
 * @param string $domain Optional. Text domain. Unique identifier for retrieving translated strings.
 *                       Default 'default'.
 */
function _e($text, $domain = 'default' )
{
    // echo __($text, $domain );
}

//$Translate = new Lable();

/**
 * Determines if the current version of PHP is greater then the supplied value
 *
 * Since there are a few places where we conditionally test for PHP > 5
 * we'll set a static variable.
 *
 * @access  public
 * @param   string
 * @return  bool
 */
function is_php($version = '5.0.0')
{
	static $_is_php;
	$version = (string)$version;

	if (!isset($_is_php[$version]))
	{
		$_is_php[$version] = (version_compare(PHP_VERSION, $version) < 0) ? FALSE : TRUE;
	}

	return $_is_php[$version];
}

/**
 * 判断操作系统
 */
function  get_sys()
{
	return substr(PHP_OS, 0, 3);
}

function encode_json($rows, $flag = true)
{
	if (defined('JSON_UNESCAPED_UNICODE'))
	{
		if (DEBUG && $flag)
		{
			return json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		}
		else
		{
			return json_encode($rows, JSON_UNESCAPED_UNICODE);
		}
	}
	else
	{
		return json_encode($rows);
	}
}

function decode_json($rows, $assoc = true)
{
	$data = json_decode($rows, $assoc);

	if ($data === null)
	{
		$error_code = json_last_error();

		if ($error_code !== JSON_ERROR_NONE)
		{
			//系统记录
            Zero_Queue::send('json_decode', sprintf('code : %s - %s - %s', $error_code, $rows, debug_backtrace_summary()));

			//throw  new Exception(__('错误的JSON字符串！'));
		}
	}

	return $data;
}


/**
 * 转义字符函数
 *
 * @param mixed $content contents should be addslashes
 *
 * @return mixed  $content
 *
 */
function quotes(&$content)
{
	if (is_array($content))
	{
		foreach ($content as $key => $value)
		{
			unset($content[$key]);

			$content[quotes($key)] = quotes($value);
		}
	}
	else
	{
		$content = addslashes($content);
	}

	return $content;
}

function unquotes(&$content)
{
	if (is_array($content))
	{
		foreach ($content as $key => $value)
		{
			unset($content[$key]);

			$content[unquotes($key)] = unquotes($value);
		}
	}
	else
	{
		$content = stripslashes($content);
	}

	return $content;
}


function mres($str)
{
	$str = addslashes($str);
	//$str = str_replace('_', '\_', $str); //转义掉”_”
	//$str = str_replace('%', '\%', $str); //转义掉”%”

	//return addslashes($str);
	//return mysql_real_escape_string($str);

	return $str;
}

function addslashes_array($array)
{
	$array = is_array($array) ? array_map('addslashes_array', $array) : addslashes($array);

	return $array;
}

function stripslashes_array($array)
{
	$array = is_array($array) ? array_map('stripslashes_array', $array) : stripslashes($array);

	return $array;
}

/**
 * 前后是否加引号
 *
 * @param  mixed  $val
 * @return mixed  $val
 *
 */
function untrim($val)
{
    if (is_array($val))
    {
        $val = array_map('untrim', $val);
    }
    elseif (is_null($val))
    {
        $val = 'NULL';
    }
    else
    {
        $val = '"' . mres($val) . '"';
    }

    return $val;
}

function untrim_auto($val)
{
    if (is_array($val))
    {
        $val = array_map('untrim_auto', $val);
    }
    elseif (is_null($val))
    {
        $val = 'NULL';
    }
    elseif (is_numeric($val))
    {
        $val = conversion_type($val);
    }
    elseif (!is_numeric($val) || is_string($val))
    {
        $val = '"' . mres($val) . '"';
    }

    return $val;
}

function encode_html($content)
{
	if (is_array($content))
	{
		foreach ($content as $key => $value)
		{
			unset($content[$key]);

			$content[encode_html($key)] = encode_html($value);
		}
	}
	else
	{
		$content = htmlspecialchars($content, ENT_COMPAT, 'UTF-8');
		//$content = htmlspecialchars($content);
	}

	return $content;
}

function framework_class_alias($original, $alias, $autoload = TRUE)
{
    $registry = Zero_Registry::getInstance();

    $registry['class_alias'][$alias] = $original;
    class_alias($original, $alias, $autoload);
}

//如果使用zend, 则关掉此处
function framework_autoload($class_name)
{
	if (!class_exists($class_name, false) && !interface_exists($class_name, false))
	{
        $class_file_path = framework_class_file($class_name);

        if (!$class_file_path)
		{
            if (!class_exists($class_name, false) && !interface_exists($class_name, false))
            {
                error_header(404, 'Page Not Found');

                if (DEBUG)
                {
                    throw new Exception('Class ' . $class_name . ' does not exists : <br />' . debug_backtrace_summary(), 404);
                }
                else
                {
                    throw new Zero_Exception_Protocol(__('访问的对象不存在！'), 404);
                }
            }
        }
	}
}


//如果使用zend, 则关掉此处
function framework_class_file($class_name)
{
    if (!class_exists($class_name, false) && !interface_exists($class_name, false))
    {
        /*
        //alias
        if (class_exists('Zero_Registry', false))
        {
            $registry = Zero_Registry::getInstance();

            if (isset($registry['class_alias'][$class_name]))
            {
                $class_name = $registry['class_alias'][$class_name];

                //echo $class_name;
                //die();
            }
        }
        */


        if (false !== strpos($class_name, '_'))
        {
            $class_name_path = str_replace('_', '/', $class_name);
        }
        else if (false !== strpos($class_name, '\\'))
        {
            $class_name_path = str_replace('\\', '/', $class_name);
        }
        else
        {
            $class_name_path = $class_name;
        }



        $class_file_suffix = sprintf('/%s.php', $class_name_path);

        $inlcude_path_row = explode(PATH_SEPARATOR, get_include_path());

        foreach ($inlcude_path_row as $inlcude_path)
        {
            if ($inlcude_path)
            {
                $class_file_path = $inlcude_path . $class_file_suffix;

                if (is_file($class_file_path))
                {
                    import($class_file_path);
					return $class_file_path;
                    break;
                }
            }
        }

        /*
        if (!class_exists($class_name, false) && !interface_exists($class_name, false))
        {
            error_header(404, 'Page Not Found');
            throw new Exception('Class ' . $class_name . ' does not exists : ' . $class_file_suffix . '<br />' . debug_backtrace_summary(), 404);
        }
        */
    }

    return false;
}

function import($file_path = null, $flag = true)
{
	global $import_file_row;

	array_unshift($import_file_row, $file_path);

	if ($flag)
	{
		include_once $file_path;
	}
}

if (!function_exists('clean_cache'))
{
	function clean_cache($dir = null, $del_dir = null)
	{
		if (is_dir($dir))
		{
			$dh = opendir($dir);

			while (false !== ($f = readdir($dh)))
			{
				if ($f == '.' || $f == '..')
				{
					continue;
				}
				elseif (is_dir($dir . '/' . $f))
				{
					clean_cache($dir . '/' . $f, true);
				}
				else
				{
					unlink($dir . '/' . $f);
				}
			}

			closedir($dh);

			if ($del_dir && 'cache' != $dir)
			{
				rmdir($dir);
			}

			return true;
		}
		else
		{
			return false;
		}
	}
}

if (is_php('5'))
{
	function mkdir_r($path)
	{
		if (!file_exists($path))
		{
			mkdir($path, 0777, true);
		}
	}
}
else
{
}

if (DEBUG)
{
	//是否启用php console
	$is_active_client = PhpConsole\Connector::getInstance()->isActiveClient();

	if ($is_active_client)
	{
		$handler = PhpConsole\Handler::getInstance();
		/* You can override default Handler behavior:
		$handler->setHandleErrors(false); // disable errors handling
		$handler->setHandleExceptions(false); // disable exceptions handling
		$handler->setCallOldHandlers(false); // disable passing errors & exceptions to prviously defined handlers */
		$handler->start(); // initialize handlers
	}
}

function fb($info, $name = 'default', $type = 'INFO')
{
	$content = func_get_args();

	if ('cli' == SAPI)
	{
		$content = func_get_args();
		$len     = count($content) - 1;
		for ($i = $len; $i >= 0; $i--)
		{
			print_r($content[$i]);
		}

		echo "\n";
	}
	else
	{
        if (DEBUG)
        {
            //$args     = func_get_args();
            //return call_user_func_array(array('Zero_Log', 'log'), $args);

            //是否启用php console
            $is_active_client = PhpConsole\Connector::getInstance()->isActiveClient();

            if ($is_active_client)
            {
                //PhpConsole\Handler::getInstance()->debug($info, $name);  //数组 autoload bug
                PhpConsole\Handler::getInstance()->debug($info, $name);
            }

            if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match_all('/\sFirePHP\/([\.|\d]*)\s?/si', @$_SERVER['HTTP_USER_AGENT'], $m))
            {
                $FirePHP = new FirePHP();
                if ($FirePHP)
                {
                    $instance = $FirePHP->getInstance(true);
                    $args     = func_get_args();
                    return call_user_func_array(array(
                                                    $instance,
                                                    'fb'
                                                ), array(
                                                    $info,
                                                    $name,
                                                    $type
                                                ));
                }
            }
        }
	}

	return true;
}

function get_ip()
{
	if (getenv('HTTP_CLIENT_IP'))
	{
		$ip = getenv('HTTP_CLIENT_IP');
	}
	elseif (getenv('HTTP_X_FORWARDED_FOR'))
	{
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	}
	elseif (getenv('HTTP_X_FORWARDED'))
	{
		$ip = getenv('HTTP_X_FORWARDED');
	}
	elseif (getenv('HTTP_FORWARDED_FOR'))
	{
		$ip = getenv('HTTP_FORWARDED_FOR');
	}
	elseif (getenv('HTTP_FORWARDED'))
	{
		$ip = getenv('HTTP_FORWARDED');
	}
	else
	{
		if (isset($_SERVER['REMOTE_ADDR']))
		{
            $ip = $_SERVER['REMOTE_ADDR'];
		}
		else
		{
            $ip = '127.0.0.1';
		}
	}

	return $ip;
}

function ceil_r($num)
{
	return ceil(round($num, 10));
}

function floor_r($num)
{
	return floor(round($num, 10));
}

/**
 * 取得当前时间
 *
 * @return  int $time 是否成功
 *
 */
function get_time()
{
	if ('cli' == SAPI)
	{
		$time = time();
	}
	else
	{
		if (isset($_SERVER['REQUEST_TIME']))
		{
			$time = $_SERVER['REQUEST_TIME'];
		}
		else
		{
			$time = time();
		}
	}

	return $time;
}

function get_date($time = null)
{
	if ($time)
	{
		return date('Y-m-d', $time);
	}
	else
	{
		return date('Y-m-d');
	}
}

function get_datetime($time = null)
{
	if ($time)
	{
		return date('Y-m-d H:i:s', $time);
	}
	else
	{
		return date('Y-m-d H:i:s');
	}
}

function get_days($start_time, $end_time)
{
	return (strtotime(date('Y-m-d', $end_time)) - strtotime(date('Y-m-d', $start_time))) / 86400 + 1;
}

/**
 * 取得执行结果
 *
 * @return  array   $rs_row             是否成功
 */
function is_ok(&$rs_row = array())
{
	return ok($rs_row);
}

/**
 * 取得执行结果
 *
 * @return  array   $rs_row             是否成功
 */
function ok(&$rs_row = array())
{
	$rs = true;

	if (in_array(false, $rs_row, true))
	{
		$rs = false;
	}

	return $rs;
}

/**
 * 判断结果是否为false, 返回flag
 *
 * @return  array   $rs_row             是否成功
 */
function check_rs($flag, &$rs_row, $msg=null)
{
	if (false === $flag || null === $flag)
	{
		$rs_row[] = false;

		if ($msg)
		{
			throw new Zero_Exception_Db($msg);
		}

        return false;
	}
	else
	{
		$rs_row[] = true;
        return true;
	}

	return $flag;
}


/**
 * 本地化  I18N 程序范例开始
 *
 *
 * @param string $lan_path 设置某个域的mo文件路径
 * @param string $lang bsd use zh_CN.UTF-8
 * @param string $domain 定义要用的mo文件名称，常规来说，我们都把PACKAGE的名称定义和程序名称相同。
 * @return void
 */
function init_locale($lan_path, $lang, $domain)
{
	setlocale(LC_ALL, $lang);   //// bsd use zh_CN.UTF-8

	bindtextdomain($domain, $lan_path); //设置某个域的mo文件路径
	bind_textdomain_codeset($domain, 'UTF-8'); //设置mo文件的编码为UTF-8
	textdomain($domain); //设置gettext()函数从哪个域去找mo文件
}

/**
 * 通知客户端错误原因
 *
 * @param  int $error_no
 * @param  string $error_msg
 */
function error_header($error_no, $error_msg)
{
	header('HTTP/1.0 ' . $error_no . ' ' . $error_msg);
}


/**
 * 通知客户端错误原因
 *
 * @param  int $error_no
 * @param  string $error_msg
 */
function location_to($url, $msg = null)
{
	header("Location:$url");
	die();
}


//按二维数组指定属性排序
function array_sort($arr, $keys, $type = 'asc')
{
	$keysvalue = $new_array = array();
	foreach ($arr as $k => $v)
	{
		$keysvalue[$k] = $v[$keys];
	}

	if ($type == 'asc')
	{
		asort($keysvalue);
	}
	else
	{
		arsort($keysvalue);
	}

	reset($keysvalue);
	foreach ($keysvalue as $k => $v)
	{
		$new_array[$k] = $arr[$k];
	}

	return $new_array;
}

function array_reset($sort_key_row, $data_rows)
{
	$data_rows_new = array();

	if (($n = count($sort_key_row)) > 0)
	{
		switch ($n)
		{
			case 1:
				foreach ($data_rows as $key => $value)
				{
					$data_rows_new[$value[$sort_key_row[0]]] = $value;
				}
				break;
			case 2:
				foreach ($data_rows as $key => $value)
				{
					$data_rows_new[$value[$sort_key_row[0]]][$value[$sort_key_row[1]]] = $value;
				}
				break;
			case 3:
				foreach ($data_rows as $key => $value)
				{
					$data_rows_new[$value[$sort_key_row[0]]][$value[$sort_key_row[1]]][$value[$sort_key_row[2]]] = $value;
				}
				break;
			case 4:
				foreach ($data_rows as $key => $value)
				{
					$data_rows_new[$value[$sort_key_row[0]]][$value[$sort_key_row[1]]][$value[$sort_key_row[2]]][$value[$sort_key_row[3]]] = $value;
				}
				break;
		}
	}
	else
	{
		$data_rows_new = $data_rows;
	}

	return $data_rows_new;
}

function get_strlen($str)
{
	/*
	$strlen = strlen($str);
	$mb_strlen = mb_strlen($str, "utf8");

	return ($strlen - $mb_strlen)/2 + $mb_strlen;
	*/

	return mb_strlen($str, "utf8");
}

/*判断一个数字是否是整数
*@param $intNum 要判断的数字
*@param $scope 1 > 0 ,0 >= 0, -1 所有整数;
*/
function is_int_true($int_num, $scope = 1)
{
	if (is_numeric($int_num) && (round($int_num, 0)) == $int_num)//是整数
	{
		if ($scope == 1)
		{
			return $int_num > 0;
		}
		elseif ($scope == 0)
		{
			return $int_num >= 0;
		}
		elseif ($scope == -1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

//按值将元素从数组中移除
function array_remove_value($value, $arr_value)
{
	if (is_array($value))
	{
		foreach ($value as $k => $v)
		{
			$del_key = array_search($v, $arr_value);

			if (false !== $del_key)
			{
				unset($arr_value[$del_key]);
			}
		}
	}
	else
	{
		$del_key = array_search($value, $arr_value);

		if (false !== $del_key)
		{
			unset($arr_value[$del_key]);
		}
	}

	return $arr_value;
}

//将2个二维数组的值相加
function array_add($arr_first, $arr_second)
{
	foreach ($arr_second as $key => $value)
	{
		foreach ($value as $k => $v)
		{
			$arr_first[$key][$k] = (isset($arr_first[$key][$k]) ? $arr_first[$key][$k] : 0) + $v;
		}
	}

	return $arr_first;
}

//将2个二维数组的值相减
function array_sub($arr_first, $arr_second)
{
	foreach ($arr_second as $key => $value)
	{
		foreach ($value as $k => $v)
		{
			$arr_first[$key][$k] = (isset($arr_first[$key][$k]) ? $arr_first[$key][$k] : 0) - $v;
		}
	}

	return $arr_first;
}


function send_request($url, $param_row = array(), $method = 'post', $sign_key = '', $timeout = 10, $curl_header = array())
{
	$params = '';

	if (is_array($param_row))
	{
		if ($param_row)
		{
			if ($sign_key)
			{
				$param_row['sign'] = get_sign($param_row, $sign_key);
			}

			$params = http_build_query($param_row);
		}
	}
	else
	{
		$params = $param_row;
	}


	$curl = curl_init();//初始化curl

	if ('get' == $method)//以GET方式发送请求
	{
		$pos = strpos($url, "?");

		if ($pos === false)
		{
			$request_url = $url . "?" . $params;
		}
		else
		{
			$request_url = $url . "&" . $params;
		}

		curl_setopt($curl, CURLOPT_URL, $request_url);
	}
	else//以POST方式发送请求
	{
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, 1);//post提交方式
		curl_setopt($curl, CURLOPT_POSTFIELDS, $params);//设置传送的参数
	}

	if ($curl_header)
	{
		curl_setopt($curl, CURLOPT_HTTPHEADER, $curl_header);
	}

	//curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers_login );
	curl_setopt($curl, CURLOPT_HEADER, false);//设置header
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);//要求结果为字符串且输出到屏幕上
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);//设置等待时间
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

	for ($i = 0; $i < 5; $i++)
	{
		$res = curl_exec($curl);//运行curl
		$err = curl_error($curl);

		if (empty($err))
		{
			break;
		}
	}

	if (false === $res || !empty($err))
	{
		$errno = curl_errno($curl);
		$Info  = curl_getinfo($curl);
		curl_close($curl);

		return array(
			'result' => false,
			'errno' => $errno,
			'msg' => $err,
			'info' => $Info,
		);
	}

	curl_close($curl);//关闭curl

	return array(
		'result' => true,
		'msg' => $res,
	);
}


function file_get_contents_time($url, &$response_header=array(), $timeout = 5)
{
	$ctx = stream_context_create(array(
									 'http' => array(
										 'timeout' => 3
										 //设置一个超时时间，单位为秒
									 )
								 ));

	$data = file_get_contents($url, 0, $ctx);

	if (false !== $data)
	{
		$response_header = $http_response_header;
	}

	return $data;
}

//二维数组
function array_filter_key($key, $data_rows)
{
	$data_rows_new = array();

	foreach ($data_rows as $row)
	{
		if (isset($row[$key]))
		{
			$data_rows_new[] = $row[$key];
		}
	}


	return $data_rows_new;
}

function get_url($url, $param_row = array(), $typ = 'JSON', $method = 'POST', $sign_key = '', $timeout = 10, $curl_header = array())
{
    if (isset($param_row['jsonp_callback']))
    {
        unset($param_row['jsonp_callback']);
    }

	$params = '';

	if (is_array($param_row))
	{
		if ($param_row)
		{
			$params = http_build_query($param_row);
		}
	}
	else
	{
		$params = $param_row;
	}


	$curl = curl_init();//初始化curl

	if ('get' == $method)//以GET方式发送请求
	{
		$pos = strpos($url, "?");

		if ($pos === false)
		{
			$request_url = $url . "?" . $params;
		}
		else
		{
			$request_url = $url . "&" . $params;
		}

		curl_setopt($curl, CURLOPT_URL, $request_url);
	}
	else//以POST方式发送请求
	{
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, 1);//post提交方式
		curl_setopt($curl, CURLOPT_POSTFIELDS, $params);//设置传送的参数
	}

	if ($curl_header)
	{
		//$header[] = "Content-type: application/x-www-form-urlencoded";
		curl_setopt($curl, CURLOPT_HTTPHEADER, $curl_header);
	}

	//curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers_login );
	curl_setopt($curl, CURLOPT_HEADER, false);  // 返回 response_header, 该选项非常重要,如果不为 true, 只会获得响应的正文
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);//要求结果为字符串且输出到屏幕上
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);//设置等待时间
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);


	//curl_setopt($curl, CURLOPT_NOBODY, true); //// 是否不需要响应的正文,为了节省带宽及时间,在只需要响应头的情况下可以不要正文

	//$user_agent = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36";
	//curl_setopt($curl, CURLOPT_USERAGENT,$user_agent);



	for ($i = 0; $i < 5; $i++)
	{
		$res = curl_exec($curl);//运行curl
		$err = curl_error($curl);

		if (empty($err))
		{
			break;
		}
	}

	/*
	$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE); // 获得响应结果里的：头大小
	$header = substr($res, 0, $header_size);  // 根据头大小去获取头信息内容
	*/

	if (false === $res || !empty($err))
	{
		$errno = curl_errno($curl);
		$Info  = curl_getinfo($curl);
		curl_close($curl);


		return array(
			'status' => 250,
			'errno' => $errno,
			'msg' => $err,
			'data' => $Info,
		);
	}

	curl_close($curl);//关闭curl

	$log_file = sprintf('get_url_%s', date("Y-m-d"));

	Zero_Log::log($url, $log_file, Zero_Log::INFO);
	Zero_Log::log($param_row, $log_file, Zero_Log::INFO);
	Zero_Log::log($res, $log_file, Zero_Log::INFO);

	if ('JSON' == strtoupper($typ))
	{
		$res = decode_json($res);
	}

	return $res;
}

//可以判断请求时间是否超过某个期限
function get_url_with_encrypt($key, $url, $formvars = array(), $typ = 'JSON', $method = 'POST', $jump=null)
{
	$formvars['rtime'] = get_time();
	$hash_row          = $formvars;

	//asort($hash_row, SORT_STRING);
	//ksort($hash_row);
	//array_map(ksort, $hash_row);
	array_multiksort($hash_row, SORT_STRING);

	$hash_row['key'] = $key;

	$tmp_str = http_build_query($hash_row);

	$formvars["token"] = md5($tmp_str);

	if ($jump)
	{
		$params = '';

		if (is_array($formvars))
		{
			if ($formvars)
			{
				$params = http_build_query($formvars);
			}
		}
		else
		{
			$params = $formvars;
		}

		$pos = strpos($url, "?");

		if ($pos === false)
		{
			$request_url = $url . "?" . $params;
		}
		else
		{
			$request_url = $url . "&" . $params;
		}

		location_to($request_url);
		die();
	}
	else
	{
		$rs = get_url($url, $formvars, $typ, $method);
	}

	$log_file = sprintf('get_url_with_encrypt_%s', date("Y-m-d"));

	Zero_Log::log($url, $log_file, Zero_Log::INFO);
	Zero_Log::log($hash_row, $log_file, Zero_Log::INFO);
	Zero_Log::log($rs, $log_file, Zero_Log::INFO);

	return $rs;
}

function check_url_with_encrypt($key, $formvars = array())
{
	$token = $formvars['token'];
	unset($formvars['token']);

	$hash_row = $formvars;
	//asort($hash_row, SORT_STRING);
	//ksort($hash_row);
	//array_map(ksort, $hash_row);

	array_multiksort($hash_row, SORT_STRING);

	$hash_row['key'] = $key;
	$tmp_str         = http_build_query($hash_row);

	//可以判断请求时间是否超过某个期限, 1分钟内
	if ((get_time() - $hash_row['rtime'] < 60) && $token == md5($tmp_str))
	{
		return true;
	}
	else
	{
		return false;
	}
}


function array_multiksort(&$rows)
{
	foreach ($rows as $key => $row)
	{
		if (is_array($row))
		{
			array_multiksort($rows[$key]);
		}
	}

	ksort($rows, SORT_STRING);
}

//$test_row = array('4.0', '2.1', 0, "0", 3., 13, "12", 3.53, "0.01", "fdafadf")

/*
$test_row = array('4.0', '2.1', 0, "0", 3., 13, "12", 3.53, "0.01", "fdafadf");

foreach ($test_row as $val)
{
	echo "\n";
	echo $val ;
	echo " - ";
	var_dump(is_float_true($val));
}
*/

function is_float_true($val)
{
	//if (is_float($val) || ((float)$val > (int)$val || strlen($val) != strlen((int)$val)) && (int)$val != 0)  //"0.01" 错误
	//if (is_float($val) || ((float)$val != round($val) || strlen($val) != strlen((int)$val)) && $val != 0)  //次算法无问题
	if (is_float($val) || ((float)$val > (int)$val || strlen($val) != strlen((int)$val)) && round($val, 10) != 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}


function conversion_type($data)
{
	$data = is_array($data) ? array_map('conversion_type', $data) : conversion($data);

	return $data;
}


function conversion($data)
{
	if (is_numeric($data))
	{
		if (is_float_true($data))
		{
            if (!is_float($data)  && $data > PHP_INT_MAX)
            {
                //$data = number_format($data, 0, '', '');
            }
            else
            {
                $data = floatval($data);
            }
		}
		else
		{
		    //if ($data > PHP_INT_MAX)
			if ($data > 2147483647)
            {
                //$data = number_format($data, 0, '', '');
            }
            else
            {
                $data = intval($data);
            }
		}
	}
	elseif (is_string($data))
	{
		//$data = mres($data);
	}

	return $data;
}

//格式化用户请求数据
//request_int
function i($key, $default = 0)
{
	$val = isset($_REQUEST[$key]) ? intval($_REQUEST[$key]) : $default;

	return $val;
}

//request_string
function s($key, $default = '')
{
	$val = isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;

	return $val;
}


//request_row
function r($key = array(), $default = array())
{
	if (is_array($key))
	{
		return $_REQUEST;
	}
	else
	{
		$val = isset($_REQUEST[$key]) && $_REQUEST[$key]!='' ? $_REQUEST[$key] : $default;

		//尝试解析JSON
		if ($val && !is_array($val))
		{
			$data = json_decode($val, true);

            if ($data === null)
            {
                $error_code = json_last_error();

                if ($error_code !== JSON_ERROR_NONE)
                {
                    //系统记录
                    //Zero_Queue::send('json_decode', sprintf('code : %s - %s - %s', $error_code, $rows, debug_backtrace_summary()));

                    //throw  new Exception(__('错误的JSON字符串！'));
                }
            }
            else
			{
                $val = $data;
			}
		}
	}

	return $val;
}

//request_float
function f($key, $default = 0)
{
	$val = isset($_REQUEST[$key]) ? floatval($_REQUEST[$key]) : $default;

	return $val;
}

function id($key = array(), $default = array())
{
    if (is_array($key))
    {
        return $_REQUEST;
    }
    else
    {

        $id_str = s($key); //","分割
        $id_row = explode(',', $id_str);

        $val = $id_row ? $id_row : $default;
    }

    return $val;
}

//格式化用户请求数据
function request_int($key, $default = 0)
{
	$val = i($key, $default);

	return $val;
}


function request_string($key, $default = '')
{
	$val = s($key, $default);;

	return $val;
}

function request_float($key, $default = 0)
{
	$val = f($key, $default);;

	return $val;
}

function request_row($key, $default = array())
{
	$val = r($key, $default);;

	return $val;
}

function grid_sort()
{
	$sort = array();

	//fix jqgrid
	$sidx = s('sidx');
	$sord = s('sord');

	if ($sidx && $sord)
	{
		$sort[$sidx] = strtoupper($sord);
	}

	return $sort;
}

function ob_get_end_clean_start()
{
	$d = ob_get_contents();
	ob_end_clean();

	//Zero_Registry::get('gzipcompress') ? ob_start('ob_gzhandler') : ob_start();
	ob_start();

	return $d;
}

//ob_flush是把数据从PHP的缓冲中释放出来，flush是把不在缓冲中的或者说是被释放出来的数据发送到浏览器。所以当缓冲存在的时候，我们必须ob_flush()和flush()同时使用。正确使用的顺序是：先用ob_flush()，后用flush()。
function flush_now()
{
	/*
	$levels = ob_get_level();
	for ($i=0; $i<$levels; $i++)
		ob_end_flush();

	flush();
	*/

    if(ob_get_level()>0)
    {
        ob_flush();
    }

    flush();
}

//$url = make_url(Zero_Registry::get('base_url'), 'defaults', $ctl='Index', $met='index', $typ='m', $query_row=array('iiiii'=>'22222'), $query_str='bbb=222&aaa=111');
function url($ctl = 'Index', $met = 'index', $mdu='', $query_str = '', $query_row = array(), $pattern_name = 'default', $typ = 'e', $host = null, $friendly = true)
{
	//call_user_func_array(array('Zero_Url_PatternManager', 'url'), $args);
	return call_user_func_array('Zero_Url_PatternManager::url', func_get_args());
}

function urlh($host = null, $ctl = 'Index', $met = 'index', $mdu='', $query_str = '', $query_row = array(), $pattern_name = 'default', $typ = 'e', $friendly = true)
{
    if ($host)
    {
        $host = Zero_Registry::get('base_url') . '/' .  $host;
    }
    else
    {
        $host = Zero_Registry::get('base_url');
    }

	return url($ctl, $met, $mdu, $query_str, $query_row, $pattern_name, $typ, $host, $friendly);
}

//Generate a URL for a given controller action.
//$url = action('HomeController@getIndex', $params);
function action($ctl = 'Index@index@', $query_str = '', $query_row = array(), $pattern_name = 'default', $typ = 'e', $host = null, $friendly = true)
{
	return call_user_func_array('Zero_Url_PatternManager::action', func_get_args());
}


//Generate a URL for a given named route.
//$url = route('default', $params);
function route($route_name = 'default', $query_str = '', $query_row = array(), $pattern_name = 'default', $typ = 'e', $host = null, $friendly = true)
{
	return call_user_func_array('Zero_Url_PatternManager::route', func_get_args());
}

//link_to
//echo link_to('foo/bar', $title, $attributes = array(), $secure = null);
//echo link_to_action('HomeController@getIndex', $title, $parameters = array(), $attributes = array());
function link_to($text, $url, $attributes = array())
{
	return Zero_Utils_Html::a($text, $url, $attributes);
}

//echo link_to_action('HomeController@getIndex', $title, $parameters = array(), $attributes = array());
function link_to_action($ctl='Index@index@', $text, $parameters = array(), $attributes = array())
{
	return Zero_Utils_Html::a($text, action($ctl, $parameters), $attributes);
}

if (!function_exists('array_column'))
{
	function array_column($input, $column_key, $index_key = null)
	{
		$arr = array_map(function ($d) use ($column_key, $index_key)
		{
			if (!isset($d[$column_key]))
			{
				return null;
			}

			if ($index_key !== null)
			{
				return array($d[$index_key] => $d[$column_key]);
			}

			return $d[$column_key];
		}, $input);

		if ($index_key !== null)
		{
			$tmp = array();

			foreach ($arr as $ar)
			{
				$tmp[key($ar)] = current($ar);
			}

			$arr = $tmp;
		}

		return $arr;
	}
}

function array_column_unique($input, $column_key, $index_key = null)
{
	return array_unique(array_filter(array_column($input, $column_key, $index_key)));
}

//image_thumb
function img($image_url, $width=64, $height=null)
{
	if (!$image_url)
	{
        $image_url = Base_ConfigModel::getConfig('default_image');
	}

	if (!$height)
	{
        $height = $width;
	}

	$ext_row = pathinfo($image_url);
	$ext_name = isset($ext_row['extension']) ? $ext_row['extension'] : 'jpg';

    $image_url_row = explode('?', $image_url);

	$url = sprintf('%s%s%dx%d.%s', $image_url_row[0], strpos($image_url, 'image.php')!==false ? '!' : '?', $width, $height, $ext_name);

	return $url;
}

//number_format
//money_format()
function format_money($number , $decimals = 2 , $dec_point = '.' , $thousands_sep = ',')
{
	if (is_numeric($number))
	{
		return sprintf('<span class="unit">%s</span><span class="price">%s</span>', Base_ConfigModel::getConfig('monetary_unit'), number_format($number, $decimals, $dec_point, $thousands_sep));
	}
	else
	{
		return sprintf('<span class="unit">%s</span><span class="price">%s</span>', Base_ConfigModel::getConfig('monetary_unit'), $number);
	}
}

//判断类型，转换
$int_row = array(
	'int8_t',
	'int16_t',
	'int32_t',
	'int64_t',
	'uint8_t',
	'uint16_t',
	'uint32_t',
	'uint64_t'
);

$float_row = array(
	'float'
);


$registry['int_row'] = $int_row;
$registry['float_row'] = $float_row;


//  \[0-7]{1,3}    八进制表示的字符串
//  \x[0-9A-Fa-f]{1,2}    八进制表示的字符串
//$str = str_replace(array('"', "'", '/', '\\', '$', "\[0-7]{1,3}", "\x[0-9A-Fa-f]{1,2}", "\n", "\r", "\t", ""), '', $str);


/**
 * Return a comma-separated string of functions that have been called to get
 * to the current point in code.
 *
 * @since 3.4.0
 *
 * @see https://core.trac.wordpress.org/ticket/19589
 *
 * @param string $ignore_class Optional. A class to ignore all function calls within - useful
 *                             when you want to just give info about the callee. Default null.
 * @param int    $skip_frames  Optional. A number of stack frames to skip - useful for unwinding
 *                             back to the source of the issue. Default 0.
 * @param bool   $pretty       Optional. Whether or not you want a comma separated string or raw
 *                             array returned. Default true.
 * @return string|array Either a string containing a reversed comma separated trace or an array
 *                      of individual calls.
 */
function debug_backtrace_summary( $ignore_class = null, $skip_frames = 0, $pretty = true ) {
	if ( version_compare( PHP_VERSION, '5.2.5', '>=' ) )
		$trace = debug_backtrace( false );
	else
		$trace = debug_backtrace();

	$caller = array();
	$check_class = ! is_null( $ignore_class );
	$skip_frames++; // skip this function

	foreach ( $trace as $call ) {
		if ( $skip_frames > 0 ) {
			$skip_frames--;
		} elseif ( isset( $call['class'] ) ) {
			if ( $check_class && $ignore_class == $call['class'] )
				continue; // Filter out calls

			$caller[] = "{$call['class']}{$call['type']}{$call['function']}";
		} else {
			if ( in_array( $call['function'], array( 'do_action', 'apply_filters' ) ) ) {
				$caller[] = "{$call['function']}('{$call['args'][0]}')";
			} elseif ( in_array( $call['function'], array( 'include', 'include_once', 'require', 'require_once' ) ) ) {
				$caller[] = $call['function'] . "('" . str_replace( array( APP_PATH, ROOT_PATH ) , '', $call['args'][0] ) . "')";
			} else {
				$caller[] = $call['function'];
			}
		}
	}
	if ( $pretty )
		return join( ', ', array_reverse( $caller ) );
	else
		return $caller;
}

/*
app_init	应用初始化标签位
path_info	PATH_INFO检测标签位
route_check	路由检测标签位
app_begin	应用开始标签位
action_name	操作方法名标签位
action_begin	控制器开始标签位
view_begin	视图输出开始标签位
view_template	视图模板解析标签位
view_parse	视图解析标签位
view_filter	视图输出过滤标签位
view_end	视图输出结束标签位
action_end	控制器结束标签位
app_end	应用结束标签位
*/
//插件函数， 分全部触发和单一触发。
//如果最后一个参数为Plugin Name, 则单一触发
//$data =  do_action('sys_test_str', array('t', 'b'), 'Logaaaa');
function do_action($tag)
{
	$args = func_get_args();
    /* @var $PluginManager Zero_Plugin_Manager */
	$PluginManager = Zero_Registry::get('hook');

	$plugin_short_name = end($args);
	$plugin = $PluginManager->getPlugin($plugin_short_name);

	$data =  call_user_func_array(array($PluginManager, 'trigger'), $args);
	return $data;
}


//插件函数， 分全部触发和单一触发。
//如果最后一个参数为Plugin Name, 则单一触发
//$data =  apply_filters('sys_test_str', array('t', 'b'));
function apply_filters($tag)
{
    /* @var $PluginManager Zero_Plugin_Manager */
	$PluginManager = Zero_Registry::get('hook');

    $data =  call_user_func_array(array($PluginManager, 'triggerFilters'), func_get_args());

    return $data;
}

/**
 * 从$_SERVER或者$_ENV全局变量根据pathinfo变量名获取$PATH_INFO值。
 * PATH_INFO的变量名几乎都是'PATH_INFO'，但也有可能是ORIG_PATH_INFO。
 *
 * Get $PATH_INFO from $_SERVER or $_ENV by the pathinfo var name.
 * Mostly, the var name of PATH_INFO is PATH_INFO, but may be ORIG_PATH_INFO.
 *
 * @access  public
 * @return  string the PATH_INFO
 */
function get_path_info()
{
    if(isset($_SERVER['PATH_INFO']))
    {
        $value = $_SERVER['PATH_INFO'];
    }
    elseif(isset($_SERVER['ORIG_PATH_INFO']))
    {
        $value = $_SERVER['ORIG_PATH_INFO'];
    }
    else
    {
        $value = @getenv('PATH_INFO');
        if(empty($value)) $value = @getenv('ORIG_PATH_INFO');
    }

    if (strpos($value, $_SERVER['SCRIPT_NAME']) !== false) $value = str_replace($_SERVER['SCRIPT_NAME'], '', $value);

    if(strpos($value, '?') === false) return trim($value, '/');


    return trim($value, '/');
}


function eq($f, $s, $out='active')
{
    if($f == $s)
    {
        return $out;
    }
}

function neq($f, $s, $out='active')
{
    if($f != $s)
    {
        return $out;
    }
}

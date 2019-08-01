<?php 
$check_ext_row = array();

//scan_dir 函数需要存在
//'PDO',
//	'pdo_mysql',
//	'sockets',
//	'openssl'
$check_ext_row['json'] = array(
	'name' => 'json',
	'state' => extension_loaded('json'),
	'need' =>  __('开启'),
	'current' =>  extension_loaded('json') ? __('开启') : __('关闭'),
	'msg' =>  __('Warning: json extension needs to be loaded for ** to work!'),
);


$check_ext_row['gd'] = array(
	'name' => 'gd',
	'state' => extension_loaded('gd'),
	'need' =>  __('开启'),
	'current' =>  extension_loaded('gd') ? __('开启') : __('关闭'),
	'msg' =>  __('Warning: GD extension needs to be loaded for ** to work!'),
);

$check_ext_row['curl'] = array(
	'name' => 'curl',
	'state' => extension_loaded('curl'),
	'need' =>  __('开启'),
	'current' =>  extension_loaded('curl') ? __('开启') : __('关闭'),
	'msg' =>  __('Warning: CURL extension needs to be loaded for ** to work!'),
);

/*
$check_ext_row['mCrypt'] = array(
	'name' => 'mCrypt',
	'state' => function_exists('mcrypt_encrypt'),
	'need' =>  __('开启'),
	'current' =>  function_exists('mcrypt_encrypt') ? __('开启') : __('关闭'),
	'msg' =>  __('Warning: mCrypt extension needs to be loaded for ** to work!'),
);

$check_ext_row['zlib'] = array(
	'name' => 'zlib',
	'state' => extension_loaded('zlib'),
	'need' =>  __('开启'),
	'current' =>  extension_loaded('zlib') ? __('开启') : __('关闭'),
	'msg' =>  __('Warning: ZLIB extension needs to be loaded for ** to work!'),
);

$check_ext_row['zip'] = array(
	'name' => 'zip',
	'state' => extension_loaded('zip'),
	'need' =>  __('开启'),
	'current' =>  extension_loaded('zip') ? __('开启') : __('关闭'),
	'msg' =>  __('Warning: zip extension needs to be loaded for ** to work!'),
);

*/

$check_ext_row['mbstring'] = array(
	'name' => 'mbstring',
	'state' => extension_loaded('mbstring') || function_exists('iconv'),
	'need' =>  __('开启'),
	'current' =>  extension_loaded('mbstring') || function_exists('iconv') ? __('开启') : __('关闭'),
	'msg' =>  __('Warning: mbstring extension needs to be loaded for ** to work!'),
);


$check_ext_row['db'] = array(
	'name' => 'DB',
	'state' => array_filter(array('mysqli', 'pgsql', 'pdo', 'pdo_mysql'), 'extension_loaded'),
	'need' =>  __('开启'),
	'current' =>  array_filter(array('mysqli', 'pgsql', 'pdo', 'pdo_mysql'), 'extension_loaded') ? __('开启') : __('关闭'),
	'msg' =>  __('Warning: A database extension needs to be loaded in the php.ini for ** to work!')
);

$check_ext_row['dom'] = array(
    'name' => 'DOM',
    'state' => class_exists('DOMDocument'),
    'need' =>  __('开启'),
    'current' =>  class_exists('DOMDocument') ? __('开启') : __('关闭'),
    'msg' =>  __('Warning: DOMDocument extension needs to be loaded for ** to work!')
);

return $check_ext_row;



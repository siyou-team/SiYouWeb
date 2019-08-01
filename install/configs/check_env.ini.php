<?php
$check_env_row = array(
);


$check_env_row['php_version']['state'] = phpversion() >= '5.3';
$check_env_row['php_version']['need'] = '5.3+';
$check_env_row['php_version']['current'] = phpversion();
$check_env_row['php_version']['msg'] = __('Warning: You need to use PHP5.3 or above for ** to work!');

$check_env_row['file_uploads']['state'] = ini_get('file_uploads');
$check_env_row['file_uploads']['need'] = __('开启');
$check_env_row['file_uploads']['current'] = ini_get('file_uploads') ? __('开启') : __('关闭');
$check_env_row['file_uploads']['msg'] = __('Warning: file_uploads needs to be enabled!');


$check_env_row['session_auto_start']['state'] = !ini_get('session.auto_start');
$check_env_row['session_auto_start']['need'] = __('关闭');
$check_env_row['session_auto_start']['current'] = ini_get('session.auto_start') ? __('开启') : __('关闭');;
$check_env_row['session_auto_start']['msg'] = __('Warning: ** will not work with session.auto_start enabled!');


$check_env_row['register_globals']['state'] = !ini_get('register_globals');
$check_env_row['register_globals']['need'] = __('关闭');
$check_env_row['register_globals']['current'] = ini_get('register_globals') ? __('开启') : __('关闭');
$check_env_row['register_globals']['msg'] = __('');


$check_env_row['magic_quotes_gpc']['state'] = !ini_get('magic_quotes_gpc');
$check_env_row['magic_quotes_gpc']['need'] =  __('关闭');
$check_env_row['magic_quotes_gpc']['current'] = ini_get('magic_quotes_gpc') ? __('开启') : __('关闭');
$check_env_row['magic_quotes_gpc']['msg'] = __('');

return $check_env_row;
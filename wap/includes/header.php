<?php 
header("Access-Control-Allow-Credentials: true"); 
$origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : '';  
header("Access-Control-Allow-Origin:$origin");  
 

defined('DS') || define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', str_replace(DS,'/',__DIR__.'/../..'));
define('LIB_PATH', ROOT_PATH . DS .'libraries'); 
define('EXT', '.php');
define('LANG_PATH', LIB_PATH.DS.'Lang'.DS.'message'); 

$test = include LIB_PATH.'/Lang.php';

if ( true )
{
    if (!isset($config_row['language_id']))
    {
        $config_row['language_id'] = 'it';
    }
    // 默认语言
    Lang::range($config_row['language_id']);
    // 开启多语言机制 检测当前语言
    // $config_row['lang_switch_on'] && Lang::detect();
    $language_id = Lang::detect();

    $registry['language'] = $language_id;

    // 加载系统语言包
    Lang::load([
        LANG_PATH . DS . $language_id . EXT,
    ]);
   
    if (!function_exists('__')) {
        /**
         * 获取语言变量值
         * @param string    $name 语言变量名
         * @param array     $vars 动态变量值
         * @param string    $lang 语言
         * @return mixed
         */

        function __( $name )
        {   
            if( !Lang::has( $name ) ){
                return $name;
                $Lang_Translate = new Lang_Translates();

                $tran_str = $Lang_Translate->translate('zh-CN',Lang::range(),$name);
                if( $tran_str ){
                    Lang::set($name,$tran_str);
                    $lang_file = LANG_PATH . DS . Lang::range() . EXT;
                    if( !file_exists( $lang_file) ){
                        $fopen = fopen($lang_file, 'wb');
                        fclose($fopen);
                    }
                    $a = file_put_contents( $lang_file , "<?php return ".var_export(Lang::ranges(), true).";");
                } else {
                    return $name;
                }
            }
            return Lang::get($name);
        }
    }
    //define('LANG', $config_row['language_id']);
    //init_locale(APP_PATH . '/data/locales/', LANG, 'HelloWorld');   //初始化，只需要一次即可
    //textdomain('HelloWorld');
}


ob_start();
$header ='';
if( $language_id == 'it' ){
    $header  = '<link rel="stylesheet" type="text/css" href="/wap/css/it.css" >
';
    $header .= '<script type="text/javascript" src="/wap/lang/it.json"></script>
';
}
if( $language_id == 'en' ){
    $header  = '<link rel="stylesheet" type="text/css" href="/wap/css/en.css" >
';
    $header .= '<script type="text/javascript" src="/wap/lang/en.json"></script>
';
}
$header .= '<script type="text/javascript" >
var language = "'.$language_id.'";
</script>
';
ob_clean();

ob_start();
 



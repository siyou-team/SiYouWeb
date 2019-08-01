<?php if (!defined('ROOT_PATH')) exit('No Permission');

//遍历所有dir
$dir = realpath('../');

if (!function_exists('scandir'))
{
    throw new Exception(__('scandir 函数需要开启!'));
}

$file_row = scandir($dir);

$project_row = array();

foreach ($file_row as $file)
{
    //if (is_file(sprintf('../%s/configs/config.ini.php', $file)) &&  is_dir($dir . '/' . $file))
    if (($file!='.' && $file!='..' && $file!='.svn' && $file!='wap' && $file!='libraries' && $file!='thumb') && is_dir($dir . '/' . $file))
    {
        $project_row[] = $file;
    }
}

$dir_row = array();
$check_dir_row = array();

foreach ($project_row as $p)
{
    $dir_row = array_merge($dir_row, array(
        "/{$p}/configs",
        "/{$p}/data",
        "/{$p}/data/logs",
    ));
}


$dir_row[] = '/wap/js/config.js';
$dir_row[] = '/shop/static/src/default/js/config.js';


$dir_row[] = '/wap/wap.manifest';
$dir_row[] = '/shop/static/src/shop.manifest';


$dir_row[] = '/libraries/data/licence';
$dir_row[] = '/thumb';
$dir_row[] = '/robots.txt';
$dir_row[] = '/sw.js';

foreach ($dir_row as $dir)
{
    $row = array();
    $row['dir'] = ROOT_PATH . $dir;
    
    if (!is_dir($row['dir']) && !file_exists($row['dir']))
    {
        mkdir($row['dir'], 0777, true);
    }
    
    if (is_dir($row['dir']) && !is_writable($row['dir']))
    {
        chmod($row['dir'], 0777);
    }
    
    $row['state'] = intval(is_writable($row['dir']));
    
    $check_dir_row[] = $row;
}


return $check_dir_row;
?>
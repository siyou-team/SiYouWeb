<?php
error_reporting(E_ALL);

function etag($etag, $notModifiedExit = true)
{
    if ($notModifiedExit && isset($_SERVER['HTTP_IF_NONE_MATCH']) && $etag == $_SERVER['HTTP_IF_NONE_MATCH']) {
        header("Etag:" . $etag, true, 304);
        exit();
    }
    
    header('Etag: ' . $etag);
}

function lastModified($modifiedTime, $notModifiedExit = true)
{
    $modifiedTime = gmdate('D, d M Y H:i:s', $modifiedTime) . ' GMT';
    if ($notModifiedExit && isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $modifiedTime == $_SERVER['HTTP_IF_MODIFIED_SINCE']) {
        header("Last-Modified: $modifiedTime", true, 304);
        exit();
    }
    
    header("Last-Modified: $modifiedTime");
}

function expires($seconds = 1800)
{
    $time = gmdate('D, d M Y H:i:s', time() + $seconds) . ' GMT';
    header("Expires: $time");
}

$time = time();
$seconds_to_cache = 3600;

header("Pragma: cache");
header("Cache-Control: max-age=$seconds_to_cache");
//lastModified($time);  //需要上次真实修改时间


if (isset($_GET['path']))
{
    $path = trim($_GET['path']);
}
else
{
    if (isset($_SERVER['PATH_INFO']))
    {
        $path = $_SERVER['PATH_INFO'];
    }
    elseif (isset($_SERVER['ORIG_PATH_INFO']))
    {
        $path = $_SERVER['ORIG_PATH_INFO'];
    }
    else
    {
        $path = @getenv('PATH_INFO');
        if (empty($path))
        {
            $path = @getenv('ORIG_PATH_INFO');
        }
    }
}

$path = trim($path, '/');

if($path)
{
    $etag = md5($path);
    etag($etag);
}

expires($seconds_to_cache);

//http://127.0.0.1/yf_shop/image.php/shop_admin/04626264083026214_mid.jpg!300x43.jpg
//http://127.0.0.1/yf_shop/image.php?path=shop_admin/04626264083026214_mid.jpg!300x43.jpg
//define('ROOT_PATH', str_replace('\\', '/', dirname(__FILE__)));
define('ROOT_PATH', dirname(__FILE__));

//ini_set('open_basedir', ROOT_PATH . '/data/upload');


if($path)
{
    $file = $path;
    
    $file_row = explode('!', $file);
    
    //原图
    $image_ori = $file_row[0];
    
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    
    switch ($extension)
    {
        case 'jpg':
        case 'jpeg':
            header("Content-type: image/jpeg");
            break;
        
        case 'gif':
            header("Content-type: image/gif");
            break;
        
        case 'png':
            header("Content-type: image/png");
            break;
        default:
            header("Content-type: image/png");
            break;
    }
    
    $ori_ext = pathinfo($image_ori, PATHINFO_EXTENSION);
    switch ($ori_ext)
    {
        case 'jpg':
        case 'jpeg':
        case 'gif':
        case 'png':
            break;
        default:
            die();
            break;
    }
    
    ob_start ();//开始截获输出流
    
    //如果需要处理图片
    if (isset($file_row[1]))
    {
        $image_size = $file_row[1];
        
        //读取缩略尺寸
        $file_path = ROOT_PATH . '/thumb/' . $file;
        
        if (is_file($file_path))
        {
            echo file_get_contents($file_path);
        }
        else
        {
            if (!file_exists(dirname($file_path)))
            {
                mkdir(dirname($file_path), 0777,true);
            }
            
            //原图存在
            $image_ori_path = ROOT_PATH . '/' . $image_ori;
            
            if (is_file($image_ori_path))
            {
                //430x430q90.jpg
                $imgge_size_q_row = explode('.', $image_size);
                //$imgge_size_q_row = explode('q', $image_size);
    
                $imgge_size_str = $imgge_size_q_row[0];
    
                $imgge_size_row = explode('x', $imgge_size_str);
    
                $width = $imgge_size_row[0];
    
                $imgge_size_row[1] = isset($imgge_size_row[1]) ? intval($imgge_size_row[1]) : 10;
    
                $height = isset($imgge_size_row[1]) ? $imgge_size_row[1] : 1;
    
                //按照最小的比例为基准缩放。
                
                //生成缩略图
                include_once ROOT_PATH . '/libraries/vendor/php' . floatval(PHP_VERSION) . '/Zero/Image.php';
                include_once ROOT_PATH . '/libraries/vendor/php' . floatval(PHP_VERSION) . '/Zero/Image/Driver/Gd.php';
                
                $PhalApi_Image = new Zero_Image();
                $PhalApi_Image->open($image_ori_path);
                
                $PhalApi_Image->thumb($width, $height, IMAGE_THUMB_CENTER);
                //$PhalApi_Image->text('Zero', ROOT_PATH . '/libraries/Image/kangti.ttf', 10, '#000000', IMAGE_WATER_SOUTHEAST, -5);
    
                $flag = $PhalApi_Image->save($file_path, $extension);
                
                /*
                include_once ROOT_PATH . '/libraries/Image/Resize.php';
                $Image_Resize = new Image_Resize();
                $Image_Resize->load($image_ori_path);
                
                
                $Image_Resize->resize($width, $height);
                $flag = $Image_Resize->save($file_path);
                */
                
                if ($flag && is_file($file_path))
                {
                    echo file_get_contents($file_path);
                }
            }
            else
            {
                header ( 'HTTP/1.1 404 Not Found' );
                exit ();
            }
        }
    }
    else
    {
        $image_ori_path = ROOT_PATH . '/' . $image_ori;
        
        //原图
        if (is_file($image_ori_path))
        {
            echo file_get_contents($image_ori_path);
        }
        else
        {
            header ( 'HTTP/1.1 404 Not Found' );
            exit ();
        }
    }
    
    
    $content = ob_get_contents ();//获取输出流
    ob_end_flush ();//输出流到网页,保证第一次请求也有图片数据放回
}

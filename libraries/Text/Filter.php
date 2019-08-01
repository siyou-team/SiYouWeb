<?php
/*
$message = 'j6546s';
$matche_row = array();

//没有违禁词
if (Text_Filter::checkBanned($message, $matche_row))
{

}

//过滤词
Text_Filter::filterWords($message);
echo $message;
 */
class Text_Filter
{
    private static $words = null;  //文字
    
    /**
     * 替换内容
     *
     * @param string $message 内容
     * @param array $matche_row 匹配
     * @return string  替换后的内容
     */
    public static function filterWords(&$message=null, &$matche_row=array())
    {
        if (!self::$words)
        {
            //include_once(INI_PATH . '/filter.ini.php');
            $_CACHE = Zero_Config::load('filter');
            
            self::$words =& $_CACHE['word_filter'];
        }
        else
        {
        
        }
        
        $message = empty(self::$words['filter']) ? $message : @preg_replace(self::$words['filter']['find'], self::$words['filter']['replace'], $message);
    }
    
    /**
     * 替换内容
     *
     * @param string $message 内容
     * @param array $matche_row 匹配
     * @return bool  是否有违禁词
     */
    public static function checkBanned(&$message=null, &$matche_row=array())
    {
        if (!self::$words)
        {
            //include_once(INI_PATH . '/filter.ini.php');
            $_CACHE = Zero_Config::load('filter');
            self::$words = $_CACHE['word_filter'];
        }
        else
        {
        
        }
        
        if(self::$words['banned'] && preg_match(self::$words['banned'], $message, $matche_row))
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}
?>
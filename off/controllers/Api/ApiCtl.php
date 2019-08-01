<?php if (!defined('ROOT_PATH')){exit('No Permission');}

/**
 * Api接口, 非权限验证接口
 *
 *
 * @category   Game
 * @package    User
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2015, 黄新泽
 * @version    1.0
 * @todo
 */
class Api_ApiCtl extends Api_AdminController
{
	/**
	 * 测试是否支持pathinfo
	 *
	 * @access public
	 */
	public function pathInfo()
	{
	    $path_info = trim($_SERVER['PATH_INFO'], '/');
	    
	    if ($path_info === 'test_pathinfo')
        {
            $status = 200;
        }
        else
        {
            $status = 250;
        }
	    
        $this->render('default', array(), $null, $status);
	}

	/**
	 * 测试是否支持rewrite
	 *
	 * @access public
	 */
	public function rewrite()
	{
	    $path_info = trim($_SERVER['PATH_INFO'], '/');
	    
	    if ($path_info === 'test_pathinfo')
        {
            $status = 200;
        }
        else
        {
            $status = 250;
        }
	    
        $this->render('default', array(), $null, $status);
	}
}

?>
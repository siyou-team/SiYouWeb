<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * Api接口, 让App等调用
 *
 *
 * @category   Game
 * @package    User
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2015, 黄新泽
 * @version    1.0
 * @todo
 */
class Api_ConfigCtl extends Api_AdminController
{
	/**
	 * 验证API是否正确
	 *
	 * @access public
	 */
	public function checkApi()
	{
		$this->render('default', array(1));
	}

	/**
	 * 生成API是否正确
	 *
	 * @access public
	 */
	public function editAppInfo()
	{
		$data = array();
		$data['shop_app_key'] = request_string('shop_app_key_new');
		$data['shop_app_url'] = request_string('shop_app_url_new');
		$data['shop_app_id'] = request_string('shop_app_id_new');
		
		$file = INI_PATH . '/shop_api.ini.php';
		
		if (!Zero_Utils_File::generatePhpFile($file, $data))
		{
			$status = 250;
			$msg = __('生成配置文件错误!');
		}
		else
		{
			$status = 200;
			$msg = __('success!');
		}

		$this->render('default', array(), $msg, $status);
	}
}

?>
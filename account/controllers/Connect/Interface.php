<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
interface Connect_Interface
{
	public function login();

	/**
	 * callback 回调函数
	 *
	 * @access public
	 */
	public function callback();
	public function select();
}
?>
<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * Api接口
 *
 *
 * @category   Game
 * @package    User
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2015, 黄新泽
 * @version    1.0
 * @todo
 */
class ApiCtl extends Zero_AppController
{
	/**
	 * Constructor
	 *
	 * @param  string $ctl 控制器目录
	 * @param  string $met 控制器方法
	 * @param  string $typ 返回数据类型
	 * @access public
	 */
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);


		$data = new Zero_Data();

		//API PERM
		$key = Base_ConfigModel::getConfig('offline_app_key');

		if (isset($_REQUEST['debug']))
		{
		}
		else
		{
			if ((isset($_POST['token']) && isset($_POST['app_id_from']) && $_POST['app_id_from'] == Base_ConfigModel::getConfig('passport_app_id')))
			{
				if (!check_url_with_encrypt($key, $_POST))
				{
					$this->dataModel->setError(__('API接口有误,请确保APP KEY及APP ID正确'), 30);
					$d = $this->dataModel->getDataRows();

					$protocol_data = Zero_Data::encodeProtocolData($d);
					echo $protocol_data;

					exit();
				}
			}
			else
			{
				$this->dataModel->setError(__('API接口有误,请确保APP KEY及APP ID正确'), 30);
				$d = $this->dataModel->getDataRows();

				$protocol_data = Zero_Data::encodeProtocolData($d);
				echo $protocol_data;

				exit();
			}
		}
	}


	/**
	 * 验证API是否正确
	 *
	 * @access public
	 */
	public function checkApi()
	{
		$this->render('user', array());
	}
}
?>
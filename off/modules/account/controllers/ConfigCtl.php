<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     Xinze <xinze@live.cn>
 */
class ConfigCtl extends AccountAdminController
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
	}

	/**
	 * 首页
	 *
	 * @access public
	 */
	public function index()
	{
		$res_row = $this->getUrl();

		$this->render('default', $res_row['data'], $res_row['msg'], $res_row['status']);
	}

	/**
	 * 设置商城API网址及key - 后台独立使用
	 *
	 * @access public
	 */
	public function api()
	{
		$this->render();
	}

	public function layout()
	{
		$this->render('page_layout');
	}

	/**
	 * 设置用户中心API网址及key - 后台独立使用
	 *
	 * @access public
	 */
	public function editPassportApi()
	{
		$passport_app_row = request_row('passport_api');

		$passport_app_key = $passport_app_row['passport_app_key'];
		$passport_app_url = $passport_app_row['passport_app_url'];
		$passport_app_id  = 100;

		//先检测API是否正确
		$key = $passport_app_key;
		$url = $passport_app_url;
		$formvars = array();
		$formvars['app_id_from'] = $passport_app_id;
		$init_rs         = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Config&met=checkApi&typ=json', $url), $formvars);

		$data = array();

		if (200 == $init_rs['status'])
		{
			//读取服务列表
			$data = $init_rs['data'];
			$status = 200;
			$msg = isset($init_rs['msg']) ? $init_rs['msg'] : __('sucess');


			//

			$data = array();
			$data['passport_app_key'] = $passport_app_key;
			$data['passport_app_url'] = $passport_app_url;
			$data['passport_app_id'] = $passport_app_id;

			$file = INI_PATH . '/passport.ini.php';

			if (!Zero_Utils_File::generatePhpFile($file, $data))
			{
				$status = 250;
				$msg = __('生成配置文件错误!');
			}
			else
			{
				$data = $this->getUrl('Config', 'edit');
			}
		}
		else
		{
			$status = 250;
			$msg = isset($init_rs['msg']) ? $init_rs['msg'] : __('请求错误!');
		}


		$this->render('default', $data=array(), $msg, $status);
	}

	/**
	 * 设置商城API网址及key - 后台独立使用
	 *
	 * @access public
	 */
	public function editShopApi()
	{
		$shop_app_row = request_row('shop_api');

		$shop_app_key = $shop_app_row['shop_app_key'];
		$shop_app_url = $shop_app_row['shop_app_url'];
		$shop_app_id = 102;

		//先检测API是否正确
		$key = $shop_app_key;
		$url = $shop_app_url;
		$formvars = array();
		$formvars['app_id_from'] = $shop_app_id;
		$init_rs         = get_url_with_encrypt($key, sprintf('%s?ctl=Api_Config&met=checkApi&typ=json', $url), $formvars);

		$data = array();

		if (200 == $init_rs['status'])
		{
			//读取服务列表
			$data = $init_rs['data'];
			$status = 200;
			$msg = isset($init_rs['msg']) ? $init_rs['msg'] : __('sucess');


			//

			$data = array();
			$data['shop_app_key'] = $shop_app_key;
			$data['shop_app_url'] = $shop_app_url;
			$data['shop_app_id'] = $shop_app_id;

			$file = INI_PATH . '/shop_api.ini.php';

			if (!Zero_Utils_File::generatePhpFile($file, $data))
			{
				$status = 250;
				$msg = __('生成配置文件错误!');
			}
		}
		else
		{
			$status = 250;
			$msg = isset($init_rs['msg']) ? $init_rs['msg'] : __('请求错误!');
		}


		$this->render('default', $data=array(), $msg, $status);
	}


	/**
	 * 列表数据
	 *
	 * @access public
	 */
	public function type()
	{
		$supply_type_rows = array();

		//类似数据可以放到前端整理
		$supply_type_row               = array();
		$supply_type_row['sortIndex']  = 0;
		$supply_type_row['id']         = 1;
		$supply_type_row['parentId']   = 0;
		$supply_type_row['detail']     = true;
		$supply_type_row['typeNumber'] = 'trade';
		$supply_type_row['level']      = 1;
		$supply_type_row['status']     = 0;
		$supply_type_row['remark']     = null;
		$supply_type_row['name']       = 'aaaa';

		$supply_type_rows[] = $supply_type_row;

		$data          = array();
		$data['items'] = $supply_type_rows;

		$this->render('default', $data);
	}
}

?>
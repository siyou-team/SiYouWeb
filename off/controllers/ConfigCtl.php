<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     Xinze <xinze@live.cn>
 */
class ConfigCtl extends AdminController
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);
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
	    $module_data = $this->getServiceData('Base_Module', 'lists', array('module_type'=>2));
        
        
        $data_rs = array();
        $data_rs['module_rows'] = $module_data['data']['items'];
        
		$this->render('layoutit', $data_rs);
		//$this->render('page_layout');
		//$this->render('build_layout');
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
	
	
	public function update()
	{
		$client_version         = Base_ConfigModel::getConfig('current_version', '1.0.1');
		$client_db_version      = Base_ConfigModel::getConfig('current_db_version', '1');
		$required_php_version   = Base_ConfigModel::getConfig('required_php_version', '5.3');
		$required_mysql_version = Base_ConfigModel::getConfig('required_mysql_version', '5.0');
		
		$app_id   = '101';
		$db_id   = 'shop_admin';
		$db_prefix     = 'yf_admin_';
		$db_prefix_base     = 'yf_admin_';
  
  
		$upgrader = new \Zero\Upgrader\Core($app_id, $client_version, LANG, $db_id, $db_prefix, $db_prefix_base);
		
		
		
		$version_rows = $upgrader->getCoreVersion();
		
		$version_row = $version_rows['latest'];
		
		//检测本地文件是否变动过
		$change_file_row = array();
		
		if ($partial = $upgrader->checkFiles($change_file_row))
		{
			
		}
		else
		{
		}
		
		
		if ($partial && request_int('upgrade') || request_int('force-upgrade'))
		{
			$updates = $upgrader->getCoreUpdateList();
			
			$version = $version_row['version'];
			$locale  = $version_row['locale'];
			
			$update = $upgrader->findCoreUpdate($version, $locale, $updates);
			
			
			if ($update)
			{
                $data['update'] = $update;
                
				$this->setMet('upgrade');
			}
		}
        
        $data['version_row'] = $version_row;
        $data['client_version'] = $client_version;
        $data['change_file_row'] = $change_file_row;
        $data['partial'] = $partial;
        
        $this->render('default', $data);
	}
	
	public function updateShop()
	{
		//从API获取。
		$data = $this->getUrl('Config', 'update');
		
		$change_file_row = $data['change_file_row'];
		$version_row     = $data['version_row'];
		$client_version  = $data['client_version'];
		$partial         = $data['partial'];
		
		
		if ($partial && request_int('upgrade') || request_int('force-upgrade'))
		{
			//url 带加密数据跳转
			$this->setMet('upgradeShop');
		}
		
		include $view = $this->getView();
		
	}
	
	public function upgradeShopContainer()
	{
		
		include $view = $this->getView();
		
	}
	
	
	public function upgradeShop()
	{
		//从API获取。
		$data = $this->getUrl('Config', 'update');
		
		$change_file_row = $data['change_file_row'];
		$version_row     = $data['version_row'];
		$client_version  = $data['client_version'];
		$partial         = $data['partial'];
		
		
		if ($partial && request_int('upgrade') || request_int('force-upgrade'))
		{
			//url 带加密数据跳转
			
			$data = $this->getUrl('Config', 'update', '', 'e', true);
			
		}
		
	}
	
    public function initSitemap()
    {
        //从API获取。
        $data = $this->getUrl('Config', 'initSitemap');
    
        $this->render('default', $data['data'], $data['msg'], $data['status']);
    }
}

?>
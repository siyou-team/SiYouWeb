<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class IndexCtl extends Zero_AppController
{
	public function __construct(&$ctl, $met, $typ)
	{
		parent::__construct($ctl, $met, $typ);

		//检测lock file
		$lock_file = APP_PATH . '/data/installed.lock';

		if(file_exists($lock_file))
		{

			$msg = __('系统已经安装过了，如果要重新安装，那么请删除install/data目录下的installed.lock文件');
            $this->showMsg($msg);
			die();
		}
	}

    public function index()
    {
        $this->title= __('安装协议');
		//检测配置文件是否存在正确,
		//检测表是否正确
		//
		// 如果无表,则直接安装 install
        
		$state_row = check_install_db();
    
    
        $this->setMet('policy');
		if (10 == $state_row['state'])
		{
			$msg = '已经安装完成,不可以再次安装!';
            $this->showMsg($msg);
		}
		elseif (9 == $state_row['state'])
		{
			$msg = '数据库信息已经存在,不可以继续安装,请先手动删除存在的表后,执行安装程序!';
            $this->showMsg($msg);
		}
		else
		{
			$this->setMet('policy');
		}
    }

	public function step1()
	{
        $this->setMet('policy');
	}

	public function step2()
	{
        $this->title= __('运行环境检测');
		$this->render();
	}

	public function step3()
	{
        $this->title= __('设置数据库配置信息');
        
        $db_cfg = Zero_Registry::get('db_cfg');
        $state = 1;
        $msg = '';
        
        if ($db_row = current($db_cfg['master']['shop_admin']))
        {
        
        }
        
		$this->render('default', array('db_row'=>$db_row));
	}

	public function step4()
	{
		$this->render();
	}

	public function msg()
	{
		$this->render();
	}

    public function policy()
    {
		$this->render();
    }

	public function checkEnv()
	{
		sleep(1);

		$check_rs = true;

		//版本
		$version_row = array();
		$version_row['php_version'] = PHP_VERSION;
		$version_row['short_open_tag'] = get_cfg_var('short_open_tag');


		$os = explode(" ", php_uname());
		$version_row['php_uname'] = $os[0];
		$version_row['upload_max_filesize'] = min(get_cfg_var('post_max_size'), get_cfg_var('upload_max_filesize'));


		//var_dump($version_row['short_open_tag']);

		//print_r($version_row);

		//扩展
		$loaded_ext_row = get_loaded_extensions();
		$check_ext_row = include_once INI_INSTALL_PATH . '/check_ext.ini.php';

		foreach ($check_ext_row as $ext_name)
		{
			if (!in_array($ext_name, $loaded_ext_row))
			{
				$check_rs = false;
				break;
			}
		}

		//目录权限
		$check_dir_row = include_once INI_INSTALL_PATH . '/check_dir.ini.php';
		$dir_rows = check_dirs_priv($check_dir_row);

		//函数检查
		if (!$dir_rows['result'])
		{
			$check_rs = false;
		}

		$this->render();
	}

    public function plugin()
    {
        $this->render();
    }

	public function db()
	{
		$db_cfg = Zero_Registry::get('db_cfg');
		$db_row = current($db_cfg['master']['shop_admin']);
		$this->render();
	}

	public function initDbConfig()
	{
		$db_row = array(
			'host' => 'localhost',
			'port' => '3306',
			'user' => '',
			'password' => '',
			'database' => '',
			'charset' => 'UTF8'
		);

		$db_row['host'] = request_string('host');
		$db_row['port'] = request_string('port');
		$db_row['user'] = request_string('user');
		$db_row['password'] = request_string('password');
		$db_row['database'] = request_string('database');

		$db_row = array_map('htmlspecialchars', $db_row);


		$file = INI_PATH . '/db.ini.php';

		$prefix = htmlspecialchars(request_string('prefix'));

		//$data[] = 'define("TABLE_SHOP_DATA_PREFIX", "' . $prefix . '"); //表前缀';
  
  
  
  
		$data['db_row'] = array(
		    'db_cfg'=>array(
		        'master'=>array(
		            'shop_data'=>array($db_row),
		            'account'=>array($db_row),
		            'pay'=>array($db_row),
		            'shop_admin'=>array($db_row),
		            'invoicing'=>array($db_row),
		            'cms'=>array($db_row),
		            'sns'=>array($db_row)
                )
            )
        );
		
		$data[] = 'return $db_row';

		if (Zero_Utils_File::generatePhpFile($file, $data))
		{
			$status = 200;
			$msg = __('success!');
   
			location_to('./index.php?met=install');
		}
		else
		{
			$status = 250;
			$msg = __('生成配置文件错误!');
            $this->showMsg($msg);
		}

		
	}

	public function install()
	{
	    set_time_limit(0);
	    
		$state_row = check_install_db();

		if (10 == $state_row['state'])
		{
			$this->setMet('msg');

			$msg = '已经安装完成,不可以再次安装!';
			$this->render();
		}
		elseif (9 == $state_row['state'])
		{
			location_to('./index.php?met=admin');
		}
		else if (2 == $state_row['state'])
		{
			ob_end_flush();

			$this->render();
            $html = ob_get_end_clean_start();
            ob_end_clean();
            echo $html;


			echo str_repeat(" ", 4096);  //以确保到达output_buffering值
			echo '<script type="text/javascript">$("#process_bar").append("安装中")</script>';  //以确保到达output_buffering值
            
            if(ob_get_level()>0)
            {
                ob_flush();
            }
            
			flush();

			//如果无表,则直接安装 install
			$Db    = Zero_Db::get('shop_admin');

			$db = new Zero_Utils_DbManage ($Db);

			$sql_path = APP_PATH . '/data/sql/';

			$dir = scandir($sql_path);

			$init_db_row = array();

			foreach ($dir as $item)
			{
				$file = $sql_path . DIRECTORY_SEPARATOR . $item;
				if (is_file($file))
				{
					$flag = $db->import($file, TABLE_SHOP_DATA_PREFIX, null,  '<script type="text/javascript">$("#process_bar").append(" . ")</script>');
					check_rs($flag, $init_db_row);
				}
			}
            
            
            
            $base_url = Zero_Registry::get('base_url');
			
            $init_sql_str = "update `account_base_config` set `config_value`='{$base_url}/account.php' where `config_key`='passport_app_url'";
            $flag = $Db->exec($init_sql_str);

			$init_sql_str = "update `account_base_config` set `config_value`='{$base_url}/index.php' where `config_key`='shop_app_url'";
			$flag = $Db->exec($init_sql_str);


			//UPDATE `shop_base_product_category` SET `type_id`='1001'
   
			if (is_ok($init_db_row))
			{
			    //初始化config文件。
			    file_get_contents("{$base_url}/shop/api/config.php");
				die('<script>window.location.href="./index.php?met=admin";</script>;');

			}
			else
			{
				$this->setMet('msg');

				$msg = '初始化数据库失败!';
				$this->render();
			}
		}
		else
		{
			location_to('./index.php?met=step3&msg=' . urlencode('数据库配置不正确!'));
		}

	}

	public function admin()
	{
	    $this->title = __('创建管理员账号');
		$this->render();
	}

	public function createAdminAccount()
	{
		$User_BaseModel = new LoginModel();

		/*
		$key = Zero_Registry::get('passport_app_key');;
		$url       = Zero_Registry::get('passport_app_url');
		$app_id    = Zero_Registry::get('passpord_app_id');
		$server_id = Zero_Registry::get('server_id');
		*/

		$key       = request_string('passport_app_key', rand(1000000000, 9999999999));
		$url       = request_string('passport_app_url', Base_ConfigModel::getConfig('passport_app_url', Zero_Registry::get('base_url') . '/account.php'));
		$app_id    = request_string('passpord_app_id', '100');
		//$server_id = Zero_Registry::get('server_id');

        /*
		//开通ucenter
		//本地读取远程信息
		$formvars              = array();
		$formvars['user_name'] = request_string('user_account');
		$formvars['password']  = request_string('user_password');
		$formvars['app_id']    = $app_id;
		$formvars['server_id'] = $server_id;
		$formvars['is_install'] = 1;

		$formvars['ctl'] = 'Api';
		$formvars['met'] = 'addUserAndBindAppServer';
		$formvars['typ'] = 'json';

		$init_rs = get_url_with_encrypt($key, $url, $formvars);
        */
        $user_account  = request_string('user_account');
        $user_password = request_string('user_password');
        
        $user_row = $User_BaseModel->getByAccount($user_account);
        
		if (!$user_row)
		{
            $user_id = $User_BaseModel->register($user_account, $user_password, null, null, null, false, 1, 1);
			
			/*
			$Rights_GroupModel = new Rights_GroupModel();
			$data_rights                = $Rights_GroupModel->getRightsGroupList();
			$data_rights                = $data_rights['items'];

			foreach ($data_rights as $key => $val)
			{
				if ($val['rights_group_id'] == $data['rights_group_id'])
				{
					$data['rights_group_name'] = $val['rights_group_name'];
				}
			}
			*/
			
			$data['user_id'] = $user_id;

			if ($user_id)
			{
                $filed_rows = array(
                    array(
                        'config_key'=>'passport_app_key',
                        'config_value'=>$key,
                        'config_type'=>'passport',
                        'config_enable'=>1
                    ),

                    array(
                        'config_key'=>'passport_app_url',
                        'config_value'=>$url,
                        'config_type'=>'passport',
                        'config_enable'=>1
                    ),

                    array(
                        'config_key'=>'passport_app_id',
                        'config_value'=>$app_id,
                        'config_type'=>'passport',
                        'config_enable'=>1
                    )
                );
                
                
			    //设置config
                $Base_ConfigModel = Base_ConfigModel::getInstance();
                $Base_ConfigModel->save($filed_rows);
                
                //修改nav
                $Base_SiteNavModel = Base_SiteNavModel::getInstance();
                
                $qrcode_img = Base_ConfigModel::qrcode(Zero_Registry::get('wap_url'));
                $nav_dropdown_menu = '<ul class="dropdown-menu"><li><a href="' . Zero_Registry::get('wap_url') . '"><img src="' . $qrcode_img. '" alt="" /></a></li></ul>';
                
                $Base_SiteNavModel->edit(18, array('nav_url'=>Zero_Registry::get('wap_url'), 'nav_dropdown_menu'=>$nav_dropdown_menu));
                $Base_SiteNavModel->edit(27, array('nav_url'=>url('Product', 'lists')));
                $Base_SiteNavModel->edit(13, array('nav_url'=>url('Point')));
                $Base_SiteNavModel->edit(28, array('nav_url'=>url('Activity', 'discount')));
                $Base_SiteNavModel->edit(24, array('nav_url'=>url('Product', 'brand')));
                $Base_SiteNavModel->edit(30, array('nav_url'=>url('Join')));
                
                //
                $Base_SiteNavModel->edit(6, array('nav_url'=>url('Article', 'get', 'cms', '', array('article_id'=>1))));
                $Base_SiteNavModel->edit(7, array('nav_url'=>url('Article', 'get', 'cms', '', array('article_id'=>4))));
                $Base_SiteNavModel->edit(8, array('nav_url'=>url('Article', 'get', 'cms', '', array('article_id'=>29))));
                $Base_SiteNavModel->edit(9, array('nav_url'=>url('Article', 'get', 'cms', '', array('article_id'=>3))));
                
                
				$msg    = 'success';
				$status = 200;
			}
			else
			{
				$msg    = 'failure';
				$status = 250;
			}
		}
		else
		{
			$data   = array();
			$msg    = '发生错误, 用户已经存在!' ;
			$status = 250;
		}

		if (250 == $status)
		{
		    $this->forward($msg);
		}
		else
		{

			//检测lock file
			$lock_file = APP_PATH . '/data/installed.lock';

			if(!file_exists($lock_file))
			{
				file_put_contents($lock_file, '');
			}

			$this->setMet('complete');

			$this->render();
		}

	}
}

/**
 * 检查目录的读写权限
 *
 * @access  public
 * @param   array     $check_dir_row     目录列表
 * @return  array     检查后的消息数组，
 */
function check_dirs_priv($check_dir_row)
{
	$state = array('result' => true, 'detail' => array());

	foreach ($check_dir_row as $dir)
	{
        $file = ROOT_PATH . $dir['dir'];

		if (!file_exists($file))
		{
			//$flag = mkdir($file, 0777, true);
		}

		if (is_writable($file))
		{
			$state['detail'][] = array($dir, __('yes'), __('可写'));
		}
		else
		{
			$state['detail'][] = array($dir, __('no'), __('不可写'));
			$state['result'] = false;
		}
	}

	return $state;
}



function check_install_db()
{
	//如果无表,则直接安装 install
	$db_cfg = Zero_Registry::get('db_cfg');
	$state = 1;
	$msg = '';

	if ($db_row = current($db_cfg['master']['shop_admin']))
	{
		try
		{
			$db_id = 'shop_admin';
			$Db  = Zero_Db::get($db_id);
			//define("DATABASE", $Dbh->cfg[$db_id]['database']);

			if ($Db->detectDbConnect())
			{
				$state = 2;

				$table_sql = 'SELECT table_name FROM information_schema.tables WHERE table_schema="' . $db_row['database'] .'" AND table_type="BASE TABLE"';

				$table_rows = $Db->getAll($table_sql);

				foreach ($table_rows as $table_row)
				{
					//表存在,则停止安装
					if (TABLE_SHOP_DATA_PREFIX == substr($table_row['table_name'], 0, strlen(TABLE_SHOP_DATA_PREFIX)))
					{
						$state = 9;
						$msg = '数据库信息已经存在,不可以继续安装,请先手动删除存在的表后,执行安装程序!';
						break;
					}
				}

				//判断admin是否设置.
				$admin_user_base = sprintf('%suser_base', TABLE_SHOP_DATA_PREFIX);

				//$admin_user_base
				if (false)
				{
					$state = 10;
				}
			}
		}
		catch(Exception $e)
		{

		}
	}

	return array('state'=>$state, 'msg'=>$msg);
}

?>
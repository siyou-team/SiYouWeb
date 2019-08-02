<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 *
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class LoginModel extends User_BaseModel
{
	public static function checkCallback($return_flag=false)
	{
		$callback_url = s('callback', Zero_Registry::get('url'));
		$from = s('from');

		//如果已经登录,则直接跳转
		if (Zero_Perm::checkUserPerm())
		{
			$data = Zero_Perm::getUserRow();

			$k = $_COOKIE[Zero_Perm::getCookieName()];
			$u = $_COOKIE[Zero_Perm::getCookieId()];
            
            $callback_url = urldecode($callback_url);
            
			if (strpos($callback_url, '?') === false)
			{
				$callback_url = sprintf('%s?ut=%s', $callback_url, $data['user_token']);
			}
			else
			{
				$callback_url = sprintf('%s&ut=%s', $callback_url, $data['user_token']);
			}
   
			//$callback_url = sprintf('%s&au=%s&ak=%s', $callback_url, urlencode($u), urlencode($k));

			if (!$return_flag)
			{
				location_to($callback_url);
			}
			else
			{
                $callback_url = urlencode($callback_url);
			}
		}

		return $callback_url;
	}

	public static function callbackStr($flag=true)
	{
		$row = array();
		$row['bind_type'] = urlencode(s('bind_type'));
		$row['t'] = urlencode(s('t'));
		$row['from'] = urlencode(s('from'));
		$row['callback'] = s('callback');
		//$row['callback'] = urlencode(s('callback'));

		$row = array_filter($row);
		$url_query = http_build_query($row); //会urlencode

		$from_callback_str = '';

		if ($url_query)
		{
			if ($flag && Zero_Registry::get('friendly_url_flag'))
			{
				$from_callback_str = '?' . $url_query;
			}
			else
			{
				$from_callback_str =  '&' . $url_query;
			}
		}

		return $from_callback_str;
	}

	/**
	 * 登录
	 *
	 * @param  string $user_account 用户账号
	 * @param  string $user_password 用户密码
	 * @param  mixed $verification_code 验证码
	 * @return array 用户登录数据
	 * @access public
	 */
	public function login($user_account, $user_password, $verification_code=null)
	{
		$data = array();

		$user_account = strtolower($user_account);
		
		if (!$user_account)
		{
			$this->msg->setMsg(__('请输入账号'), ErrorCode::E_ACCOUNT);
		}

		if (!$user_password)
		{
			$this->msg->setMsg(__('请输入密码'), ErrorCode::E_PASSWORD);
		}
		else
		{
			$user_base_row   = $this->getByAccount($user_account);
            
            if (!$user_base_row)
            {
                //判断用户手机是否存在
                if (Zero_Utils_String::isMobile($user_account))
                {
                    $bind_id = $user_account;
    
                    $bind_row = User_BindConnectModel::getInstance()->findOne(array('bind_id'=>$bind_id, 'bind_type'=>User_BindConnectModel::MOBILE, 'bind_active'=>1));
    
                    if ($bind_row)
					{
                        $user_base_row   = $this->getOne($bind_row['user_id']);
					}
                }
            }
            
			if (!$user_base_row)
			{
				$this->msg->setMsg(__('账号不存在'), ErrorCode::E_ACCOUNT);
			}
			else
			{
				$user_state = $user_base_row['user_state'];
				
				if ($user_state)
				{
					$user_salt = $user_base_row['user_salt'];
					
					if (md5($user_salt . md5($user_password)) != $user_base_row['user_password'])
					{
						$this->msg->setMsg(__('密码错误'), ErrorCode::E_PASSWORD);
					}
					else
					{
						$data = $this->doLogin($user_base_row['user_id'], $user_base_row);
						$this->msg->setMsg(__('登录成功'), ErrorCode::E_SUCC);
					}
				}
				else
				{
					$this->msg->setMsg(__('账号被封禁'), ErrorCode::E_DISABLED);
				}
				
			}
		}

		return $data;
	}

	/**
	 * 执行登录操作
	 *
	 * @param  int $user_id 用户账号
	 * @param  array $user_base_row 用户信息
	 * @return array 用户登录数据
	 * @access public
	 */
	public function doLogin($user_id, $user_base_row=array())
	{
		$data = array();

		$User_InfoModel = new User_InfoModel();

		if (!$user_base_row)
		{
			$user_base_row   = $this->getOne($user_id);
		}

		if (!$user_base_row)
		{
			$this->msg->setMsg(__('用户不存在'), ErrorCode::E_ACCOUNT);
		}
		else
		{
			$user_key = $user_base_row['user_key'];

			$user_key_row               = array();
			/*
			srand((double) microtime() * 1000000);
			$user_key                 = uniqid(rand());
			$user_key_row['user_key'] = $user_key;  //修改密码时候修改,登录暂时不变
			*/

			srand((double) microtime() * 1000000);
			$user_key_row['user_token'] = uniqid(rand());

			if ($this->edit($user_id, $user_key_row) > 0)
			{
				$encrypt_row            = array();
				$encrypt_row['user_id'] = $user_id;

				$encrypt_str = Zero_Perm::encryptUserInfo($encrypt_row, $user_key);

				$data = $user_base_row;

				unset($data['user_password']);
				unset($data['user_key']);
				unset($data['user_token']);
				unset($data['user_salt']);

				$data['k'] = $encrypt_str;
				$data['key'] = $encrypt_str;
				$data['rid'] = $_COOKIE[Zero_Perm::getCookieRoleId()];
				
				//登录完成，积分变动，插件机制
                //login_done
                $PluginManager = Zero_Plugin_Manager::getInstance();
                $PluginManager->trigger('login_done', $user_id);
                
                $points_login = Base_ConfigModel::getConfig('points_login');
                User_ResourceModel::points($user_id, $points_login, PointsTypeModel::POINTS_TYPE_LOGIN, sprintf(__('登录赠送积分 %s'), $points_login));
                User_InfoModel::experience($user_id, Base_ConfigModel::getConfig('exp_login'), Base_UserLevelModel::EXP_TYPE_LOGIN);
                
                
                //判断是否绑定，是否填写地址
                
                $cookie = Zero_Cookie::getInstance();
                
				if ($bind_row = User_BindConnectModel::getInstance()->getBind($user_id, User_BindConnectModel::MOBILE))
				{
				
				}
                
                $user_info_row = $User_InfoModel->getOne($user_id);
				
				if (!$user_info_row['user_province_id'] || !$user_info_row['user_city_id'] || !$user_info_row['user_county_id'])
				{
                    $cookie->setCookie('as', 0);
                    $data['as'] = 0;
				}
				else
				{
                    $cookie->setCookie('as', 1);
                    $data['as'] = 1;
				}
            }
			else
			{
				$this->msg->setMsg('登录失败');
			}
		}

		return $data;
	}

	/**
	 * 注册
	 *
	 * @param  string $user_account 用户账号
	 * @param  string $user_password 用户密码
	 * @param  mixed $rand_key 验证码, 如果启用,则有值. 是否启用有控制器判断
	 * @param  mixed $verification_code 验证码
	 * @param  mixed $app_id 来源id
	 * @return array 用户登录数据
	 * @access public
	 */
	public function register($user_account, $user_password, $rand_key=null, $verification_code=null, $app_id=null, $auto_login=false, $rights_group_id=0, $is_admin=0, $store_id='')
	{
		$flag = true;
		$data = array();

		if (!$user_account)
		{
			$flag = false;
			$this->msg->setMsg(__('请输入账号'), ErrorCode::E_ACCOUNT);

		}

		if (!$user_password)
		{
			$flag = false;
			$this->msg->setMsg(__('请输入密码'), ErrorCode::E_PASSWORD);
		}

		if ($rand_key)
		{
			if (!$verification_code)
			{
				$flag = false;
				$this->msg->setMsg(__('请输入验证码'), ErrorCode::E_VERIFYCODE);
			}

			$verification_code_flag = Zero_VerifyCode::checkCode($rand_key, $verification_code);

			if (!$verification_code_flag)
			{
				$flag = false;
				$this->msg->setMsg(__('验证码错误').'--'.$code.'--'.$rand_key.'--'.$verification_code, ErrorCode::E_VERIFYCODE);
			}
		}

		if ($flag)
		{
			$user_base_row = $this->getByAccount($user_account);

			if ($user_base_row)
			{
				$this->msg->setMsg('用户已经存在,请更换用户名!', ErrorCode::E_ACCOUNT);
			}
			else
			{
				$rs_row = array();

				$seq_name = 'user_id';
				$seq = new Number_SeqModel();
				$user_id  = $seq->createNextSeq($seq_name, 10, false);

				$now_time = time();
				$ip       = get_ip();

				srand((double) microtime() * 1000000);

				$user_key                         = uniqid(rand());
				$user_salt                        = uniqid(rand());

				$user_base_reg_row                = array();
				$user_base_reg_row['user_id']     = $user_id;
				$user_base_reg_row['user_account']   = $user_account;
				$user_base_reg_row['user_password']    = md5($user_salt . md5($user_password));
				$user_base_reg_row['user_nickname'] = $user_account;
				$user_base_reg_row['user_state']   = 1;
				$user_base_reg_row['user_key']  = $user_key;
				$user_base_reg_row['user_salt']  = $user_salt;
    
				$user_base_reg_row['rights_group_id']  = $rights_group_id;
				$user_base_reg_row['user_is_admin']  = $is_admin;
				$user_base_reg_row['store_ids']  = $store_id;
				

				srand((double) microtime() * 1000000);
				$user_base_reg_row['user_token']  = uniqid(rand());

				$flag = $this->add($user_base_reg_row);
				array_push($rs_row, $flag);

				$user_login_reg_row                        = array();
				$user_login_reg_row['user_id']           = $user_id;
				$user_login_reg_row['user_reg_time']       = date('Y-m-d H:i:s', $now_time);
				$user_login_reg_row['user_reg_ip']       = $ip;
				$user_login_reg_row['user_lastlogin_time'] = date('Y-m-d H:i:s', $now_time);;
				$user_login_reg_row['user_lastlogin_ip']   = $ip;
				$user_login_reg_row['user_count_login']    = 1;
                
                
                $User_LoginModel = User_LoginModel::getInstance();
				$flag = $User_LoginModel->add($user_login_reg_row);
				array_push($rs_row, $flag);
                
                $user_info_reg_row                        = array();
                $user_info_reg_row['user_id']             = $user_id;
                $user_info_reg_row['user_mobile']         = $user_account;
                $user_info_reg_row['user_avatar']         = Base_ConfigModel::getConfig('user_no_avatar');
                $User_InfoModel = User_InfoModel::getInstance();
                $flag = $User_InfoModel->add($user_info_reg_row);
                array_push($rs_row, $flag);
                
				$Base_App = new Base_AppModel();

				if ($app_id && !($base_app_rows = $Base_App->getApp($app_id)))
				{
					/*
					$base_app_row = array_pop($base_app_rows);

					$arr_field_user_app = array();
					$arr_field_user_app['user_account'] = $user_account;
					$arr_field_user_app['app_id'] = $app_id;
					$arr_field_user_app['active_time'] = time();

					$User_App = new User_AppModel();

					//是否存在
					$user_app_row = $User_App->getAppByNameAndAppId($user_account, $app_id);

					if ($user_app_row)
					{
						// update app_quantity
						$app_quantity_row = array();
						$app_quantity_row['app_quantity'] = $user_app_row['app_quantity'] + 1;
						$flag = $User_App->editApp($user_account, $app_quantity_row);
						array_push($rs_row, $flag);
					}
					else
					{

						$flag = $User_App->addApp($arr_field_user_app);
						array_push($rs_row, $flag);

					}

					$User_AppServerModel = new User_AppServerModel();

					$user_app_server_row = array();
					$user_app_server_row['user_account'] = $user_account;
					$user_app_server_row['app_id'] = $app_id;
					$user_app_server_row['server_id'] = $server_id;
					$user_app_server_row['active_time'] = time();

					$flag = $User_AppServerModel->addAppServer($user_app_server_row);
					*/
				}
				else
				{
				}

				if (is_ok($rs_row))
				{
                    //login_done
                    $PluginManager = Zero_Plugin_Manager::getInstance();
                    $PluginManager->trigger('register_done', $user_id);

                    $points_reg = Base_ConfigModel::getConfig('points_reg');
                    User_ResourceModel::points($user_id,  $points_reg, PointsTypeModel::POINTS_TYPE_REG, sprintf(__('注册赠送积分 %s'), $points_reg));
                    User_InfoModel::experience($user_id, Base_ConfigModel::getConfig('exp_reg'), Base_UserLevelModel::EXP_TYPE_REG);

					$flag = true;
					
					if ($auto_login)
					{
                        //登录
                        $data = $this->doLogin($user_id, $user_base_reg_row);
                        
                        //
                        Zero_VerifyCode::removeCode($rand_key, $verification_code);
                        
					}
					else
					{
                        $data = array('user_id'=>$user_id);
					}
				}
				else
				{
					$flag = false;
				}
			}

		}

		return $data;
	}

	/**
	 * 注册
	 *
	 * @param  string $user_account 用户账号
	 * @param  string $user_password 用户密码
	 * @param  mixed $rand_key 验证码, 如果启用,则有值. 是否启用有控制器判断
	 * @param  mixed $verification_code 验证码
	 * @param  mixed $app_id 来源id
	 * @return array 用户登录数据
	 * @access public
	 */
	public function doResetPasswd($user_account, $user_password, $old_password = null, $app_id=0)
	{
		$flag = true;
		$data = array();

		if (!$user_account)
		{
			$flag = false;
			$this->msg->setMsg(__('请输入账号'), ErrorCode::E_ACCOUNT);

		}

		if (!$user_password)
		{
			$flag = false;
			$this->msg->setMsg(__('请输入密码'), ErrorCode::E_PASSWORD);
		}



		if ($flag)
		{
			//检测登录状态
			$user_row = $this->getByAccount($user_account);

			if ($user_row)
			{
				if($old_password)
				{
					$user_salt = $user_row['user_salt'];

					if (md5($user_salt . md5($old_password)) != $user_row['user_password'])
					{
						$flag = false;
						$this->msg->setMsg(__('原密码错误'), ErrorCode::E_PASSWORD);
					}

				}

				if($flag)
				{

					//重置密码
					$user_id          = $user_row['user_id'];
					$reset_passwd_row = array();

					srand((double) microtime() * 1000000);
					$user_key                         = uniqid(rand());
					$user_salt                        = $user_row['user_salt'];

					$reset_passwd_row['user_password']  = md5($user_salt . md5($user_password));
					$reset_passwd_row['user_key']       = $user_key;

					$flag = $this->edit($user_id, $reset_passwd_row);

					if ($flag)
					{
						$msg    = '重置密码成功';
                        $this->msg->setMsg($msg, ErrorCode::E_PASSWORD);
						$status = 200;
					}
					else
					{
						$msg    = '重置密码失败';
                        $this->msg->setMsg($msg, ErrorCode::E_PASSWORD);
						$status = 250;
					}

				}

			}
			else
			{
				$msg    = '用户不存在';
				$status = 250;
                $this->msg->setMsg($msg, ErrorCode::E_PASSWORD);
			}
		}
		else
		{
			$msg    = '密码不能为空';
			$status = 250;
            $this->msg->setMsg($msg, ErrorCode::E_PASSWORD);
		}

		
		return $flag;
	}


	// apache AllowEncodedSlashes 允许URL中对路径分隔符进行编码, AllowEncodedSlashes 经常和pathinfo配合使用

	public function checkUserToken($user_token)
	{
		$user_row = array();

		$crond = array();
		$crond['user_token'] = $user_token;

		$user_rows = $this->find($crond);

		if ($user_rows)
		{
			$user_row = array_pop($user_rows);

			//验证后, 重置
			srand((double) microtime() * 1000000);

			$user_key_row               = array();
			$user_key_row['user_token'] = uniqid(rand());

			if ($this->edit($user_row['user_id'], $user_key_row) > 0)
			{

			}
		}

		return $user_row;
	}

}
?>

<?php

class LoginCtl extends Zero_AppController
{
    /**
     * layout数据初始化, layoutdata只能在layout view中调用， 控制器 不可以调用
     *
     * @access public
     */
    protected function getLayoutData()
    {
        $layout_data['site_company_name']            = Base_ConfigModel::getConfig('site_company_name');
        $layout_data['site_tel']            = Base_ConfigModel::getConfig('site_tel');
        $layout_data['site_email']            = Base_ConfigModel::getConfig('site_email');
        $layout_data['site_address']            = Base_ConfigModel::getConfig('site_address');
        //$layout_data['site_hotline']            = Base_ConfigModel::getConfig('site_hotline');

        $layout_data['icp_number']            = Base_ConfigModel::getConfig('icp_number');
        $layout_data['copyright']             = Base_ConfigModel::getConfig('copyright');


        $layout_data['statistics_code']     = Base_ConfigModel::getConfig('statistics_code');



        return $layout_data;
    }

    public function getConnectInfo()
    {
        $connect_row = array();

        $Base_ConfigModel = new Base_ConfigModel();
        $data['connect'] = $Base_ConfigModel->getConfigFormatByType(array('connect'));

        if ($data['connect']['mobile_status']['config_value'])
        {
            $item = array();
            $item['url'] = urlh(Zero_Registry::get('index_page'), 'Connect_Weixin', 'login') . LoginModel::callbackStr();
            $item['icon'] = 'sms';

            $connect_row['items'][] = $item;
            $connect_row['sms']= 1;
            $connect_row['sms_url']= $item['url'];
        }

        if ($data['connect']['weixin_status']['config_value'])
        {
            $item = array();
            $item['url'] = urlh(Zero_Registry::get('index_page'), 'Connect_Weixin', 'login') . LoginModel::callbackStr();
            $item['icon'] = 'weixin';

            $connect_row['items'][] = $item;
            $connect_row['weixin']= 1;
            $connect_row['weixin_url']= $item['url'];
        }

        if ($data['connect']['qq_status']['config_value'])
        {
            $item = array();
            $item['url'] = urlh(Zero_Registry::get('index_page'), 'Connect_Qq', 'login') . LoginModel::callbackStr();
            $item['icon'] = 'qq';

            $connect_row['items'][] = $item;
            $connect_row['qq']= 1;
            $connect_row['qq_url']= $item['url'];

        }

        if ($data['connect']['weibo_status']['config_value'])
        {
            $item = array();
            $item['url'] = urlh(Zero_Registry::get('index_page'), 'Connect_Weibo', 'login') . LoginModel::callbackStr();
            $item['icon'] = 'weibo';

            $connect_row['items'][] = $item;
            $connect_row['weibo']= 1;
            $connect_row['weibo_url']= $item['url'];

        }

        $this->render('login', $connect_row);
    }

    public function index()
    {
        LoginModel::checkCallback();

        $Base_ConfigModel = new Base_ConfigModel();
        $data['connect'] = $Base_ConfigModel->getConfigFormatByType(array('connect'));

        $this->setMet('login');
        $this->render('login', $data);

        return get_defined_vars();
    }

	public function login()
	{
		LoginModel::checkCallback();

        $Base_ConfigModel = new Base_ConfigModel();
		$data['connect'] = $Base_ConfigModel->getConfigFormatByType(array('connect'));

		$this->render('login', $data);

        return get_defined_vars();
	}

	public function register()
	{
		LoginModel::checkCallback();

        $Base_ConfigModel = new Base_ConfigModel();
		$data['connect'] = $Base_ConfigModel->getConfigFormatByType(array('connect'));
		$this->render('login', $data);
	}
    public function register_mobile()
  {
      LoginModel::checkCallback();

      $Base_ConfigModel = new Base_ConfigModel();
      $data['connect'] = $Base_ConfigModel->getConfigFormatByType(array('connect'));
      $this->render('login', $data);
  }
	public function findpwd()
	{
		LoginModel::checkCallback();

        $step = i('step', 1);
        $data = array();

		$this->render('login' ,$data);
	}


	public function findpwdStepTwo()
	{
		LoginModel::checkCallback();

        $data = array();
        //修改密码第二步

        $rand_key = s('rand_key', null);
        $verify_code = s('verify_code', null);
        $user_account = s('user_account', null);
        $channel = strtolower(s('channel', 'mobile'));

        $verification_code_flag = Zero_VerifyCode::checkCode($rand_key, $verify_code);

        //验证码验证
        if (!$verification_code_flag || !$verify_code) {
            $data['error'] = __('验证码错误');
        }
        $user_base_row = LoginModel::getInstance()->getByAccount($user_account);

        //用户信息验证
        if (!$user_base_row || !$user_account) {
            $data['error'] = __('用户名错误');
        }
		else
		{
			$user_id = $user_base_row['user_id'];
			$column_data = array('user_id' => $user_id, 'bind_active' => 1);

			//修改方式

			$column_data['bind_type:in'] = array(User_BindConnectModel::MOBILE, User_BindConnectModel::EMAIL);

			$bind_row = User_BindConnectModel::getInstance()->find($column_data);



			if ($bind_row) {
				$current_type = current($bind_row)['bind_type'];
				$current_bind_id = current($bind_row)['bind_id'];
				$next_bind_id = next($bind_row)['bind_id'];

				$data['user_id'] = $user_id;
				$data['channel'] = $channel;
				$data['canChange'] = count($bind_row) == 2 ? true : false;

				//仅仅只有一种方式可以选择时
				if (!$data['canChange']){
					$data['channel_verify_key'] = $current_bind_id;
					$data['channel'] = $current_type == User_BindConnectModel::MOBILE ? 'mobile' : 'email';
				}

				//多种修改方式时
				if (($current_type == User_BindConnectModel::MOBILE && $data['channel'] == 'mobile') || ($current_type == User_BindConnectModel::EMAIL && $data['channel'] != 'mobile')){
					$data['channel_verify_key'] = $current_bind_id;
				} else {
					$data['channel_verify_key'] = $next_bind_id;
				}

			} else {
				if ($channel == 'mobile') {
					$data['error'] = __('未绑定手机, 无法通过手机验证找回密码');
				} else {
					$data['error'] = __('未绑定邮箱, 无法通过邮箱验证找回密码');
				}
			}

		}

		$this->render('login' ,$data);
	}

    public function findpwdStepThree()
    {
        LoginModel::checkCallback();

        $data = array();
        //修改密码第二步
        $channel_verify_key = s('channel_verify_key', null);
        $channel_verify_code = s('channel_verify_code', null);
        $channel = strtolower(s('channel', null));

        $verification_code_flag = Zero_VerifyCode::checkCode($channel_verify_key, $channel_verify_code);
        if ($verification_code_flag == false || !$channel_verify_code || !$channel_verify_key)
        {
            if ($channel == 'mobile'){
                $data['error'] =  __('手机验证码错误或过期！');
            } else {
                $data['error'] =  __('邮件验证码错误或过期！');
            }
        }

        $this->render('login' ,$data);
    }


    //修改密码
    public function setNewPassword()
    {
        $pwd = trim(s('pwd', ''));
        $channel_verify_key = s('channel_verify_key', null);
        $channel_verify_code = s('channel_verify_code', null);
        $channel = strtolower(s('channel', null));

        $data = array();

        if (!$pwd) {
            $msg = __('密码不可为空！');
            $status = 250;
        } else {
            $verification_code_flag = Zero_VerifyCode::checkCode($channel_verify_key, $channel_verify_code);
            if ($verification_code_flag !== false) {

                $user_row = User_BindConnectModel::getInstance()->find(array('bind_id'=>$channel_verify_key, 'bind_active'=>1, 'bind_type'=> User_BindConnectModel::MOBILE));
                $user_id = current($user_row)['user_id'];

                $user_account_row = User_BaseModel::getInstance()->getOne($user_id);
                $user_account = $user_account_row['user_account'];

                $LoginMode = new LoginModel();
                $flag = $LoginMode->doResetPasswd($user_account, $pwd);

                if($flag !== false)
                {
                    $msg = __('操作成功');
                    $status = 200;
                }
                else
                {
                    $msg = $LoginMode->msg->getMsg();
                    $status = 250;
                }
            } else {
                $msg = __('操作失败');
                $status = 250;
            }
        }


        $this->render('user', $data, $msg, $status);
    }

	/**
	 * 自动绑定,随机账号,账号可以修改. 或者采用现有模式, 确定绑定或者注册
	 * 手机注册,邮箱注册,必须验证激活! 无账号注册,可以用户修改用户名当做账号.
	 *
	 * @access public
	 */
	public function select()
	{
		LoginModel::checkCallback();


		//如果不强调绑定的话，此处可以自动创建新账号，自动登录。
		if (true)
		{
			$user_account = s('nickname');
			//判断用户是否存在
			$user_account = $user_account . rand(1000, 9999);

			$user_password = '';

			$LoginModel  = new LoginModel();

			$LoginModel->sql->startTransaction();
			$data = $LoginModel->register($user_account, $user_password);

			if ($data && $LoginModel->sql->commit())
			{
				$msg = __('注册成功');
				$callback_url = LoginModel::checkCallback(true);
				$data['callback_url'] = $callback_url;

				//connect绑定操作
				$User_BindConnectModel = new User_BindConnectModel();
				$User_BindConnectModel->bind(Zero_Perm::getUserId(), s('t'));
			}
			else
			{
				$LoginModel->sql->rollBack();
				$msg = __('创建用户信息失败');
				$msg = $LoginModel->msg->getMsg();
			}

			if ($data)
			{
				$status = 200;
			}
			else
			{
				$status = 250;
			}
		}

        $this->render('login', $data);
	}

	/**
	 * 手机获取注册码
	 *
	 * @access public
	 */
	public function getRegCode()
	{
		$mobile = s('user_mobile');
		$user_account = s('user_account');

		$data = array();

		$data['verify_code'] = rand(1000, 9999);

		$cache = Zero_Cache::create();
		$cache->save($data['verify_code'], $user_account);

		//发送短消息
		$contents = sprintf('您的验证码是：%s。请不要把验证码泄露给其他人。如非本人操作，可不用理会！', $data['verify_code']);

		$result = Zero_Utils_Sms::send($mobile, $contents);

		{
			if (true)
			{
				$msg    = 'success';
				$status = 200;
			}
			else
			{
				$msg    = '失败';
				$status = 250;
			}

		}

		$this->render('login', $data, $msg, $status);
	}


	/**
	 * 手机获取找回密码验证码
	 *
	 * @access public
	 */
	public function getResetPasswdCode()
	{
		$mobile = s('user_mobile');
		$user_account = s('user_account');

		//判断用户是否存在  $mobile
		if (true)
		{
			$data = array();

			$data['verify_code'] = rand(1000, 9999);

			$cache = Zero_Cache::create();
			$cache->save($data['verify_code'], $user_account);

			//发送短消息
			$contents = sprintf('您的验证码是：%s。请不要把验证码泄露给其他人。如非本人操作，可不用理会！', $data['verify_code']);

			$result = Zero_Utils_Sms::send($mobile, $contents);

			{
				if (true)
				{
					$msg    = 'success';
					$status = 200;
				}
				else
				{
					$msg    = '失败';
					$status = 250;
				}

			}
		}
		else
		{
			$msg    = '用户账号不存在';
			$status = 250;
		}

		$this->render('user', $data, $msg, $status);
	}

	/**
	 * 手机获取找回密码-尚未正确
	 *
	 * @access public
	 */
	public function doResetPassword()
	{
		$app_id = s('app_id_from', null);
		$rand_key = s('rand_key', null);
		$verify_code = s('verify_code', null);

		$user_account   = s('user_account');
		$user_mobile    = s('user_mobile');
		$user_password    = s('user_password');

		if (!$user_mobile)
		{
			throw  new Zero_Exception_Protocol('手机号不能为空');
			return false;
		}


		if ($rand_key)
		{
			if (!$verify_code)
			{
				$flag = false;
				$this->msg->setMsg(__('请输入验证码'), ErrorCode::E_VERIFYCODE);
			}

			$verification_code_flag = Zero_VerifyCode::checkCode($rand_key, $verify_code);

			if (!$verification_code_flag)
			{
				$flag = false;
				$this->msg->setMsg(__('验证码错误'), ErrorCode::E_VERIFYCODE);
			}
		}

		if ($verify_code)
		{
			//用户是否存在
			$LoginModel  = new LoginModel();

			$LoginModel->sql->startTransaction();
			$data = $LoginModel->doResetPasswd($user_account, $user_password, null, $app_id);

			if ($data && $LoginModel->sql->commit())
			{
				$msg = __('修改密码成功');

				$callback_url = LoginModel::checkCallback(true);
				$data['callback_url'] = $callback_url;

				Zero_VerifyCode::removeCode($rand_key, $verify_code);

			}
			else
			{
				$LoginModel->sql->rollBack();
				$msg = __('修改密码失败');
				$msg = $LoginModel->msg->getMsg();
			}

			if ($data)
			{
				$status = 200;
			}
			else
			{
				$status = 250;
			}
		}
		else
		{
			$msg    = '验证码不能为空';
			$status = 250;
		}

		$this->render('user', $data, $msg, $status);
	}

	//如果不需要验证码, 则$rand_key $verify_code 为null即可
	public function doRegister()
	{
		$app_id = i('app_id_from', 0);
		$user_account = s('user_account', null);
		$user_password  = s('user_password', null);
//		$verify_code = s('verify_code', null);
        $channel_verify_code=s('channel_verify_code');
        $user_phone=s('user_phone');

		if (!$user_account)
		{
			throw  new Zero_Exception_Protocol('请输入账号', ErrorCode::E_ACCOUNT);
			return false;
		}

		if (!$user_password)
		{
			throw  new Zero_Exception_Protocol('请输入密码', ErrorCode::E_PASSWORD);
			return false;
		}
        $check=VerifyCode::checkCode($user_phone, $channel_verify_code);
		if(!$check){
            throw  new Zero_Exception_Protocol('短信验证码错误', ErrorCode::E_PASSWORD);
            return false;
		}

//
//		if (!$rand_key)
//		{
//			throw  new Zero_Exception_Protocol('程序非法请求, 检测验证码键值');
//			return false;
//		}

//		if (!$verify_code)
//		{
//			throw  new Zero_Exception_Protocol('请输入验证码', ErrorCode::E_VERIFYCODE);
//			return false;
//		}


		/*
		$user_province_id = i('user_province_id');
		$user_city_id = i('user_city_id');
		$user_county_id = i('user_county_id');


		if ( !$user_province_id || !$user_city_id || !$user_county_id)
		{
			throw  new Zero_Exception_Protocol('请选择地区', ErrorCode::E_VERIFYCODE);
			return false;
		}
		*/


		//用户是否存在
		$LoginModel  = new LoginModel();

		$LoginModel->sql->startTransaction();
		$data = $LoginModel->register($user_account, $user_password, null, null, $app_id, true);

		/*
		//修改用户所在地
		$user_info_row = array();
		$user_info_row['user_province_id'] = $user_province_id;
		$user_info_row['user_city_id'] = $user_city_id;
		$user_info_row['user_county_id'] = $user_county_id;

		*/
        $flag = User_InfoModel::getInstance()->edit($data['user_id'], array('user_mobile'=>$user_phone));

        $flag = true;
		if ($data && $flag && $LoginModel->sql->commit())
		{
            {
                //初次注册
                $message_id = 'registration-of-welcome-information';
                $args = array(
                );

                Message_TemplateModel::getInstance()->sendNoticeMsg($data['user_id'], 0, $message_id, $args);
            }

			//connect绑定操作
            $User_BindConnectModel = new User_BindConnectModel();
            $User_BindConnectModel->bind(Zero_Perm::getUserId(), s('t'));
			/*
			//分配用户所属门店

            if ($chain_id = User_BaseModel::getSourceChainId())
            {
                User_BaseModel::addSourceChainId($data['user_id'], $chain_id);
            }
            else
            {
                //计算附近的门店
                $ip = get_ip();
                $coord = Zero_Utils_Ip::getLatAndLngByIp($ip);

                if ($coord)
                {
                    $chain_list = Chain_BaseModel::getInstance()->getNearChain($coord['lat'], $coord['lng'], null, 999999999);

                    if ($chain_list['items'])
                    {
                        $chain_id = $chain_list['items'][0]['chain_id'];

                        if ($chain_id)
                        {
                            User_BaseModel::addSourceChainId($data['user_id'], $chain_id);
                        }
                    }
                }
            }
            */

			//分销用户来源 - 平台推广员功能，佣金平台出
			if (Base_ConfigModel::ifPlantformFx())
			{
				User_BaseModel::addSourceUserId($data['user_id']);
			}

            //店铺销售员
			if (Base_ConfigModel::ifStoreFx())
			{
				User_BaseModel::addStoreSourceUserId($data['user_id']);
			}

            $msg = __('注册成功');
            $callback_url = LoginModel::checkCallback(true);
            $data['callback_url'] = $callback_url;
        }
		else
		{
			$LoginModel->sql->rollBack();
			$msg = __('创建用户信息失败');
			$msg = $LoginModel->msg->getMsg();
		}

		if ($data)
		{
			$status = 200;
		}
		else
		{
			$status = 250;
		}

		$this->render('user', $data, $msg, $status);
	}

	public function doLogin()
	{
		$user_account = s('user_account', null);
		$user_password  = s('user_password', null);

		$user_account = strtolower($user_account);

		$LoginModel  = new LoginModel();
		$data   = $LoginModel->login($user_account, $user_password);
		if ($data)
		{
			$status = 200;
			$msg = $LoginModel->msg->getMsg();
			if($data['store_ids']){
                $data['callback_url'] = '/admin.php';
			}else{
                $data['callback_url'] = '/index.php?ctl=Join&met=index';
			}
			
            if($user_account=='admin'){
                $data['callback_url'] = '/admin.php';
            }
			//$callback_url = LoginModel::checkCallback(true);

			//connect绑定操作
			$User_BindConnectModel = new User_BindConnectModel();
			$User_BindConnectModel->bind(Zero_Perm::getUserId(), s('t'));
		}
		else
		{
			$status = 250;
			$msg = $LoginModel->msg->getMsg();
		}

		$this->render('user', $data, $msg, $status);
	}


	/*
	 * 用户退出
	 *
	 *
	 */
	public function logout()
	{
		Zero_Perm::removeUserInfo();

        $url = s('callback', Zero_Registry::get('url'));

        $this->redirect($url);
	}

	/*
	 * 检测用户登录, 通过u 和 k   子站登录后验证, 废弃,不这么使用.
	 */
	public function getUser()
	{
		if (Zero_Perm::checkUserPerm())
		{
			$msg = '数据正确';
			$status = 200;
			$data = Zero_Perm::getUserRow();
		}
		else
		{
			$msg = '权限错误';
			$status = 250;
			$data = array();
		}

		$this->dataModel->addBody(100, $data, $msg, $status);
	}

    public function checkMobileOrEmail()
    {

        $channel_verify_key = s('channel_verify_key', null);
        $channel_verify_code = s('channel_verify_code', null);
        $channel = strtolower(s('channel', null));
        $data = array();

        $verification_code_flag = Zero_VerifyCode::checkCode($channel_verify_key, $channel_verify_code);


        //手机验证码检测
        if (!$channel_verify_key || !$channel_verify_code || $verification_code_flag == false) {
            if ($channel == 'mobile') {
                $msg = __('短信验证码错误');
            } else {
                $msg = __('邮箱验证码错误');
            }
            $status = 250;
        } else {
            $msg = __('操作成功');
            $status = 200;
        }


        $this->render('user', $data, $msg, $status);
    }


	/*
	 * 子站登录后验证 user_token
	 */
    public function checkLogin()
    {
        $this->getUserByToken();
    }

	public function getUserByToken()
	{
		//user_token,  根据用户传入的user_token, 判断是否正确.
		$user_token = s('user_token');


		$LoginModel  = new LoginModel();

		$data = array();

		if ($data = $LoginModel->checkUserToken($user_token))
		{
			unset($data['user_password']);
			unset($data['user_key']);
			unset($data['user_token']);
			unset($data['user_salt']);

			$msg = '数据正确';
			$status = 200;
		}
		else
		{
			$msg = __('token错误');
			$status = 250;
		}


        $this->render('user', $data, $msg, $status);
	}

    /**
     * 用户协议
     */
    public function protocol()
    {
        $this->render('login', array());
    }



    /**
     * 用户消息
     *
     * @access public
     */
    public function doRegisterWechatAccount()
    {
        $user_id = Zero_Perm::getUserId();

        $User_InfoModel = User_InfoModel::getInstance();

        $User_InfoModel->sql->startTransaction();

        $data['bind_id'] = s('mobile');
        $data['bind_access_token'] = s('auth_code');

        $flag = User_BindConnectModel::getInstance()->checkAccessToken(User_BindConnectModel::MOBILE, $data);

        $data_rs['bind_type'] = User_BindConnectModel::MOBILE;

        $data_rs['bind_id'] = strHandel(User_BindConnectModel::MOBILE, $data['bind_id']);

        if ($flag !== false)
        {
			/*
            //修改用户密码及区域问题。
            //修改用户所在地
            $user_province_id = i('user_province_id');
            $user_city_id = i('user_city_id');
            $user_county_id = i('user_county_id');

            $user_info_row = array();
            $user_info_row['user_province_id'] = $user_province_id;
            $user_info_row['user_city_id'] = $user_city_id;
            $user_info_row['user_county_id'] = $user_county_id;

            $flag1 = User_InfoModel::getInstance()->edit($user_id, $user_info_row);
			*/
			$flag1 = true;

            if ($flag1 !== false)
            {
                //更改密码
                $user_account = Zero_Perm::$row['user_account'];
                $user_password = s('user_password');

                $LoginModel  = new LoginModel();
                $flag1 = $LoginModel->doResetPasswd($user_account, $user_password);
            }
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;

            $flag1 = false;
        }

        if ($flag!==false && $flag1!==false && $User_InfoModel->sql->commit())
        {
            $msg = __('绑定成功');
            $status = 200;



            $cookie = Zero_Cookie::getInstance();
            $cookie->setCookie('as', 1);
            $data['as'] = 1;

        }
        else
        {
            $User_InfoModel->sql->rollBack();

            $msg = __('绑定失败');
            $status = 250;
        }


        $this->render('user', $data_rs, $msg, $status);
    }
}

function strHandel($type = 1, $str='')
{

    $str_complete = '';

    if($type == User_BindConnectModel::MOBILE )
    {
        $str_complete = substr($str,0,3).'******'.substr($str,9,2);

    }

    if($type == User_BindConnectModel::EMAIL )
    {
        $str_complete = substr($str,0,2).'******'.substr($str,-6,6);
    }


    return $str_complete;
}
?>

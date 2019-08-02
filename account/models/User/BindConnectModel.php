<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 用户绑定模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2016-10-14, Xinze
 * @version    1.0
 * @todo
 */
class User_BindConnectModel extends Zero_Model
{
	const MOBILE     = 1;
	const EMAIL      = 2;

	const SINA_WEIBO = 11;
	const QQ         = 12;
	const WEIXIN     = 13;

	public static $bindTypeMap = array(
		'11'     => '微博',
		'12' => 'QQ',
		'13'    => '微信',
	);
	
	public static $prefix = 'm|zero|bind|';

	public $_cacheName       = 'user';
	public $_tableName       = 'user_bind_connect';
	public $_tablePrimaryKey = 'bind_id';
	public $_useCache        = false;
	public $_languageCond    = false;
	
	public $fieldType = array();

	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'user_bind_connect_cond'=>array(
			'bind_type'=>null,
			'user_id'=>null,
			'bind_access_token'=>null,
			'bind_active' => null,
			'bind_id'=>null
		)
	);

	public $_validateRules = array('integer'=>array('bind_type', 'user_id', 'bind_gender', 'bind_vip', 'bind_level', 'bind_expires_in'), 'date'=>array('bind_time'));

	public $_validateLabels= array();


	/**
	 * @param string $user  User Object
	 * @var   string $db_id 指定需要连接的数据库Id
	 * @return void
	 */
	public function __construct(&$db_id='account', &$user=null)
	{
		$this->_useCache  = CHE;

		$this->_tabelPrefix  = TABLE_ACCOUNT_PREFIX;
		parent::__construct($db_id, $user);
	}

	/**
	 * 读取分页列表
	 *
	 * @param  array $column_row where查询条件
	 * @param  array $sort  排序条件order by
	 * @param  int $page 当前页码
	 * @param  int $rows 每页显示记录数
	 * @return array $data 返回的查询内容
	 * @access public
	 */
	public function getLists($column_row=array(), $sort=array(), $page=1, $rows=500)
	{
		//修改值 $column_row
		$data = $this->lists($column_row, $sort, $page, $rows);

		return $data;
	}


	public function checkBind($bind_id, $bind_type, $user_id, $user_info_row, $return_flag=false)
	{
		$flag = false;

		$bind_row = $this->getOne($bind_id);

		//已经绑定,并且用户正确
		if (isset($bind_row['user_id']) && $bind_row['user_id'])
		{
			//验证通过, 登录成功.
			if ($user_id && $user_id==$bind_row['user_id'])
			{
				echo '非法请求,已经登录用户不应该访问到此页面-重复绑定';
                $flag = false;
			}
			elseif ($user_id && $user_id!=$bind_row['user_id'])
			{
				echo '非法请求,错误绑定数据';
                $flag = false;
			}

			$LoginModel = new LoginModel();
			$data = $LoginModel->doLogin($bind_row['user_id']);

			if ($data)
			{
				//已经登录，并且绑定完成，页面跳转即可。
				$url = LoginModel::checkCallback($return_flag);
                $flag = $url;
			}
			else
			{
				echo '绑定的账户登录失败';
                $flag = false;
			}
		}
		else
		{
			if ($bind_row)
			{
				/*
				if ($bind_row['user_id'])
				{
					//该账号已经绑定
					echo '非法请求,该账号已经绑定';
                    $flag = false;
				}
				*/

				$data_row = array();
				$data_row['user_id'] = $user_id;
				$data_row['bind_access_token'] = $user_info_row['bind_access_token'] ;
				$data_row['bind_expires_in']       = $user_info_row['bind_expires_in'];
				$data_row['bind_refresh_token']   = $user_info_row['bind_refresh_token'];

				$connect_flag = $this->edit($bind_id, $data_row);
			}
			else
			{
				//头像会变动, 需要本地缓存, 生成新网址.
				$bind_icon = $user_info_row['bind_icon'];

				$img_path = sprintf('data/upload/avater/%s.png', $bind_id);
				$img_file = APP_PATH . DIRECTORY_SEPARATOR . $img_path;

				if (Zero_Utils_Net::download($bind_icon, $img_file))
				{
					$bind_icon = sprintf('%s/%s', Zero_Registry::get('app_url'), $img_path);
				}

				$data = array();

				$data['bind_id']                = $bind_id            ;
				$data['bind_type']              = $bind_type;
				$data['user_id']                = $user_id;
				$data['bind_nickname']          = $user_info_row['bind_nickname']      ; // 名称
				$data['bind_icon']              = $bind_icon          ; //
				$data['bind_gender']            = $user_info_row['bind_gender']        ; // 性别 1:男  2:女
				$data['bind_country']           = $user_info_row['bind_country']       ; //
				$data['bind_province']          = $user_info_row['bind_province']      ; // 省
				$data['bind_city']              = $user_info_row['bind_city']          ; // 城市
				$data['bind_openid']            = $user_info_row['bind_openid']        ; // 访问
				$data['bind_unionid']           = $user_info_row['bind_unionid']     ; // for wechat
				$data['bind_access_token']     =  $user_info_row['bind_access_token']      ;
				$data['bind_expires_in']       = $user_info_row['bind_expires_in'];
				$data['bind_refresh_token']   = $user_info_row['bind_refresh_token'];
				$connect_flag = $this->add($data);
			}

			//取得open id, 需要封装
			if ($connect_flag)
			{
				//选择,登录绑定还是新创建账号 $user_id == 0
				if (!Zero_Perm::checkUserPerm())
				{
					$nickname = isset($bind_row['bind_nickname']) ? $bind_row['bind_nickname'] : $user_info_row['bind_nickname'];
					$bind_icon = isset($bind_row['bind_icon']) ? $bind_row['bind_icon'] : $bind_icon;

                    //如果不强调绑定的话，此处可以自动创建新账号，自动登录。
                    if (false)
                    {
                        
                    }
                    else
                    {
                        $_REQUEST['bind_type'] = $bind_type;
                        $url = sprintf('%s?ctl=Login&met=select&t=%s&icon=%s&nickname=%s%s', Zero_Registry::get('url'), urlencode($user_info_row['bind_access_token']),   urlencode($bind_icon), urlencode($nickname),  LoginModel::callbackStr(false));
                        $flag = $url;
                    }
				}
				else
				{
					//已经登录，并且绑定完成，页面跳转即可。
					$url = LoginModel::checkCallback($return_flag);
                    $flag = $url;
				}
			}
			else
			{
				echo '绑定数据操作失败';
                $flag = false;
			}
		}

		return $flag;
	}


	public function bind($user_id, $token)
	{
		$flag = false;

		//connect绑定操作
		$column_row = array(
			//'bind_type'=>self::WEIXIN,
			'bind_access_token'=> $token
		);

		$user_bind_rows = $this->find($column_row);
		if ($user_bind_rows)
		{
			$user_bind_row = array_pop($user_bind_rows);

			if (!$user_bind_row['user_id'])
			{
				$bind_row = array();
				$bind_row['user_id'] =$user_id;
				$flag = $this->edit($user_bind_row['bind_id'], $bind_row);
			}
		}

		return $flag;
	}
    
    
    //获取有效绑定
    public function getBind($user_id, $bind_type)
    {
        $bind_row = User_BindConnectModel::getInstance()->findOne(array('user_id'=>$user_id, 'bind_active'=>1, 'bind_type'=> $bind_type));

        return $bind_row;
    }


    public function checkVerify($bind_id, $data, $verify_code, $rand_key)
	{
		$verification_code_flag = Zero_VerifyCode::checkCode($rand_key, $verify_code);

        if (!$verification_code_flag)
        {
			//验证码错误
			throw new Zero_Exception_Db(__('wng_capt'));

        }
        
        $bind_type_name = $data['bind_type'] == User_BindConnectModel::MOBILE ? 'mobile' : 'email';

		$rs_row = array();

		$bind_row = $this->getOne($bind_id);

		if ($bind_row && $bind_row['bind_active'])
		{
			throw new Exception(sprintf(' %s 已经绑定!', $bind_type_name));
		}

		return is_ok($rs_row) ? $bind_id : false;
	}


	public function checkAccessToken($bind_type, $data, $user_id=null)
	{
		$rs_row = array();

		$user_id = Zero_Perm::getUserId();

		$bind_id = $data['bind_id'];

		$verification_code_flag = Zero_VerifyCode::checkCode($bind_id,  $data['bind_access_token']);

		if($verification_code_flag !==  false)
		{
			$data['bind_active'] = 1;
		    $data['user_id'] = $user_id;
			$data['bind_type'] = $bind_type;

			//判断是否已经绑定
			if ($bind_row = User_BindConnectModel::getInstance()->findOne(array('bind_id'=>$bind_id, 'bind_type'=>$bind_type, 'bind_active'=>1)))
			{
                throw new Zero_Exception_Db(__('已经绑定，不可以重复绑定!'));
			}
            
            $flag = $this->edit($bind_id, $data);

			if (false === check_rs($flag, $rs_row))
			{
				throw new Zero_Exception_Db(__('验证失败!'));
			}

            switch ($bind_type) {
                case User_BindConnectModel::MOBILE:
                    $user_row['user_mobile'] = $bind_id;
                    $data['bind_openid']     = $bind_id;
                    break;
                case User_BindConnectModel::EMAIL:
                    $user_row['user_email'] = $bind_id;
                    $data['bind_openid']    = $bind_id;
                    break;
            }

			$flag = User_InfoModel::getInstance()->edit($user_id, $user_row);

			if (false === check_rs($flag, $rs_row))
			{
				throw new Zero_Exception_Db(__('保存用户数据失败!'));
			}


			$flag = $this->add($data, true, true);

			if (false === check_rs($flag, $rs_row))
			{
				throw new Zero_Exception_Db(__('保存用户绑定失败!'));
			}


		}
		else
		{
			throw new Zero_Exception_Db(__('wng_capt'));
		}

		return is_ok($rs_row) ? $bind_id : false;

	}

}
?>

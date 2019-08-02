<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */

class Connect_MobileCtl extends Zero_AppController implements Connect_Interface
{

	public $options = null;
	public $api     = null;
	public $redirectUrl = null;

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

		$this->options = array(
			'cache_name' => 'mobile'
		);

		$this->api      = new Zero_Api_Mobile($this->options);
	}

	public function select()
	{
	}

	public function login()
	{
		//判断当前登录账户,绑定
		if (Zero_Perm::checkUserPerm())
		{
			$user_id = Zero_Perm::getUserId();

			//判断用户是否绑定 $user_id 不能被其它绑定
			$User_BindConnectModel = new User_BindConnectModel();

			$column_row = array(
				'bind_type'=>User_BindConnectModel::MOBILE,
				'user_id'=>$user_id
			);

			$rs = $User_BindConnectModel->find($column_row);

			if ($rs)
			{
				throw new Exception(__('用户已经绑定'));
			}
		}

		//子站跳转
		$redirect_url = sprintf('%s?ctl=Connect_Mobile&met=callback%s', Zero_Registry::get('url'), LoginModel::callbackStr(true));
		$this->redirectUrl = $redirect_url;

		//
		if (Zero_Utils_Device::isMobile())
		{
			$url = $this->api->getOauthRedirect($redirect_url, $state = '1', $scope = 'snsapi_login');
		}
		else
		{
			$url = $this->api->getOauthPcRedirect($redirect_url, $state = '1', $scope = 'snsapi_login');
		}

		location_to($url);
	}

	/**
	 * callback 回调函数
	 *
	 * @access public
	 */
	public function callback()
	{
		$code = s('code', null);

		$login_flag = false;

		//判断当前登录账户
		if (Zero_Perm::checkUserPerm())
		{
			$user_id = Zero_Perm::getUserId();
		}
		else
		{
			$user_id = 0;
		}

		if($code)
		{
			$access_token_row = $this->api->getOauthAccessToken($code);

			$access_token_row['access_token'];
			$access_token_row['expires_in'];
			$access_token_row['refresh_token'];
			$access_token_row['openid'];
			$access_token_row['scope'];
			$access_token_row['unionid'];

			if ($access_token_row)
			{
				$user_info_row = $this->api->getOauthUserinfo($access_token_row['access_token'], $access_token_row['openid']);

				$bind_id = sprintf('%s_%s', 'weixin', $user_info_row['openid']);

				$data = array();

				$data['bind_id']                = $bind_id            ;
				$data['bind_type']              = User_BindConnectModel::MOBILE;
				$data['user_id']                = $user_id;
				$data['bind_nickname']          = $user_info_row['nickname']      ; // 名称
				$data['bind_icon']              =  $user_info_row['headimgurl']   ; //
				$data['bind_gender']            = $user_info_row['sex']           ; // 性别 1:男  2:女
				$data['bind_country']           = $user_info_row['country']       ; //
				$data['bind_province']          = $user_info_row['province']      ; // 省
				$data['bind_city']              = $user_info_row['city']          ; // 城市
				$data['bind_openid']            = $user_info_row['openid']        ; // 访问
				$data['bind_unionid']           = isset($user_info_row['unionid']) ? $user_info_row['unionid'] : 0;     ; // for wechat
				$data['bind_access_token']      = $access_token_row['access_token'];
				$data['bind_expires_in']        = $access_token_row['expires_in'];
				$data['bind_refresh_token']     = $access_token_row['refresh_token'];

                $User_BindConnectModel = new User_BindConnectModel();
                $flag = $User_BindConnectModel->checkBind($bind_id,  User_BindConnectModel::MOBILE, $user_id, $data);
			}
			else
			{
				//失败
				echo '获取token失败';
				die();
			}

		}
		else
		{
			//失败
			echo '返回数据错误';
			die();
		}
	}
}

?>



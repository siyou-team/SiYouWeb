<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */

class Connect_WeiboCtl extends Zero_AppController implements Connect_Interface
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
			'appid' => Base_ConfigModel::getConfig('weibo_app_id'), //填写高级调用功能的app id
			'appsecret' => Base_ConfigModel::getConfig('weibo_app_key'), //填写高级调用功能的密钥
			'cache_name' => 'weibo',//填写缓存目录，默认为当前运行目录的子目录cache下
			'debug' => true,
		);

		$this->api      = new Zero_Api_Weibo($this->options);
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
				'bind_type'=>User_BindConnectModel::SINA_WEIBO,
				'user_id'=>$user_id,
				'bind_active'=>1
			);

			$rs = $User_BindConnectModel->find($column_row);

			if ($rs)
			{
				throw new Exception(__('用户已经绑定'));
			}
		}

		//子站跳转
		$redirect_url = sprintf('%s/account.php?ctl=Connect_Weibo&met=callback%s', Zero_Registry::get('base_url'), LoginModel::callbackStr(true));
		$redirect_url = sprintf('%s/account.php?ctl=Connect_Weibo&met=callback', 'https://dev.43390.com');
		$redirect_url = 'https://dev.43390.com/account.php?ctl=Connect_Weibo&met=callback';
		$this->redirectUrl = $redirect_url;

		$url = $this->api->getAuthorizeURL( $redirect_url);

		location_to($url);
	}

	/**
	 * callback 回调函数
	 *
	 * @access public
	 */
	public function callback()
	{
        $redirect_url = sprintf('%s/account.php?ctl=Connect_Weibo&met=callback', 'https://dev.43390.com');
		$redirect_url = 'https://dev.43390.com/account.php?ctl=Connect_Weibo&met=callback';
        $this->redirectUrl = $redirect_url;
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
			$keys = array();
			$keys['code'] = $code;
			$keys['redirect_uri'] = $this->redirectUrl;

			try {
				$access_token_row = $this->api->getAccessToken( 'code', $keys ) ;
			}
			catch (OAuthException $e)
			{
				echo '获取token失败';
				print_r($e);
				die();
			}

//
//			$access_token_row['access_token'];
//			$access_token_row['expires_in'];
//			$access_token_row['refresh_token'];
//			$access_token_row['openid'];
//			$access_token_row['scope'];
//			$access_token_row['unionid'];

			if ($access_token_row)
			{
				$c = new SaeTClientV2($this->appid, $this->appsecret, $access_token_row['access_token']);
				$ms  = $c->home_timeline(); // done
				$uid_get = $c->get_uid();
				$uid = $uid_get['uid'];
				$user_info_row = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息

				//$user_info_row = $this->api->getOauthUserinfo($access_token_row['access_token'], $access_token_row['openid']);
				$user_info_row['openid'] = $uid;
				
				$bind_id = sprintf('%s_%s', 'weibo', $user_info_row['openid']);

				$data = array();

				$data['bind_id']                = $bind_id            ;
				$data['bind_type']              = User_BindConnectModel::SINA_WEIBO;
				$data['user_id']                = $user_id;
				$data['bind_nickname']          = $user_info_row['name']      ; // 名称
				$data['bind_icon']              =  $user_info_row['avatar_hd']    ; //
				$data['bind_gender']            = $user_info_row['gender']=='m' ? 1 : 2        ; // 性别 1:男  2:女
				$data['bind_country']           = $user_info_row['country']       ; //
				$data['bind_province']          = $user_info_row['province']      ; // 省
				$data['bind_city']              = $user_info_row['city']          ; // 城市
				$data['bind_openid']            = $user_info_row['openid']        ; // 访问
				$data['bind_unionid']           = isset($user_info_row['unionid']) ? $user_info_row['unionid'] : 0;     ; // for wechat
				$data['bind_access_token']     = $access_token_row['access_token']     ;
				$data['bind_expires_in']       = $access_token_row['expires_in'];
				$data['bind_refresh_token']   = $access_token_row['refresh_token'];
				$data['bind_active'] =1;

				$User_BindConnectModel = new User_BindConnectModel();
				$flag = $User_BindConnectModel->checkBind($bind_id,  User_BindConnectModel::SINA_WEIBO, $user_id, $data);
                
                if ($flag)
                {
                    $msg    = $flag;
                    $this->redirect($flag);
                }
                else
                {
                    $msg    = __('检测绑定失败');
                    $status = 250;
                }
			}
			else
			{
				//失败
                $msg    = __('获取token失败');
                $status = 250;
			}

		}
		else
		{
			//失败
            $msg    = __('返回数据错误');
            $status = 250;
		}
        
        $this->render('login', $data);
	}
}

?>



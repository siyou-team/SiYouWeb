<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'weibo' . DIRECTORY_SEPARATOR . 'saetv2.ex.class.php';

class Api_Weibo extends SaeTOAuthV2
{
	public function __construct($options)
	{
		$this->token          = isset($options['token']) ? $options['token'] : '';
		$this->encodingAesKey = isset($options['encodingaeskey']) ? $options['encodingaeskey'] : '';

		$this->appid     = isset($options['appid']) ? $options['appid'] : '';
		$this->appsecret = isset($options['appsecret']) ? $options['appsecret'] : '';

		$this->debug       = isset($options['debug']) ? $options['debug'] : false;
		$this->logcallback = isset($options['logcallback']) ? $options['logcallback'] : false;
		$this->cacheName   = isset($options['cache_name']) ? $options['cache_name'] : 'weibo';

		//$this->access_token = $access_token;
		//$this->refresh_token = $refresh_token;
		parent::__construct($this->appid, $this->appsecret);
	}


	public function getOauthUserinfo($access_token, $refresh_token = null)
	{
		$c             = new SaeTClientV2($this->appid, $this->appsecret, $access_token);
		$ms            = $c->home_timeline(); // done
		$uid_get       = $c->get_uid();
		$uid           = $uid_get['uid'];
		$user_info_row = $c->show_user_by_id($uid);//根据ID获取用户等基本信息

		$user_info_row['openid'] = $uid;

		/*
		$user_info_row['nickname']      ; // 名称
		$user_info_row['headimgurl']    ; //
		$user_info_row['sex']           ; // 性别 1:男  2:女
		$user_info_row['country']       ; //
		$user_info_row['province']      ; // 省
		$user_info_row['city']          ; // 城市
		$user_info_row['openid']        ; // 访问
		*/

		return $user_info_row;
	}
}

?>
<?php

class OAuth2Ctl extends Zero_AppController
{
	public $server = null;

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


		$dsn      = 'mysql:dbname=dev_pcenter;host=192.168.0.88';
		$username = 'rd02';
		$password = 'rd02111111';

		// $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
		$storage = new OAuth2\Storage\Pdo(array(
											  'dsn' => $dsn,
											  'username' => $username,
											  'password' => $password
										  ));


		// Pass a storage object or array of storage objects to the OAuth2 server class
		//$this->server = new OAuth2\Server($storage);
		$this->server = new OAuth2\Server($storage, array(
			'allow_implicit' => true,
			'refresh_token_lifetime' => 2419200,
		));

		// Add the "Client Credentials" grant type (it is the simplest of the grant types)
		$this->server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

		// Add the "Authorization Code" grant type (this is where the oauth magic happens)
		$this->server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));

		//Resource Owner Password Credentials (资源所有者密码凭证许可）
		$this->server->addGrantType(new OAuth2\GrantType\UserCredentials($storage));

		//can RefreshToken set always_issue_new_refresh_token=true
		$this->server->addGrantType(new OAuth2\GrantType\RefreshToken($storage, array(
			'always_issue_new_refresh_token' => true
		)));

		// configure your available scopes
		$defaultScope    = 'basic';
		$supportedScopes = array(
			'basic',
			'postonwall',
			'accessphonenumber'
		);

		$memory    = new OAuth2\Storage\Memory(array(
												   'default_scope' => $defaultScope,
												   'supported_scopes' => $supportedScopes
											   ));
		$scopeUtil = new OAuth2\Scope($memory);
		$this->server->setScopeUtil($scopeUtil);
	}

	public function init()
	{
	}


	//curl -u testclient:testpass http://127.0.0.1/ucenter/index.php?ctl=OAuth2&met=token -d 'grant_type=client_credentials'

	//curl -u testclient:testpass http://127.0.0.1/ucenter/index.php -d 'ctl=OAuth2&met=token&grant_type=authorization_code&code=YOUR_CODE'
	//curl -u testclient:testpass http://127.0.0.1/ucenter/index.php -d 'ctl=OAuth2&met=token&grant_type=client_credentials'

	//资源所有者密码凭证许可: user 表设计使用 sha1 摘要方式，没有添加 salt.
	//curl -u testclient:testpass http://127.0.0.1/ucenter/index.php -d 'ctl=OAuth2&met=token&grant_type=password&username=rereadyou&password=rereadyou'

	//scope 用来确定 client 所能进行的操作权限。项目中操作权限由 srbac 进行控制， Oauth2 中暂不做处理
	//curl -u testclient:testpass http://127.0.0.1/ucenter/index.php -d 'ctl=OAuth2&met=token&grant_type=client_credentials&scope=postonwall'
	public function token()
	{
		// Handle a request for an OAuth2.0 Access Token and send the response to the client
		$this->server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();
	}


	//curl http://127.0.0.1/ucenter/index.php -d 'ctl=OAuth2&met=resource&access_token=YOUR_TOKEN'
	public function resource()
	{
		/*
		$request = OAuth2\Request::createFromGlobals();
		$response = new OAuth2\Response();
		$scopeRequired = 'postonwall'; // this resource requires "postonwall" scope
		if (!$this->server->verifyResourceRequest($request, $response, $scopeRequired)) {
			// if the scope required is different from what the token allows, this will send a "401 insufficient_scope" error
			$this->server->getResponse()->send();
			die;
		}
		*/

		// Handle a request for an OAuth2.0 Access Token and send the response to the client
		if (!$this->server->verifyResourceRequest(OAuth2\Request::createFromGlobals()))
		{
			$this->server->getResponse()->send();
			die;
		}

		//当你认证了一个用户并且分派了一个Token之后，你可能想知道彼时到底是哪个用户使用了这个Token
		//你可以使用handleAuthorizeRequest的可选参数user_id来完成，修改你的authorize.php文件
		$token = $this->server->getAccessTokenData(OAuth2\Request::createFromGlobals());
		echo "User ID associated with this token is {$token['user_id']}";

		echo json_encode(array(
							 'success' => true,
							 'message' => 'You accessed my APIs!'
						 ));
	}

	//http://127.0.0.1/ucenter/index.php?ctl=OAuth2&met=authorize&response_type=code&client_id=testclient&state=xyz
	public function authorize()
	{
		$request  = OAuth2\Request::createFromGlobals();
		$response = new OAuth2\Response();

		// validate the authorize request
		if (!$this->server->validateAuthorizeRequest($request, $response))
		{
			$response->send();
			die;
		}

		// display an authorization form
		if (empty($_POST))
		{
			exit('
				<form method="post">
				  <label>Do You Authorize TestClient?</label><br />
				  <input type="submit" name="authorized" value="yes">
				</form>');
		}

		// print the authorization code if the user has authorized your client
		$is_authorized = ($_POST['authorized'] === 'yes');

		//$this->server->handleAuthorizeRequest($request, $response, $is_authorized);

		//当你认证了一个用户并且分派了一个Token之后，你可能想知道彼时到底是哪个用户使用了这个Token  你可以使用handleAuthorizeRequest的可选参数user_id来完成，修改你的authorize.php文件
		$userid = 1; // A value on your server that identifies the user
		$this->server->handleAuthorizeRequest($request, $response, $is_authorized, $userid);

		if ($is_authorized)
		{
			// this is only here so that you get to see your code in the cURL request. Otherwise, we'd redirect back to the client
			$code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=') + 5, 40);
			//exit("SUCCESS AND DO redirect_uri! Authorization Code: $code");
		}

		$response->send();
	}
}

?>
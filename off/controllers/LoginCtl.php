<?php
class LoginCtl extends Zero_Api_AdminController
{
	public function login()
	{
		if (!Zero_Perm::checkUserPerm())
		{
   
			$this->render('login');
		}
		else
		{
			header('location:' . $this->registry('url'));
		}
	}

	/*
	 * 检测登录数据是否正确
	 *
	 *
	 */
	public function check()
	{
        $redirect = request_string('redirect');
        if($redirect)
        {
            location_to(urldecode($redirect));
        }
        else
        {
            location_to($this->registry('url'));
        }
	}


	/*
	 * 用户退出
	 *
	 *
	 */
	public function logout()
	{
		if ($_REQUEST['met'] == 'logout')
		{
            Zero_Perm::removeUserInfo();
            
            $url = s('callback', Zero_Registry::get('url'));
            location_to($url);
            
            
			$login_url = Base_ConfigModel::getLogoutUrl();
			$callback  = $this->registry('url') . '?redirect=' . urlencode($this->registry('url')) . '&type=shop';

			$login_url = $login_url . '&from=shop&callback=' . urlencode($callback);

			header('location:' . $login_url);
			exit();
		}
	}


	public function doLoginOut()
	{
		if (isset($_COOKIE['key']) || isset($_COOKIE['id']))
		{
			echo "<script>parent.location.href='index.php';</script>";
			setcookie("key", null, time() - 3600 * 24 * 365);
			setcookie("id", null, time() - 3600 * 24 * 365);
		}

		$redirect = request_string('redirect');
		if($redirect)
		{
			header('location:' . urldecode($redirect));
			exit();
		}
	}
    
}

?>
<?php if (!defined('ROOT_PATH')){exit('No Permission');}
/**
 * 验证码类, 所有的请求,必须带rand_key, 此key, 在请求的时候,传回后端.  这个key可以用account  mobile等替换,但是为了统一且这样可以方便远程调用,故使用随机key
 *
 *
 * @category   Framework
 * @package    Zero
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */

class VerifyCodeCtl extends Zero_AppController
{
	public function index()
	{
		$this->image();
	}

	public function image()
	{
		//
		$key  = s('rand_key');
		$code = Zero_VerifyCode::getCode($key);

		die();
	}

	public function mobile()
	{
	    //todo 传入图形验证码
        $image_key   = s('image_key');
        $image_value = s('image_value');



		//需要判断是否为手机号
		$key  = s('mobile',s('rand_key'));

		$verify_code = VerifyCode::getVerifyCode($key, null);
		$data = array();
		$data['verify_code'] = $verify_code;

		if ($verify_code)
		{
			$msg    = 'success';
			$status = 200;
		}
		else
		{
			$msg    = '失败';
			$status = 250;
		}
		$this->render('user', $data, $msg, $status);

	}

    //获取会员手机号验证码，验证手机号是否为平台会员
    public function userMobile()
    {
        //todo 传入图形验证码
        $image_key   = s('image_key');
        $image_value = s('image_value');

        if (!$image_key)
        {
            throw  new Zero_Exception_Protocol('程序非法请求, 检测验证码键值');
            return false;
        }

        if (!$image_value)
        {
            throw  new Zero_Exception_Protocol('请输入验证码', ErrorCode::E_VERIFYCODE);
            return false;
        }


        $verification_code_flag = Zero_VerifyCode::checkCode($image_key, $image_value);

        if (!$verification_code_flag)
        {
            throw new Zero_Exception_Db(__('验证码错误!'));
        }


        //需要判断是否为手机号
        $key  = s('mobile',s('auth_key'));

        //判断是否已经绑定
        if (!$bind_row = User_BindConnectModel::getInstance()->findOne(array('bind_id'=>$key, 'bind_type'=>User_BindConnectModel::MOBILE, 'bind_active'=>1)))
        {
            throw new Zero_Exception_Db(__('该手机号尚未注册!'));
        }

        $verify_code = VerifyCode::getVerifyCode($key, null);

        $data = array();
        $data['verify_code'] = $verify_code;

        if ($verify_code)
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $msg    = '失败';
            $status = 250;
        }
        $this->render('user', $data, $msg, $status);

    }

	public function email()
	{
		//需要判断是否为邮件
		$email  = s('email', s('rand_key'));

		if ($email)
        {
            $verify_code = Zero_VerifyCode::getCode($email, null, Zero_VerifyCode::EMAIL);

            /*$title = 'SuteShop找回密码';
            $contents = "SuteShop找回密码，<a href='". url('Login', 'findpwdStepThree', '', array('channel_verify_key'=>$email, 'channel_verify_code'=>$verify_code))."'>点击进入</a>";
            $contents .= ",或者输入验证码{$verify_code}";

            $result = Zero_Utils_Mail::send($email, $title, $contents);*/

            $data = array();
            $data['verify_code'] = $verify_code;

            if ($verify_code)
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
        else
        {
            $msg    = '失败';
            $status = 250;
        }

        $this->render('user', $data, $msg, $status);
	}
}

?>

<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class User_SecurityCtl extends AccountController
{
    /* @var $userBaseModel User_BaseModel */
    public $userBaseModel = null;
    
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
        
        $this->userBaseModel = User_BaseModel::getInstance();
    }
    
    /**
     * 用户基本信息首页
     *
     * @access public
     */
    public function index()
    {
        $user_id = Zero_Perm::getUserId();

        $user_bind_connect_row =  User_BindConnectModel::getInstance()->find(array('user_id'=>$user_id, 'bind_active'=>1));
        $user_row = User_InfoModel::getInstance()->getOne($user_id);
        
        foreach($user_bind_connect_row as  $connect)
        {
            //$data[$connect['bind_type']] = strHandel($connect['bind_type'], $connect['bind_id']);
            $data[$connect['bind_type']] = $connect['bind_id'];
        }

        //$data['user_certification'] = $user_row['user_certification'] == StateCode::USER_CERTIFICATION_VERIFY ? true : false;
        $data['user_certification'] = $user_row['user_certification'];
        $data['bind_type_row'] = array_values(array_column_unique($user_bind_connect_row, 'bind_type'));


        $this->render('user', $data);
    }
    
    
    
    //短信绑定验证
    public function bindMobile()
    {
        $user_id = Zero_Perm::getUserId();
    
        $data['bind_id'] = s('mobile');
        $data['bind_access_token'] = s('auth_code');
    
        $flag = User_BindConnectModel::getInstance()->checkAccessToken(User_BindConnectModel::MOBILE, $data);
    
        $data_rs['bind_type'] = User_BindConnectModel::MOBILE;
    
        $data_rs['bind_id'] = strHandel(User_BindConnectModel::MOBILE, $data['bind_id']);
    
        if ($flag !== false)
        {
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }
        
        $this->render('user', $data_rs, $msg, $status);
    }
    
    
    
    //邮箱绑定验证
    public function checkBindEmail()
    {

        $user_id = Zero_Perm::getUserId();

        $cache_key = sprintf('%s|security-change|%d', User_BindConnectModel::$prefix, $user_id);

        $cache = Zero_Cache::create('verify_code');

        if ($cache->get($cache_key))
        {

            $data['bind_access_token'] = s('bind_access_token');

            $data['bind_id'] = s('email_bind_id');

            $flag = User_BindConnectModel::getInstance()->checkAccessToken(User_BindConnectModel::EMAIL, $data);

            $data_rs['bind_type'] = User_BindConnectModel::EMAIL;

            $data_rs['bind_id'] = strHandel(User_BindConnectModel::EMAIL, $data['bind_id']);

            if ($flag !== false)
            {
                $msg = __('操作成功');
                $status = 200;
            }
            else
            {
                $msg = __('操作失败');
                $status = 250;
            }

        }
        else
        {

            $data = array();

            $user_connect_rows=  User_BindConnectModel::getInstance()->find(array('user_id'=>$user_id, 'bind_active'=>1 , 'bind_type' => array(User_BindConnectModel::EMAIL,User_BindConnectModel::MOBILE)));

            foreach($user_connect_rows as $connect)
            {
                $data[$connect['bind_type']] = $connect['bind_id'];
            }

            if(count($data) >1)
            {
                $data_rs['bind_id'] = $data[User_BindConnectModel::MOBILE];
                $msg = __('checkMobile');
            }
            else
            {
                if(User_BindConnectModel::EMAIL == $connect['bind_type'])
                {
                    $data_rs['bind_id'] = $data[User_BindConnectModel::EMAIL];
                    $msg = __('checkEmail');

                }
                else
                {
                    $data_rs['bind_id'] = $data[User_BindConnectModel::MOBILE];
                    $msg = __('checkMobile');
                }

            }

            $status = 250;
        }

        $this->render('user', $data_rs, $msg, $status);

    }

    //短信绑定验证
    public function checkBindMobile()
    {

        $user_id = Zero_Perm::getUserId();

        $cache_key = sprintf('%s|security-change|%d', User_BindConnectModel::$prefix, $user_id);

        $cache = Zero_Cache::create('verify_code');

        if ($cache->get($cache_key))

        {

            $data['bind_access_token'] = s('bind_access_token');

            $data['bind_id'] = s('mobile_bind_id');

            $flag = User_BindConnectModel::getInstance()->checkAccessToken(User_BindConnectModel::MOBILE, $data);

            $data_rs['bind_type'] = User_BindConnectModel::MOBILE;

            $data_rs['bind_id'] = strHandel(User_BindConnectModel::MOBILE, $data['bind_id']);

            if ($flag !== false)
            {
                $msg = __('操作成功');
                $status = 200;
            }
            else
            {
                $msg = __('操作失败');
                $status = 250;
            }

        }
        else
        {
            $data = array();

            $user_connect_rows=  User_BindConnectModel::getInstance()->find(array('user_id'=>$user_id, 'bind_active'=>1 , 'bind_type' => array(User_BindConnectModel::EMAIL,User_BindConnectModel::MOBILE)));

            foreach($user_connect_rows as $connect)
            {
                $data[$connect['bind_type']] = $connect['bind_id'];
            }

            if(count($data) >1)
            {
                $data_rs['bind_id'] = $data[User_BindConnectModel::MOBILE];
                $msg = __('checkMobile');
            }
            else
            {
                if(User_BindConnectModel::EMAIL == $connect['bind_type'])
                {
                    $data_rs['bind_id'] = $data[User_BindConnectModel::EMAIL];
                    $msg = __('checkEmail');

                }
                else
                {
                    $data['bind_id'] = $data[User_BindConnectModel::MOBILE];
                    $msg = __('checkMobile');
                }

            }

            $status = 250;
        }

        $this->render('user', $data_rs, $msg, $status);

    }

    //发送短信
    public function message()
    {

        $user_id = Zero_Perm::getUserId();

        $user_connect_row = User_BindConnectModel::getInstance()->findOne(array('user_id'=>$user_id, 'bind_type'=>User_BindConnectModel::MOBILE, 'bind_active'=>1));

        $user_mobile = $user_connect_row['bind_id'];

        $verify_code = Zero_VerifyCode::getCode($user_mobile, null, Zero_VerifyCode::MOBILE);

        if ($verify_code !==  false)
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $msg = '失败';
            $status = 250;
        }


        $data['user_mobile'] = strHandel(User_BindConnectModel::MOBILE, $user_mobile);

        $this->render('user', $data, $msg, $status);
    }
    
    /**
     * 检测手机验证码是否正确
     *
     * @access public
     */
    public function checkMobile()
    {
        $code= s('code');

        $user_id = Zero_Perm::getUserId();

        $user_connect_row = User_BindConnectModel::getInstance()->findOne(array('user_id'=>$user_id, 'bind_type'=>User_BindConnectModel::MOBILE, 'bind_active'=>1));

        $mobile = $user_connect_row['bind_id'];

        $verification_code_flag = Zero_VerifyCode::checkCode($mobile, $code);

        if ($verification_code_flag !== false)
        {
            $cache_key = sprintf('%s|security-change|%d', User_BindConnectModel::$prefix, $user_id);
            $cache = Zero_Cache::create('verify_code');
            $cache->save(1, $cache_key);


            $cache_type_key = sprintf('%s|security-type|%d', User_BindConnectModel::$prefix, $user_id);

            $bind_type = $cache->get($cache_type_key);

            if($bind_type == 'mobile')
            {
                $msg = __('manageMobile');
            }
            else if($bind_type == 'email')
            {
                $msg = __('manageEmail');
            }
            else
            {
                $msg = __('managePasswd');
            }

            $status = 200;


        }
        else
        {
            $msg = __('验证码有误，请重新输入');
            $status = 250;
        }

        $data['user_mobile'] = strHandel(User_BindConnectModel::MOBILE, $mobile);

        $this->render('user', $data, $msg, $status);
    }

    //发送邮件
    public function email()
    {

        $user_id = Zero_Perm::getUserId();

        $user_connect_row = User_BindConnectModel::getInstance()->findOne(array('user_id'=>$user_id, 'bind_type'=>User_BindConnectModel::EMAIL, 'bind_active'=>1));

        $user_email =  $user_connect_row['bind_id'];
//
        $verify_code = Zero_VerifyCode::getCode($user_email, null, Zero_VerifyCode::EMAIL);
//
        if ($verify_code !== false)
        {
            $msg    = 'success';
            $status = 200;
        }
        else
        {
            $msg = '失败';
            $status = 250;
        }

        $data['user_email'] = strHandel(User_BindConnectModel::EMAIL, $user_email);

        $this->render('user', $data, $msg, $status);
    }
    
    /**
     * 检测Email验证码是否正确
     *
     * @access public
     */
    public function checkEmail()
    {
        $code = s('code');

        $user_id = Zero_Perm::getUserId();

        $user_connect_row = User_BindConnectModel::getInstance()->findOne(array('user_id'=>$user_id, 'bind_type'=>User_BindConnectModel::EMAIL, 'bind_active'=>1));

        $email = $user_connect_row['bind_id'];

        $verification_code_flag = Zero_VerifyCode::checkCode($email, $code);

        if ($verification_code_flag !== false)
        {

            $cache_key = sprintf('%s|security-change|%d', User_BindConnectModel::$prefix, $user_id);
            $cache = Zero_Cache::create('verify_code');
            $cache->save(1, $cache_key);

            $cache_type_key = sprintf('%s|security-type|%d', User_BindConnectModel::$prefix, $user_id);

            $bind_type = $cache->get($cache_type_key);
    
            if($bind_type == 'mobile')
            {
                $msg = __('manageMobile');
            }
            else if($bind_type == 'email')
            {
                $msg = __('manageEmail');
            }
            else
            {
                $msg = __('managePasswd');
            }

            $status = 200;
        }
        else
        {
            $msg = __('验证码有误，请重新输入');
            $status = 250;
        }

        $data['user_email'] = strHandel(User_BindConnectModel::MOBILE, $email);

        $this->render('user', $data, $msg, $status);
    }
    
    
    /**
     * 绑定手机操作UI窗口
     *
     * 1、安全判断，检测是否可以直接绑定，如果有权限这直接进入绑定UI界面
     * 2、没有权限，则检测是否有email、mobile绑定，有绑定，则先需要验证，如果没有绑定，这直接去进行绑定操作。
     *
     * @access public
     */
    public function manageMobile()
    {
        $user_id = Zero_Perm::getUserId();

        $user_connect = array();

        $cache_key = sprintf('%s|security-change|%d', User_BindConnectModel::$prefix, $user_id);
        $cache = Zero_Cache::create('verify_code');
    
    
        $msg = __('操作成功');
        $status = 200;
        
        //有绑定权限。
        if ($cache->get($cache_key))
        {
           $this->setMet('manageMobile');
        }
        else
        {

            $cache_type_key = sprintf('%s|security-type|%d', User_BindConnectModel::$prefix, $user_id);

            $cache->save('mobile', $cache_type_key);

            //读取当前绑定的类型，可以选权限验证方式
            $user_connect_rows=  User_BindConnectModel::getInstance()->find(array('user_id'=>$user_id, 'bind_active'=>1 , 'bind_type' => array(User_BindConnectModel::EMAIL,User_BindConnectModel::MOBILE)));

            foreach($user_connect_rows as $connect)
            {
                $user_connect[$connect['bind_type']] = $connect['bind_id'];
            }

            //如果有两个，则必然有mobile
            if(count($user_connect) > 1)
            {
                $this->setMet('verifyMobile');
            }
            elseif (count($user_connect) == 1)
            {
                if(User_BindConnectModel::EMAIL == $connect['bind_type'])
                {
                    $this->setMet('verifyEmail');

                }
                else
                {
                    $this->setMet('verifyMobile');
                }
            }
            else
            {
                //目前无任何绑定操作，可以直接去绑定。
                //设置权限。
                $cache_key = sprintf('%s|security-change|%d', User_BindConnectModel::$prefix, $user_id);
                $cache = Zero_Cache::create('verify_code');
                $cache->save(1, $cache_key);
                
                $this->setMet('manageMobile');
            }
        }

        $this->render('user', $user_connect, $msg, $status);
    }
    
    /**
     * 绑定邮件操作UI窗口
     *
     * 1、安全判断，检测是否可以直接绑定，如果有权限这直接进入绑定UI界面
     * 2、没有权限，则检测是否有email、mobile绑定，有绑定，则先需要验证，如果没有绑定，这直接去进行绑定操作。
     *
     * @access public
     */
    public function manageEmail()
    {
        $user_connect = array();
        $user_id = Zero_Perm::getUserId();

        $cache_key = sprintf('%s|security-change|%d', User_BindConnectModel::$prefix, $user_id);
        $cache = Zero_Cache::create('verify_code');



        if ($cache->get($cache_key))
        {
            $this->setMet('manageEmail');
        }
        else
        {

            $cache_type_key = sprintf('%s|security-type|%d', User_BindConnectModel::$prefix, $user_id);

            $cache->save('email', $cache_type_key);

            $user_connect_rows=  User_BindConnectModel::getInstance()->find(array('user_id'=>$user_id, 'bind_active'=>1 , 'bind_type' => array(User_BindConnectModel::EMAIL,User_BindConnectModel::MOBILE)));

            foreach($user_connect_rows as $connect)
            {
                $user_connect[$connect['bind_type']] = $connect['bind_id'];
            }

            if(count($user_connect) > 1)
            {
                $this->setMet('verifyMobile');
            }
            elseif (count($user_connect) == 1)
            {
                if(User_BindConnectModel::EMAIL == $connect['bind_type'])
                {
                    $this->setMet('verifyEmail');
        
                }
                else
                {
                    $this->setMet('verifyMobile');
                }
            }
            else
            {
                //目前无任何绑定操作，可以直接去绑定。
                //设置权限。
                $cache_key = sprintf('%s|security-change|%d', User_BindConnectModel::$prefix, $user_id);
                $cache = Zero_Cache::create('verify_code');
                $cache->save(1, $cache_key);
        
                $this->setMet('manageEmail');
            }

        }


        $this->render('user', $user_connect);

    }
    
    /**
     * 修改密码入口。
     *
     * 1、安全判断，检测是否可以直接修改
     * 2、没有权限，则检测是否有email、mobile绑定，有绑定，则先需要验证，如果没有绑定，这直接去进行修改密码
     *
     * @access public
     */
    public function checkSecurityChange()
    {
        $user_connect = array();
        $user_id = Zero_Perm::getUserId();
    
        $cache_key = sprintf('%s|security-change|%d', User_BindConnectModel::$prefix, $user_id);
        $cache = Zero_Cache::create('verify_code');
    
    
        if ($cache->get($cache_key))
        {
            $this->setMet('managePassword');
            
            $msg    = __('操作成功');
            $status = 200;
        }
        else
        {
            //当前修改密码

            //判断是否需要验证。
            $cache_type_key = sprintf('%s|security-type|%d', User_BindConnectModel::$prefix, $user_id);
            $cache->save('passwd', $cache_type_key);
    
            //读取当前绑定的类型，可以选权限验证方式
            $user_connect_rows=  User_BindConnectModel::getInstance()->find(array('user_id'=>$user_id, 'bind_active'=>1 , 'bind_type' => array(User_BindConnectModel::EMAIL,User_BindConnectModel::MOBILE)));
    
            foreach($user_connect_rows as $connect)
            {
                $user_connect[$connect['bind_type']] = $connect['bind_id'];
            }
    
            //如果有两个，则必然有mobile
            if(count($user_connect) > 1)
            {
                $this->setMet('verifyMobile');
            }
            elseif (count($user_connect) == 1)
            {
                if(User_BindConnectModel::EMAIL == $connect['bind_type'])
                {
                    $this->setMet('verifyEmail');
            
                }
                else
                {
                    $this->setMet('verifyMobile');
                }
            }
            else
            {
                //目前无任何绑定操作，可以直接去绑定。
                //设置权限。
                $cache_key = sprintf('%s|security-change|%d', User_BindConnectModel::$prefix, $user_id);
                $cache = Zero_Cache::create('verify_code');
                $cache->save(1, $cache_key);
        
                $this->setMet('managePassword');
            }
            
            
            //$this->setMet('managePassword');
            $msg = __('权限不足或操作超时');
            $status = 250;
        }

    
        $this->render('user', $user_connect, $msg, $status);
        
    }
    
    /**
     *
     *
     * @access public
     */
    public function verifyMobile()
    {
        $user_connect = array();

        $user_id = Zero_Perm::getUserId();

        $user_connect_rows=  User_BindConnectModel::getInstance()->find(array('user_id'=>$user_id, 'bind_active'=>1 , 'bind_type' => array(User_BindConnectModel::EMAIL,User_BindConnectModel::MOBILE)));

        foreach($user_connect_rows as $connect)
        {
            $user_connect[$connect['bind_type']] = $connect['bind_id'];
        }


        $this->render('user', $user_connect);
    }

    public function verifyEmail()
    {
        $user_connect = array();

        $user_id = Zero_Perm::getUserId();

        $user_connect_rows=  User_BindConnectModel::getInstance()->find(array('user_id'=>$user_id, 'bind_active'=>1 , 'bind_type' => array(User_BindConnectModel::EMAIL,User_BindConnectModel::MOBILE)));

        foreach($user_connect_rows as $connect)
        {
            $user_connect[$connect['bind_type']] = $connect['bind_id'];
        }


        $this->render('user', $user_connect);
    }
    
    /**
     * 绑定第一步，输入手机/邮件及图形验证码操作, 判断下一步操作是否合法 -  当前$bind_id是否已经绑定。
     *
     *
     * @access public
     */
    public function checkVerify()
    {
        $bind_id             = s('bind_id')                    ; // 用户ID
        $user_id = Zero_Perm::getUserId();
        $verify_str  = s('verify_code');
        $rand_key = s('rand_key');
        $data['bind_type'] = i('bind_type');

        if($data['bind_type'] == User_BindConnectModel::EMAIL)
        {
            $verify_code = Zero_VerifyCode::getCode($bind_id, null, Zero_VerifyCode::EMAIL);
        }
        else
        {
            $verify_code = Zero_VerifyCode::getCode($bind_id, null, Zero_VerifyCode::MOBILE);
        }

        if($verify_code !== false)
        {
            //判断是否可以绑定。
            $flag = User_BindConnectModel::getInstance()->checkVerify($bind_id, $data, $verify_str, $rand_key);

            if ($flag !== false)
            {
                $msg = __('操作成功');
                $status = 200;
            }
            else
            {
                $msg = __('操作失败');
                $status = 250;
            }

        }
        else
        {
            $msg = __('操作失败');
            $status = 250;

        }


        $data_rs = $data;
        $data_rs['bind_id'] = $bind_id;
        $data_rs['user_id'] = $user_id;

        $this->render('user', $data_rs, $msg, $status);

    }

    //重新发送短信/邮件
    public function resend()
    {
        $bind_id             = s('bind_id')                    ; // 用户ID
        $bind_type = i('bind_type');

        if($bind_type == User_BindConnectModel::MOBILE)
        {
            $verify_code = Zero_VerifyCode::getCode($bind_id, null, Zero_VerifyCode::MOBILE);
        }
        else
        {
            $verify_code = Zero_VerifyCode::getCode($bind_id, null, Zero_VerifyCode::EMAIL);
        }

        if($verify_code !== false)
        {

            $msg = __('操作成功');
            $status = 200;

        }
        else
        {
            $msg = __('操作失败');
            $status = 250;

        }

        $data_rs['bind_id'] = $bind_id;

        $this->render('user', $data_rs, $msg, $status);

    }
    
    
    //充值密码
    public function resetPassword()
    {
        $new_password = s('password');

        $user_id = Zero_Perm::getUserId();
        $user_connect = array();
        $user_id = Zero_Perm::getUserId();
    
        $cache_key = sprintf('%s|security-change|%d', User_BindConnectModel::$prefix, $user_id);
        $cache = Zero_Cache::create('verify_code');
    
    
        if ($cache->get($cache_key))
        {
            $user_account_row = User_BaseModel::getInstance()->getOne($user_id);
            $user_account = $user_account_row['user_account'];
    
            $LoginMode = new LoginModel();
            $flag = $LoginMode->doResetPasswd($user_account, $new_password);
    
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
        }
        else
        {
            $msg = __('权限不足或操作超时');
            $status = 250;
        }
        

        
        
        $data[] = '';
        $this->render('user', $data, $msg, $status);
    }
    
    
    //修改密码
    public function changePassword()
    {
        $old_password = s('old_password');
        $new_password = s('new_password');
        
        $verify_code = s('verify_code');
        $rand_key = s('rand_key');
        $user_id = Zero_Perm::getUserId();
        
        $verification_code_flag = Zero_VerifyCode::checkCode($rand_key, $verify_code);
        $verification_code_flag = 1;

        if ($verification_code_flag)
        {
            $user_account_row = User_BaseModel::getInstance()->getOne($user_id);
            $user_account = $user_account_row['user_account'];

            $LoginMode = new LoginModel();
            $flag = $LoginMode->doResetPasswd($user_account, $new_password, $old_password);

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
        }
        else
        {
            $msg = __('验证码错误');
            $status = 250;

        }

        
        $data[] = '';
        $this->render('user', $data, $msg, $status);
    }

    /**
     * 实名认证保存接口
     */
    public function saveCertificate()
    {

        $data['user_realname'] = s('user_realname');
        $data['user_idcard'] = s('user_idcard');
        $data['user_idcard_images'] = s('user_idcard_images');
        $data['user_certification'] = StateCode::USER_CERTIFICATION_VERIFY;

        $user_id = Zero_Perm::getUserId();
        $User_InfoModel = User_InfoModel::getInstance();
        $user_info_row = $User_InfoModel->getOne($user_id);

        if ($user_info_row['user_certification'] != StateCode::USER_CERTIFICATION_YES) {

            $flag = $User_InfoModel->edit($user_id, $data);
            if($flag !== false)
            {
                $msg = __('操作成功');
                $status = 200;
            } else {
                $msg = __('操作失败');
                $status = 250;
            }
        } else {
            $msg = __('已提交，请勿重复提交！');
            $status = 250;
        }

        $this->render('user', array(), $msg, $status);

    }

    /**
     * 实名认证页面
     */
    public function certification()
    {
        $data = array();
        $user_id = Zero_Perm::getUserId();
        /* @var $User_InfoModel User_InfoModel */
        $User_InfoModel = User_InfoModel::getInstance();
        $user_info_row = $User_InfoModel->getOne($user_id);

        $data['user_certification'] = $user_info_row['user_certification'];
        $data['user_realname'] = $user_info_row['user_realname'];
        $data['user_idcard'] = $user_info_row['user_idcard'];
        $data['user_idcard_images'] = $user_info_row['user_idcard_images'];

        $data = $User_InfoModel->dealUserCertification($data);

        $this->render('user', $data);
    }
}
?>
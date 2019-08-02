<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 用户基本信息控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2016-10-14, Xinze
 * @request int $user_id 用户ID
 * @request string $user_account 用户名
 * @request string $user_password 密码
 * @request string $user_nickname 用户昵称
 * @request int $user_state 状态:0-锁定;1-未激活;2-已激活;
 * @request string $user_key session_id-修改密码更改（登录修改涉及多端，影响用户中心）
 * @request string $user_salt 加点盐
 * @request string $user_token for site connect check： user_key密码登录更改， user_token connect请求验证就更改

 * 用户详细信息控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2016-10-14, Xinze
 * @request int $user_id 用户id
 * @request int $user_group 用户组
 * @request string $user_avatar 头像
 * @request int $user_gender 性别  1:男  2:女
 * @request string $user_realname 真实姓名
 * @request string $user_mobile 手机号码
 * @request string $user_tel 电话
 * @request string $user_email 用户邮箱
 * @request string $user_qq QQ
 * @request string $user_msn MSN
 * @request string $user_birthday 生日(DATE)
 * @request int $user_province_id 省
 * @request string $user_province 省份
 * @request int $user_city_id 城市
 * @request string $user_city 城市
 * @request int $user_county_id 县
 * @request string $user_county 县
 * @request string $user_address 详细地址
 * @request string $user_intro 个人简介
 * @request string $user_sign 用户签名
 * @request string $user_reg_time 注册时间
 * @request string $user_reg_ip 注册IP
 * @request string $user_lastlogin_time 上次登录时间
 * @request string $user_lastlogin_ip 上次登录IP
 * @request int $user_count_login 登录次数
 * @request int $user_money 用户资金
 * @request int $user_points 积分
 * @request int $user_credit 用户信用
 * @request string $user_idcard 身份证
 */
class Api_User_InfoCtl extends Api_AccountController
{
    public $userBaseModel = null;
    public $userInfoModel = null;

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

        $this->userBaseModel = new User_BaseModel();
        $this->userInfoModel = new User_InfoModel();
    }

    /**
     * 员工账号列表数据
     *
     * @access public
     */
    public function listse()
    {
        $page = i('page', 1);  //当前页码
        $rows = i('rows', 500); //每页记录条数
        $sort = grid_sort();
        $column_data = array();
        //获取店铺id
        $column_data['store_ids'] = Zero_Perm::getStoreId();
        //获取门店id
        $column_data['chain_ids'] = Zero_Perm::getChainId();
//        var_dump($column_data['chain_ids']);die();
        $data = array('items'=>array());

        $data = $this->userInfoModel->getLists($column_data, $sort, $page, $rows);
        if ($data){
            $msg = 'success';
            $status = 200;
        }else{
            $msg = '获取失败';
            $status = 250;
        }
        $this->render('user', $data,$msg,$status);
    }


    /**
     * 用户基本信息列表数据
     *
     * @access public
     */
    public function lists()
    {
		$page = i('page', 1);  //当前页码
		$rows = i('rows', 500); //每页记录条数
		$sort = grid_sort();

        $data = array('items'=>array());
        $column_data = array();

        if ($user_account = s('user_account'))
        {
            $column_data['user_account:LIKE'] =  '%' . $user_account . '%';
        }
        
        if ($user_nickname = s('user_nickname'))
        {
            $column_data['user_nickname:LIKE'] =  '%' . $user_nickname . '%';
        }
    
    
        if ($user_is_admin= i('user_is_admin'))
        {
            $column_data['user_is_admin'] =  $user_is_admin;
        }

        $data = $this->userInfoModel->getLists($column_data, $sort, $page, $rows);

        if (Zero_Api_Controller::getPlantformRole() && i("subsite_flag", 0)) {
            $data['items'] = Plantform_SubsiteModel::getInstance()->fixSubsite($data['items']);
        }

        /*//权限判断
        if (Zero_Api_Controller::getPlantformRole()) {

        } else {
            // 非平台权限时
            /* @var $Store_EmployeeModel Store_EmployeeModel
            $Store_EmployeeModel = Store_EmployeeModel::getInstance();
            $store_id = Zero_Perm::getStoreId();

            $data = $Store_EmployeeModel->getLists(array('store_id' => $store_id), $sort, $page, $rows);
            $data['items'] = $Store_EmployeeModel->fixUserInfo($data['items']);
        }*/



        $this->render('user', $data);
    }

    public function listUserResource()
    {
        $page = i('page', 1);  //当前页码
        $rows = i('rows', 500); //每页记录条数
        $sort = grid_sort();

        $column_data = array();

        if ($user_account = s('user_account'))
        {
            $column_data['user_account:LIKE'] =  '%' . $user_account . '%';
        }

        if ($user_nickname = s('user_nickname'))
        {
            $column_data['user_nickname:LIKE'] =  '%' . $user_nickname . '%';
        }
        
        if ($user_id = i('user_id'))
        {
            $column_data['user_id'] = $user_id;
        }

        if ($user_is_admin= i('user_is_admin'))
        {
            $column_data['user_is_admin'] =  $user_is_admin;
        }

        $data = $this->userInfoModel->getLists($column_data, $sort, $page, $rows);

        $resource_rows = User_ResourceModel::getInstance()->find($column_data, $sort, $page, $rows);

        $data['items'] = Zero_Utils_Array::leftjoin($data['items'], $resource_rows, 'user_id');
        
        if (!Zero_Api_Controller::getPlantformRole()) {
            $data['page'] = 0;
            $data['total'] = 0;
            $data['records'] = 0;
            $data['items'] = array();
        }
        
        $this->render('user', $data);
    }

    /**
     * 读取用户基本信息
     *
     * @access public
     */
    public function get()
    {
		$user_id_str = s('user_id'); //用户ID ","分割
		$user_id_row = explode(',', $user_id_str);

        $rows = array();

		//权限判断
        if (Zero_Api_Controller::getPlantformRole())
        {
            $rows = $this->userInfoModel->getUser($user_id_row);
        }

        $this->render('user', $rows);
    }

    /**
     * 添加用户基本信息
     *
     * @access public
     */
    public function add()
    {

        $base['user_account']           = s('user_account')               ; // 用户名
        $base['user_password']          = s('user_password')              ; // 密码
        $base['user_nickname']          = s('user_nickname', s('user_account'))           ; //  用户昵称
        $data['user_state']             = i('user_state')                 ; // 状态:0-锁定;1-未激活;2-已激活;
    
    
        $data['user_id']                = i('user_id')                    ; // 用户id
        $data['user_type_id']           = i('user_type_id')               ; // 用户类别
        $data['user_level_id']          = i('user_level_id')              ; // 用户等级
        $data['user_group']             = i('user_group')                 ; // 用户组
        $data['user_avatar']            = s('user_avatar')                ; // 头像
        $data['user_gender']            = i('user_gender')                ; // 性别(ENUM):1-男;  2-女;
        $data['user_realname']          = s('user_realname')              ; // 真实姓名
        $data['user_birthday']          = s('user_birthday')              ; // 生日(DATE)
        $data['user_mobile']            = s('user_mobile')                ; // 手机号码(mobile)
        $data['user_tel']               = s('user_tel')                   ; // 电话
        $data['user_email']             = s('user_email')                 ; // 用户邮箱(email)
        $data['user_qq']                = s('user_qq')                    ; // QQ
        $data['user_ww']                = s('user_ww')                    ; // 阿里旺旺
        $data['user_idcard']            = s('user_idcard')                ; // 身份证
        $data['user_province_id']       = i('user_province_id')           ; // 省
        $data['user_city_id']           = i('user_city_id')               ; // 城市
        $data['user_county_id']         = i('user_county_id')             ; // 县
        $data['user_address']           = s('user_address')               ; // 详细地址
        $data['user_sign']              = s('user_sign')                  ; // 签名

        $subsite_id = i("subsite_id", 0);

        $this->userInfoModel->sql->startTransactionDb();

        if (Zero_Api_Controller::getPlantformRole())
        {


            if (i('is_admin'))
            {
                $is_admin = 1;
                $rights_group_id = 1;
            }
            else
            {
                $is_admin = 0;
                $rights_group_id = 0;
            }

            $user_base_row = $this->userInfoModel->register($base['user_account'], $base['user_password'], null, null, null, false, $rights_group_id, $is_admin);
            $user_id = $user_base_row['user_id'];

            if ($subsite_id) {
                Plantform_SubsiteUserModel::getInstance()->add(array('user_id' => $user_id, "subsite_id" => $subsite_id));
            }
        } else {
            $store_id = Zero_Perm::getStoreId();
            $user_id = $this->userInfoModel->registerStoreEmployee($base['user_account'], $base['user_password'], $store_id);
        }


        if ($user_id && $this->userInfoModel->sql->commitDb())
        {
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $this->userInfoModel->sql->rollBackDb();
            $msg = __('操作失败');
            $status = 250;
        }

        $data['user_id'] = $user_id;

        $this->render('user', $data, $msg, $status);
    }

    /**
     * 删除用户基本信息
     *
     * @access public
     */
    public function remove()
    {
        $user_id_str = s('user_id'); //用户ID ","分割
		$user_id_row = explode(',', $user_id_str);

		//权限判断

        if (Zero_Api_Controller::getPlantformRole())
        {
            $flag = $this->userInfoModel->removeUser($user_id_row);
        }

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

        $data['user_id'] = $user_id_row;

        $this->render('user', $data, $msg, $status);
    }

    /**
     * 修改用户基本信息
     *
     * @access public
     */
    public function editRightGroupIds()
    {
        $data['user_id']                = i('user_id')                    ; // 用户ID
        $data['rights_group_id']        = s('rights_group_id')            ; // 权限组(DOT)

        $user_id = $data['user_id'];
        $data_rs = $data;
        unset($data['user_id']);

        //权限判断
        if (Zero_Api_Controller::getPlantformRole())
        {
            $flag = $this->userBaseModel->edit($user_id, $data);

            if ($flag)
            {
                $msg = __('操作成功');
                $status = 200;
            } else {
                $msg = __('操作失败');
                $status = 250;
            }
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }

        $this->render('default', $data_rs, $msg, $status);
    }

    /**
     * 修改用户基本信息
     *
     * @access public
     */
    public function edit()
    {
        $data['user_id']                = i('user_id')                    ; // 用户ID
        $data['user_account']           = s('user_account')               ; // 用户名
        $data['user_password']          = s('user_password')              ; // 密码
        $data['user_nickname']          = s('user_nickname')              ; //  用户昵称
        $data['user_state']             = i('user_state')                 ; // 状态:0-锁定;1-未激活;2-已激活;
        //$data['rights_group_id']        = i('rights_group_id')                 ; // 状态:0-锁定;1-未激活;2-已激活;
        
        /*
        $data['user_type_id']           = i('user_type_id')               ; // 用户类别
        $data['user_level_id']          = i('user_level_id')              ; // 用户等级
        */
        
        $data['user_avatar']            = s('user_avatar')                ; // 头像
        $data['user_gender']            = i('user_gender')                ; // 性别(ENUM):1-男;  2-女;
        $data['user_realname']          = s('user_realname')              ; // 真实姓名
        $data['user_birthday']          = s('user_birthday')              ; // 生日(DATE)
        $data['user_mobile']            = s('user_mobile')                ; // 手机号码(mobile)
        $data['user_tel']               = s('user_tel')                   ; // 电话
        $data['user_email']             = s('user_email')                 ; // 用户邮箱(email)
        $data['user_qq']                = s('user_qq')                    ; // QQ
        $data['user_ww']                = s('user_ww')                    ; // 阿里旺旺
        $data['user_idcard']            = s('user_idcard')                ; // 身份证
        $data['user_province_id']       = i('user_province_id')           ; // 省
        $data['user_city_id']           = i('user_city_id')               ; // 城市
        $data['user_county_id']         = i('user_county_id')             ; // 县
        $data['user_address']           = s('user_address')               ; // 详细地址
        $data['user_sign']              = s('user_sign')                  ; // 签名
        $subsite_id = i("subsite_id", 0);

        $user_id = $data['user_id'];
        $data_rs = $data;
        unset($data['user_id']);

        //权限判断
        if (Zero_Api_Controller::getPlantformRole()) {
            $flag = $this->userInfoModel->editUser($user_id, $data);

            if ($subsite_id) {
                $Plantform_SubsiteUserModel = Plantform_SubsiteUserModel::getInstance();
                $subsite_user_id            = $Plantform_SubsiteUserModel->findKey(array('user_id' => $user_id));
                if ($subsite_user_id) {
                    Plantform_SubsiteUserModel::getInstance()->edit($subsite_user_id, array("subsite_id" => $subsite_id));
                } else {
                    Plantform_SubsiteUserModel::getInstance()->add(array(
                        'user_id'    => $user_id,
                        "subsite_id" => $subsite_id
                    ));
                }
            }

        }

        if ($flag !== false) {
            $msg    = __('操作成功');
            $status = 200;
        } else {
            $msg    = __('操作失败');
            $status = 250;
        }

        $this->render('user', $data_rs, $msg, $status);
    }

    /**
     * 修改用户状态
     *
     * @access public
     */
    public function enable($render = false)
    {
        $data['user_id']                = i('user_id')                    ; // 用户ID
        $data['user_state']             = i('user_state')                 ; // 状态:0-锁定;1-未激活;2-已激活;
        $data['user_jb_state']             = i('user_jb_state')                 ; // 状态:0-锁定;1-未激活;2-已激活;


        $user_id = $data['user_id'];
        $data_rs = $data;
        unset($data['user_id']);

        //权限判断
        if (Zero_Api_Controller::getPlantformRole())
        {
            if ('user_jb_state' == s('enable_name'))
            {
                $flag = $this->userInfoModel->editJbState($user_id, $data['user_jb_state']);
            }
            else
            {
                $flag = $this->userInfoModel->editState($user_id, $data['user_state']);
            }
        }

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

    /**
     * 修改活动状态
     *
     * @access public
     */
    public function editCertification()
    {
        $data['user_id']             =  r('user_id')                 ; // 产品id
        $data['user_certification']       = i('user_certification')           ;
        $data_rs = $data;
        $user_id = $data['user_id'];
        unset($data['user_id']);


        if (Zero_Api_Controller::getPlantformRole())
        {

            $this->userInfoModel->sql->startTransactionDb();

            $flag = $this->userInfoModel->editCertification($user_id, $data['user_certification']);

            if ($flag && $this->userInfoModel->sql->commitDb())
            {
                $msg = __('操作成功');
                $status = 200;
            }
            else
            {
                $this->userInfoModel->sql->rollBackDb();

                $msg = __('操作失败');
                $status = 250;
            }
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }

        $this->render('default', $data_rs, $msg, $status);
    }
}
?>

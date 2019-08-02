<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 用户详细信息模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2016-10-14, Xinze
 * @version    1.0
 * @todo
 */
class User_InfoModel extends Zero_Model
{
    public $_cacheName       = 'user';
    public $_tableName       = 'user_info';
    public $_tablePrimaryKey = 'user_id';
    public $_useCache        = false;
    public $_languageCond    = false;
    
    public $fieldType = array('user_idcard_images'=>'DOT');


    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'user_info_cond'=>array(
            'user_id' => null,
        )
    );

    public $_validateRules = array('integer'=>array('user_id', 'user_group', 'user_gender', 'user_province_id', 'user_city_id', 'user_county_id', 'user_count_login', 'user_money', 'user_points', 'user_credit'), 'date'=>array('user_birthday', 'user_reg_time', 'user_lastlogin_time'));

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
        $data = User_BaseModel::getInstance()->lists($column_row, $sort, $page, $rows);
        
        $user_id_row = array_column_unique($data['items'], 'user_id');
        
        $user_base_rows = $this->get($user_id_row);
        $user_login_rows = User_LoginModel::getInstance()->get($user_id_row);

        foreach ($data['items'] as $key=>$row)
        {
            unset($data['items'][$key]['user_key']);
            unset($data['items'][$key]['user_password']);
            unset($data['items'][$key]['user_salt']);
            unset($data['items'][$key]['user_token']);
            
            $data['items'][$key]    = array_merge($user_base_rows[$row['user_id']], $data['items'][$key]);

            $data['items'][$key]['user_reg_time']    = $user_login_rows[$row['user_id']]['user_reg_time'];
            $data['items'][$key]['user_reg_ip']    = $user_login_rows[$row['user_id']]['user_reg_ip'];
            $data['items'][$key]['user_lastlogin_time']    = $user_login_rows[$row['user_id']]['user_lastlogin_time'];
            $data['items'][$key]['user_lastlogin_ip']    = $user_login_rows[$row['user_id']]['user_lastlogin_ip'];
        }
        
        return $data;
    }

    /**
     * 注册
     *
     * @param  string $user_account 用户账号
     * @param  string $user_password 用户密码
     * @param  mixed $rand_key 验证码, 如果启用,则有值. 是否启用有控制器判断
     * @param  mixed $verification_code 验证码
     * @param  mixed $app_id 来源id
     * @return array 用户登录数据
     * @access public
     */
    public function register($user_account, $user_password, $rand_key=null, $verification_code=null, $app_id=null, $auto_login=false, $rights_group_id=0, $is_admin=0, $store_id='')
    {
        $LoginModel = new LoginModel();

        return $LoginModel->register($user_account, $user_password, $rand_key, $verification_code, $app_id, $auto_login, $rights_group_id, $is_admin, $store_id);
    }

    /**
     * 注册店铺员工
     *
     * @param  string $user_account 用户账号
     * @param  string $user_password 用户密码
     * @param  string $store_id 店铺ID
     * @param  mixed $rand_key 验证码, 如果启用,则有值. 是否启用有控制器判断
     * @param  mixed $verification_code 验证码
     * @param  mixed $app_id 来源id
     * @return array 用户登录数据
     * @access public
     */
    public function registerStoreEmployee($user_account, $user_password, $store_id, $rand_key=null, $verification_code=null, $app_id=null, $auto_login=false, $rights_group_id=1, $is_admin=0)
    {
        $LoginModel = new LoginModel();
        $user_row = $LoginModel->register($user_account, $user_password, $rand_key, $verification_code, $app_id, $auto_login, $rights_group_id, $is_admin, $store_id);
        $user_id = $user_row['user_id'];

        if ($user_id) {
            $employee_id = Store_EmployeeModel::getInstance()->add(array('user_id' => $user_id, 'store_id' => $store_id));
        } else {
            return false;
        }

        return $user_id && $employee_id ? $user_id : false;
    }


    /**
     * 获取用户
     *
     * @param  mixed $user_id 用户Id
     * @return array 用户登录数据
     * @access public
     */
    public function getUserOne($user_id)
    {
        $rs = array();

        $data = $this->getUser($user_id);

        if ($data)
        {
            $rs = current($data);
        }

        return $rs;
    }

    /**
     * 获取用户
     *
     * @param  mixed $user_id 用户Id
     * @return array 用户登录数据
     * @access public
     */
    public function getUser($user_id)
    {
        $User_BaseModel = new User_BaseModel();
        $user_base_rows = $User_BaseModel->get($user_id);
        $user_info_rows = $this->get($user_id);

        foreach ($user_base_rows as $key=>$row)
        {
            $user_info_rows[$key]['user_id']       = $row['user_id'];
            $user_info_rows[$key]['user_state']    = $row['user_state'];
            $user_info_rows[$key]['user_nickname'] = $row['user_nickname'];
            $user_info_rows[$key]['user_account']  = $row['user_account'];
        }

        return $user_info_rows;
    }

    /**
     * 删除用户
     *
     * @param  mixed $user_id 用户Id
     * @return array 用户登录数据
     * @access public
     */
    public function removeUser($user_id)
    {        
        $User_BaseModel = new User_BaseModel();

        $flag[] = $User_BaseModel->remove($user_id);
        $flag[] = $this->remove($user_id);
        $flag[] = User_BindConnectModel::getInstance()->removeCond(array('user_id'=>$user_id));
        $flag[] = User_LoginModel::getInstance()->remove($user_id);
        $flag[] = Distribution_PlantformUserModel::getInstance()->remove($user_id);
        $flag[] = User_ChainModel::getInstance()->remove($user_id);

        return is_ok($flag);
    }

    /**
     * 编辑用户
     *
     * @param  mixed $user_id 用户Id
     * @return array 用户登录数据
     * @access public
     */
    public function editUser($user_id, $data)
    {
        $User_BaseModel = new User_BaseModel();
        $user_row = $User_BaseModel->getOne($user_id);
        $flag = false;

        if ($user_row)
        {
            $flag = true;
            if (isset($data['user_password']))
            {
                $user_account          = $user_row['user_account'];

                $LoginModel = new LoginModel();
                $flag = $LoginModel->doResetPasswd($user_account, $data['user_password']);

                unset($data['user_password']);
            }

            if (isset($data['user_account']))
            {
                //$base_data['user_account'] = $data['user_account'];
                $base_data['user_nickname'] = $data['user_nickname'];
                $base_data['user_state'] = $data['user_state'];

                unset($data['user_account']);
                unset($data['user_nickname']);
                unset($data['user_state']);

                $User_BaseModel->edit($user_id, $base_data);
            }

            unset($data['user_account']);
            unset($data['user_nickname']);
            unset($data['user_state']);
            if ($data)
            {
                $flag = $this->edit($user_id, $data);
            }

        }


        return $flag;
    }

    /**
     * 编辑用户密码
     *
     * @param  mixed $user_id 用户Id
     * @return array 用户登录数据
     * @access public
     */
    public function editPasswrod($user_id, $user_password)
    {
        $User_BaseModel = new User_BaseModel();
        $user_row = $User_BaseModel->getOne($user_id);

        if ($user_row)
        {
            $user_account          = $user_row['user_account'];

            $LoginModel = new LoginModel();
            $flag = $LoginModel->doResetPasswd($user_account, $user_password);
        }
        

        return $flag;
    }

    /**
     * 编辑用户状态
     *
     * @param  mixed $user_id 用户Id
     * @return array 用户登录数据
     * @access public
     */
    public function editState($user_id, $user_state)
    {
        $data['user_state'] = $user_state;

        $User_BaseModel = new User_BaseModel();
        $flag = $User_BaseModel->edit($user_id, $data);

        return $flag;
    }
    
    /**
     * 编辑用户状态
     *
     * @param  mixed $user_id 用户Id
     * @return array 用户登录数据
     * @access public
     */
    public function editJbState($user_id, $user_jb_state)
    {
        $data['user_jb_state'] = $user_jb_state;
    
        $flag = $this->edit($user_id, $data);
    
        return $flag;
    }
    
    /**
     * 编辑用户状态
     *
     * @param  mixed $user_id 用户Id
     * @return array 用户登录数据
     * @access public
     */
    public function editCertification($user_id, $user_certification)
    {
        $data['user_certification'] = $user_certification;

        $flag = $this->edit($user_id, $data);

        return $flag;
    }


    public function sync($user_id)
    {
        $edit_user_row = array();
        $user_info_row = array();

        if ($user_id)
        {
            $User_InfoModel = new User_InfoModel();
            $user_row = $User_InfoModel->getOne($user_id);

            $edit_user_row['user_id'] = $user_id;
            $edit_user_row['user_delete'] = $user_row['user_state']==3 ? 1 : 0;

            if ($user_row)
            {
                $User_InfoDetailModel = new User_InfoDetailModel();
                $user_info_row = $User_InfoDetailModel->getOne($user_row['user_name']);



                $edit_user_row['user_mobile']     = $user_info_row['user_mobile'];
                $edit_user_row['user_email']      = $user_info_row['user_email'];

                $edit_user_row['user_sex']        = $user_info_row['user_gender'];
                $edit_user_row['user_realname']   = $user_info_row['user_truename'];
                $edit_user_row['user_qq']         = $user_info_row['user_qq'];
                $edit_user_row['user_avatar']     = $user_info_row['user_avatar'];


                $edit_user_row['user_provinceid'] = $user_info_row['user_provinceid'];
                $edit_user_row['user_cityid']     = $user_info_row['user_cityid'];
                $edit_user_row['user_areaid']     = $user_info_row['user_areaid'];
                $edit_user_row['user_area']       = $user_info_row['user_area'];
                $edit_user_row['user_birthday']   = $user_info_row['user_birth'];
            }
            else
            {
            }
        }

        if ($edit_user_row)
        {
            //同步

            $Base_App = new Base_AppModel();
            $base_app_rows = $Base_App->find();


            foreach ($base_app_rows as $base_app_row)
            {
                $url = $base_app_row['app_url'];

                if ($url)
                {
                    $key = $base_app_row['app_key'];

                    $formvars = $edit_user_row;
                    $formvars['app_id_from']        = $base_app_row['app_id'];;

                    $url = sprintf('%s?ctl=%s&met=%s&typ=%s', $url, 'Api_User_Info', 'editUserInfo', 'json');

                    //权限加密数据处理
                    $init_rs = get_url_with_encrypt($key, $url, $formvars);

                    if (200 == $init_rs['status'] && $init_rs['data'])
                    {
                        $init_flag = true;

                        //更新状态app server 信息及状态
                    }
                    else
                    {
                        $init_flag = false;
                    }
                }
            }
        }
    }

    public function editAccount($user_id, $data)
    {

        $rs_row = array();

        if (array_key_exists('user_nickname', $data))
        {
            $row['user_nickname'] = $data['user_nickname'];
            
            $flag = User_BaseModel::getInstance()->edit($user_id, $row);
            
            if (false === check_rs($flag, $rs_row))
            {
                throw new Zero_Exception_Db(__('保存用户基础数据失败!'));
            }
            
            unset($data['user_nickname']);
        }

        $flag = $this->edit($user_id, $data);

        if (false === check_rs($flag, $rs_row))
        {
            throw new Zero_Exception_Db(__('保存用户信息数据失败!'));
        }

        return is_ok($rs_row) ? $flag : false;

    }



    /**
     * 作用：用*号替代姓名除第一个字之外的字符
     * 参数：$name
     * @param string $name 名字
     * @param int $num 名字
     * @return string
     *
     * 返回值：string
     */
    function starReplaceRealName($name, $num = 0)
    {
        if ($num && mb_strlen($name, 'UTF-8') > $num) {
            return mb_substr($name, 0, 4, 'UTF-8') . '*';
        }

        if ($num && mb_strlen($name, 'UTF-8') <= $num) {
            return $name;
        }

        $doubleSurname = [
            '欧阳', '太史', '端木', '上官', '司马', '东方', '独孤', '南宫',
            '万俟', '闻人', '夏侯', '诸葛', '尉迟', '公羊', '赫连', '澹台', '皇甫', '宗政', '濮阳',
            '公冶', '太叔', '申屠', '公孙', '慕容', '仲孙', '钟离', '长孙', '宇文', '司徒', '鲜于',
            '司空', '闾丘', '子车', '亓官', '司寇', '巫马', '公西', '颛孙', '壤驷', '公良', '漆雕', '乐正',
            '宰父', '谷梁', '拓跋', '夹谷', '轩辕', '令狐', '段干', '百里', '呼延', '东郭', '南门', '羊舌',
            '微生', '公户', '公玉', '公仪', '梁丘', '公仲', '公上', '公门', '公山', '公坚', '左丘', '公伯',
            '西门', '公祖', '第五', '公乘', '贯丘', '公皙', '南荣', '东里', '东宫', '仲长', '子书', '子桑',
            '即墨', '达奚', '褚师', '吴铭'
        ];

        $surname = mb_substr($name, 0, 2, 'UTF-8');

        if (in_array($surname, $doubleSurname)) {
            $name = mb_substr($name, 0, 2, 'UTF-8') . str_repeat('*', (mb_strlen($name, 'UTF-8') - 2));
        } else {
            $name = mb_substr($name, 0, 1, 'UTF-8') . str_repeat('*', (mb_strlen($name, 'UTF-8') - 1));
        }


        return $name;
    }

    /**
     * 作用：用*号替代姓名除第一个字之外的字符
     * 参数：$name
     * @param string $card_num 身份证号码
     * @param int $start
     * @param int $end
     *
     * @return string
     *
     * 返回值：string
     */
    function starReplacecCertificateCard($card_num, $start = 4, $end = 4)
    {
        $certificate_identification_length = 18;

        if (strlen($card_num) == $certificate_identification_length) {
            $card_num = substr_replace($card_num, "****", $start, $certificate_identification_length - $end -$start);
        } else {
            $card_num = "身份证位数不正常！";
        }

        return $card_num;
    }

    /**
     * 处理用户实名信息
     *
     * @param array $user_info_row 用户信息
     *
     * @return array
     */
    public function dealUserCertification($user_info_row = array())
    {
        if (isset($user_info_row['user_realname']) && $user_info_row['user_realname']) {
            //$user_info_row['user_realname'] = $this->starReplaceRealName($user_info_row['user_realname']);
        }

        if (isset($user_info_row['user_idcard']) && $user_info_row['user_idcard']) {
            //$user_info_row['user_idcard'] = $this->starReplacecCertificateCard($user_info_row['user_idcard']);
        }

        return $user_info_row;
    }


    /**
     * @param array $rows
     * @param int $dimensionality 默认为2，因为 1.大部分用到的地方是二维数组用到，2.初始时是为二维设计的
     * @param bool $fix_user_account 是否将user_account一起读取
     * @return array
     */
    public static function fixUserAvatar(&$rows, $dimensionality = 2, $fix_user_account = false)
    {
        $tmp_row = array();
        if ($dimensionality == 1) {
            $tmp_row[] = $rows;
        } else {
            $tmp_row = $rows;
        }

        $user_ids = array_unique(array_filter(array_merge(array_column($tmp_row, 'user_id_to'),array_column($tmp_row, 'user_other_id'), array_column($tmp_row, 'user_id'), array_column($tmp_row, 'friend_id'), array_column($tmp_row, 'buyer_user_id'), array_column($tmp_row, 'buyer_id'), array_column($tmp_row, 'user_parent_id'))));


        if ($user_ids)
        {
            $user_base_rows = User_BaseModel::getInstance()->get($user_ids);
            $user_info_rows = User_InfoModel::getInstance()->get($user_ids);

            foreach ($tmp_row as $id=>$row)
            {
                if (isset($row['user_other_id']))
                {
                    if (isset($user_base_rows[$row['user_other_id']]))
                    {
                        $tmp_row[$id]['user_other_nickname'] = $user_base_rows[$row['user_other_id']]['user_nickname'];
                        $tmp_row[$id]['user_other_avatar'] = $user_info_rows[$row['user_other_id']]['user_avatar'];
                        $tmp_row[$id]['user_other_sign'] = $user_info_rows[$row['user_other_id']]['user_sign'];
                        if ($fix_user_account) {
                            $tmp_row[$id]['user_account'] = $user_base_rows[$row['user_other_id']]['user_account'];
                        }
                    }
                    else
                    {
                        $tmp_row[$id]['user_other_nickname'] = __('临时:') . $row['user_other_id'];
                        $tmp_row[$id]['user_other_avatar'] = '';
                        $tmp_row[$id]['user_other_sign'] = '';
                        if ($fix_user_account) {
                            $tmp_row[$id]['user_account'] = '';
                        }
                    }
                }

                if (isset($row['buyer_user_id']))
                {
                    $tmp_row[$id]['buyer_user_nickname'] = @$user_base_rows[$row['buyer_user_id']]['user_nickname'];
                    $tmp_row[$id]['buyer_user_avatar'] = @$user_info_rows[$row['buyer_user_id']]['user_avatar'];
                    $tmp_row[$id]['buyer_user_sign'] = @$user_info_rows[$row['buyer_user_id']]['user_sign'];
                    if ($fix_user_account) {
                        $tmp_row[$id]['buyer_user_account'] = $user_base_rows[$row['buyer_user_id']]['user_account'];
                    }
                }

                if (isset($row['friend_id']))
                {
                    $tmp_row[$id]['username'] = @$user_base_rows[$row['friend_id']]['user_nickname'];
                    $tmp_row[$id]['avatar'] = @$user_info_rows[$row['friend_id']]['user_avatar'] ? $user_info_rows[$row['friend_id']]['user_avatar'] : Base_ConfigModel::getConfig('user_no_avatar');
                    $tmp_row[$id]['sign'] = @$user_info_rows[$row['friend_id']]['user_sign'];
                    if ($fix_user_account) {
                        $tmp_row[$id]['account'] = $user_base_rows[$row['friend_id']]['user_account'];
                    }
                }

                if (isset($row['user_id']))
                {
                    $tmp_row[$id]['user_nickname'] = @$user_base_rows[$row['user_id']]['user_nickname'];
                    $tmp_row[$id]['user_avatar'] = @$user_info_rows[$row['user_id']]['user_avatar'];
                    $tmp_row[$id]['user_sign'] = @$user_info_rows[$row['user_id']]['user_sign'];
                    if ($fix_user_account) {
                        $tmp_row[$id]['user_account'] = $user_base_rows[$row['user_id']]['user_account'];
                    }
                }

                if (isset($row['buyer_id']))
                {
                    $tmp_row[$id]['buyer_nickname'] = @$user_base_rows[$row['buyer_id']]['user_nickname'];
                    $tmp_row[$id]['buyer_avatar'] = @$user_info_rows[$row['buyer_id']]['user_avatar'];
                    $tmp_row[$id]['buyer_sign'] = @$user_info_rows[$row['buyer_id']]['user_sign'];
                    if ($fix_user_account) {
                        $tmp_row[$id]['buyer_account'] = $user_base_rows[$row['buyer_id']]['user_account'];
                    }
                }

                if (isset($row['user_id_to']))
                {
                    $tmp_row[$id]['user_nickname_to'] = @$user_base_rows[$row['user_id_to']]['user_nickname'];
                    $tmp_row[$id]['user_avatar_to'] = @$user_info_rows[$row['user_id_to']]['user_avatar'];
                    $tmp_row[$id]['user_sign_to'] = @$user_info_rows[$row['user_id_to']]['user_sign'];
                    if ($fix_user_account) {
                        $tmp_row[$id]['user_account_to'] = $user_base_rows[$row['user_id_to']]['user_account'];
                    }
                }
    
                if (isset($row['user_parent_id']))
                {
                    $tmp_row[$id]['user_parent_nickname'] = @$user_base_rows[$row['user_parent_id']]['user_nickname'];
                    $tmp_row[$id]['user_parent_avatar'] = @$user_info_rows[$row['user_parent_id']]['user_avatar'];
                    $tmp_row[$id]['user_parent_sign'] = @$user_info_rows[$row['user_parent_id']]['user_sign'];
                    if ($fix_user_account) {
                        $tmp_row[$id]['user_parent_account'] = $user_base_rows[$row['user_parent_id']]['user_account'];
                    }
                }
                
            }
        }
        
        return $rows = ($dimensionality == 1 ? $tmp_row[0] : $tmp_row);
    }

    public static function getCustomerChainId()
    {
        $User_ChainModel = User_ChainModel::getInstance();
        return $User_ChainModel->findKey(array('user_id' => Zero_Perm::getUserId()));
    }

    /**
     * 经验操作统一入口
     *
     * @param  int   $exp
     * @param  int   $exp_type_id  积分类型(ENUM):1-会员注册;2-会员登录;3-商品评论;4-购买商品;5-管理员操作;7-积分换购商品;8-积分兑换优惠券
     * @return bool  返回的查询内容
     * @access public
     */
    public static function experience($user_id, $exp, $exp_type_id, $desc='')
    {
        $date  = get_date();
        /* @var $User_ExpHistoryModel User_ExpHistoryModel */
        $User_ExpHistoryModel = User_ExpHistoryModel::getInstance();

        //通用判断， 注册和
        switch ($exp_type_id)
        {
            CASE Base_UserLevelModel::EXP_TYPE_REG:
                //注册只可以触发一次
                if ($User_ExpHistoryModel->findKey(array('user_id'=>$user_id, 'exp_type_id'=>$exp_type_id)))
                {
                    return false;
                }

                break;
            CASE Base_UserLevelModel::EXP_TYPE_LOGIN:
                //登录，每天只可以触发一次
                if ($User_ExpHistoryModel->findKey(array('user_id'=>$user_id, 'exp_type_id'=>$exp_type_id, 'exp_log_date'=>$date)))
                {
                    return false;
                }

                break;
            CASE Base_UserLevelModel::EXP_TYPE_EVALUATE_PRODUCT:
                break;
            CASE Base_UserLevelModel::EXP_TYPE_EVALUATE_STORE:
                break;
            CASE Base_UserLevelModel::EXP_TYPE_CONSUME:
                break;
            CASE Base_UserLevelModel::EXP_TYPE_OTHER:
                break;
            CASE Base_UserLevelModel::EXP_TYPE_EXCHANGE_PRODUCT:
                break;
            CASE Base_UserLevelModel::EXP_TYPE_EXCHANGE_VOUCHER:
                break;
            default:
                $exp_kind_id = 2;
                break;
        }

        if ($exp > 0)
        {
            $exp_kind_id = 1;
        }
        else
        {
            $exp_kind_id = 2;
        }

        $data['exp_kind_id']         = $exp_kind_id                               ; // 类型(ENUM):1-获取积分;2-消费积分;


        $data['exp_type_id']         = $exp_type_id             ; // 积分类型(ENUM):1-会员注册;2-会员登录;3-商品评论;4-购买商品;5-管理员操作;7-积分换购商品;8-积分兑换优惠券
        $data['user_id']                = $user_id                        ; // 会员编号
        $data['exp_log_value']      = max(intval($exp), 1)          ; // 改变积分值
        $data['exp_log_desc']        = $desc             ; // 描述
        $data['exp_log_time']        = get_datetime()            ; // 积分日期
        $data['exp_log_date']        = get_date()             ; // 积分日期

        $exp_log_id = $User_ExpHistoryModel->addExp($data, true);

        return $exp_log_id ? $exp_log_id : false;
    }
}
?>

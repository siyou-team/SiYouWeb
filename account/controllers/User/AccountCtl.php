<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class User_AccountCtl extends AccountController
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
        $this->profile();
    }

    
    /**
     * 用户基本信息管理界面
     *
     * @access public
     */
    public function profile()
    {
        $rs = array('member_info'=>array());
    
        $user_id = Zero_Perm::getUserId();
        $rs['base'] = Zero_Perm::getUserRow();
    
        //用户信息
        $User_InfoModel = User_InfoModel::getInstance();
        $user_info_row = $User_InfoModel->getOne(Zero_Perm::getUserId());
    
    
        //用户等级
        $Base_UserLevelModel = Base_UserLevelModel::getInstance();
    
        if ($user_info_row['user_level_id'])
        {
            $user_level_row = $Base_UserLevelModel->getOne($user_info_row['user_level_id']);
        }
    
        //用户收藏
    
        $favorites_store = User_FavoritesStoreModel::getInstance()->getNum(array('user_id'=>$user_id));
        $favorites_goods = User_FavoritesItemModel::getInstance()->getNum(array('user_id'=>$user_id));
    
        $rs['member_info'] = $user_info_row;
        $rs['member_info']['user_nickname'] = $rs['base']['user_nickname'];
        $rs['member_info']['user_level_name'] = isset($user_level_row['user_level_name']) ? $user_level_row['user_level_name'] : __('V1');
        $rs['member_info']['favorites_store'] = $favorites_store;
        $rs['member_info']['favorites_goods'] = $favorites_goods;

        //读取用户身份
        //
        $user_role_row = Distribution_UserModel::getInstance()->getOne($user_id);
        $user_role_row['user_role_name'] = ($user_role_row['user_is_sp'] ? '服务商' : '') . ($user_role_row['user_is_da'] ? '区代理' : '') . ($user_role_row['user_is_ca'] ? '市代理' : '') ;
        $rs['user_role'] = $user_role_row;


        $this->setMet('index');
        $this->render('user', $rs);
    }
    
    /**
     * 用户基本信息管理界面
     *
     * @access public
     */
    public function settings()
    {
        $this->render('user');
    }
    
    /**
     * 用户消息
     *
     * @access public
     */
    public function message()
    {
        $this->render('user');
    }

    public function edit()
    {
        $data['user_id']                = Zero_Perm::getUserId()                    ; // 用户ID
        
        if (s('user_nickname'))
        {
            $data['user_nickname']           = s('user_nickname')               ; // 用户名
        }
        
        $data['user_gender']            = i('user_gender')                ; // 性别:1-男;  2-女;
        $data['user_realname']          = s('user_realname')              ; // 真实姓名
        //$data['user_mobile']            = s('user_mobile')                ; // 手机号码
        //$data['user_qq']                = s('user_qq')                    ; // QQ

        if (s('user_avatar'))
        {
            $user_avatar_row = explode('?', s('user_avatar'));
            $data['user_avatar'] = $user_avatar_row[0];
    
            $data['user_avatar'] = $data['user_avatar'] . '?t=' . rand();
        }
        
        if (s('user_idcard'))
        {
            $data['user_idcard']          = s('user_idcard')              ;
        }

        if (s('user_birthday'))
        {
            $data['user_birthday']          = s('user_birthday')              ;
        }
    
        if (s('user_sign'))
        {
            $data['user_sign']          = s('user_sign')              ;
        }
    
        if (s('user_email'))
        {
            $data['user_email']          = s('user_email')              ;
        }
        
        
        //todo 验证码问题。
        if ($user_mobile = s('user_mobile') && $code= s('code'))
        {
            $verification_code_flag = Zero_VerifyCode::checkCode($user_mobile, $code);
            
            if (!$verification_code_flag)
            {
                throw new Exception(__('手机验证码输入不正确！'));
            }
            
            $data['user_mobile']            = $user_mobile;
        }

        
        $user_id = $data['user_id'];
        $data_rs = $data;
        unset($data['user_id']);

        //权限判断
        $flag = User_InfoModel::getInstance()->editAccount($user_id, $data);

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
    
    public function sign()
    {
        $data['user_id']                = Zero_Perm::getUserId()                    ; // 用户ID
        $data['user_sign']          = s('user_sign')              ;
       
        $user_id = $data['user_id'];
        $data_rs = $data;
        unset($data['user_id']);
        
        //权限判断
        
        $flag = User_InfoModel::getInstance()->editAccount($user_id, $data);
        
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


    public function upgrade()
    {
        $user_id                = Zero_Perm::getUserId()                    ; // 用户ID
        $role          = s('role')              ;
    
        
        if ('sp' == $role)
        {
            //判断是否已经升级完成。
            $parent_user_role_row = Distribution_UserModel::getInstance()->getOne($user_id);
    
            if ($parent_user_role_row && $parent_user_role_row['user_is_sp'])
            {
                throw new Zero_Exception_Db(__('已经升级为服务商!'));
            }
            
            //扣款
            $need_user_money =  Base_ConfigModel::getConfig('reg_sp_fee');
            $waiting_payment_amount = $need_user_money;
    
            if (@$flag || true)
            {
                $time = time();
        
                $user_resource_row = User_ResourceModel::getInstance()->getOne($user_id);
                $user_money = $user_resource_row['user_money'];
        
                //不创建订单，只记录流水
                $Consume_TradeModel = Consume_TradeModel::getInstance();
    
                //分红订单id
                $type_code = 'UP';
                $order_id  = Number_SeqModel::getInstance()->createNextSeq(sprintf('%s-%s-', $type_code, date('Ymd')));
                
                //
                //写入流水
                $consume_record_rows = array();
                $seller_consume_record_rows = array();
        
                $consume_record_row = array();
                $consume_record_row['order_id'] = $order_id;
                $consume_record_row['user_id']  = $user_id;
                $consume_record_row['user_nickname']  = Zero_Perm::$row['user_nickname'];
                $consume_record_row['record_date']  = date('Y-m-d', $time);
        
                $consume_record_row['record_year']  = date('Y', $time);
                $consume_record_row['record_month']  = date('n', $time);
                $consume_record_row['record_day']  = date('j', $time);
        
                $consume_record_row['record_title']  = sprintf(__('服务商升级 %s'), $order_id);
                //$consume_record_row['record_desc']  = $trade_row['trade_title'];
                $consume_record_row['record_time']  = date('Y-m-d H:i:s', $time);
        
        
                $trade_data = array();
                $resource_data = array();
                $seller_resource_data = array();

                $order_points_add = $waiting_payment_amount;

                //余额支付
                if ($user_money>=$waiting_payment_amount && $waiting_payment_amount>0)
                {
                    $consume_record_row['payment_met_id']  = PaymentModel::PAYMENT_MET_MONEY;
            
                    //订单支付完成
                    if ($user_money >= $waiting_payment_amount)
                    {

                        $resource_data['user_money'] = - $waiting_payment_amount;
                
                        //扣除流水
                        $consume_record_row['record_money']  = -$waiting_payment_amount;
                
                        //订单支付完成
                        $user_money = $user_money - $waiting_payment_amount;
                        $waiting_payment_amount = 0;
                
                    }
                    else
                    {
                        
                        throw new Zero_Exception_Db(sprintf(__('余额不足 %s 元，请先充值后再升级服务商!'), $waiting_payment_amount));
                    }
            
                    $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_BUY_SP;
                    $consume_record_row['user_id']  = $user_id;
                    $consume_record_row['user_nickname']  = @$user_nickname;
                    $consume_record_rows[] = $consume_record_row;
    
    
                    User_ResourceModel::getInstance()->sql->startTransactionDb();
                    
                    //买家数据
                    if ($consume_record_rows)
                    {
                        $flag_row[] = Consume_RecordModel::getInstance()->add($consume_record_rows);
                    }
            
                    $flag_row[] = User_ResourceModel::getInstance()->edit($user_id, $resource_data, true); //where
    
    
                    //修改状态
                    if ($user_role_row = Distribution_UserModel::getInstance()->getOne($user_id))
                    {
                        $flag_row[] = Distribution_UserModel::getInstance()->edit($user_id, array('user_is_sp'=>1), null, array('user_is_sp'=>0));
                    }
                    else
                    {
                        $flag_row[] = Distribution_UserModel::getInstance()->add(array('user_id'=>$user_id, 'user_is_sp'=>1));
                    }
    
                    
                    //获取金宝
                    $chang_bp =  Base_ConfigModel::getConfig('reg_sp_bp');
                    $flag_row[] = User_ResourceModel::bp($user_id, $chang_bp, BpTypeModel::BP_TYPE_AGENT_GIFT);
    
    
    
                    //赠送积分
                    $order_points_add =  $order_points_add * Base_ConfigModel::getConfig('points_gift_rate', 1);
                    $flag_row[] = User_ResourceModel::points($user_id, $order_points_add, PointsTypeModel::POINTS_TYPE_UP_SP, sprintf(__('升级服务商赠送积分 %s'), $order_points_add));
                    
                    //上级获得推荐奖励  商家推荐奖
                    
                    
                    //判断用户是否有上级。
                    $dist_user_row = Distribution_PlantformUserModel::getInstance()->getOne($user_id);
                    
                    if ($dist_user_row)
                    {
                        //判断上级是否为服务商
                        $parent_user_role_row = Distribution_UserModel::getInstance()->getOne($dist_user_row['user_parent_id']);
    
                        if ($parent_user_role_row && $parent_user_role_row['user_is_sp'])
                        {
                            //$zs_seller_prize =  Base_ConfigModel::getConfig('zs_seller_prize');
                            $zs_sp_prize =  Base_ConfigModel::getConfig('zs_sp_prize') * $need_user_money / 100;
    
                            $user_order_row = array();
                            $user_order_row['buyer_user_id']          = $user_id ; // 用户编号
                            $user_order_row['user_id']                = $dist_user_row['user_parent_id'] ; // 用户编号
                            $user_order_row['order_id']               = $user_id                   ; // 订单编号
    
                            //！！！！！！！！！！！分成比例为平台佣金再按照设定分成。
                            $user_order_row['uo_buy_commission']      = 0;
                            //服务商获得佣金
                            $user_order_row['uo_directseller_commission'] = $zs_sp_prize; // 销售员佣金
    
    
                            $user_order_row['uo_level']               = 52                   ; // 等级:51-推荐商家奖励;52-推荐服务商奖励
                            $user_order_row['uo_time']                = time()               ; // 时间
                            $user_order_row['uo_active']              = 1                  ; // 是否有效(BOOL):0-未生效;1-有效
    
                            $flag_row[] = Distribution_UserOrderModel::getInstance()->add($user_order_row);
    
    
                            //推广员获取佣金
                            $user_commission_row = array();
                            $user_commission_row['commission_amount'] = $zs_sp_prize;
                            $user_commission_row['commission_directseller_amount_0'] = $zs_sp_prize;
    
                            $flag_row[] = Distribution_UserCommissionModel::getInstance()->editInc($user_order_row['user_id'], $user_commission_row);
                        }
                    }
                    
                    
                    //执行结算操作
                    if (is_ok($flag_row) && User_ResourceModel::getInstance()->sql->commitDb())
                    {
                        //
                        $msg = __('操作成功');
                        $status = 200;
                    }
                    else
                    {
                        User_ResourceModel::getInstance()->sql->rollBackDb();
        

                        $msg = __('操作失败');
                        $status = 250;
                    }
                }
                else
                {
    
                    $msg = sprintf(__('余额不足 %s 元，请先充值后再升级服务商!'), $waiting_payment_amount);
                    $status = 250;
                }
            }
            else
            {
                throw new Zero_Exception_Db(__('支付密码有误!'));
            }
    
    
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }
        
        $this->render('user', array(), $msg, $status);
    }

}
?>
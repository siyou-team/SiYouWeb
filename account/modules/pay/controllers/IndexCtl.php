<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class IndexCtl extends PayController
{
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);
    
        Zero_Perm::checkLogin();
    }
    
    public function index()
    {
        $this->setMet('consumeTradeIndex');
        $this->consumeTradeIndex();
    }
    
    /**
     * 获取可用的支付方式
     *
     * @access public
     */
    public function payType()
    {
        $data = Payment_TypeModel::getInstance()->getLists(array('payment_type_enable' => 1), array('payment_type_order' => 'ASC'));
        
        $this->render('pay', $data);
    }
    
    
    /**
     * 获取具体订单支付时候可用的支付渠道， 如果为直接支付，不可以多店铺下单
     *
     * @access public
     */
    public function payLists()
    {
        
        $data['pay_info'] = array();
        
        $user_id      = Zero_Perm::getUserId();
        $resource_row = User_ResourceModel::getInstance()->getOne($user_id);
        

        //判断功能是否开启
        $data['pay_info']['user_money']         = 0;
        $data['pay_info']['user_recharge_card'] = 0;
        $data['pay_info']['user_credit']        = 0;
        $data['pay_info']['user_points']        = 0;

        $order_ids                  = s('pay_sn', s('order_id'));
        $data['pay_info']['pay_sn'] = $order_ids;
        
        //值传递一个参数时$order_ids时以0为键的数组。
        if (is_array($order_ids))
        {
            $order_id_rows = $order_ids;
        }
        else
        {
            $order_id_rows = explode(',', $order_ids);
        }
        //读取订单信息
        
        
        $data['pay_info']['is_pay_passwd'] = 0;
        $user_pay_row                      = User_PayModel::getInstance()->getOne($user_id);
        
        if ($user_pay_row)
        {
            $data['pay_info']['is_pay_passwd'] = 1;
        }
        
        
        //支付信息
        $Consume_TradeModel = Consume_TradeModel::getInstance();
        
        
        $consume_trade_rows = $Consume_TradeModel->find(array('order_id' => $order_id_rows));
        
        $data['pay_info']['pay_amount']   = array_sum(array_column($consume_trade_rows, 'trade_payment_amount'));
        $data['pay_info']['payed_amount'] = array_sum(array_column($consume_trade_rows, 'trade_payment_money')) + array_sum(array_column($consume_trade_rows, 'trade_payment_recharge_card')) + array_sum(array_column($consume_trade_rows, 'trade_payment_points')) + array_sum(array_column($consume_trade_rows, 'trade_payment_credit')) + array_sum(array_column($consume_trade_rows, 'trade_payment_redpack'));;
        
        $Payment_ChannelModel = Payment_ChannelModel::getInstance();
        
        $where_row = array();
        
        if (i('payment_type_id'))
        {
            //获取余额支付和其他渠道的支付方式
            $where_row['payment_type_id'] = array(
                i('payment_type_id'),
                0
            );
        }
        
        $where_row['payment_channel_enable'] = 1;
        $where_row['payment_type_id']        = StateCode::PAYMENT_TYPE_ONLINE;
        
        //判断是门店 店铺 平台
        if (Base_ConfigModel::getTradeModePlantform())
        {
            $where_row['store_id']        = 0;
            $where_row['chain_id']        = 0;
        }
        else
        {
            //判断店铺或者门店ID
            $store_id_row = array_column_unique($consume_trade_rows, 'store_id');
            $chain_id_row = array_column_unique($consume_trade_rows, 'chain_id');
            
            if (count($store_id_row) == 1)
            {
                //固定死， 是门店收银还是店铺收银。， 统一店铺收银
                if (true)
                {
                    $where_row['store_id']        = current($store_id_row);
                    $where_row['chain_id']        = 0;
                }
                else
                {
                    if (count($chain_id_row) === 0)
                    {
                        throw new Exception(__('订单信息有误，门店信息不存在！'));
                        $where_row['store_id']        = current($store_id_row);
                        $where_row['chain_id']        = 0;
                    }
                    elseif (count($chain_id_row) === 1)
                    {
                        $where_row['store_id']        = 0;
                        $where_row['chain_id']        = current($chain_id_row);
                    }
                    else
                    {
                        throw new Exception(__('多门店订单不可以一次支付，请分开支付！'));
                    }
                }
            }
            else
            {
                throw new Exception(__('多店铺订单不可以一次支付，请分开支付！'));
            }
        }
        
        
        $data['pay_info']['payment_list'] = array_values($Payment_ChannelModel->find($where_row));
        
        
        foreach ($data['pay_info']['payment_list'] as $key=>$payment)
        {
            if ('money' == $payment['payment_channel_code'])
            {
                if ($payment['payment_channel_enable'])
                {
                    $data['pay_info']['user_money'] = $resource_row['user_money'];
                }
            }
            
            if ('recharge_card' == $payment['payment_channel_code'])
            {
                if ($payment['payment_channel_enable'])
                {
                    $data['pay_info']['user_recharge_card'] = $resource_row['user_recharge_card'];
                }
            }
            
            if ('credit' == $payment['payment_channel_code'])
            {
                if ($payment['payment_channel_enable'])
                {
                    $data['pay_info']['user_credit'] = $resource_row['user_credit'];
                }
            }

            if ('points' == $payment['payment_channel_code'])
            {
                if ($payment['payment_channel_enable'])
                {
                    $data['pay_info']['user_points'] = $resource_row['user_points'];
                    $data['pay_info']['user_points_money'] = $resource_row['user_points'] * Base_ConfigModel::getConfig('points_vaue_rate', 100);
                }
            }
        }
        
        $this->render('pay', $data);
    }

    /**
     * 快捷充值
     *
     * @access public
     */
    public function rechargePage()
    {
        $id = i("id");
        $data = array();

        $data["header-title"] = __("充值");
        $this->render('pay', $data);
    }
    
    /**
     * 充值
     *
     * @access public
     */
    public function rechargeManage()
    {
        $this->render('pay', array());
    }
    
    /**
     * 充值
     *
     * @access public
     */
    public function recharge()
    {
        $type_code = StateCode::getCode(StateCode::TRADE_TYPE_DEPOSIT);
        $order_id  = Number_SeqModel::getInstance()->createNextSeq(sprintf('%s-%s-', $type_code, date('Ymd')));
        
        //或者通过API
        $consume_trade_row['order_id']                    = $order_id; // 商户订单id
        $consume_trade_row['buyer_id']                    = Zero_Perm::getUserId(); // 买家id
        $consume_trade_row['seller_id']                   = 0; // 卖家id
        $consume_trade_row['store_id']                    = 0; // 卖家id
        $consume_trade_row['order_state_id']              = StateCode::ORDER_STATE_WAIT_PAY; // 订单状态
        $consume_trade_row['trade_is_paid']               = StateCode::ORDER_PAID_STATE_NO; // 未支付
        $consume_trade_row['trade_type_id']               = StateCode::TRADE_TYPE_DEPOSIT; // 交易类型
        $consume_trade_row['payment_channel_id']          = 0; // 支付渠道
        $consume_trade_row['app_id']                      = 0; // app_id
        $consume_trade_row['server_id']                   = 0; // 服务器id
        $consume_trade_row['trade_mode_id']               = 1; // 交易类型:1-担保交易;  2-直接交易
        $consume_trade_row['order_payment_amount']        = f('pdr_amount'); // 总付款额度: trade_payment_amount + trade_payment_money + trade_payment_recharge_card + trade_payment_points
        $consume_trade_row['trade_payment_amount']        = f('pdr_amount'); // 实付金额:在线支付金额
        $consume_trade_row['trade_payment_money']         = 0; // 余额支付
        $consume_trade_row['trade_payment_recharge_card'] = 0; // 充值卡余额支付
        $consume_trade_row['trade_payment_points']        = 0; // 积分支付
        $consume_trade_row['trade_payment_credit']        = 0; // 信用支付
        $consume_trade_row['trade_payment_redpack']       = 0; // 红包支付
        $consume_trade_row['trade_discount']              = 0; // 折扣优惠
        $consume_trade_row['trade_amount']                = f('pdr_amount'); // 总额虚拟:trade_order_amount + trade_discount
        $consume_trade_row['trade_date']                  = date('Y-m-d'); // 年-月-日
        $consume_trade_row['trade_year']                  = date('Y'); // 年
        $consume_trade_row['trade_month']                 = date('n'); // 月
        $consume_trade_row['trade_day']                   = date('j'); // 日
        $consume_trade_row['trade_title']                 = '充值'; // 标题
        
        $Consume_TradeModel = Consume_TradeModel::getInstance();
        $flag               = $Consume_TradeModel->add($consume_trade_row);
        
        if ($flag)
        {
            $msg    = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg    = __('操作失败');
            $status = 250;
        }
        
        $data['pay_sn'] = $order_id;
        $this->render('pay', $data, $msg, $status);
    }

    /**
     * 充值套餐
     *
     * @access public
     */
    public function rechargeByLevel()
    {
        $type_code = StateCode::getCode(StateCode::TRADE_TYPE_DEPOSIT);
        $order_id  = Number_SeqModel::getInstance()->createNextSeq(sprintf('%s-%s-', $type_code, date('Ymd')));

        $recharge_level_id = i('recharge_level_id');


        $recharge_level_row = Base_RechargeLevelModel::getInstance()->getOne($recharge_level_id);

        $pdr_amount = $recharge_level_row['recharge_level_value'];

        //或者通过API
        $consume_trade_row['order_id']                    = $order_id; // 商户订单id
        $consume_trade_row['buyer_id']                    = Zero_Perm::getUserId(); // 买家id
        $consume_trade_row['seller_id']                   = 0; // 卖家id
        $consume_trade_row['store_id']                    = 0; // 卖家id
        $consume_trade_row['order_state_id']              = StateCode::ORDER_STATE_WAIT_PAY; // 订单状态
        $consume_trade_row['trade_is_paid']               = StateCode::ORDER_PAID_STATE_NO; // 未支付
        $consume_trade_row['trade_type_id']               = StateCode::TRADE_TYPE_DEPOSIT; // 交易类型
        $consume_trade_row['payment_channel_id']          = 0; // 支付渠道
        $consume_trade_row['app_id']                      = 0; // app_id
        $consume_trade_row['server_id']                   = 0; // 服务器id
        $consume_trade_row['trade_mode_id']               = 1; // 交易类型:1-担保交易;  2-直接交易
        $consume_trade_row['order_payment_amount']        = $pdr_amount; // 总付款额度: trade_payment_amount + trade_payment_money + trade_payment_recharge_card + trade_payment_points
        $consume_trade_row['trade_payment_amount']        = $pdr_amount; // 实付金额:在线支付金额
        $consume_trade_row['trade_payment_money']         = 0; // 余额支付
        $consume_trade_row['trade_payment_recharge_card'] = 0; // 充值卡余额支付
        $consume_trade_row['trade_payment_points']        = 0; // 积分支付
        $consume_trade_row['trade_payment_credit']        = 0; // 信用支付
        $consume_trade_row['trade_payment_redpack']       = 0; // 红包支付
        $consume_trade_row['trade_discount']              = 0; // 折扣优惠
        $consume_trade_row['trade_amount']                = $pdr_amount; // 总额虚拟:trade_order_amount + trade_discount
        $consume_trade_row['trade_date']                  = date('Y-m-d'); // 年-月-日
        $consume_trade_row['trade_year']                  = date('Y'); // 年
        $consume_trade_row['trade_month']                 = date('n'); // 月
        $consume_trade_row['trade_day']                   = date('j'); // 日
        $consume_trade_row['trade_title']                 = '预购充值'; // 标题

        $Consume_TradeModel = Consume_TradeModel::getInstance();
        $flag               = $Consume_TradeModel->add($consume_trade_row);

        if ($flag)
        {
            $msg    = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg    = __('操作失败');
            $status = 250;
        }

        $data['pay_sn'] = $order_id;
        $this->render('pay', $data, $msg, $status);
    }

    public function listRechargeLevel()
    {
        $data = Base_RechargeLevelModel::getInstance()->getLists(array(), array('recharge_level_value'=>'ASC'));
        $this->render('pay', $data);
    }
    /**
     * 线下买单
     *
     * @access public
     */
    public function favorable()
    {
        $store_id = i('store_id');
    
        //获取卖家
    
        //获取买家信息 $base_row['store_id']
        $epl_row = Store_EmployeeModel::getInstance()->findOne(array('store_id'=>$store_id, 'employee_is_admin'=>1));
    
        if ($epl_row)
        {
            $seller_id = $epl_row['user_id'];
        }
        else
        {
            throw new Exception(__('商家用户不存在'));
        }
        
        $type_code = StateCode::getCode(StateCode::TRADE_TYPE_FAVORABLE);
        $order_id  = Number_SeqModel::getInstance()->createNextSeq(sprintf('%s-%s-', $type_code, date('Ymd')));
    
        $pdr_amount = f('pdr_amount');
        $order_commission_fee = $pdr_amount * 0.15; //商品平台佣金。
        
        //或者通过API
        $consume_trade_row['order_id']                    = $order_id; // 商户订单id
        $consume_trade_row['buyer_id']                    = Zero_Perm::getUserId(); // 买家id
        $consume_trade_row['seller_id']                   = $seller_id; // 卖家id
        $consume_trade_row['store_id']                    = $store_id; // 卖家id
        $consume_trade_row['order_state_id']              = StateCode::ORDER_STATE_WAIT_PAY; // 订单状态
        $consume_trade_row['trade_is_paid']               = StateCode::ORDER_PAID_STATE_NO; // 未支付
        $consume_trade_row['trade_type_id']               = StateCode::TRADE_TYPE_FAVORABLE; // 交易类型
        $consume_trade_row['payment_channel_id']          = 0; // 支付渠道
        $consume_trade_row['app_id']                      = 0; // app_id
        $consume_trade_row['server_id']                   = 0; // 服务器id
        $consume_trade_row['trade_mode_id']               = 1; // 交易类型:1-担保交易;  2-直接交易
        $consume_trade_row['order_payment_amount']        = $pdr_amount; // 总付款额度: trade_payment_amount + trade_payment_money + trade_payment_recharge_card + trade_payment_points
        $consume_trade_row['trade_payment_amount']        = $pdr_amount; // 实付金额:在线支付金额
        $consume_trade_row['order_commission_fee']        = $order_commission_fee; //
        $consume_trade_row['trade_payment_money']         = 0; // 余额支付
        $consume_trade_row['trade_payment_recharge_card'] = 0; // 充值卡余额支付
        $consume_trade_row['trade_payment_points']        = 0; // 积分支付
        $consume_trade_row['trade_payment_credit']        = 0; // 信用支付
        $consume_trade_row['trade_payment_redpack']       = 0; // 红包支付
        $consume_trade_row['trade_discount']              = 0; // 折扣优惠
        $consume_trade_row['trade_amount']                = $pdr_amount; // 总额虚拟:trade_order_amount + trade_discount
        $consume_trade_row['trade_date']                  = date('Y-m-d'); // 年-月-日
        $consume_trade_row['trade_year']                  = date('Y'); // 年
        $consume_trade_row['trade_month']                 = date('n'); // 月
        $consume_trade_row['trade_day']                   = date('j'); // 日
        $consume_trade_row['trade_title']                 = __('线下付款'); // 标题
        
        $Consume_TradeModel = Consume_TradeModel::getInstance();
        $flag               = $Consume_TradeModel->add($consume_trade_row);
        
        if ($flag)
        {
            $msg    = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg    = __('操作失败');
            $status = 250;
        }
        
        $data['pay_sn'] = $order_id;
        $this->render('pay', $data, $msg, $status);
    }
    
    
    /**
     * 线下买单
     *
     * @access public
     */
    public function other()
    {
        $store_id = i('store_id');
    
        //获取卖家
    
        //获取买家信息 $base_row['store_id']
        $epl_row = Store_EmployeeModel::getInstance()->findOne(array('store_id'=>$store_id, 'employee_is_admin'=>1));
    
        if ($epl_row)
        {
            $seller_id = $epl_row['user_id'];
        }
        else
        {
            throw new Exception(__('商家用户不存在'));
        }
    
        $type_code = StateCode::getCode(StateCode::TRADE_TYPE_FAVORABLE);
        $order_id  = Number_SeqModel::getInstance()->createNextSeq(sprintf('%s-%s-', $type_code, date('Ymd')));
    
        //或者通过API
        $consume_trade_row['order_id']                    = $order_id; // 商户订单id
        $consume_trade_row['buyer_id']                    = Zero_Perm::getUserId(); // 买家id
        $consume_trade_row['seller_id']                   = $seller_id; // 卖家id
        $consume_trade_row['store_id']                    = $store_id; // 卖家id
        $consume_trade_row['order_state_id']              = StateCode::ORDER_STATE_WAIT_PAY; // 订单状态
        $consume_trade_row['trade_is_paid']               = StateCode::ORDER_PAID_STATE_NO; // 未支付
        $consume_trade_row['trade_type_id']               = StateCode::TRADE_TYPE_FAVORABLE; // 交易类型
        $consume_trade_row['payment_channel_id']          = 0; // 支付渠道
        $consume_trade_row['app_id']                      = 0; // app_id
        $consume_trade_row['server_id']                   = 0; // 服务器id
        $consume_trade_row['trade_mode_id']               = 1; // 交易类型:1-担保交易;  2-直接交易
        $consume_trade_row['order_payment_amount']        = f('pdr_amount'); // 总付款额度: trade_payment_amount + trade_payment_money + trade_payment_recharge_card + trade_payment_points
        $consume_trade_row['trade_payment_amount']        = f('pdr_amount'); // 实付金额:在线支付金额
        $consume_trade_row['trade_payment_money']         = 0; // 余额支付
        $consume_trade_row['trade_payment_recharge_card'] = 0; // 充值卡余额支付
        $consume_trade_row['trade_payment_points']        = 0; // 积分支付
        $consume_trade_row['trade_payment_credit']        = 0; // 信用支付
        $consume_trade_row['trade_payment_redpack']       = 0; // 红包支付
        $consume_trade_row['trade_discount']              = 0; // 折扣优惠
        $consume_trade_row['trade_amount']                = f('pdr_amount'); // 总额虚拟:trade_order_amount + trade_discount
        $consume_trade_row['trade_date']                  = date('Y-m-d'); // 年-月-日
        $consume_trade_row['trade_year']                  = date('Y'); // 年
        $consume_trade_row['trade_month']                 = date('n'); // 月
        $consume_trade_row['trade_day']                   = date('j'); // 日
        $consume_trade_row['trade_title']                 = __('线下付款'); // 标题
    
        $Consume_TradeModel = Consume_TradeModel::getInstance();
        $flag               = $Consume_TradeModel->add($consume_trade_row);
    
        if ($flag)
        {
            $msg    = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg    = __('操作失败');
            $status = 250;
        }
    
        $data['pay_sn'] = $order_id;
        $this->render('pay', $data, $msg, $status);
    }
    
    
    /**
     * 确认支付页面
     */
    public function confirmPay()
    {
        $data = array();
        $this->render('pay', $data);
    }
    
    /**
     * 检测支付密码接口
     */
    public function checkPayPasswd()
    {
        $password = s('password');
        $user_id  = Zero_Perm::getUserId();
        
        $msg = '';
        
        $flag = User_PayModel::getInstance()->checkPayPasswd($user_id, $password, $msg);
        
        if ($flag)
        {
            $msg    = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg    = $msg;
            $status = 250;
        }
        
        $this->render('pay', array(), $msg, $status);
    }
    
    /**
     * 获取支付密码
     * @param boolean $render 是否RESTFUL API风格进行返回
     * @access public
     * @return render|array
     */
    public function getPayPasswd($render = true)
    {
        $user_id = Zero_Perm::getUserId();
        
        $user_pay_row = User_PayModel::getInstance()->getOne($user_id);
        
        if (!$render)
        {
            if ($user_pay_row)
            {
                return array('isSet' => 1);
            }
            return array('isSet' => 0);
        }
        
        if ($user_pay_row)
        {
            $msg    = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg    = __('未设置支付密码');
            $status = 250;
        }
        
        $this->render('pay', array(), $msg, $status);
    }
    
    
    /**
     * 重置密码接口
     */
    public function resetPayPassword()
    {
        $password = s('password');
        $user_id  = Zero_Perm::getUserId();
        
        $user_pay_row = User_PayModel::getInstance()->getOne($user_id);
        
        if (@$user_pay_row['user_pay_salt'])
        {
            $user_salt = $user_pay_row['user_pay_salt'];
        }
        else
        {
            $user_salt = uniqid(rand());
        }
        
        $salt_password = md5($user_salt . md5($password));
        
        $data['user_pay_salt']   = $user_salt;
        $data['user_pay_passwd'] = $salt_password;
        $data['user_id']         = $user_id;
        
        $flag = User_PayModel::getInstance()->save($data);
        
        if ($flag !== false)
        {
            $msg    = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg    = __('修改支付密码错误');
            $status = 250;
        }
        
        $this->render('pay', array(), $msg, $status);
    }
    
    /**
     * 根据旧密码修改支付密码
     */
    public function changePayPassword()
    {
        $old_password = s('old_pay_password');
        $password = s('new_pay_password');
        
        $user_id  = Zero_Perm::getUserId();
        
        $user_pay_row = User_PayModel::getInstance()->getOne($user_id);
        

        if (@$user_pay_row['user_pay_salt'])
        {
            $user_salt = $user_pay_row['user_pay_salt'];
            //判断旧密码是否正确
    
            $salt_password = md5($user_salt . md5($old_password));
            
            if ($salt_password != $user_pay_row['user_pay_passwd'])
            {
                throw  new Exception(__('原支付密码不正确！'));
            }
        }
        else
        {
            $user_salt = uniqid(rand());
        }
        
        $salt_password = md5($user_salt . md5($password));
        
        $data['user_pay_salt']   = $user_salt;
        $data['user_pay_passwd'] = $salt_password;
        $data['user_id']         = $user_id;
        
        $flag = User_PayModel::getInstance()->save($data);
        
        if ($flag !== false)
        {
            $msg    = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg    = __('修改支付密码错误');
            $status = 250;
        }
        
        $this->render('pay', array(), $msg, $status);
    }

    public function managePayPassword()
    {
        $data = $this->getPayPasswd(false);
        $this->render('user', $data);
    }
    
     /**
     * 支付操作
     *
     * @access public
     */
    public function pay()
    {   
        $user_id = Zero_Perm::getUserId();
        
        //相应支付额度。
        //todo 在线支付前修正最终数据。
        $trade_payment_money         = f('pm_money');   //选中余额支付方式
        $trade_payment_recharge_card = f('pm_recharge_card'); //选中充值卡支付方式
        
        $trade_payment_points  = f('pm_points');
        $trade_payment_credit  = f('pm_credit');
        $trade_payment_redpack = f('pm_redpack');
        
        
        $order_id_str = s('pay_sn', s('order_id'));
        $order_id_row       = explode(',', $order_id_str);
        Order_BaseModel::getInstance()->setPaidYes($order_id_row);

        $jump_url = sprintf('%s/shop/api/order_proxy.php?order_id=%s', $registry['base_url'], $order_id);

        $payment_channel_code = s('payment_channel_code');
        
        //todo $payment_channel_code 是否启用
        if (!$payment_channel_code)
        {
            $payment_channel_id   = i('payment_channel_id');
            
            if ($payment_channel_row  = Payment_ChannelModel::getInstance()->getOne($payment_channel_id))
            {
                $payment_channel_code = $payment_channel_row['payment_channel_code'];
            }
        }

    
        $Consume_TradeModel = new Consume_TradeModel();
        $trade_rows         = $Consume_TradeModel->find(array('order_id' => $order_id_row));
        
    
        //基于安全考虑，检测支付模式及数据
        //判断是门店 店铺 平台
        if (Base_ConfigModel::getTradeModePlantform())
        {
            $payment_store_id        = 0;
            $payment_chain_id        = 0;
        }
        else
        {
            //不可以联合支付。
            if (count($order_id_row) > 1)
            {
                throw new Exception(__('多订单不可以一次支付，请分开支付！'));
            }
        
            //获取店铺数据检测
            $trade_row_tmp = current($trade_rows);
    
            //固定死， 是门店收银还是店铺收银。， 统一店铺收银
            if (true)
            {
                $payment_store_id        = $trade_row_tmp['store_id'];
                $payment_chain_id        = 0;
            }
            else
            {
                $payment_store_id        = 0;
                $payment_chain_id        = $trade_row_tmp['chain_id'];;
            }
        }

        //待支付额度
        $trade_payment_amount = array_sum(array_column($trade_rows, 'trade_payment_amount'));
        
        $trade_payment_amount=0;

        if ($trade_payment_amount > 0)
        {
            if ($trade_payment_money || $trade_payment_recharge_card || $trade_payment_points || $trade_payment_credit || $trade_payment_redpack)
            {
                //计算支付额度， 顺序按照  $trade_payment_recharge_card  < $trade_payment_money <   $trade_payment_redpack  < trade_payment_points < $trade_payment_credit

                //判断支付密码
                $password = s('password');

                $msg  = '';
                $flag = User_PayModel::getInstance()->checkPayPasswd($user_id, $password, $msg);

                if ($flag)
                {
                    //开启事务
                    $Consume_TradeModel->sql->startTransactionDb();

                    $flag = $Consume_TradeModel->processOfflinePay($trade_rows, $trade_payment_money, $trade_payment_recharge_card, $trade_payment_points, $trade_payment_credit, $trade_payment_redpack);
                    
                    //重新加载数据
                    if ($flag && $Consume_TradeModel->sql->commitDb())
                    {
                        $trade_rows = $Consume_TradeModel->find(array('order_id' => $order_id_row));
                    }
                    else
                    {
                        //错误，则在线支付
                        $Consume_TradeModel->sql->rollBackDb();
                    }
                }
                else
                {
                }
            }
            //StateCode::ORDER_PAID_STATE_YES
            /*
            if (1 != $this->order['order_state_id'])
            {
                throw new Exception('订单状态不为待付款状态');
            }
            */

            $trade_row['trade_is_paid'] = in_array(StateCode::ORDER_PAID_STATE_YES, array_column_unique($trade_rows, 'trade_is_paid')) ? StateCode::ORDER_PAID_STATE_YES : StateCode::ORDER_PAID_STATE_NO;



            $trade_order_id_row = array_column_unique($trade_rows, 'order_id');

            if (count($trade_order_id_row) > 1)
            {
                //生成联合支付
                $consume_trade_combine_row = array();
                $consume_trade_combine_row['order_ids'] = $trade_order_id_row;

                $Consume_TradeCombineModel = Consume_TradeCombineModel::getInstance();

                $trade_row['order_id']    = $Consume_TradeCombineModel->addTradeCombine($consume_trade_combine_row, true);

                if (!$trade_row['order_id'])
                {
                    throw new Exception(__('联合支付订单好有误！'));
                }
            }
            else
            {
                $trade_row['order_id']    = implode(',', $trade_order_id_row);
            }


            $trade_row['trade_title'] = implode(',', array_column_unique($trade_rows, 'trade_title'));

            //付款金额
            $trade_row['trade_payment_amount'] = array_sum(array_column($trade_rows, 'trade_payment_amount'));

            $trade_row['quantity'] = 1;

            $trade_row['jump_url'] = ''; //构造不同的地址，WAP和PC，不同终端可能不一致
  
            //取消的不给支付
            if ($trade_row['trade_payment_amount'] > 0)
            {
                if ($trade_row && $trade_row['trade_payment_amount'] > 0 && !in_array(StateCode::ORDER_STATE_CANCEL, array_column($trade_rows, 'order_state_id')))
                {
                    $Payment = PaymentModel::create($payment_channel_code, $payment_store_id, $payment_chain_id);

                    $trade_row['trade_title'] = str_replace(array(' ', '+', '%40'), array('', '', ''), $trade_row['trade_title']);
                    $trade_row['trade_desc'] = str_replace(array(' ', '+', '%40'), array('', '', ''), @$trade_row['trade_desc']);

                    $trade_row['trade_title'] = __('在线购物');
                    $trade_row['trade_desc'] = __('在线购物');

                    if ($Payment)
                    {
                        //判断是预付还是直接支付。
                        if (i('prepay_flag'))
                        {
                            $js_api_parameters = $Payment->prePay($trade_row);
                            $js_api_parameters_row = json_decode($js_api_parameters);


                            $data = new Zero_Data();
                            $data->setError('', 0, $js_api_parameters_row, 200);
                            $d = $data->getDataRows();

                            $protocol_data = Zero_Data::encodeProtocolData($d);

                            if ($jsonp_callback = s('jsonp_callback'))
                            {
                                exit($jsonp_callback . '(' . $protocol_data . ')');
                            }
                            else
                            {
                                echo $protocol_data;
                            }

                            exit();
                        }
                        else
                        {
                            $Payment->pay($trade_row);
                        }

                        die();
                    }
                    else
                    {
                        $this->forward(__('错误的支付渠道'));
                    }
                }
                else
                {
                    $msg = __('待付款订单信息有误');
                }
            }
            else
            {

                if ('e' == $this->typ)
                {
                    $registry = Zero_Registry::getInstance();
                    $order_id = $order_id_row[0];
                    $jump_url = sprintf('%s/shop/api/order_proxy.php?order_id=%s', $registry['base_url'], $order_id);
    
                    /*
                    if (Zero_Utils_Device::isMobile())
                    {
                        $row = Order_InfoModel::getInstance()->getOne($order_id);
                        if (StateCode::PRODUCT_KIND_ENTITY == $row['kind_id'])
                        {
                            $jump_url = sprintf('%s/tmpl/member/order_detail.html?order_id=%s', $registry['wap_url'], $order_id);
                        }
                        else
                        {
                            $jump_url = sprintf('%s/tmpl/member/vr_order_detail.html?order_id=%s', $registry['wap_url'], $order_id);
                        }
                    }
                    else
                    {
                        $jump_url = urlh('index.php', 'User_Order', 'detail', '', '', array('order_id'=>$order_id));
                    }
                    */

                    $msg_str = <<<OEF
<script>
    if (window.opener)
    {
        window.opener.location.href = window.opener.SYS.URL.user.order_index.replace('json', 'e');
        window.close();
    }
    else
    {
        alert("{$msg}!");

        //支付成功，跳转到订单
        window.location.href = "{$jump_url}";
    }
</script>
OEF;
                }
                else
                {

                    $msg_str = $msg;
                }
            }
        }
        else
        {   

            $msg = __('支付成功！');

            if ('e' == $this->typ)
            {
                $registry = Zero_Registry::getInstance();
                $order_id = $order_id_row[0];
                $jump_url = sprintf('%s/shop/api/order_proxy.php?order_id=%s', $registry['base_url'], $order_id);
    
                /*
                if (Zero_Utils_Device::isMobile())
                {
                    $row = Order_InfoModel::getInstance()->getOne($order_id);
                    if (StateCode::PRODUCT_KIND_ENTITY == $row['kind_id'])
                    {
                        $jump_url = sprintf('%s/tmpl/member/order_detail.html?order_id=%s', $registry['wap_url'], $order_id);
                    }
                    else
                    {
                        $jump_url = sprintf('%s/tmpl/member/vr_order_detail.html?order_id=%s', $registry['wap_url'], $order_id);
                    }
                }
                else
                {
                    $jump_url = urlh('index.php', 'User_Order', 'detail', '', '', array('order_id'=>$order_id));
                }
                */

                $msg_str = <<<OEF
<script>
    if (window.opener)
    {
        window.opener.location.href = window.opener.SYS.URL.user.order_index.replace('json', 'e');
        window.close();
    }
    else
    {
        alert("{$msg}!");

        //支付成功，跳转到订单
        window.location.href = "{$jump_url}";
    }
</script>
OEF;
            }
            else
            {
                $msg_str = $msg;
            }
        }
        
        //$this->forward($msg);
        $this->showMsg($msg_str);
    }
    
    /*
    public function alipay()
    {
		$Consume_TradeModel = new Consume_TradeModel();
		$trade_row = $Consume_TradeModel->getOne('11');

		if ($trade_row)
		{
            $Payment = PaymentModel::create('alipay');
			$Payment->pay($trade_row);
		}
		else
		{

		}
    }

	public function wx()
	{
		$Consume_TradeModel = new Consume_TradeModel();
		$trade_row = $Consume_TradeModel->getOne('11321322');

		if ($trade_row)
		{
            $Payment = PaymentModel::create('wx_native');
			$Payment->pay($trade_row);
		}
		else
		{

		}
	}*/
    
    function payed(){
        $order_id           = s('order_id');

        $Consume_TradeModel = Consume_TradeModel::getInstance();
        $Consume_TradeModel->sql->startTransactionDb();
        $trade_row          = $Consume_TradeModel->findOne(array('order_id' => $order_id));

        if ( $trade_row && $trade_row['trade_payment_amount']*1 == 0){
             
            $flag_row[] = $Consume_TradeModel->edit( $trade_row['order_id'],array('trade_is_paid'=>StateCode::ORDER_PAID_STATE_YES));

            //本地服务器订单更改
            try
            {   
                $flag_row[] = Order_BaseModel::getInstance()->setPaidYes(array($trade_row['order_id']));

            }
            catch (Exception $e)
            {
                Zero_Log::log($e->getMessage(), Zero_Log::ERROR, 'pay_order_setPaidYes');
            }
        }

        if( is_ok( $flag_row) && $Consume_TradeModel->sql->commitDb() ){
             $msg = __('支付成功！');

            if ('e' == $this->typ)
            {
                $registry = Zero_Registry::getInstance();
                $order_id = $trade_row['order_id'];
                $jump_url = sprintf('%s/shop/api/order_proxy.php?order_id=%s', $registry['base_url'], $order_id);
                $msg_str = <<<OEF
<script>
    if (window.opener)
    {
        window.opener.location.href = window.opener.SYS.URL.user.order_index.replace('json', 'e');
        window.close();
    }
    else
    {
        alert("{$msg}!");

        //支付成功，跳转到订单
        window.location.href = "{$jump_url}";
    }
</script>
OEF;
            }
            else
            {
                $msg_str = $msg;
            }
        } else {
            $Consume_TradeModel->sql->rollBackDb();
            $$msg = __('支付失败！');
        }

        $this->showMsg($msg_str);
    }

    //PC 端 资源UI 和wap端的获取用户预存余额信息
    public function resourceIndex()
    {
        $user_id = Zero_Perm::getUserId();
        $data    = array();
        
        if ($user_id)
        {
            $data   = User_ResourceModel::getInstance()->getOne($user_id);
            
            //用户其它资源, 临时直接读取
            $sns_row = User_SnsModel::getInstance()->getOne($user_id);
            $data = $data + $sns_row;
            
            //佣金问题, 临时直接读取
            $user_commission = Distribution_UserCommissionModel::getInstance()->getOne($user_id);
            $data = $data + $user_commission;
    
            //可用佣金 = 历史总佣金 - 已结算
            $data['user_commission'] = floatval(@$data['commission_amount'] - @$data['commission_settled']);

            // 用户经验值
            $user_info_row = User_InfoModel::getInstance()->getOne($user_id);
            $data['user_growth'] = $user_info_row['user_exp_total'];
            
            //余额总数
            $data['user_amount'] = $data['user_money'] + $data['user_money_frozen'];

            $msg    = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg    = __('操作失败');
            $status = 250;
        }
        
        $this->render('pay', $data, $msg, $status);
    }
    
    public function resource()
    {
        $this->resourceIndex();
    }
    
    public function consumeRecord()
    {
        $user_id = Zero_Perm::getUserId();
        $data    = array();
        
        if ($user_id)
        {
            $sort = array('consume_record_id' => 'DESC');
            
            $rows = i('rows', i('iDisplayLength', 10)); //每页记录条数
            $page = i('page', max(1, ceil_r((i('iDisplayStart')+1) / $rows)));  //当前页码
            $column_row            = array();

            if ($trade_type_id = i('trade_type_id', 0))
            {
                $column_row['trade_type_id'] = $trade_type_id;
            }
            else
            {
                if ($change_type = i('change_type', 0))
                {
                    if ($change_type == 1)
                    {
                        $column_row['trade_type_id'] = array(StateCode::TRADE_TYPE_SHOPPING, StateCode::TRADE_TYPE_TRANSFER, StateCode::TRADE_TYPE_WITHDRAW, StateCode::TRADE_TYPE_REFUND_PAY, StateCode::TRADE_TYPE_COMMISSION_TRANSFER);
                    }
        
                    if ($change_type == 2)
                    {
                        $column_row['trade_type_id'] = array(StateCode::TRADE_TYPE_DEPOSIT, StateCode::TRADE_TYPE_SALES, StateCode::TRADE_TYPE_COMMISSION, StateCode::TRADE_TYPE_REFUND_GATHERING, StateCode::TRADE_TYPE_TRANSFER_GATHERING);
                    }
                }
    
            }
            
            $column_row['user_id'] = $user_id;
            $data = Consume_RecordModel::getInstance()->getLists($column_row, $sort, $page, $rows);
            
            $msg    = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg    = __('操作失败');
            $status = 250;
        }
        
        $this->render('pay', $data, $msg, $status);
    }
    
    
    public function consumeDeposit()
    {
        $user_id = Zero_Perm::getUserId();
        
        $column_row            = array();
        $column_row['user_id'] = $user_id;
        
        $data = Consume_DepositModel::getInstance()->getLists($column_row);
        
        $this->render('pay', $data);
    }
    
    //PC 端交易记录UI
    public function consumeTradeIndex()
    {
        $this->render('pay', array());
    }
    
    public function consumeTrade()
    {
        $user_id = Zero_Perm::getUserId();
        $data    = array();
        if ($user_id)
        {
            $rows = i('rows', i('iDisplayLength', 10)); //每页记录条数
            $page = i('page', max(1, ceil_r((i('iDisplayStart')+1) / $rows)));  //当前页码
            
            $sort = array('consume_trade_id' => 'DESC');
            
            $column_row             = array();
            $column_row['buyer_id'] = $user_id;
            //$column_row['trade_type_id'] = StateCode::TRADE_TYPE_DEPOSIT;
            
            $data   = Consume_TradeModel::getInstance()->getLists($column_row, $sort, $page, $rows);
            $msg    = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg    = __('操作失败');
            $status = 250;
        }
        $this->render('pay', $data, $msg, $status);
    }
    
    
    public function consumeWithdraw()
    {
        $user_id = Zero_Perm::getUserId();
        
        $column_row            = array();
        $column_row['user_id'] = $user_id;
        //$column_row['trade_type_id'] = StateCode::TRADE_TYPE_DEPOSIT;
        
        $data = Consume_WithdrawModel::getInstance()->getLists($column_row);
        
        $this->render('pay', $data);
    }
    
    public function withdrawIndex()
    {
        $user_id = Zero_Perm::getUserId();
        $data['bank_list'] = User_BankCardModel::getInstance()->find(array('user_id' => $user_id));
        $this->render('pay',$data);
    }
    
    public function withdrawInfo()
    {
        $user_id = Zero_Perm::getUserId();
        
        $withdraw_id = i('withdraw_id');
        
        $data = Consume_WithdrawModel::getInstance()->getOne($withdraw_id);
        
        $this->render('pay', $data);
    }

    public function getConsumeRecord()
    {

        $column_row = array();
        $order_id = s('order_id');
        if ($order_id) {
            $column_row['order_id'] = $order_id;
        }
        //权限判断
        if (!Zero_Api_Controller::getPlantformRole())
        {
            $user_id = Zero_Perm::getUserId();
            $column_row['user_id'] = $user_id;
        }

        $data = Consume_RecordModel::getInstance()->findOne($column_row);

        $this->render('pay', $data);
    }
    
    
    public function addWithdraw()
    {
        $user_id = Zero_Perm::getUserId();
        
        $data['user_id'] = $user_id; // 会员支付ID
        
        $data['order_id']              = s('order_id'); // 所属订单
        $data['withdraw_amount']       = f('withdraw_amount'); // 提现额度
        $data['withdraw_state']        = 0; // 是否成功(BOOL):0-申请中;1-提现通过
        $data['withdraw_desc']         = s('withdraw_desc'); // 描述
        $data['withdraw_bank']         = s('withdraw_bank'); // 银行
        $data['withdraw_mobile']       = s('withdraw_mobile'); // 电话
        $data['withdraw_account_no']   = s('withdraw_account_no'); // 银行账户
        $data['withdraw_account_name'] = s('withdraw_account_name'); // 开户名称
        $data['withdraw_fee']          = $data['withdraw_amount'] * 100 * Base_ConfigModel::getConfig('withdraw_fee_rate', 0.00); // 提现手续费
        $data['withdraw_time']         = get_datetime(); // 创建时间

        //判断支付密码是否正确
        $password = s('password');
        $msg      = '';
        
        $user_info_row = User_InfoModel::getInstance()->getOne($user_id);
        
        $user_certification = $user_info_row['user_certification'] != StateCode::USER_CERTIFICATION_YES ? 0 : 1;
        var_dump( $user_certification );die();
        if ($user_certification)
        {
            
            $flag = User_PayModel::getInstance()->checkPayPasswd($user_id, $password, $msg);
            
            if ($flag)
            {
                /* @var $Consume_WithdrawModel Consume_WithdrawModel */
                $Consume_WithdrawModel = Consume_WithdrawModel::getInstance();
                $Consume_WithdrawModel->sql->startTransactionDb();
                
                $data['withdraw_id'] = $Consume_WithdrawModel->doWithdraw($data);
                
                if ($data['withdraw_id'] && $Consume_WithdrawModel->sql->commitDb())
                {
                    $msg    = __('操作成功');
                    $status = 200;
                }
                else
                {
                    $Consume_WithdrawModel->sql->rollBackDb();
                    
                    $msg    = __('申请体现失败');
                    $status = 250;
                }
            }
            else
            {
                $msg    = __('支付密码有误');
                $status = 250;
            }
        }
        else
        {
            $msg    = __('尚未实名认证，不可提现');
            $status = 250;
        }
        $data['user_certification'] = $user_certification;
        $this->render('pay', $data, $msg, $status);
    }
    
    
    public function main()
    {
        $this->render();
    }

    public function userBank()
    {
        $user_id = Zero_Perm::getUserId();

        $data = User_BankCardModel::getInstance()->getLists(array('user_id' => $user_id));

        $data['bank_list'] = Base_BankModel::getInstance()->find();

        $this->render('pay', $data);
    }

    public function getUserBank()
    {
        $user_id = Zero_Perm::getUserId();

        $user_bank_id = i('id',0);

        $data = User_BankCardModel::getInstance()->findOne(array('user_id' => $user_id , 'user_bank_id' =>$user_bank_id));

        $this->render('pay', $data);
    }

    public function addUserBank()
    {

        $user_id = Zero_Perm::getUserId();

        $data['user_id'] = $user_id; // 会员ID

        $data['user_id']                 = $user_id; // 用户id
        $data['bank_id']                 = i('bank_id'); // 银行id
        $data['bank_name']               = s('bank_name'); // 银行名称
        $data['user_bank_card_code']     = s('user_bank_card_code'); // 卡号
        $data['user_bank_card_address']  = s('user_bank_card_address'); // 开户行地址
        $data['user_bank_enable']        = 1; // 状态
        $data['user_bank_card_name']     = s('user_bank_card_name'); // 持卡人姓名
        $data['user_bank_card_mobile']   = s('user_bank_card_mobile'); // 电话
        $data['user_bank_card_time']     = get_datetime(); // 创建时间

        $User_BankCardModel = User_BankCardModel::getInstance();

        $flag = $User_BankCardModel->findKey(array('user_bank_card_code' =>$data['user_bank_card_code']));

        if (!$flag) {
            $User_BankCardModel->sql->startTransactionDb();

            $User_BankCardModel->add($data);

            if ($User_BankCardModel->sql->commitDb())
            {
                $msg    = __('操作成功');
                $status = 200;
            } else {
                $User_BankCardModel->sql->rollBackDb();
                $msg    = __('添加失败');
                $status = 250;
            }
        } else {
            $msg = __('此卡已绑定');
            $status = 250;
        }

        $this->render('pay', $data, $msg, $status);
    }

    public function removeUserBank()
    {
        $id = i('id');

        $flag = User_BankCardModel::getInstance()->remove($id);

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

        $this->render('pay', array(), $msg, $status);
    }
}

?>
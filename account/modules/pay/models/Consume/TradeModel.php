<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 交易订单-强调唯一订单-充值则先创建充值订单模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-23, Xinze
 * @version    1.0
 * @todo
 */
class Consume_TradeModel extends Zero_Model
{
    public $_cacheName       = 'consume';
    public $_tableName       = 'consume_trade';
    public $_tablePrimaryKey = 'consume_trade_id';
    public $_useCache        = false;
    public $_languageCond    = false;
    
    public $fieldType = array();

	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'consume_trade_cond'=>array(
		    'order_id'=>null,
            'store_id'=>null,
            'chain_id' => null,
            'buyer_id'=>null,
            'trade_type_id'=>null
		)
	);

    public $_validateRules = array('integer'=>array('consume_trade_id', 'buyer_id', 'store_id', 'seller_id', 'trade_is_paid', 'order_state_id', 'trade_type_id', 'payment_channel_id', 'app_id', 'server_id', 'trade_mode_id', 'trade_year', 'trade_month', 'trade_day', 'trade_delete'), 'numeric'=>array('order_payment_amount', 'trade_payment_amount', 'trade_payment_money', 'trade_payment_recharge_card', 'trade_payment_points', 'trade_payment_credit', 'trade_payment_redpack', 'trade_discount', 'trade_amount'), 'date'=>array('trade_date', 'trade_create_time', 'trade_pay_time', 'trade_finish_time'));

    public $_validateLabels= array();


    /**
     * @param string $user  User Object
     * @var   string $db_id 指定需要连接的数据库Id
     * @return void
     */
    public function __construct(&$db_id='pay', &$user=null)
    {
        $this->_useCache  = false;

        $this->_tabelPrefix  = TABLE_PAY_PREFIX;
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
        $data = $this->lists($column_row, $sort, $page, $rows);

		return $data;
	}

	/**
	 * 根据订单号读取信息
	 *
	 * @param  int $order_id 订单id
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getTradeByOrderId($order_id)
	{
		$cond_row = array('order_id'=>$order_id);
        
        $row = $this->findOne($cond_row);
        
		return $row;
	}
    
    
    /**
     * 各种额度支付变化
     *
     * @param  array $trade_rows 订单信息
     * @param  int $money 余额支付
     * @param  int $recharge_card 充值卡支付
     * @param  int $points 积分支付,此处为积分转换的支付额度。
     * @param  int $credit 信用支付
     * @param  int $redpack 红包支付
     * @return bool  处理结果
     * @access public
     */
    public function processOfflinePay($trade_rows, $money=0, $recharge_card=0, $points=0, $credit=0, $redpack=0)
    {

        $money = max(0, $money);
        $recharge_card = max(0, $recharge_card);
        $points = max(0, $points);
        $credit = max(0, $credit);
        $redpack = max(0, $redpack);
        
        
        
        $flag_row = array();
        $time = time();
        
        $paid_order_id_row = array();
        $part_paid_order_id_row = array();
        
        //积分抵扣，暂时忽略，不涉及此处支付。
        //按照次序，依次支付。
        foreach ($trade_rows as $trade_row)
        {
            $order_id  = $trade_row['order_id'];
            $user_id   = $trade_row['buyer_id'];
            $seller_id = $trade_row['seller_id'];
            $store_id  = $trade_row['store_id'];
    
            
            if (!$seller_id)
            {
                throw new Exception(__('卖家信息有误'));
            }
    
    
            if (!$user_id)
            {
                throw new Exception(__('买家信息有误'));
            }
    
    
           
    
            //判断当前余额
            $user_resource_row = User_ResourceModel::getInstance()->getOne($user_id);
    
            if ($user_resource_row['user_money'] <= 0)
            {
                $money = 0;
            }
            else
            {
                //判断是否够用。
                $money = min($user_resource_row['user_money'], $money);
            }
    
            if ($user_resource_row['user_recharge_card'] <= 0)
            {
                $recharge_card = 0;
            }
            else
            {
                //判断是否够用。
                $recharge_card = min($user_resource_row['user_recharge_card'], $recharge_card);
            }
            
            if ($user_resource_row['user_points'] <= 0)
            {
                $points = 0;
            }
            else
            {
                //判断积分是否够用。
                $points = min($user_resource_row['user_points'] * Base_ConfigModel::getConfig('points_vaue_rate', 100), $points);
            }
    
            if ($user_resource_row['user_credit'] <= 0)
            {
                $credit = 0;
            }
            else
            {
                //判断是否够用。
                $credit = min($user_resource_row['user_credit'], $credit);
            }
    
            if ($user_resource_row['user_redpack'] <= 0)
            {
                $redpack = 0;
            }
            else
            {
                //判断是否够用。
                $redpack = min($user_resource_row['user_redpack'], $redpack);
            }
            
            
            //当前订单需要支付额度
            $trade_payment_amount = $trade_row['trade_payment_amount'];
            $waiting_payment_amount  = $trade_payment_amount;

            if ($waiting_payment_amount && ($money || $recharge_card || $points || $credit || $redpack))
            {
                //
                //写入流水
                $consume_record_rows = array();
                $seller_consume_record_rows = array();
                
                $consume_record_row = array();
                //$consume_record_row['consume_record_id'] = date('ymd');
                $consume_record_row['order_id'] = $order_id;
                $consume_record_row['user_id']  = $user_id;
                $consume_record_row['user_nickname']  = @$user_nickname;
                $consume_record_row['record_date']  = date('Y-m-d', $time);
    
                $consume_record_row['record_year']  = date('Y', $time);
                $consume_record_row['record_month']  = date('n', $time);
                $consume_record_row['record_day']  = date('j', $time);
    
                $consume_record_row['record_title']  = $trade_row['trade_title'];
                //$consume_record_row['record_desc']  = $trade_row['trade_title'];
                $consume_record_row['record_time']  = date('Y-m-d H:i:s', $time);

                
                $trade_data = array();
                $resource_data = array();
                $seller_resource_data = array();
    
                //余额支付
                if ($money>0 && $waiting_payment_amount>0)
                {
                    $consume_record_row['payment_met_id']  = PaymentModel::PAYMENT_MET_MONEY;
                    
                    //订单支付完成
                    if ($money >= $waiting_payment_amount)
                    {
                        $trade_data['trade_payment_amount'] = $trade_row['trade_payment_amount'] - $waiting_payment_amount;
                        $trade_data['trade_payment_money'] =  $trade_row['trade_payment_money'] + $waiting_payment_amount;
                        $resource_data['user_money'] = - $waiting_payment_amount;
                        
                        //扣除流水
                        $consume_record_row['record_money']  = -$waiting_payment_amount;
                        
                        //订单支付完成
                        $money = $money - $waiting_payment_amount;
                        $waiting_payment_amount = 0;
    
                    }
                    else
                    {
                        $trade_data['trade_payment_amount'] = $trade_row['trade_payment_amount'] - $money;
                        $trade_data['trade_payment_money'] =  $trade_row['trade_payment_money'] + $money;
                        $resource_data['user_money'] = - $money;
    
                        //扣除流水
                        $consume_record_row['record_money']  = -$money;
                        
                        //订单未完成
                        $waiting_payment_amount = $waiting_payment_amount - $money;
                        $money = 0;
                    }
    
    
                    $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_SHOPPING;
                    $consume_record_row['user_id']  = $user_id;
                    $consume_record_row['user_nickname']  = @$user_nickname;
                    $consume_record_rows[] = $consume_record_row;
                    
                    //卖家流水记录
                    $consume_record_row['user_id']  = $seller_id;
                    $consume_record_row['user_nickname']  = @$seller_nickname;
    
    
                    if ($waiting_payment_amount <= 0)
                    {
                        $consume_record_row['record_money']  = -$consume_record_row['record_money'] - $trade_row['order_commission_fee']; //佣金平台获取。 是否需要加入一个统计字段中？
                        $consume_record_row['record_commission_fee']  = $trade_row['order_commission_fee']; //佣金平台获取
                    }
                    else
                    {
                        $consume_record_row['record_money'] = -$consume_record_row['record_money'];
                        $consume_record_row['record_commission_fee']  = 0; //佣金平台获取
                    }
                    
                    $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_SALES;
                    $seller_consume_record_rows[] = $consume_record_row;
                }
    
                //充值卡支付
                if ($recharge_card>0 && $waiting_payment_amount>0)
                {
                    $consume_record_row['payment_met_id']  = PaymentModel::PAYMENT_MET_RECHARGE_CARD;
                    
                    if ($recharge_card >= $waiting_payment_amount)
                    {
                        $trade_data['trade_payment_amount'] = $trade_row['trade_payment_amount'] - $waiting_payment_amount;
                        $trade_data['trade_payment_recharge_card'] =  $trade_row['trade_payment_recharge_card'] + $waiting_payment_amount;
                        $resource_data['user_recharge_card'] = - $waiting_payment_amount;
                        
                        //扣除流水
                        $consume_record_row['record_money']  = -$waiting_payment_amount;
                        
                        //订单支付完成
                        $recharge_card = $recharge_card - $waiting_payment_amount;
                        $waiting_payment_amount = 0;
                        
                    }
                    else
                    {
                        $trade_data['trade_payment_amount'] = $trade_row['trade_payment_amount'] - $recharge_card;
                        $trade_data['trade_payment_recharge_card'] =  $trade_row['trade_payment_recharge_card'] + $recharge_card;
                        $resource_data['user_recharge_card'] = - $recharge_card;
                        
                        //扣除流水
                        $consume_record_row['record_money']  = - $recharge_card;;
                        
                        //订单未完成
                        $waiting_payment_amount = $waiting_payment_amount - $recharge_card;
                        $recharge_card = 0;
    
                    }
    
                    $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_SHOPPING;
                    $consume_record_row['user_id']  = $user_id;
                    $consume_record_row['user_nickname']  = @$user_nickname;
                    $consume_record_rows[] = $consume_record_row;
                    
                    //卖家流水记录
                    $consume_record_row['user_id']  = $seller_id;
                    $consume_record_row['user_nickname']  = @$seller_nickname;
                    
                    if ($waiting_payment_amount <= 0)
                    {
                        $consume_record_row['record_money']  = -$consume_record_row['record_money'] - $trade_row['order_commission_fee']; //佣金平台获取。 是否需要加入一个统计字段中？
                        $consume_record_row['record_commission_fee']  = $trade_row['order_commission_fee']; //佣金平台获取
                    }
                    else
                    {
                        $consume_record_row['record_money'] = -$consume_record_row['record_money'];
                        $consume_record_row['record_commission_fee']  = 0; //佣金平台获取
                    }
                    
                    $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_SALES;
                    $seller_consume_record_rows[] = $consume_record_row;
                }
    
    
                //积分支付
                if ($points>0 && $waiting_payment_amount>0)
                {
                    $consume_record_row['payment_met_id']  = PaymentModel::PAYMENT_MET_POINTS;

                    //todo 判断积分是否够用。
                    if ($points >= $waiting_payment_amount)
                    {
                        $trade_data['trade_payment_amount'] = $trade_row['trade_payment_amount'] - $waiting_payment_amount;
                        $trade_data['trade_payment_points'] =  $trade_row['trade_payment_points'] + $waiting_payment_amount;
                        $resource_data['user_points'] =  - $waiting_payment_amount / Base_ConfigModel::getConfig('points_vaue_rate', 100); //扣除买家积分，积分和钱的比例
    
                        //扣除流水
                        $consume_record_row['record_money']  = -$waiting_payment_amount;
                        
                        //订单支付完成
                        $points = $points - $waiting_payment_amount;
                        $waiting_payment_amount = 0;
                    }
                    else
                    {
                        $trade_data['trade_payment_amount'] = $trade_row['trade_payment_amount'] - $points;
                        $trade_data['trade_payment_points'] =  $trade_row['trade_payment_points'] + $points;
                        $resource_data['user_points'] =  - $points / Base_ConfigModel::getConfig('points_vaue_rate', 100); //扣除买家积分，积分和钱的比例
                        
                        //扣除流水
                        $consume_record_row['record_money']  = - $points;;
                        
                        //订单未完成
                        $waiting_payment_amount = $waiting_payment_amount - $points;
                        $points = 0;
    
                    }
    
                    $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_SHOPPING;
                    $consume_record_row['user_id']  = $user_id;
                    $consume_record_row['user_nickname']  = @$user_nickname;
                    $consume_record_rows[] = $consume_record_row;
                    
                    //卖家流水记录
                    $consume_record_row['user_id']  = $seller_id;
                    $consume_record_row['user_nickname']  = @$seller_nickname;
    
                    if ($waiting_payment_amount <= 0)
                    {
                        $consume_record_row['record_money']  = -$consume_record_row['record_money'] - $trade_row['order_commission_fee']; //佣金平台获取。 是否需要加入一个统计字段中？
                        $consume_record_row['record_commission_fee']  = $trade_row['order_commission_fee']; //佣金平台获取
                    }
                    else
                    {
                        $consume_record_row['record_money'] = -$consume_record_row['record_money'];
                        $consume_record_row['record_commission_fee']  = 0; //佣金平台获取
                    }
                    
                    $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_SALES;
                    $seller_consume_record_rows[] = $consume_record_row;
                }
    
                //信用支付
                if ($credit>0 && $waiting_payment_amount>0)
                {
                    $consume_record_row['payment_met_id']  = PaymentModel::PAYMENT_MET_CREDIT;
                    
                    
                    if ($credit >= $waiting_payment_amount)
                    {
    
                        $trade_data['trade_payment_amount'] = $trade_row['trade_payment_amount'] - $waiting_payment_amount;
                        $trade_data['trade_payment_credit'] =  $trade_row['trade_payment_credit'] + $waiting_payment_amount;
                        $resource_data['user_credit'] = - $waiting_payment_amount;
    
                        //扣除流水
                        $consume_record_row['record_money']  = -$waiting_payment_amount;
                        
                        //订单支付完成
                        $credit = $credit - $waiting_payment_amount;
                        $waiting_payment_amount = 0;
    
                    }
                    else
                    {
    
                        $trade_data['trade_payment_amount'] = $trade_row['trade_payment_amount'] - $credit;
                        $trade_data['trade_payment_credit'] =  $trade_row['trade_payment_credit'] + $credit;
                        $resource_data['user_credit'] = - $credit;
                        
                        //扣除流水
                        $consume_record_row['record_money']  = - $credit;
                        
                        //订单未完成
                        $waiting_payment_amount = $waiting_payment_amount - $credit;
                        $credit = 0;
    
                    }
    
                    $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_SHOPPING;
                    $consume_record_row['user_id']  = $user_id;
                    $consume_record_row['user_nickname']  = @$user_nickname;
                    $consume_record_rows[] = $consume_record_row;
                    
                    //卖家流水记录
                    $consume_record_row['user_id']  = $seller_id;
                    $consume_record_row['user_nickname']  = @$seller_nickname;
    
                    if ($waiting_payment_amount <= 0)
                    {
                        $consume_record_row['record_money']  = -$consume_record_row['record_money'] - $trade_row['order_commission_fee']; //佣金平台获取。 是否需要加入一个统计字段中？
                        $consume_record_row['record_commission_fee']  = $trade_row['order_commission_fee']; //佣金平台获取
                    }
                    else
                    {
                        $consume_record_row['record_money'] = -$consume_record_row['record_money'];
                        $consume_record_row['record_commission_fee']  = 0; //佣金平台获取
                    }
                    
                    $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_SALES;
                    $seller_consume_record_rows[] = $consume_record_row;
                }
                
                //红包支付
                if ($redpack>0 && $waiting_payment_amount>0)
                {
                    $consume_record_row['payment_met_id']  = PaymentModel::PAYMENT_MET_REDPACK;
                    
                    
                    if ($redpack >= $waiting_payment_amount)
                    {
    
                        $trade_data['trade_payment_amount'] = $trade_row['trade_payment_amount'] - $waiting_payment_amount;
                        $trade_data['trade_payment_redpack'] =  $trade_row['trade_payment_redpack'] + $waiting_payment_amount;
                        $resource_data['user_redpack'] = - $waiting_payment_amount;
                        
                        //扣除流水
                        $consume_record_row['record_money']  = -$waiting_payment_amount;
                        
                        //订单支付完成
                        $redpack = $redpack - $waiting_payment_amount;
                        $waiting_payment_amount = 0;
    
                    }
                    else
                    {
                        $trade_data['trade_payment_amount'] = $trade_row['trade_payment_amount'] - $redpack;
                        $trade_data['trade_payment_redpack'] =  $trade_row['trade_payment_redpack'] + $redpack;
                        $resource_data['user_redpack'] = - $redpack;
                        //扣除流水
                        $consume_record_row['record_money']  = -$redpack;
                        
                        //订单未完成
                        $waiting_payment_amount = $waiting_payment_amount - $redpack;
                        $redpack = 0;
    
                    }
    
                    $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_SHOPPING;
                    $consume_record_row['user_id']  = $user_id;
                    $consume_record_row['user_nickname']  = @$user_nickname;
                    $consume_record_rows[] = $consume_record_row;
    
                    //卖家流水记录
                    $consume_record_row['user_id']  = $seller_id;
                    $consume_record_row['user_nickname']  = @$seller_nickname;
                    
                    if ($waiting_payment_amount <= 0)
                    {
                        $consume_record_row['record_money']  = -$consume_record_row['record_money'] - $trade_row['order_commission_fee']; //佣金平台获取。 是否需要加入一个统计字段中？
                        $consume_record_row['record_commission_fee']  = $trade_row['order_commission_fee']; //佣金平台获取
                    }
                    else
                    {
                        $consume_record_row['record_money'] = -$consume_record_row['record_money'];
                        $consume_record_row['record_commission_fee']  = 0; //佣金平台获取
                    }
                    
                    $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_SALES;
                    $seller_consume_record_rows[] = $consume_record_row;
                }
                
                if ($waiting_payment_amount <= 0)
                {
                    //订单处理
                    //更改订单状态, 可以完成订单支付状态
                    $trade_data['trade_is_paid'] = StateCode::ORDER_PAID_STATE_YES;
                    $paid_order_id_row[] = $order_id;
    
    
                    //支付佣金
                    if ($waiting_payment_amount <= 0)
                    {
                        //平台佣金总额
                        $plantform_resource_row = array();
                        $plantform_resource_row['plantform_resource_id'] = DATA_ID;
                        $plantform_resource_row['plantform_commission_fee'] = $trade_row['order_commission_fee'];
                        $flag_row[] = Plantform_ResourceModel::getInstance()->save($plantform_resource_row, true, true);
                    }
                }
                else
                {
                    //部分支付
                    $trade_data['trade_is_paid'] = StateCode::ORDER_PAID_STATE_PART;
                    $part_paid_order_id_row[] = $order_id;
                }
    
                
                //买家数据
                if ($consume_record_rows)
                {
                    $flag_row[] = Consume_RecordModel::getInstance()->add($consume_record_rows);
                }
                
                $flag_row[] = User_ResourceModel::getInstance()->edit($user_id, $resource_data, true); //where
                
                
                //卖家数据, 卖家金钱进入冻结收益中? 其它的支付方式，收益通过其它方式结算。 卖家可以通过trade记录统计
                //预存款支付影响
                if (isset($resource_data['user_money']))
                {
                    //流水记录
                    if ($seller_consume_record_rows)
                    {
                        $flag_row[] = Consume_RecordModel::getInstance()->add($seller_consume_record_rows);
                    }

                    // - - 为加
                    if ($waiting_payment_amount <= 0)
                    {
                        $seller_resource_data['user_money'] = -$resource_data['user_money'] - $trade_row['order_commission_fee'];
                    }
                    else
                    {
                        $seller_resource_data['user_money'] = -$resource_data['user_money'];
                    }

                    $flag_row[] = User_ResourceModel::getInstance()->edit($seller_id, $seller_resource_data, true);
                }

                //充值卡， 存入商家预存款账户
                if (isset($resource_data['user_recharge_card']))
                {
                    //流水记录
                    if ($seller_consume_record_rows)
                    {
                        $flag_row[] = Consume_RecordModel::getInstance()->add($seller_consume_record_rows);
                    }

                    // - - 为加
                    if ($waiting_payment_amount <= 0)
                    {
                        $seller_resource_data['user_money'] = -$resource_data['user_recharge_card'] - $trade_row['order_commission_fee'];
                    }
                    else
                    {
                        $seller_resource_data['user_money'] = -$resource_data['user_recharge_card'];
                    }

                    $flag_row[] = User_ResourceModel::getInstance()->edit($seller_id, $seller_resource_data, true);
                }

                //积分支付影响， 存入商家预存款账户
                if (isset($resource_data['user_points']))
                {
                    //流水记录
                    if ($seller_consume_record_rows)
                    {
                        $flag_row[] = Consume_RecordModel::getInstance()->add($seller_consume_record_rows);
                    }

                    // - - 为加
                    if ($waiting_payment_amount <= 0)
                    {
                        $seller_resource_data['user_money'] = -$resource_data['user_points'] * Base_ConfigModel::getConfig('points_vaue_rate', 100) - $trade_row['order_commission_fee'];
                    }
                    else
                    {
                        $seller_resource_data['user_money'] = -$resource_data['user_points'] * Base_ConfigModel::getConfig('points_vaue_rate', 100); //将积分转为抵扣预存款
                    }

                    $flag_row[] = User_ResourceModel::getInstance()->edit($seller_id, $seller_resource_data, true);
                }
                
                $flag_row[] = $this->edit($trade_row['consume_trade_id'], $trade_data); //where
            }
        }
        
        if ($paid_order_id_row)
        {
    
            //本地服务器订单更改
            try
            {   
                
                $flag_row[] = Order_BaseModel::getInstance()->setPaidYes($paid_order_id_row);
                
                //Order_BaseModel::getInstance()->setPaidYes($order_id_row);
            }
            catch (Exception $e)
            {   
                throw new Exception(__('订单支付失败'));
               
                Zero_Log::log($e->getMessage(), Zero_Log::ERROR, 'pay_order_setPaidYes');
            }
        }
        
        
        if ($part_paid_order_id_row)
        {
            //远程服务器订单更改放入
    
            //本地服务器订单更改
            try
            {
                $flag_row[] = Order_BaseModel::getInstance()->setPaidPart($part_paid_order_id_row);
                //Order_BaseModel::getInstance()->setPaidPart($order_id_row);
            }
            catch (Exception $e)
            {
                throw new Exception(__('订单支付失败'));
            }
        }
        
        
        return is_ok($flag_row);
    }
    
    
    /**
     * 执行退款操作
     *
     * @param  array $return_rows 订单信息
     * @param  int $money 余额支付
     * @param  int $recharge_card 充值卡支付
     * @param  int $points 积分支付
     * @param  int $credit 信用支付
     * @param  int $redpack 红包支付
     * @return bool  处理结果
     * @access public
     */
    public function doRefund($return_rows, $money=0, $recharge_card=0, $points=0, $credit=0, $redpack=0)
    {
        $money = max(0, $money);
        $recharge_card = max(0, $recharge_card);
        $points = max(0, $points);
        $credit = max(0, $credit);
        $redpack = max(0, $redpack);
        
        $paid_return_id_row = array();
        
        $flag_row = array();
        $time = time();
        
        //积分抵扣，暂时忽略，不涉及此处支付。
        //按照次序，依次支付。
        foreach ($return_rows as $return_row)
        {
            $return_id  = $return_row['return_id'];
            $user_id   = $return_row['buyer_user_id'];
            
            $store_id  = $return_row['store_id'];
            $store_row = Store_BaseModel::getInstance()->getOne($store_id);
            $seller_id = $store_row['user_id'];
            
            if (!$seller_id)
            {
                throw new Exception(__('卖家信息有误'));
            }
            
            
            if (!$user_id)
            {
                throw new Exception(__('买家信息有误'));
            }
            
            
            //判断当前余额
            $user_resource_row = User_ResourceModel::getInstance()->getOne($user_id);
            
            if ($user_resource_row['user_money'] <= 0)
            {
                $money = 0;
            }
            
            if ($user_resource_row['user_recharge_card'] <= 0)
            {
                $recharge_card = 0;
            }
            
            if ($user_resource_row['user_points'] <= 0)
            {
                $points = 0;
            }
            
            if ($user_resource_row['user_credit'] <= 0)
            {
                $credit = 0;
            }
            
            if ($user_resource_row['user_redpack'] <= 0)
            {
                $redpack = 0;
            }
            
            
            //当前订单需要支付额度
            $return_refund_amount = $return_row['return_refund_amount'];
            $waiting_refund_amount  = $return_refund_amount;
            
            //if ($waiting_refund_amount && ($money || $recharge_card || $points || $credit || $redpack))
            if ($waiting_refund_amount)
            {
                //
                
                $trade_data = array();
                $resource_data = array();
                $resource_data['user_money'] = $waiting_refund_amount;
                
                $seller_resource_data = array();
                $seller_resource_data['user_money'] = -$waiting_refund_amount;
                
                //写入流水
                $consume_record_rows = array();
                $seller_consume_record_rows = array();
                
                $consume_record_row = array();
                //$consume_record_row['consume_record_id'] = date('ymd');
                $consume_record_row['order_id'] = $return_id;
                $consume_record_row['user_id']  = $user_id;
                $consume_record_row['user_nickname']  = @$user_nickname;
                $consume_record_row['record_date']  = date('Y-m-d', $time);
                
                $consume_record_row['record_year']  = date('Y', $time);
                $consume_record_row['record_month']  = date('n', $time);
                $consume_record_row['record_day']  = date('j', $time);
                
                $consume_record_row['record_title']  = __('退款单:') . $return_row['return_id'];
                //$consume_record_row['record_desc']  = $return_row['trade_title'];
                $consume_record_row['record_time']  = date('Y-m-d H:i:s', $time);
                
                
                
                $consume_record_row['payment_met_id']  = PaymentModel::PAYMENT_MET_MONEY;
                
                //增加流水
                $consume_record_row['record_money']  = $waiting_refund_amount; //佣金问题？
                $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_REFUND_GATHERING;
                $consume_record_row['user_id']  = $user_id;
                $consume_record_row['user_nickname']  = @$user_nickname;
                
                $consume_record_rows[] = $consume_record_row;
                
                //卖家流水记录
                $consume_record_row['user_id']  = $seller_id;
                $consume_record_row['user_nickname']  = @$seller_nickname;
                $consume_record_row['record_money'] = -$consume_record_row['record_money'];
                $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_REFUND_PAY;
                $seller_consume_record_rows[] = $consume_record_row;
                
                
                
                //买家数据
                if ($consume_record_rows)
                {
                    $flag_row[] = Consume_RecordModel::getInstance()->add($consume_record_rows);
                }
                
                $flag_row[] = User_ResourceModel::getInstance()->edit($user_id, $resource_data, true); //where
                
                
                //卖家数据, 卖家金钱进入冻结收益中? 其它的支付方式，收益通过其它方式结算。 卖家可以通过trade记录统计
                if (isset($resource_data['user_money']))
                {
                    //流水记录
                    if ($seller_consume_record_rows)
                    {
                        $flag_row[] = Consume_RecordModel::getInstance()->add($seller_consume_record_rows);
                    }
                    
                    // -
                    $seller_resource_data['user_money'] = -$resource_data['user_money'];
                    $flag_row[] = User_ResourceModel::getInstance()->edit($seller_id, $seller_resource_data, true);
                }
                
                $paid_return_id_row[] = $return_id;
            }
        }
        
        if ($paid_return_id_row)
        {
            //远程服务器订单更改放入
            
            //本地服务器订单更改
            try
            {
                $flag_row[] = Order_ReturnModel::getInstance()->setPaidYes($paid_return_id_row);
                //Order_BaseModel::getInstance()->setPaidYes($return_id_row);
            }
            catch (Exception $e)
            {
    
                Zero_Log::log($e->getMessage(), Zero_Log::ERROR, 'pay_order_setPaidYes');
            }
        }
        
        
        return is_ok($flag_row);
    }

    public function addTradeRecord( $order_id_row ){
        $trade_rows  = Consume_TradeModel::getInstance()->find(array('order_id' => $order_id_row));
        if( !$trade_rows ){
            throw new Exception(__('交易信息有误'));
        }

        $time = time();
        foreach ( $trade_rows as $trade_row ){
            $order_id  = $trade_row['order_id'];
            $user_id   = $trade_row['buyer_id'];
            $seller_id = $trade_row['seller_id'];
            $store_id  = $trade_row['store_id'];

            if (!$seller_id)
            {
                throw new Exception(__('卖家信息有误'));
            }
    
            if (!$user_id)
            {
               throw new Exception(__('买家信息有误'));
            }
            $trade_payment_amount = $trade_row['trade_payment_amount'];

            //写入买家流水
            $consume_record_row    = array();
            $consume_record_row['order_id']    = $order_id;
            $consume_record_row['user_id']     = $user_id;
            $consume_record_row['user_nickname']  = @$user_nickname;
            $consume_record_row['record_date']  = date('Y-m-d', $time);
            $consume_record_row['record_year']  = date('Y', $time);
            $consume_record_row['record_month']  = date('n', $time);
            $consume_record_row['record_day']  = date('j', $time);
            $consume_record_row['record_title']  = $trade_row['trade_title'];
            $consume_record_row['record_time']  = date('Y-m-d H:i:s', $time);
            $consume_record_row['payment_met_id']  = PaymentModel::PAYMENT_MET_MONEY;
            $consume_record_row['record_money']  = -$trade_payment_amount;
            $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_SHOPPING;

            // $consume_record_rows[] = $consume_record_row;
            $flag_row[] = Consume_RecordModel::getInstance()->add($consume_record_row);


            //写入卖家流水
            $consume_record_row  = array();
            $consume_record_row['order_id']       = $order_id;
            $consume_record_row['user_id']        = $seller_id;
            $consume_record_row['user_nickname']  = @$seller_nickname;
            $consume_record_row['record_date']    = date('Y-m-d', $time);
            $consume_record_row['record_year']    = date('Y', $time);
            $consume_record_row['record_month']   = date('n', $time);
            $consume_record_row['record_day']     = date('j', $time);
            $consume_record_row['record_title']   = $trade_row['trade_title'];
            $consume_record_row['record_time']    = date('Y-m-d H:i:s', $time);
            $consume_record_row['payment_met_id']  = PaymentModel::PAYMENT_MET_MONEY;
            $consume_record_row['record_money']   = $trade_payment_amount - $trade_row['order_commission_fee'];
            $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_SALES;
            $consume_record_row['record_commission_fee']  = $trade_row['order_commission_fee']; //佣金平台获取

            $flag_row[] = Consume_RecordModel::getInstance()->add($consume_record_row);
            
            //买家冻结资金
            $resource_data['user_money'] = - $trade_payment_amount;
            $flag_row[] = User_ResourceModel::getInstance()->edit($user_id, $resource_data, true);

            //买家冻结资金
            $seller_resource_data['user_money'] = -$resource_data['user_money'] - $trade_row['order_commission_fee'];
            $flag_row[] = User_ResourceModel::getInstance()->edit($seller_id, $seller_resource_data, true);

            //交易
            $trade_data['trade_payment_amount'] = 0;
            $trade_data['trade_payment_money']  =  $trade_payment_amount;
            $trade_data['trade_is_paid']        =  StateCode::ORDER_PAID_STATE_YES;
            $flag_row[] = Consume_TradeModel::getInstance()->edit($trade_row['consume_trade_id'], $trade_data);
        }
        return is_ok($flag_row);
    }
}


<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 充值-支付回调callback使用-确认付款模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-23, Xinze
 * @version    1.0
 * @todo
 */
class Consume_DepositModel extends Zero_Model
{
    public $_cacheName       = 'consume';
    public $_tableName       = 'consume_deposit';
    public $_tablePrimaryKey = 'deposit_id';
    public $_useCache        = false;
    public $_languageCond    = false;
    
    public $fieldType = array('store_id'=>'DOT', 'chain_id'=>'DOT');

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'consume_deposit_cond'=>array(
            'store_id'=>null,
            'chain_id'=>null,
            'user_id'=>null,
            'order_id'=>null,
            'deposit_trade_no'=>'string'
        )
    );

    public $_validateRules = array('integer'=>array('payment_channel_id', 'app_id', 'server_id', 'deposit_app_id_channel', 'deposit_payment_type', 'deposit_quantity', 'deposit_is_total_fee_adjust', 'deposit_use_coupon', 'deposit_state', 'deposit_async', 'deposit_review'), 'numeric'=>array('deposit_total_fee', 'deposit_price', 'deposit_discount'), 'date'=>array('deposit_gmt_create', 'deposit_gmt_payment', 'deposit_gmt_close', 'deposit_notify_time'));

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
    
        $data['items'] = Payment_ChannelModel::fixChannelName($data['items']);
        
		return $data;
	}

	/**
	 * 支付完成接口调用
	 *
	 * @param  array $notify_row  回调通知数据
	 * @param  bool $return_insert_id 是否返回主键
	 * @param  int $money 余额支付
	 * @param  int $recharge_card 充值卡支付
	 * @param  int $points 积分支付
	 * @param  int $credit 信用支付
	 * @param  int $redpack 红包支付
	 * @return bool  处理结果
	 * @access public
	 */
	public function processDeposit($notify_row, $return_insert_id=false, $money=0, $recharge_card=0, $points=0, $credit=0, $redpack=0)
	{
		$order_id = $notify_row['order_id'];

		//$deposit_row = $this->getOne($order_id);
        
        $deposit_column_row = array('order_id'=>$order_id, 'deposit_trade_no'=>$notify_row['deposit_trade_no']);
		$deposit_row = $this->findOne($deposit_column_row);
  
		if (!$deposit_row)
		{
			//增加充值信息
			$flag = $this->add($notify_row, $return_insert_id);
		}
		else
		{
			//edit , 同步处理的时候, 数据可能确实,此处更新, 是否更新,判断数据
			$deposit_data = array();
			$deposit_data = $notify_row;
			unset($deposit_data['order_id']);

			//异步已经完成支付了,则不更新
			if (!$deposit_row['deposit_async'])
			{
				$flag = $this->edit($deposit_row['deposit_id'], $deposit_data);
			}
			else
			{
				$flag = 0;
			}
		}

		//读取最新记录
		if (false !== $flag)
		{
			//$deposit_row = $this->getOne($order_id);
            $deposit_row = $this->findOne($deposit_column_row);
		}
		else
		{
			return false;
		}

		//待走流程
		if ($deposit_row)
		{
            //判断是否(DOT)分割的多条订单,合并支付
            $order_id_row = explode(',', $order_id);

            
            $paid_order_id_row = array();
            
			if (0 == $deposit_row['deposit_state'])
			{
				$time = time();

				//订单信息
                
                $Consume_TradeModel = new Consume_TradeModel();
                $trade_rows = $Consume_TradeModel->find(array('order_id'=>$order_id_row));
                
                $flag_row = array();
                
                
                //用户账户增加充值额度
                $trade_row = current($trade_rows);
                $user_id = $trade_row['buyer_id'];
                $user_nickname  = '';
                
                $User_ResourceModel = new User_ResourceModel();
                $user_res_row = $User_ResourceModel->getOne($user_id);
                
                $user_res_data = array();
                $deposit_total_fee = $deposit_row['deposit_total_fee'];
                
                if ($user_res_row)
                {
                    //$user_res_data['user_money'] = $user_res_row['user_money'] + $deposit_row['deposit_total_fee'];
                    //$flag_row[] = $User_ResourceModel->edit($user_id, $user_res_data); //where
                    $flag_row[] = $User_ResourceModel->edit($user_id, array('user_money'=>$deposit_row['deposit_total_fee']), true); //where
                }
                else
                {
                    $user_res_data['user_money'] = $deposit_row['deposit_total_fee'];
                    $user_res_data['user_id'] = $user_id;
                    $flag_row[] = $User_ResourceModel->add($user_res_data);
                }
                //end 用户账户增加充值额度
                
                
                
                //写入充值流水
                $consume_record_row = array();
                //$consume_record_row['consume_record_id'] = date('ymd');
                $consume_record_row['order_id'] = $order_id;
                $consume_record_row['user_id']  = $user_id;
                $consume_record_row['user_nickname']  = $user_nickname;
                $consume_record_row['store_id']  = 0;
                $consume_record_row['chain_id']  = 0;
                $consume_record_row['record_total']  = $deposit_row['deposit_total_fee'];
                $consume_record_row['record_money']  = $deposit_row['deposit_total_fee'];
                $consume_record_row['record_date']  = date('Y-m-d', $time);
                
                
                $consume_record_row['record_year']  = date('Y', $time);
                $consume_record_row['record_month']  = date('n', $time);
                $consume_record_row['record_day']  = date('j', $time);
                
                $consume_record_row['record_title']  = $deposit_row['deposit_subject'];
                $consume_record_row['record_desc']  = $deposit_row['deposit_body'];
                $consume_record_row['record_time']  = date('Y-m-d H:i:s', $time);
                $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_DEPOSIT;
                $consume_record_row['payment_met_id']  = PaymentModel::PAYMENT_MET_MONEY;
                
                
                $Consume_RecordModel = new Consume_RecordModel();
                $flag_row[] = $Consume_RecordModel->add($consume_record_row);
                //end 写入充值流水
                
                $deposit_data = array();
                $deposit_data['deposit_state'] = 1;
                
                //数据传入，此处注释掉。
                //$deposit_data['store_id'] = array_values(array_column_unique($trade_rows, 'store_id'));
                //$deposit_data['chain_id'] = array_values(array_column_unique($trade_rows, 'chain_id'));
                $deposit_data['user_id'] = $user_id;
                
                //store_id
                
                $flag_row[] = $this->edit($deposit_row['deposit_id'], $deposit_data);
            
                //订单状态异常，不需要记录，因为用户资金已经存入了余额账户
                /*
                {
                    //记录数据,异常
                    $deposit_data = array();
                    $deposit_data['deposit_state'] = 9;
                    
                    $flag = $this->edit($deposit_row['deposit_id'], $deposit_data);
                    
                    if ($flag)
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
                */
                
                
                //$money=0, $recharge_card=0, $points=0, $credit=0, $redpack=0
                
                foreach ($trade_rows as $trade_row)
                {
                    $order_id = $trade_row['order_id'];
                    
                    if ($deposit_total_fee>0 && $trade_row && StateCode::ORDER_PAID_STATE_YES!=$trade_row['trade_is_paid'])
                    {
                        $seller_id = $trade_row['seller_id'];
                        $seller_nickname = '';
    
                        //当前订单需要支付额度
                        $trade_payment_amount = $trade_row['trade_payment_amount'];
                        
                        if ($deposit_total_fee >= $trade_payment_amount)
                        {
                            //订单处理
                            //更改订单状态, 可以完成订单支付状态
                            $trade_data = array();
                            $trade_data['trade_is_paid'] = StateCode::ORDER_PAID_STATE_YES;
                            $trade_data['trade_payment_amount'] = 0;
                            $trade_data['trade_payment_money'] =   $trade_row['trade_payment_money'] + $trade_payment_amount;
                            $flag_row[] = $Consume_TradeModel->edit($trade_row['consume_trade_id'], $trade_data); //where
    
                            //不是充值订单, 订单支付完成
                            if (StateCode::TRADE_TYPE_DEPOSIT != $trade_row['trade_type_id'])
                            {
                                $paid_order_id_row[] = $order_id;
                            }
    
    
                            $deposit_total_fee = $deposit_total_fee - $trade_payment_amount;
    
                        }
                        else
                        {
                            $trade_payment_amount = $deposit_total_fee;
                            
                            //订单处理
                            //不够支付完成
                            $trade_data = array();
                            $trade_data['trade_payment_amount'] = -$trade_payment_amount;
                            $trade_data['trade_payment_money'] =  $trade_payment_amount;
                            $flag_row[] = $Consume_TradeModel->edit($trade_row['consume_trade_id'], $trade_data, true); //where
    
                            $deposit_total_fee = 0;
                        }
                        
                        //订单扣除流水
                        //订单消费流水
                        //涉及佣金结算问题
                        if (StateCode::TRADE_TYPE_SHOPPING == $trade_row['trade_type_id'])
                        {
                            //1. 买家流水及订单扣除
                            $consume_record_row['record_title']  = $trade_row['trade_title'];
                            //$consume_record_row['record_desc']   = $trade_row['trade_title'];
    
                            $consume_record_row['user_id']  = $user_id;
                            $consume_record_row['user_nickname']  = $user_nickname;
                            $consume_record_row['store_id']  = 0;
                            $consume_record_row['chain_id']  = 0;
    
                            $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_SHOPPING;
                            $consume_record_row['record_total']  = -$trade_payment_amount;
                            $consume_record_row['record_money']  = -$trade_payment_amount;
            
                            $flag_row[] = $Consume_RecordModel->add($consume_record_row);
                            $flag_row[] = $User_ResourceModel->edit($user_id, array('user_money'=>-$trade_payment_amount), true); //where
                            
                            //2. 卖家订单流水增加
                            $consume_record_row['user_id']  = $seller_id;
                            $consume_record_row['user_nickname']  = $seller_nickname;
                            $consume_record_row['store_id']  = $trade_row['store_id'];
                            $consume_record_row['chain_id']  = $trade_row['chain_id'];
    
                            $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_SALES;
                            //$consume_record_row['payment_type_id']  = StateCode::PAYMENT_TYPE_ONLINE;
                            //$consume_record_row['payment_channel_id']  = StateCode::PAYMENT_TYPE_ONLINE;
                            $consume_record_row['record_total']  = $trade_payment_amount;
    
                            //卖家收益涉及佣金问题， 可以分多次付款，支付完成才扣佣金
                            if (in_array($order_id, $paid_order_id_row))
                            {
                                $consume_record_row['record_money']  = $trade_payment_amount - $trade_row['order_commission_fee']; //佣金平台获取。 是否需要加入一个统计字段中？
                                $consume_record_row['record_commission_fee']  = $trade_row['order_commission_fee']; //佣金平台获取
                                
                                //平台佣金总额
                                $plantform_resource_row = array();
                                $plantform_resource_row['plantform_resource_id'] = DATA_ID;
                                $plantform_resource_row['plantform_commission_fee'] = $trade_row['order_commission_fee'];
                                $flag_row[] = Plantform_ResourceModel::getInstance()->save($plantform_resource_row, true, true);
                                
                            }
                            else
                            {
                                $consume_record_row['record_money']  = $trade_payment_amount;
                            }
    
                            $flag_row[] = $Consume_RecordModel->add($consume_record_row);
                            
                            //卖家收益，进入冻结中?
                            $flag_row[] = $User_ResourceModel->edit($seller_id, array('user_money'=>$consume_record_row['record_money']), true); //where
                        }
                        
                        //线下买单
                        if (StateCode::TRADE_TYPE_FAVORABLE == $trade_row['trade_type_id'])
                        {
                            //1. 买家流水及订单扣除
                            $consume_record_row['record_title']  = $trade_row['trade_title'];
                            //$consume_record_row['record_desc']   = $trade_row['trade_title'];
        
                            $consume_record_row['user_id']  = $user_id;
                            $consume_record_row['user_nickname']  = $user_nickname;
                            $consume_record_row['store_id']  = 0;
                            $consume_record_row['chain_id']  = 0;
        
                            $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_FAVORABLE;
                            $consume_record_row['record_total']  = -$trade_payment_amount;
                            $consume_record_row['record_money']  = -$trade_payment_amount;
        
                            $flag_row[] = $Consume_RecordModel->add($consume_record_row);
                            $flag_row[] = $User_ResourceModel->edit($user_id, array('user_money'=>-$trade_payment_amount), true); //where
        
                            //2. 卖家订单流水增加
                            $consume_record_row['user_id']  = $seller_id;
                            $consume_record_row['user_nickname']  = $seller_nickname;
                            $consume_record_row['store_id']  = $trade_row['store_id'];
                            $consume_record_row['chain_id']  = $trade_row['chain_id'];
        
                            $consume_record_row['trade_type_id']  = StateCode::TRADE_TYPE_SALES;
                            //$consume_record_row['payment_type_id']  = StateCode::PAYMENT_TYPE_ONLINE;
                            //$consume_record_row['payment_channel_id']  = StateCode::PAYMENT_TYPE_ONLINE;
                            $consume_record_row['record_total']  = $trade_payment_amount;
        
                            //卖家收益涉及佣金问题， 可以分多次付款，支付完成才扣佣金
                            if (in_array($order_id, $paid_order_id_row))
                            {
                                $consume_record_row['record_money']  = $trade_payment_amount - $trade_row['order_commission_fee']; //佣金平台获取。 是否需要加入一个统计字段中？
                                $consume_record_row['record_commission_fee']  = $trade_row['order_commission_fee']; //佣金平台获取
            
                                //平台佣金总额
                                $plantform_resource_row = array();
                                $plantform_resource_row['plantform_resource_id'] = DATA_ID;
                                $plantform_resource_row['plantform_commission_fee'] = $trade_row['order_commission_fee'];
                                $flag_row[] = Plantform_ResourceModel::getInstance()->save($plantform_resource_row, true, true);
            
                            }
                            else
                            {
                                $consume_record_row['record_money']  = $trade_payment_amount;
                            }
        
                            $flag_row[] = $Consume_RecordModel->add($consume_record_row);
        
                            //卖家收益，进入冻结中?
                            $flag_row[] = $User_ResourceModel->edit($seller_id, array('user_money'=>$consume_record_row['record_money']), true); //where
                        }
                    }
                    else
                    {
    
                        //不是充值订单, 订单支付完成
                        if (StateCode::TRADE_TYPE_DEPOSIT != $trade_row['trade_type_id'])
                        {
                            $paid_order_id_row[] = $order_id;
                        }
                    }
                }
                

                if (is_ok($flag_row))
                {
    
                    if ($paid_order_id_row)
                    {
                        //远程服务器订单更改放入
    
                        //本地服务器订单更改
                        try
                        {
                            $flag_row[] = Order_BaseModel::getInstance()->setPaidYes($paid_order_id_row);
                            //Order_BaseModel::getInstance()->setPaidYes($paid_order_id_row);
                        }
                        catch (Exception $e)
                        {
    
                            Zero_Log::log($e->getMessage(), Zero_Log::ERROR, 'pay_order_setPaidYes');
                        }
                    }
    
                    try
                    {
                        // todo 暂时直接进入账户中，所以只有余额变动提醒
                        if ($return_insert_id && is_ok($flag_row)){
                            $message_id = 'balance-change-reminder';
                            $args = array(
                                'change_amount' => $consume_record_row['record_money'],
                                'des' => $consume_record_row['record_desc'],
                                'freeze_amount' => '',
                            );
                            Message_TemplateModel::getInstance()->sendNoticeMsg($user_id, 0, $message_id, $args);
                        }
                    }
                    catch (Exception $e)
                    {
                    }
                    
                    return $return_insert_id ? $deposit_row['deposit_id'] : is_ok($flag_row);
                }
                else
                {
                    return false;
                }
			}
			else
			{
			    if ($paid_order_id_row)
                {
                    //本地服务器订单更改
                    try
                    {
                        $flag_row[] = Order_BaseModel::getInstance()->setPaidYes($paid_order_id_row);
                    }
                    catch (Exception $e)
                    {
                        Zero_Log::log($e->getMessage(), Zero_Log::ERROR, 'pay_order_setPaidYes');
                    }
    
                }
                
				return $return_insert_id ? $deposit_row['deposit_id'] : true;;
			}
		}
		else
		{
			return false;
		}
	}

	/**
	 * 支付完成后,异步通知商城,更新订单状态
	 *
	 * @param  array $order_id  需要修改状态的订单
	 * @return bool  处理结果
	 * @access public
	 */
	public function notifyShop($order_id)
	{
	
	}
}


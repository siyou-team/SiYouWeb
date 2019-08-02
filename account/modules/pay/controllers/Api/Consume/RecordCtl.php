<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 交易明细-账户收支明细-资金流水-账户金额变化流水控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-23, Xinze
 * @request string $consume_record_id 支付流水号
 * @request string $order_id 商户订单id
 * @request int $store_id 所属用id
 * @request string $user_nickname 昵称
 * @request float $record_money 金额
 * @request string $record_date 年-月-日
 * @request int $record_year 年
 * @request int $record_month 月
 * @request int $record_day 日
 * @request string $record_title 标题
 * @request string $record_desc 描述
 * @request string $record_time 支付时间
 * @request int $trade_type_id 交易类型(ENUM):1201-购物; 1202-转账; 1203-充值; 1204-提现; 1205-销售; 1206-佣金;
 * @request int $payment_type_id 支付方式(ENUM):1301-货到付款; 1302-在线支付; 1305-线下支付;
 * @request int $payment_channel_id 
 */
class Api_Consume_RecordCtl extends Api_PayController
{
    /* @var $consumeRecordModel Consume_RecordModel */
    public $consumeRecordModel = null;

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

        //$this->consumeRecordModel = new Consume_RecordModel();
        $this->consumeRecordModel = Consume_RecordModel::getInstance();
        
        $this->model = $this->consumeRecordModel;
    }

    /**
     * 交易明细-账户收支明细-资金流水-账户金额变化流水列表数据
     * 
     * @access public
     */
    public function lists()
    {
        $store_id = Zero_Perm::getStoreId();

        $page = i('page', 1);  //当前页码
        $rows = i('rows', 500); //每页记录条数
        $sort = grid_sort();
        $trade_type_id = i('trade_type_id', 0);

        $column_row = array();
        if ($trade_type_id) {
            $column_row['trade_type_id'] = $trade_type_id;
        }

        //权限判断
        if (!Zero_Api_Controller::getPlantformRole())
        {
            if ($store_id = Zero_Perm::getStoreId())
            {
                $column_row['store_id'] = $store_id;
            }
    
            if ($chain_id = Zero_Perm::getChainId())
            {
                $column_row['chain_id'] = $chain_id;
            }
        }
    

        $data = $this->consumeRecordModel->getLists($column_row, $sort, $page, $rows);

        $this->render('pay', $data);
    }
    
    
    /**
     * 支付记录
     *
     * @access public
     */
    public function orderRecord()
    {
        $order_id = s('order_id'); //商户网站唯一订单号(DOT):合并支付则为多个订单号, 没有创建联合支付交易号 ","分割
        
        $rows = $this->consumeRecordModel->find(array('order_id'=>$order_id, 'trade_type_id'=>StateCode::TRADE_TYPE_SHOPPING), array('consume_record_id'=>'DESC'));
        
        //权限判断
        if (!Zero_Api_Controller::getPlantformRole())
        {
            $store_id = Zero_Perm::getStoreId();
            
            if (!Zero_Perm::checkDataRights($store_id, $rows, 'store_id'))
            {
                $rows = array();
            }
        }
    
        $rows = Payment_ChannelModel::fixChannelName($rows);
        
        
        $data = Consume_TradeModel::getInstance()->findOne(array('order_id'=>$order_id));
        $data['items'] = array_values($rows);
        
        
        $data['payment_waiting_review'] = 0;
        
        foreach ($data['items'] as $item)
        {
            if (!@$item['record_review'])
            {
                $data['payment_waiting_review'] = $data['payment_waiting_review'] + @$item['record_review'];
            }
        }
        
        
        $this->render('pay', $data);
    }
    
    /**
     * 读取交易明细-账户收支明细-资金流水-账户金额变化流水
     * 
     * @access public
     */
    public function get()
    {
        $consume_record_id_str = s('consume_record_id'); //支付流水号 ","分割
        $consume_record_id_row = explode(',', $consume_record_id_str);

        $rows = $this->consumeRecordModel->get($consume_record_id_row);

        //权限判断
        if (!Zero_Api_Controller::getPlantformRole())
        {
            $store_id = Zero_Perm::getStoreId();
    
            if (!Zero_Perm::checkDataRights($store_id, $rows, 'store_id'))
            {
                $rows = array();
            }
        }
        

        $this->render('pay', $rows);
    }

    /**
     * 添加交易明细-账户收支明细-资金流水-账户金额变化流水
     *
     * @access public
     */
    public function add()
    {
        $data['consume_record_id']      = s('consume_record_id')          ; // 支付流水号      
        $data['order_id']               = s('order_id')                   ; // 商户订单id      
        $data['store_id']                = i('store_id')                    ; // 所属用id
        $data['user_nickname']          = s('user_nickname')              ; // 昵称            
        $data['record_money']           = f('record_money')               ; // 金额            
        $data['record_date']            = s('record_date')                ; // 年-月-日        
        $data['record_year']            = i('record_year')                ; // 年              
        $data['record_month']           = i('record_month')               ; // 月              
        $data['record_day']             = i('record_day')                 ; // 日              
        $data['record_title']           = s('record_title')               ; // 标题            
        $data['record_desc']            = s('record_desc')                ; // 描述            
        $data['record_time']            = s('record_time')                ; // 支付时间        
        $data['trade_type_id']          = i('trade_type_id')              ; // 交易类型(ENUM):1201-购物; 1202-转账; 1203-充值; 1204-提现; 1205-销售; 1206-佣金;
        $data['payment_type_id']        = i('payment_type_id')            ; // 支付方式(ENUM):1301-货到付款; 1302-在线支付; 1305-线下支付;
        $data['payment_channel_id']     = i('payment_channel_id')         ; //                 

        unset($data['consume_record_id']);

        //权限判断
        $user_id = Zero_Perm::getUserId();
        $data['user_id'] = $user_id;

        $consume_record_id = $this->consumeRecordModel->add($data, true);

        if ($consume_record_id)
        {
            /*//余额变动提醒
            {
                $message_id = 'balance-change-reminder';
                $args = array(
                    'change_amount' => $data['record_money'],
                    'des' => $data['record_desc'],
                    'freeze_amount' => '',
                );
                Message_TemplateModel::getInstance()->sendNoticeMsg($user_id, 0, $message_id, $args);
            }*/
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }

        $data['consume_record_id'] = $consume_record_id;

        $this->render('pay', $data, $msg, $status);
    }

    /**
     * 删除交易明细-账户收支明细-资金流水-账户金额变化流水
     *
     * @access public
     */
    public function remove()
    {
        $consume_record_id_str = s('consume_record_id'); //支付流水号 ","分割
        $consume_record_id_row = explode(',', $consume_record_id_str);

        //权限判断
        $store_id = Zero_Perm::getStoreId();

        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($store_id, $rows=$this->consumeRecordModel->get($consume_record_id_row), 'store_id'))
        {
            $flag = $this->consumeRecordModel->remove($consume_record_id_row);

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

        $data['consume_record_id'] = $consume_record_id_row;

        $this->render('pay', $data, $msg, $status);
    }

    /**
     * 修改交易明细-账户收支明细-资金流水-账户金额变化流水
     *
     * @access public
     */
    public function edit()
    {
        $data['consume_record_id']      = s('consume_record_id')          ; // 支付流水号      
        $data['order_id']               = s('order_id')                   ; // 商户订单id      
        $data['store_id']                = i('store_id')                    ; // 所属用id
        $data['user_nickname']          = s('user_nickname')              ; // 昵称            
        $data['record_money']           = f('record_money')               ; // 金额            
        $data['record_date']            = s('record_date')                ; // 年-月-日        
        $data['record_year']            = i('record_year')                ; // 年              
        $data['record_month']           = i('record_month')               ; // 月              
        $data['record_day']             = i('record_day')                 ; // 日              
        $data['record_title']           = s('record_title')               ; // 标题            
        $data['record_desc']            = s('record_desc')                ; // 描述            
        $data['record_time']            = s('record_time')                ; // 支付时间        
        $data['trade_type_id']          = i('trade_type_id')              ; // 交易类型(ENUM):1201-购物; 1202-转账; 1203-充值; 1204-提现; 1205-销售; 1206-佣金;
        $data['payment_type_id']        = i('payment_type_id')            ; // 支付方式(ENUM):1301-货到付款; 1302-在线支付; 1305-线下支付;
        $data['payment_channel_id']     = i('payment_channel_id')         ; //                 


        $consume_record_id = $data['consume_record_id'];
        $data_rs = $data;
        unset($data['consume_record_id']);

        //权限判断
        $store_id = Zero_Perm::getStoreId();
        
        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($store_id, $rows=$this->consumeRecordModel->get($consume_record_id), 'store_id'))
        {
            $flag = $this->consumeRecordModel->edit($consume_record_id, $data);

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

        $this->render('pay', $data_rs, $msg, $status);
    }
}

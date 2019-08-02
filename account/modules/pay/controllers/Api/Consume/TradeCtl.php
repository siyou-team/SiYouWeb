<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 交易订单-强调唯一订单-充值则先创建充值订单控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-23, Xinze
 * @request int $consume_trade_id 交易订单id
 * @request string $trade_title 标题
 * @request string $order_id 商户订单id
 * @request int $buyer_id 买家id
 * @request int $store_id 店铺ID
 * @request int $seller_id 卖家id
 * @request int $trade_is_paid 支付状态
 * @request int $order_state_id 订单状态
 * @request int $trade_type_id 交易类型(ENUM):1201-购物; 1202-转账; 1203-充值; 1204-提现; 1205-销售; 1206-佣金;
 * @request int $payment_channel_id 支付渠道
 * @request int $app_id app_id
 * @request int $server_id 服务器id
 * @request int $trade_mode_id 交易模式(ENUM):1-担保交易;  2-直接交易
 * @request float $order_payment_amount 总付款额度: trade_payment_amount + trade_payment_money + trade_payment_recharge_card + trade_payment_points
 * @request float $trade_payment_amount 实付金额:在线支付金额
 * @request float $trade_payment_money 余额支付
 * @request float $trade_payment_recharge_card 充值卡余额支付
 * @request float $trade_payment_points 积分支付
 * @request float $trade_payment_credit 信用支付
 * @request float $trade_payment_redpack 红包支付
 * @request float $trade_discount 折扣优惠
 * @request float $trade_amount 总额虚拟:trade_order_amount + trade_discount
 * @request string $trade_date 年-月-日
 * @request int $trade_year 年
 * @request int $trade_month 月
 * @request int $trade_day 日
 * @request string $trade_desc 描述
 * @request string $trade_remark 备注
 * @request string $trade_create_time 创建时间
 * @request string $trade_pay_time 付款时间
 * @request string $trade_finish_time 结束时间
 * @request int $trade_delete 是否删除
 */
class Api_Consume_TradeCtl extends Api_PayController
{
    /* @var $consumeTradeModel Consume_TradeModel */
    public $consumeTradeModel = null;

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

        //$this->consumeTradeModel = new Consume_TradeModel();
        $this->consumeTradeModel = Consume_TradeModel::getInstance();
        
        $this->model = $this->consumeTradeModel;
    }

    /**
     * 交易订单-强调唯一订单-充值则先创建充值订单首页
     *
     * @access public
     */
    public function index()
    {
        $this->render('pay');
    }

    /**
     * 交易订单-强调唯一订单-充值则先创建充值订单管理界面
     *
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

    /**
     * 交易订单-强调唯一订单-充值则先创建充值订单列表数据
     * 
     * @access public
     */
    public function lists()
    {
        $store_id = Zero_Perm::getStoreId();

        $page = i('page', 1);  //当前页码
        $rows = i('rows', 500); //每页记录条数
        $sort = grid_sort();

        $column_row = array();

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

        if ($buyer_id = i("buyer_id"))
        {
            $column_row['buyer_id'] = $buyer_id;
        }
    

        $data = $this->consumeTradeModel->getLists($column_row, $sort, $page, $rows);
        $data['items'] = User_InfoModel::fixUserAvatar($data['items']);


        $this->render('pay', $data);
    }

    /**
     * 读取交易订单-强调唯一订单-充值则先创建充值订单
     * 
     * @access public
     */
    public function get()
    {
        $consume_trade_id_str = s('consume_trade_id'); //交易订单id ","分割
        $consume_trade_id_row = explode(',', $consume_trade_id_str);

        $rows = $this->consumeTradeModel->get($consume_trade_id_row);

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
     * 线下支付
     *
     * @access public
     */
    public function offline()
    {
        //权限判断
        $store_id = Zero_Perm::getStoreId();
        $chain_id = Zero_Perm::getChainId();
        $order_id = s('order_id');
        $trade_row = array();
        
        $Consume_TradeModel = new Consume_TradeModel();
        $trade_rows = $Consume_TradeModel->find(array('order_id'=>$order_id));
        $trade_payment_money = f('pm_money');
        $trade_payment_recharge_card = f('pm_recharge_card');
    
        $trade_payment_points = f('pm_points');
        $trade_payment_credit = f('pm_credit');
        $trade_payment_redpack = f('pm_redpack');
    
        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($store_id, $trade_rows, 'store_id') || Zero_Perm::checkDataRights($chain_id, $trade_rows, 'chain_id'))
        {
            $flag = true;
    
            //开启事务
            $Consume_TradeModel->sql->startTransactionDb();
    
            //修改余额支付结果
            if ($trade_payment_money || $trade_payment_recharge_card || $trade_payment_points || $trade_payment_credit || $trade_payment_redpack)
            {
                $flag = $Consume_TradeModel->processOfflinePay($trade_rows, $trade_payment_money, $trade_payment_recharge_card, $trade_payment_points, $trade_payment_credit, $trade_payment_redpack);
            }
    
            $trade_rows = $Consume_TradeModel->find(array('order_id'=>$order_id));
            $trade_row = current($trade_rows);
    
            //重新加载数据
            if ($flag)
            {
                $deposit_total_fee = f('deposit_total_fee')          ; // 交易金额
                $deposit_trade_no  = trim(s('deposit_trade_no'))           ; // 交易号:支付宝etc 汇款单号
                $deposit_subject  = s('deposit_subject')            ; // 商品名称
                $payment_channel_id = i('payment_channel_id');  // 线下支付 收款账户
                
                if ($deposit_total_fee>0 && !$deposit_trade_no)
                {
                    throw new Exception(__('请正确填写汇款凭证单号！'));
                }
                
                //取消的不给支付
                if ($deposit_total_fee>0 && $deposit_trade_no && $trade_row && $trade_row['trade_payment_amount']>0 && StateCode::ORDER_STATE_CANCEL != $trade_row['order_state_id'])
                {
                    $consume_trade_id = $trade_row['consume_trade_id'];
                    $order_id = $trade_row['order_id'];
                    $user_id = $trade_row['buyer_id'];
    
    
                    unset($trade_row['id']);
    
    
                    $notify_row = array();
    
    
                    //先处理预存款支付
                    
                    $notify_row['order_id']               = $order_id                   ; // 商户网站唯一订单号(DOT):合并支付则为多个订单号, 没有创建联合支付交易号
                    $notify_row['deposit_trade_no']       = $deposit_trade_no           ; // 交易号:支付宝etc 汇款单号
                    $notify_row['payment_channel_id']     = $payment_channel_id         ; // 线下支付 收款账户
                    $notify_row['app_id']                 = 0                     ; // 订单来源
                    $notify_row['server_id']              = 0                  ; // 服务器id:决定回调url
                    $notify_row['deposit_app_id_channel'] = 0     ; // 支付渠道app_id
                    $notify_row['deposit_subject']        = $deposit_subject            ; // 商品名称
                    $notify_row['deposit_payment_type']   = StateCode::PAYMENT_TYPE_OFFLINE       ; // 支付方式(ENUM):1301-货到付款; 1302-在线支付; 1305-线下支付;
                    $notify_row['deposit_trade_status']   = 'TRADE_SUCCESS'       ; // 交易状态
                    $notify_row['deposit_seller_id']      = ''          ; // 卖家户号:支付宝etc
                    $notify_row['deposit_seller_email']   = ''       ; // 卖家支付账号
                    $notify_row['deposit_buyer_id']       = ''           ; // 买家支付用户号
                    $notify_row['deposit_buyer_email']    = ''        ; // 买家支付宝账号
                    $notify_row['deposit_total_fee']      = $deposit_total_fee          ; // 交易金额
                    $notify_row['deposit_quantity']       = ''           ; // 购买数量
                    $notify_row['deposit_price']          = ''              ; // 商品单价
                    $notify_row['deposit_body']           = ''               ; // 商品描述
                    $notify_row['deposit_gmt_create']     = ''         ; // 交易创建时间
                    $notify_row['deposit_gmt_payment']    = s('deposit_notify_time')        ; // 交易付款时间
                    $notify_row['deposit_gmt_close']      = ''          ; //
                    $notify_row['deposit_is_total_fee_adjust'] = ''; // 是否调整总价
                    $notify_row['deposit_use_coupon']     = ''         ; // 是否使用红包买家
                    $notify_row['deposit_discount']       = ''           ; // 折扣
                    $notify_row['deposit_notify_time']    = s('deposit_notify_time')        ; // 通知时间
                    $notify_row['deposit_notify_type']    = ''        ; // 通知类型
                    $notify_row['deposit_notify_id']      = ''          ; // 通知校验ID
                    $notify_row['deposit_sign_type']      = ''          ; // 签名方式
                    $notify_row['deposit_sign']           = ''               ; // 签名
                    $notify_row['deposit_extra_param']    = ''        ; // 额外参数
                    $notify_row['deposit_service']        = ''            ; // 支付
                    $notify_row['deposit_state']          = 0              ; // 支付状态:0-默认; 1-接收正确数据处理完逻辑; 9-异常订单
                    $notify_row['deposit_async']          = 0              ; // 是否同步:0-同步; 1-异步回调使用
                    $notify_row['deposit_review']         = 1             ; // 收款确认(BOOL):0-未确认;1-已确认
    
                    $notify_row['deposit_enable']         = 1             ; // 是否作废(BOOL):1-正常; 2-作废
                    $notify_row['store_id']               = $store_id                   ; // 所属店铺
                    $notify_row['chain_id']               = $chain_id                   ; // 所属店铺
                    $notify_row['user_id']                = $user_id                    ; // 所属用户
    
                    unset($notify_row['deposit_id']);
    
    
                    $flag = Consume_DepositModel::getInstance()->processDeposit($notify_row);

                }
            }
            else
            {
                throw new Exception(__('余额支付信息错误！'));
            }
    
            if ($flag && $Consume_TradeModel->sql->commitDb())
            {
                //处理一步回调-通知商城更新订单状态
                //Consume_DepositModel::getInstance()->notifyShop($trade_rows);
    
                $msg = __('操作成功');
                $status = 200;
            }
            else
            {
                $Consume_TradeModel->sql->rollBackDb();
                
                $msg = __('操作失败');
                $status = 250;
            }
        }
        else
        {
            $msg = __('非法访问');
            $status = 250;
        }
        

        
        /*
        $data['consume_trade_id']       = i('consume_trade_id')           ; // 交易订单id      
        $data['trade_title']            = s('trade_title')                ; // 标题            
        $data['order_id']               = s('order_id')                   ; // 商户订单id      
        $data['buyer_id']               = i('buyer_id')                   ; // 买家id          
        $data['store_id']               = i('store_id')                   ; // 店铺ID          
        $data['seller_id']              = i('seller_id')                  ; // 卖家id          
        $data['trade_is_paid']          = i('trade_is_paid')              ; // 支付状态        
        $data['order_state_id']         = i('order_state_id')             ; // 订单状态        
        $data['trade_type_id']          = i('trade_type_id')              ; // 交易类型(ENUM):1201-购物; 1202-转账; 1203-充值; 1204-提现; 1205-销售; 1206-佣金;
        $data['payment_channel_id']     = i('payment_channel_id')         ; // 支付渠道        
        $data['app_id']                 = i('app_id')                     ; // app_id          
        $data['server_id']              = i('server_id')                  ; // 服务器id        
        $data['trade_mode_id']          = i('trade_mode_id')              ; // 交易模式(ENUM):1-担保交易;  2-直接交易
        $data['order_payment_amount']   = f('order_payment_amount')       ; // 总付款额度: trade_payment_amount + trade_payment_money + trade_payment_recharge_card + trade_payment_points
        $data['trade_payment_amount']   = f('trade_payment_amount')       ; // 实付金额:在线支付金额
        $data['trade_payment_money']    = f('trade_payment_money')        ; // 余额支付        
        $data['trade_payment_recharge_card'] = f('trade_payment_recharge_card'); // 充值卡余额支付  
        $data['trade_payment_points']   = f('trade_payment_points')       ; // 积分支付        
        $data['trade_payment_credit']   = f('trade_payment_credit')       ; // 信用支付        
        $data['trade_payment_redpack']  = f('trade_payment_redpack')      ; // 红包支付        
        $data['trade_discount']         = f('trade_discount')             ; // 折扣优惠        
        $data['trade_amount']           = f('trade_amount')               ; // 总额虚拟:trade_order_amount + trade_discount
        $data['trade_date']             = s('trade_date')                 ; // 年-月-日        
        $data['trade_year']             = i('trade_year')                 ; // 年              
        $data['trade_month']            = i('trade_month')                ; // 月              
        $data['trade_day']              = i('trade_day')                  ; // 日              
        $data['trade_desc']             = s('trade_desc')                 ; // 描述            
        $data['trade_remark']           = s('trade_remark')               ; // 备注            
        $data['trade_create_time']      = s('trade_create_time')          ; // 创建时间        
        $data['trade_pay_time']         = s('trade_pay_time')             ; // 付款时间        
        $data['trade_finish_time']      = s('trade_finish_time')          ; // 结束时间        
        $data['trade_delete']           = i('trade_delete')               ; // 是否删除        


        $consume_trade_id = $data['consume_trade_id'];
        $data_rs = $data;
        unset($data['consume_trade_id']);
        */



        $this->render('pay', $trade_row, $msg, $status);
    }
    
}

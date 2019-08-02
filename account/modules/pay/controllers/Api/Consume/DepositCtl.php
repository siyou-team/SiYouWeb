<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 充值-支付回调callback使用-确认付款控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-23, Xinze
 * @request string $deposit_id 商户网站唯一订单号(DOT):合并支付则为多个订单号, 没有创建联合支付交易号
 * @request string $deposit_trade_no 交易号:支付宝etc
 * @request int $payment_channel_id 支付渠道
 * @request int $app_id 订单来源
 * @request int $server_id 服务器id:决定回调url
 * @request int $deposit_app_id_channel 支付渠道app_id
 * @request string $deposit_subject 商品名称
 * @request int $deposit_payment_type 支付方式(ENUM):1301-货到付款; 1302-在线支付; 1305-线下支付;
 * @request string $deposit_trade_status 交易状态
 * @request string $deposit_seller_id 卖家户号:支付宝etc
 * @request string $deposit_seller_email 卖家支付账号
 * @request string $deposit_buyer_id 买家支付用户号
 * @request string $deposit_buyer_email 买家支付宝账号
 * @request float $deposit_total_fee 交易金额
 * @request int $deposit_quantity 购买数量
 * @request float $deposit_price 商品单价
 * @request string $deposit_body 商品描述
 * @request string $deposit_gmt_create 交易创建时间
 * @request string $deposit_gmt_payment 交易付款时间
 * @request string $deposit_gmt_close 
 * @request int $deposit_is_total_fee_adjust 是否调整总价
 * @request int $deposit_use_coupon 是否使用红包买家
 * @request float $deposit_discount 折扣
 * @request string $deposit_notify_time 通知时间
 * @request string $deposit_notify_type 通知类型
 * @request string $deposit_notify_id 通知校验ID
 * @request string $deposit_sign_type 签名方式
 * @request string $deposit_sign 签名
 * @request string $deposit_extra_param 额外参数
 * @request string $deposit_service 支付
 * @request int $deposit_state 支付状态:0-默认; 1-接收正确数据处理完逻辑; 9-异常订单
 * @request int $deposit_async 是否同步:0-同步; 1-异步回调使用
 * @request int $deposit_review 收款确认(BOOL):0-未确认;1-已确认
 */
class Api_Consume_DepositCtl extends Api_PayController
{
    /* @var $consumeDepositModel Consume_DepositModel */
    public $consumeDepositModel = null;

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

        //$this->consumeDepositModel = new Consume_DepositModel();
        $this->consumeDepositModel = Consume_DepositModel::getInstance();
        
        $this->model = $this->consumeDepositModel;
    }

    /**
     * 充值-支付回调callback使用-确认付款首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('pay');
    }
    
    /**
     * 充值-支付回调callback使用-确认付款管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

    /**
     * 充值-支付回调callback使用-确认付款列表数据
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
    

        $data = $this->consumeDepositModel->getLists($column_row, $sort, $page, $rows);

        $this->render('pay', $data);
    }

    /**
     * 读取充值-支付回调callback使用-确认付款
     * 
     * @access public
     */
    public function get()
    {
        $deposit_id_str = s('deposit_id'); //商户网站唯一订单号(DOT):合并支付则为多个订单号, 没有创建联合支付交易号 ","分割
        $deposit_id_row = explode(',', $deposit_id_str);

        $rows = $this->consumeDepositModel->get($deposit_id_row);

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
     * 买家线下支付，可以提交支付记录，卖家确认付款
     *
     * @access public
     */
    public function review()
    {
        $data['deposit_id']             = s('deposit_id')                      ; // 支付流水号
        $data['deposit_state']          = 1              ; // 支付状态:0-默认; 1-接收正确数据处理完逻辑; 9-异常订单
        $data['deposit_review']         = 1             ; // 收款确认(BOOL):0-未确认;1-已确认
        //$data['deposit_enable']         = i('deposit_enable')             ; // 是否作废(BOOL):1-正常; 2-作废
 

        $deposit_id = $data['deposit_id'];
        $data_rs = $data;
        unset($data['deposit_id']);

        //权限判断
        $store_id = Zero_Perm::getStoreId();
        $chain_id = Zero_Perm::getChainId();

        $notify_row = $this->consumeDepositModel->getOne($deposit_id);
        unset($notify_row['id']);

        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($store_id, $notify_row, 'store_id') || Zero_Perm::checkDataRights($chain_id, $notify_row, 'chain_id'))
        {
            //处理逻辑，
            //开启事务
            $this->consumeDepositModel->sql->startTransactionDb();
    
            $rs = $this->consumeDepositModel->processDeposit($notify_row);
    
            if ($rs && $this->consumeDepositModel->sql->commitDb())
            {
                //处理一步回调-通知商城更新订单状态
                $this->consumeDepositModel->notifyShop($notify_row);
    
                $msg = __('操作成功');
                $status = 200;
            }
            else
            {
                $this->consumeDepositModel->sql->rollBackDb();
    
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

    /**
     * 卖家确认收款
     */
    public function confirm()
    {
        $deposit_id = s('deposit_id');
        //权限判断
        $store_id = Zero_Perm::getStoreId();
        $chain_id = Zero_Perm::getChainId();

        $row = $this->consumeDepositModel->getOne($deposit_id);
        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($store_id, $row, 'store_id') || Zero_Perm::checkDataRights($chain_id, $row, 'chain_id')) {

            $flag = $this->consumeDepositModel->edit($deposit_id, array('deposit_review' => 1));

            if ($flag !== false) {
                $msg    = __('操作成功');
                $status = 200;
            } else {
                $msg    = __('操作失败');
                $status = 250;
            }
        } else {
            $msg    = __('操作失败');
            $status = 250;
        }
        $this->render('pay', $row, $msg, $status);
    }

    
    
    /**
     * 买家线下支付，可以提交支付记录，卖家确认付款
     *
     * @access public
     */
    public function disable()
    {
        $data['deposit_id']             = s('deposit_id')                      ; // 支付流水号
        //$data['deposit_state']          = i('deposit_state')              ; // 支付状态:0-默认; 1-接收正确数据处理完逻辑; 9-异常订单
        //$data['deposit_review']         = i('deposit_review')             ; // 收款确认(BOOL):0-未确认;1-已确认
        $data['deposit_enable']         = 2             ; // 是否作废(BOOL):1-正常; 2-作废
        
        
        $deposit_id = $data['deposit_id'];
        $data_rs = $data;
        unset($data['deposit_id']);
        
        //权限判断
        $store_id = Zero_Perm::getStoreId();
        $chain_id = Zero_Perm::getChainId();

        $rows = $this->consumeDepositModel->get($deposit_id);
        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($store_id, $rows, 'store_id') || Zero_Perm::checkDataRights($chain_id, $rows, 'chain_id'))
        {
            $flag = $this->consumeDepositModel->edit($deposit_id, $data);
            
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

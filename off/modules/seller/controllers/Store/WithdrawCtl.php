<?php if (!defined('ROOT_PATH')) exit('No Permission');

/**
 * 提现申请控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-10-25, Xinze
 * @request int $withdraw_id ID
 * @request int $user_id 会员支付ID
 * @request int $store_id 所属店铺
 * @request string $order_id 所属订单
 * @request float $withdraw_amount 提现额度
 * @request int $withdraw_state 是否成功(BOOL):0-申请中;1-提现通过
 * @request string $withdraw_desc 描述
 * @request string $withdraw_bank 银行
 * @request string $withdraw_account_no 银行账户
 * @request string $withdraw_account_name 开户名称
 * @request float $withdraw_fee 提现手续费
 * @request string $withdraw_time 创建时间
 * @request string $withdraw_bankflow 打款后银行流水账号
 * @request int $withdraw_user_id 操作管理员
 * @request string $withdraw_opertime 操作时间
 */
class Store_WithdrawCtl extends SellerAdminController
{
    /* @var $consumeWithdrawModel Consume_WithdrawModel */
    public $consumeWithdrawModel = null;

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

        //$this->consumeWithdrawModel = new Consume_WithdrawModel();
        $this->consumeWithdrawModel = Consume_WithdrawModel::getInstance();

        $this->model = $this->consumeWithdrawModel;
    }

    /**
     * 提现申请首页
     *
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }

    /**
     * 提现申请管理界面
     *
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }
}

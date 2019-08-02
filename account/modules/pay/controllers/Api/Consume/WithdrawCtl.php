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
class Api_Consume_WithdrawCtl extends Api_PayController
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

    /**
     * 提现申请列表数据
     * 
     * @access public
     */
    public function lists()
    {
        $user_id = Zero_Perm::getUserId();

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
    

        $data = $this->consumeWithdrawModel->getLists($column_row, $sort, $page, $rows);
        $data['items'] = User_InfoModel::fixUserAvatar($data['items']);

        $this->render('default', $data);
    }

    /**
     * 读取提现申请
     * 
     * @access public
     */
    public function get()
    {


        $withdraw_id_row = id('withdraw_id'); //ID

        $rows = $this->consumeWithdrawModel->get($withdraw_id_row);

        //权限判断
        if (!Zero_Api_Controller::getPlantformRole())
        {
            $store_id = Zero_Perm::getStoreId();
    
            if (!Zero_Perm::checkDataRights($store_id, $rows, 'store_id'))
            {
                $rows = array();
            }
        }
        

        $this->render('default', $rows);
    }



    /**
     * 修改提现申请
     *
     * @access public
     */
    public function edit()
    {
        $user_id = Zero_Perm::getUserId();
        $store_id = Zero_Perm::getStoreId();


        $data['withdraw_id']            = i('withdraw_id')                ; // ID
        $data['withdraw_state']         =  i('withdraw_state')            ; // 是否成功(BOOL):0-申请中;1-提现通过
        $data['withdraw_desc']          = s('withdraw_desc')              ; // 描述
        $data['withdraw_bankflow']      = s('withdraw_bankflow')          ; // 打款后银行流水账号
        $data['withdraw_opertime']      = s('withdraw_opertime')          ; // 打款后银行流水账号

        $withdraw_id = $data['withdraw_id'];
        $data_rs = $data;

        unset($data['withdraw_id']);
        $rs_row = array();


        $rows = $this->consumeWithdrawModel->getOne($withdraw_id);

        // 仅平台可修改状态 权限判断
        if (Zero_Api_Controller::getPlantformRole())
        {
            $this->consumeWithdrawModel->sql->startTransactionDb();

            if ($data['withdraw_state'] && !$rows['withdraw_state']){
                // 执行提现审核通过操作
                $flag = User_ResourceModel::money($rows['user_id'], -$rows['withdraw_amount'] , StateCode::TRADE_TYPE_WITHDRAW);
                check_rs($flag, $rs_row);
            } else {
                unset($data['withdraw_state']);
            }

            $flag = $this->consumeWithdrawModel->edit($withdraw_id, $data);
            check_rs($flag, $flag);

            if (is_ok($rs_row) && $this->consumeWithdrawModel->sql->commitDb())
            {
                $msg = __('操作成功');
                $status = 200;
            }
            else
            {
                $this->consumeWithdrawModel->sql->rollBackDb();

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

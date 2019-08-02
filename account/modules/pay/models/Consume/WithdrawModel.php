<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 提现申请模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-07-03, Xinze
 * @version    1.0
 * @todo
 */
class Consume_WithdrawModel extends Zero_Model
{
    public $_cacheName       = 'consume';
    public $_tableName       = 'consume_withdraw';
    public $_tablePrimaryKey = 'withdraw_id';
    public $_useCache        = false;
    public $_languageCond    = false;
    
    public $fieldType = array();

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'consume_withdraw_cond' => array(
            'user_id' => null,
            'store_id' => null,
            'chain_id' => null,
        )
    );

    public $_validateRules = array('integer'=>array('withdraw_id', 'user_id', 'withdraw_state', 'withdraw_user_id'), 'numeric'=>array('withdraw_amount', 'withdraw_fee'), 'date'=>array('withdraw_time', 'withdraw_opertime'));

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
     * 用户提现申请
     *
     * @param  array $data
     *
     * @return mixed $flag 返回结果
     * @access public
     */
    public function doWithdraw($data)
    {
        $user_id = $data['user_id'];
        /* @var $User_ResourceModel User_ResourceModel */
        $User_ResourceModel = User_ResourceModel::getInstance();
    
        $resource_row = $User_ResourceModel->getOne($user_id);
    
    
        //提现日期
        $withdraw_weekday = Base_ConfigModel::getConfig('withdraw_weekday', '');
        $week_row = explode(',', $withdraw_weekday);
        
        if (!in_array(date('w'), $week_row))
        {
            throw new Exception(sprintf(__('只有周: %s 可以申请提现!'), $withdraw_weekday));
        }
        
        
        if ($data['withdraw_amount'] <= 0)
        {
            throw new Exception(__('提现额度有误'));
        }
        
        if ($resource_row['user_money'] < $data['withdraw_amount'])
        {
            throw new Exception(__('可提现余额不足'));
        }
        
        
        if ($data['withdraw_amount'] < $withdraw_min_amount = Base_ConfigModel::getConfig('withdraw_min_amount', 0.00))
        {
            throw new Exception(sprintf(__('最低体现额度为: %f'), $withdraw_min_amount));
        }
        
        //扣除余额, 放入冻结余额
        $flag = $User_ResourceModel->editInc($user_id, array('user_money'=>-$data['withdraw_amount'], 'user_money_frozen'=>$data['withdraw_amount']));
    
        if ($flag)
        {
            $flag = $this->add($data);
        }
        
        //执行提现审核通过操作
        //User_ResourceModel::money($user_id, -$withdraw_amount, StateCode::TRADE_TYPE_WITHDRAW);
        
        return $flag;
    }
}


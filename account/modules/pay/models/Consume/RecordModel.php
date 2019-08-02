<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 交易明细-账户收支明细-资金流水-账户金额变化流水模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-23, Xinze
 * @version    1.0
 * @todo
 */
class Consume_RecordModel extends Zero_Model
{
    public $_cacheName       = 'consume';
    public $_tableName       = 'consume_record';
    public $_tablePrimaryKey = 'consume_record_id';
    public $_useCache        = false;
    public $_languageCond    = false;
    
    public $fieldType = array();

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'consume_record_cond'=>array(
            'store_id'=>null,
            'chain_id' => null,
            'order_id'=>null,
            'trade_type_id'=>null,
            'record_money'=>null,
            'user_id'=>null
        )
    );

    public $_validateRules = array('integer'=>array('user_id', 'record_year', 'record_month', 'record_day', 'trade_type_id', 'payment_type_id', 'payment_channel_id'), 'numeric'=>array('record_money'), 'date'=>array('record_date', 'record_time'));

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
    
        foreach ($data['items'] as $k=>$item)
        {
            $data['items'][$k]['trade_type_name'] = StateCode::getText($item['trade_type_id']);
        }
        
        User_InfoModel::fixUserAvatar($data['items']);
        
        return $data;
    }
}


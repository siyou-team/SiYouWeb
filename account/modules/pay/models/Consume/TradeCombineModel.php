<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 合并支付，一个或多个订单-所有支付入口-暂不使用：联合支付，传入多个订单id，合并计算价格，传入支付渠道更好？模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2018-02-07, Xinze
 * @version    1.0
 * @todo
 */
class Consume_TradeCombineModel extends Zero_Model
{
    public $_cacheName       = 'consume';
    public $_tableName       = 'consume_trade_combine';
    public $_tablePrimaryKey = 'ctc_id';
    public $_useCache        = false;
    public $_useListCache    = false;
    public $_languageCond    = false;

    public $fieldType = array('order_ids'=>'DOT');

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'consume_trade_combine_cond'=>array(
            'order_ids'=>null
        )
    );

    public $_validateRules = array('array'=>array('order_ids'), 'date'=>array('ctc_time'));

    public $_validateLabels= array();


    /**
     * @param string $user  User Object
     * @var   string $db_id 指定需要连接的数据库Id
     * @return void
     */
    public function __construct(&$db_id='pay', &$user=null)
    {
        $this->_useCache  = CHE;

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
     * 插入  - 可以传入二维数据一次添加多条记录 插入多条记录 实现批量插入数据
     * @param array $field_row 信息
     * @param bool $return_insert_id 自增主键
     * @param bool $replace 是否数据覆盖
     * @return bool  是否成功
     * @access public
     */
    public function addTradeCombine($field_row, $return_insert_id=false, $replace=false)
    {
        sort($field_row['order_ids']);

        $field_row['ctc_id'] = 'TC-' . md5(implode(',', $field_row['order_ids']));
        $field_row['ctc_time'] = get_datetime();

        return $this->save($field_row, $return_insert_id, $replace);
    }
}

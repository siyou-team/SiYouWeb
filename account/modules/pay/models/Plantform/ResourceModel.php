<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 平台佣金汇总模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2018-04-10, Xinze
 * @version    1.0
 * @todo
 */
class Plantform_ResourceModel extends Zero_Model
{
    public $_cacheName       = 'base';
    public $_tableName       = 'plantform_resource';
    public $_tablePrimaryKey = 'plantform_resource_id';
    public $_useCache        = false;
    public $_useListCache    = false;
    public $_languageCond    = false;
    
    public $fieldType = array();

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'plantform_resource_cond'=>array(
        )
    );

    public $_validateRules = array('integer'=>array('plantform_resource_id'), 'numeric'=>array('plantform_commission_fee', 'plantform_recharge_card', 'plantform_points', 'plantform_credit', 'plantform_credit_used', 'plantform_credit_total', 'plantform_redpack', 'plantform_redpack_frozen'));

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
}


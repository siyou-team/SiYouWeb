<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 卡片基础信息模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-28, Xinze
 * @version    1.0
 * @todo
 */
class Card_TypeModel extends Zero_Model
{
    public $_cacheName       = 'base';
    public $_tableName       = 'card_type';
    public $_tablePrimaryKey = 'card_type_id';
    public $_useCache        = false;
    public $_languageCond    = false;
    
    public $fieldType = array('card_type_prize'=>'JSON');

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'card_type_cond'=>array(
        )
    );

    public $_validateRules = array('integer'=>array('card_type_id', 'app_id'), 'date'=>array('card_type_starttime', 'card_type_endtime'));

    public $_validateLabels= array();

    public $_languageField = array(
        'it'=>array('card_type_name','card_type_desc')
    );

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


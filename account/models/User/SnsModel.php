<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 用户SNS信息模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-09-01, Xinze
 * @version    1.0
 * @todo
 */
class User_SnsModel extends Zero_Model
{
    public $_cacheName       = 'user';
    public $_tableName       = 'user_sns';
    public $_tablePrimaryKey = 'user_id';
    public $_useCache        = false;
    public $_useListCache    = false;

    public $fieldType = array();

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'user_sns_cond'=>array(
        )
    );

    public $_validateRules = array('integer'=>array('user_id', 'user_blog', 'user_friend', 'user_fans', 'user_growth', 'user_report', 'user_buy', 'user_comment'));

    public $_validateLabels= array();


    /**
     * @param string $user  User Object
     * @var   string $db_id 指定需要连接的数据库Id
     * @return void
     */
    public function __construct(&$db_id='account', &$user=null)
    {
        $this->_useCache  = CHE;

        $this->_tabelPrefix  = TABLE_ACCOUNT_PREFIX;
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


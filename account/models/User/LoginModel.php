<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 用户登录信息模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-05, Xinze
 * @version    1.0
 * @todo
 */
class User_LoginModel extends Zero_Model
{
    public $_cacheName       = 'user';
    public $_tableName       = 'user_login';
    public $_tablePrimaryKey = 'user_id';
    public $_useCache        = false;
    public $_languageCond    = false;
    
    public $fieldType = array();
    
    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'user_login_cond'=>array(
        )
    );
    
    public $_validateRules = array('integer'=>array('user_id', 'user_count_login'), 'date'=>array('user_reg_time', 'user_active_time', 'user_lastlogin_time'));
    
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
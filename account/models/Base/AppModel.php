<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 应用配置模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2016-11-09, Xinze
 * @version    1.0
 * @todo
 */
class Base_AppModel extends Zero_Model
{
	public $_cacheName       = 'base';
	public $_tableName       = 'base_app';
	public $_tablePrimaryKey = 'app_id';
	public $_useCache        = false;
	public $_languageCond    = false;
	
	public $fieldType = array('app_ip'=>'DOT', 'app_hosts'=>'DOT', 'app_return_fields'=>'DOT');

	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'base_app_cond'=>array(
		)
	);

	public $_validateRules = array('integer'=>array('app_id', 'app_type', 'app_seq'), 'array'=>array('app_ip', 'app_hosts', 'app_return_fields'));

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


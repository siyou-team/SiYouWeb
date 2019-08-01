<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 权限组模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-05, Xinze
 * @version    1.0
 * @todo
 */
class Rights_GroupModel extends Zero_Model
{
	public $_cacheName       = 'rights';
	public $_tableName       = 'rights_group';
	public $_tablePrimaryKey = 'rights_group_id';
	public $_useCache        = false;

	public $fieldType = array('rights_group_rights_ids'=>'DOT', 'rights_group_rights_data'=>'DOT');

	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'rights_group_cond'=>array(
		)
	);

	public $_validateRules = array('integer'=>array('rights_group_id'), 'array'=>array('rights_group_rights_ids', 'rights_group_rights_data'), 'date'=>array('rights_group_add_time'));

	public $_validateLabels= array();


	/**
	 * @param string $user  User Object
	 * @var   string $db_id 指定需要连接的数据库Id
	 * @return void
	 */
	public function __construct(&$db_id='shop_admin', &$user=null)
	{
		$this->_useCache  = false;

		$this->_tabelPrefix  = TABLE_SHOP_ADMIN_PREFIX;
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


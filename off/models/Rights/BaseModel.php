<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 权限 模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-05, Xinze
 * @version    1.0
 * @todo
 */
class Rights_BaseModel extends Zero_Model
{
	public $_cacheName       = 'rights';
	public $_tableName       = 'rights_base';
	public $_tablePrimaryKey = 'rights_id';
	public $_useCache        = false;

	public $fieldType = array();

	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'rights_base_cond'=>array(
		)
	);

	public $_validateRules = array('integer'=>array('rights_id', 'rights_parent_id', 'rights_order'));

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

	public function removeRights($rights_id)
    {
        $rr_row = array();

        $flag = $this->remove($rights_id);

        check_rs($flag, $rr_row);

        $flag = $this->removeCond(array('rights_parent_id'=>$rights_id));

        check_rs($flag, $rr_row);

        return is_ok($rr_row);


    }

}

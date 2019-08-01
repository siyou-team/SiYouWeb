<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 *
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class Order_ReturnModel extends Zero_Model
{
	public $_cacheName       = 'return';
	public $_tableName       = 'order_return';
	public $_tablePrimaryKey = 'return_id';
	public $_useCache        = false;

	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'order_return_cond'=>array(
			'store_id'=>null,
			'chain_id'=>null,
			'order_id'=>null,
			'return_id'=>null,
			'return_add_time'=>null,
			'order_good_id'=>null,
			'return_type'=>null
		)
	);

	/**
	 * @param string $user  User Object
	 * @var   string $db_id 指定需要连接的数据库Id
	 * @return void
	 */
	public function __construct(&$db_id='ypos', &$user=null)
	{
		$this->_useCache  = false;
        
        $this->_tabelPrefix  = TABLE_YPOS_PREFIX;
		parent::__construct($db_id, $user);
	}

	/**
	 * 读取分页列表
	 *
	 * @param  int $column_row where查询条件, 需要设置在multiCond中, 方便处理为group名字,用来通过组更新缓存
	 * @param  string $group 组名称
	 * @param  int $page 当前页码
	 * @param  int $rows 每页显示记录数
	 * @param  int $sort 排序方式
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getLists($column_row=array(), $sort=array(), $page=1, $rows=500)
	{
		//修改值 $column_row
		$data = $this->lists($column_row, $sort, $page, $rows);

		return $data;
	}
	
	//获取打印数据
	public function getPrintData($order_id)
	{
		$return_data = $this->find(array('order_id'=>$order_id));
		/* $order_goods_id = array_column($return_data,'order_good_id');
		$this->orderGoodsModel  = Order_GoodsModel::getInstance();	
		$order_data = $this->getOne($order_id);
        $data = $this->orderGoodsModel->find(array('order_id'=>$order_id)); */
		return $return_data;
	}
}
?>
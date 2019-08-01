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
class Goods_InventoryItemModel extends Zero_Model
{
	public $_cacheName       = 'inventory_item';
	public $_tableName       = 'goods_inventory_item';
	public $_tablePrimaryKey = 'inventory_item_id';
	public $_useCache        = false;
 
	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'goods_inventory_item_cond'=>array(
			'store_id' => null,
			'chain_id' => null,
			'inventory_item_id' => null,
			'goods_id' => null,
			'inventory_id' => null
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
		
		$this->inventoryTypeText = array(
			'1' => '产品入库',
			'2' => '销售出库',
			'3' => '调拨出库',
			'4' => '调拨入库',
			'5' => '库存盘点'
		);
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
		foreach($data['items'] as $k=>$v)
		{
			$data['items'][$k]['inventory_type_text'] = $this->inventoryTypeText[$v['inventory_type_id']];	
		}

		return $data;
	}
}
?>

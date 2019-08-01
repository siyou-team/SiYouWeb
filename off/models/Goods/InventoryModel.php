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
class Goods_InventoryModel extends Zero_Model
{
	public $_cacheName       = 'inventory';
	public $_tableName       = 'goods_inventory';
	public $_tablePrimaryKey = 'inventory_id';
	public $_useCache        = false;
 
	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'goods_inventory_cond'=>array(
			'store_id'=>null,
			'chain_id'=>null,
			'inventory_id'=>null,
			'inventory_add_time'=>null,
			'inventory_type_id'=>null,
			'in_chain_id'=>null,
			'inventory_checked'=>null,
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
	
	//出入库订单
	public function addInventoryOrder($type_code = 'IN',$type_id = 1)
	{
		$this->inventoryGoodsModel = Goods_InventoryItemModel::getInstance();
        $inventory_id  = Number_SequeModel::getInstance()->createNextSeq(sprintf('%s-%s-', $type_code, date('Ymd')));
		$supplier_id  = i('supplier');
		$this->store_id = Zero_Perm::getStoreId();
		$this->chain_id = Zero_Perm::getChainId();
		
		$add_row = array();
		$add_row['inventory_id']       = $inventory_id;
		$add_row['store_id']           = $this->store_id;
		$add_row['chain_id']           = $this->chain_id;
		$add_row['inventory_number']   = i('inventory_number');
		$add_row['inventory_amount']   = f('inventory_amount');
		$add_row['inventory_remark']   = s('remark');
		$add_row['inventory_date']     = date('Y-m-d');
		$add_row['inventory_add_time'] = get_datetime();
		$add_row['inventory_type_id']  = $type_id;
		$add_row['supplier_id']        = $supplier_id;
		$add_row['in_chain_id']        = i('in_chain_id'); //调入ID
		$inventory_checked = ($type_id == 3)? 0:1;
		$add_row['inventory_checked'] = $inventory_checked;

		$flag = $this->add($add_row);
		if($flag)
		{
			$this->stockModel = Goods_StockModel::getInstance();
			$inventoryGoods = r('inventoryGoods');
			
			//插入商品信息
			foreach($inventoryGoods as $k=>$v)
			{
				$goods_row = array();
				$goods_row['inventory_id']   = $inventory_id;
				$goods_row['goods_id']       = $v['goods_id'];
				$goods_row['goods_code']     = $v['goods_code'];
				$goods_row['goods_name']     = $v['goods_name'];
				$goods_row['goods_price']    = $v['goods_cost'];
				$goods_row['goods_quantity'] = $v['goods_quantity'];
				$goods_row['goods_amount']   = $v['goods_amount'];
				$goods_row['chain_id']       = $this->chain_id;
				$goods_row['store_id']       = $this->store_id;
				$goods_row['supplier_id']    = $supplier_id;
				$goods_row['goods_add_time'] = get_datetime();
				$goods_row['inventory_type_id']  = $type_id;
				$goods_row['goods_pre_stock']= $v['goods_pre_stock'];
				$goods_row['inventory_checked'] = $inventory_checked;
				
				$flag = $this->inventoryGoodsModel->add($goods_row,true);
				if($flag)
				{
					$goods_stock = $v['goods_quantity'];
					if($type_id == 3){$goods_stock *= (-1);}
					//更新商品库存
					$flag = $this->stockModel->updateStock($v['goods_id'],$goods_stock);
				}
			}
		}

		return $flag;
	}
	
	//出入库订单
	public function addInventory($type_code = 'IN',$type_id = 1,$row = array(),$goods = array())
	{
		$this->inventoryGoodsModel = Goods_InventoryItemModel::getInstance();
        $inventory_id  = Number_SequeModel::getInstance()->createNextSeq(sprintf('%s-%s-', $type_code, date('Ymd')));
		$this->store_id = Zero_Perm::getStoreId();
		$this->chain_id = Zero_Perm::getChainId();
		$supplier_id = $row['supplier_id'];
		
		$add_row = array();
		$add_row['inventory_id']       = $inventory_id;
		$add_row['store_id']           = $this->store_id;
		$add_row['chain_id']           = $this->chain_id;
		$add_row['inventory_number']   = $row['inventory_number'];
		$add_row['inventory_amount']   = $row['inventory_amount'];
		$add_row['inventory_remark']   = $row['remark'];
		$add_row['inventory_date']     = date('Y-m-d');
		$add_row['inventory_add_time'] = get_datetime();
		$add_row['inventory_type_id']  = $type_id;
		$add_row['supplier_id']        = $supplier_id;
		$add_row['in_chain_id']        = $row['in_chain_id']; //调入ID
		$inventory_checked = ($type_id == 3)? 0:1;
		$add_row['inventory_checked'] = $inventory_checked;

		$flag = $this->add($add_row);
		if($flag)
		{
			$this->stockModel = Goods_StockModel::getInstance();
 
			//插入商品信息
			foreach($goods as $k=>$v)
			{
				$goods_row = array();
				$goods_row['inventory_id']   = $inventory_id;
				$goods_row['goods_id']       = $v['goods_id'];
				$goods_row['goods_code']     = $v['goods_code'];
				$goods_row['goods_name']     = $v['goods_name'];
				$goods_row['goods_price']    = $v['goods_cost'];
				$goods_row['goods_quantity'] = $v['goods_stock'];
				$goods_row['goods_amount']   = $goods_row['goods_quantity']*$goods_row['goods_price'];
				$goods_row['chain_id']       = $this->chain_id;
				$goods_row['store_id']       = $this->store_id;
				$goods_row['supplier_id']    = $supplier_id;
				$goods_row['goods_add_time'] = get_datetime();
				$goods_row['inventory_type_id']  = $type_id;
				$goods_row['goods_pre_stock']= $v['goods_pre_stock'];
				$goods_row['inventory_checked'] = $inventory_checked;
				
				$flag = $this->inventoryGoodsModel->add($goods_row,true);
				if($flag)
				{
					$goods_stock = $goods_row['goods_quantity'];
					if($type_id == 3){$goods_stock *= (-1);}
					//更新商品库存
					$flag = $this->stockModel->updateStock($v['goods_id'],$goods_stock);
				}
			}
		}

		return $flag;
	}
}
?>
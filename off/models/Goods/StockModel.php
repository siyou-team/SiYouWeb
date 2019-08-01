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
class Goods_StockModel extends Zero_Model
{
	public $_cacheName       = 'stock';
	public $_tableName       = 'goods_stock';
	public $_tablePrimaryKey = 'stock_id';
	public $_useCache        = false;
	public $language_code    = 'zh-CN';
	public $store_id         = null;
	public $chain_id         = null;
	
	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'goods_stock_cond'=>array(
			'store_id'=>null,
			'goods_id'=>null,
			'chain_id'=>null,
			'language_code' => null,
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
		$this->language_code = Lang::range();
		parent::__construct($db_id, $user);
		
		$this->store_id = Zero_Perm::getStoreId();
		$this->chain_id = Zero_Perm::getChainId();
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
	
	//更新商品库存
	public function updateStock($goods_id = null,$stock = 0,$type = true)
	{
		$column_row = array();
		$column_row['store_id'] = $this->store_id;
		$column_row['chain_id'] = $this->chain_id;
		$column_row['goods_id'] = $goods_id;
		$data = $this->findOne($column_row);
		
		if(!empty($data))
		{
			$edit['goods_stock'] = $stock;
			$edit['update_time'] = get_datetime();
			$flag = $this->edit($data['stock_id'],$edit,$type);
		}else{
			$add = array();
			$add['goods_id']    = $goods_id;
			$add['goods_stock'] = $stock;
			$add['update_time'] = get_datetime();
			$add['store_id']    = $this->store_id;
			$add['chain_id']    = $this->chain_id;
			$add['language_code'] = $this->language_code;
			$flag = $this->add($add);
		}
		
		return $flag;
	}
	
	//获取产品列表并绑定库存
	public function getGoodsLists($column_row=array(), $sort=array(), $page=1, $rows=500)
	{
		$this->goodsModel = Goods_ItemModel::getInstance();
		$data = $this->goodsModel->lists($column_row, $sort, $page, $rows);
		
		//绑定商品库存
		if(!empty($data))
		{
			/* $goods_ids = array_column($data['items'],'goods_id');
			$stock_data = $this->find(array('goods_id:IN'=>$goods_ids,'store_id'=>$this->store_id,'chain_id'=>$this->chain_id));
			$data['test'] = array_column($stock_data,NULL,'goods_id'); */
			foreach($data['items'] as $k=>$v)
			{
				$stock_data = $this->findOne(array('goods_id'=>$v['goods_id'],'store_id'=>$this->store_id,'chain_id'=>$this->chain_id));
				$stock = $stock_data['goods_stock'];
				$data['items'][$k]['goods_stock'] = $stock?$stock:0;
			}
		}
		
		return $data;
	}
	
	//获取产品库存列表
	public function getGoodsStock($column_row=array(), $sort=array(), $page=1, $rows=500)
	{
		//$column_row['language_code'] = $this->language_code;
		$data = $this->lists($column_row, $sort, $page, $rows);	
		
		//绑定商品信息
		if(!empty($data))
		{
			$goods_ids = array_column($data['items'],'goods_id');
			$this->goodsModel = Goods_ItemModel::getInstance();
			$goods_data = $this->goodsModel->find(array('goods_id:IN'=>$goods_ids));
			
			foreach($data['items'] as $k=>$v)
			{
				$info = $goods_data[$v['goods_id']];
				$data['items'][$k]['goods_code']  = $info['goods_code'];
				$data['items'][$k]['goods_name']  = $info['goods_name'];
				$data['items'][$k]['goods_price'] = $info['goods_price'];
				$data['items'][$k]['goods_cost']  = $info['goods_cost'];
			}
		}
		
		return $data;
	}
	
	//商品出库
	public function goodsOut($order_data = array(), $goods_data = array())
	{
		$type_code = 'OUT';
        $inventory_id  = Number_SequeModel::getInstance()->createNextSeq(sprintf('%s-%s-', $type_code, date('Ymd')));
		$this->inventoryModel  = Goods_InventoryModel::getInstance();
		$this->inventoryGoodsModel = Goods_InventoryItemModel::getInstance();
		
		$store_id = $order_data['store_id'];
		$chain_id = $order_data['chain_id'];
		$add_row = array();
		$add_row['inventory_id']       = $inventory_id;
		$add_row['store_id']           = $store_id;
		$add_row['chain_id']           = $chain_id;
		$add_row['inventory_number']   = $order_data['order_number'];
		$add_row['inventory_amount']   = $order_data['order_pay_amount'];
		$add_row['inventory_date']     = date('Y-m-d');
		$add_row['inventory_add_time'] = get_datetime();
		$add_row['inventory_type_id']  = 2;
		$add_row['order_id']           = $order_data['order_id'];

		$flag = $this->inventoryModel->add($add_row);
		if($flag)
		{
			//插入商品信息
			foreach($goods_data as $k=>$v)
			{
				$goods_row = array();
				$goods_row['inventory_id']   = $inventory_id;
				$goods_row['goods_id']       = $v['goods_id'];
				$goods_row['goods_code']     = $v['goods_code'];
				$goods_row['goods_name']     = $v['goods_name'];
				$goods_row['goods_price']    = $v['goods_price'];
				$goods_row['goods_quantity'] = $v['Qty'];
				$goods_row['goods_amount']   = $v['TotalMoney'];
				$goods_row['chain_id']       = $chain_id;
				$goods_row['store_id']       = $store_id;
				$goods_row['goods_add_time'] = get_datetime();
				$goods_row['inventory_type_id']  = 2;
				$goods_row['goods_pre_stock']= $v['Count']+$v['Qty'];
				
				$flag = $this->inventoryGoodsModel->add($goods_row,true);
				if($flag)
				{
					//更新商品库存
					$stock = $v['Qty']*(-1);
					$flag = $this->updateStock($v['goods_id'],$stock);
				}
			}
		}
		
		return $flag;
	}
}
?>
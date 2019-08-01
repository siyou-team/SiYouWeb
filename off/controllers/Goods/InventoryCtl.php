<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Goods_InventoryCtl extends AdminController
{
    public $store_id = null;
	public $chain_id = null;
	public $inventoryModel  = null;
	public $inventoryGoodsModel = null;

    /**
     * Constructor
     *
     * @param  string $ctl 控制器目录
     * @param  string $met 控制器方法
     * @param  string $typ 返回数据类型
     * @access public
     */
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);

		$this->inventoryModel  = Goods_InventoryModel::getInstance();
		$this->inventoryGoodsModel = Goods_InventoryItemModel::getInstance();
		
        $this->store_id = Zero_Perm::$storeId;
		$this->chain_id = Zero_Perm::getChainId();
    }
	
	
    //库存首页
    public function index()
    {
		$this->render('default');
    }
	
	//产品入库
	public function add()
	{
		$this->inventoryModel->sql->startTransactionDb();
		$flag = $this->inventoryModel->addInventoryOrder('IN',1);
		
		if ($flag !== false && $this->inventoryModel->sql->commitDb())
        {
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $this->inventoryModel->sql->rollBackDb();
            $msg = __('操作失败');
            $status = 250;
        }
		
		$data = array();
        $this->render('default',$data,$msg,$status);
	}
	
	//获取商品库存列表
	public function stockLists()
	{
		$page = i('page', 1);  //当前页码
        $rows = i('rows', 10); //每页记录条数
        $sort = grid_sort();
		$this->stockModel = Goods_StockModel::getInstance();
		$column_row['store_id'] = $this->store_id;
		$column_row['chain_id'] = $this->chain_id;
		if($goods_code = s('goodsKey')){
			$goodsItemModel = Goods_ItemModel::getInstance();
			$goods_data = $goodsItemModel->findOne(array('goods_code'=>$goods_code));
			if(!empty($goods_data)){
				$column_row['goods_id'] = $goods_data['goods_id'];
			}else{
				$column_row['goods_id'] = -1;
			}
		}
		$data = $this->stockModel->getGoodsStock($column_row, $sort, $page, $rows);
		
		$this->render('default',$data);
	}
 
	//获取分店列表
	public function chainLists()
	{
		$this->chainModel = Chain_InfoModel::getInstance();
		$data = $this->chainModel->find(array('store_id'=>$this->store_id));
		$store[] = array('chain_id'=>1,'chain_name'=>__('总店'));
		
		if(!empty($data))
		{
			$data = $store + $data;
		}else{
			$data = $store;
		}
		
		$this->render('default',$data);
	}
 
	//出入库明细
	public function order()
	{
		$this->render('default');
	}
	
	//获取库存变更记录
	public function inventoryLog()
	{
		$page = i('pageIndex', 1);  //当前页码
        $rows = i('pageRows', 10); //每页记录条数
        $sort = array('inventory_add_time'=>'DESC');
		$column_row['store_id'] = $this->store_id;
		$column_row['chain_id'] = $this->chain_id;
		
		if($inventory_id = s('inventory_id')){
			$column_row['inventory_id:LIKE'] = '%'.$inventory_id.'%';
		}
		
		if($inventory_type = i('inventory_type')){
			$column_row['inventory_type_id'] = $inventory_type;
		}
		
		//发布时间
		if($btime = s('beginDate')){
			$column_row['inventory_add_time:>='] = $btime;
		}
		if($etime = s('endDate')){
			$column_row['inventory_add_time:<='] = $etime;
		}
 
		$data = $this->inventoryModel->getLists($column_row, $sort, $page, $rows);
		
		$this->render('default',$data);
	}
	
	//获取出入库单详情
	public function inventoryDetail()
	{
		$inventory_id = s('inventory_id');
		$column_row = array();
        $column_row['store_id'] = $this->store_id;
		$column_row['chain_id'] = $this->chain_id;
		$column_row['inventory_id'] = $inventory_id;
		$data = $this->inventoryGoodsModel->find($column_row);
		$data = array_values($data);
		
		$this->render('default',$data);
	}
}
?>
<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Goods_AllotCtl extends AdminController
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
	
	
    //首页
    public function index()
    {
		$this->render('default');
    }
	
	//调入单列表
	public function lists()
	{
		$page = i('pageIndex', 1);  //当前页码
        $rows = i('pageRows', 10); //每页记录条数
        $sort = array('inventory_add_time'=>'DESC');
		$column_row['store_id'] = $this->store_id;
		$column_row['in_chain_id'] = $this->chain_id;
		$column_row['inventory_type_id'] = 3;
		$column_row['inventory_checked'] = 0;
		
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
 
	//产品调拨
	public function add()
	{
		$this->inventoryModel->sql->startTransactionDb();
		$flag = $this->inventoryModel->addInventoryOrder('OUT',3);
		
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
	
	//调拨到货确认
	public function allotConfirm()
	{		
		$data = array();
        $this->render('default',$data,$msg,$status);
	}
}
?>
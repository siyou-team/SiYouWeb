<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Goods_SupplierCtl extends AdminController
{
	public $store_id = null;
	public $chain_id = null;
	public $supplierModel = null;
	
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
		
		$this->store_id = Zero_Perm::getStoreId();
		$this->chain_id = Zero_Perm::getChainId();
		$this->supplierModel = Goods_SupplierModel::getInstance();
    }
	
	
    /**
     * 首页
     * 
     * @access public
     */
    public function index()
    {		
		$this->render('default');
    }
	
	public function manage()
	{
		$data = array();
		
		if(i('typ') == 'json')
		{
			$supplier_id = i('supplier_id');
			$data = $this->supplierModel->getOne($supplier_id);
		}
			
        $this->render('default',$data);
	}
	
	//列表
	public function lists()
	{
		$page = i('page', 1);  //当前页码
        $rows = i('rows', 10); //每页记录条数
        $sort = array();
		
		$column_data = array();
		$column_data['store_id'] = $this->store_id;
		$data = $this->supplierModel->getLists($column_data, $sort, $page, $rows);
 
		$this->render('default',$data);
	}
	
	public function add()
	{
		$data['supplier_code'] = s('supplier_code');
		$data['supplier_name'] = s('supplier_name');
		$data['supplier_contactor'] = s('supplier_contactor');
		$data['supplier_telephone'] = s('supplier_telephone');
		$data['supplier_address'] = s('supplier_address');
		$data['supplier_remark'] = s('supplier_remark');
		$data['store_id'] = $this->store_id;
		$data['chain_id'] = $this->chain_id;
		$data['supplier_add_time'] = get_datetime();
		$flag = $this->supplierModel->add($data);
		
		if ($flag !== false)
        {
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }
		
		$this->render('default', $data, $msg, $status);
	}
 
	public function edit()
	{
		$supplier_id = i('supplier_id');
		$data['supplier_code'] = s('supplier_code');
		$data['supplier_name'] = s('supplier_name');
		$data['supplier_contactor'] = s('supplier_contactor');
		$data['supplier_telephone'] = s('supplier_telephone');
		$data['supplier_address'] = s('supplier_address');
		$data['supplier_remark'] = s('supplier_remark');
 	
		$flag = $this->supplierModel->edit($supplier_id,$data);
		
		if ($flag !== false)
        {
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }
		
		$this->render('default', $data, $msg, $status);
	}
 
	public function remove()
    {
        $supplier_id = i('supplier_id');
        $data['supplier_id'] = $supplier_id;
        $supplier = $this->supplierModel->getOne($supplier_id);
        if ($supplier && $supplier['store_id'] == $this->store_id)
        {
            $flag = $this->supplierModel->remove($supplier_id);
            if ($flag !== false)
            {
                $msg = __('操作成功');
                $status = 200;
            }
            else
            {
                $msg = __('操作失败');
                $status = 250;
            }
        }else{

            $msg = __('数据不存在');
            $status = 250;
        }

        $this->render('default', $data, $msg, $status);
    }
}
?>
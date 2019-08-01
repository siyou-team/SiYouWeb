<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Cashier_OrderCtl extends AdminController
{

	public $orderBaseModel  = null;
	public $orderGoodsModel = null;
    public $accountInfoModel = null;
	
	public $store_id = null;
	public $chain_id = null;

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

        $this->orderBaseModel   = Order_ListModel::getInstance();
		$this->orderGoodsModel  = Order_GoodsModel::getInstance();
        $this->accountInfoModel = User_InfoModel::getInstance();
		
		$this->store_id = Zero_Perm::$storeId;
		$this->chain_id = Zero_Perm::getChainId();
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

    public function lists()
    {
        $page = i('pageIndex', 1);  //当前页码
        $rows = i('pageRows', 8);   //每页记录条数
        $sort = array('order_create_time'=>'DESC');

        $column_row = array();
        $column_row['store_id'] = $this->store_id;
		$column_row['chain_id'] = $this->chain_id;

        if(s('order_id'))
        {
            $column_row['order_id'] = s('order_id');
        }
        if(i('order_type'))
        {
            $column_row['order_type'] = i('order_type');
        }
        if(s('beginDate'))
        {
            $column_row['order_create_time:>='] = s('beginDate');
        }
        if(s('endDate'))
        {
            $column_row['order_create_time:<='] = s('endDate');
        }
        if(f('beginMoney'))
        {
            $column_row['order_pay_amount:>='] = f('beginMoney');
        }
        if(f('endMoney'))
        {
            $column_row['order_pay_amount:<='] = f('endMoney');
        }

        $data = $this->orderBaseModel->getLists($column_row, $sort, $page, $rows);
        foreach($data['items'] as $k=>$v){
            if($v['user_id']){
                $user = $this->accountInfoModel->getUserOne($v['user_id']);
                $data['items'][$k]['user_realname'] = $user['user_realname'];
            }else{
                $data['items'][$k]['user_realname'] = '散客';
            }
        }
        $this->render('default', $data);
    }
	
	//获取订单产品
	public function orderGoods()
	{
		$order_id = s('order_id');
		$column_row = array();
        $column_row['store_id'] = $this->store_id;
		$column_row['chain_id'] = $this->chain_id;
		$column_row['order_id'] = $order_id;
		if($goods_status = i('goods_status')){
			$column_row['goods_status'] = $goods_status;
		}
		$data = $this->orderGoodsModel->find($column_row);
		foreach($data as $k=>$v){
			$data[$k]['return_quantity'] = $v['goods_number'] - $v['goods_return_number']; //商品可退数量 
			$data[$k]['order_goods_payamount'] = $v['order_goods_payamount'] - $v['goods_return_number']*$v['goods_pay_price'];
		}
		$data = array_values($data);
		$this->render('default',$data);
	}

	//获取打印数据
    public function getPrintData()
    {
        $order_id = s('order_id');
        $order_type = 2;
       		
        $data['printData'] = $this->orderBaseModel->getPrintData($order_id,$order_type);
        $this->render('default',$data);
    }
	
	//线上订单
	public function online()
	{
		$this->render('default');
	}
}
?>
<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Cashier_ReturnCtl extends AdminController
{

	public $orderBaseModel  = null;
	public $orderGoodsModel = null;
	public $returnModel = null;
 
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
		$this->returnModel = Order_ReturnModel::getInstance();

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
        $sort = array('return_add_time'=>'DESC');

        $column_row = array();
        $column_row['store_id'] = $this->store_id;
		$column_row['chain_id'] = $this->chain_id;

        if(s('order_id'))
        {
            $column_row['order_id'] = s('order_id');
        }
        if(i('return_type'))
        {
            $column_row['return_type'] = i('return_type');
        }
        if(s('beginDate'))
        {
            $column_row['return_add_time:>='] = s('beginDate');
        }
        if(s('endDate'))
        {
            $column_row['return_add_time:<='] = s('endDate');
        }
         
        $data = $this->returnModel->getLists($column_row, $sort, $page, $rows);
 
        $this->render('default', $data);
    }
 
	//获取打印数据
    public function getPrintData()
    {
        $order_id = s('order_id');
        $order_type = 2;
       		
        $data['printData'] = $this->orderBaseModel->getPrintData($order_id,$order_type);
        $this->render('default',$data);
    }
 
	//增加退货记录
	public function add()
	{
		$returnModel = Order_ReturnModel::getInstance();
		$return_order_id = Number_SequeModel::getInstance()->createNextSeq(sprintf('%s-%s-', "TH", date('Ymd')));
		$order_id = s('order_id');
		$return_goods = r('returnData');
		$return_remark = s('return_remark');
		$return_time = get_datetime();
		$user_row = Zero_Perm::getUserRow();
		$order_data = $this->orderBaseModel->getOne($order_id);
		$return_number = 0;
		$return_amount = 0;
		
		$returnModel->sql->startTransactionDb(); 
		foreach($return_goods as $k=>$v)
		{
			$add_row = array();
			$add_row['return_order_id'] = $return_order_id;
			$add_row['order_id'] = $order_id;
			$add_row['order_good_id'] = $v['order_goods_id'];
			$add_row['goods_name'] = $v['goods_name'];
			$add_row['store_id'] = $this->store_id;
			$add_row['chain_id'] = $this->chain_id;
			$add_row['return_type'] = 2;
			$add_row['return_quantity'] = $v['return_quantity'];
			$add_row['return_remark'] = $return_remark;
			$add_row['return_price']  = $v['goods_pay_price'];
			$add_row['return_money']  = $v['order_goods_payamount'];
			$add_row['return_add_time'] = $return_time;
			$add_row['operator_id'] = $user_row['user_id'];
			$add_row['operator_name'] = $user_row['user_account'];
			
			//增加商品退货记录
			$flag = $returnModel->add($add_row);
			
			//修改商品的状态和已退数量
			$goods_edit_row = array(); 
			$goods_return_number = $v['goods_return_number']+$v['return_quantity']; //退货数量
			$goods_edit_row['goods_return_number'] = $goods_return_number;
			if($goods_return_number == $v['consume_quantity'])
			{			
				$goods_edit_row['goods_status'] = 7;
			}
			$flag = $this->orderGoodsModel->edit($v['order_goods_id'],$goods_edit_row);
			
			//新增退货的数量
			$return_number += $v['return_quantity'];
			$return_amount += $v['order_goods_payamount'];
		}
		
		$return_number += $order_data['order_return_number'];
		$return_amount += $order_data['order_return_amount'];
		$order_edit_row = array();
		$order_edit_row['order_return_amount'] = $return_amount;
		$order_edit_row['order_return_number'] = $return_amount;
		
		//修改订单退货数量和退货金额
		if($return_number == $order_data['order_number'])
		{
			//商品的退货总数 = 订单的商品总数 订单改为关闭状态
			$order_edit_row['order_state_id'] = 7;
			
		} 
		
		$flag = $this->orderBaseModel->edit($order_id,$order_edit_row);
		
		if ($flag !== false && $returnModel->sql->commitDb())
        {
            $msg = __('操作成功');
            $status = 200;

			$printData = $this->returnModel->getPrintData($order_id);
        }
        else
        {
            $returnModel->sql->rollBackDb();
            $msg = __('操作失败');
            $status = 250;
        }
		
		$data['printData'] = array_values($printData);
		$this->render('default',$data,$msg,$status);
	}
}
?>
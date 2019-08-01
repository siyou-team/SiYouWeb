<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Cashier_QuickCtl extends AdminController
{
	public $orderBaseModel  = null;	
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

        $this->orderBaseModel  = Order_ListModel::getInstance();
		
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
	
	//快速消费
	public function saveQuickConsume()
	{
		$data = array();
		$printData = array();
		
		$type_code = 'SY';
		$order_id  = Number_SequeModel::getInstance()->createNextSeq(sprintf('%s-%s-', $type_code, date('Ymd')));
		
		$this->orderBaseModel->sql->startTransactionDb();		
		$add_row = array();
		$add_row['order_id'] = $order_id;     //订单号
		$add_row['user_id'] = i('user_id',0); //会员ID
		$add_row['user_name'] = s('user_name','散客'); //会员名称
		$add_row['order_amount'] = f('TotalMoney'); //订单金额
		$add_row['order_pay_amount'] = f('DiscountMoney'); //折后金额
		$add_row['order_points'] = f('TotalPoint'); //赠送积分
		$add_row['order_remark'] = s('Remark');  //订单备注
		$add_row['member_grade_id'] = i('member_grade_id'); //会员等级
		$add_row['member_grade_discountrate'] = f('member_grade_discountrate'); //会员折扣
        $add_row['member_grade_pointsrate'] = f('member_grade_pointsrate'); //积分比例
		$add_row['store_id'] = $this->store_id; //店铺ID
		$add_row['chain_id'] = $this->chain_id; //店铺ID
		$add_row['store_name'] = s('store_name'); //店铺信息
		$add_row['order_type'] = 1; //订单类型
		$add_row['order_create_time'] = get_datetime(); //订单创建时间
		$add_row['order_state_id'] = 2; //订单状态
        $add_row['pay_type'] = i('PayType');
		$add_row['pay_money'] = f('PayMoney');
		$add_row['pay_cash'] = f('PayCash');
		$add_row['pay_union'] = f('PayUnion');
		$add_row['pay_point'] = f('PayPoint');
		$add_row['pay_online'] = f('PayOther');
		
		$user_row = Zero_Perm::getUserRow();
		$add_row['order_operator'] = $user_row['user_account'];
 
		$flag = $this->orderBaseModel->add($add_row);
		if ($flag !== false && $this->orderBaseModel->sql->commitDb())
		{
			$msg = __('操作成功');
			$status = 200;

			if($add_row['user_id'])
			{
			    //增加积分
                $user_id = $add_row['user_id'];
				$this->pointsLogModel = Points_LogModel::getInstance();
                $this->pointsLogModel->pointsLog($user_id,$this->store_id,5,$add_row['order_points'],$order_id);
            }
		}
		else
		{
			$this->orderBaseModel->sql->rollBackDb();
			$msg = __('操作失败');
			$status = 250;
		}
 
		$data['printData'] = $printData;
		$data['PrintTemplateList'] = array();
		$this->render('default',$data);
	}
}
?>
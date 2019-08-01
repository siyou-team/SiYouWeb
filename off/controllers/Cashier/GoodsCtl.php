<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Cashier_GoodsCtl extends AdminController
{
	public $goodsItemModel  = null;
	public $goodsComboModel = null;
	public $orderBaseModel  = null;
	public $orderGoodsModel = null;

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

        $this->goodsItemModel   = Goods_ItemModel::getInstance();
		$this->goodsComboModel  = Goods_ComboModel::getInstance();
        $this->orderBaseModel   = Order_ListModel::getInstance();
        $this->orderGoodsModel  = Order_GoodsModel::getInstance();

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
	
	//获取产品列表
	public function goodsLists()
	{
		$page = i('pageIndex', 1);  //当前页码
        $rows = i('pageRows', 8);   //每页记录条数
        $sort = grid_sort();

        $column_row = array();
		$column_row['store_id'] = $this->store_id;
		$column_row['chain_id'] = $this->chain_id;
		if(s('goodsCode'))
		{
			$column_row['goods_code'] = s('goodsCode');
		}
		
		if(i('goods_type') == 5)
		{
			$data = $this->goodsComboModel->getLists($column_row, $sort, $page, $rows);
			foreach($data['items'] as $k=>$v)
			{
				$data['items'][$k]['goods_id'] = $v['combo_id'];
				$data['items'][$k]['goods_name'] = $v['combo_name'];
				$data['items'][$k]['goods_price'] = $v['combo_price'];
				$data['items'][$k]['goods_type'] = 5;
				$data['items'][$k]['goods_cat_id']= $v['combo_cat_id'];
				$data['items'][$k]['goods_code'] = $v['combo_code'];
				$data['items'][$k]['goods_cost'] = $v['combo_cost'];
				$data['items'][$k]['goods_is_discount'] = $v['combo_is_discount'];
				$data['items'][$k]['goods_is_points'] = $v['combo_is_points'];
				$data['items'][$k]['goods_min_rate'] = $v['combo_min_discount'];
				$data['items'][$k]['goods_points_type'] = $v['combo_points_amount'];
				$data['items'][$k]['goods_vip_price'] = 0;
			}
		}else{			
			$column_row['goods_status'] = 1;//正常销售商品
			$this->stockModel = Goods_StockModel::getInstance();
			$data = $this->stockModel->getGoodsLists($column_row, $sort, $page, $rows);
        }
		
		$this->render('default', $data);
	}

	//保存订单-商品消费
	public function saveGoodsConsume()
    {        
        $type_code = 'SY';
        $order_id  = Number_SequeModel::getInstance()->createNextSeq(sprintf('%s-%s-', $type_code, date('Ymd')));
		
		$user_name = s('CardID');		
		if($user_name == '0000')
		{
			$user_name = '散客';
		}
		$goods_data = r('orderData'); //订单数据

        $this->orderBaseModel->sql->startTransactionDb();      
		$add_row = array();
        $add_row['order_id'] = $order_id;     //订单号
        $add_row['user_id'] = i('MemID',0); //会员ID
        $add_row['user_name'] = $user_name; //会员名称
        $add_row['order_amount'] = f('TotalMoney'); //订单金额
        $add_row['order_pay_amount'] = f('DiscountMoney'); //折后金额
        $add_row['order_points'] = f('TotalPoint'); //赠送积分
        $add_row['order_remark'] = s('Remark');  //订单备注
        $add_row['member_grade_id'] = i('member_grade_id'); //会员等级
        $add_row['member_grade_discountrate'] = f('member_grade_discountrate'); //会员折扣
        $add_row['member_grade_pointsrate'] = f('member_grade_pointsrate'); //积分比例
        $add_row['store_id'] = $this->store_id; //店铺ID
		$add_row['chain_id'] = $this->chain_id; //分店ID
        $add_row['store_name'] = s('store_name'); //店铺信息
        $add_row['order_type'] = 2; //订单类型
        $add_row['order_create_time'] = get_datetime(); //订单创建时间
        $add_row['order_state_id'] = 2; //订单状态
        $add_row['pay_type'] = i('PayType');
		$add_row['pay_money'] = f('PayMoney');
		$add_row['pay_cash'] = f('PayCash');
		$add_row['pay_union'] = f('PayUnion');
		$add_row['pay_point'] = f('PayPoint');
		$add_row['pay_online'] = f('PayOther');
		$add_row['order_goods_num'] = i('GoodsNum'); //商品种类数
		$add_row['order_number'] = array_sum(array_column($goods_data,'Qty'));//商品总数
		$user_row = Zero_Perm::getUserRow();
		$add_row['order_operator'] = $user_row['user_account'];
		//订单成本价
		$order_cost = array_sum(array_column($goods_data,'goods_cost'));
		$add_row['order_cost'] = $order_cost;
 
        $flag = $this->orderBaseModel->add($add_row);	
		if($flag)
		{			
			if(!empty($goods_data))
			{
				foreach($goods_data as $k=>$v)
				{
					$goods_field = array();
					$goods_field['goods_id']   = $v['goods_id']; //商品ID
					$goods_field['goods_type'] = $v['goods_type']; //商品类型
					$goods_field['goods_code'] = $v['goods_code']; //商品编号
					$goods_field['goods_name'] = $v['goods_name']; //商品名称
					$goods_field['goods_price'] = $v['UnitPrice']; //商品售价
					$goods_field['goods_pay_price'] = $v['goods_price']; //支付单价
					$goods_field['order_goods_payamount'] = $v['Sum']; //应付金额 折扣后金额
					$goods_field['order_goods_amount'] = $v['TotalMoney']; //商品总价格 折扣前
					$goods_field['goods_is_points'] = $v['goods_is_points']; //是否赠送积分
					$goods_field['goods_points'] = $v['Point']; //商品赠送总积分
					$goods_field['goods_cat_id'] = $v['goods_cat_id']; //商品分类ID
					$goods_field['goods_number'] = $v['Qty']; //购买商品数量
					$goods_field['goods_add_time'] = get_datetime(); //时间
					$goods_field['order_id'] = $order_id; //时间
					$goods_field['goods_stock'] = $v['Count']; //剩余库存
					$goods_field['goods_cost'] = $v['goods_cost']; //成本价
					$goods_field['user_id'] = i('MemID',0); //会员ID
					$goods_field['store_id'] = $this->store_id; //店铺ID
					$goods_field['chain_id'] = $this->chain_id; //门店ID
					$goods_field['goods_discount'] = $v['goods_discount']; //商品折扣
					$goods_field['goods_tax_rate'] = $v['goods_tax_rate']; //商品税率
					
					$flag = $this->orderGoodsModel->add($goods_field,true);
					if($flag)
					{						
						$goods = $this->goodsItemModel->getOne($v['goods_id']);
						if(!empty($goods))
						{
							//修改商品销量
							$edit_row = array();
							$edit_row['goods_sales'] = $v['Qty'];
							$flag = $this->goodsItemModel->edit($v['goods_id'],$edit_row,true);
						}
					}
				}
			}

			if($add_row['user_id'])
			{
			    //增加积分
                $user_id = $add_row['user_id'];
				$this->pointsLogModel = Points_LogModel::getInstance();
                $this->pointsLogModel->pointsLog($user_id,$this->store_id,5,$add_row['order_points'],$order_id);
            }
			
			//生成出库单
			$this->stockModel = Goods_StockModel::getInstance();
			$flag = $this->stockModel->goodsOut($add_row,$goods_data);
		}
		
		$printData = array();
        if ($flag !== false && $this->orderBaseModel->sql->commitDb())
        {
            $msg = __('操作成功');
            $status = 200;

			$printData = $this->orderBaseModel->getPrintData($order_id,2);
        }
        else
        {
            $this->orderBaseModel->sql->rollBackDb();
            $msg = __('操作失败');
            $status = 250;
        }

        $data['printData'] = $printData;
        $data['PrintTemplateList'] = array();
        $this->render('default',$data,$msg,$status);
    }
}
?>
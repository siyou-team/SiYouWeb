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
class Order_ListModel extends Zero_Model
{
	public $_cacheName       = 'base';
	public $_tableName       = 'order_list';
	public $_tablePrimaryKey = 'order_id';
	public $_useCache        = false;

	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'order_list_cond'=>array(
			'store_id'=>null,
			'chain_id'=>null,
			'order_id'=>null,
			'user_id'=>null,
			'order_create_time'=>null,
			'order_pay_amount'=>null,
			'order_type'=>null,
			'order_state_id'=>null
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
	
	//获取打印数据
	public function getPrintData($order_id,$order_type)
	{
		$this->orderGoodsModel  = Order_GoodsModel::getInstance();	
		$order_data = $this->getOne($order_id);
        $order_goods = $this->orderGoodsModel->find(array('order_id'=>$order_id));
		foreach($order_goods as $k=>$v)
		{
			$order_goods[$k]['discount_amount'] = round($v['order_goods_amount'] - $v['order_goods_payamount'],2); //商品折扣总计
			$order_goods[$k]['discount'] = round($v['goods_price'] - $v['goods_pay_price'],2); //商品折扣价格
		}
		
		$data = array();
        $data['order_id'] = $order_id; //订单号
        $data['order_type'] =  $order_type;
        $data['user_name'] = $order_data['user_name'];
        $data['user_points'] = 0;//会员积分
        $data['order_amount'] = $order_data['order_amount'];//总金额
        $data['order_pay_amount'] = $order_data['order_pay_amount']; //实付金额
        $data['order_number'] = $order_data['order_number']; //数量
        $data['order_points'] = $order_data['order_points']; //积分
        $data['pay_money'] = $order_data['pay_money']; //余额支付
        $data['pay_cash'] = $order_data['pay_cash'];  //现金支付
        $data['pay_union'] = $order_data['pay_union'];  //银联支付
        $data['pay_online'] = $order_data['pay_online'];  //在线支付
        $data['operator'] = $order_data['order_operator']; //操作员
        $data['create_time'] = $order_data['order_create_time']; //消费时间
        $data['pay_type'] = $order_data['pay_type']; //支付方式
        $data['Contact'] = ''; //联系方式
        $data['rows1'] = array_values($order_goods);
		
		return $data;
	}
}
?>
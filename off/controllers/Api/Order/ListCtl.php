<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 订单详细信息-检索不分也行，cache控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-05-10, Xinze
 * @request string $order_id 订单Id
 * @request string $order_number 订单编号，商城内部使用
 * @request int $order_state_id 订单状态:2010-待付款;2020-待配货;2030-待发货;2040-已发货;2050-已签收;2060-已完成;2070-已取消;
 * @request float $order_payment_amount 应付金额/应支付金额=order_goods_amount - order_discount_amount + order_shipping_fee - order_voucher_price - order_points_fee - order_adjust_fee
 * @request string $order_time 订单生成时间
 * @request int $store_id 卖家店铺id
 * @request string $store_name 卖家店铺名称
 * @request int $buyer_user_id 买家id
 * @request string $buyer_user_name 买家姓名
 */
class Api_Order_ListCtl extends Api_AdminController
{        
	/* @var $  orderBaseModel Order_BaseModel */
    public $orderListModel = null;

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

        $this->orderListModel = Order_ListModel::getInstance();
        
        $this->model = $this->orderListModel;
    }

    /**
     * 订单详细信息-检索不分也行，cache列表数据
     * 
     * @access public
     */
    public function lists()
    {
		$data = $this->orderListModel->getLists();
		
		$this->render('default',$data);
    }

}

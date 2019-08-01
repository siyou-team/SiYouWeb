<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 订单商品控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-09-01, Xinze
 * @request string $order_item_id id
 * @request string $order_id 订单Id
 * @request int $buyer_id 买家user_id  冗余
 * @request int $store_id 店铺ID
 * @request string $product_id 产品SPU
 * @request string $item_id 货品SKU
 * @request string $item_name 商品名称
 * @request int $category_id 商品对应的类目ID
 * @request int $spec_id 规格id
 * @request string $spec_info 规格描述
 * @request float $item_unit_price 商品价格单价
 * @request float $order_item_unit_price 商品实际成交价单价
 * @request int $order_item_quantity 商品数量
 * @request string $order_item_image 商品图片
 * @request int $order_item_return_num 退货数量
 * @request float $order_item_amount 商品实际总金额 =  goods_pay_unit_price * goods_quantity
 * @request float $order_item_discount_amount 优惠金额  负数
 * @request float $order_item_adjust_fee 手工调整金额 负数
 * @request float $order_item_points_fee 积分费用
 * @request float $order_item_payment_amount 实付金额 : goods_payment_amount =  goods_amount + goods_discount_amount + goods_adjust_fee + goods_point_fee
 * @request int $order_item_evaluation_status 评价状态(ENUM): 1-未评价;2-已评价;3-失效评价
 * @request int $activity_type_id 活动类型:0-默认;1101-加价购=搭配宝;1102-店铺满赠-小礼品;1103-限时折扣;1104-优惠套装;1105-店铺优惠券coupon优惠券;1106-拼团;1107-满减送;1108-阶梯价
 * @request int $activity_id 促销活动ID:与activity_type_id搭配使用, 团购ID/限时折扣ID/优惠套装ID
 * @request float $order_item_commission_rate 分佣金比例
 */
class Order_ItemCtl extends SellerAdminController
{
    /* @var $orderItemModel Order_ItemModel */
    public $orderItemModel = null;

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

        //$this->orderItemModel = new Order_ItemModel();
        $this->orderItemModel = Order_ItemModel::getInstance();

        $this->model = $this->orderItemModel;
    }

    /**
     * 订单商品首页
     *
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }

    /**
     * 订单商品管理界面
     *
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

}
<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 退款退货-未发货退款，发货退货,卖家也可以决定不退货退款，买家申请退款不支持。卖家可以主动退款。控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-09-11, Xinze
 * @request string $return_id 退单号
 * @request string $return_number 退货编号
 * @request int $service_type_id 服务类型
 * @request string $order_id 订单编号
 * @request string $order_number 订单编号
 * @request float $order_amount 订单总额
 * @request string $order_item_ids 退货商品编号(DOT):0为退款
 * @request int $item_type_id 1默认2团购商品3限时折扣商品4组合套装5赠品
 * @request string $order_item_name 退款商品名称
 * @request int $order_item_num 退货数量
 * @request string $order_item_image 商品图片
 * @request string $return_item_image 退货凭证
 * @request float $return_refund_amount 退款金额 = goods_payment_amount/goods_quantity, 因为涉及到折扣等等  或者 为订单中  order_payment_amount
 * @request int $store_id 店铺编号
 * @request int $seller_user_id 卖家ID
 * @request string $seller_user_account 卖家账号
 * @request int $buyer_user_id 买家ID
 * @request string $buyer_user_account 买家会员名
 * @request string $return_add_time 添加时间
 * @request int $return_reason_id 退款理由id
 * @request string $return_reason 退款理由
 * @request string $return_buyer_message 买家退货备注
 * @request string $return_addr_contacter 收货人
 * @request string $return_tel 联系电话
 * @request string $return_addr 收货地址详情
 * @request int $return_post_code 邮编
 * @request int $express_id 物流公司编号
 * @request string $return_tracking_number 物流单号
 * @request int $plantform_return_state_id 申请状态平台(ENUM):3180-处理中;3181-为待管理员处理卖家同意或者收货后;3182-为已完成
 * @request int $return_state_id 卖家处理状态(ENUM): 3190-新发起等待卖家审核;3191-卖家同意; 3192-卖家不同意;3193-卖家审核通过如果有退货则收到退货
 * @request int $return_flag 退货类型(BOOL): 1-不用退货;2-需要退货
 * @request int $return_type 申请类型(ENUM): 1-退款申请; 2-退货申请; 3-虚拟退款
 * @request int $return_order_lock 订单锁定类型(BOOL):1-不用锁定;2-需要锁定
 * @request int $return_item_state_id 物流状态(LIST):2030-待发货;2040-已发货/待收货确认;2060-已完成/已签收;2070-已取消/已作废;
 * @request string $return_store_time 商家处理时间
 * @request string $return_store_message 商家备注
 * @request float $return_commision_fee 退还佣金
 * @request string $return_finish_time 退款完成时间
 * @request string $return_platform_message 平台留言
 */
class Order_ReturnCtl extends SellerAdminController
{
    /* @var $orderReturnModel Order_ReturnModel */
    public $orderReturnModel = null;

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

        //$this->orderReturnModel = new Order_ReturnModel();
        $this->orderReturnModel = Order_ReturnModel::getInstance();

        $this->model = $this->orderReturnModel;
    }

    /**
     * 退款退货-未发货退款，发货退货,卖家也可以决定不退货退款，买家申请退款不支持。卖家可以主动退款。首页
     *
     * @access public
     */
    public function index()
    {
        $data = $this->getUrl('Store_Config', 'get', null);

        $this->render('default', $data['data'], $data['msg'], $data['status']);
    }

    /**
     * 退款退货-未发货退款，发货退货,卖家也可以决定不退货退款，买家申请退款不支持。卖家可以主动退款。管理界面
     *
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }


    /**
     * 退款退货详情
     *
     * @access public
     */
    public function detail()
    {
        $data = $this->getUrl('Store_Config', 'get', null);

        $this->render('default', $data['data'], $data['msg'], $data['status']);
    }


    /**
     * 退货单审核
     *
     * @access public
     */
    public function reviewManage()
    {
        $this->render('manage');
    }


}

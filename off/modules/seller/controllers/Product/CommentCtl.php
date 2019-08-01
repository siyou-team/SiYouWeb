<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 商品评价控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-08-30, Xinze
 * @request string $comment_id
 * @request string $order_id 订单Id
 * @request string $product_id 产品SPU
 * @request string $item_id 商品id
 * @request string $item_name 商品规格
 * @request int $store_id 卖家店铺编号-冗余
 * @request string $store_name 店铺名称
 * @request int $user_id 买家id
 * @request string $user_name 买家姓名:user_nickname
 * @request float $comment_points 获得积分-冗余，独立表记录
 * @request int $comment_scores 评价星级1-5积分
 * @request string $comment_content 评价内容
 * @request string $comment_image 评论上传的图片(DOT)
 * @request int $comment_helpful 有帮助
 * @request int $comment_nohelpful 无帮助
 * @request string $comment_time 评价时间
 * @request int $comment_is_anonymous 匿名评价
 * @request int $comment_enable 评价信息的状态(BOOL): 1-正常显示; 0-禁止显示
 * @request int $comment_store_desc_credit 描述相符评分 - order_buyer_evaluation_status , 评价状态改变后不需要再次评论，根据订单走
 * @request int $comment_store_service_credit 服务态度评分 - order_buyer_evaluation_status
 * @request int $comment_store_delivery_credit 发货速度评分 - order_buyer_evaluation_status
 */
class Product_CommentCtl extends SellerAdminController
{


    /**
     * 商品评价首页
     *
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }

    /**
     * 商品评价管理界面
     *
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

    /**
     * 商品评价回复
     *
     * @access public
     */
    public function listCommentReply()
    {
        $this->render('default');
    }
}
<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 商品咨询控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-08-22, Xinze
 * @request int $ask_id 咨询id
 * @request int $ask_type_id 咨询类别id
 * @request int $product_id 商品id
 * @request int $store_id 店铺编号
 * @request int $user_id 用户id
 * @request string $user_nickname 用户名称
 * @request string $ask_question 咨询内容
 * @request string $ask_time 提问时间
 * @request string $ask_answer 答案
 * @request string $ask_answer_time 回答时间
 * @request int $ask_answer_user_id
 * @request string $ask_answer_user_nickname
 * @request int $ask_status 0-未回复 1-已回复
 */
class Product_AskBaseCtl extends SellerAdminController
{

    /**
     * 商品咨询首页
     *
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }

    /**
     * 商品咨询管理界面
     *
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }


}

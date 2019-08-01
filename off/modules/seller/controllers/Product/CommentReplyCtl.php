<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 商品评价回复控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-08-31, Xinze
 * @request string $comment_reply_id 评论回复id
 * @request string $comment_id 评论id
 * @request int $user_id 评论id
 * @request string $user_name 买家评论者姓名
 * @request int $user_id_to 回复用户
 * @request string $user_name_to 回复用户名称
 * @request string $comment_reply_content 评论回复内容
 * @request string $comment_reply_time 评论回复时间
 * @request int $comment_reply_enable 允许显示
 * @request int $comment_reply_isadmin 管理员评价
 */
class Product_CommentReplyCtl extends SellerAdminController
{

    /**
     * 商品评价回复首页
     *
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }

    /**
     * 商品评价回复管理界面
     *
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }


}

<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 积分礼品控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2018-03-25, Xinze
 * @request int $points_item_id 积分礼品索引id
 * @request string $points_item_number 积分礼品货号
 * @request string $points_item_name 积分礼品名称
 * @request float $points_item_price 积分礼品原价
 * @request int $points_item_points 积分礼品兑换所需积分
 * @request string $points_item_image 积分礼品默认封面图片
 * @request string $points_item_tag 积分礼品标签(DOT)
 * @request int $points_item_storage 积分礼品库存数
 * @request int $points_item_enable 积分礼品上架(BOOL): 0-表示下架;1-表示上架
 * @request int $points_item_recommend 积分礼品是否推荐(BOOL):1-是;0-否
 * @request string $points_item_add_time 积分礼品添加时间
 * @request string $points_item_keywords 积分礼品关键字
 * @request string $points_item_description 积分礼品描述
 * @request string $points_item_content 积分礼品详细内容
 * @request int $points_item_salenum 积分礼品售出数量
 * @request int $points_item_view 积分商品浏览次数
 * @request int $points_item_user_level 换购针对会员等级限制，默认为0,所有等级都可换购
 * @request int $points_item_islimit 是否限制每会员兑换数量(BOOL):0-不限制;1-限制
 * @request int $points_item_limitnum 每会员限制兑换数量
 * @request int $points_item_islimittime 是否限制兑换时间(BOOL):0-不限制；1-为限制
 * @request string $points_item_starttime 兑换开始时间
 * @request string $points_item_endtime 兑换结束时间
 * @request int $points_item_order 礼品排序
 */
class Points_ItemCtl extends AdminController
{
    /**
     * 积分礼品首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 积分礼品管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

}

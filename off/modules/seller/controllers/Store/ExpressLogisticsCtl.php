<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 物流 = shop_store_express控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2018-03-08, Xinze
 * @request int $logistics_id 物流Id
 * @request int $store_id 店铺
 * @request string $logistics_name 物流名称
 * @request string $logistics_pinyin 物流
 * @request int $logistics_number 物流公司编号
 * @request int $logistics_state 电子面单状态
 * @request int $express_id 对应快递公司
 * @request int $waybill_tpl_id 
 * @request int $logistics_is_default 是否为默认(BOOL):1-默认;0-非默认
 * @request string $logistics_tpl_item 
 * @request string $logistics_tpl_top 运单模板上偏移量，单位为毫米mm
 * @request string $logistics_tpl_left 运单模板左偏移量，单位为毫米mm
 * @request string $logistics_phone 联系电话
 * @request string $logistics_mobile 联系手机
 * @request string $logistics_contacter 联系人
 * @request string $logistics_tax 传真
 * @request string $logistics_address 联系地址
 * @request string $logistics_fee 物流运费
 * @request int $fee_type 运费类型(ENUM) 0-统一;1-区域
 * @request int $logistics_is_enable 是否启用(BOOL):1-启用;0-禁用
 */
class Store_ExpressLogisticsCtl extends SellerAdminController
{
    /**
     * 物流 = shop_store_express首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 物流 = shop_store_express管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }
}

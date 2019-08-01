<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 发货地址控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2018-03-08, Xinze
 * @request int $ss_id 地址Id
 * @request string $ss_name 地址简称
 * @request string $ss_mobile 手机号码
 * @request string $ss_telephone 联系电话
 * @request string $ss_contacter 联系人
 * @request string $ss_postalcode 联系IM:QQ
 * @request int $ss_province_id 省id
 * @request string $ss_province 省份
 * @request int $ss_city_id 市id
 * @request string $ss_city 市
 * @request int $ss_county_id 县
 * @request string $ss_county 县区
 * @request string $ss_address 详细地址-不必重复填写地区
 * @request string $ss_time 
 * @request int $ss_is_default 默认地址  0:否 1:是
 */
class Store_ShippingAddressCtl extends SellerAdminController
{
    /**
     * 发货地址首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 发货地址管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }
}

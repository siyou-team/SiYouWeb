<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 用户地址控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-12, Xinze
 * @request string $ud_id 订单Id
 * @request string $ud_name 地址简称
 * @request string $ud_mobile 手机号码
 * @request string $ud_telephone 联系电话
 * @request string $ud_contacter 联系人
 * @request string $ud_im 联系Im、MSN/QQ
 * @request int $ud_province_id 省id
 * @request string $ud_province 省份
 * @request int $ud_city_id 市id
 * @request string $ud_city 市
 * @request int $ud_county_id 县
 * @request string $ud_county 县区
 * @request string $ud_address 详细地址
 * @request string $ud_postalcode 邮政编码
 * @request string $ud_tag_name 地址标签：家里、公司等等
 * @request string $ud_time 添加时间
 * @request int $ud_is_default 是否默认
 */
class User_DeliveryAddressCtl extends SellerAdminController
{
    /* @var $userDeliveryAddressModel User_DeliveryAddressModel */
    public $userDeliveryAddressModel = null;

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

        //$this->userDeliveryAddressModel = new User_DeliveryAddressModel();
        $this->userDeliveryAddressModel = User_DeliveryAddressModel::getInstance();
        
        $this->model = $this->userDeliveryAddressModel;
    }

    /**
     * 用户地址首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 用户地址管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $data = array();

        if($ud_id = i('ud_id'))
        {

            $data = $this->userDeliveryAddressModel->getOne($ud_id);
            $data = $this->userDeliveryAddressModel->fixAddressData($data);

        }

        $this->render('manage', $data);
    }

}

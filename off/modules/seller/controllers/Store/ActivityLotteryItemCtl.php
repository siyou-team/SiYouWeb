<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 活动-通过插件实现控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-24, Xinze
 * @request int $activity_id 活动编号
 * @request int $store_id 店铺编号
 * @request int $store_id 用户编号
 * @request string $activity_name 活动名称
 * @request string $activity_title 活动标题
 * @request string $activity_remark 活动说明
 * @request int $activity_combo_id 套餐编号
 * @request int $activity_type_id 活动类型
 * @request string $activity_starttime 活动开始时间
 * @request string $activity_endtime 活动结束时间
 * @request int $activity_state 活动状态(ENUM):0-未开启;1-正常;2-已结束;3-管理员关闭
 * @request string $activity_rule 活动规则(json):不检索{rule_id:{}, rule_id:{}},统一解析规则{"requirement":{"buy":{"item":[1,2,3],"subtotal":"通过计算修正满足的条件"}},"rule":[{"total":100,"max_num":1,"item":{"1":1,"1200":3}},{"total":200,"max_num":1,"item":{"1":1,"1200":3}}]}
 */
class Store_ActivityLotteryItemCtl extends SellerAdminController
{
    /* @var $storeActivityBaseModel Store_ActivityBaseModel */
    public $storeActivityBaseModel = null;

    /**
     * Constructor
     *
     * @param  string $ctl 控制器目录
     * @param  string $met 控制器方法
     * @param  string $typ 返回数据类型
     * @access public
     * @throws Exception
     */
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);

        //$this->storeActivityBaseModel = new Store_ActivityBaseModel();
        $this->storeActivityBaseModel = Store_ActivityBaseModel::getInstance();

        $this->model = $this->storeActivityBaseModel;
    }

    /**
     * 活动-通过插件实现首页
     *
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }

    /**
     * 活动-通过插件实现管理界面
     *
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }



}

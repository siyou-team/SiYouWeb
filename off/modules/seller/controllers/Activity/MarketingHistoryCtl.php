<?php if (!defined('ROOT_PATH')) exit('No Permission');

class Activity_MarketingHistoryCtl extends SellerAdminController
{
    /* @var $activityMarketingHistoryModel Activity_MarketingHistoryModel */
    public $activityMarketingHistoryModel = null;

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

        //$this->activityMarketingHistoryModel = new Activity_MarketingHistoryModel();
        $this->activityMarketingHistoryModel = Activity_MarketingHistoryModel::getInstance();

        $this->model = $this->activityMarketingHistoryModel;
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

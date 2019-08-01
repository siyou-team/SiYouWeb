<?php if (!defined('ROOT_PATH')) exit('No Permission');

class Activity_LotteryHistoryCtl extends SellerAdminController
{
    /* @var $activityLotteryHistoryModel Activity_LotteryHistoryModel */
    public $activityLotteryHistoryModel = null;

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

        //$this->activityLotteryHistoryModel = new Activity_LotteryHistoryModel();
        $this->activityLotteryHistoryModel = Activity_LotteryHistoryModel::getInstance();

        $this->model = $this->activityLotteryHistoryModel;
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

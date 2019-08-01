<?php if (!defined('ROOT_PATH')) exit('No Permission');
class Store_ActivityBaseCtl extends SellerAdminController
{
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

        $_POST['activity_id'] =  i('activity_id');

        $data = $this->getUrl('Store_ActivityBase', 'get','seller');

        $this->render('manage', @$data['data']['activity_rule']['rule']);

    }


    public function buyManage()
    {
        $this->render('default');
    }

    public function ruleManage()
    {


        $this->render('default');
    }


    public function vouManage()
    {
        $this->render('manage');
    }

    public function discountManage()
    {

        $this->render('default');
    }

    public function fullRuleManage()
    {

        $this->render('default');

    }

    public function fullItemManage()
    {

        $this->render('default');
    }

    public function barginItemManage()
    {

        $this->render('default');
    }

    public function barginManage()
    {

        $this->render('default');
    }

    public function suitManage()
    {
        $this->render('default');
    }


    public function reductionRuleManage()
    {
        $this->render('default');
    }


    public function reductionItemManage()
    {
        $this->render('default');
    }

    public function pointShoppingManage()
    {
        $this->render('default');
    }


    public function fullBuyItemManage()
    {
        $this->render('default');
    }

    public function marketingManage()
    {
        $this->render('default');
    }

    public function lotteryManage()
    {
        $this->render('default');
    }

    public function lotteryItemManage()
    {
        $this->render('default');
    }

    public function groupManage()
    {
        $this->render('default');
    }

    public function addLotteryItemManage()
    {
        $this->render('default');
    }

    public function cutPriceManage()
    {
        $this->render('default');
    }
}

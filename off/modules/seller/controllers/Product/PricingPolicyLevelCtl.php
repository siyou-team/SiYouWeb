<?php if (!defined('ROOT_PATH')) exit('No Permission');
class Product_PricingPolicyLevelCtl extends SellerAdminController
{
    /**
     * 价格策略-按客户等级定价首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 价格策略-按客户等级定价管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

}

<?php if (!defined('ROOT_PATH')) exit('No Permission');
class Product_PricingPolicyWholesaleCtl extends SellerAdminController
{
    /**
     * 批发价格-首页
     *
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }

    /**
     * 批发价格-管理界面
     *
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

}

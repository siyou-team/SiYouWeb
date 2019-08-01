<?php if (!defined('ROOT_PATH')) exit('No Permission');
class Order_CommentCtl extends SellerAdminController
{

    /**
     * 订单店铺评价首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 订单店铺评价管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

}

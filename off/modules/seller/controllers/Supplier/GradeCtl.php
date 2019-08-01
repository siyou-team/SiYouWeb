<?php if (!defined('ROOT_PATH')) exit('No Permission');
class Supplier_GradeCtl extends SellerAdminController
{
    /**
     * 店铺基础信息首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 店铺基础信息管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }
}

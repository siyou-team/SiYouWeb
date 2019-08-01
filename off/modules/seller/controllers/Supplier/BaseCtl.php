<?php if (!defined('ROOT_PATH')) exit('No Permission');
class Supplier_BaseCtl extends SellerAdminController
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

    /**
     * 审核
     */
    public function verify()
    {

//        print_r($data);
        $this->render('default');
    }

     /**
     * 审核
     */
    public function grade()
    {

//        print_r($data);
        $this->render('default');
    }
}

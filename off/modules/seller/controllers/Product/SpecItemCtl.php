<?php if (!defined('ROOT_PATH')) exit('No Permission');
class Product_SpecItemCtl extends SellerAdminController
{
    /**
     * 商品规格值首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 商品规格值管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }
}

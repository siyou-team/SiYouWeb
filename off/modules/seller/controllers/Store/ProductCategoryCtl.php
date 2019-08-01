<?php if (!defined('ROOT_PATH')) exit('No Permission');
class Store_ProductCategoryCtl extends SellerAdminController
{
    /**
     * 店铺商品分类首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 店铺商品分类管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }
}

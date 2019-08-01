<?php if (!defined('ROOT_PATH')) exit('No Permission');
class Chain_UserCtl extends SellerAdminController
{
    /**
     * 门店用户首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 门店用户管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

}

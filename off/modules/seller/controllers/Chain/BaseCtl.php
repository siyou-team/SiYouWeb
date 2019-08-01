<?php if (!defined('ROOT_PATH')) exit('No Permission');

class Chain_BaseCtl extends SellerAdminController
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

    /**
     * 门店用户管理界面
     *
     * @access public
     */
    public function setChainAdmin()
    {
        $this->render('default');
    }
    
    /**
     * 门店用户管理界面
     *
     * @access public
     */
    public function getQrCode()
    {
        $this->render('default');
    }
}

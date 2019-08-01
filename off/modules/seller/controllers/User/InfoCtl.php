<?php if (!defined('ROOT_PATH')) exit('No Permission');


class User_InfoCtl extends SellerAdminController
{
    /**
     * 用户基本信息首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 用户基本信息管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }
}

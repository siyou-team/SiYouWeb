<?php if (!defined('ROOT_PATH')) exit('No Permission');

class Store_WaybillTplCtl extends SellerAdminController
{
    /**
     * 运单模板首页
     *
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 运单模板管理界面
     *
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }
    
}

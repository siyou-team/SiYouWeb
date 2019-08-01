<?php if (!defined('ROOT_PATH')) exit('No Permission');

class Store_TransportTypeCtl extends SellerAdminController
{
    /**
     * 自定义物流运费及售卖区域类型首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 自定义物流运费及售卖区域类型管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

}

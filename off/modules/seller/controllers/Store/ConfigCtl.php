<?php if (!defined('ROOT_PATH')) exit('No Permission');

class Store_ConfigCtl extends SellerAdminController
{
    /**
     * 店铺参数设置首页
     * 
     * @access public
     */
    public function index()
    {
        $data = $this->getUrl('Store_Config', 'get', null);
        
        $this->render('default', $data['data'], $data['msg'], $data['status']);
    }
    
    /**
     * 店铺参数设置管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }
    
    /**
     * 店铺参数设置首页
     *
     * @access public
     */
    public function orderProcess()
    {
        $data = $this->getUrl('Store_Config', 'get', null);
        
        $this->render('default', $data['data'], $data['msg'], $data['status']);
    }

}

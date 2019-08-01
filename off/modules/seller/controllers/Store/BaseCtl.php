<?php if (!defined('ROOT_PATH')) exit('No Permission');
class Store_BaseCtl extends SellerAdminController
{
    /**
     * 店铺基础信息首页
     * 
     * @access public
     */
    public function index()
    {
        $data = $this->getUrl('Store_Base', 'get');
        
        $this->render('default', $data['data'], $data['msg'], $data['status']);
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
     * 店铺风格管理
     *
     * @access public
     */
    public function themes()
    {
        $data = $this->getUrl('Store_Base', 'get');
    
        $ctl = 'Base_AppTpl';
        $met = 'lists';
        $typ = 'json';
    
        $formvars['rows'] = 99999;
    
        $rs = $this->getServiceData($ctl, $met, $formvars);
        $data['data']['items'] = $rs['data']['items'];
        
        
        $this->render('default', $data['data'], $data['msg'], $data['status']);
    }
}

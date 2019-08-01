<?php if (!defined('ROOT_PATH')) exit('No Permission');
class Store_ContractCtl extends SellerAdminController
{

    /**
     * 消费者保障服务店铺关联首页
     * 
     * @access public
     */
    public function index()
    {

        $data = $this->getUrl('Base_ContractType', 'getContractInfo');

        $this->render('default', $data['data'], $data['msg'], $data['status']);
    }
    
    /**
     * 消费者保障服务店铺关联管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }
}

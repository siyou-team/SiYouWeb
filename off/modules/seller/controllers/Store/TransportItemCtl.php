<?php if (!defined('ROOT_PATH')) exit('No Permission');
class Store_TransportItemCtl extends SellerAdminController
{
    /**
     * 自定义物流模板内容-只处理区域及运费。首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 自定义物流模板内容-只处理区域及运费。管理界面
     * 
     * @access public
     */
    public function manage()
    {

        $this->render('manage');
    }
}

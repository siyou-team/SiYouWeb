<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Store_CompanyCtl extends SellerAdminController
{
    /**
     * 首页
     *
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }

    /**
     * 管理界面
     *
     * @access public
     */
    public function manage()
    {
        $data = $this->getUrl('Store_Company', 'get');
    
        $this->render('default', $data['data']);
    }
}
?>
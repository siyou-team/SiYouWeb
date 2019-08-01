<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class Base_ProductBrandCtl extends SellerAdminController
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
		$this->render('manage');
	}
}
?>
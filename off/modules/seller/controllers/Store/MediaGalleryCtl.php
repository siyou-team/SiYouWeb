<?php if (!defined('ROOT_PATH')) exit('No Permission');
class Store_MediaGalleryCtl extends SellerAdminController
{
    /**
     * 用户相册首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 用户相册管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }
}

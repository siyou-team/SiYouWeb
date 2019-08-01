<?php if (!defined('ROOT_PATH')) exit('No Permission');
class Store_EmployeeDepartmentCtl extends SellerAdminController
{
    /**
     * 部门首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 部门管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

}

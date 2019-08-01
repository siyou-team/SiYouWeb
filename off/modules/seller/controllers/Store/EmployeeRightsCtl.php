<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 用户权限信息-废弃，使用store_employee控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-10-30, Xinze
 * @request int $employee_id 用户id
 * @request string $employee_group_id 用户权限组
 * @request string $employee_rights_ids 用户权限
 */
class Store_EmployeeRightsCtl extends SellerAdminController
{

    /**
     * 用户权限信息-废弃，使用store_employee首页
     *
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }

    /**
     * 用户权限信息-废弃，使用store_employee管理界面
     *
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }


}
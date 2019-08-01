<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 卖家用户—公司员工employee-通过user id启用用户中心控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-01, Xinze
 * @request int $employee_id 卖家id
 * @request int $store_id 店铺ID
 * @request int $user_id 会员ID
 * @request int $rights_group_id 卖家组ID
 * @request int $employee_is_admin 是否管理员(0-不是 1-是)
 * @request string $employee_login_time 最后登录时间
 */
class Store_EmployeeCtl extends SellerAdminController
{
    /**
     * 卖家用户—公司员工employee-通过user id启用用户中心首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 卖家用户—公司员工employee-通过user id启用用户中心管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

}

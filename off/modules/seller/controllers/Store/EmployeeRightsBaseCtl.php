<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 权限 控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-10-30, Xinze
 * @request int $rights_id 权限Id
 * @request string $rights_name 权限名称
 * @request int $rights_parent_id 权限父Id
 * @request string $rights_remark 备注
 * @request int $rights_order 排序
 */
class Store_EmployeeRightsBaseCtl extends SellerAdminController
{


    /**
     * 权限 首页
     *
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }

    /**
     * 权限 管理界面
     *
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

}
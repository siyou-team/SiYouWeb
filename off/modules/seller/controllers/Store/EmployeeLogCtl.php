<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 卖家日志控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-10-30, Xinze
 * @request string $employee_log_id
 * @request string $employee_log_content 日志内容
 * @request string $employee_log_time 日志时间
 * @request int $user_id 卖家id
 * @request string $user_name 卖家帐号
 * @request int $store_id 店铺编号
 * @request string $employee_log_ip 卖家ip
 * @request string $employee_log_url 日志url
 * @request int $employee_log_status 日志状态(0-失败 1-成功)
 */
class Store_EmployeeLogCtl extends SellerAdminController
{


    /**
     * 卖家日志首页
     *
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }

    /**
     * 卖家日志管理界面
     *
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

}
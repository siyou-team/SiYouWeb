<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 用户基本信息控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-01-08, Xinze
 * @request int $user_id 用户ID
 * @request string $user_account 用户名
 * @request string $user_password 密码
 * @request string $user_nickname 用户昵称
 * @request int $user_state 状态(ENUM):0-锁定;1-未激活;2-已激活;
 * @request string $user_key Cookie加密Key:修改密码更改 登录修改涉及多端，影响用户中心
 * @request string $user_salt 加点盐
 * @request string $user_token for site connect check： user_key密码登录更改， user_token connect请求验证就更改
 */
class User_BaseCtl extends SellerAdminController
{
    /**
     * 用户基本信息首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 用户基本信息管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }


    /**
     * 用户基本信息管理界面
     *
     * @access public
     */
    public function rights()
    {
        $rights_group_row = $this->getUrl('Store_EmployeeRightsGroup', 'find');

        $data['base'] = $rights_group_row['data'];

        $group_rights_row = explode(',', s('group_rights_id'));
        $data['group_rights_row'] = $group_rights_row;

        $this->render('default', $data);
    }

}

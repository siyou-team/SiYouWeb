<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 用户等级控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-05-24, Xinze
 * @request int $user_level_id 
 * @request string $user_level_name 等级名称
 * @request int $user_level_exp 条件-经验值
 * @request string $user_level_logo LOGO
 * @request int $user_level_validity 有效期-会员有效期1年， 0:永久有效  1年后扣除4000成长值，根据剩余成长值重新计算级别
 * @request int $user_level_exp_reduction 年费
 * @request int $user_level_annual_fee 年费
 * @request float $user_level_rate 折扣率
 * @request string $user_level_privilege 权益-参加rights功能-独立表实现
 * @request string $user_level_time 创建时间
 */
class Base_UserLevelCtl extends AdminController
{
    /**
     * 用户等级首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 用户等级管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

    /**
     * 用户等级设置
     *
     * @access public
     */
    public function expRule()
    {
        $this->render('manage');
    }
}

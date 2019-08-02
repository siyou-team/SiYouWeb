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
class Api_Base_UserLevelCtl extends Api_AccountController
{
    /* @var $baseUserLevelModel Base_UserLevelModel */
    public $baseUserLevelModel = null;

    /**
     * Constructor
     *
     * @param  string $ctl 控制器目录
     * @param  string $met 控制器方法
     * @param  string $typ 返回数据类型
     * @access public
     */
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);

        //$this->baseUserLevelModel = new Base_UserLevelModel();
        $this->baseUserLevelModel = Base_UserLevelModel::getInstance();
        
        $this->model = $this->baseUserLevelModel;
    }

    /**
     * 用户等级列表数据
     * 
     * @access public
     */
    public function lists()
    {
        $page = i('page', 1);  //当前页码
        $rows = i('rows', 500); //每页记录条数
        $sort = grid_sort();

        $column_row = array();


        $data = $this->baseUserLevelModel->getLists($column_row, $sort, $page, $rows);


        $this->render('default', $data);
    }

    /**
     * 添加用户等级
     *
     * @access public
     */
    public function add()
    {
        $data['user_level_name']        = s('user_level_name')            ; // 等级名称        
        $data['user_level_exp']         = i('user_level_exp')             ; // 条件-经验值     
        $data['user_level_logo']        = s('user_level_logo')            ; // LOGO            
        $data['user_level_validity']    = i('user_level_validity')        ; // 有效期-会员有效期1年， 0:永久有效  1年后扣除4000成长值，根据剩余成长值重新计算级别
        $data['user_level_exp_reduction'] = i('user_level_exp_reduction')   ; // 年费            
        $data['user_level_annual_fee']  = i('user_level_annual_fee')      ; // 年费            
        $data['user_level_rate']        = f('user_level_rate')            ; // 折扣率          
        $data['user_level_privilege']   = s('user_level_privilege')       ; // 权益-参加rights功能-独立表实现

        unset($data['user_level_id']);

        //权限判断
        $user_id = Zero_Perm::getUserId();
        
        if (Zero_Api_Controller::getPlantformRole())
        {
            $user_level_id = $this->baseUserLevelModel->add($data, true);
        }

        if ($user_level_id)
        {
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }

        $data['user_level_id'] = $user_level_id;

        $this->render('default', $data, $msg, $status);
    }

    /**
     * 删除用户等级
     *
     * @access public
     */
    public function remove()
    {
        $user_level_id_str = s('user_level_id'); // ","分割
        $user_level_id_row = explode(',', $user_level_id_str);

        //权限判断
        $user_id = Zero_Perm::getUserId();

        if (Zero_Api_Controller::getPlantformRole())
        {
            $flag = $this->baseUserLevelModel->remove($user_level_id_row);

            if ($flag !== false)
            {
                $msg = __('操作成功');
                $status = 200;
            }
            else
            {
                $msg = __('操作失败');
                $status = 250;
            }
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }

        $data['user_level_id'] = $user_level_id_row;

        $this->render('default', $data, $msg, $status);
    }

    /**
     * 修改用户等级
     *
     * @access public
     */
    public function edit()
    {
        $data['user_level_id']          = i('user_level_id')              ; //                 
        $data['user_level_name']        = s('user_level_name')            ; // 等级名称        
        $data['user_level_exp']         = i('user_level_exp')             ; // 条件-经验值     
        $data['user_level_logo']        = s('user_level_logo')            ; // LOGO            
        $data['user_level_validity']    = i('user_level_validity')        ; // 有效期-会员有效期1年， 0:永久有效  1年后扣除4000成长值，根据剩余成长值重新计算级别
        $data['user_level_exp_reduction'] = i('user_level_exp_reduction')   ; // 年费            
        $data['user_level_annual_fee']  = i('user_level_annual_fee')      ; // 年费            
        $data['user_level_rate']        = f('user_level_rate')            ; // 折扣率          
        $data['user_level_privilege']   = s('user_level_privilege')       ; // 权益-参加rights功能-独立表实现
        $data['user_level_time']        = get_datetime()            ; // 创建时间


        $user_level_id = $data['user_level_id'];
        $data_rs = $data;
        unset($data['user_level_id']);

        //权限判断
        $user_id = Zero_Perm::getUserId();
        
        if (Zero_Api_Controller::getPlantformRole())
        {
            $flag = $this->baseUserLevelModel->edit($user_level_id, $data);

            if ($flag !== false)
            {
                $msg = __('操作成功');
                $status = 200;
            }
            else
            {
                $msg = __('操作失败');
                $status = 250;
            }
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }

        $this->render('default', $data_rs, $msg, $status);
    }
}

<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 定额充值控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2018-06-23, Xinze
 * @request int $recharge_level_id 
 * @request string $recharge_level_name 额度名称
 * @request int $recharge_level_value 充值额度
 * @request float $recharge_level_gift 收益
 * @request int $recharge_level_validity 有效期:按天计算
 * @request float $recharge_level_rate 赠送积分比例
 * @request string $recharge_level_time 修改时间
 */
class Api_Base_RechargeLevelCtl extends Api_PayController
{
    /* @var $baseRechargeLevelModel Base_RechargeLevelModel */
    public $baseRechargeLevelModel = null;

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

        //$this->baseRechargeLevelModel = new Base_RechargeLevelModel();
        $this->baseRechargeLevelModel = Base_RechargeLevelModel::getInstance();
        
        $this->model = $this->baseRechargeLevelModel;
    }

    /**
     * 定额充值列表数据
     * 
     * @access public
     */
    public function lists()
    {
        $user_id = Zero_Perm::getUserId();

        $page = i('page', 1);  //当前页码
        $rows = i('rows', 500); //每页记录条数
        $sort = grid_sort();

        $column_row = array();

        //权限判断
        if (!Zero_Api_Controller::getPlantformRole())
        {
            $user_id = Zero_Perm::getUserId();
            $column_row['user_id'] = $user_id;
        }
    

        $data = $this->baseRechargeLevelModel->getLists($column_row, $sort, $page, $rows);

        $this->render('default', $data);
    }

    /**
     * 读取定额充值
     * 
     * @access public
     */
    public function get()
    {
        $recharge_level_id_row = id('recharge_level_id'); //

        $rows = $this->baseRechargeLevelModel->get($recharge_level_id_row);

        //权限判断
        if (!Zero_Api_Controller::getPlantformRole())
        {
            $user_id = Zero_Perm::getUserId();
    
            if (!Zero_Perm::checkDataRights($user_id, $rows, 'user_id'))
            {
                $rows = array();
            }
        }
        

        $this->render('default', $rows);
    }

    /**
     * 添加定额充值
     *
     * @access public
     */
    public function add()
    {
        $data['recharge_level_id']      = i('recharge_level_id')          ; //                 
        $data['recharge_level_name']    = s('recharge_level_name')        ; // 额度名称        
        $data['recharge_level_value']   = i('recharge_level_value')       ; // 充值额度        
        $data['recharge_level_gift']  = f('recharge_level_gift')      ; // 收益
        $data['recharge_level_validity'] = i('recharge_level_validity')    ; // 有效期:按天计算 
        $data['recharge_level_rate']    = f('recharge_level_rate')        ; // 赠送积分比例    
        $data['recharge_level_time']    = s('recharge_level_time')        ; // 修改时间        

        unset($data['recharge_level_id']);

        //权限判断
        $user_id = Zero_Perm::getUserId();
        $data['user_id'] = $user_id;

        $recharge_level_id = $this->baseRechargeLevelModel->add($data, true);

        if ($recharge_level_id)
        {
            $msg = __('success');
            $status = 200;
        }
        else
        {
            $msg = __('failure');
            $status = 250;
        }

        $data['recharge_level_id'] = $recharge_level_id;

        $this->render('default', $data, $msg, $status);
    }

    /**
     * 删除定额充值
     *
     * @access public
     */
    public function remove()
    {
        $recharge_level_id_row = id('recharge_level_id'); //

        //权限判断
        $user_id = Zero_Perm::getUserId();

        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($user_id, $rows=$this->baseRechargeLevelModel->get($recharge_level_id_row), 'user_id'))
        {
            $flag = $this->baseRechargeLevelModel->remove($recharge_level_id_row);

            if ($flag !== false)
            {
                $msg = __('success');
                $status = 200;
            }
            else
            {
                $msg = __('failure');
                $status = 250;
            }
        }
        else
        {
            $msg = __('failure');
            $status = 250;
        }

        $data['recharge_level_id'] = $recharge_level_id_row;

        $this->render('default', $data, $msg, $status);
    }

    /**
     * 修改定额充值
     *
     * @access public
     */
    public function edit()
    {
        $data['recharge_level_id']      = i('recharge_level_id')          ; //                 
        $data['recharge_level_name']    = s('recharge_level_name')        ; // 额度名称        
        $data['recharge_level_value']   = i('recharge_level_value')       ; // 充值额度        
        $data['recharge_level_gift']  = f('recharge_level_gift')      ; // 收益
        $data['recharge_level_validity'] = i('recharge_level_validity')    ; // 有效期:按天计算 
        $data['recharge_level_rate']    = f('recharge_level_rate')        ; // 赠送积分比例    
        $data['recharge_level_time']    = s('recharge_level_time')        ; // 修改时间        


        $recharge_level_id = $data['recharge_level_id'];
        $data_rs = $data;
        unset($data['recharge_level_id']);

        //权限判断
        $user_id = Zero_Perm::getUserId();
        
        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($user_id, $rows=$this->baseRechargeLevelModel->get($recharge_level_id), 'user_id'))
        {
            $flag = $this->baseRechargeLevelModel->edit($recharge_level_id, $data);

            if ($flag !== false)
            {
                $msg = __('success');
                $status = 200;
            }
            else
            {
                $msg = __('failure');
                $status = 250;
            }
        }
        else
        {
            $msg = __('failure');
            $status = 250;
        }

        $this->render('default', $data_rs, $msg, $status);
    }
    
    /**
     * 修改，单一字段。
     *
     * @access public
     */
    public function enable($render = false)
    {
        $this->model = $this->baseRechargeLevelModel;
        $recharge_level_id = s('recharge_level_id');
        
        //权限判断
        $user_id = Zero_Perm::getUserId();
        
        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($user_id, $rows=$this->baseRechargeLevelModel->get($recharge_level_id), 'user_id'))
        {
            parent::enable($render);
        }
    }
}

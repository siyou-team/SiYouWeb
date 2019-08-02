<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 群组控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-09-20, Xinze
 * @request int $zone_id 好友组ID
 * @request string $zone_name 群组名称
 * @request int $zone_type 群组类型(ENUM):0-临时组上限100人;  1-普通组上限300人; 2-VIP组 上限500人
 * @request int $zone_permission 申请加入模式(ENUM): 0-默认直接加入; 1-需要身份验证; 2-私有群组
 * @request string $zone_declared 群组公告
 * @request int $user_id 管理员
 * @request string $zone_bind_id 第三方群组id
 * @request int $zone_user_num 人数
 */
class User_ZoneCtl extends AccountController
{
    /* @var $userZoneModel User_ZoneModel */
    public $userZoneModel = null;

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

        //$this->userZoneModel = new User_ZoneModel();
        $this->userZoneModel = User_ZoneModel::getInstance();
        
        $this->model = $this->userZoneModel;
    }

    /**
     * 群组首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('user');
    }
    
    /**
     * 群组管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

    /**
     * 群组列表数据
     * 
     * @access public
     */
    public function lists()
    {
        $user_id = Zero_Perm::getUserId();

        $page = i('page', 1);  //当前页码
        $rows = i('rows', 10); //每页记录条数
        $sort = grid_sort();

        $column_row = array();

        //权限判断
        if (!Zero_Api_Controller::getPlantformRole())
        {
            $user_id = Zero_Perm::getUserId();
            $column_row['user_id'] = $user_id;
        }
    

        $data = $this->userZoneModel->getLists($column_row, $sort, $page, $rows);

        $this->render('user', $data);
    }

    /**
     * 读取群组
     * 
     * @access public
     */
    public function get()
    {
        $zone_id_row = id('zone_id'); //好友组ID

        $rows = $this->userZoneModel->get($zone_id_row);

        //权限判断
        if (!Zero_Api_Controller::getPlantformRole())
        {
            $user_id = Zero_Perm::getUserId();
    
            if (!Zero_Perm::checkDataRights($user_id, $rows, 'user_id'))
            {
                $rows = array();
            }
        }
        

        $this->render('user', $rows);
    }
    
    /**
     * 读取群组
     *
     * @access public
     */
    public function getMembers()
    {
        $zone_id = i('zone_id', i('id')); //好友组ID
        
        $rows = $this->userZoneModel->getMembers($zone_id);
        
        //权限判断
        $user_id = Zero_Perm::getUserId();
    
        if (!Zero_Perm::checkDataRights($user_id, $rows, 'user_id'))
        {
            //$rows = array();
        }
        
        $data['list'] = array_values($rows);
        $this->render('user', $data);
    }
    
    
    /**
     * 添加群组
     *
     * @access public
     */
    public function add()
    {
        $data['zone_id']                = i('zone_id')                    ; // 好友组ID        
        $data['zone_name']              = s('zone_name')                  ; // 群组名称        
        $data['zone_type']              = i('zone_type')                  ; // 群组类型(ENUM):0-临时组上限100人;  1-普通组上限300人; 2-VIP组 上限500人
        $data['zone_permission']        = i('zone_permission')            ; // 申请加入模式(ENUM): 0-默认直接加入; 1-需要身份验证; 2-私有群组
        $data['zone_declared']          = s('zone_declared')              ; // 群组公告        
        $data['user_id']                = i('user_id')                    ; // 管理员          
        $data['zone_bind_id']           = s('zone_bind_id')               ; // 第三方群组id    
        $data['zone_user_num']          = i('zone_user_num')              ; // 人数            

        unset($data['zone_id']);

        //权限判断
        $user_id = Zero_Perm::getUserId();
        $data['user_id'] = $user_id;

        $zone_id = $this->userZoneModel->add($data, true);

        if ($zone_id)
        {
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }

        $data['zone_id'] = $zone_id;

        $this->render('user', $data, $msg, $status);
    }
    
    /**
     * 添加群组消息
     *
     * @access public
     */
    public function addMessage()
    {
        $to = r('to');
        $mine = r('mine');
        
        //权限判断
        $user_id = Zero_Perm::getUserId();
        $data['user_id'] = $user_id;
        
        $data['zone_message_id']        = i('zone_message_id')            ; // 短消息索引id
        $data['zone_id']                = $to['id']                    ;
        $data['zone_message_content']   = $mine['content']       ; // 短消息内容
        $data['zone_message_time']      = get_datetime()          ; // 短消息发送时间
        $data['zone_message_is_delete'] = 0     ; // 短消息状态(BOOL):0-正常状态;1-删除状态
        $data['zone_message_type']      = 2          ; // 消息类型(ENUM):1-系统消息;2-用户消息;3-私信
    
        unset($data['zone_message_id']);
    
    
        $zone_message_id = User_ZoneMessageModel::getInstance()->add($data, true);
    
        if ($zone_message_id)
        {
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }
    
        $data['zone_message_id'] = $zone_message_id;
    
        $this->render('user', $data, $msg, $status);
    }


    /**
     * 删除群组
     *
     * @access public
     */
    public function remove()
    {
        $zone_id_row = id('zone_id'); //好友组ID

        //权限判断
        $user_id = Zero_Perm::getUserId();

        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($user_id, $rows=$this->userZoneModel->get($zone_id_row), 'user_id'))
        {
            $flag = $this->userZoneModel->remove($zone_id_row);

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

        $data['zone_id'] = $zone_id_row;

        $this->render('user', $data, $msg, $status);
    }

    /**
     * 修改群组
     *
     * @access public
     */
    public function edit()
    {
        $data['zone_id']                = i('zone_id')                    ; // 好友组ID        
        $data['zone_name']              = s('zone_name')                  ; // 群组名称        
        $data['zone_type']              = i('zone_type')                  ; // 群组类型(ENUM):0-临时组上限100人;  1-普通组上限300人; 2-VIP组 上限500人
        $data['zone_permission']        = i('zone_permission')            ; // 申请加入模式(ENUM): 0-默认直接加入; 1-需要身份验证; 2-私有群组
        $data['zone_declared']          = s('zone_declared')              ; // 群组公告        
        $data['user_id']                = i('user_id')                    ; // 管理员          
        $data['zone_bind_id']           = s('zone_bind_id')               ; // 第三方群组id    
        $data['zone_user_num']          = i('zone_user_num')              ; // 人数            


        $zone_id = $data['zone_id'];
        $data_rs = $data;
        unset($data['zone_id']);

        //权限判断
        $user_id = Zero_Perm::getUserId();
        
        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($user_id, $rows=$this->userZoneModel->get($zone_id), 'user_id'))
        {
            $flag = $this->userZoneModel->edit($zone_id, $data);

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

        $this->render('user', $data_rs, $msg, $status);
    }
    
    
}

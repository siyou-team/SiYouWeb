<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 群组消息-聊天记录控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-09-20, Xinze
 * @request int $zone_message_id 短消息索引id
 * @request int $user_id 消息所属用户:发送者或者接收者，如果message_kind=1则为改用户发送的消息。
 * @request int $zone_id 群组id
 * @request string $zone_message_content 短消息内容
 * @request string $zone_message_time 短消息发送时间
 * @request int $zone_message_is_delete 短消息状态(BOOL):0-正常状态;1-删除状态
 * @request int $zone_message_type 消息类型(ENUM):1-系统消息;2-用户消息;3-私信
 */
class User_ZoneMessageCtl extends Zero_AppController
{
    /* @var $userZoneMessageModel User_ZoneMessageModel */
    public $userZoneMessageModel = null;

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

        //$this->userZoneMessageModel = new User_ZoneMessageModel();
        $this->userZoneMessageModel = User_ZoneMessageModel::getInstance();
        
        $this->model = $this->userZoneMessageModel;
    }

    /**
     * 群组消息-聊天记录首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 群组消息-聊天记录管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

    /**
     * 群组消息-聊天记录列表数据
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
        $user_id = Zero_Perm::getUserId();
        $column_row['user_id'] = $user_id;
        $column_row['zone_id'] = i('zone_id');
    

        $data = $this->userZoneMessageModel->getLists($column_row, $sort, $page, $rows);

        $this->render('default', $data);
    }

    /**
     * 读取群组消息-聊天记录
     * 
     * @access public
     */
    public function get()
    {
        $zone_message_id_row = id('zone_message_id'); //短消息索引id

        $rows = $this->userZoneMessageModel->get($zone_message_id_row);

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
     * 添加群组消息-聊天记录
     *
     * @access public
     */
    public function add()
    {
        $data['zone_message_id']        = i('zone_message_id')            ; // 短消息索引id    
        $data['user_id']                = i('user_id')                    ; // 消息所属用户:发送者或者接收者，如果message_kind=1则为改用户发送的消息。
        $data['zone_id']                = i('zone_id')                    ; // 群组id          
        $data['zone_message_content']   = s('zone_message_content')       ; // 短消息内容      
        $data['zone_message_time']      = s('zone_message_time')          ; // 短消息发送时间  
        $data['zone_message_is_delete'] = i('zone_message_is_delete')     ; // 短消息状态(BOOL):0-正常状态;1-删除状态
        $data['zone_message_type']      = i('zone_message_type')          ; // 消息类型(ENUM):1-系统消息;2-用户消息;3-私信

        unset($data['zone_message_id']);

        //权限判断
        $user_id = Zero_Perm::getUserId();
        $data['user_id'] = $user_id;

        $zone_message_id = $this->userZoneMessageModel->add($data, true);

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

        $this->render('default', $data, $msg, $status);
    }

    /**
     * 删除群组消息-聊天记录
     *
     * @access public
     */
    public function remove()
    {
        $zone_message_id_row = id('zone_message_id'); //短消息索引id

        //权限判断
        $user_id = Zero_Perm::getUserId();

        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($user_id, $rows=$this->userZoneMessageModel->get($zone_message_id_row), 'user_id'))
        {
            $flag = $this->userZoneMessageModel->remove($zone_message_id_row);

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

        $data['zone_message_id'] = $zone_message_id_row;

        $this->render('default', $data, $msg, $status);
    }

    /**
     * 修改群组消息-聊天记录
     *
     * @access public
     */
    public function edit()
    {
        $data['zone_message_id']        = i('zone_message_id')            ; // 短消息索引id    
        $data['user_id']                = i('user_id')                    ; // 消息所属用户:发送者或者接收者，如果message_kind=1则为改用户发送的消息。
        $data['zone_id']                = i('zone_id')                    ; // 群组id          
        $data['zone_message_content']   = s('zone_message_content')       ; // 短消息内容      
        $data['zone_message_time']      = s('zone_message_time')          ; // 短消息发送时间  
        $data['zone_message_is_delete'] = i('zone_message_is_delete')     ; // 短消息状态(BOOL):0-正常状态;1-删除状态
        $data['zone_message_type']      = i('zone_message_type')          ; // 消息类型(ENUM):1-系统消息;2-用户消息;3-私信


        $zone_message_id = $data['zone_message_id'];
        $data_rs = $data;
        unset($data['zone_message_id']);

        //权限判断
        $user_id = Zero_Perm::getUserId();
        
        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($user_id, $rows=$this->userZoneMessageModel->get($zone_message_id), 'user_id'))
        {
            $flag = $this->userZoneMessageModel->edit($zone_message_id, $data);

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

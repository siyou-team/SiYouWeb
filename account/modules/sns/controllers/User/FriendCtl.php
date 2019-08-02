<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 用户好友关系控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-09-01, Xinze
 * @request int $user_friend_id 
 * @request int $user_id 用户ID
 * @request int $friend_id 好友id
 * @request string $friend_note 备注名称
 * @request string $user_friend_addtime 添加时间
 * @request int $friend_state 关注状态(ENUM):1-单向关注;2-双向关注
 * @request int $friend_invite 邀请状态(ENUM):0-新邀请;2-处理完成后邀请
 */
class User_FriendCtl extends AccountController
{
    /* @var $userFriendModel User_FriendModel */
    public $userFriendModel = null;

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

        //$this->userFriendModel = new User_FriendModel();
        $this->userFriendModel = User_FriendModel::getInstance();
        
        $this->model = $this->userFriendModel;
    }

    /**
     * 用户好友关系首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('user');
    }
    
    /**
     * 用户好友关系管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

    /**
     * 用户好友关系列表数据
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
    

        $data = $this->userFriendModel->getLists($column_row, $sort, $page, $rows);

        $this->render('user', $data);
    }
    
    /**
     * 用户好友关系列表数据
     *
     * @access public
     */
    public function getFriendsInfo()
    {
        $user_id = Zero_Perm::getUserId();
        
        $page = i('page', 1);  //当前页码
        $rows = i('rows', 1000); //每页记录条数
        $sort = grid_sort();
        
        $column_row = array();
        
        //权限判断
        $user_id = Zero_Perm::getUserId();
        $column_row['user_id'] = $user_id;
        
        
        $data = $this->userFriendModel->getFriendsInfo($column_row, $sort, $page, $rows);
        
        $this->render('user', $data);
    }
    

    /**
     * 读取用户好友关系
     * 
     * @access public
     */
    public function get()
    {
        $user_friend_id_str = s('user_friend_id'); // ","分割
        $user_friend_id_row = explode(',', $user_friend_id_str);

        $rows = $this->userFriendModel->get($user_friend_id_row);

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
     * 添加用户好友关系
     *
     * @access public
     */
    public function agree()
    {
        $friend_id = i('friend_id', i('uid'));
    
        $user_id = Zero_Perm::getUserId();
        $data['user_id'] = $user_id;
    
        $data['user_friend_id']         = i('user_friend_id')             ; //
        $data['friend_id']              = $friend_id                  ; // 好友id
        $data['friend_note']            = s('friend_note')                ; // 备注名称        
        $data['user_friend_addtime']    = get_datetime()        ; // 添加时间
        
        //判断状态
        $invite_rows = User_FriendModel::getInstance()->getInvite($user_id);
        
        if ($invite_rows)
        {
            //修改邀请信息
            $invite_row = current($invite_rows);
            $flag = User_FriendModel::getInstance()->edit($invite_row['user_friend_id'], array('friend_state'=>2, 'friend_invite'=>2));
            
            $data['friend_state']           = 2               ; // 关注状态(ENUM):1-单向关注;2-双向关注
            $data['friend_invite']          = 2              ; // 邀请状态(ENUM):0-新邀请;2-处理完成后邀请
        }
        else
        {
            $data['friend_state']           = 1               ; // 关注状态(ENUM):1-单向关注;2-双向关注
            $data['friend_invite']          = 0              ; // 邀请状态(ENUM):0-新邀请;2-处理完成后邀请
        }

        unset($data['user_friend_id']);

        //
        $user_friend_id = $this->userFriendModel->add($data, true);

        //分组信息
        $group_id = i('group_id', i('group'));
        
        if ($group_id && $friend_id)
        {
            $flag = User_GroupRelModel::getInstance()->add(array('group_id'=>$group_id, 'user_id'=>$friend_id));
        }
        
        if ($user_friend_id)
        {
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }

        $data['user_friend_id'] = $user_friend_id;

        $this->render('user', $data, $msg, $status);
    }

    /**
     * 删除用户好友关系
     *
     * @access public
     */
    public function refuse()
    {
        $friend_id = i('friend_id', i('uid'));

        //权限判断
        $user_id = Zero_Perm::getUserId();
    
        //判断状态
        $invite_rows = User_FriendModel::getInstance()->getInvite($user_id);
    
        if ($invite_rows)
        {
            //修改邀请信息
            $invite_row = current($invite_rows);
        
            $flag = User_FriendModel::getInstance()->edit($invite_row['user_friend_id'], array('friend_invite'=>2));
        }
        else
        {
        
        }
    
        $flag = $this->userFriendModel->removeCond(array('user_id'=>$user_id, 'friend_id'=>$friend_id));
    
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

        $data['user_friend_id'] = array($friend_id);

        $this->render('user', $data, $msg, $status);
    }

    /**
     * 修改用户好友关系
     *
     * @access public
     */
    public function edit()
    {
        $data['user_friend_id']         = i('user_friend_id')             ; //                 
        $data['user_id']                = i('user_id')                    ; // 用户ID          
        $data['friend_id']              = i('friend_id')                  ; // 好友id          
        $data['friend_note']            = s('friend_note')                ; // 备注名称        
        $data['user_friend_addtime']    = s('user_friend_addtime')        ; // 添加时间        
        $data['friend_state']           = i('friend_state')               ; // 关注状态(ENUM):1-单向关注;2-双向关注
        $data['friend_invite']          = i('friend_invite')              ; // 邀请状态(ENUM):0-新邀请;2-处理完成后邀请


        $user_friend_id = $data['user_friend_id'];
        $data_rs = $data;
        unset($data['user_friend_id']);

        //权限判断
        $user_id = Zero_Perm::getUserId();
        
        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($user_id, $rows=$this->userFriendModel->get($user_friend_id), 'user_id'))
        {
            $flag = $this->userFriendModel->edit($user_friend_id, $data);

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

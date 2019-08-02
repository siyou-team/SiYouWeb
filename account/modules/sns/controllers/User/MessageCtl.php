<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 短消息控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-08-29, Xinze
 * @request int $message_id 短消息索引id
 * @request int $message_parent_id 回复短消息message_id
 * @request int $user_id 短消息接收人
 * @request int $user_other_id 短消息发送人
 * @request string $user_other_nickname 发信息人用户名
 * @request string $message_content 短消息内容
 * @request string $message_time 短消息发送时间
 * @request int $message_is_read 是否读取(BOOL):0-未读;1-已读
 * @request int $message_is_delete 短消息状态(BOOL):0-正常状态;1-删除状态
 * @request int $message_type 消息类型(ENUM):1-系统消息;2-用户消息;3-私信
 */
class User_MessageCtl extends AccountController
{
    /* @var $userMessageModel User_MessageModel */
    public $userMessageModel = null;

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

        //$this->userMessageModel = new User_MessageModel();
        $this->userMessageModel = User_MessageModel::getInstance();
        
        $this->model = $this->userMessageModel;
    }

    /**
     * 短消息首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('user');
    }
    
    /**
     * 短消息管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

    
    /**
     * 短消息列表数据
     * 
     * @access public
     */
    public function lists()
    {
        $user_id = Zero_Perm::getUserId();

        $page = i('page', 1);  //当前页码
        $rows = i('rows', 10); //每页记录条数
        $sort = grid_sort();//
        $sort['message_time'] = 'DESC';
        $sort['message_is_read'] = 'ASC';

        $column_row = array();
    
    
        $user_id = Zero_Perm::getUserId();//获取UserID
        $column_row['user_id'] = $user_id;
        
        if ($user_other_id = i('user_other_id'))
        {
            $column_row['user_other_id'] = i('user_other_id');
        }

        $data = $this->userMessageModel->getLists($column_row, $sort, $page, $rows);
        $this->render('user', $data);
    }
    
    public function getMsgCount()
    {
        $rs = array();
        
        $user_id = Zero_Perm::getUserId();
        
        $num = $this->userMessageModel->getNum(array('user_id'=>$user_id, 'message_is_read'=>0));
        
        $rs['num'] = $num;
        
        
        $this->render('user', $rs);
    }
    
    public function getMsgUser()
    {
        $data = array();
        
        $user_id = Zero_Perm::getUserId();
    
        $msg_user_rows = $this->userMessageModel->getMsgUser($user_id);

        $data['items'] = array_values($msg_user_rows);
        
        $this->render('user', $data);
    }
    
    /**
     * 读取短消息
     * 
     * @access public
     */
    public function get()
    {
        $message_id = i('message_id'); //短消息索引id ","分割
        $row = $this->userMessageModel->getOne($message_id);

        //权限判断
        $user_id = Zero_Perm::getUserId();
    
        if (!Zero_Perm::checkDataRights($user_id, $row, 'user_id'))
        {
            $row = array();
        }
        else
        {
            //设为已读
            $this->userMessageModel->edit($message_id, array('message_is_read'=>1));
        }
        
        $this->render('user', $row);
    }
    
    /**
     * 设置为已读
     *
     * @access public
     */
    public function setRead()
    {
        //权限判断
        $user_id = Zero_Perm::getUserId();
        $message_id = i('message_id'); //短消息索引id ","分割
        
        //设为已读
        $this->userMessageModel->editCond(array('message_id'=>$message_id, 'user_id'=>$user_id), array('message_is_read'=>1));
        
        $this->render('user', array());
    }
    
    
    /**
     * 添加短消息
     *
     * @access public
     */
    public function add()
    {
        $user_id = Zero_Perm::getUserId();
        $user_row = Zero_Perm::getUserRow() ;
        
        //判断接收者是否存在。
    
        $user_other_nickname = s('user_nickname');
        
        if ($user_other_nickname)
        {
            $user_other_row = User_BaseModel::getInstance()->getByNickname($user_other_nickname);
        }
        else
        {
            $user_other_id = i('user_other_id');
            
            if (!$user_other_id)
            {
                $to_row = r('to');
                $user_other_id = $to_row['user_id'];
    
            }
            
            if ($user_other_id)
            {
                $user_other_row = User_BaseModel::getInstance()->getOne($user_other_id);
            }
        }
    
        if ($message_content = s('message_content'))
        {
            $message_title = s('message_title');
        }
        else
        {
            $mine_row = r('mine');
            $message_title =  '';
            $message_content = $mine_row['content'];
        }
    
        if ($user_other_row)
        {
            //发件箱
            $data['user_id'] = $user_id;
            $data['user_nickname']          = $user_row['user_nickname']      ; // 接收人用户名
            $data['user_other_id']          = $user_other_row['user_id']         ; // 短消息发送人
            $data['user_other_nickname']    = $user_other_nickname        ; // 发信息人用户名
    
            $data['message_title']          = $message_title              ; //短消息标题
            $data['message_content']        = $message_content            ; // 短消息内容
    
            $data['message_is_read']        = 1            ; // 是否读取(BOOL):0-未读;1-已读
            $data['message_is_delete']      = 0          ; // 短消息状态(BOOL):0-正常状态;1-删除状态
            $data['message_type']           = 2               ; // 消息类型(ENUM):1-系统消息;2-用户消息;3-私信
            $data['message_kind']           = 1               ;
            $data['message_time']           = time()               ;
    
            //收件箱
            $other['user_id']                = $user_other_row['user_id']              ; // 短消息接收人
            $other['user_nickname']          = $user_other_nickname        ; // 接收人用户名
            $other['user_other_id']          = $user_id                    ; // 短消息发送人
            $other['user_other_nickname']    = $user_row['user_nickname']             ; // 发信息人用户名
            $other['message_title']          = $message_title             ; //短消息标题
            $other['message_content']        = $message_content            ; // 短消息内容
    
    
            $other['message_is_read']        = 0            ; // 是否读取(BOOL):0-未读;1-已读
            $other['message_is_delete']      = 0          ; // 短消息状态(BOOL):0-正常状态;1-删除状态
            $other['message_type']           = 2               ; // 消息类型(ENUM):1-系统消息;2-用户消息;3-私信
            $other['message_kind']           = 2                                ;//消息种类
            $other['message_time']           = time()               ;
    
    
            $message_id = $this->userMessageModel->add($data, true);
            $message_other_id = $this->userMessageModel->add($other, true);
    
    
            if ($message_id && $message_other_id)
            {
                $msg = 'close';
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
            //临时会话
            //发件箱
            /*
            $data['user_id'] = $user_id;
            $data['user_nickname']          = $user_row['user_nickname']      ; // 接收人用户名
            $data['user_other_id']          = $user_other_id         ; // 短消息发送人
            $data['user_other_nickname']    = $user_other_nickname        ; // 发信息人用户名
    
            $data['message_title']          = $message_title              ; //短消息标题
            $data['message_content']        = $message_content            ; // 短消息内容
    
            $data['message_is_read']        = 1            ; // 是否读取(BOOL):0-未读;1-已读
            $data['message_is_delete']      = 0          ; // 短消息状态(BOOL):0-正常状态;1-删除状态
            $data['message_type']           = 2               ; // 消息类型(ENUM):1-系统消息;2-用户消息;3-私信
            $data['message_kind']           = 1               ;
            $data['message_time']           = time()               ;
    
    
            $message_id = $this->userMessageModel->add($data, true);
            if ($message_id)
            {
                $msg = 'close';
                $status = 200;
            }
            else
            {
                $msg = __('操作失败');
                $status = 250;
            }
            */
    
            $msg = 'temp';
            $status = 200;
        }
        

        $data['message_id'] = $message_id;
        $data['message_other_id'] = isset($message_other_id) ? $message_other_id : null;

        $this->render('user', $data, $msg, $status);
    }
  
    /*
     * 查询用户信息
     */
    public function getUserByNickname(){
        $user_nickname = s('user_nickname');
        $data =User_BaseModel::getInstance()->getByNickname($user_nickname);
    
        if ($data)
        {
            $data['ok'] = __("验证通过");
            $msg = 'close';
            $status = 200;
        }
        else
        {
            $data['error'] = __("用户不存在");
            $msg = __('操作失败');
            $status = 250;
        }
        
        $this->render('user', $data);
    }
    
    /**
     * 删除短消息
     *
     * @access public
     */
    public function remove()
    {
        $message_id_str = s('message_id'); //短消息索引id ","分割

        $message_id_row = explode(',', $message_id_str);

        //权限判断
        $user_id = Zero_Perm::getUserId();

        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($user_id, $rows=$this->userMessageModel->get($message_id_row), 'user_id'))
        {
            $flag = $this->userMessageModel->remove($message_id_row);

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

        $data['message_id'] = $message_id_row;

        $this->render('user', $data, $msg, $status);
    }
    
    
    /**
     * 删除短消息
     *
     * @access public
     */
    public function removeUserMsg()
    {
        $user_id = Zero_Perm::getUserId();
        $user_other_id = i('user_other_id');
   
        $flag = $this->userMessageModel->removeCond(array('user_id'=>$user_id, 'user_other_id'=>$user_other_id));
    
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
        
        $data['message_id'] = array($user_other_id);
        
        $this->render('user', $data, $msg, $status);
    }
    
    /**
     * 获取通知信息
     *
     * @access public
     */
    public function listNotice()
    {
        $user_id = Zero_Perm::getUserId();
    
        $data = array();
        
        //获取新邀请
        $invite_rows = User_FriendModel::getInstance()->getInvite($user_id);
        foreach ($invite_rows as $invite_row)
        {
            $invite_row['content'] =  "添加你为好友";
            $invite_row['from'] =  $invite_row['user_id'];
            $invite_row['uid']  =  $invite_row['friend_id'];
            $invite_row['from_group']  =  0;
            $invite_row['type']  =  1;
            $invite_row['remark']  =  '';
            $invite_row['href']  =  '';
            $invite_row['read']  =  1;
            $invite_row['time']  =   $invite_row['user_friend_addtime'];
            $invite_row['user']  =  array(
                "id"=> $invite_row['user_id'],
                "avatar"=> $invite_row['user_avatar'],
                "username"=> $invite_row['user_username'],
                "sign"=> $invite_row['user_sign']
            );
            
            $data[] = $invite_row;
        }
        
        
        //系统通知
        $notice_rows = User_MessageModel::getInstance()->getNotice($user_id);
        foreach ($notice_rows as $notice_row)
        {
            $notice_row['content'] =  $notice_row['message_content'];
            $notice_row['from'] =  null;
            $notice_row['uid']  =  $notice_row['user_id'];
            $notice_row['from_group']  =  null;
            $notice_row['type']  =  1;
            $notice_row['remark']  =  '';
            $notice_row['href']  =  '';
            $notice_row['read']  =  1;
            $notice_row['time']  =   $notice_row['message_time'];
            $notice_row['user']  =  array(
                "id"=> null
            );
        
            $data[] = $notice_row;
        }
        
        
        $this->render('user', $data);
    }

}

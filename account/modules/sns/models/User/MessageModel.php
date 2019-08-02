<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 短消息模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-08-29, Xinze
 * @version    1.0
 * @todo
 */
class User_MessageModel extends Zero_Model
{
    public $_cacheName       = 'user';
    public $_tableName       = 'user_message';
    public $_tablePrimaryKey = 'message_id';
    public $_useCache        = false;
    public $_useListCache    = false;
    public $_languageCond    = false;
    
    public $fieldType = array();

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'user_message_cond'=>array(
            'user_id'=>null,
            'message_type'=>null,
            'message_time'=>null,
            'message_kind'=>null,
            'user_other_id'=>null
        )
    );

    public $_validateRules = array('integer'=>array('message_id', 'message_parent_id', 'user_id', 'user_other_id', 'message_is_read', 'message_is_delete', 'message_type'));

    public $_validateLabels= array();


    /**
     * @param string $user  User Object
     * @var   string $db_id 指定需要连接的数据库Id
     * @return void
     */
    public function __construct(&$db_id='sns', &$user=null)
    {
        $this->_useCache  = CHE;

        $this->_tabelPrefix  = TABLE_SNS_PREFIX;
        parent::__construct($db_id, $user);
    }

    /**
     * 读取分页列表
     *
     * @param  array $column_row where查询条件
     * @param  array $sort  排序条件order by
     * @param  int $page 当前页码
     * @param  int $rows 每页显示记录数
     * @return array $data 返回的查询内容
     * @access public
     */
    public function getLists($column_row=array(), $sort=array(), $page=1, $rows=500)
    {
        //修改值 $column_row
        $data = $this->lists($column_row, $sort, $page, $rows);

        User_InfoModel::fixUserAvatar($data['items']);
        
        return $data;
    }

    public function getNotice($user_id)
    {
        //修改值 $column_row
        $data = $this->find(array('user_id'=>$user_id, 'message_type'=>1, 'message_time:>'=>time()-3600*24*10));
        
        User_InfoModel::fixUserAvatar($data);
        
        return $data;
    }
    
    public function getMsgUser($user_id)
    {
        $sql = '
            SELECT
                message_id,
                user_id,
                user_other_id,
                user_nickname,
                user_other_nickname,
                message_content,
                message_is_read,
                message_time
            FROM
                %s
            WHERE
                user_id = %s
            GROUP BY
                user_other_id
            ORDER BY
                message_time DESC
        ';
        
        $sql = sprintf($sql, $this->_tableName, $user_id);
    
        $msg_user_rows = $this->sql->getAll($sql);
    
        $msg_user_rows = User_InfoModel::fixUserAvatar($msg_user_rows);
        
        return $msg_user_rows;
    }
    
    /**
     * 读取分页列表
     *
     * @param  int $user_other_id 短消息接收人
     * @param  int $user_id  短消息发送人
     * @return string $message_content 短消息内容
     * @access public
     */
    public function sendMsg($user_id, $user_other_id, $message_content, $message_type=1)
    {
        if ($user_other_id)
        {
            //发件箱
            $data['user_id'] = $user_id;
            $data['user_other_id']          = $user_other_id         ; // 短消息发送人
            $data['message_content']        = $message_content            ; // 短消息内容
    
            $data['message_is_read']        = 1            ; // 是否读取(BOOL):0-未读;1-已读
            $data['message_is_delete']      = 0          ; // 短消息状态(BOOL):0-正常状态;1-删除状态
            $data['message_type']           = 2               ; // 消息类型(ENUM):1-系统消息;2-用户消息;3-私信
            $data['message_kind']           = 1               ;
            $data['message_time']           = time()               ;
    
            //收件箱
            $other['user_id']                = $user_id              ; // 短消息接收人
            $other['user_other_id']          = $user_other_id                    ; // 短消息发送人
            $other['message_content']        = $message_content            ; // 短消息内容
    
    
            $other['message_is_read']        = 0            ; // 是否读取(BOOL):0-未读;1-已读
            $other['message_is_delete']      = 0          ; // 短消息状态(BOOL):0-正常状态;1-删除状态
            $other['message_type']           = 2               ; // 消息类型(ENUM):1-系统消息;2-用户消息;3-私信
            $other['message_kind']           = 2                                ;//消息种类
            $other['message_time']           = time()               ;
    
    
            $message_id = $this->add($data, true);
            $message_other_id = $this->add($other, true);
    
    
            return $message_id && $message_other_id;
        }
    }
    
    public function sendMsgByNickname($user_other_nickname, $user_other_id, $message_content, $message_type=1)
    {
        if ($user_other_nickname)
        {
            $user_other_row = User_BaseModel::getInstance()->getByNickname($user_other_nickname);
            $user_id =  $user_other_row['user_id'];
            
            return $this->sendMsg($user_id, $user_other_id, $message_content, $message_type);
        }
        else
        {
        
        }
    }
    
    /**
     * 系统通知消息
     *
     * @param  int $user_other_id 短消息接收人
     * @param  int $user_id 短消息发送人
     * @return string $message_content 短消息内容
     * @access public
     */
    public function noticeMsg($user_id, $user_other_id, $message_content, $message_type=1)
    {
        //收件箱
        $other['user_id']         = $user_id; // 短消息接收人
        $other['user_other_id']   = $user_other_id; // 短消息发送人
        $other['message_content'] = $message_content; // 短消息内容
    
        $other['message_is_read']   = 0; // 是否读取(BOOL):0-未读;1-已读
        $other['message_is_delete'] = 0; // 短消息状态(BOOL):0-正常状态;1-删除状态
        $other['message_type']      = $message_type; // 消息类型(ENUM):1-系统消息;2-用户消息;3-私信
        $other['message_kind']      = 2;//消息种类
        $other['message_time']      = time();

        $message_id = $this->add($other, true);
    
        return $message_id;
    }
}


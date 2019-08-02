<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 短消息控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-08-29, Xinze
 * @request int $message_id 短消息索引id
 * @request int $message_parent_id 回复短消息message_id
 * @request int $store_id 短消息接收人
 * @request int $user_other_id 短消息发送人
 * @request string $user_other_nickname 发信息人用户名
 * @request string $message_content 短消息内容
 * @request string $message_time 短消息发送时间
 * @request int $message_is_read 是否读取(BOOL):0-未读;1-已读
 * @request int $message_is_delete 短消息状态(BOOL):0-正常状态;1-删除状态
 * @request int $message_type 消息类型(ENUM):1-系统消息;2-用户消息;3-私信
 */
class Api_User_MessageCtl extends Api_AccountController
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
     * 短消息列表数据
     * 
     * @access public
     */
    public function lists()
    {
        $store_id = Zero_Perm::getStoreId();

        $page = i('page', 1);  //当前页码
        $rows = i('rows', 500); //每页记录条数
        $sort = grid_sort();

        $column_row = array();

        //权限判断
        if (!Zero_Api_Controller::getPlantformRole())
        {
            $store_id = Zero_Perm::getStoreId();
            $column_row['store_id'] = $store_id;
        }
    
        if ($message_content = s('message_content'))
        {
            $column_row['message_content'] = '%' . $message_content . '%';
        }
    
        $column_row['message_kind'] = 1;
        $data = $this->userMessageModel->getLists($column_row, $sort, $page, $rows);

        $this->render('user', $data);
    }
}

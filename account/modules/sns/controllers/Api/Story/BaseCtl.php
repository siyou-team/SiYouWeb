<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 动态信息控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-09-25, Xinze
 * @request int $story_id ID
 * @request int $user_id 会员ID
 * @request string $story_title 标题
 * @request string $story_content 内容(HTMl)
 * @request string $story_file 图片(DOT)
 * @request int $story_type 类型(ENUM): 1-文字; 2-图片; 3-音乐; 4-视频; 5-商品
 * @request int $story_src_id 转发源
 * @request int $story_time 添加时间
 * @request int $story_status 状态(ENUM);0-草稿;1-发布
 * @request int $story_enable 是否删除(BOOL):0-删除;1-有效
 * @request int $story_privacy 隐私可见度(ENUM):0-所有人可见; 1-好友可见; 2-仅自己可见
 * @request int $story_comment_count 评论数
 * @request int $story_forward_count 转发数
 * @request int $story_like_count 点赞数
 * @request int $story_collection_count 帖子收藏数
 * @request int $story_forward 是否可以转发(BOOL):0-不可以;1-可以
 */
class Api_Story_BaseCtl extends Api_AccountController
{
    /* @var $storyBaseModel Story_BaseModel */
    public $storyBaseModel = null;

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

        //$this->storyBaseModel = new Story_BaseModel();
        $this->storyBaseModel = Story_BaseModel::getInstance();
        
        $this->model = $this->storyBaseModel;
    }

    /**
     * 动态信息首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 动态信息管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

    /**
     * 动态信息列表数据
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
    

        $data = $this->storyBaseModel->getLists($column_row, $sort, $page, $rows);

        $this->render('default', $data);
    }

    /**
     * 读取动态信息
     * 
     * @access public
     */
    public function get()
    {
        $story_id_row = id('story_id'); //ID

        $rows = $this->storyBaseModel->get($story_id_row);

        //权限判断
        if (!Zero_Api_Controller::getPlantformRole())
        {
            $store_id = Zero_Perm::getStoreId();
    
            if (!Zero_Perm::checkDataRights($store_id, $rows, 'store_id'))
            {
                $rows = array();
            }
        }
        

        $this->render('default', $rows);
    }

    /**
     * 添加动态信息
     *
     * @access public
     */
    public function add()
    {
        $data['story_id']               = i('story_id')                   ; // ID              
        $data['user_id']                = i('user_id')                    ; // 会员ID          
        $data['story_title']            = s('story_title')                ; // 标题            
        $data['story_content']          = s('story_content')              ; // 内容(HTMl)      
        $data['story_file']             = s('story_file')                 ; // 图片(DOT)       
        $data['story_type']             = i('story_type')                 ; // 类型(ENUM): 1-文字; 2-图片; 3-音乐; 4-视频; 5-商品
        $data['story_src_id']           = i('story_src_id')               ; // 转发源          
        $data['story_time']             = i('story_time')                 ; // 添加时间        
        $data['story_status']           = i('story_status')               ; // 状态(ENUM);0-草稿;1-发布
        $data['story_enable']           = i('story_enable')               ; // 是否删除(BOOL):0-删除;1-有效
        $data['story_privacy']          = i('story_privacy')              ; // 隐私可见度(ENUM):0-所有人可见; 1-好友可见; 2-仅自己可见
        $data['story_comment_count']    = i('story_comment_count')        ; // 评论数          
        $data['story_forward_count']    = i('story_forward_count')        ; // 转发数          
        $data['story_like_count']       = i('story_like_count')           ; // 点赞数          
        $data['story_collection_count'] = i('story_collection_count')     ; // 帖子收藏数      
        $data['story_forward']          = i('story_forward')              ; // 是否可以转发(BOOL):0-不可以;1-可以

        unset($data['story_id']);

        //权限判断
        $store_id = Zero_Perm::getStoreId();
        $data['user_id'] = $store_id;

        $story_id = $this->storyBaseModel->add($data, true);

        if ($story_id)
        {
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }

        $data['story_id'] = $story_id;

        $this->render('default', $data, $msg, $status);
    }

    /**
     * 删除动态信息
     *
     * @access public
     */
    public function remove()
    {
        $story_id_row = id('story_id'); //ID

        //权限判断
        $store_id = Zero_Perm::getStoreId();

        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($store_id, $rows=$this->storyBaseModel->get($story_id_row), 'user_id'))
        {
            $flag = $this->storyBaseModel->remove($story_id_row);

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

        $data['story_id'] = $story_id_row;

        $this->render('default', $data, $msg, $status);
    }

    /**
     * 修改动态信息
     *
     * @access public
     */
    public function edit()
    {
        $data['story_id']               = i('story_id')                   ; // ID              
        $data['user_id']                = i('user_id')                    ; // 会员ID          
        $data['story_title']            = s('story_title')                ; // 标题            
        $data['story_content']          = s('story_content')              ; // 内容(HTMl)      
        $data['story_file']             = s('story_file')                 ; // 图片(DOT)       
        $data['story_type']             = i('story_type')                 ; // 类型(ENUM): 1-文字; 2-图片; 3-音乐; 4-视频; 5-商品
        $data['story_src_id']           = i('story_src_id')               ; // 转发源          
        $data['story_time']             = i('story_time')                 ; // 添加时间        
        $data['story_status']           = i('story_status')               ; // 状态(ENUM);0-草稿;1-发布
        $data['story_enable']           = i('story_enable')               ; // 是否删除(BOOL):0-删除;1-有效
        $data['story_privacy']          = i('story_privacy')              ; // 隐私可见度(ENUM):0-所有人可见; 1-好友可见; 2-仅自己可见
        $data['story_comment_count']    = i('story_comment_count')        ; // 评论数          
        $data['story_forward_count']    = i('story_forward_count')        ; // 转发数          
        $data['story_like_count']       = i('story_like_count')           ; // 点赞数          
        $data['story_collection_count'] = i('story_collection_count')     ; // 帖子收藏数      
        $data['story_forward']          = i('story_forward')              ; // 是否可以转发(BOOL):0-不可以;1-可以


        $story_id = $data['story_id'];
        $data_rs = $data;
        unset($data['story_id']);

        //权限判断
        $store_id = Zero_Perm::getStoreId();
        
        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($store_id, $rows=$this->storyBaseModel->get($story_id), 'user_id'))
        {
            $flag = $this->storyBaseModel->edit($story_id, $data);

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

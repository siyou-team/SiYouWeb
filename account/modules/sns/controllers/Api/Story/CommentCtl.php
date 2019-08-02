<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 评论控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-09-25, Xinze
 * @request int $commect_id ID
 * @request int $user_id 会员ID
 * @request int $story_id 原帖ID
 * @request string $commect_content 评论内容
 * @request int $commect_state 状态(BOOL): 0-正常; 1-屏蔽
 * @request int $to_user_id 被回复的评论id，0为对动态信息进行评论
 * @request int $commect_like_count 是否点赞
 * @request string $commect_time 添加时间
 */
class Api_Story_CommentCtl extends Api_AccountController
{
    /* @var $storyCommentModel Story_CommentModel */
    public $storyCommentModel = null;

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

        //$this->storyCommentModel = new Story_CommentModel();
        $this->storyCommentModel = Story_CommentModel::getInstance();
        
        $this->model = $this->storyCommentModel;
    }

    /**
     * 评论首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 评论管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

    /**
     * 评论列表数据
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
    

        $data = $this->storyCommentModel->getLists($column_row, $sort, $page, $rows);

        $this->render('default', $data);
    }

    /**
     * 读取评论
     * 
     * @access public
     */
    public function get()
    {
        $commect_id_row = id('commect_id'); //ID

        $rows = $this->storyCommentModel->get($commect_id_row);

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
     * 添加评论
     *
     * @access public
     */
    public function add()
    {
        $data['commect_id']             = i('commect_id')                 ; // ID              
        $data['user_id']                = i('user_id')                    ; // 会员ID          
        $data['story_id']               = i('story_id')                   ; // 原帖ID          
        $data['commect_content']        = s('commect_content')            ; // 评论内容        
        $data['commect_state']          = i('commect_state')              ; // 状态(BOOL): 0-正常; 1-屏蔽
        $data['to_user_id']             = i('to_user_id')                 ; // 被回复的评论id，0为对动态信息进行评论
        $data['commect_like_count']     = i('commect_like_count')         ; // 是否点赞        
        $data['commect_time']           = s('commect_time')               ; // 添加时间        

        unset($data['commect_id']);

        //权限判断
        $store_id = Zero_Perm::getStoreId();
        $data['user_id'] = $store_id;

        $commect_id = $this->storyCommentModel->add($data, true);

        if ($commect_id)
        {
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }

        $data['commect_id'] = $commect_id;

        $this->render('default', $data, $msg, $status);
    }

    /**
     * 删除评论
     *
     * @access public
     */
    public function remove()
    {
        $commect_id_row = id('commect_id'); //ID

        //权限判断
        $store_id = Zero_Perm::getStoreId();

        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($store_id, $rows=$this->storyCommentModel->get($commect_id_row), 'user_id'))
        {
            $flag = $this->storyCommentModel->remove($commect_id_row);

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

        $data['commect_id'] = $commect_id_row;

        $this->render('default', $data, $msg, $status);
    }

    /**
     * 修改评论
     *
     * @access public
     */
    public function edit()
    {
        $data['commect_id']             = i('commect_id')                 ; // ID              
        $data['user_id']                = i('user_id')                    ; // 会员ID          
        $data['story_id']               = i('story_id')                   ; // 原帖ID          
        $data['commect_content']        = s('commect_content')            ; // 评论内容        
        $data['commect_state']          = i('commect_state')              ; // 状态(BOOL): 0-正常; 1-屏蔽
        $data['to_user_id']             = i('to_user_id')                 ; // 被回复的评论id，0为对动态信息进行评论
        $data['commect_like_count']     = i('commect_like_count')         ; // 是否点赞        
        $data['commect_time']           = s('commect_time')               ; // 添加时间        


        $commect_id = $data['commect_id'];
        $data_rs = $data;
        unset($data['commect_id']);

        //权限判断
        $store_id = Zero_Perm::getStoreId();
        
        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($store_id, $rows=$this->storyCommentModel->get($commect_id), 'user_id'))
        {
            $flag = $this->storyCommentModel->edit($commect_id, $data);

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

<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 敏感词过滤-启用api控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-11-10, Xinze
 * @request int $filter_id 敏感词id
 * @request string $filter_find 查找敏感词
 * @request string $filter_replace 替换内容
 * @request int $filter_type 过滤类型:1-banned禁止;   2-替换replace
 * @request string $filter_time 添加时间
 * @request int $filter_buildin 是否系统内置(ENUM): 1-系统内置; 0-非内置
 * @request int $user_id 用户id
 * @request int $filter_enable 是否启用(ENUM): 0-未启用; 1-已启用
 */
class Api_Base_FilterKeywordCtl extends Api_AccountController
{
    /* @var $baseFilterKeywordModel Base_FilterKeywordModel */
    public $baseFilterKeywordModel = null;

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

        //$this->baseFilterKeywordModel = new Base_FilterKeywordModel();
        $this->baseFilterKeywordModel = Base_FilterKeywordModel::getInstance();
        
        $this->model = $this->baseFilterKeywordModel;
    }

    /**
     * 敏感词过滤-启用api首页
     *
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }
    
    /**
     * 敏感词过滤-启用api管理界面
     *
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

    /**
     * 敏感词过滤-启用api列表数据
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
    

        $data = $this->baseFilterKeywordModel->getLists($column_row, $sort, $page, $rows);

        $this->render('default', $data);
    }

    /**
     * 读取敏感词过滤-启用api
     *
     * @access public
     */
    public function get()
    {
        $filter_id_row = id('filter_id'); //敏感词id

        $rows = $this->baseFilterKeywordModel->get($filter_id_row);

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
     * 添加敏感词过滤-启用api
     *
     * @access public
     */
    public function add()
    {
        $data['filter_id']              = i('filter_id')                  ; // 敏感词id
        $data['filter_find']            = s('filter_find')                ; // 查找敏感词
        $data['filter_replace']         = s('filter_replace')             ; // 替换内容
        //$data['filter_type']            = i('filter_type')                ; // 过滤类型:1-banned禁止;   2-替换replace
        //$data['filter_time']            = s('filter_time')                ; // 添加时间
        $data['filter_buildin']         = 0             ; // 是否系统内置(ENUM): 1-系统内置; 0-非内置
        //$data['user_id']                = i('user_id')                    ; // 用户id
        $data['filter_enable']          = i('filter_enable')              ; // 是否启用(ENUM): 0-未启用; 1-已启用

        unset($data['filter_id']);
        $data['filter_type']          = $data['filter_replace'] ? 2 : 1 ; // 1:禁止

        //权限判断
        $user_id = Zero_Perm::getUserId();
        $data['user_id'] = $user_id;
    
        $data['filter_type']          = $data['filter_replace'] ? 2 : 1 ; // 1:禁止
    
    
    
        if (Zero_Api_Controller::getPlantformRole())
        {
    
            $filter_id = $this->baseFilterKeywordModel->add($data, true);
    
            $data['filter_id'] = $filter_id;
            
            if ($filter_id)
            {
                $msg = __('操作成功');
                $status = 200;
        
                //初始化
                $filter_rule_rows = $this->baseFilterKeywordModel->getFilterRule();
            }
            else
            {
                $msg = $this->baseFilterKeywordModel->msg->getMsg();
                //$msg = __('操作失败');
                $status = 250;
            }

        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }
        

        $this->render('default', $data, $msg, $status);
    }

    /**
     * 删除敏感词过滤-启用api
     *
     * @access public
     */
    public function remove()
    {
        $filter_id_row = id('filter_id'); //敏感词id

        //权限判断
        $user_id = Zero_Perm::getUserId();

        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($user_id, $rows=$this->baseFilterKeywordModel->get($filter_id_row), 'user_id'))
        {
            //$flag = $this->baseFilterKeywordModel->remove($filter_id_row);
            $flag = $this->baseFilterKeywordModel->removeCond(array('filter_id'=>$filter_id_row, 'filter_buildin'=>0));

            if ($flag !== false)
            {
                $msg = __('操作成功');
                $status = 200;
    
                //初始化
                $filter_rule_rows = $this->baseFilterKeywordModel->getFilterRule();
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

        $data['filter_id'] = $filter_id_row;

        $this->render('default', $data, $msg, $status);
    }

    /**
     * 修改敏感词过滤-启用api
     *
     * @access public
     */
    public function edit()
    {
        $data['filter_id']              = i('filter_id')                  ; // 敏感词id
        $data['filter_find']            = s('filter_find')                ; // 查找敏感词
        $data['filter_replace']         = s('filter_replace')             ; // 替换内容
        //$data['filter_type']            = i('filter_type')                ; // 过滤类型:1-banned禁止;   2-替换replace
        //$data['filter_time']            = s('filter_time')                ; // 添加时间
        //$data['filter_buildin']         = i('filter_buildin')             ; // 是否系统内置(ENUM): 1-系统内置; 0-非内置
        //$data['user_id']                = i('user_id')                    ; // 用户id
        $data['filter_enable']          = i('filter_enable')              ; // 是否启用(ENUM): 0-未启用; 1-已启用
    
        $data['filter_type']          = $data['filter_replace'] ? 2 : 1 ; // 1:禁止

        $filter_id = $data['filter_id'];
        $data_rs = $data;
        unset($data['filter_id']);

        //权限判断
        $user_id = Zero_Perm::getUserId();
        
        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($user_id, $rows=$this->baseFilterKeywordModel->get($filter_id), 'user_id'))
        {
    
            if (!$data['filter_replace'] || ($data['filter_replace'] && preg_match("/[\x{4e00}-\x{9fa5}\w]+$/u", $data['filter_replace'])))
            {
                unset($data['filter_id']);
        
                $flag = $this->baseFilterKeywordModel->edit($filter_id, $data);
            }
    
            if ($flag !== false)
            {
                $msg = __('操作成功');
                $status = 200;
        
                //初始化
                $filter_rule_rows = $this->baseFilterKeywordModel->getFilterRule();
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

    
    
    //从服务器初始化国家标准屏蔽词汇
    public function initFromCloud()
    {
        $ctl = 'Base_FilterKeyword';
        $met = 'lists';
        $typ = 'json';
        
        $_POST['rows'] = 99999;
        
        $Zero_Api_AdminController = new Zero_Api_AdminController($ctl, $met, $typ);
        $rs = $Zero_Api_AdminController->getServiceData($ctl, $met);
        
        //读取当前所有数据
        $filter_rows = $this->baseFilterKeywordModel->find(array(), array(), 1, 99999);
        
        //todo循环入库
        $filter_new_rows = array();
        
        foreach ($rs['data']['items'] as $item)
        {
            if (!isset($filter_rows[$item['filter_id']]))
            {
                unset($item['id']);
                $item['filter_buildin'] = 1;
                $filter_new_rows[] = $item;
            }
        }
        
        if ($filter_new_rows)
        {
            $filter_id = $this->baseFilterKeywordModel->add($filter_new_rows, true);
        }
        
        $this->render('default', array());
    }
    
}

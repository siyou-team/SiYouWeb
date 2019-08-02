<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 卡片信息控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-28, Xinze
 * @request string $card_code 卡片激活码
 * @request string $card_password 卡片密码
 * @request int $card_type_id 卡片id
 * @request string $card_fetch_time 领奖时间
 * @request int $card_media_id 媒体id
 * @request int $server_id 领卡人的服务id
 * @request int $user_id 用户id
 * @request string $user_account 领卡人账号
 * @request string $card_time 卡牌生成时间
 */
class Api_Card_InfoCtl extends Api_PayController
{
    /* @var $cardInfoModel Card_InfoModel */
    public $cardInfoModel = null;

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

        //$this->cardInfoModel = new Card_InfoModel();
        $this->cardInfoModel = Card_InfoModel::getInstance();
        
        $this->model = $this->cardInfoModel;
    }

    /**
     * 卡片信息首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('pay');
    }
    
    /**
     * 卡片信息管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

    /**
     * 卡片信息列表数据
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

        if($card_type_id = i('card_type_id'))
        {
            $column_row['card_type_id'] = $card_type_id;
        }

        //权限判断
        if (!Zero_Api_Controller::getPlantformRole())
        {
            $store_id = Zero_Perm::getStoreId();
            $column_row['store_id'] = $store_id;
        }
    

        $data = $this->cardInfoModel->getLists($column_row, $sort, $page, $rows);

        $this->render('pay', $data);
    }

    /**
     * 读取卡片信息
     * 
     * @access public
     */
    public function get()
    {
        $card_code_str = s('card_code'); //卡片激活码 ","分割
        $card_code_row = explode(',', $card_code_str);

        $rows = $this->cardInfoModel->get($card_code_row);

        //权限判断
        if (!Zero_Api_Controller::getPlantformRole())
        {
            $user_id = Zero_Perm::getUserId();
    
            if (!Zero_Perm::checkDataRights($user_id, $rows, 'user_id'))
            {
                $rows = array();
            }
        }
        

        $this->render('pay', $rows);
    }

    /**
     * 添加卡片信息
     *
     * @access public
     */
    public function add()
    {

        for($i =0; $i<i('card_num'); $i++)
        {
            $data[$i]['card_code'] = s('card_prefix').mt_rand(10000000,99999999);
            $data[$i]['card_type_id'] = i('card_type_id')               ; // 卡片id
            $data[$i]['card_time'] = date('Y-m-d H:i:s',time())         ; // 卡牌生成时间

        }

        $card_code = $this->cardInfoModel->add($data, true);

        if ($card_code)
        {
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }


        $this->render('pay', $data, $msg, $status);
    }

    /**
     * 删除卡片信息
     *
     * @access public
     */
    public function remove()
    {
        $card_code = s('card_code'); //卡片激活码 ","分割

        //权限判断
        $user_id = Zero_Perm::getUserId();

        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($user_id, $rows=$this->cardInfoModel->get($card_code), 'user_id'))
        {
            $flag = $this->cardInfoModel->remove($card_code);

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

        $data['card_code'][] = $card_code;

        $this->render('pay', $data, $msg, $status);
    }

    /**
     * 修改卡片信息
     *
     * @access public
     */
    public function edit()
    {
        $data['card_code']              = s('card_code')                  ; // 卡片激活码      
        $data['card_password']          = s('card_password')              ; // 卡片密码        
        $data['card_type_id']           = i('card_type_id')               ; // 卡片id          
        $data['card_fetch_time']        = s('card_fetch_time')            ; // 领奖时间        
        $data['card_media_id']          = i('card_media_id')              ; // 媒体id          
        $data['server_id']              = i('server_id')                  ; // 领卡人的服务id  
        $data['user_id']                = i('user_id')                    ; // 用户id          
        $data['user_account']           = s('user_account')               ; // 领卡人账号      
        $data['card_time']              = s('card_time')                  ; // 卡牌生成时间    


        $card_code = $data['card_code'];
        $data_rs = $data;
        unset($data['card_code']);

        //权限判断
        $user_id = Zero_Perm::getUserId();
        
        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($user_id, $rows=$this->cardInfoModel->get($card_code), 'user_id'))
        {
            $flag = $this->cardInfoModel->edit($card_code, $data);

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

        $this->render('pay', $data_rs, $msg, $status);
    }
    
   
}

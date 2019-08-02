<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 卡片基础信息控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-28, Xinze
 * @request int $card_type_id 卡片id
 * @request int $app_id AppId:9999通用
 * @request string $card_type_name 卡名称
 * @request string $card_type_prize 卡片里面的奖品
 * @request string $card_type_desc 卡片描述
 * @request string $card_type_starttime 卡的有效开始时间
 * @request string $card_type_endtime 卡的有效结束时间
 * @request string $card_type_image 卡片Logo
 */
class Api_Card_TypeCtl extends Api_PayController
{
    /* @var $cardTypeModel Card_TypeModel */
    public $cardTypeModel = null;

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

        //$this->cardTypeModel = new Card_TypeModel();
        $this->cardTypeModel = Card_TypeModel::getInstance();
        
        $this->model = $this->cardTypeModel;
    }

    /**
     * 卡片基础信息首页
     * 
     * @access public
     */
    public function index()
    {
        $this->render('pay');
    }
    
    /**
     * 卡片基础信息管理界面
     * 
     * @access public
     */
    public function manage()
    {
        $this->render('manage');
    }

    /**
     * 卡片基础信息列表数据
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
    

        $data = $this->cardTypeModel->getLists($column_row, $sort, $page, $rows);

        foreach ($data['items'] as $k => $item)
        {
            $data['items'][$k]['card_type_card'] = $item['card_type_prize']['c'];
            $data['items'][$k]['card_type_points'] = $item['card_type_prize']['p'];
            $data['items'][$k]['card_type_money'] = $item['card_type_prize']['m'];

        }

        $this->render('pay', $data);
    }

    /**
     * 读取卡片基础信息
     * 
     * @access public
     */
    public function get()
    {
        $card_type_id_str = s('card_type_id'); //卡片id ","分割
        $card_type_id_row = explode(',', $card_type_id_str);

        $rows = $this->cardTypeModel->get($card_type_id_row);

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
     * 添加卡片基础信息
     *
     * @access public
     */
    public function add()
    {

        $data['app_id']                 = i('app_id')                     ; // AppId:9999通用  
        $data['card_type_name']         = s('card_type_name')             ; // 卡名称
        $data['card_type_name_it']      = s('card_type_name_it')             ; // 卡名称

        $card_type_card = i('card_type_card');
        $card_type_points = i('card_type_points');
        $card_type_money = i('card_type_money');

        $data['card_type_prize'] = array('c'=>$card_type_card,'p'=>$card_type_points,'m'=>$card_type_money);

        $data['store_id'] = Zero_Perm::getStoreId();
        $data['card_type_desc']         = s('card_type_desc')             ; // 卡片描述    
        $data['card_type_desc_it']      = s('card_type_desc_it')             ; // 卡片描述        
        $data['card_type_starttime']    = s('card_type_starttime')        ; // 卡的有效开始时间
        $data['card_type_endtime']      = s('card_type_endtime')          ; // 卡的有效结束时间
        $data['card_type_image']        = s('card_type_image')            ; // 卡片Logo        

        $card_type_id = $this->cardTypeModel->add($data, true);

        if ($card_type_id)
        {
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }

        $data['card_type_id'] = $card_type_id;

        $this->render('pay', $data, $msg, $status);
    }

    /**
     * 删除卡片基础信息
     *
     * @access public
     */
    public function remove()
    {
        $card_type_id_str = s('card_type_id'); //卡片id ","分割
        $card_type_id_row = explode(',', $card_type_id_str);

        //权限判断
        $user_id = Zero_Perm::getUserId();

        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($user_id, $rows=$this->cardTypeModel->get($card_type_id_row), 'user_id'))
        {
            $flag = $this->cardTypeModel->remove($card_type_id_row);

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

        $data['card_type_id'] = $card_type_id_row;

        $this->render('pay', $data, $msg, $status);
    }

    /**
     * 修改卡片基础信息
     *
     * @access public
     */
    public function edit()
    {
        $data['card_type_id']           = i('card_type_id')               ; // 卡片id          
        $data['app_id']                 = i('app_id')                     ; // AppId:9999通用  
        $data['card_type_name']         = s('card_type_name')             ; // 卡名称
        $data['card_type_name_it']      = s('card_type_name_it')             ; // 卡名称

        //
        $card_type_card = i('card_type_card');
        $card_type_points = i('card_type_points');
        $card_type_money = i('card_type_money');

        $data['card_type_prize'] = array('c'=>$card_type_card,'p'=>$card_type_points,'m'=>$card_type_money);



        $data['card_type_desc']         = s('card_type_desc')             ; // 卡片描述  
        $data['card_type_desc_it']      = s('card_type_desc_it')             ; // 卡片描述        
              
        $data['card_type_starttime']    = s('card_type_starttime')        ; // 卡的有效开始时间
        $data['card_type_endtime']      = s('card_type_endtime')          ; // 卡的有效结束时间
        $data['card_type_image']        = s('card_type_image')            ; // 卡片Logo        


        $card_type_id = $data['card_type_id'];
        $data_rs = $data;
        unset($data['card_type_id']);

        //权限判断
        $user_id = Zero_Perm::getUserId();
        
        if (Zero_Api_Controller::getPlantformRole() || Zero_Perm::checkDataRights($user_id, $rows=$this->cardTypeModel->get($card_type_id), 'user_id'))
        {
            $flag = $this->cardTypeModel->edit($card_type_id, $data);

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

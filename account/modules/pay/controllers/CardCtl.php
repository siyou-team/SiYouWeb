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
class CardCtl extends PayController
{
    /* @var $cardTypeModel Card_TypeModel */
    public $cardTypeModel = null;
    
    /* @var $cardInfoModel Card_InfoModel */
    public $cardInfoModel = null;
    
    /* @var $cardHistoryModel Card_HistoryModel */
    public $cardHistoryModel = null;
    
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
    
    
        $this->cardInfoModel = Card_InfoModel::getInstance();
        $this->cardHistoryModel = Card_HistoryModel::getInstance();
        
        $this->model = $this->cardTypeModel;
    }

    /**
     * 卡片使用记录
     * 
     * @access public
     */
    public function lists()
    {

        $page = i('page', 1);  //当前页码
        $rows = i('rows', 10); //每页记录条数
        $sort = grid_sort();

        $column_row = array();

        //权限判断
        if (!Zero_Api_Controller::getPlantformRole())
        {
            $user_id = Zero_Perm::getUserId();
            $column_row['user_id'] = $user_id;
        }
    

        $data = $this->cardHistoryModel->getLists($column_row, $sort, $page, $rows);

        $this->render('pay', $data);
    }
    
    
    
    public function addCard()
    {
        
        $data['card_code'] = i('card_code');
        
        $Card_HistoryModel = Card_HistoryModel::getInstance();
        
        $Card_HistoryModel->sql->startTransactionDb();
        
        $card_history_id = Card_HistoryModel::getInstance()->addCard($data);
        
        if ($card_history_id && $Card_HistoryModel->sql->commitDb())
        {
            {
                //充值卡余额变动
                $message_id = 'prepaid-card-balance-change-reminder';
                $args = array(
                    'des' => $data['card_history_remark'],
                    'change_amount' => $data['card_history_value'],
                    'freeze_amount' => '',
                );
                Message_TemplateModel::getInstance()->sendNoticeMsg(Zero_Perm::getUserId(), 0, $message_id, $args);
            }
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $Card_HistoryModel->sql->rollBackDb();
            
            $msg = __('操作失败');
            $status = 250;
        }
        
        $data['card_history_id'] = $card_history_id;
        
        $this->render('pay', $data, $msg, $status);
    }
    
    public function index()
    {

        $resource = User_ResourceModel::getInstance()->getOne(Zero_Perm::getUserId());

        $data['user_recharge_card'] = $resource['user_recharge_card'];
        $data['user_recharge_card_frozen'] = $resource['user_recharge_card_frozen'];

        $this->render('pay',$data);
    }

    //充值卡信息
    public function eCart()
    {
        $page = i('page', 1);  //当前页码
        $rows = i('rows', 10); //每页记录条数
        $sort = grid_sort();
        $column_row = array();
        $data = array();


        if (!Zero_Api_Controller::getPlantformRole())
        {
            $user_id = Zero_Perm::getUserId();
            $column_row['user_id'] = $user_id;
            $data = Card_HistoryModel::getInstance()->getLists($column_row, $sort, $page, $rows);
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }




        $this->render('pay',$data, $msg, $status);
    }

    public function cardHistory()
    {
        
        $page = i('page', 1);  //当前页码
        $rows = i('rows', 10); //每页记录条数
        $sort = grid_sort();
        $column_row = array();
        
        
        if (!Zero_Api_Controller::getPlantformRole())
        {
            $user_id = Zero_Perm::getUserId();
            $column_row['user_id'] = $user_id;
        }
        
        $resource = User_ResourceModel::getInstance()->getOne(Zero_Perm::getUserId());
        
        $data = Card_HistoryModel::getInstance()->getLists($column_row, $sort, $page, $rows);

        $data['user_recharge_card'] = $resource['user_recharge_card'];
        $data['user_recharge_card_frozen'] = $resource['user_recharge_card_frozen'];


        
        $this->render('pay',$data);
    }
}

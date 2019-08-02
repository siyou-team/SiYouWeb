<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 卡片使用记录模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-28, Xinze
 * @version    1.0
 * @todo
 */
class Card_HistoryModel extends Zero_Model
{
    public $_cacheName       = 'card';
    public $_tableName       = 'card_history';
    public $_tablePrimaryKey = 'card_history_id';
    public $_useCache        = false;
    public $_languageCond    = false;
    
    public $fieldType = array();

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'card_history_cond'=>array(
            'user_id' => null
        )
    );

    public $_validateRules = array('integer'=>array('card_history_id', 'card_type_id', 'user_id', 'store_id'), 'numeric'=>array('card_history_value', 'user_recharge_card'), 'date'=>array('card_history_time'));

    public $_validateLabels= array();


    /**
     * @param string $user  User Object
     * @var   string $db_id 指定需要连接的数据库Id
     * @return void
     */
    public function __construct(&$db_id='pay', &$user=null)
    {
        $this->_useCache  = false;

        $this->_tabelPrefix  = TABLE_PAY_PREFIX;
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

        $sort['card_history_id'] = 'DESC';

        $data = $this->lists($column_row, $sort, $page, $rows);

        return $data;
    }

    public function addCard($data)
    {

        $card_info_row = Card_InfoModel::getInstance()->getOne($data['card_code']);

        $user_id = Zero_Perm::getUserId();

        if($card_info_row)
        {
            if(!$card_info_row['user_id'])
            {

                $card_type_row = Card_TypeModel::getInstance()->getOne($card_info_row['card_type_id']);

                $data['card_history']['card_code'] = $data['card_code'];
                $data['card_history']['card_type_id'] = $card_info_row['card_type_id'];
                $data['card_history']['user_id'] = $user_id;
                $data['card_history']['user_recharge_card'] = $card_type_row['card_type_prize']['c'];
                $data['card_history']['card_history_time'] = date('Y-m-d H:i:s',time());
                $data['card_history']['card_history_remark'] = $card_type_row['card_type_name'];

                $card_history_id = $this->add($data['card_history'],true);

                if (false === check_rs($card_history_id, $rs_row))
                {
                    throw new Zero_Exception_Db(__('新增充值卡历史记录失败!'));
                }


                $data['card_info']['card_fetch_time'] = date('Y-m-d H:i:s',time());
                $data['card_info']['user_id'] = $user_id;
                $user_row = User_BaseModel::getInstance()->getOne($user_id);
                $data['card_info']['user_account'] = $user_row['user_account'];

                $flag = Card_InfoModel::getInstance()->edit($data['card_code'],$data['card_info']);

                if (false === check_rs($flag, $rs_row))
                {
                    throw new Zero_Exception_Db(__('修改充值卡信息失败!'));
                }



                $user_resource_row = User_ResourceModel::getInstance()->getOne($user_id);
                $data['user_resource']['user_recharge_card'] = $user_resource_row['user_recharge_card'] + $card_type_row['card_type_prize']['c'];
                
                $flag = User_ResourceModel::getInstance()->edit($user_id,$data['user_resource']);

                if (false === check_rs($flag, $rs_row))
                {
                    throw new Zero_Exception_Db(__('修改用户信息失败!'));
                }


            }
            else
            {
                throw new Zero_Exception_Db(__('该充值卡已使用!'));
            }

        }
        else
        {
            throw new Zero_Exception_Db(__('该充值卡号不存在!'));
        }


        return is_ok($data)?true:false;

    }
}


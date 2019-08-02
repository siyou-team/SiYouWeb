<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 用户资源模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-06-13, Xinze
 * @version    1.0
 * @todo
 */
class User_ResourceModel extends Zero_Model
{
    public $_cacheName       = 'user';
    public $_tableName       = 'user_resource';
    public $_tablePrimaryKey = 'user_id';
    public $_useCache        = false;

    public $fieldType = array();

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'user_resource_cond'=>array(
            'user_sp_frozen'=>null,
            'user_sp_base'=>null,
            'user_id'=>null
        )
    );

    public $_validateRules = array('integer'=>array('user_id'), 'numeric'=>array('user_money', 'user_money_frozen', 'user_recharge_card', 'user_recharge_card_frozen', 'user_points', 'user_points_frozen', 'user_credit'));

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
        $data = $this->lists($column_row, $sort, $page, $rows);
    
        $user_id_row =   array_column_unique($data['items'], 'user_id');
        $user_base_row = User_BaseModel::getInstance()->get($user_id_row);
    
        foreach ($data['items'] as $id=>$datum)
        {
            $data['items'][$id]['user_account'] = $user_base_row[$datum['user_id']]['user_account'];
        }
        
        return $data;
    }
    
    
    /**
     * 只获取一条记录
     *
     * @param  int   $user_id  主键值
     * @return array $rows 返回的查询内容
     * @access public
     */
    public function getOne($user_id=null, $key_row=null, $sort_row=array())
    {
        $row = parent::getOne($user_id, $key_row, $sort_row);

        
        if (!$row)
        {
            //初始化 ? 会不会访问无用数据，初始化很多无用信息?
            $flag = $this->add(array('user_id'=>$user_id));
    
            $row = parent::getOne($user_id, $key_row, $sort_row);
        }

        $store_id = Zero_Perm::getStoreId();

        $row['voucher'] = User_VoucherModel::getInstance()->getNum(array('user_id'=>$user_id, 'store_id'=>$store_id, 'voucher_state_id' => StateCode::VOUCHER_STATE_UNUSED));
    
    
        $row['user_sp'] = @$row['user_sp_base'] + @$row['user_sp_profit'];
        $row['user_sp_total'] = @$row['user_sp_base'] + @$row['user_sp_profit'] + @$row['user_sp_buy'];
        
        return $row;
    }
    
    /**
     * 余额操作入口
     *
     * @param  int   $user_id
     * @param  float   $money 区分正负数，未负数则减少
     * @param  int   $trade_type_deposit
     * @param  int   $payment_type_id
     * @param  int   $desc
     * @return mixed
     * @access public
     */
    public static function money($user_id, $money, $trade_type_deposit, $desc='', $payment_type_id=StateCode::PAYMENT_TYPE_OFFLINE)
    {
        $time = time();
    
    
        $resource_data = array();
        
        //写入流水
        $consume_record_rows = array();
    
        $consume_record_row = array();

        $consume_record_row['order_id'] = '';
        $consume_record_row['user_id']  = $user_id;
        $consume_record_row['user_nickname']  = @$user_nickname;
        $consume_record_row['record_date']  = date('Y-m-d', $time);
    
        $consume_record_row['record_year']  = date('Y', $time);
        $consume_record_row['record_month']  = date('n', $time);
        $consume_record_row['record_day']  = date('j', $time);
    
        if (StateCode::PAYMENT_TYPE_OFFLINE == $payment_type_id)
        {
            $consume_record_row['record_title']  = __('线下');
        }
        else
        {
            $consume_record_row['record_title']  = __('线下');
        }
        
        $consume_record_row['record_time']  = date('Y-m-d H:i:s', $time);
    
        //通用判断
        switch ($trade_type_deposit)
        {
            CASE StateCode::TRADE_TYPE_DEPOSIT:
                $consume_record_row['record_title'] = $consume_record_row['record_title'] . ' ' .  StateCode::getText($trade_type_deposit);
                $resource_data['user_money'] = $money;
                
                break;
            CASE StateCode::TRADE_TYPE_TRANSFER:
                $consume_record_row['record_title'] = $consume_record_row['record_title'] . ' ' .  StateCode::getText($trade_type_deposit);
                $resource_data['user_money'] = $money;
                break;
            CASE StateCode::TRADE_TYPE_COMMISSION:
                $consume_record_row['record_title'] = $consume_record_row['record_title'] . ' ' .  StateCode::getText($trade_type_deposit);
                $resource_data['user_money'] = $money;
                break;
            CASE StateCode::TRADE_TYPE_WITHDRAW:
                $consume_record_row['record_title'] = $consume_record_row['record_title'] . ' ' .  StateCode::getText($trade_type_deposit);
                $resource_data['user_money_frozen'] = $money;
                break;
            default:
                $consume_record_row['record_title'] = $consume_record_row['record_title'] . ' ' .  StateCode::getText($trade_type_deposit);
                break;
        }
    
        $consume_record_row['payment_met_id']  = PaymentModel::PAYMENT_MET_MONEY;

        $consume_record_row['record_money']  = $money; //佣金问题？
        $consume_record_row['trade_type_id']  = $trade_type_deposit;

    
        $consume_record_rows[] = $consume_record_row;
    
    
        //买家数据
        if ($consume_record_rows)
        {
            $flag_row[] = Consume_RecordModel::getInstance()->add($consume_record_rows);
        }
    
        $flag_row[] = User_ResourceModel::getInstance()->edit($user_id, $resource_data, true); //where
    
    
        return is_ok($flag_row);
    }
    
    /**
     * 积分操作统一入口
     *
     * @param  int   $points_kind_id  类型(ENUM):1-获取积分;2-消费积分;
     * @param  int   $points_type_id  积分类型(ENUM):1-会员注册;2-会员登录;3-商品评论;4-购买商品;5-管理员操作;7-积分换购商品;8-积分兑换优惠券
     * @return array $rows 返回的查询内容
     * @access public
     */
    public static function points($user_id, $points, $points_type_id, $desc='', $store_id=0, $user_id_other=null)
    {
        $date  = get_date();
        
        //通用判断， 注册和
        switch ($points_type_id)
        {
            CASE PointsTypeModel::POINTS_TYPE_REG:
                //注册只可以触发一次
                if (User_PointsHistoryModel::getInstance()->findKey(array('user_id' => $user_id, 'points_type_id' => $points_type_id))) {
                    return false;
                }
                $points_kind_id = PointsTypeModel::POINTS_ADD;
                break;
            CASE PointsTypeModel::POINTS_TYPE_LOGIN:
                //登录，每天只可以触发一次
                if (User_PointsHistoryModel::getInstance()->findKey(array('user_id' => $user_id, 'points_type_id' => $points_type_id, 'points_log_date' => $date))) {
                    return false;
                }
                $points_kind_id = PointsTypeModel::POINTS_ADD;
                break;
            CASE PointsTypeModel::POINTS_TYPE_EVALUATE_PRODUCT:
                $points_kind_id = PointsTypeModel::POINTS_ADD;
                break;
            CASE PointsTypeModel::POINTS_TYPE_EVALUATE_STORE:
                $points_kind_id = PointsTypeModel::POINTS_ADD;
                break;
            CASE PointsTypeModel::POINTS_TYPE_CONSUME:
                $points_kind_id = PointsTypeModel::POINTS_ADD;
                break;
            CASE PointsTypeModel::POINTS_TYPE_OTHER:
                break;
            CASE PointsTypeModel::POINTS_TYPE_EXCHANGE_PRODUCT:
                $points_kind_id = PointsTypeModel::POINTS_MINUS;
                break;
            CASE PointsTypeModel::POINTS_TYPE_EXCHANGE_VOUCHER:
                $points_kind_id = PointsTypeModel::POINTS_MINUS;
                break;
            CASE PointsTypeModel::POINTS_TYPE_EXCHANGE_SP:
                $points_kind_id = PointsTypeModel::POINTS_MINUS;
                break;
            CASE PointsTypeModel::POINTS_TYPE_TRANSFER_ADD:
                $points_kind_id = PointsTypeModel::POINTS_ADD;
                break;
            CASE PointsTypeModel::POINTS_TYPE_TRANSFER_MINUS:
                $points_kind_id = PointsTypeModel::POINTS_MINUS;
                break;
            CASE PointsTypeModel::POINTS_TYPE_CONSUME_RETRUN:
                $points_kind_id = PointsTypeModel::POINTS_ADD;
                break;

            default:
                break;
        }
    
        
        
        if (!isset($points_kind_id)) {
            if ($points > 0) {
                $points_kind_id = 1;
            } else {
                $points_kind_id = 2;
            }
        }

        $data['points_kind_id']         = $points_kind_id                               ; // 类型(ENUM):1-获取积分;2-消费积分;
        $data['points_type_id']         = $points_type_id             ; // 积分类型(ENUM):1-会员注册;2-会员登录;3-商品评论;4-购买商品;5-管理员操作;7-积分换购商品;8-积分兑换优惠券
        $data['user_id']                = $user_id                        ; // 会员编号
        //$data['points_log_points']      = abs(intval($points))          ; // 改变积分
        $data['points_log_points']      = $points          ; // 改变积分
        $data['points_log_desc']        = $desc             ; // 描述
        $data['points_log_date']        = $date             ; // 积分日期
        $data['store_id']        = $store_id             ;
        $data['user_id_other']        = $user_id_other             ;


        $points_log_id = User_PointsHistoryModel::getInstance()->addPoints($data, true);
        
        return $points_log_id;
    }
    
    
    /**
     * SP操作统一入口  涉及使用到消费账户，收益账户 ， 释放，等等，封装操作。...
     *
     * @param  int   $sp_kind_id  类型(ENUM):1-获取积分;2-消费积分;
     * @param  int   $sp_type_id  变动类型(ENUM):1-释放;2-购买;3-转入;4-购物积分增加;6-售卖;7-转出;8-购物;9-兑换金宝
     * @return array $rows 返回的查询内容
     * @access public
     */
    public static function sp($user_id, $sp, $sp_type_id, $desc='', $user_id_other=null)
    {
        $time  = time();
        $date  = get_date($time);
    
        //通用判断， 注册和
        switch ($sp_type_id)
        {
            CASE SpTypeModel::SP_TYPE_POINTS_EXCHANGE:
                $sp_kind_id = SpTypeModel::ADD;
                break;
            CASE SpTypeModel::SP_TYPE_RELEASE_IN:
                $sp_kind_id = SpTypeModel::ADD;
                break;
            CASE SpTypeModel::SP_TYPE_MARKET_IN:
                $sp_kind_id = SpTypeModel::ADD;
                break;
            CASE SpTypeModel::SP_TYPE_TRANSFER_IN:
                $sp_kind_id = SpTypeModel::ADD;
                break;
            CASE SpTypeModel::SP_TYPE_PROFIT:
                $sp_kind_id = SpTypeModel::ADD;
                break;
            CASE SpTypeModel::SP_TYPE_MARKET_OUT:
                $sp_kind_id = SpTypeModel::MINUS;
                break;
            CASE SpTypeModel::SP_TYPE_TRANSFER_OUT:
                $sp_kind_id = SpTypeModel::MINUS;
                break;
            CASE SpTypeModel::SP_TYPE_BUY_PRODUCT:
                $sp_kind_id = SpTypeModel::MINUS;
                break;
            CASE SpTypeModel::SP_TYPE_EXCHANGE_BP:
                $sp_kind_id = SpTypeModel::MINUS;
                break;
    
            CASE SpTypeModel::SP_TYPE_RELEASE_OUT:
                $sp_kind_id = SpTypeModel::MINUS;
                break;
    
            CASE SpTypeModel::SP_TYPE_BUY_PRODUCT_ACCOUNT:
                $sp_kind_id = SpTypeModel::MINUS;
                break;
    
    
            CASE SpTypeModel::SP_TYPE_MARKET_CANCEL_IN:
                $sp_kind_id = SpTypeModel::ADD;
                break;
            CASE SpTypeModel::SP_TYPE_MARKET_CANCEL_PROFIT_IN:
                $sp_kind_id = SpTypeModel::ADD;
                break;
                
    
            CASE SpTypeModel::SP_TYPE_MARKET_CANCEL_BUY_OUT:
                $sp_kind_id = SpTypeModel::MINUS;
                break;
    
            CASE SpTypeModel::SP_TYPE_CONSUME_RETRUN:
                $sp_kind_id = SpTypeModel::ADD;
                break;
            default:
                if ($sp > 0) {
                    $sp_kind_id = SpTypeModel::ADD;
                } else {
                    $sp_kind_id = SpTypeModel::MINUS;
                }
                break;
        }
        
        $data['sp_kind_id']         = $sp_kind_id                               ; // 类型(ENUM):1-获取积分;2-消费积分;
        $data['sp_type_id']         = $sp_type_id             ; // 变动类型(ENUM):1-释放;2-购买;3-转入;4-购物积分增加;6-售卖;7-转出;8-购物;9-兑换金宝
        $data['user_id']                = $user_id                        ; // 会员编号
        $data['sp_log_sp']      = $sp          ; // 改变积分
        $data['sp_log_desc']        = $desc             ; // 描述
        $data['sp_log_time']        = $time             ; // 积分日期
        $data['sp_log_date']        = $date             ; // 积分日期
        $data['user_id_other']        = $user_id_other             ;
   
        $sp_log_id = User_SpHistoryModel::getInstance()->addSp($data, true);
        
        return $sp_log_id;
    }
    
    /**
     * SP操作统一入口
     *
     * @param  int   $sp_kind_id  类型(ENUM):1-获取积分;2-消费积分;
     * @param  int   $sp_type_id  变动类型(ENUM):1-释放;2-购买;3-转入;4-购物积分增加;6-售卖;7-转出;8-购物;9-兑换金宝
     * @return array $rows 返回的查询内容
     * @access public
     */
    public static function spFrozen($user_id, $sp, $sp_type_id, $desc='')
    {
        $date  = get_date();
        
        //通用判断， 注册和
        switch ($sp_type_id)
        {
            CASE SpTypeModel::SP_TYPE_RELEASE_IN:
                $sp_kind_id = SpTypeModel::ADD;
                break;
            CASE SpTypeModel::SP_TYPE_MARKET_IN:
                $sp_kind_id = SpTypeModel::ADD;
                break;
            CASE SpTypeModel::SP_TYPE_TRANSFER_IN:
                $sp_kind_id = SpTypeModel::ADD;
                break;
            CASE SpTypeModel::SP_TYPE_PROFIT:
                $sp_kind_id = SpTypeModel::ADD;
                break;
            CASE SpTypeModel::SP_TYPE_MARKET_OUT:
                $sp_kind_id = SpTypeModel::MINUS;
                break;
            CASE SpTypeModel::SP_TYPE_TRANSFER_OUT:
                $sp_kind_id = SpTypeModel::MINUS;
                break;
            CASE SpTypeModel::SP_TYPE_BUY_PRODUCT:
                $sp_kind_id = SpTypeModel::MINUS;
                break;
            CASE SpTypeModel::SP_TYPE_EXCHANGE_BP:
                $sp_kind_id = SpTypeModel::MINUS;
                break;
            CASE SpTypeModel::SP_TYPE_RELEASE_OUT:
                $sp_kind_id = SpTypeModel::MINUS;
                break;
    
            CASE SpTypeModel::SP_TYPE_BUY_PRODUCT_ACCOUNT:
                $sp_kind_id = SpTypeModel::MINUS;
                break;
            default:
                if ($sp > 0) {
                    $sp_kind_id = SpTypeModel::ADD;
                } else {
                    $sp_kind_id = SpTypeModel::MINUS;
                }
                break;
        }
        
        $data['sp_kind_id']         = $sp_kind_id                               ; // 类型(ENUM):1-获取积分;2-消费积分;
        $data['sp_type_id']         = $sp_type_id             ; // 变动类型(ENUM):1-释放;2-购买;3-转入;4-购物积分增加;6-售卖;7-转出;8-购物;9-兑换金宝
        $data['user_id']                = $user_id                        ; // 会员编号
        $data['sp_log_sp']      = $sp          ; // 改变积分
        $data['sp_log_desc']        = $desc             ; // 描述
        $data['sp_log_date']        = $date             ; // 积分日期
        
        
        $sp_log_id = User_SpHistoryModel::getInstance()->addSp($data, true);
        
        return $sp_log_id;
    }
    
    /**
     * BP积分操作统一入口
     *
     * @param  int   $bp_kind_id  类型(ENUM):1-获取积分;2-消费积分;
     * @param  int   $bp_type_id  变动类型(ENUM):1-SP兑换;2-购买品牌推广获得;3-赠送;4-激活市区代理;7-转出;8-转为原始股
     * @return array $rows 返回的查询内容
     * @access public
     */
    public static function bp($user_id, $bp, $bp_type_id, $desc='')
    {
        $time  = time();
        $date  = get_date($time);
    
    
        //通用判断， 注册和
        switch ($bp_type_id)
        {
            CASE BpTypeModel::BP_TYPE_EXCHANGE:
                $bp_kind_id = BpTypeModel::ADD;
                break;
            CASE BpTypeModel::BP_TYPE_BRAND_GIFT:
                $bp_kind_id = BpTypeModel::ADD;
                break;
            CASE BpTypeModel::BP_TYPE_PLANTFORM_GIFT:
                $bp_kind_id = BpTypeModel::ADD;
                break;
            CASE BpTypeModel::BP_TYPE_AGENT_GIFT:
                $bp_kind_id = BpTypeModel::ADD;
                break;
            CASE BpTypeModel::BP_TYPE_TRANSFER_SALE:
                $bp_kind_id = BpTypeModel::MINUS;
                break;
            CASE BpTypeModel::BP_TYPE_TRANSFER_GUFEN:
                $bp_kind_id = BpTypeModel::MINUS;
                break;
            default:
                if ($bp > 0) {
                    $bp_kind_id = BpTypeModel::ADD;
                } else {
                    $bp_kind_id = BpTypeModel::MINUS;
                }
                break;
        }
        
        
        $data['bp_kind_id']         = $bp_kind_id                               ; // 类型(ENUM):1-获取积分;2-消费积分;
        $data['bp_type_id']         = $bp_type_id             ; // 变动类型(ENUM):1-SP兑换;2-购买品牌推广获得;3-赠送;4-激活市区代理;7-转出;8-转为原始股
        $data['user_id']                = $user_id                        ; // 会员编号
        $data['bp_log_bp']      = $bp       ; // 改变积分
        $data['bp_log_desc']        = $desc             ; // 描述
        $data['bp_log_time']        = $time             ; // 日期
        $data['bp_log_date']        = $date             ; // 日期
        
        
        $bp_log_id = User_BpHistoryModel::getInstance()->addBp($data, true);
        
        return $bp_log_id;
    }
}


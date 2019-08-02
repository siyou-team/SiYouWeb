<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 用户等级模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-05-24, Xinze
 * @version    1.0
 * @todo
 */
class Base_UserLevelModel extends Zero_Model
{
    const   EXP_TYPE_REG      = 1;  //会员注册
    const   EXP_TYPE_LOGIN    = 2;  //会员登录
    const   EXP_TYPE_EVALUATE_PRODUCT  = 3; //商品评论
    const   EXP_TYPE_EVALUATE_STORE  = 6; //店铺评论
    const   EXP_TYPE_CONSUME     = 4; //购买商品
    const   EXP_TYPE_OTHER    = 5; //管理员操作
    const   EXP_TYPE_EXCHANGE_PRODUCT = 7; //积分换购商品
    const   EXP_TYPE_EXCHANGE_VOUCHER  = 8; //积分兑换优惠券

    public $_cacheName       = 'base';
    public $_tableName       = 'base_user_level';
    public $_tablePrimaryKey = 'user_level_id';
    public $_useCache        = false;
    public $_languageCond    = false;
    
    public $fieldType = array();

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'base_user_level_cond'=>array(
            'user_level_exp' => null
        )
    );

    public $_validateRules = array('integer'=>array('user_level_id', 'user_level_exp', 'user_level_validity', 'user_level_exp_reduction', 'user_level_annual_fee'), 'numeric'=>array('user_level_rate'), 'date'=>array('user_level_time'));

    public $_validateLabels= array();

    public $_languageField = array(
        'it'=>array('user_level_name')
    );
    
    /**
     * @param string $user  User Object
     * @var   string $db_id 指定需要连接的数据库Id
     * @return void
     */
    public function __construct(&$db_id='account', &$user=null)
    {
        $this->_useCache  = true;

        $this->_tabelPrefix  = TABLE_ACCOUNT_PREFIX;
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

        return $data;
    }
}


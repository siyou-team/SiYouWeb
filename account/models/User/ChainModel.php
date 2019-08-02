<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 门店顾客关系模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2018-02-04, Xinze
 * @version    1.0
 * @todo
 */
class User_ChainModel extends Zero_Model
{
    public $_cacheName       = 'user';
    public $_tableName       = 'user_chain';
    public $_tablePrimaryKey = 'user_id';
    public $_useCache        = false;
    public $_useListCache    = false;
    public $_languageCond    = false;
    
    public $fieldType = array();

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'user_chain_cond'=>array(
            'user_id'=>null,
            'chain_id'=>null
        )
    );

    public $_validateRules = array('integer'=>array('user_id', 'chain_id', 'store_id'));

    public $_validateLabels= array();


    /**
     * @param string $user  User Object
     * @var   string $db_id 指定需要连接的数据库Id
     * @return void
     */
    public function __construct(&$db_id='account', &$user=null)
    {
        $this->_useCache  = CHE;

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


    /**
     * 保存内容
     * @param array $field_row   key=>value数组
     * @param bool $return_insert_id 自增主键
     * @param bool $flag 是否增量更新
     * @return bool $update_flag 是否成功
     * @access public
     */
    public function saveUserChain($user_chain_rows, $return_insert_id=false, $flag=false)
    {
        $rs = parent::save($user_chain_rows);

        //添加门店客户
        /*
        $data['customer_number']        = s('customer_number')            ; // 客户编号
        $data['customer_name']          = s('customer_name')              ; // 客户名称
        $data['customer_type_id']       = i('customer_type_id')           ; // 客户类别
        $data['customer_level_id']      = i('customer_level_id')          ; // 客户等级
        $data['customer_tax_rate']      = f('customer_tax_rate')          ; // 税率
        $data['customer_remark']        = s('customer_remark')            ; // 备注消息
        $data['seller_id']              = i('seller_id')                  ; // 所属业务员:employee
        $data['customer_bank']          = s('customer_bank')              ; // 开户银行
        $data['customer_card']          = s('customer_card')              ; // 银行账号
        $data['customer_account_name']  = s('customer_account_name')      ; // 开户名称
        $data['customer_taxnum']        = s('customer_taxnum')            ; // 纳税人识别号
        $data['customer_invoice']       = s('customer_invoice')           ; // 发票抬头
        */

        $data['user_id']  = $user_chain_rows['user_id'] ;
        $data['chain_id'] = $user_chain_rows['chain_id'] ;
        $data['store_id'] = $user_chain_rows['store_id']                   ; // 店铺id

        if ($data['user_id'])
        {
            $customer_data['base'] = $data;
            $customer_data['contacter'] = array();

            $customer_id = Customer_BaseModel::getInstance()->saveCustomer($customer_data);
        }

        return $rs;
    }

}


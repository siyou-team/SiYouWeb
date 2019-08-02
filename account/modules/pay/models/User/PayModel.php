<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 用户基础信息模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-09-12, Xinze
 * @version    1.0
 * @todo
 */
class User_PayModel extends Zero_Model
{
    public $_cacheName       = 'user';
    public $_tableName       = 'user_pay';
    public $_tablePrimaryKey = 'user_id';
    public $_useCache        = false;
    public $_useListCache    = false;

    public $fieldType = array();

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'user_pay_cond'=>array(
        )
    );

    public $_validateRules = array('integer'=>array('user_id'));

    public $_validateLabels= array();


    /**
     * @param string $user  User Object
     * @var   string $db_id 指定需要连接的数据库Id
     * @return void
     */
    public function __construct(&$db_id='pay', &$user=null)
    {
        $this->_useCache  = CHE;

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

        return $data;
    }
    
    public function checkPayPasswd($user_id, $password, &$msg)
    {
        $flag = false;
        
        $user_pay_row = User_PayModel::getInstance()->getOne($user_id);
        
        if ($user_pay_row)
        {
            $user_salt                        = uniqid(rand());
            
            $user_salt = $user_pay_row['user_pay_salt'];
            
            $salt_password    = md5($user_salt . md5($password));
            
            
            if ($user_pay_row['user_pay_passwd'] == $salt_password)
            {
                $flag = true;
                $msg = __('操作成功');
                $status = 200;
            }
            else
            {
                $flag = false;
                $msg = __('支付密码错误');
                $status = 250;
            }
        }
        else
        {
            $flag = false;
            $msg = __('未设置支付密码');
            $status = 250;
        }
        
        return $flag;
    }
}

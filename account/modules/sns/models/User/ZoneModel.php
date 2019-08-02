<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 好友管理组模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-09-01, Xinze
 * @version    1.0
 * @todo
 */
class User_ZoneModel extends Zero_Model
{
    public $_cacheName       = 'user';
    public $_tableName       = 'user_zone';
    public $_tablePrimaryKey = 'zone_id';
    public $_useCache        = false;
    public $_useListCache    = false;
    public $_languageCond    = false;
    
    public $fieldType = array();

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'user_zone_cond'=>array(
        )
    );

    public $_validateRules = array('integer'=>array('zone_id', 'zone_type', 'zone_permission', 'user_id', 'zone_user_num'));

    public $_validateLabels= array();


    /**
     * @param string $user  User Object
     * @var   string $db_id 指定需要连接的数据库Id
     * @return void
     */
    public function __construct(&$db_id='sns', &$user=null)
    {
        $this->_useCache  = CHE;

        $this->_tabelPrefix  = TABLE_SNS_PREFIX;
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
    
    public function getMembers($zone_id)
    {
        $user_zone_rel_rows = array();
        
        //群组
        if ($zone_id)
        {
            $column_row['zone_id'] = $zone_id;
            $user_zone_rel_rows = User_ZoneRelModel::getInstance()->find($column_row);
    
            $user_zone_rel_rows = User_InfoModel::fixUserAvatar($user_zone_rel_rows);
    
            foreach ($user_zone_rel_rows as $id=>$user_zone_rel_row)
            {
                $user_zone_rel_rows[$id]['avatar'] = $user_zone_rel_row['user_avatar'];
                $user_zone_rel_rows[$id]['username'] = $user_zone_rel_row['user_nickname'];
                $user_zone_rel_rows[$id]['sign'] = $user_zone_rel_row['user_sign'];
                $user_zone_rel_rows[$id]['id'] = $user_zone_rel_row['user_id'];
            }
        }
        else
        {
        
        }

        return $user_zone_rel_rows;
    }


}


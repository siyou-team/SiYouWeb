<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 用户好友关系模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-09-01, Xinze
 * @version    1.0
 * @todo
 */
class User_FriendModel extends Zero_Model
{
    public $_cacheName       = 'user';
    public $_tableName       = 'user_friend';
    public $_tablePrimaryKey = 'user_friend_id';
    public $_useCache        = false;
    public $_useListCache    = false;
    public $_languageCond    = false;
    
    public $fieldType = array();

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'user_friend_cond'=>array(
            'user_id'=>null,
            'friend_id'=>null,
            'friend_invite'=>null
        )
    );

    public $_validateRules = array('integer'=>array('user_friend_id', 'user_id', 'friend_id', 'friend_state', 'friend_invite'), 'date'=>array('user_friend_addtime'));

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
    public function getInvite($user_id)
    {
        //修改值 $column_row
        $data = $this->find(array('friend_id'=>$user_id, 'friend_invite'=>0));
    
        $data = User_InfoModel::fixUserAvatar($data);
        return $data;
    }
    
    /**
     * 读取好友列表，包含分组，群组等等
     *
     * @param  array $column_row where查询条件
     * @param  array $sort  排序条件order by
     * @param  int $page 当前页码
     * @param  int $rows 每页显示记录数
     * @return array $data 返回的查询内容
     * @access public
     */
    public function getFriendsInfo($column_row=array(), $sort=array(), $page=1, $rows=500)
    {
        $data = array();
        
        $friend_rows = $this->find($column_row, $sort, $page, $rows);
        $friend_rows = array_reset(array('friend_id'), $friend_rows);
    
        $friend_rows = User_InfoModel::fixUserAvatar($friend_rows);
    
        foreach ($friend_rows as $user_id=>$friend_row)
        {
            $friend_rows[$user_id]['id']  = $user_id;
        }

        
        //读取用户组
        $where_row = array();
        $where_row['user_id'] = $column_row['user_id'];
        $group_rows = User_GroupModel::getInstance()->find($where_row);
        
        foreach ($group_rows as $group_id=>$group_row)
        {
            $group_rows[$group_id]['groupname'] = $group_row['group_name'];
        }
        
        
        //
        $group_user_ids = array();
        $group_rel_rows = array();
        $where_row = array();
        $where_row['group_id'] = array_column_unique($group_rows, 'group_id');
        
        if ($where_row['group_id'])
        {
            $group_rel_rows = User_GroupRelModel::getInstance()->find($where_row);
    
            $group_user_ids = array_column_unique($group_rel_rows, 'user_id');
            
            foreach ($group_rel_rows as $group_rel_row)
            {
                $group_rows[$group_rel_row['group_id']]['list'][] = $friend_rows[$group_rel_row['user_id']];
            }
        }
    
        //未分组判断
        $none_group_friend_rows = array();
        foreach ($friend_rows as $friend_id=>$friend_row)
        {
            if (!in_array($friend_id, $group_user_ids))
            {
                $none_group_friend_rows[] = $friend_row;
            }
            else
            {
            
            }
        }
        
        if ($none_group_friend_rows)
        {
            $temp = array();
            $temp['list'] = $none_group_friend_rows;
            $temp['groupname'] = '未分组';
            $temp['id'] = 0;
            $temp['online'] = 0;
    
            array_unshift($group_rows, $temp);
        }
    
        //群组
        $where_row = array();
        $where_row['user_id'] = $column_row['user_id'];
        
        $user_zone_rel_rows = User_ZoneRelModel::getInstance()->find($where_row);
    
        $zone_ids = array_column_unique($user_zone_rel_rows, 'zone_id');
        $zone_rows = User_ZoneModel::getInstance()->get($zone_ids);
    
        $data['friend'] = (array)array_values($group_rows);
        $data['group'] = array();
        
        if ($zone_rows)
        {
            foreach ($zone_rows as $zone_id=>$zone_row)
            {
                $zone_rows[$zone_id]['avatar'] = "//tva3.sinaimg.cn/crop.64.106.361.361.50/7181dbb3jw8evfbtem8edj20ci0dpq3a.jpg";
                $zone_rows[$zone_id]['groupname'] = $zone_row['zone_name'];
                $zone_rows[$zone_id]['id'] = Zero_Model::getPlantformUid($zone_row['id']);;
                //$zone_rows[$zone_id]['members'] = User_ZoneRelModel::getInstance()->getNum(array('zone_id'=>$zone_id));
            }
            
            $data['group'] = (array)array_values($zone_rows);
        }
        
        $data['mine'] = User_InfoModel::getInstance()->getUserOne($where_row['user_id']);
    
        $data['mine']['avatar'] = $data['mine']['user_avatar'];
        $data['mine']['remark'] = $data['mine']['user_sign'];
        $data['mine']['status'] = "online";
        $data['mine']['username'] = $data['mine']['user_nickname'];
        $data['mine']['user_id'] = $data['mine']['user_id'];
        $data['mine']['id'] = Zero_Model::getPlantformUid($data['mine']['id']);

        
        //修正平台Id
        foreach ($data['friend'] as $k=>$g_rows)
        {
            foreach ($g_rows['list'] as $index=>$f_row)
            {
                $data['friend'][$k]['list'][$index]['id'] = Zero_Model::getPlantformUid($f_row['id']);
            }
           
        }
        
        return $data;
    }
}


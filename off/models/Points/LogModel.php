<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 *
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class Points_LogModel extends Zero_Model
{
	public $_cacheName       = 'log';
	public $_tableName       = 'points_log';
	public $_tablePrimaryKey = 'points_log_id';
	public $_useCache        = false;

	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'points_log_cond'=>array(
			'points_log_id'=>null,
			'store_id'=>null,
			'chain_id'=>null,
			'user_id'=>null,
			'points_type'=>null,
			'points_log_time'=>null,
			'points_order_id'=>null
		)
	);

	/**
	 * @param string $user  User Object
	 * @var   string $db_id 指定需要连接的数据库Id
	 * @return void
	 */
	public function __construct(&$db_id='ypos', &$user=null)
	{
		$this->_useCache  = false;
        
        $this->_tabelPrefix  = TABLE_YPOS_PREFIX;
		parent::__construct($db_id, $user);
		
		$this->pointsTypeText = array(
			'1' => '积分增加',
			'2' => '积分减少',
			'3' => '积分清零',
			'4' => '积分兑换',
			'5' => '商品消费',
			'6' => '快速消费'
		);
	}

	/**
	 * 读取分页列表
	 *
	 * @param  int $column_row where查询条件, 需要设置在multiCond中, 方便处理为group名字,用来通过组更新缓存
	 * @param  string $group 组名称
	 * @param  int $page 当前页码
	 * @param  int $rows 每页显示记录数
	 * @param  int $sort 排序方式
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getLists($column_row=array(), $sort=array(), $page=1, $rows=500)
	{
		//修改值 $column_row
		$data = $this->lists($column_row, $sort, $page, $rows);
		
		foreach($data['items'] as $k=>$v)
		{
			$type = $v['points_type'];
			$data['items'][$k]['points_type_txt'] = $this->pointsTypeText[$type];
		}
		
		return $data;
	}
	
	//店铺会员日志
	public function pointsLog($user_id = 0,$store_id = 0,$type = 0,$points = 0,$order_id = null,$remark = '')
	{	
		if($user_id && $store_id)
		{
			$this->memberBaseModel  = Member_BaseModel::getInstance();
            $member = $this->memberBaseModel->findOne(array('user_id' => $user_id, 'store_id' => $store_id));
			$user = $this->memberBaseModel->getAccountUser($user_id);
            
            if (empty($member))
            {
				$field = array();
                $field['user_id'] = $user_id;
                $field['member_mobile'] = $user['user_mobile'];
                $field['member_name'] = $user['user_realname'];
                $field['member_birthday'] = $user['user_birthday'];
                $field['member_email'] = $user['user_email'];
                $field['member_idcard'] = $user['user_idcard'];
                $field['member_logo'] = $user['user_avatar'];
                $field['member_grade_id'] = 0;
                $field['store_id'] = $store_id;
                $member_id = $this->memberBaseModel->add($field, true);
                $member_points = 0;
            } else 
			{
                $member_id = $member['member_id'];
                $member_points = $member['member_points'];
            }
 
			if($points > 0 || $type == 3)
			{
				$edit = array();
				$edit['member_points'] = $points;
				if($type == 2 || $type == 4)
				{
					$edit['member_points'] = $points*(-1);
				}
				
				if($type == 3)
				{
					$points = $member_points;
					$edit['member_points'] = $member_points*(-1);
				}
				$flag = $this->memberBaseModel->edit($member_id,$edit,true);
				
				$log = array();
				$log['user_id'] = $user_id;
				$log['points_type'] = $type; //商品消费
				$log['user_name']   = $user['user_account'];
				$log['member_id'] = $member_id;
				$log['points_order_id'] = $order_id;
				$log['points'] = $points;
				$log['points_pre_amount'] = $member_points;
				$log['store_id'] = $store_id;
				$log['points_log_time'] = get_datetime();
				
				$log['points_log_desc'] = $this->pointsTypeText[$type];
				if($remark)
				{
					$log['points_log_desc'].='-'.$remark;
				}
				$user_row = Zero_Perm::getUserRow();
				$log['points_operator'] = $user_row['user_account'];

				$this->add($log);
			}
		}
	}
}
?>
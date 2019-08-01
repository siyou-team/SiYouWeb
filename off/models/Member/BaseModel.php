<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @category   Framework
 * @package    Model
 * @author     windfnn
 */
class Member_BaseModel extends Zero_Model
{
	public $_cacheName       = 'base';
	public $_tableName       = 'member_base';
	public $_tablePrimaryKey = 'member_id';
	public $_useCache        = false;

	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'member_base_cond'=>array(
			'store_id'=>null,
			'chain_id'=>null,
			'user_id'=>null,
			'member_grade_id'=>null,
			'member_gender'=>null,
			'member_card'=>null
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

		return $data;
	}
	
	//根据member_id 获取会员基本信息
	public function getUserInfo($member_id = 0,$store_id = 0)
	{
		$data = array();
		$member = $this->getOne($member_id);

		if(!empty($member) && $member['store_id'] == $store_id)
		{
			$user_id = $member['user_id'];
			$this->accountInfoModel = User_InfoModel::getInstance();
			$data = $this->accountInfoModel->getUserOne($user_id);
		}
		$data['member_grade_id'] = $member['member_grade_id'];
		$this->gradeModel = Member_GradeModel::getInstance();
		$data['grade'] = $this->gradeModel->find(array('store_id'=>$store_id));
		$data['member_card'] = $member['member_card'];
		$data['member_address'] = $member['member_address'];
		$data['member_remark'] = $member['member_remark'];
		
		return $data;
	}
	
	//添加会员 - 目前直接向account表中添加数据
	public function addUser()
	{
		$this->accountInfoModel = User_InfoModel::getInstance();
		$base['user_account']  = s('user_account'); // 用户名
		$base['user_password'] = s('user_password','123456'); // 密码
		$base['user_nickname'] = s('user_nickname', s('user_account')); 
 
		$data['user_realname'] = s('user_realname');// 真实姓名
		$data['user_mobile']   = s('user_mobile');  // 手机号码(mobile)
		$data['user_tel']      = s('user_tel');     // 电话
		$data['user_email']    = s('user_email');   // 用户邮箱(email)
		$data['user_avatar']   = s('user_avatar');  // 头像
        $data['user_gender']   = i('user_gender');  // 性别1-男;  2-女;

		$is_admin = 0;
		$rights_group_id = i('rights_group_id');
		
		$this->accountInfoModel->sql->startTransactionDb();		
		$user_base_row = $this->accountInfoModel->register($base['user_account'], $base['user_password'], null, null, null, false, $rights_group_id, $is_admin);
		
		$user_id = $user_base_row['user_id'];
		if ($user_id && $this->accountInfoModel->sql->commitDb())
		{
			$flag = $this->accountInfoModel->editAccount($user_id, $data);
		}else{
			$this->accountInfoModel->sql->rollBackDb();
			$user_id = 0;
		}
		
		return $user_id;
	}

	//根据关键词搜索会员
	public function getUserId($key = null,$store_id = 0)
	{
		$user_id = 0;
		if($key)
		{
			//首先根据会员卡号搜索
			$member = $this->findOne(array('member_card'=>$key,'store_id'=>$store_id));
			if(empty($member))
			{
				$this->accountInfoModel = User_InfoModel::getInstance();
				$this->acctountBaseModel = User_BaseModel::getInstance();
				//会员卡号不存在 - 根据会员昵称查找
				$member = $this->acctountBaseModel->findOne(array('user_account'=>$key));
				
				if(empty($member))
				{
					//会员昵称不存在 - 根据会员手机号查找
					$member = $this->accountInfoModel->findOne(array('user_mobile'=>$key));
				}
			}
			
			$user_id = $member['user_id'];
		}
		
		return $user_id;
	}
	
	public function getAccountUser($user_id)
	{
		$this->accountInfoModel = User_InfoModel::getInstance();
		$data = $this->accountInfoModel->getUserOne($user_id);
		
		return $data;
	}
}
?>

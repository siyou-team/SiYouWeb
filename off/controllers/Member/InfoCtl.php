<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author    windfnn
 */
class Member_InfoCtl extends AdminController
{
    public $memberBaseModel = null; //店铺会员
	public $labelModel = null; //店铺标签
	public $store_id = null;   //店铺ID
	public $chain_id = null;   //门店ID
	public $accountInfoModel = null; //Account会员

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

        $this->memberBaseModel = Member_BaseModel::getInstance();		
		$this->labelModel = Member_LabelModel::getInstance();
		$this->accountInfoModel = User_InfoModel::getInstance();	
		$this->store_id  = Zero_Perm::$storeId;
		$this->chain_id  = Zero_Perm::getChainId();
    }
	
	
    //首页
    public function index()
    {
		$data = array();
		$this->gradeModel = Member_GradeModel::getInstance();
		$data['grade'] = $this->gradeModel->find(array('store_id'=>$this->store_id));
 
		$this->render('default',$data);
    }
    
    //编辑会员界面
	public function manage()
	{
		$data = array();
		$member_id = i('id');
		$data = $this->memberBaseModel->getUserInfo($member_id,$this->store_id);
 
		$this->render('default',$data);
	}
 
	/*
	* 获取该店铺或者门店下面的会员列表 
	*/
    public function lists()
    {
        $page = i('page', 1);  //当前页码
        $rows = i('rows', 10); //每页记录条数
        $sort = grid_sort();

        $column_row = array();
		$column_row['store_id'] = $this->store_id;
		$column_row['chain_id'] = $this->chain_id;
		
		$gender = i('gender'); //性别
		$member_grade_id = i('member_grade_id');
		
		if($gender)
		{
			$column_row['member_gender'] = $gender;
		}
		
		if($member_grade_id)
		{
			$column_row['member_grade_id'] = $member_grade_id;
		}
		
		if(s('memName'))
		{
			$column_row['member_number:LIKE'] = '%'.s('memName').'%';
		}
		
		$data = $this->memberBaseModel->getLists($column_row, $sort, $page, $rows);
		if(!empty($data['items']))
		{
			foreach($data['items'] as $k=>$val)
			{
				if($val['member_grade_id'] == 0)
				{
				 	$data['items'][$k]['member_grade_name'] = '普通会员';
				}else
				{
					$this->gradeModel = Member_GradeModel::getInstance();
					$this->gradeList = $this->gradeModel->find(array('store_id'=>$this->store_id));
					$data['items'][$k]['member_grade_name'] =  $this->gradeList[$val['member_grade_id']]['member_grade_name'];
				}
			}
		}
 
        $this->render('default', $data);
    }
	
	//增加会员
	public function add()
	{	
		$member_card = s('member_card');
		$member = $this->memberBaseModel->findOne(array('member_card'=>$member_card,'store_id'=>$this->store_id));
		
		if(empty($member))
		{
			$user_id = $this->memberBaseModel->addUser();
			if($user_id)
			{
				$this->memberBaseModel->sql->startTransactionDb();
				$field = array();
				$field['user_id'] = $user_id;
				$field['member_account'] = s('user_account'); //会员账号
				$field['member_card'] = s('member_card'); //会员卡号
				$field['member_grade_id'] = i('member_grade_id'); //等级
				$field['member_gender'] = i('user_gender'); //性别
				$field['member_mobile'] = $data['user_mobile'];
				$field['member_name']   = $data['user_realname'];
				$field['member_birthday'] = $data['user_birthday'];
				$field['member_email'] = $data['user_email'];
				$field['member_idcard']   = $data['user_idcard'];
				$field['member_logo']   = $data['user_avatar'];
				$field['member_grade_id'] = i('member_grade_id');
				$field['member_address'] = s('member_address');
				$field['member_remark']  = s('member_remark');
				$field['store_id']      = $this->store_id;
	 
				$flag = $this->memberBaseModel->add($field);
				if ($flag && $this->memberBaseModel->sql->commitDb())
				{
					$msg = __('操作成功');
					$status = 200;
				}
				else
				{
					$this->memberBaseModel->sql->rollBackDb();
					$msg = __('操作失败');
					$status = 250;
				}
			}else{
				$msg = __('操作失败');
				$status = 250;
			}
		}else{
			$msg = __('会员卡号已存在');
			$status = 250;
		}
		$data = array();
		$this->render('default', $data, $msg, $status);
	}

    //修改会员基本信息
    public function edit()
    {
		$data = array();
		$member_id = i('member_id');
		$member = $this->memberBaseModel->getOne($member_id);
		$member_card = s('member_card');
 
		if(!empty($member) && $member['store_id'] == $this->store_id)
		{
			$member_data = array();
			if($member['member_card'] != $member_card)
			{
				$member_data = $this->memberBaseModel->findOne(array('member_card'=>$member_card,'store_id'=>$this->store_id));
			}
			
			if(empty($member_data))
			{
				$user_id = $member['user_id'];
				$edit_field = array();
				$edit_field['user_avatar'] = s('user_avatar');// 头像
				$edit_field['user_gender'] = i('user_gender'); // 性别:1-男;  2-女;
				$edit_field['user_realname'] = s('user_realname'); // 真实姓名
				$edit_field['user_birthday'] = s('user_birthday'); // 生日(DATE)
				$edit_field['user_mobile'] = s('user_mobile'); // 手机号码(mobile)
				$edit_field['user_tel'] = s('user_tel'); // 电话
				$edit_field['user_email'] = s('user_email'); // 用户邮箱(email)
				$edit_field['user_idcard'] = s('user_idcard'); // 身份证
				
				$flag = $this->accountInfoModel->editUser($user_id, $edit_field);
				
				if($flag !== false)
				{
					$this->memberBaseModel->sql->startTransactionDb();
					$field = array();
					$field['user_id'] = $member['user_id'];
					$field['member_mobile'] = $edit_field['user_mobile'];
					$field['member_name']   = $edit_field['user_realname'];
					$field['member_birthday'] = $edit_field['user_birthday'];
					$field['member_email'] = $edit_field['user_email'];
					$field['member_idcard']   = $edit_field['user_idcard'];
					$field['member_logo']   = $edit_field['user_avatar'];
					$field['member_grade_id'] = i('member_grade_id');
					$field['member_gender'] = $edit_field['user_gender'];
					$field['store_id']      = $this->store_id;
					$field['member_card'] = s('member_card'); //会员卡号
					$field['member_address'] = s('member_address');
					$field['member_remark']  = s('member_remark');
					$flag = $this->memberBaseModel->edit($member_id,$field);
					if ($flag !== false && $this->memberBaseModel->sql->commitDb())
					{
						$msg = __('操作成功');
						$status = 200;
					}
					else
					{
						$this->memberBaseModel->sql->rollBackDb();
						$msg = __('操作失败');
						$status = 250;
					}
				}
			}else{
				$msg = __('会员卡号已存在');
				$status = 250;
			}
		}else{
			$msg = '未找到改会员';
			$status = 250;
		}
 
        $this->render('default', $data, $msg, $status);
    }
	
	//获取所有会员列表
	public function memberLists()
	{
		$data = array();
		$column_data = array();
		$page = i('page', 1);  //当前页码
        $rows = i('rows', 10); //每页记录条数
		$store_id = $this->store_id;

		$user_account = s('cardNo');
		if($user_account)
		{
			$user_id = $this->memberBaseModel->getUserId($user_account,$store_id);
			$column_data['user_id'] = $user_id;
		}
		$data = $this->accountInfoModel->getLists($column_data, $sort, $page, $rows);		
		$grade = Member_GradeModel::getInstance()->find();
		
		if($data['items'])
		{
			foreach($data['items'] as $k=>$v)
			{
				$user_id = $v['user_id'];			
				$member_points = 0;
				$member_money  = 0;
			
				$store_user = $this->memberBaseModel->findOne(array('user_id'=>$user_id,'store_id'=>$store_id));
				if($store_user)
				{
					$member_grade_id = $store_user['member_grade_id'];
					$member_points = $store_user['member_points'];
					$member_money  = $store_user['member_money'];
				}else{
					$member_grade_id = 0;
				}

				$data['items'][$k]['member_grade_id'] = $member_grade_id;
				$data['items'][$k]['member_grade_name'] = $member_grade_id?$grade[$member_grade_id]['member_grade_name']:'普通会员';
				$data['items'][$k]['member_points'] = $member_points;
				$data['items'][$k]['member_money'] = $member_money;
			}
		}
		$data['grade'] = $grade;
		
		$this->render('default', $data);
	}
	
	//获取会员信息
	public function memberInfo()
	{
		$user_id = i('user_id');
		$store_id = $this->store_id;
		$label = array();
		$level = array();
		
		$store_user = $this->memberBaseModel->findOne(array('user_id'=>$user_id,'store_id'=>$store_id));
		$member_points = 0;
		if($store_user)
		{
			$member_label_arr = explode(',',$store_user['member_label_id']);
			$label = $this->labelModel->find(array('member_label_id:IN'=>$member_label_arr));
			
			$member_grade_id = $store_user['member_grade_id'];
			$this->gradeModel = Member_GradeModel::getInstance();
			$level = $this->gradeModel->findOne(array('member_grade_id'=>$member_grade_id));
			if($member_grade_id ==  0)
			{
				$level['member_grade_pointsrate'] = 0;
				$level['member_grade_name'] = '普通会员';
				$level['member_grade_discountrate'] = 0;
			}

			$member_points = $store_user['member_points'];
		}else{
			$level['member_grade_pointsrate'] = 0;
			$level['member_grade_name'] = '普通会员';
			$level['member_grade_discountrate'] = 0;
		}
 
		$data['info']  = $this->accountInfoModel->getUserOne($user_id);
		$data['info']['member_points'] = $store_user['member_points']?$store_user['member_points']:0;
		$data['info']['member_card'] = $store_user['member_card'];
		$data['info']['member_grade_id'] = $store_user['member_grade_id'];
		$data['label'] = array_values($label);
		$data['level'] = $level;
		$msg = 200;
		$status = 200;
		
		$this->render('default', $data, $msg, $status);
	}
	
	//删除会员
	public function remove()
	{
		$member_id = i('member_id');
		$member = $this->memberBaseModel->getOne($member_id);
		if(!empty($member) && $member['store_id'] == $this->store_id)
		{
			$flag = $this->memberBaseModel->remove($member_id);
			if ($flag !== false)
			{
				$msg = __('操作成功');
				$status = 200;
			}
			else
			{
				$msg = __('操作失败');
				$status = 250;
			}
		}else{
			$msg = __('会员不存在');
			$status = 250;
		}
		
        $data['member_id'] = $member_id;
        $this->render('default', $data, $msg, $status);
	}
}
?>
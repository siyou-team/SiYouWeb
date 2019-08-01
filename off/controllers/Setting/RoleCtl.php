<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Setting_RoleCtl extends AdminController
{
	public $store_id = null;
	public $accountInfoModel = null;
	public $accountModel = null;
	public $groupModel = null;
	public $roleModel  = null;
	
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

		$this->accountInfoModel = User_InfoModel::getInstance();
		$this->accountModel = User_BaseModel::getInstance();
		$this->groupModel = Role_RightsGroupModel::getInstance();
		$this->roleModel = Role_BaseModel::getInstance();
		$this->store_id = Zero_Perm::$storeId;
    }
	
	
    /**
     * 首页
     * 
     * @access public
     */
    public function index()
    {		
		$data['group'] = $this->groupModel->find(array('store_id'=>$this->store_id));
		$this->render('default',$data);
    }
	
	//列表
	public function lists()
	{
		$page = i('PageIndex', 1);  //当前页码
        $rows = i('PageSize', 10); //每页记录条数
        $sort = array();
 
		$column_data = array();
		$column_data['store_id'] = $this->store_id;
		$data = $this->roleModel->getLists($column_data, $sort, $page, $rows);
		if(!empty($data['items']))
		{
			$user_ids = array_column($data['items'], 'user_id');
			$user_rows = User_BaseModel::getInstance()->get($user_ids);
			$user_info = $this->accountInfoModel->get($user_ids);
			foreach ($data['items'] as $k=>$v) 
			{
				$data['items'][$k]['user_account'] = $user_rows[$v['user_id']]['user_account'];
				$data['items'][$k]['user_nickname'] = $user_rows[$v['user_id']]['user_nickname'];
				$data['items'][$k]['user_realname'] = $user_info[$v['user_id']]['user_realname'];
				$data['items'][$k]['user_mobile'] = $user_info[$v['user_id']]['user_mobile'];

				$rights_group_id = $v['rights_group_id'];
				$group = $this->groupModel->getOne($rights_group_id);
				$data['items'][$k]['rights_group_name'] = $group['rights_group_name'];
			}
		}
		
		$this->render('default',$data);
	}
 
	//新增
	public function add()
	{				
		$data['user_state']             = i('user_state',2);
		$data['user_id']                = i('user_id'); // 用户id
		$data['user_realname']          = s('user_realname'); // 真实姓名
		$data['user_mobile']            = s('user_mobile'); // 手机号码(mobile)
		$data['user_tel']               = s('user_tel');    // 电话
		$data['user_email']             = s('user_email');  // 用户邮箱(email)

		$is_admin = 0;	
		$base['user_account']  = s('user_account'); // 用户名
		$base['user_password'] = s('user_password'); // 密码
		$base['user_nickname'] = s('user_nickname', s('user_account')); //  用户昵称
		$this->accountInfoModel->sql->startTransactionDb();
			
		$user_base_row = $this->accountInfoModel->register($base['user_account'], $base['user_password'], null, null, null, false, 0, $is_admin,$this->store_id);			
		$user_id = $user_base_row['user_id'];
		if($user_id)
		{
			//目前必须插入店铺员工表，否则无法获取店铺storeId
			$employee_id = Store_EmployeeModel::getInstance()->add(array('user_id' => $user_id, 'store_id' => $this->store_id,'employee_is_admin'=>3));
		}
			
		if ($user_id && $employee_id && $this->accountInfoModel->sql->commitDb())
		{
			$msg = __('操作成功');
			$status = 200;
				
			$rights_group_id = i('rights_group_id');
			$role_row = array();
			$role_row['user_id'] = $user_id;
			$role_row['user_is_pos'] = 1;
			$role_row['role_add_time'] = get_datetime();
			$role_row['store_id'] = $this->store_id;
			$role_row['rights_group_id'] = $rights_group_id;
			$role_row['employee_id'] = $employee_id; //插入冗余字段
			$flag = $this->roleModel->add($role_row);
		}
		else
		{
			$this->accountInfoModel->sql->rollBackDb();
			$msg = __('操作失败');
			$status = 250;
		}

		$data['user_id'] = $user_id;		
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
		$this->render('default', $data, $msg, $status);
	}
	
	//修改
	public function edit()
	{
		$user_id = i('user_id');		
		$data['user_state']             = i('user_state',2);
		$data['user_id']                = i('user_id');       // 用户id
		$data['user_realname']          = s('user_realname'); // 真实姓名
		$data['user_mobile']            = s('user_mobile');   // 手机号码(mobile)
		$data['user_tel']               = s('user_tel');      // 电话
		$data['user_email']             = s('user_email');    // 用户邮箱(email)
		
		$flag = $this->accountInfoModel->editUser($user_id, $data);
		$data['user_id'] = $user_id;		
		if ($flag !== false)
        {
            $msg = __('操作成功');
            $status = 200;
			
			$role = $this->roleModel->findOne(array('store_id'=>$this->store_id,'user_id'=>$user_id));
			$role_id = $role['role_id'];
			$rights_group_id = i('rights_group_id');
			$role_row = array();
			$role_row['rights_group_id'] = $rights_group_id;
			$flag = $this->roleModel->edit($role_id,$role_row);
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }		
		$this->render('default', $data, $msg, $status);
	}
 
	//删除
	public function remove()
    {
        $user_id = i('user_id');
        $data['user_id'] = $user_id;
        $user = $this->accountInfoModel->getOne($user_id);
		$user_pos = $this->roleModel->findOne(array('user_id'=>$user_id,'store_id'=>$this->store_id));
        if ($user && $user_pos)
        {
            $flag = $this->accountInfoModel->removeUser($user_id);
            if ($flag !== false)
            {
				//删除当role_base表中的数据
				$flag = $this->roleModel->remove($user_pos['role_id']);
				//删除employee表中的数据
				$flag = Store_EmployeeModel::getInstance()->remove($user_pos['employee_id']);
                $msg = __('操作成功');
                $status = 200;
            }
            else
            {
                $msg = __('操作失败');
                $status = 250;
            }
        }else{

            $msg = __('数据不存在');
            $status = 250;
        }

        $this->render('default', $data, $msg, $status);
    }
}
?>
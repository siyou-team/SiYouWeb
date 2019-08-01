<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Setting_ChainCtl extends AdminController
{
	public $store_id = null;
	public $chainModel = null;
	
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
		
		$this->store_id = Zero_Perm::getStoreId();
		$this->chainModel = Chain_InfoModel::getInstance();
    }
 
    //首页
    public function index()
    {		
		$this->groupModel = Role_RightsGroupModel::getInstance();
		$data['group'] = $this->groupModel->find(array('store_id'=>$this->store_id));

		$this->render('default',$data);
    }
	
	//列表
	public function lists()
	{
		$page = i('page', 1);  //当前页码
        $rows = i('rows', 10); //每页记录条数
        $sort = array();
		
		$column_data = array();
		$column_data['store_id'] = $this->store_id;
		$data = $this->chainModel->getLists($column_data, $sort, $page, $rows);
		foreach($data['items'] as $k=>$v)
		{
			$data['items'][$k]['staff_department_name'] = $this->departmentList[$v['staff_department_id']]['department_name'];
		}
		
		$this->render('default',$data);
	}
	
	public function add()
	{
		
		$data['chain_name']      = s('chain_name');
		$data['chain_telephone'] = s('chain_telephone');
		$data['chain_contacter'] = s('chain_contacter');
		$data['chain_email']     = s('chain_email');
		$data['chain_address']   = s('chain_address');
		$data['store_id'] = $this->store_id;
		$data['chain_time'] = get_datetime();
		
		$this->chainModel->sql->startTransactionDb();  
		$chain_id = $this->chainModel->add($data,true);
		if($chain_id)
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
			
			$this->accountInfoModel = User_InfoModel::getInstance();
			$user_base_row = $this->accountInfoModel->register($base['user_account'], $base['user_password'], null, null, null, false, 0, $is_admin,$this->store_id);			
			$user_id = $user_base_row['user_id'];
			if($user_id)
			{
				//目前必须插入店铺员工表，否则无法获取店铺storeId
				$chain_user_id = Chain_UserModel::getInstance()->add(array('user_id' => $user_id, 'store_id' => $this->store_id,'chain_id'=>$chain_id));
			}
				
			if ($user_id && $chain_user_id)
			{
				$msg = __('操作成功');
				$status = 200;
				
				$this->roleModel = Role_BaseModel::getInstance();
				$rights_group_id = i('rights_group_id');
				$role_row = array();
				$role_row['user_id'] = $user_id;
				$role_row['user_is_pos'] = 1;
				$role_row['role_add_time'] = get_datetime();
				$role_row['store_id'] = $this->store_id;
				$role_row['rights_group_id'] = $rights_group_id;
				$role_row['chain_id'] = $chain_id;
				$role_row['role_is_chain'] = 1;
				$flag = $this->roleModel->add($role_row);
			}
			else
			{
				$msg = __('操作失败');
				$status = 250;
			}
		}
		
		if ($flag !== false && $chain_id && $this->chainModel->sql->commitDb())
        {
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
			$this->chainModel->sql->rollBackDb();
			
            $msg = __('操作失败');
            $status = 250;
        }
		
		$this->render('default', $data, $msg, $status);
	}
 
	public function edit()
	{
		$chain_id = i('chain_id');
		$data['chain_name']      = s('chain_name');
		$data['chain_telephone'] = s('chain_telephone');
		$data['chain_contacter'] = s('chain_contacter');
		$data['chain_email']     = s('chain_email');
		$data['chain_address']   = s('chain_address');

		$flag = $this->chainModel->edit($chain_id,$data);
		
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
}
?>
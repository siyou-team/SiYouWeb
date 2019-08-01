<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Setting_RightsCtl extends AdminController
{
	public $store_id = null;
	public $groupModel = null;
	
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
		$this->groupModel = Role_RightsGroupModel::getInstance();
    }
	
	
    /**
     * 首页
     * 
     * @access public
     */
    public function index()
    {		
		$this->render('default');
    }
	
	//列表
	public function lists()
	{
		$page = i('PageIndex', 1);  //当前页码
        $rows = i('PageSize', 10); //每页记录条数
        $sort = array();
		
		$column_data = array();
		$column_data['store_id'] = $this->store_id;
		$data = $this->groupModel->getLists($column_data, $sort, $page, $rows);
 
		$this->render('default',$data);
	}
 
	public function edit()
	{
		$rights_group_id = i('rights_group_id');
		$data['rights_group_name'] = s('rights_group_name');
		$flag = $this->groupModel->edit($rights_group_id,$data);
		
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
 
	public function add()
	{				
		$data['rights_group_name'] = s('rights_group_name');
		$data['store_id'] = $this->store_id;
		$data['group_add_time'] = get_datetime();
		$flag = $this->groupModel->add($data);

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
 
	public function remove()
    {
        $rights_group_id = i('rights_group_id');
        $data['rights_group_id'] = $rights_group_id;
        $rightsGroup = $this->groupModel->getOne($rights_group_id);
        if ($rightsGroup && $rightsGroup['store_id'] == $this->store_id)
        {
			$rightsUser = Role_BaseModel::getInstance()->find(array('rights_group_id'=>$rights_group_id,'store_id'=>$this->store_id));
			
			if(empty($rightsUser))
			{
				$flag = $this->groupModel->remove($rights_group_id);
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
				$msg = __('该权限组下面有用户存在！'); 
				$status = 250;
			}
        }else{

            $msg = __('数据不存在');
            $status = 250;
        }

        $this->render('default', $data, $msg, $status);
    }
	
	//角色权限列表
	public function rightsLists()
	{
		$Role_RightsModel = Role_RightsModel::getInstance();
		$data = $Role_RightsModel->getLists(array('rights_enable'=>1));
		
		$this->render('default',$data);
	}
	
	//获取当前角色组权限
	public function groupRights()
	{
	    $data = array();
	    $rights_group_id = i('rights_group_id');
	    $group = $this->groupModel->getOne($rights_group_id);
	    if($group['rights_ids'])
	    {
			$data = explode(',',$group['rights_ids']);
	    }
		$this->render('default',$data);
	}
	
	//编辑角色权限
	public function editGroupRights()
	{
		$rights_group_id = i('rights_group_id');
		$group = $this->groupModel->getOne($rights_group_id);
		
		if(!empty($group) && $group['store_id'] == $this->store_id)
		{
			$data['rights_ids'] = s('rights_ids');		
			$flag = $this->groupModel->edit($rights_group_id,$data);
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
			$msg = __('数据不存在');
			$status = 250;
		}
		
		$this->render('default', $data, $msg, $status);
	}
}
?>
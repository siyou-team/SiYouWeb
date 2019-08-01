<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Setting_DepartmentCtl extends AdminController
{
	public $store_id = null;
	public $departmentModel = null;
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
		$this->departmentModel = Shop_StaffDepartmentModel::getInstance();
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
		$data = $this->departmentModel->getLists($column_data, $sort, $page, $rows);
		$this->render('default',$data);
	}
	
	//编辑
	public function manage()
    {
		$this->render('default');
    }
	
	public function add()
	{
		$data['department_name'] = s('department_name');
		$data['department_enable'] = i('department_enable');
		$data['store_id'] = $this->store_id;
		$data['department_add_time'] = get_datetime();
		$flag = $this->departmentModel->add($data);
		
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
	
	public function edit()
	{
		$department_id = i('department_id');
		$data['department_name'] = s('department_name');
		$data['department_enable'] = i('department_enable');
		$flag = $this->departmentModel->edit($department_id,$data);
		
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
        $department_id = i('department_id');
        $data['department_id'] = $department_id;
        $department = $this->departmentModel->getOne($department_id);
        if ($department && $department['store_id'] == $this->store_id)
        {
			$staffModel = Shop_StaffModel::getInstance();
			$department_staff = $staffModel->find(array('staff_department_id'=>$department_id,'store_id'=>$this->store_id));
			
			if(empty($department_staff)){
				$flag = $this->departmentModel->remove($department_id);
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
				$msg = __('该部门下有员工存在！'); 
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
<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Setting_StaffCtl extends AdminController
{
	public $store_id = null;
	public $staffModel = null;
	public $departmentModel = null;
	public $departmentList = null;
	
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
		$this->staffModel = Shop_StaffModel::getInstance();
		$this->departmentModel = Shop_StaffDepartmentModel::getInstance(); 
		$this->departmentList = $this->departmentModel->find(array('store_id'=>$this->store_id,'department_enable'=>1));
    }
	
	
    /**
     * 首页
     * 
     * @access public
     */
    public function index()
    {	
		$data['department'] = $this->departmentList;	
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
		$data = $this->staffModel->getLists($column_data, $sort, $page, $rows);
		foreach($data['items'] as $k=>$v)
		{
			$data['items'][$k]['staff_department_name'] = $this->departmentList[$v['staff_department_id']]['department_name'];
		}
		
		$this->render('default',$data);
	}
	
	public function add()
	{
		
		$data['staff_name'] = s('staff_name');
		$data['staff_mobile'] = s('staff_mobile');
		$data['staff_department_id'] = i('staff_department_id');
		$data['staff_gender'] = i('staff_gender');
		$data['staff_address'] = s('staff_address');
		$data['store_id'] = $this->store_id;
		$data['staff_add_time'] = get_datetime();
		$flag = $this->staffModel->add($data);
		
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
		$staff_id = i('staff_id');
		$data['staff_name'] = s('staff_name');
		$data['staff_mobile'] = s('staff_mobile');
		$data['staff_department_id'] = i('staff_department_id');
		$data['staff_gender'] = i('staff_gender');
		$data['staff_address'] = s('staff_address');
 	
		$flag = $this->staffModel->edit($staff_id,$data);
		
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
        $staff_id = i('staff_id');
        $data['staff_id'] = $staff_id;
        $department = $this->staffModel->getOne($staff_id);
        if ($department && $department['store_id'] == $this->store_id)
        {
            $flag = $this->staffModel->remove($staff_id);
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
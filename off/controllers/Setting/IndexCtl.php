<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Setting_IndexCtl extends AdminController
{
	public $store_id = null;
	public $chain_id = null;
	public $settingModel = null;
	
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
		$this->chain_id = Zero_Perm::getChainId();
		$this->settingModel = Shop_SettingModel::getInstance();
    }
	
	
    /**
     * 首页
     * 
     * @access public
     */
    public function index()
    {	
		$data = $this->settingModel->getSettings($this->store_id,$this->chain_id);
		$this->render('default',$data);
    }
 
	public function edit()
	{
		$staff_id = i('staff_id');
		$data['staff_name'] = s('staff_name');
		$data['staff_mobile'] = s('staff_mobile');
		$data['staff_department_id'] = i('staff_department_id');
		$data['staff_gender'] = i('staff_gender');
		$data['staff_address'] = s('staff_address');
 	
		$flag = $this->settingModel->edit($staff_id,$data);
		
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
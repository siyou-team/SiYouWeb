<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Report_MemberCtl extends AdminController
{
    public $memberBaseModel = null;
	public $gradeModel = null;
	public $labelModel = null;
	public $store_id = null;
	public $orderBaseModel = null;
	
	public $orderReportModel = null;
	public $rangeDay = null;
	public $begin_time = null;
	public $end_time = null;
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
        $this->model = $this->memberBaseModel;
		$this->gradeModel = Member_GradeModel::getInstance();
		$this->labelModel = Member_LabelModel::getInstance();
		$this->store_id = Zero_Perm::$storeId;
		$this->orderBaseModel = Order_ListModel::getInstance();
		
		$this->orderReportModel = Order_ReportModel::getInstance();
		
		$timetype = i('timetype');
		$this->begin_time = s('begintime');
		$this->end_time = s('endtime');
		
		$this->rangeDay = 7;
		if($timetype == 1)
		{
			//获取当日时间段
			$this->begin_time = date("Y-m-d 00:00:00");
			$this->end_time = date('Y-m-d 23:59:59');
			$this->rangeDay = 1;
		}
		if($timetype == 2)
		{
			//获取最近七天的起止时间
			$this->begin_time = date("Y-m-d 00:00:00", strtotime("-7 days"));
			$this->end_time = date('Y-m-d 23:59:59');
		}
		
		if($timetype == 3)
		{
			//获取本月时间
			$month = $this->orderReportModel->getMonthRange(date('Y-m'));
			$this->rangeDay = date("t"); //获取当前月份的天数
			$this->begin_time = $month[0];
			$this->end_time = $month[1];
		}
		if($timetype == 4)
		{
			//获取本年时间段
			$year = date('Y');
			$this->begin_time = $year.'-01-01 00:00:00';
			$this->end_time = $year.'-12-31 23:59:59';
			//获取两个时间之间的时间差
			$this->rangeDay = round((strtotime($this->end_time)-strtotime($this->begin_time))/3600/24);
		}
		if($timetype == 5)
		{
			//获取两个时间之间的时间差
			$this->rangeDay = round((strtotime($this->end_time)-strtotime($this->begin_time))/3600/24);
		}
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
	
	public function getMemberConsumption()
	{		
		$data = array();

		$data = $this->orderReportModel->memberConsumption($this->store_id,$this->rangeDay,$this->begin_time,$this->end_time);
 
		$this->render('default',$data);
	}
	
	public function getGenderConsumption()
	{
		//member_gender 1男 2女
		$data[] = $this->orderReportModel->genderConsumption($this->store_id,$this->rangeDay,$this->begin_time,$this->end_time,1);
		$data[] = $this->orderReportModel->genderConsumption($this->store_id,$this->rangeDay,$this->begin_time,$this->end_time,2);
		
		$this->render('default',$data);
	}
}
?>
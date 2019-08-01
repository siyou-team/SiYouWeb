<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Report_GoodsCtl extends AdminController
{
	public $orderReportModel = null;
	public $rangeDay = null;
	public $begin_time = null;
	public $end_time = null;
	public $timetype = null;
	public $store_id = null;
	public $ismember = null;
	public $order_type = null;
	public $limitRows = null;
	
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

		$this->orderReportModel = Order_ReportModel::getInstance();
		$timetype = i('timetype');
		$this->timetype = $timetype;
		$this->begin_time = s('begintime');
		$this->end_time = s('endtime');
		$this->store_id = Zero_Perm::$storeId;
		$this->ismember = i('ismember');
		$this->order_type = i('order_type',2);
		$this->limitRows = i('top',10);
		
		$this->rangeDay = 1;
		if($timetype == 1)
		{
			//获取当日时间段
			$this->begin_time = date("Y-m-d 00:00:00");
			$this->end_time = date('Y-m-d 23:59:59');
		}
		
		if($timetype == 2)
		{
			//获取最近七天的起止时间
			$this->begin_time = date("Y-m-d 00:00:00", strtotime("-6 days"));
			$this->end_time = date('Y-m-d 23:59:59');
			$this->rangeDay = 7;
		}
		
		if($timetype == 3)
		{
			//获取本月时间段
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
		
		if($timetype == -1)
		{
			$this->rangeDay = 7;
			//获取最近七天的起止时间
			$this->begin_time = date("Y-m-d 00:00:00", strtotime("-6 days"));
			$this->end_time = date('Y-m-d 23:59:59');
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
 
	public function salesList()
	{
		$data = array();
		if($this->timetype == 1)
		{
			//获取当天所有的时间段
			$h = date('H');			
			for($i=0; $i<= $h; $i++)
			{
				if($i < 10)
				{
					$time = '0'.$i.':00';
				}else{
					$time = $i.':00';
				}
				
				$consumption = array();
				$consumption['CreateTime'] = $time;
				$begin_time = date('Y-m-d '.$i.':00:00');
				$end_time = date('Y-m-d H:i:s',strtotime($begin_time)+3600-1);
				
				$consumption['begin_time'] = $begin_time;
				$consumption['end_time'] = $end_time;
				$order_data = $this->orderReportModel->getTimeConsumption($this->store_id,$begin_time,$end_time,$this->ismember,$this->order_type,$this->limitRows);
				$consumption['TotalConsumption'] = $order_data['totalMoney'];
				$consumption['PurchasePrice'] = 0;
				$consumption['Profit'] = 0;
				$consumption['AddMember'] = 0;
				$consumption['Freight'] = 0;
				$consumption['totalNum'] = $order_data['totalNum'];
				$consumption['ismember'] = $order_data['ismember'];
				$consumption['totalCost'] = $order_data['totalCost'];
				$consumption['profit'] = $order_data['profit'];
				
				$data[] = $consumption;
			}
		}
		
		if($this->timetype == 2 ||$this->timetype == 5 ||$this->timetype == -1 ||$this->timetype == 3||$this->timetype == 4)
		{
			//获取本月所有的时间段
			$consumption = array();
			for($i=0; $i< $this->rangeDay; $i++)
			{
				$time = strtotime($this->begin_time)+$i*24*60*60;
				$begin_time = date('Y-m-d 00:00:00',$time);
				$end_time = date('Y-m-d 23:59:59',$time);
				
				$consumption['CreateTime'] = date('Y-m-d',$time);
				$consumption['begin_time'] = $begin_time;
				$consumption['end_time'] = $end_time;
				$order_data = $this->orderReportModel->getTimeConsumption($this->store_id,$begin_time,$end_time,$this->ismember,$this->order_type,$this->limitRows);
				$consumption['TotalConsumption'] = $order_data['totalMoney'];
				$consumption['PurchasePrice'] = 0;
				$consumption['Profit'] = 0;
				$consumption['AddMember'] = 0;
				$consumption['Freight'] = 0;
				$consumption['totalNum'] = $order_data['totalNum'];
				$consumption['totalCost'] = $order_data['totalCost'];
				$consumption['profit'] = $order_data['profit'];
				
				$data[] = $consumption;
			}	
		}
		
		//按年
		if($this->timetype == -2)
		{
			//获取本月所有的时间段
			$consumption = array();
			$year = date('Y');
			for($i=1; $i<= 12; $i++)
			{
				$monthRange = $this->orderReportModel->getMonthRange($year.'-'.$i);
				$begin_time = $monthRange[0];
				$end_time   = $monthRange[1];
				
				$consumption['CreateTime'] = $i.__('月');
				$consumption['begin_time'] = $begin_time;
				$consumption['end_time'] = $end_time;
				$order_data = $this->orderReportModel->getTimeConsumption($this->store_id,$begin_time,$end_time,$this->ismember,$this->order_type,$this->limitRows);
				$consumption['TotalConsumption'] = $order_data['totalMoney'];
				$consumption['PurchasePrice'] = 0;
				$consumption['Profit'] = 0;
				$consumption['AddMember'] = 0;
				$consumption['Freight'] = 0;
				$consumption['totalNum'] = $order_data['totalNum'];
				$consumption['totalCost'] = $order_data['totalCost'];
				$consumption['profit'] = $order_data['profit'];
				
				$data[] = $consumption;
			}	
		}
		
		$total['CreateTime'] = __('总计');
		$total['TotalConsumption'] = array_sum(array_column($data,'TotalConsumption'));
		$total['totalNum'] = array_sum(array_column($data,'totalNum'));
		$total['totalCost'] = array_sum(array_column($data,'totalCost'));
		$total['profit'] = array_sum(array_column($data,'profit'));
		
		$data[] = $total;
		
		$return = array();
		$return['lists'] = $data;
		$return['totalMoney'] = $total['TotalConsumption'];
		$return['totalNum'] = $total['totalNum'];
		$return['timetype'] = $this->timetype;
		
		$this->render('default',$return);
	}
	
	//商品销量
	public function salesAnalysisList()
	{
		$data = array();
		
		$order_data = $this->orderReportModel->salesAnalysisList($this->store_id,$this->begin_time,$this->end_time,$this->ismember);
		
		$i = 0;
		foreach($order_data as $k=>$v)
		{
			$consumption['GoodsName'] = $v['goods_name'];
			$consumption['GoodsCode'] = $v['goods_code'];
			$consumption['TotalMoney'] = $v['totalMoney'];
			$consumption['TotalNum'] = $v['totalNum'];
			$consumption['begin_time'] = $this->begin_time;
			$consumption['end_time'] = $this->end_time;
			$consumption['totalCost']  = $v['totalCost'];
			$consumption['profit'] = round($consumption['TotalMoney']-$v['totalCost'],2);
			$data[] = $consumption;
		}
 
		$this->render('default',$data);
	}
}
?>
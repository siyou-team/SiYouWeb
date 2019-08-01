<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 *
 *
 * @category   Framework
 * @package    Model
 * @author     windfnn
 * @copyright  Copyright (c) 2010, windfnn 该model仅用于店铺统计
 * @version    1.0
 * @todo
 */
class Order_ReportModel extends Order_ListModel
{	
	//获取店铺的会员和非会员的消费统计
	public function memberConsumption($store_id,$rangeDay,$begin_time = null,$end_time = null)
	{
		$sql = 'SELECT * FROM '.TABLE_YPOS_PREFIX.'order_list'.' WHERE store_id = '.$store_id.' AND  user_id = 0';
		if($begin_time)
		{
			$sql.= " AND `order_create_time` >= '$begin_time' ";
		}
		if($end_time)
		{
			$sql.= " AND `order_create_time` <= '$end_time '";
		}
		$member_data = $this->sql->getAll($sql);
		$member_consumption['totalNum'] = count($member_data);
		$member_consumption['totalMoney'] = array_sum(array_column($member_data,'order_pay_amount'));
		$member_consumption['avgMoney'] = round($member_consumption['totalMoney']/$rangeDay,2);
		$member_consumption['name'] = ('非会员');
		$data[] = $member_consumption;
		
		$sql = 'SELECT * FROM '.TABLE_YPOS_PREFIX.'order_list'.' WHERE store_id = '.$store_id.' AND  user_id != 0';
		if($begin_time)
		{
			$sql.= " AND `order_create_time` >= '$begin_time' ";
		}
		if($end_time)
		{
			$sql.= " AND `order_create_time` <= '$end_time '";
		}
		$member_data = $this->sql->getAll($sql);
		$member_consumption['totalNum'] = count($member_data);
		$member_consumption['totalMoney'] = array_sum(array_column($member_data,'order_pay_amount'));
		$member_consumption['avgMoney'] = round($member_consumption['totalMoney']/$rangeDay,2);
		$member_consumption['name'] = ('会员');
		
		$data[] = $member_consumption;

		return $data;
	}
	
	public function genderConsumption($store_id,$rangeDay,$begin_time = null,$end_time = null,$gender = 1)
	{
		if($gender == 1)
		{
			$data['gender'] = ('男士');
		}else{
			$data['gender'] = ('女士');
		}
		
		$sql = 'SELECT `user_id` FROM ypos_member_base WHERE member_gender = '.$gender.' AND store_id = '.$store_id;
		$user_data = $this->sql->getAll($sql);
		$con = implode(',',array_column($user_data,'user_id'));
		if(empty($con)){$con = -1;}
 
		$sql = 'SELECT * FROM ypos_order_list WHERE `user_id` IN ('.$con.') AND store_id = '.$store_id;
		if($begin_time)
		{
			$sql.= " AND `order_create_time` >= '$begin_time' ";
		}
		if($end_time)
		{
			$sql.= " AND `order_create_time` <= '$end_time '";
		}
		$order_data = $this->sql->getAll($sql);
		
		$data['totalNum'] = count($order_data);
		$data['totalMoney'] = array_sum(array_column($order_data,'order_pay_amount'));
		$data['avgMoney'] = round($data['totalMoney']/$rangeDay,2);
		//$data['user_ids'] = $user_ids;
		
		return $data;
	}
	
	public function getTimeConsumption($store_id,$begin_time,$end_time,$ismember,$order_type = 2,$limitRows = 10)
	{
		$sql = 'SELECT * FROM ypos_order_list WHERE store_id = '.$store_id.'';
		
		if($order_type)
		{
			$sql.= " AND `order_type` = '$order_type' ";
		}
		
		if($begin_time)
		{
			$sql.= " AND `order_create_time` >= '$begin_time' ";
		}
		if($end_time)
		{
			$sql.= " AND `order_create_time` <= '$end_time '";
		}
		if($ismember == 2)
		{
			$sql.= " AND `user_id` != 0";
		}
		if($ismember == 3)
		{
			$sql.= " AND `user_id` = 0";
		}
		$sql.=" order by order_pay_amount desc ";
		//$sql.=" limit 0,".$limitRows;
		$order_data = $this->sql->getAll($sql);
		
		$data['totalNum'] = count($order_data);
		$data['totalMoney'] = array_sum(array_column($order_data,'order_pay_amount'));
		$data['totalCost']  = array_sum(array_column($order_data,'order_cost'));
		$data['profit'] = round($data['totalMoney']-$data['totalCost'],2);
		
		return $data;
	}
	
	public function salesAnalysisList($store_id,$begin_time,$end_time,$ismember)
	{
		$sql = 'SELECT goods_id,goods_code,goods_name,SUM(order_goods_payamount) as totalMoney,SUM(goods_number) as totalNum,SUM(goods_cost) as totalCost FROM `ypos_order_goods` WHERE store_id = '.$store_id;
		
		if($begin_time)
		{
			$sql.= " AND `goods_add_time` >= '$begin_time' ";
		}
		if($end_time)
		{
			$sql.= " AND `goods_add_time` <= '$end_time '";
		}
		if($ismember == 2)
		{
			$sql.= " AND `user_id` != 0";
		}
		if($ismember == 3)
		{
			$sql.= " AND `user_id` = 0";
		}
		
		$sql.=' GROUP BY goods_id ';
		if($order = s('order')){
			$sql.= $order;
		}else{
			$sql.='ORDER BY totalMoney DESC';
		}
		if($top = s('top')){
			$sql.= ' limit 0,'.$top;
		}else{
			$sql.=' limit 0,10';
		}
		
		$order_data = $this->sql->getAll($sql);
		
		return $order_data;
	}
	
	public function getMonthRange($month)
	{
		$timestamp     = strtotime($month . "-1");
		$monthFirstDay = date('Y-m-1 00:00:00', $timestamp);
		$arr[]         = $monthFirstDay;
		$mdays         = date('t', $timestamp);
		$monthLastDay  = date('Y-m-' . $mdays . ' 23:59:59', $timestamp);
		$arr[]         = $monthLastDay;
		return $arr;
	} 
}
?>
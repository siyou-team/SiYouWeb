<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 *
 *
 * @category   Framework
 * @package    Model
 * @author     windfnn <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 上海迅有 windfnn
 * @version    1.0
 * @todo
 */
class ReportModel extends Zero_Model
{
	/**
	 * @param string $user  User Object
	 * @var   string $db_id 指定需要连接的数据库Id
	 * @return void
	 */
	public function __construct()
	{
	}
	
	public function get_weekinfo($month, $k = NULL)
	{
		$weekinfo = array();
		$end_date = date('d', strtotime($month . ' +1 month -1 day'));
		for ($i = 1; $i < $end_date; $i = $i + 7)
		{
			$w = date('N', strtotime($month . '-' . $i));

			$weekinfo[] = array(
				date('Y-m-d', strtotime($month . '-' . $i . ' -' . ($w - 1) . ' days')),
				date('Y-m-d', strtotime($month . '-' . $i . ' +' . (7 - $w) . ' days'))
			);
		}
		if ($k)
		{
			return $weekinfo[$k];
		}
		else
		{
			return $weekinfo;
		}

	}

	public function getYear()
	{
		$start_year = date("Y", strtotime("-5 years"));
		$end_year   = date("Y", strtotime("+5 years"));
		$year       = "";
		for ($i = $start_year; $i <= $end_year; $i++)
		{
			$selected = "";
			if ($i == date("Y"))
			{
				$selected = "selected='selected'";
			}
			$year .= "<option value='{$i}' {$selected}>{$i}" . __('年') . "</option>";
		}
		$month = "";
		for ($i = 1; $i <= 12; $i++)
		{
			$selected = "";
			if ($i == date("m"))
			{
				$selected = "selected='selected'";
			}
			$month .= "<option value='{$i}' {$selected}>{$i}" . __('月') . "</option>";
		}
		$arr['year']  = $year;
		$arr['month'] = $month;
		return $arr;
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

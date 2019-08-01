<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 *
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class Shop_OperationLogModel extends Zero_Model
{
	public $_cacheName       = 'log';
	public $_tableName       = 'shop_operation_log';
	public $_tablePrimaryKey = 'log_id';
	public $_useCache        = false;
	public $_languageCond    = true;
	
	public $fieldType = array('log_param'=>'SOURCE');
	
	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'shop_operation_log_cond'=>array(
			'log_id'=>null,
			'store_id'=>null
		)
	);

	/**
	 * @param string $user  User Object
	 * @var   string $db_id 指定需要连接的数据库Id
	 * @return void
	 */
	public function __construct(&$db_id='ypos', &$user=null)
	{
		$this->_useCache  = false;
        
        $this->_tabelPrefix  = TABLE_YPOS_PREFIX;
		parent::__construct($db_id, $user);
	}

	/**
	 * 读取分页列表
	 *
	 * @param  int $column_row where查询条件, 需要设置在multiCond中, 方便处理为group名字,用来通过组更新缓存
	 * @param  string $group 组名称
	 * @param  int $page 当前页码
	 * @param  int $rows 每页显示记录数
	 * @param  int $sort 排序方式
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getLists($column_row=array(), $sort=array(), $page=1, $rows=500)
	{
		//修改值 $column_row
		$data = $this->lists($column_row, $sort, $page, $rows);

		return $data;
	}
	
	public function addLogs()
	{
		$data = array();
		$ctl  = $_REQUEST['ctl'];
		$met  = $_REQUEST['met'];
		
		$met_array = array('add','edit','remove','update','memberImport');
		$flag = in_array($met,$met_array);

		if($flag)
		{
			$ctl = $_REQUEST['ctl'];
			$met = $_REQUEST['met'];
			$Menu_BaseModel = Menu_BaseModel::getInstance();
			$menu_rows = $Menu_BaseModel->findOne(array('menu_url_ctl'=>$ctl,'menu_url_met'=>$met));
			if (isset($menu_rows))
			{
				$rights_id   = $menu_rows['rights_id'];
				$log_content = $menu_rows['menu_name'];
			}
			if (Zero_Perm::checkLogin())
			{
				$user_row = Zero_Perm::getUserRow();
				$data['user_id']      = $user_row['user_id']; // 玩家Id
				$data['user_name'] = $user_row['user_account']; // 角色账户
			}
			
			$log_param = $_REQUEST;
			$log_url = Zero_Registry::get('url').'?mdu='.$log_param['mdu'].'&ctl='. $log_param['ctl'].'&met='.$log_param['met'].'&typ='.$log_param['typ'];
			unset($log_param['ctl']);
			unset($log_param['met']);
			unset($log_param['mdu']);
			unset($log_param['typ']);

			$data['store_id']  = Zero_Perm::getStoreId();
			$data['log_time']  = get_datetime();
			$data['action_id'] = $rights_id;  // 行为id == protocal_id -> rights_id
			$data['log_param'] = $log_param;  // 请求的参数
			$data['log_url']   = $log_url;    // 请求的网址
			$data['log_ip']    = get_ip();    //  获取IP地址
			$data['log_content'] = $log_content; //操作菜单
			$log_id         = $this->add($data, true);
		}
	}
}
?>
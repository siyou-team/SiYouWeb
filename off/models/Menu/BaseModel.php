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
class Menu_BaseModel extends Zero_Model
{
	public $_cacheName       = 'base';
	public $_tableName       = 'menu_base';
	public $_tablePrimaryKey = 'menu_id';
	public $_useCache        = false;

	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'menu_base_cond'=>array(
			'menu_enable'=>null,
			'menu_parent_id'=>null,
			'menu_role'=>null,
			'menu_type'=>null,
			'menu_id'=>null,
			'rights_id'=>null,
			'menu_url_ctl'=>null,
			'menu_url_met'=>null,
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



	/**
	 * 读取子类id
	 *
	 * @param  int $menu_parent_id 主键值
	 * @param  bools $recursive  是否递归查询
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getMenuChildId($menu_parent_id=0, $recursive=true)
	{
		$menu_data = array();

		if (is_array($menu_parent_id))
		{
			$cond_row = array('menu_parent_id:in'=>$menu_parent_id);
		}
		else
		{
			$cond_row = array('menu_parent_id'=>$menu_parent_id);
		}

		$menu_id_row  = $this->getKeyByMultiCond($cond_row);

		if ($recursive && $menu_id_row)
		{
			$rs = call_user_func_array(array($this, 'getMenuChildId'), array($menu_id_row, $recursive));

			$menu_id_row = array_merge($menu_id_row, $rs);
		}

		return $menu_id_row;
	}

	/**
	 * 读取分页列表, 自定义操作, 根据父类读取数据. 需要cache
	 *
	 * @param  int $menu_id 主键值
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getMenuTreeData($rights_ids = array(),$menu_parent_id=0, $recursive=true, $level=0)
	{
		$menu_data = array();
		$level++;
		
		$cond_row = array();
		if (is_array($menu_parent_id))
		{
			$cond_row['menu_parent_id:in'] = $menu_parent_id;
		}
		else
		{
			$cond_row['menu_parent_id'] = $menu_parent_id;
		}
		if(!empty($rights_ids))
		{
			$cond_row['rights_id:IN'] = $rights_ids;
		}
		$cond_row['menu_enable'] = 1; //启用的菜单
		
		$menu_rows = $this->find($cond_row, array('menu_order'=>'ASC'));

		//类似数据可以放到前端整理
		foreach ($menu_rows as $key => $menu_row)
		{
			$menu_row['menu_url'] = sprintf('%s?ctl=%s&met=%s&typ=e', Zero_Registry::get('url'), $menu_row['menu_url_ctl'], $menu_row['menu_url_met']);
			unset($menu_row['id']);
			unset($menu_row['menu_rel']);
			unset($menu_row['menu_label']);
			unset($menu_row['menu_order']);
			unset($menu_row['menu_time']);

			if ($recursive)
			{
				$rs = call_user_func_array(array($this, 'getMenuTreeData'), array($rights_ids,$menu_row['menu_id'], $recursive, $level));

				if ($rs)
				{
					$menu_row['children'] = $rs;
					//$menu_row['is_leaf']       = false;
				}
				else
				{
					//$menu_row['is_leaf']       = true;
				}
				$menu_data[$key] = $menu_row;
			}
			else
			{
				//$menu_row['is_leaf']       = true;
				$menu_data[$key] = $menu_row;
			}
		}

		return $menu_data;
	}
	
	/**
	 * 判断用户是否拥有访问权限-功能权限
	 *
	 * @return bool true/false
	 */
	public static function checkUserRights()
	{
		if (Zero_Perm::checkLogin())
		{			
			//读取当然用户信息
			$user_row = Zero_Perm::getUserRow();
			$rights_id = null;
			
			$ctl = $_REQUEST['ctl'];
			$met = $_REQUEST['met'];
			$Menu_BaseModel = Menu_BaseModel::getInstance();
			$menu_rows = $Menu_BaseModel->findOne(array('menu_url_ctl'=>$ctl,'menu_url_met'=>$met));

			if (isset($menu_rows))
			{
				$rights_id = $menu_rows['rights_id'];
			}
			
			//权限要求为false
			if (!$rights_id)
			{
				return true;
			}

			$rights_group_id = $user_row['rights_group_id'][0];
			
			$roleModel = Role_BaseModel::getInstance();
			$user_pos  = $roleModel->findOne(array('user_id'=>$user_row['user_id']));
			if(!empty($user_pos))
			{
				$rights_group_id = $user_pos['rights_group_id'];
			}
			
			$store_id = Zero_Perm::getStoreId();
			$store_data = Store_BaseModel::getInstance()->getOne($store_id);
			if(($rights_group_id && $rights_group_id != 1) || $store_data['user_id'] != $user_row['user_id'])
			{
				$Role_RightsGroupModel = Role_RightsGroupModel::getInstance();
				
				$rights = $Role_RightsGroupModel->getOne($rights_group_id);
				if($rights['rights_ids'])
				{
					$rights_ids = explode(',',$rights['rights_ids']);
				}else{
					$rights_ids = array(-1);
				}
				
				if (isset($rights_ids) && in_array($rights_id, $rights_ids))
				{
					return true;
				}
			}else{
				return true;
			}
		}
 
		return false;
	}
}
?>
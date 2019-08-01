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
class Base_MenuModel extends Zero_Model
{
	public $_cacheName       = 'base';
	public $_tableName       = 'base_menu';
	public $_tablePrimaryKey = 'menu_id';
	public $_useCache        = false;

	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'base_menu_cond'=>array(
			'menu_enable'=>null,
			'menu_role'=>null,
			'menu_type'=>null
		)
	);

	/**
	 * @param string $user  User Object
	 * @var   string $db_id 指定需要连接的数据库Id
	 * @return void
	 */
	public function __construct(&$db_id='shop_admin', &$user=null)
	{
		$this->_useCache  = false;
        
        $this->_tabelPrefix  = TABLE_SHOP_ADMIN_PREFIX;
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
	public function getMenuTreeData($menu_parent_id=0, $recursive=true, $level=0)
	{
		$menu_data = array();

		//
		$level++;

		if (is_array($menu_parent_id))
		{
			$cond_row = array('menu_parent_id:in'=>$menu_parent_id);
		}
		else
		{
			$cond_row = array('menu_parent_id'=>$menu_parent_id);
		}

		$menu_rows = $this->find($cond_row, array('menu_order'=>'ASC'));

		//类似数据可以放到前端整理
		foreach ($menu_rows as $key => $menu_row)
		{
			$menu_row['menu_url'] = sprintf('%s?ctl=%s&met=%s&typ=e', Zero_Registry::get('url'), $menu_row['menu_url_ctl'], $menu_row['menu_url_met']);
			unset($menu_row['id']);
			unset($menu_row['menu_rel']);
			unset($menu_row['menu_label']);
			//unset($menu_row['menu_url']);
			unset($menu_row['menu_order']);
			unset($menu_row['menu_time']);
			/*
			$menu_row['parent_id']   = $menu_row['menu_parent_id'];
			$menu_row['name']        = $menu_row['menu_name'];

			//for treegrid
			$menu_row['level']       = $level;
			$menu_row['menu_level']   = $level;

			$menu_row['menu_icon']   = 'ui-icon-star';


			$menu_row['expanded']     = true;
			$menu_row['loaded']       = true;
			*/
			if ($recursive)
			{
				$rs = call_user_func_array(array($this, 'getMenuTreeData'), array($menu_row['menu_id'], $recursive, $level));

				if ($rs)
				{
					$menu_row['sub'] = $rs;
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
}
?>

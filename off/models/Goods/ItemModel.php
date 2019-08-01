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
class Goods_ItemModel extends Zero_Model
{
	public $_cacheName       = 'item';
	public $_tableName       = 'goods_item';
	public $_tablePrimaryKey = 'goods_id';
	public $_useCache        = false;
	public $_languageCond    = true;
	
	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'goods_item_cond'=>array(
			'store_id'=>null,
			'chain_id'=>null,
			'user_id'=>null,
			'goods_id'=>null,
			'goods_code'=>null,
			'goods_min_rate'=>null,
			'goods_price'=>null,
			'goods_add_time'=>null,
			'goods_status'=>null,
			'synchro_item_id'=>null,
			'is_synchro'=>null,
			'language_code' => null,
			'goods_name'=>null
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
	
	//根据 goods_code 获取商品信息
	public function goodsCodeExist($goods_code = null)
	{
		$data = array();
		$column_data = array();
		$column_data['store_id']   = Zero_Perm::getStoreId();
		$column_data['chain_id']   = Zero_Perm::getChainId();
		$column_data['goods_code'] = $goods_code;
        $data = $this->findOne($column_data);
		
		return $data;
	}
}
?>
<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 *
 *
 * @category   Framework
 * @package    Model
 * @version    1.0
 * @todo
 */
class Goods_CheckModel extends Zero_Model
{
	public $_cacheName       = 'check';
	public $_tableName       = 'goods_check';
	public $_tablePrimaryKey = 'check_id';
	public $_useCache        = false;
 
	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'goods_check_cond'=>array(
			'store_id'=>null,
			'chain_id'=>null,
			'check_id'=>null
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
	
	//出入库订单
	public function addCheckOrder($type_code = 'CH',$type_id = 1)
	{
		$this->checkGoodsModel = Goods_CheckItemModel::getInstance();
        $check_id  = Number_SequeModel::getInstance()->createNextSeq(sprintf('%s-%s-', $type_code, date('Ymd')));
		$this->store_id = Zero_Perm::getStoreId();
		$this->chain_id = Zero_Perm::getChainId();
		
		$add_row = array();
		$add_row['check_id']          = $check_id;
		$add_row['store_id']          = $this->store_id;
		$add_row['chain_id']          = $this->chain_id;
		$add_row['overflow_quantity'] = i('overflow_quantity');
		$add_row['overflow_amount']   = f('overflow_amount');
		$add_row['loss_quantity']     = i('loss_quantity');
		$add_row['loss_amount']       = f('loss_amount');
		$add_row['check_remark']      = s('remark');
		$add_row['check_date']        = date('Y-m-d');
		$add_row['check_add_time']    = get_datetime();
		$add_row['check_type_id']     = $type_id;
		$user_row                     = Zero_Perm::getUserRow();
		$add_row['check_user_id']     = $user_row['user_id'];//操作Id
		$add_row['check_operator']    = $user_row['user_account'];//操作员
 
		$flag = $this->add($add_row);
		if($flag)
		{
			$this->stockModel = Goods_StockModel::getInstance();
			$checkGoods = r('checkGoods');
			
			//插入商品信息
			foreach($checkGoods as $k=>$v)
			{
				$goods_row = array();
				$goods_row['check_id']          = $check_id;
				$goods_row['goods_id']          = $v['goods_id'];
				$goods_row['goods_code']        = $v['goods_code'];
				$goods_row['goods_name']        = $v['goods_name'];
				$goods_row['goods_price']       = $v['goods_cost'];
				$goods_row['goods_quantity']    = $v['goods_quantity'];
				$goods_row['chain_id']          = $this->chain_id;
				$goods_row['store_id']          = $this->store_id;
				$goods_row['goods_add_time']    = get_datetime();
				$goods_row['check_type_id']     = $type_id;
				$goods_row['goods_pre_stock']   = $v['goods_pre_stock'];
				$goods_row['overflow_quantity'] = $v['overflow_quantity'];
				$goods_row['overflow_amount']   = $v['overflow_amount'];
				$goods_row['loss_quantity']     = $v['loss_quantity'];
				$goods_row['loss_amount']       = $v['loss_amount'];
 
				$flag = $this->checkGoodsModel->add($goods_row,true);
				if($flag)
				{
					//更新商品库存
					$goods_stock = $v['goods_quantity']; //盘点后库存
					$flag = $this->stockModel->updateStock($v['goods_id'],$goods_stock,false);
				}
			}
		}

		return $flag;
	}
}
?>
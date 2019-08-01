<?php
/**
 * Created by PhpStorm.
 * User: fangningning
 * Date: 2018/9/22
 * Time: 下午10:53
 */
class Order_GoodsModel extends Zero_Model
{
    public $_cacheName       = 'goods';
    public $_tableName       = 'order_goods';
    public $_tablePrimaryKey = 'order_goods_id';
    public $_useCache        = false;

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'order_goods_cond'=>array(
            'store_id'=>null,
			'chain_id'=>null,
            'order_id'=>null,
            'user_id'=>null,
			'order_id'=>null,
			'goods_status'=>null
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
}
?>
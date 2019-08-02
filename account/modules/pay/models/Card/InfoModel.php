<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 卡片信息模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2016-11-09, Xinze
 * @version    1.0
 * @todo
 */
class Card_InfoModel extends Zero_Model
{
	public $_cacheName       = 'card';
	public $_tableName       = 'card_info';
	public $_tablePrimaryKey = 'card_code';
	public $_useCache        = false;
	public $_languageCond    = false;
	
	public $fieldType = array();

	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'card_info_cond'=>array(
			'card_type_id' => null
		)
	);

	public $_validateRules = array('integer'=>array('card_id', 'card_media_id', 'server_id', 'user_id'), 'date'=>array('card_fetch_time', 'card_time'));

	public $_validateLabels= array();


	/**
	 * @param string $user  User Object
	 * @var   string $db_id 指定需要连接的数据库Id
	 * @return void
	 */
	public function __construct(&$db_id='pay', &$user=null)
	{
		$this->_useCache  = false;

		$this->_tabelPrefix  = TABLE_PAY_PREFIX;
		parent::__construct($db_id, $user);
	}

	/**
	 * 读取分页列表
	 *
	 * @param  array $column_row where查询条件
	 * @param  array $sort  排序条件order by
	 * @param  int $page 当前页码
	 * @param  int $rows 每页显示记录数
	 * @return array $data 返回的查询内容
	 * @access public
	 */
	public function getLists($column_row=array(), $sort=array(), $page=1, $rows=500)
	{
		//修改值 $column_row
		$sort['card_time'] = 'DESC';

		$data = $this->lists($column_row, $sort, $page, $rows);

		$card_type_id = array_column_unique($data['items'],'card_type_id');
		$card_type_row = Card_TypeModel::getInstance()->getOne($card_type_id);

		$media_id_row = array_column_unique($data['items'],'card_media_id');
		$card_media_row = Card_MediaModel::getInstance()->get($media_id_row);

		foreach($data['items'] as $k=>$item)
		{
			$data['items'][$k]['card_type_name'] = $card_type_row['card_type_name'];
			$data['items'][$k]['card_media_name'] = $card_media_row[$item['card_media_id']]['card_media_name'];

		}

		return $data;
	}
}


<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 支付渠道-可以用config取代模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2016-11-09, Xinze
 * @version    1.0
 * @todo
 */
class Payment_ChannelModel extends Zero_Model
{
	const ALIPAY = 1;
	const TENPAY = 2;
	const ALIPAY_WAP  = 3;
	const WECHAT_PAY = 4;
	const CASH = 5;
	public static $configRows = array();
	public $_cacheName       = 'base';
	public $_tableName       = 'payment_channel';
	public $_tablePrimaryKey = 'payment_channel_id';
	public $_useCache        = false;
	public $_languageCond    = false;
	
	public $fieldType = array('payment_channel_config'=>'JSON');
	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'payment_channel_cond'=>array(
			'payment_channel_code' => null,
			'payment_channel_enable' => null,
            'payment_type_id' => null,
            'chain_id' => null,
            'store_id' => null
		)
	);
	public $_validateRules = array('integer'=>array('payment_channel_id', 'payment_channel_status', 'payment_channel_wechat', 'payment_channel_enable'), 'array'=>array('payment_channel_config'));
	public $_validateLabels= array();

	/**
	 * @param string $user  User Object
	 * @var   string $db_id 指定需要连接的数据库Id
	 * @return void
	 */
	public function __construct(&$db_id='pay', &$user=null)
	{
		$this->_useCache  = CHE;

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
		$data = $this->lists($column_row, $sort, $page, $rows);

		return $data;
	}

    
	/**
	 * 此处可以先这样, 可以考虑生成PHP配置文件或者Cache
	 *
	 * @param  int $payment_channel_code 支付渠道code
	 * @return array $rows 返回的查询内容
	 * @access public
	 */
	public function getChannelConfig($payment_channel_code, $store_id=0, $chain_id=0)
	{
	    $key = sprintf('%s-%s-%s', $payment_channel_code, $store_id, $chain_id);
	    
		$config_row = array();

		if (isset(self::$configRows[$key]))
		{
			$config_row = self::$configRows[$key];
		}
		else
		{
			$Payment_ChannelModel = new Payment_ChannelModel();
			$data_row                 = $Payment_ChannelModel->findOne(array('payment_channel_code' => $payment_channel_code, 'store_id' => $store_id, 'chain_id' => $chain_id));

			if ($data_row)
			{
				$config_row = $data_row['payment_channel_config'];
                $config_row['payment_channel_id'] = $data_row['payment_channel_id'];
                $config_row['payment_channel_code'] = $data_row['payment_channel_code'];

				self::$configRows[$key] = $config_row;
			}
		}

		return $config_row;
	}
	
	public static function fixChannelName($rows)
    {
        $payment_channel_ids = array_column_unique($rows, 'payment_channel_id');
        
        if ($payment_channel_ids)
        {
            $payment_channel_rows = Payment_ChannelModel::getInstance()->get($payment_channel_ids);
    
    
            foreach ($rows as $id=>$row)
            {
                $rows[$id]['payment_channel_name'] = $payment_channel_rows[$row['payment_channel_id']]['payment_channel_name'];
            }
        }
        
        return $rows;
    }
}


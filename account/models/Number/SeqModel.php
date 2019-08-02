<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 *
 *
 *  CREATE TABLE `table_prefix_number_seq` (
 *		`prefix` varchar(20) NOT NULL DEFAULT '' COMMENT '前缀',
 *		`number` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '增长值',
 *		PRIMARY KEY (`prefix`),
 *		UNIQUE KEY `prefix` (`prefix`) COMMENT '(null)'
 *	) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='Id管理表';
 *
 *
 *
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <xinze@live.cn>
 * @copyright  Copyright (c) 2010, 黄新泽
 * @version    1.0
 * @todo
 */
class Number_SeqModel extends Zero_Model
{
	public $_cacheName       = 'base';
	public $_tableName       = 'number_seq';
	public $_tablePrimaryKey = 'prefix';
	public $_useCache        = false;
	public $_languageCond    = false;
	
	/**
	 *  默认key = $this->_tableName . '_cond'
	 * @access public
	 */
	public $_multiCond = array(
		'number_seq_cond'=>array(
		)
	);

	/**
	 * @param string $user  User Object
	 * @var   string $db_id 指定需要连接的数据库Id
	 * @return void
	 */
	public function __construct(&$db_id='account', &$user=null)
	{
		$this->_useCache  = false;
		parent::__construct($db_id, $user);
	}

	/**
     * 根据主键值，从数据库读取当前Number
	 *
     * @param int $prefix
     * @param int $pad_length
     * @return string $number_str 下一个序列号
	 * @access public
	 */
    public function getSeq($prefix, $next_flag=false, $pad_length=4, $prefix_flag=true)
    {
        $rows = array();
        $rows = $this->get($prefix);

        $number = 0;

        if (!$rows)
        {
            $number = 1;

            //set index = 1
            $data['prefix'] = $prefix ; // 前缀
            $data['number'] = $number ;

            $add_flag = $this->add($data);

            if (!$add_flag)
            {
                $number = 0;
            }
        }
        else
        {
            $number = $rows[$prefix]['number'];

			if ($next_flag)
			{
				$number = $number + 1;
			}
        }


        $number_str = '';

        if ($number)
        {
			if ($prefix_flag)
			{
				$number_str = $prefix . str_pad($number, $pad_length, 0 ,STR_PAD_LEFT);
			}
			else
			{
				$number_str = $number;
			}
        }
        else
        {
            $number_str = false;
        }

        return $number_str;
    }


    /**
     * 得到下一个Id
     * @param int $prefix
     * @param int $pad_length
     * @return string $number_str 下一个序列号
     * @access public
     */
    public function createNextSeq($prefix, $pad_length=4, $prefix_flag=true)
    {
		$this->edit($prefix, array('number'=>1), true);
		$number = $this->getSeq($prefix, false, $pad_length, $prefix_flag);

        return $number;
    }

	/**
	 * 得到下一个Id
	 * @param int $prefix
	 * @param int $pad_length
	 * @return string $number_str 下一个序列号
	 * @access public
	 */
	public function getNextSeq($prefix, $pad_length=4, $prefix_flag=true)
	{
		$number = $this->getSeq($prefix, true, $pad_length, $prefix_flag);

		return $number;
	}
}
?>
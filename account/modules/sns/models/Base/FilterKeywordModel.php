<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 敏感词过滤-启用api模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2016-10-15, Xinze
 * @version    1.0
 * @todo
 */
class Base_FilterKeywordModel extends Zero_Model
{
    public $_cacheName       = 'base';
    public $_tableName       = 'base_filter_keyword';
    public $_tablePrimaryKey = 'filter_id';
    public $_useCache        = false;
    public $_useListCache    = false;
    public $_languageCond    = false;
    
    public $fieldType = array();

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'base_filter_keyword_cond'=>array(
        )
    );

    public $_validateRules = array('integer'=>array('filter_id', 'filter_type', 'filter_buildin', 'user_id', 'filter_enable'), 'date'=>array('filter_time'));

    public $_validateLabels= array();


    /**
     * @param string $user  User Object
     * @var   string $db_id 指定需要连接的数据库Id
     * @return void
     */
    public function __construct(&$db_id='sns', &$user=null)
    {
        $this->_useCache  = CHE;

        $this->_tabelPrefix  = TABLE_SNS_PREFIX;
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


	public function getFilterRule()
	{
		//初始化
		$filter_rows = $this->getLists(array(), array(), 1, 100000);

		$filter_rule_rows = array();
		$filter_rule_rows['filter']['find'] = array();
		$filter_rule_rows['filter']['replace'] = array();
		$filter_rule_rows['banned'] = array();

		foreach ($filter_rows['items'] as $key => $filter_row)
		{
			if ('' !== $filter_row['filter_find'])
			{
				if ('' !== $filter_row['filter_replace'])
				{
					$filter_rule_rows['filter']['find'][] = sprintf('/%s/i', addslashes($filter_row['filter_find']));
					$filter_rule_rows['filter']['replace'][] = addslashes($filter_row['filter_replace']);
				}
				else
				{
					$filter_rule_rows['banned'][] = addslashes($filter_row['filter_find']);
				}
			}
		}

		$filter_rule_rows['banned'] = sprintf('/(%s)/i', $filter_rule_rows['banned'] ? implode('|', $filter_rule_rows['banned']) : '挨了一炮');


		//init file
		$file = INI_PATH . '/filter.ini.php';

		if (!Zero_Utils_File::generatePhpFile($file, array('_CACHE["word_filter"]'=>$filter_rule_rows)))
		{
		}

		return $filter_rule_rows;
	}
}
?>

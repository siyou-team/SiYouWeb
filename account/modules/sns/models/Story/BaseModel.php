<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 动态信息模型
 *
 * @category   Framework
 * @package    Model
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-09-25, Xinze
 * @version    1.0
 * @todo
 */
class Story_BaseModel extends Zero_Model
{
    public $_cacheName       = 'story';
    public $_tableName       = 'story_base';
    public $_tablePrimaryKey = 'story_id';
    public $_useCache        = false;
    public $_useListCache    = false;
    public $_languageCond    = false;
    
    public $fieldType = array('story_content'=>'HTML', 'story_file'=>'DOT');

    /**
     *  默认key = $this->_tableName . '_cond'
     * @access public
     */
    public $_multiCond = array(
        'story_base_cond'=>array(
            'user_id' => null
        )
    );

    public $_validateRules = array('integer'=>array('story_id', 'user_id', 'story_type', 'story_src_id', 'story_time', 'story_status', 'story_enable', 'story_privacy', 'story_comment_count', 'story_forward_count', 'story_like_count', 'story_collection_count', 'story_forward'), 'array'=>array('story_file'));

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
}


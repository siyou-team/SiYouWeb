<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Setting_LogCtl extends AdminController
{
	public $store_id = null;
	public $logModel = null;

    /**
     * Constructor
     *
     * @param  string $ctl 控制器目录
     * @param  string $met 控制器方法
     * @param  string $typ 返回数据类型
     * @access public
     */
    public function __construct(&$ctl, $met, $typ)
    {
        parent::__construct($ctl, $met, $typ);
		
		$this->store_id = Zero_Perm::getStoreId();
		$this->logModel = Shop_OperationLogModel::getInstance();
    }
	
	
    /**
     * 首页
     * 
     * @access public
     */
    public function index()
    {		
		$this->render('default',$data);
    }
	
	//列表
	public function lists()
	{
		$page = i('PageIndex', 1);  //当前页码
        $rows = i('PageSize', 10); //每页记录条数
        $sort = array();
		
		$column_data = array();
		$column_data['store_id'] = $this->store_id;
		$data = $this->logModel->getLists($column_data, $sort, $page, $rows);

		$this->render('default',$data);
	}
}
?>
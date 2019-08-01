<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Goods_CheckCtl extends AdminController
{
    public $store_id = null;
	public $chain_id = null;
	public $checkModel  = null;
	public $checkGoodsModel = null;

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

		$this->checkModel  = Goods_CheckModel::getInstance();
		$this->checkGoodsModel = Goods_CheckItemModel::getInstance();
        $this->store_id = Zero_Perm::$storeId;
		$this->chain_id = Zero_Perm::getChainId();
    }
	
	
    //首页
    public function index()
    {
		$this->render('default');
    }
	
	//添加库存盘点记录
	public function add()
	{
		$this->checkModel->sql->startTransactionDb();
		$flag = $this->checkModel->addCheckOrder('CH',1);
		
		if ($flag !== false && $this->checkModel->sql->commitDb())
        {
            $msg = __('操作成功');
            $status = 200;
        }
        else
        {
            $this->checkModel->sql->rollBackDb();
            $msg = __('操作失败');
            $status = 250;
        }
		
		$data = array();
        $this->render('default',$data,$msg,$status);
	}
}
?>
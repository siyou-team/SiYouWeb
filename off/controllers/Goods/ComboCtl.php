<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author    windfnn
 */
class Goods_ComboCtl extends AdminController
{
    public $store_id = null;
	public $chain_id = null;
	
	public $goodsComboModel = null;

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

		$this->goodsComboModel = Goods_ComboModel::getInstance();

		$this->store_id = Zero_Perm::$storeId;
		$this->chain_id = Zero_Perm::getChainId();
    }
	
	
    //首页
    public function index()
    {
		$this->render('default');
    }
 
	//编辑页面
    public function comboManage()
    {
        $data = array();
		
		if(i('typ') == 'json')
		{
			$combo_id = i('combo_id');
			$data = $this->goodsComboModel->getOne($combo_id);
		}
		
        $this->render('default',$data);
    }

	//列表数据
    public function lists()
    {
        $page = i('pageIndex', 1);  //当前页码
        $rows = i('pageRows', 20);  //每页记录条数
        $sort = array('combo_add_time'=>'DESC');

        $data = array('items'=>array());
        $column_data = array();
		$column_data['store_id'] = $this->store_id;
		$column_data['chain_id'] = $this->chain_id;
		
        if(s('combo_code'))
        {
            $column_data['combo_code:LIKE'] = '%'.s('combo_code').'%';
        }

        $data = $this->goodsComboModel->getLists($column_data, $sort, $page, $rows);

        $this->render('default',$data);
    }

    public function addCombo()
    {
		$data['combo_code'] 		= s('combo_code');  //编号
		$column_data = array();
		$column_data['store_id'] = $this->store_id;
		$column_data['chain_id'] = $this->chain_id;
		$column_data['combo_code'] = $data['combo_code'];
        $combo = $this->goodsComboModel->findOne($column_data);
		
		if(empty($combo))
        {
			$data['combo_name'] 		= s('combo_name');	//名称
			$data['combo_cat_id'] 		= i('combo_cat_id');//分类
			$data['combo_price'] 		= f('combo_price');	//价格	
			$data['combo_is_discount'] 	= i('combo_is_discount');	//打折
			$data['combo_min_discount'] = f('combo_min_discount');	//折扣
			$data['combo_is_points'] 	= i('combo_is_points');	//积分
			$data['combo_points_amount']= i('combo_points_amount');	//积分
			$data['combo_detail'] 		= s('combo_detail');//详细
			$data['combo_remark'] 		= s('combo_remark');//备注
			$data['combo_image']        = s('combo_image');	//图片
			$data['store_id'] 			= $this->store_id;	//店铺id
			$data['chain_id'] 			= $this->chain_id;	//门店id
			$data['user_id'] 			= Zero_Perm::getUserId();	//用户id
			$data['combo_add_time'] 	= get_datetime();	//时间
			$data['combo_goods_number'] = i('goods_number');
			$data['combo_cost'] = $this->goodsComboModel->getCost(s('combo_detail'));
			
			$flag = $this->goodsComboModel->add($data);
			if($flag)
			{
				$msg    = __('添加成功');
				$status = 200;
			}
			else
			{
				$msg    = __('添加失败');
				$status = 250;

			}
		}else{
			$msg = '商品编号已经存在！';
            $status = 250;
		}

        $this->render('default',$data);
    }

    public function editCombo()
    {
		$combo_id = i('combo_id');
		$data['combo_code'] 		= s('combo_code');	//编号
		$column_data = array();
		$column_data['store_id'] = $this->store_id;
		$column_data['chain_id'] = $this->chain_id;
		$column_data['combo_code'] = $data['combo_code'];
        $combo = $this->goodsComboModel->findOne($column_data);
		
		//修改的商品编号不存在，或者修改的是当前商品
		if(empty($combo) || $combo['combo_id'] ==  $combo_id)
        {
			$data['combo_name'] 		= s('combo_name');	//名称
			$data['combo_cat_id'] 		= i('combo_cat_id'); //分类
			$data['combo_price'] 		= f('combo_price');	//价格
			$data['combo_is_discount'] 	= i('combo_is_discount');	//打折
			$data['combo_min_discount'] = f('combo_min_discount');	//折扣
			$data['combo_is_points'] 	= i('combo_is_points');	//积分
			$data['combo_points_amount']= i('combo_points_amount');	//积分
			$data['combo_detail'] 		= s('combo_detail');//规格
			$data['combo_remark'] 		= s('combo_remark');//备注
			$data['combo_image']        = s('combo_image');	//图片
			$data['combo_goods_number'] = i('goods_number');
			$data['combo_cost'] = $this->goodsComboModel->getCost(s('combo_detail'));
 
			$flag = $this->goodsComboModel->edit($combo_id,$data);
			if($flag)
			{
				$msg    = __('添加成功');
				$status = 200;
			}
			else
			{
				$msg    = __('添加失败');
				$status = 250;

			}
		}else{
			$msg = '商品编号已经存在！';
            $status = 250;
		}

        $this->render('default',$data);
    }
	
	public function remove()
	{
		$combo_id = id('combo_id');
        $data = $this->goodsComboModel->getOne($combo_id);
        
		if ($data && $data['store_id'] == $this->store_id && $data['chain_id'] == $this->chain_id)
        {
            $flag = $this->goodsComboModel->remove($combo_id);

            if ($flag !== false)
            {
                $msg = __('操作成功');
                $status = 200;
            }
            else
            {
                $msg = __('操作失败');
                $status = 250;
            }
        }
        else
        {
            $msg = __('操作失败');
            $status = 250;
        }
 
        $this->render('default', $data, $msg, $status);
	}
}
?>
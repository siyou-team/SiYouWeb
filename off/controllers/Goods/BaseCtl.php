<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Goods_BaseCtl extends Zero_Api_AdminController
{
	public $goodsItemModel  = null;
 
	public $store_id = null;
	public $chain_id = null;

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

		$this->goodsItemModel  = Goods_ItemModel::getInstance();

		if (Zero_Perm::checkLogin())
        {
            $user_row = Zero_Perm::getUserRow();
			$roleModel = Role_BaseModel::getInstance();
			$user_pos  = $roleModel->findOne(array('user_id'=>$user_row['user_id']));
            if (!$user_pos['user_is_pos'] && !$user_row['store_ids'] && !$user_row['chain_ids'] && !$user_pos['store_id'])
            {
                throw new Exception(__('无管理中心访问权限'));
            }
            else
            {
				Zero_Perm::$storeId = Zero_Perm::getStoreId();
				if(!Zero_Perm::$storeId)
				{
					Zero_Perm::$storeId = $user_pos['store_id'];
				}
				$flag = Menu_BaseModel::checkUserRights();
                if (!$flag)
                {
                    throw new Exception(__('无操作权限'));
					die;
                }
            }
			
			$this->store_id = Zero_Perm::$storeId;
			$this->chain_id = Zero_Perm::getChainId();
        }
        else
        {
            throw new Exception(__('无访问权限, 请先登录系统'));
        }
    }
	
	
    //商品列表首页
    public function index()
    {
		$this->render('default');
    }

    //商品信息页面
    public function manage()
    {
		$data = array();
		
		if(i('typ') == 'json')
		{
			$goods_id = i('goods_id');
			$data = $this->goodsItemModel->getOne($goods_id);
		}
			
        $this->render('default',$data);
    }
 
    //获取列表数据
    public function lists()
    {
        $page = i('pageIndex', 1);  //当前页码
        $rows = i('pageRows', 10);  //每页记录条数
        $sort = array('goods_add_time'=>'DESC');

        $data = array('items'=>array());
        $column_data = array();
		$column_data['store_id'] = $this->store_id;
		$column_data['chain_id'] = $this->chain_id;
 
		if($goods_code = s('goodsCode')){
			$goods_data = $this->goodsItemModel->findOne(array('goods_code'=>$goods_code));
			if(!empty($goods_data)){
				$column_data['goods_id'] =  $goods_data['goods_id'];
			}else{
				$column_data['goods_name:LIKE'] = '%'.$goods_code.'%';
			}
		}
 
		if($goods_status = s('goods_status')){
			$column_data['goods_status'] = $goods_status;
		}
		
		if(i('goods_source')){
			$column_data['is_synchro'] = i('goods_source') - 1;
		}
 
		//发布时间
		if($btime = s('begin_time')){
			$column_data['goods_add_time:>='] = $btime;
		}
		if($etime = s('end_time')){
			$column_data['goods_add_time:<='] = $etime;
		}
 
		//零售价
		if($goods_price = f('price')){
			$column_data['goods_price:>='] = $goods_price;
		}
		if($goods_price_end = f('price_end')){
			$column_data['goods_price:<='] = $goods_price_end;
		}
		
		//折扣率
		if($min_discount = f('discount')){
			$column_data['goods_min_rate:>='] = $min_discount;
		}
		if($min_discount_end = f('discount_end')){
			$column_data['goods_min_rate:<='] = $min_discount_end;
		}
 
		$this->stockModel = Goods_StockModel::getInstance();
		$data = $this->stockModel->getGoodsLists($column_data, $sort, $page, $rows);
        $this->render('default', $data);
    }

	//新增商品
    public function add()
    {
		//获取编号商品，判断编号是否存在
        $data['goods_code'] = s('goods_code');
        $goods_base = $this->goodsItemModel->goodsCodeExist($data['goods_code']);

        if(empty($goods_base))
        {
			$this->goodsItemModel->sql->startTransactionDb();
            $data['goods_name'] = s('goods_name');//名称
            $data['goods_cat_id'] = i('goods_cat_id');//分类ID
            $data['goods_spec'] = s('goods_spec');//规格
            $data['goods_cost'] = f('goods_cost');//进价
            $data['goods_unit'] = s('goods_unit');//单位
            $data['goods_price'] = f('goods_price');//价格
            $data['goods_vip_price'] = f('goods_vip_price'); //vip价格
            $data['goods_is_discount'] = i('goods_is_discount');//是否打折
            $data['goods_min_rate'] = f('goods_min_rate'); //最低折扣
            $data['goods_remark'] = s('goods_remark');     //备注
            $data['store_id'] = $this->store_id;           //店铺id
            $data['chain_id'] = Zero_Perm::getChainId();   //门店id
            $data['user_id'] = Zero_Perm::getUserId();     //用户id
            $data['goods_is_points'] = i('goods_is_points'); //是否积分
            $data['goods_points_type'] = f('goods_points_type');    //积分形式
            $data['goods_image'] = s('goods_image');    //图片
            $data['goods_add_time'] = get_datetime();    //添加时间
			$data['goods_tax_rate'] = f('goods_tax_rate'); //商品税率
            $data['need_asyn'] = 1;
            $data['need_action'] = 'add';
            $flag = $this->goodsItemModel->add($data,true);
			$data['goods_id'] = $flag;
			$data['goods_stock'] = i('goods_stock',0);
            if($flag !== false) 
			{
                $msg = __('添加成功');
                $status = 200;
				
				$supplier_id = i('supplier_id',0);
				if($supplier_id && $data['goods_stock'])
				{
					//增加产品入库信息
					$inventoryModel = Goods_InventoryModel::getInstance();
					$row['inventory_number'] = $data['goods_stock'];
					$row['inventory_amount'] = $data['goods_stock']*$data['goods_cost'];
					$row['supplier_id'] = $supplier_id;
					$row['remark'] = '添加商品，自动入库';
					$row['in_chain_id'] = 0;
					$goods[] = $data;
	 
					$flag = $inventoryModel->addInventory('IN',1,$row,$goods);
				}
            } 
			
			if ($flag !== false && $this->goodsItemModel->sql->commitDb())
			{
				$msg = __('操作成功');
				$status = 200;
			}
			else
			{
				$this->goodsItemModel->sql->rollBackDb();
				$msg = __('操作失败');
				$status = 250;
			}
        }else{
            $msg = '商品编号已经存在！';
            $status = 250;
        }

        $this->render('default',$data,$msg,$status);
    }

	//修改商品信息
    public function edit()
    {
        $goods_id = i('goods_id');
		$data['goods_code'] 		= s('goods_code');	//编号
		$goods_base = $this->goodsItemModel->goodsCodeExist($data['goods_code']);
		
		//修改的商品编号不存在，或者修改的是当前商品
		if(empty($goods_base) || $goods_base['goods_id'] ==  $goods_id)
        {
			$data['goods_name'] = s('goods_name');
			$data['goods_cat_id'] = i('goods_cat_id');
			$data['goods_spec'] = s('goods_spec');
			$data['goods_cost'] = f('goods_cost');      
			$data['goods_unit'] = s('goods_unit');
			$data['goods_price'] = f('goods_price');
			$data['goods_vip_price'] = f('goods_vip_price');
			$data['goods_is_discount'] = i('goods_is_discount');
			$data['goods_min_rate'] = f('goods_min_rate');
			$data['goods_remark'] = s('goods_remark');
			$data['goods_is_points'] = i('goods_is_points');
			$data['goods_points_type'] = f('goods_points_type');
			$data['goods_image'] = s('goods_image');
			$data['goods_tax_rate'] = f('goods_tax_rate');
            $data['need_asyn'] = 1;
            $data['need_action'] = 'modify';
			$flag = $this->goodsItemModel->edit($goods_id,$data);
			if($flag !== false)
			{
				$msg    = __('修改成功');
				$status = 200;
			}
			else
			{
				$msg    = __('修改失败');
				$status = 250;

			}
		}else{
            $msg = '商品编号已经存在！';
            $status = 250;
        }

        $this->render('default',$data,$msg,$status);
    }

	//删除商品
    public function remove()
    {
        $goods_id = i('goods_id');
        $goods_base = $this->goodsItemModel->getOne($goods_id);
        
		if ($goods_base && $goods_base['store_id'] == $this->store_id && $goods_base['chain_id'] == $this->chain_id)
        {
            $flag = $this->goodsItemModel->remove($goods_id);
            if ($flag !== false)
            {
                $msg = __('操作成功');
                $status = 200;
				
				//删除库存数据
				$stockModel = Goods_StockModel::getInstance();
				$column_row['store_id'] = $this->store_id;
				$column_row['chain_id'] = $this->chain_id;
				$column_row['goods_id'] = $goods_id;
				$stock_data = $stockModel->findOne($column_row);
				$stockModel->remove($stock_data['stock_id']);
            }
            else
            {
                $msg = __('操作失败');
                $status = 250;
            }
        }else{

            $msg = __('商品不存在');
            $status = 250;
        }

		$data['goods_id'] = $goods_id;
        $this->render('default', $data, $msg, $status);
    }

    public function editStatus()
    {
        $goods_id = i('goods_id');
        $goods_status = i('goods_status');
        $goods_base = $this->goodsItemModel->getOne($goods_id);
        
		if ($goods_base && $goods_base['store_id'] == $this->store_id && $goods_base['chain_id'] == $this->chain_id)
        {
            $flag = $this->goodsItemModel->edit($goods_id,array('goods_status'=>$goods_status));
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
        }else{

            $msg = __('商品不存在');
            $status = 250;
        }

		$data['goods_id'] = $goods_id;
        $this->render('default', $data, $msg, $status);
    }
	
	public function goodsTopInfo()
	{
		$this->stockModel = Goods_StockModel::getInstance();
		
		//通用条件
		$language_code = Lang::range();
		$column_data['store_id'] = $this->store_id;
		$column_data['chain_id'] = $this->chain_id;
		//$column_data['language_code'] = $language_code;
		
		//产品总数
		$total = $this->goodsItemModel->getNum($column_data); 
		
		//库存商品低于10件的商品总数
		$goods_cond = array();
		$goods_cond = $column_data;
		$goods_cond['goods_stock:>'] = 10;
		$low_num = $this->stockModel->getNum($goods_cond); 
		$low_num = $total - $low_num;
		
		//正常出售的商品
		$goods_status_con = array();
		$goods_status_con = $column_data;
		$goods_status_con['goods_status'] = 1;
		$normal = $this->goodsItemModel->getNum($goods_status_con); 
		
		//停止销售的商品
		$goods_stop_con = array();
		$goods_stop_con = $column_data;
		$goods_stop_con['goods_status'] = 2;
		$stop_num = $this->goodsItemModel->getNum($goods_stop_con); 
		
		//库存预警商品
		$goods_warn_con = array();
		$goods_warn_con = $column_data;
		$goods_warn_con['goods_stock:>'] = 5;
		$warn_num = $this->stockModel->getNum($goods_warn_con); 
		$warn_num = $total - $warn_num;
		
		//近七日销售前三的商品
		$top3 = $this->goodsItemModel->lists(array('store_id'=>$this->store_id,'chain_id'=>$this->chain_id), array('goods_sales'=>'DESC'), 1, 3);
		
		//库存成本价格
		$cost_total = $this->goodsItemModel->getSumOne('goods_cost', $column_data);
		
		$data['total'] = $total;
		$data['low_num'] = $low_num;
		$data['top3'] = $top3['items'];
		$data['normal'] = $normal;
		$data['stop_num'] = $stop_num;
		$data['warn_num'] = $warn_num;
		$data['cost_total'] = $cost_total;
		
		$this->render('default',$data);
	}
	
	//同步线上店铺产品
	public function synchroGoods()
	{
		//获取所有的店铺产品
		$data = $this->getUrl('Product_Item', 'lists',array('store_id'=>$this->store_id));
		$store_goods = $data['data']['items'];
		
		$i = 0;
		foreach($store_goods as $k=>$v)
		{
			//商品是否已同步
			$goods = $this->goodsItemModel->findOne(array('synchro_item_id'=>$v['item_id'],'is_synchro'=>1)); 
 
			if(empty($goods))
			{
				$data = array();
				$item_barcode = $v['item_barcode']?$v['item_barcode']:date('YmdHis').$i; //商品条码
				$data['goods_code'] = $item_barcode;  //编号
				
				//判断条码是否存在
				$goods_base = $this->goodsItemModel->goodsCodeExist($data['goods_code']);
				
				if(empty($goods_base) && $v['item_enable'] == 1001)
				{
					$data['goods_name'] = $v['item_name'];    //商品名称
					$data['goods_cat_id'] = $v['category_id'];    //分类名称
					$data['goods_spec'] = $v['item_spec_name'];    //规格
					$data['goods_cost'] = $v['item_cost_price'];    //进价
					$data['goods_unit'] = '';    //单位
					$data['goods_price'] = $v['item_unit_price']; //销售价格
					$data['goods_vip_price'] = 0;    //vip价格
					$data['goods_is_discount'] = 0;    //是否打折				
					$data['store_id'] = $this->store_id;    //店铺id
					$data['chain_id'] = $this->chain_id;    //门店id
					$data['user_id'] = Zero_Perm::getUserId();    //用户id
					$data['goods_image'] = $v['product_image'];    //图片
					$data['goods_add_time'] = get_datetime();    //时间
					$data['is_synchro'] = 1;
					$data['synchro_item_id'] = $v['item_id'];
					$data['goods_status'] = i('goods_status');
					
					$flag = $this->goodsItemModel->add($data);
					if($flag){$i++;}
				}
			}
			
		}
		
		$status = 200;
		$data = array();
		$msg = __('成功同步').$i.' 件 商品';
		$this->render('default',$data,$msg,$status);
	}
}
?>
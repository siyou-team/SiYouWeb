<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class IndexCtl extends Zero_Api_AdminController
{
    public function __construct(&$ctl, $met, $typ)
    {
        //本地读取远程信息
        $this->key = Base_ConfigModel::getConfig('shop_app_key');
        $this->url = Base_ConfigModel::getConfig('shop_app_url');
        $this->appId = Base_ConfigModel::getConfig('shop_app_id');
        
        parent::__construct($ctl, $met, $typ);
        
		$user_row = Zero_Perm::getUserRow();
		if(empty($user_row))
		{
			location_to(Zero_Registry::get('index_page').'?ctl=Login&met=login');
		}else{		
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
			}
			else
			{
				throw new Exception(__('无访问权限, 请先登录系统'));
			}
		}
    }
    
	//首页
	public function index()
	{ 
		$user_row = Zero_Perm::getUserRow();    
        if (array_filter($user_row['store_ids']))
        {
            //读取店铺信息，不应该直接读取
            $store_id = Zero_Perm::getStoreId();
            $_POST['store_id'] = $store_id;
            $store_data = $this->getUrl('Store_Base', 'get', null);
            $rows['store'] = $store_data['data'];
        }
        
        if ($chain_id = Zero_Perm::getChainId())
        {
			//读取门店信息
			$Chain_InfoModel = Chain_InfoModel::getInstance();
            $chain_data = $Chain_InfoModel->getOne($chain_id);
            $rows['chain'] = $chain_data;
        }
        
		//获取左侧菜单
		$Menu_BaseModel = Menu_BaseModel::getInstance();
		$rights_group_id = $user_row['rights_group_id'][0];
		
		$roleModel = Role_BaseModel::getInstance();
		$user_pos  = $roleModel->findOne(array('user_id'=>$user_row['user_id']));
		if(!empty($user_pos))
		{
			$rights_group_id = $user_pos['rights_group_id'];
		}
		
		if($rights_group_id != 1 || $store_data['data']['user_id'] != $user_row['user_id'])
		{			
			$Role_RightsGroupModel = Role_RightsGroupModel::getInstance();
			
			$rights = $Role_RightsGroupModel->getOne($rights_group_id);
			if($rights['rights_ids'])
			{
				$rights_ids = explode(',',$rights['rights_ids']);
			}else{
				$rights_ids = array(-1);
			}
			
			$menu_rows = $Menu_BaseModel->getMenuTreeData($rights_ids);
		}else{
			$menu_rows = $Menu_BaseModel->getMenuTreeData();
		}
 
		$rows['menu_rows'] = $menu_rows;
        $rows['user_row'] = $user_row;
       
		$this->render('Index', $rows);
	}

	//首页-统计数据
    public function dashboard()
    {
        $data = array();
		$store_id = Zero_Perm::getStoreId();
		$chain_id = Zero_Perm::getChainId();
		
		//获取产品总数
		$language_code = Lang::range();
		$this->stockModel = Goods_StockModel::getInstance();
		$this->goodsItemModel = Goods_ItemModel::getInstance();
		
		$column_data['store_id']      = $store_id;
		//$column_data['language_code'] = $language_code;
		$column_data['chain_id']      = $chain_id;
		$goods_total = $this->goodsItemModel->getNum($column_data);
		$data['goods_total']  = $goods_total?$goods_total:0;
		
		//获取会员总数
		$memberModel = Member_BaseModel::getInstance();
		$member_total = $memberModel->getNum(array('store_id'=>$store_id,'chain_id'=>$chain_id));
		$data['member_total'] = $member_total?$member_total:0;
		
		//获取消费总额
		$this->orderReportModel = Order_ReportModel::getInstance();
		//获取本月时间段
		$month = $this->orderReportModel->getMonthRange(date('Y-m'));
		$begin_time = $month[0];
		$end_time = $month[1];
		$order_data = $this->orderReportModel->getTimeConsumption($store_id,$begin_time,$end_time,0,0);
		$data['total_money'] = $order_data['totalMoney']?$order_data['totalMoney']:0;
		$data['total_cost'] = $order_data['totalCost']?$order_data['totalCost']:0;
		$data['profit'] = $data['total_money'] - $data['total_cost'];
	
        $this->render('default', $data);
    }
	
	//获取用户角色权限
	public function auth()
	{
		$data = array();
		if (Zero_Perm::checkLogin())
		{
			$user_row  = Zero_Perm::getUserRow();
			$roleModel = Role_BaseModel::getInstance();
			$user_pos  = $roleModel->findOne(array('user_id'=>$user_row['user_id']));
			if(!empty($user_pos))
			{
				$rights_group_id = $user_pos['rights_group_id'];
			}
			
			$Role_RightsGroupModel = Role_RightsGroupModel::getInstance();
				
			$rights = $Role_RightsGroupModel->getOne($rights_group_id);
			if($rights['rights_ids'])
			{
				$rights_ids = explode(',',$rights['rights_ids']);
			}else{
				$rights_ids = array(-1);
			}
			
			$rightsModel = Role_RightsModel::getInstance();
			$data = $rightsModel->find(array('rights_id:IN'=>$rights_ids));
			$data = array_values($data);
		}
		
		$this->render('default',$data);
	}
}
?>
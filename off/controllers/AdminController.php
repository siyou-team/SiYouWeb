<?php if (!defined('ROOT_PATH')){exit('No Permission');}
/**
 * @author     Xinze <xinze@live.cn>
 */
class AdminController extends Zero_Api_AdminController
{
    public $isPlantformRole = null;
    
	public function __construct(&$ctl, $met, $typ)
	{
		//本地读取远程信息
        $this->key = Base_ConfigModel::getConfig('shop_app_key');
        $this->url = Base_ConfigModel::getConfig('shop_app_url');
        $this->appId = Base_ConfigModel::getConfig('shop_app_id');
		parent::__construct($ctl, $met, $typ);
        
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
                }else{
					Shop_OperationLogModel::getInstance()->addLogs();
				}
            }
        }
        else
        {
            throw new Exception(__('无访问权限, 请先登录系统'));
        }
	}
}

?>
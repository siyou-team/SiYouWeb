<?php if (!defined('ROOT_PATH')){exit('No Permission');}
/**
 * @author     Xinze <xinze@live.cn>
 */
class SellerAdminController extends Zero_Api_AdminController
{
	public function __construct(&$ctl, $met, $typ)
	{
        $this->key = Base_ConfigModel::getConfig('shop_app_key');;
        $this->url = Base_ConfigModel::getConfig('shop_app_url');
        $this->appId = Base_ConfigModel::getConfig('shop_app_id');
        
        parent::__construct($ctl, $met, $typ);
        
        if (Zero_Perm::checkLogin())
        {
            $user_row = Zero_Perm::getUserRow();
            
            
            if ($user_row['user_is_admin'])
            {
                $this->isPlantformRole = true;
            }
            else
            {
                $this->isPlantformRole = false;
            }
            
            if (!$user_row['user_is_admin'] && !$user_row['store_ids'] && !$user_row['chain_ids'])
            {
                throw new Exception(__('无管理中心访问权限'));
            }
            else
            {
                if (!Zero_Perm::checkUserRights())
                {
                    throw new Exception(__('无操作权限'));
                }
            }
        }
        else
        {
            throw new Exception(__('无访问权限, 请先登录系统'));
        }
	}
    
    /**
     * layout数据初始化
     *
     * @access public
     */
    protected function getLayoutData()
    {
        if ($this->typ == 'e')
        {
            $Base_MenuModel = Base_MenuModel::getInstance();
            return $Base_MenuModel->getOne(i('menu_id'));
        }
    }
}

?>
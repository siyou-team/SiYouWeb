<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class PassportController extends Zero_AppController
{
    /**
     * 请求统一封装
     *
     * @param string $method 方法名称
     * @param string $args  参数
     * @return void
     */
    public function getUrl($ctl=null, $met=null, $mdu=null, $typ='json', $debug=null)
    {
        $key = Base_ConfigModel::getConfig('passport_app_key');
        $url = Base_ConfigModel::getConfig('passport_app_url');
        $app_id =  Base_ConfigModel::getConfig('passport_app_id');
        
        
        $formvars = $_POST;
        
        if ($user_id = Zero_Perm::getUserId())
        {
            $formvars['perm_id'] = $user_id;
            $formvars['perm_key'] = $_COOKIE[Zero_Perm::getCookieName()];
        }
        
        
        foreach ($_GET as $k=>$item)
        {
            if ('mdu'!=$k && 'ctl'!=$k && 'met'!=$k && 'typ'!=$k && 'debug'!=$k)
            {
                $formvars[$k] = $item;
            }
        }
        
        unset($formvars['mdu']);
        
        if ($mdu === null)
        {
            $mdu = s('mdu', '');
        }
        
        $init_rs         = get_url(sprintf('%s?mdu=%s&ctl=%s&met=%s&typ=%s', $url, $mdu, $ctl, $met, $typ), $formvars, $typ, 'POST', $debug);
        
        $data = array();
        
        if (200 == $init_rs['status'])
        {
            //读取服务列表
            $data = $init_rs['data'];
            $status = 200;
            $msg = isset($init_rs['msg']) ? $init_rs['msg'] : __('sucess');
        }
        else
        {
            $status = 250;
            $msg = isset($init_rs['msg']) ? $init_rs['msg'] : __('请求错误!');
        }
        
        return array('data'=>$data, 'msg'=>$msg, 'status'=>$status);
    }
    
    /**
     * layout数据初始化
     *
     * @access public
     */
    protected function getLayoutData()
    {
        $data['site_logo'] = Base_ConfigModel::getConfig('site_logo');
        $data['site_name'] = Base_ConfigModel::getConfig('site_name');
        $data['site_meta_description'] = Base_ConfigModel::getConfig('site_meta_description');
        $data['site_meta_keyword'] = Base_ConfigModel::getConfig('site_meta_keyword');
        $data['icp_number'] = Base_ConfigModel::getConfig('icp_number');
        $data['copyright'] = Base_ConfigModel::getConfig('copyright');
        
        
        //
        if (Zero_Perm::isLogin())
        {
            $user_id = Zero_Perm::getUserId();
    
            $data['user_row'] = Zero_Perm::getUserRow();
    
            $data['user_row'] = array_merge($data['user_row'], User_InfoModel::getInstance()->getOne($user_id));
    
            //用户等级
            $Base_UserLevelModel = Base_UserLevelModel::getInstance();
    
            if ($data['user_row']['user_level_id'])
            {
                $user_level_row = $Base_UserLevelModel->getOne($data['user_row']['user_level_id']);
            }
            
            $data['user_row']['user_level_name'] = isset($user_level_row['user_level_name']) ? $user_level_row['user_level_name'] : __('V1');
            
            //用户收藏
            $favorites_store = User_FavoritesStoreModel::getInstance()->getNum(array('user_id'=>$user_id));
            $favorites_goods = User_FavoritesItemModel::getInstance()->getNum(array('user_id'=>$user_id));
            $new_msg_num = User_MessageModel::getInstance()->getNum(array('user_id'=>$user_id, 'message_is_read'=>0));
            
            $data['user_row']['favorites_store'] = $favorites_store;
            $data['user_row']['favorites_goods'] = $favorites_goods;
            $data['user_row']['new_msg_num']     = $new_msg_num;
            
            //关注信息
            $data['user_row'] = $data['user_row'] + User_SnsModel::getInstance()->getOne($user_id);
        }
        
        return $data;
    }
	
    //父类继承
    protected function header()
    {
    }
	
	
	protected function footer()
	{
	}
	
    protected function testWidgets()
    {
        $data = array(1, 2, 3);

        $this->renderWidget('test', $data);
    }
}
?>
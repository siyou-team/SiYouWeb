<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class PayController extends AccountController
{
    /**
     * layout数据初始化
     *
     * @access public
     */
    protected function getLayoutData()
    {
        $data = parent::getLayoutData();

        //
        if (Zero_Perm::isLogin())
        {
            $user_id = Zero_Perm::getUserId();
    
            $data['user_row'] = array_merge($data['user_row'], User_ResourceModel::getInstance()->getOne($user_id));
        }
        
        return $data;
    }
}
?>
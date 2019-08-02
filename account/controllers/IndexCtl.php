<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class IndexCtl extends AccountController
{
    public function index()
    {
        $this->redirect(urlh(Zero_Registry::get('index_page'), 'User_Account'));
        die();
        
        /*
        $avatar_max_height = Base_ConfigModel::getConfig('avatar_thumb_width');
        print_r($avatar_max_height);
        $avatar_max_height = Base_ConfigModel::getConfig('avatar_thumb_height');
        print_r($avatar_max_height);
        */
        $data = array('user_row'=>array());
        
        if (Zero_Perm::checkUserPerm())
        {
            $data['user_row'] = Zero_Perm::getUserRow();
        }
        
        $this->render('default', $data);
        //var_export($data);
    }


    public function alipay()
    {
        $Consume_TradeModel = new Consume_TradeModel();
        $trade_row = $Consume_TradeModel->getOne('12');
        $trade_row = $Consume_TradeModel->find(array('order_id'=>array(20000013, 20000012)));

        if ($trade_row)
        {
            $Payment = PaymentModel::create('alipay');
            $Payment->pay($trade_row);
        }
        else
        {

        }

        die();
    }

    public function wx()
    {
        $Consume_TradeModel = new Consume_TradeModel();
        $trade_row = $Consume_TradeModel->getOne('11321322');

        if ($trade_row)
        {
            $Payment = PaymentModel::create('wx_native');
            $Payment->pay($trade_row);
        }
        else
        {

        }
    }


    public function main()
    {
        $this->render();
    }
    
    public function avatar()
    {
        //
        $user_id = i('user_id', i('id'));
        $w = i('w', 64);
        $h = i('h', 64);
    
        $user_avatar = '';
        
        if ($user_id)
        {
            $user_info_row = User_InfoModel::getInstance()->getOne($user_id);
            
            $user_avatar = $user_info_row['user_avatar'];
        }
        else
        {
        
        }
        
        echo img($user_avatar, $w, $h);
        die();
    }


    public function getConfig()
    {

        if (Zero_Perm::checkUserPerm())
        {
            $user_id = Zero_Perm::getUserId();
        }
        else
        {
            $user_id = s('uid');
        }

        $data = array();

        $user_other_id = i('user_other_id');

        //{"code":200,"datas":{"im_chat":true,"node_site_url":"https:\/\/b2b2c.shopsuite.com:8090","resource_site_url":"http:\/\/b2b2c.shopsuite.com\/tesa\/data\/resource","user_info":{"member_id":"201","member_name":"huangxz","member_avatar":"http:\/\/b2b2c.shopsuite.com\/tesa\/data\/upload\/shop\/common\/default_user_portrait.gif","store_id":"","store_name":"","store_avatar":"","grade_id":""},"user_other_info":{"member_id":"1","member_name":"shopnc","member_avatar":"http:\/\/b2b2c.shopsuite.com\/tesa\/data\/upload\/shop\/common\/default_user_portrait.gif","store_id":"1","store_name":"\u5e73\u53f0\u81ea\u8425","store_avatar":"http:\/\/b2b2c.shopsuite.com\/tesa\/data\/upload\/shop\/common\/default_store_avatar.png","grade_id":"0","seller_name":"shopnc_seller"}}}



        $service_user_id = Base_ConfigModel::getConfig('service_user_id');


        $data['im_chat'] = true;
        $data['node_site_url'] = Zero_Model::getPlantformChatUrl($user_id, $service_user_id, 'wss://shop.xunyoutest.com:8888');

        if (Zero_Perm::checkUserPerm())
        {
        }
        else
        {
        }

        $data['suid'] = $service_user_id;

        $data['resource_site_url'] = Zero_Registry::get('static_lib_url') . '';


        if (Zero_Perm::checkUserPerm())
        {

            $user_rows = User_InfoModel::getInstance()->getUser(array($user_id, $user_other_id));

            $data['user_info'] = $user_rows[$user_id];
            $data['user_info']['puid'] = Zero_Model::getPlantformUid($user_id);
            $data['user_info']['suid'] = $service_user_id;


            $data['puid'] = $data['user_info']['puid'];

            if (isset($user_rows[$user_other_id]))
            {
                $data['user_other_info'] = $user_rows[$user_other_id];

                //

                $data['user_other_info']['puid'] = Zero_Model::getPlantformUid($user_other_id);
                $data['user_other_info']['suid'] = $service_user_id;
            }
            else
            {

                $data['user_other_info'] = null;
            }

            if ($chat_item_id = i('chat_item_id'))
            {
                $data['chat_item_row'] = Product_BaseModel::getInstance()->getProductItemOne($chat_item_id);
            }

            //
            User_MessageModel::getInstance()->editCond(array('user_id'=>$user_id, 'user_other_id'=>$user_other_id), array('message_is_read'=>1));

        }
        else
        {
            $data['user_info'] = null;

            if ($user_other_id)
            {
                $user_rows = User_InfoModel::getInstance()->getUser(array($user_other_id));
            }

            $data['user_other_info'] = @$user_rows[$user_other_id];

            $data['user_other_info']['puid'] = Zero_Model::getPlantformUid($user_other_id);;
            $data['user_other_info']['suid'] = $service_user_id;

            $data['puid'] = Zero_Model::getPlantformUid($user_id);;;
        }

        $this->render('user', $data);
    }
    
    
    public function listBaseUserLevel()
    {
        $data = Base_UserLevelModel::getInstance()->getLists();
        $this->render('user', $data);
    }
}
?>
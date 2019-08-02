<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class User_ConnectCtl extends AccountController
{
    /* @var $userBaseModel User_BaseModel */
    public $userBaseModel = null;
    
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
        
        $this->userBaseModel = User_BaseModel::getInstance();
    }
    
    /**
     * 用户基本信息首页
     *
     * @access public
     */
    public function index()
    {

        $user_id = Zero_Perm::getUserId();

        $data = User_BindConnectModel::getInstance()->find(array('user_id' => $user_id, 'bind_active' => 1));

        $data['user_id'] = $user_id;

        $Base_ConfigModel = new Base_ConfigModel();

        $data['connect'] = $Base_ConfigModel->getConfigFormatByType(array('connect'));


        $this->render('user', $data);
    }


    public function remove()
    {
        $user_id = Zero_Perm::getUserId();
        $bind_type = i('bind_type');

        $bind_row = User_BindConnectModel::getInstance()->findOne(array('user_id'=>$user_id, 'bind_type'=>$bind_type));

        $data['bind_active'] = 0;

        if($bind_row)
        {
            $flag = User_BindConnectModel::getInstance()->edit($bind_row['bind_id'], $data);

            if ($flag !== false)
            {
                $bind_row['bind_active'] = 0;
                
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
    

        $this->render('user', $bind_row, $msg, $status);

    }
}
?>
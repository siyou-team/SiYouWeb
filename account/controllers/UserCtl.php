<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class UserCtl extends Zero_AppController
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
        $this->render('user');
    }

    public function get()
    {

        $user_id = Zero_Perm::getUserId();


        $rows = $this->userBaseModel->get($user_id);

        $data = (array)$rows + (array)User_InfoModel::getInstance()->get($user_id);

        $this->render('user', $data);


    }
    
    /**
     * 用户基本信息管理界面
     *
     * @access public
     */
    public function profile()
    {
        $this->render('user');
    }
    
    /**
     * 用户基本信息管理界面
     *
     * @access public
     */
    public function settings()
    {
        $this->render('user');
    }
    
    /**
     * 用户消息
     *
     * @access public
     */
    public function message()
    {
        $this->render('user');
    }
}
?>
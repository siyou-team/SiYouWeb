<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class UserCtl extends AccountController
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
        $user_id = i('user_id');
        
        $this->render('default');
    }
}
?>
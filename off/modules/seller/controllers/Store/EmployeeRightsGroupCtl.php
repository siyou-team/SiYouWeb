<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * 权限组控制器
 *
 * @package    Controller
 * @author     Xinze <i@xinze.me>
 * @copyright  Copyright (c) 2017-10-30, Xinze
 * @request int $rights_group_id 权限组id
 * @request string $rights_group_name 权限组名称
 * @request string $rights_group_rights_ids 权限列表(DOT)
 * @request string $rights_group_rights_data 数据权限(DOT):组数据权限，仅仅用来表示有一定小的结果集的数据。
 * @request string $rights_group_add_time 创建时间
 */
class Store_EmployeeRightsGroupCtl extends SellerAdminController
{


    /* @var $storeEmployeeRightsGroupModel Store_EmployeeRightsGroupModel */
    public $storeEmployeeRightsGroupModel = null;

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

        $this->storeEmployeeRightsGroupModel = Store_EmployeeRightsGroupModel::getInstance();

        $this->model = $this->storeEmployeeRightsGroupModel;
    }
    /**
     * 权限组首页
     *
     * @access public
     */
    public function index()
    {
        $this->render('default');
    }

    /**
     * 权限组管理界面
     *
     * @access public
     */
    public function manage()
    {
        $rights_group_id   = i('id', i('rights_group_id'))            ; // 权限组id

        $Store_EmployeeRightsBaseModel = Store_EmployeeRightsBaseModel::getInstance();

        $rights_rows = $Store_EmployeeRightsBaseModel->find(array(), array('rights_order'=>'ASC'));

        $data['base'] = Zero_Utils_Array::arr2tree($rights_rows, 0, 'son', 'rights_');

        $right_group_row = $this->storeEmployeeRightsGroupModel->getOne($rights_group_id);

        $data['group'] = $right_group_row['rights_group_rights_ids'];

        $this->render('manage', $data);
    }

}

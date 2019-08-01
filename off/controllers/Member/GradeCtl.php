<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Member_GradeCtl extends AdminController
{
    public $memberGradeModel = null;
	public $store_id = null;

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

        $this->memberGradeModel = Member_GradeModel::getInstance();
		$this->store_id = Zero_Perm::$storeId;
    }
	
	
    /**
     * 首页
     * 
     * @access public
     */
    public function index()
    {
		$this->render('default');
    }
    
    /**
     * 管理界面
     * 
     * @access public
     */
	public function manage()
	{
		$this->render('manage');
	}
	
    public function lists()
    {
        $user_id = Zero_Perm::getUserId();

        $page = i('page', 1);  //当前页码
        $rows = i('rows', 10); //每页记录条数
        $sort = grid_sort();

        $column_row = array();

        //权限判断
        $user_id = Zero_Perm::getUserId();
		$data = $this->memberGradeModel->getLists();
        
        $this->render('default', $data);
    }
	
	public function add()
	{
		$field = array();
		$field['member_grade_name'] = s('member_grade_name'); //等级名称
		$field['member_grade_discountrate'] = f('member_grade_discountrate'); //折扣比例
		$field['member_grade_desc'] = s('member_grade_desc'); //描述
		$field['member_card_money'] = f('member_card_money'); //初始余额
		$field['member_card_sales'] = f('member_card_sales'); //售卡金额
		$field['member_grade_pointsrate'] = f('member_grade_pointsrate'); //积分抵扣比例
		$field['store_id'] = $this->store_id;
		
		$this->memberGradeModel->sql->startTransactionDb();
		$flag = $this->memberGradeModel->add($field,true);
		
		if ($flag && $this->memberGradeModel->sql->commitDb())
		{
			$msg = __('操作成功');
			$status = 200;
		}
		else
		{
			$this->memberGradeModel->sql->rollBackDb();
			$msg = __('操作失败');
			$status = 250;
		}
		
		$data = array();
		$data = $field;
		$data['member_grade_id'] = $flag;
		$this->render('default', $data, $msg, $status);
	}
	
	public function edit()
	{
		$member_grade_id = i('member_grade_id');
		$field['member_grade_name'] = s('member_grade_name'); //等级名称
		$field['member_grade_discountrate'] = f('member_grade_discountrate'); //折扣比例
		$field['member_grade_desc'] = s('member_grade_desc'); //描述
		$field['member_card_money'] = f('member_card_money'); //初始余额
		$field['member_card_sales'] = f('member_card_sales'); //售卡金额
		$field['member_grade_pointsrate'] = f('member_grade_pointsrate'); //积分抵扣比例
		$field['store_id'] = $this->store_id;
		
		$this->memberGradeModel->sql->startTransactionDb();
		$flag = $this->memberGradeModel->edit($member_grade_id,$field);
		
		if ($flag && $this->memberGradeModel->sql->commitDb())
		{
			$msg = __('操作成功');
			$status = 200;
		}
		else
		{
			$this->memberGradeModel->sql->rollBackDb();
			$msg = __('操作失败');
			$status = 250;
		}
		
		$data = array();
		$data = $field;
		$data['member_grade_id'] = $member_grade_id;
		$this->render('default', $data, $msg, $status);
	}
	
	public function remove()
	{
		$id = i('member_grade_id');
		$data = $this->memberGradeModel->getOne($id);
		if(!empty($data) && $data['store_id'] == $this->store_id)
		{
			$flag = $this->memberGradeModel->remove($id);
			if ($flag !== false)
			{
				$msg = __('操作成功');
				$status = 200;
			}
			else
			{
				$msg = __('操作失败');
				$status = 250;
			}
		}else{
			$msg = __('数据不存在');
			$status = 250;
		}
		
        $data['id'] = $id;
        $this->render('default', $data, $msg, $status);
	}
}
?>
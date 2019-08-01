<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Marketing_PointsCtl extends AdminController
{
    public $memberBaseModel = null;
    public $pointsLogModel  = null;
    public $pointsGiftModel = null;
 
	public $store_id = null;
	public $chain_id = null;

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

        $this->memberBaseModel = Member_BaseModel::getInstance();
        $this->pointsLogModel  = Points_LogModel::getInstance();
        $this->pointsGiftModel = Points_GiftModel::getInstance();
		
		$this->store_id = Zero_Perm::$storeId;
		$this->chain_id = Zero_Perm::getChainId();
    }
 
    //积分变动页面
    public function index()
    {
		$this->render('default');
    }
	
	//积分变动操作
    public function changePoint()
    {
        $user_id = i('user_id'); //会员ID
        $points  = f('points');   //变动积分值
        $flag    = i('flag');     //变动类型
        $remark  = s('remark');   //备注
        $type_code = 'JF';
        $order_id  = Number_SequeModel::getInstance()->createNextSeq(sprintf('%s-%s-', $type_code, date('Ymd')));

        if($user_id && $points >= 0)
        {		
			$this->pointsLogModel->pointsLog($user_id,$this->store_id,$flag,$points,$order_id,$remark);

            $msg = '修改成功';
            $status = 200;
        }else
        {
            $status = 250;
            $data = array();
            $msg = '数据错误';
        }

        $data = array();
        $this->render('default',$data,$msg,$status);
    }

	//礼品列表页面
    public function gift()
    {
        $this->render('default');
    }
	
	//获取礼品列表
    public function lists()
    {
        $page = i('pageIndex', 1);  //当前页码
        $rows = i('pageRows', 20);  //每页记录条数
        $sort = array('points_gift_date'=>'DESC');

        $data = array('items'=>array());
        $column_data = array();
		$column_data['store_id'] = $this->store_id;
		$column_data['chain_id'] = $this->chain_id;
		if(s('gift_code'))
		{
			$column_data['points_gift_code'] = s('gift_code');
		}

        $data = $this->pointsGiftModel->getLists($column_data, $sort, $page, $rows);
        $this->render('default', $data);
    }
	
	//礼品管理页面
    public function manage()
    {
		$data = array();
		
		if(i('typ') == 'json')
		{
			$points_gift_id = i('points_gift_id');
			$data = $this->pointsGiftModel->getOne($points_gift_id);
        }
		
		$this->render('default',$data);
    }

    //增加礼品
    public function add()
    {
        $gift_row = array();
		$code = s('points_gift_code');  //编号
        $base = $this->pointsGiftModel->giftCodeExist($code);
		
		if(empty($base))
		{
			$gift_row['points_gift_code'] = $code; //编号
			$gift_row['points_gift_name'] = s('points_gift_name'); //名称
			$gift_row['points_gift_price'] = f('points_gift_price'); //价值
			$gift_row['points_gift_points'] = f('points_gift_points'); //积分
			$gift_row['points_gift_remark'] = s('points_gift_remark'); //备注
			$gift_row['points_gift_date'] = get_datetime();
			$gift_row['points_gift_stock'] = i('points_gift_stock');  //库存
			$gift_row['points_gift_image'] = s('points_gift_image');  //图片
			$gift_row['points_gift_cat_id'] = s('points_gift_cat_id'); //分类
			$gift_row['store_id'] = $this->store_id;
			$gift_row['chain_id'] = $this->chain_id;

			$this->pointsGiftModel->sql->startTransactionDb();
			$flag = $this->pointsGiftModel->add($gift_row,true);

			if ($flag && $this->pointsGiftModel->sql->commitDb())
			{
				$msg = __('操作成功');
				$status = 200;
			}
			else
			{
				$this->pointsGiftModel->sql->rollBackDb();
				$msg = __('操作失败');
				$status = 250;
			}
		}else{
			$msg = '编号已经存在！';
            $status = 250;
		}

        $data = array();
        $this->render('default',$data);
    }

	//编辑礼品
    public function edit()
    {
        $gift_row = array();
		$points_gift_id   = i('points_gift_id');
		$code = s('points_gift_code');  //编号
        $base = $this->pointsGiftModel->giftCodeExist($code);
		
		if(empty($base) || $base['points_gift_id'] ==  $points_gift_id)
        {
			$gift_row['points_gift_code'] = $code; //编号
			$gift_row['points_gift_name'] = s('points_gift_name'); //名称
			$gift_row['points_gift_price'] = f('points_gift_price');
			$gift_row['points_gift_points'] = f('points_gift_points');
			$gift_row['points_gift_remark'] = s('points_gift_remark');
			$gift_row['points_gift_date'] = get_datetime();
			$gift_row['points_gift_stock'] = i('points_gift_stock');
			$gift_row['points_gift_image'] = s('points_gift_image');
			$gift_row['points_gift_cat_id'] = s('points_gift_cat_id');
			 
			$this->pointsGiftModel->sql->startTransactionDb();
			$flag = $this->pointsGiftModel->edit($points_gift_id,$gift_row);

			if ($flag && $this->pointsGiftModel->sql->commitDb())
			{
				$msg = __('操作成功');
				$status = 200;
			}
			else
			{
				$this->pointsGiftModel->sql->rollBackDb();
				$msg = __('操作失败');
				$status = 250;
			}
		}else{
			$msg = '编号已经存在！';
            $status = 250;
		}

        $data = array();
        $this->render('default',$data,$msg,$status);
    }
	
	//删除礼品
    public function remove()
    {
        $points_gift_id = i('points_gift_id');
        $data['points_gift_id'] = $points_gift_id;
        $gift = $this->pointsGiftModel->getOne($points_gift_id);
        
		if ($gift && $gift['store_id'] == $this->store_id && $gift['chain_id'] == $this->chain_id)
        {
            $flag = $this->pointsGiftModel->remove($points_gift_id);
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

            $msg = __('不存在');
            $status = 250;
        }

        $this->render('default', $data, $msg, $status);
    }
	
	//积分兑换页面
	public function exchange()
    {
        $this->render('default');
    }
	
	//兑换礼品
    public function addGiftOrder()
    {
        $gifts_list = r('gifts');
        $post_data = r('postGiftData');
        $user_id = $post_data['user_id'];

        if($user_id)
        {
            $member = $this->memberBaseModel->findOne(array('user_id'=>$user_id,'store_id'=>$this->store_id));
 
            if(empty($member))
            {
                $member_points = 0;
            }else{
                $member_points = $member['member_points'];
            }

            if($member_points >= $post_data['total_points'])
            {
                $pointsGorderModel = Points_GorderModel::getInstance();
                $pointsGorderModel->sql->startTransactionDb();

                $order_row = array();
                $type_code = 'DH';
                $points_order_id = Number_SequeModel::getInstance()->createNextSeq(sprintf('%s-%s-', $type_code, date('Ymd')));
                $order_row['points_order_id'] = $points_order_id;
                $order_row['user_id'] = $user_id;
				$order_row['user_name'] = $member['member_account'];
                $order_row['order_add_time'] = get_datetime();
                $order_row['order_points'] = $post_data['total_points'];
                $order_row['order_num'] = $post_data['quantity'];
                $order_row['order_remark'] = $post_data['remark'];
                $order_row['store_id'] = $this->store_id;
				$order_row['chain_id'] = $this->chain_id;

                $flag = $pointsGorderModel->add($order_row, true);
                if ($flag)
                {
                    $pointsGorderItemModel = Points_GorderItemModel::getInstance();

                    foreach ($gifts_list as $k => $v) 
					{
                        $item_row = array();
                        $item_row['points_gift_id'] = $v['points_gift_id'];
                        $item_row['points_gift_name'] = $v['points_gift_name'];
                        $item_row['points_gift_code'] = $v['points_gift_code'];
                        $item_row['points_gift_quantity'] = $v['quantity'];
                        $item_row['points_gift_points'] = $v['points_gift_points'];
                        $item_row['store_id'] = $this->store_id;
						$item_row['chain_id'] = $this->chain_id;
                        $item_row['user_id'] = $user_id;
                        $item_row['points_order_id'] = $points_order_id;

                        $flag = $pointsGorderItemModel->add($item_row, true);
                    }
					
                    $this->pointsLogModel->pointsLog($user_id,$this->store_id,4,$post_data['total_points'],$points_order_id);
                }

                if ($flag && $pointsGorderModel->sql->commitDb()) {
                    $msg = __('操作成功');
                    $status = 200;
                } else {
                    $pointsGorderModel->sql->rollBackDb();
                    $msg = __('操作失败');
                    $status = 250;
                }
            }else{
                $msg = __('会员积分不足！');
                $status = 250;
            }
        }else{
            $msg = __('请选择会员');
            $status = 250;
        }

        $data = array();
        $this->render('default', $data, $msg, $status);
    }
 
	//积分日志
    public function logs()
    {
		$this->render('default');
    }
 
	//积分日志明细
    public function logsList()
    {
        $page = i('pageIndex', 1);  //当前页码
        $rows = i('pageRows', 20); //每页记录条数
        $sort = array('points_log_time'=>'DESC');

        $data = array('items'=>array());
        $column_data = array();
		$column_data['store_id'] = $this->store_id;
		$column_data['chain_id'] = $this->chain_id;
		
		if(i('points_type')){
			$column_data['points_type'] = i('points_type');
		}
		if(s('order_id')){
			$column_data['points_order_id'] = s('order_id');
		}
		if(s('beginDate'))
        {
            $column_data['points_log_time:>='] = s('beginDate');
        }
        if(s('endDate'))
        {
            $column_data['points_log_time:<='] = s('endDate');
        }

        $data = $this->pointsLogModel->getLists($column_data, $sort, $page, $rows);
        $this->render('default', $data);
    }
}
?>
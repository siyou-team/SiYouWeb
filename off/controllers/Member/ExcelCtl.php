<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Member_ExcelCtl extends AdminController
{
    public $memberGradeModel = null;
	public $memberBaseModel  = null;
	public $accountInfoModel = null;
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
        $this->memberBaseModel  = Member_BaseModel::getInstance();
		$this->accountInfoModel = User_InfoModel::getInstance();
		
		$this->store_id = Zero_Perm::$storeId;
		
    }
	
	
    /**
     * 会员导入模板
     * 
     * @access public
     */
    public function member()
    {
		ob_end_clean();
		ob_start();
		
		$PHPExcel = new PHPExcel();
		$title = '会员数据批量导入模版';
		$PHPExcel->setActiveSheetIndex(0);
        $PHPExcel->getActiveSheet()->setTitle("$title");    	
        $PHPExcel->getActiveSheet()->setCellValue('A1', "$title"); //填入表头主标题
        
		$grade = $this->memberGradeModel->find(array('store_id'=>$this->store_id)); 
		$txt = "";
		foreach($grade as $k=>$v)
		{
			$txt.= $v['member_grade_id']."：".$v['member_grade_name']."；";
		}
		
		//填入表头副标题
		$str = "模版数据填写注意事项：\r\n"."1、会员卡号、会员手机号为必填字段，不能留空；日期格式必须为：yyyy-MM-dd(yyyy/MM/dd)，如：2016-09-24(2016/09/24)\r\n"."2、会员等级编号：根据店铺设置的会员等级填写；（".$txt."）\r\n"."3、会员密码为空时，使用系统全局设置的会员默认密码；如果会员默认密码为空，请先进行系统全局设置\r\n".
		"4、会员性别:男 / 女\r\n".
		"5、会员生日格式：yyyy-MM-dd 请不要输入中文日期 示例: 会员生日输入格式为  1999-01-01  会员生日不填 默认为当前日期\r\n"."6、导入条数最多为500条!请不要修改列名,否则数据将无法导入!\r\n";
        $PHPExcel->getActiveSheet()->setCellValue('A2',$str);
		$PHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setWrapText(true);

        //合并表头单元格
        $PHPExcel->getActiveSheet()->mergeCells('A1:I1');
		$PHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray(
	            array(
	                'font' => array (
	                    'bold' => true
	                ),
	                'alignment' => array(
	                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
	                )
	            )
	    );
		$PHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
		
        $PHPExcel->getActiveSheet()->mergeCells('A2:I2');
        
        //设置表头行高
        $PHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(40);
        $PHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(206);
        $PHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(30);
        
        //设置表头字体
        $PHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('黑体');
        $PHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $PHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $PHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('宋体');
        $PHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
        $PHPExcel->getActiveSheet()->getStyle('A3:I3')->getFont()->setBold(true);
		$PHPExcel->getActiveSheet()->getStyle('A3:I3')->getFont()->setColor( new PHPExcel_Style_Color( PHPExcel_Style_Color::COLOR_RED) );
		//$PHPExcel->getActiveSheet()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$PHPExcel->setActiveSheetIndex(0)->getStyle('A3:I3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
 
        //设置单元格边框
        $styleArray = array(  
            'borders' => array(  
                'allborders' => array(  
                    //'style' => PHPExcel_Style_Border::BORDER_THICK,//边框是粗的  
                    'style' => PHPExcel_Style_Border::BORDER_THIN,//细边框  
                    //'color' => array('argb' => 'FFFF0000'),  
                ),  
            ),  
        );
        
        //表格宽度
        $PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);  //店铺名称
        $PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);  //订单编号
        $PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  //订单状态
        $PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);  //下单时间
        $PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);  //付款时间
        $PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);  //完成时间
        $PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);  //物流单号
        $PHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);  //支付方式
		$PHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);  //支付方式
 
        //表格标题
		$PHPExcel->getActiveSheet()->setCellValue('A3', '会员卡号(*)');
        $PHPExcel->getActiveSheet()->setCellValue('B3', '会员手机号(*)');
		$PHPExcel->getActiveSheet()->setCellValue('C3', '会员姓名');
		$PHPExcel->getActiveSheet()->setCellValue('D3', '会员性别');
        $PHPExcel->getActiveSheet()->setCellValue('E3', '会员等级编号');
        $PHPExcel->getActiveSheet()->setCellValue('F3', '会员生日');
        $PHPExcel->getActiveSheet()->setCellValue('G3', '身份证号');
        $PHPExcel->getActiveSheet()->setCellValue('H3', '会员邮箱');
		$PHPExcel->getActiveSheet()->setCellValue('I3', '会员密码');

        for($i = 4; $i <= 527 ;$i++)
        {
            $PHPExcel->getActiveSheet()->setCellValue("A$i", '');
        }
         
		$savePath = ROOT_PATH.'/off/data/upload/excel/member/';
		$name = "批量导入会员模板.xls";
		$filename = $savePath.$name;
 
		$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
		$objWriter->save($filename);
		$data['filepath'] = Zero_Registry::get('base_url').'/off/data/upload/excel/member/'.$name;
		
		$this->render('default',$data);
    }
	
	public function memberImport()
	{
		if(@is_uploaded_file($_FILES['filedata']['tmp_name']))
		{
			$upfile = $_FILES["filedata"]; 
			$file_types = explode ( ".", $upfile['name']);
			$file_type = $file_types [count($file_types) - 1];

			//判别是不是.xls文件，判别是不是excel文件
			if (strtolower ( $file_type ) != "xls" && strtolower ( $file_type ) != 'xlsx')             
			{
				$msg    = '不是Excel文件，重新上传';
				$status = 250;
			}else
			{		
				//获取数组里面的值 
				$name=$upfile["name"];//上传文件的文件名 
				$type=$upfile["type"];//上传文件的类型 
				$size=$upfile["size"];//上传文件的大小 
				$tmp_name=$upfile["tmp_name"];//上传文件的临时存放路径   

				$savePath = ROOT_PATH.'/off/data/upload/excel/member/';
				$str = date ('Ymdhis');
				$file_name = $str . "." . $file_type;

				//是否上传成功
				if (! copy ( $tmp_name, $savePath . $file_name ))
				{
					$msg    = '文件上传失败！';
					$status = 250;
				}else
				{
					ob_end_clean();   //这里再加一个
					$PHPExcel = new PHPExcel();   
					$filename = $savePath . $file_name;		  //导入的Excel	
					$PHPReader = new PHPExcel_Reader_Excel5(); 
					$PHPExcel = $PHPReader->load($filename);
					$currentSheet = $PHPExcel->getSheet(0);
					$allColumn = $currentSheet->getHighestColumn();
					$allRow = $currentSheet->getHighestRow();

					for($currentRow = 4; $currentRow <= $allRow; $currentRow++)
					{
						for($currentColumn='A'; $currentColumn<=$allColumn; $currentColumn++)
						{   
							$address = $currentColumn.$currentRow;   
							$data[$currentRow][] = $currentSheet->getCell($address)->getValue();
						}
					}
					 
					if(!empty($data))
					{
						foreach($data as $k=>$v)
						{
							// 0会员卡号     1会员手机号 2会员姓名 3会员性别 
							// 4会员等级编号 5会员生日   6身份证号 7会员邮箱 8会员密码

							if($v[0] && $v[1])
							{
								$birthday = gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($v[5]));
								if($birthday == '')
								{
									$birthday = date('Y-m-d');
								}
								if($v[3] == '男')
								{
									$user_gender = 1;
								}else{
									$user_gender = 2;
								}
								
								if($v[8] == '')
								{
									$v[8] = '123456';
								}
								
								$base['user_account']           = $v[0]; // 用户名
								$base['user_password']          = $v[8]; // 密码
								$base['user_nickname']          = $v[0]; //  用户昵称
								$base['user_state']             = 2; // 状态:0-锁定;1-未激活;2-已激活;
 
								$info['user_gender']            = $user_gender; // 性别(ENUM):1-男;  2-女;
								$info['user_realname']          = $v[2]; // 真实姓名
								$info['user_birthday']          = $birthday; // 生日(DATE)
								$info['user_mobile']            = $v[1]; // 手机号码(mobile)
								$info['user_email']             = $v[7]; // 用户邮箱(email)
								$info['user_idcard']            = $v[6]; // 身份证
								
								$this->accountInfoModel->sql->startTransactionDb();
								$is_admin = 0;
								$rights_group_id = 0;
								
								$user_base_row = $this->accountInfoModel->register($base['user_account'], $base['user_password'], null, null, null, false, $rights_group_id, $is_admin);
								$user_id = $user_base_row['user_id'];
								
								if ($user_id && $this->accountInfoModel->sql->commitDb())
								{
									$msg = __('操作成功');
									$status = 200;
									
									$flag = $this->accountInfoModel->editAccount($user_id, $info);
									
									$this->memberBaseModel->sql->startTransactionDb();
									$field = array();
									$field['user_id'] = $user_id;
									$field['member_number'] = $base['user_account'];
									$field['member_mobile'] = $info['user_mobile'];
									$field['member_name']   = $info['user_realname'];
									$field['member_birthday'] = $info['user_birthday'];
									$field['member_email'] = $info['user_email'];
									$field['member_idcard']   = $info['user_idcard'];
									$field['member_grade_id'] = $v[4];
									$field['member_gender'] = $info['user_gender'];
									$field['store_id']      = $this->store_id;
									$flag = $this->memberBaseModel->add($field);
									if ($flag && $this->memberBaseModel->sql->commitDb())
									{
										$msg = __('操作成功');
										$status = 200;
									}
									else
									{
										$this->memberBaseModel->sql->rollBackDb();
										$msg = __('操作失败');
										$status = 250;
									}
								}
								else
								{
									$this->accountInfoModel->sql->rollBackDb();
									$msg = __('操作失败');
									$status = 250;
								}
							}
						}
						
						$data['field'] = $field;
					}else{
						$msg = '数据为空!';
						$status = 250;
					}
				}
				
				$msg    = 'success';
				$status = 200;
			}
		}else{
			$data['1'] = 2;
			$msg    = 'failure';
            $status = 250;
		}

		//$data = array();
		$this->render('default', $data, $msg, $status);
	}
}
?>
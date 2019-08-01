<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     windfnn
 */
class Goods_ExcelCtl extends AdminController
{
    public $goodsItemModel = null;
	public $goodsCatModel = null;
	
	public $savePath = null; //表格存储路径
	public $filepath  = null; //表格下载路径
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

        $this->goodsItemModel = Goods_ItemModel::getInstance();
		//$this->goodsCatModel  = Goods_CatModel::getInstance();
		
		$this->savePath = ROOT_PATH.'/off/data/upload/excel/goods/';
		$this->filepath = Zero_Registry::get('base_url').'/off/data/upload/excel/goods/';
		$this->store_id = Zero_Perm::$storeId;
    }
	
	
    /**
     * 导入模板
     * 
     * @access public
     */
    public function down()
    {
		ob_end_clean();
		ob_start();
		
		$PHPExcel = new PHPExcel();
		$title = __('导入模版');
		$PHPExcel->setActiveSheetIndex(0);
        $PHPExcel->getActiveSheet()->setTitle("$title");    	
        $PHPExcel->getActiveSheet()->setCellValue('A1', "$title"); //填入表头主标题
        
		$store_id = $this->store_id;
		$cat = array(); 
		$txt = "";
		foreach($cat as $k=>$v)
		{
			$txt.= $v['member_grade_id']."：".$v['member_grade_name']."；";
		}
		
		//填入表头副标题
		$str = __("模版数据填写注意事项：")."\r\n".
		__("1、产品编号,产品名称为必填字段，不能留空，且产品编号必须无重复!")."\r\n".
		__("2、导入条数最多为500条!请不要修改列名,否则数据将无法导入! ");
        $PHPExcel->getActiveSheet()->setCellValue('A2',$str);
		$PHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setWrapText(true);

        //合并表头单元格
        $PHPExcel->getActiveSheet()->mergeCells('A1:N1');
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
        $PHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(60);
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
        $PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);  //产品编号
        $PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);  //产品类别编号
        $PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);  //产品名称
        $PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);  //参考进价
        $PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);  //产品售价
        $PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);  //是否积分
        $PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);  //产品积分
        $PHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);  //产品库存
		$PHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);  //是否打折
		/* $PHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);  //最低折扣
		$PHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);  //产品会员价
		$PHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);  //计量单位
		$PHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);  //产品规格
		$PHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);  //产品备注 */
 
        //表格标题
		$PHPExcel->getActiveSheet()->setCellValue('A3', __('条形码').'(*)');
        $PHPExcel->getActiveSheet()->setCellValue('B3', __('产品编号').'(*)');
		$PHPExcel->getActiveSheet()->setCellValue('C3', __('产品名称').'(*)');
		$PHPExcel->getActiveSheet()->setCellValue('D3', __('成本价').'(*)');
        $PHPExcel->getActiveSheet()->setCellValue('E3', __('进货折扣价').'(*)');
        $PHPExcel->getActiveSheet()->setCellValue('F3', __('零售价格'));
        $PHPExcel->getActiveSheet()->setCellValue('G3', __('产品会员价'));
		$PHPExcel->getActiveSheet()->setCellValue('H3', __('供应商')); 
        $PHPExcel->getActiveSheet()->setCellValue('I3', __('产品库存'));
		/* $PHPExcel->getActiveSheet()->setCellValue('J3', '最低折扣');	
		$PHPExcel->getActiveSheet()->setCellValue('K3', '产品会员价'); 
		$PHPExcel->getActiveSheet()->setCellValue('L3', '计量单位'); 
		$PHPExcel->getActiveSheet()->setCellValue('M3', '产品规格'); 
		$PHPExcel->getActiveSheet()->setCellValue('N3', '产品备注');  */  
		
		for($i = 4; $i <= 527 ;$i++)
		{
			$PHPExcel->getActiveSheet()->setCellValue("A$i", '');
		}
 
		$name = $store_id."_产品批量导入模板.xls";
		$filename = $this->savePath.$name;
 
		$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
		$objWriter->save($filename);
		$data['filepath'] = $this->filepath.$name;
		
		$this->render('default',$data);
    }
	
	public function dataImport()
	{
		$store_id = $this->store_id;
		$data = array();
		
		if(@is_uploaded_file($_FILES['filedata']['tmp_name']))
		{
			$upfile = $_FILES["filedata"]; 
			$file_types = explode ( ".", $upfile['name']);
			$file_type = $file_types [count($file_types) - 1];

			//判别是不是.xls文件，判别是不是excel文件
			if (strtolower ( $file_type ) != "xls" && strtolower ( $file_type ) != 'xlsx')             
			{
				$msg    = __('不是Excel文件，重新上传');
				$status = 250;
			}else
			{		
				//获取数组里面的值 
				$name=$upfile["name"];//上传文件的文件名 
				$type=$upfile["type"];//上传文件的类型 
				$size=$upfile["size"];//上传文件的大小 
				$tmp_name=$upfile["tmp_name"];//上传文件的临时存放路径   

				$file_name = $store_id.'_'. date ('Ymdhis') . "." . $file_type;

				//是否上传成功
				if (! copy ( $tmp_name, $this->savePath . $file_name ))
				{
					$msg    = __('文件上传失败！');
					$status = 250;
				}else
				{
					ob_end_clean();   //这里再加一个
					$PHPExcel = new PHPExcel();   
					$filename = $this->savePath . $file_name;		  //导入的Excel	
					$PHPReader = new PHPExcel_Reader_Excel5(); 
					$PHPExcel = $PHPReader->load($filename);
					$currentSheet = $PHPExcel->getSheet(0);
					$allColumn = $currentSheet->getHighestColumn();
					$allRow = $currentSheet->getHighestRow();

					for($currentRow = 4; $currentRow <= $allRow; $currentRow++)
					{
						for($currentColumn='A'; $currentColumn<=$allColumn; $currentColumn++)
						{   
							$cellValue = $currentColumn.$currentRow;
							$row = $currentSheet->getCell($cellValue)->getValue();
							
							if(empty($row) && $currentColumn == 'A')
							{
								break;
							}
							
							$result[$currentRow][] = $row;
						}
					}
 
					if(!empty($result))
					{
						foreach($result as $k=>$v)
						{
							//表头 
							/* 
							0-条形码(*) 1-产品编码(*)	2-产品描述(*)	3-进货价(*)	
							4-进货折扣价(*)	5-销售价	6-特价	7-供应商	8-数量	
							*/
							if($v[1] && $v[2])
							{							
								$goods_base = $this->goodsItemModel->findOne(array('goods_code'=>$v[1],'store_id'=>$store_id));
								
								if(empty($goods_base))
								{
									if($v[6] <0 || $v[6] >1){
										$v[6] = 0; //产品最低折扣
									}
									
									$add_field['goods_barcode']     = $v[0];    //编号
									$add_field['goods_code']        = $v[1];    //编号
									$add_field['goods_name'] 		= $v[2];	//商品名称
									$add_field['goods_cost'] 		= $v[3];	//进价
									$add_field['goods_cost_discount']= $v[4];	//进货折扣价
									$add_field['goods_price'] 		= $v[5];	//销售价
									$add_field['goods_vip_price']   = $v[6];	//特价
									$add_field['goods_supply'] 		= $v[7];	//供应商
 
									$add_field['store_id'] 			= $store_id;	//店铺id
									$add_field['chain_id'] 			= Zero_Perm::getChainId();	//门店id
									$add_field['user_id'] 			= Zero_Perm::getUserId();	//用户id									
									$add_field['goods_add_time'] 	= get_datetime();	//时间
 
									$flag = $this->goodsItemModel->add($add_field,true);
									$data = $add_field;
									$data['goods_id'] = $flag;
									$data['goods_stock'] = $v[8];

									if($data['goods_stock'] > 0){
										//增加产品入库信息
										$inventoryModel = Goods_InventoryModel::getInstance();
										$row['inventory_number'] = $data['goods_stock'];
										$row['inventory_amount'] = $data['goods_stock']*$data['goods_cost'];
										$row['supplier_id'] = $supplier_id;
										$row['remark'] = '导入商品，自动入库';
										$row['in_chain_id'] = 0;
										$goods[] = $data;
						 
										$flag = $inventoryModel->addInventory('IN',1,$row,$goods);
									}
								}
							}
						}
						
						$data['txt'] = __('插入数据');
						$msg    = 'success';
						$status = 200;
					}else{

						$msg = __('数据为空!');
						$status = 250;
					}
				}
			}
		}else
		{
			$data['1'] = 2;
			$msg    = __('上传失败');
            $status = 250;
		}

		//$data = array();
		$this->render('default', $data, $msg, $status);
	}
}
?>
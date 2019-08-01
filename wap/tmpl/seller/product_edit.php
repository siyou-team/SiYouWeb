<!doctype html>
<html  >
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-touch-fullscreen" content="yes" />
<meta name="format-detection" content="telephone=no"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<meta name="msapplication-tap-highlight" content="no" />
<meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1" />
<title></title>
<link rel="stylesheet" type="text/css" href="../../css/base.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_common.css">
<link rel="stylesheet" type="text/css" href="../../css/sstouch_member.css">
<link rel="stylesheet" type="text/css" href="../../css/sweetalert.css">
    <style>
        .sstouch-order-item-con .goods-subtotal{
            top: 0rem;
        }
        .product_list{
            display: flex;
            justify-content: space-between;
            font-size: .6rem;
            border: 1px solid #efefef;
            line-height: 2rem;
            background: #fbfbfb;
            height: 2rem;
            overflow: hidden;
            margin: 0 1rem;
        }
        #order-list{
            text-align: center;
        }
        .input-p{
        	width: 80%;
		    height: 1rem;
		    border: 1px solid #ccc !important;
		    text-align: center;
        }
        #submit_p{
        	font-size: .8rem;
		    line-height: 1.5rem;
		    border: 1px solid red;
		    width: 5rem;
		    margin: .2rem auto;
		    background-color: red;
		    border-radius: .2rem;
		    color: white;
        }
        .wid-10{
            width:10%;
        }
        .wid-15{
             width:15%;
         }
        .wid-45{
            width:45%;
        }
        .wid-30{
            width:30%;
        }
        .wid-70{
             width:70%;
         }
        .wid-25{
             width:25%;
         }
        .wid-100{
             width:100%;
         }
        .text-c{
            text-align: center;
        }
        .update{
            background-color: #608cff;
            padding: 0.rem;
            height: 1rem;
            margin-top: .5rem;
            color: #fff;
            border-radius: .2rem;
            line-height: 1rem;
        }
        .in-edit{
            border: 1px solid #afafaf !important;
            border-radius: 0.2rem !important;
            height: 1rem;
            margin-top: .25rem;
        }
        .footnav ul li{
             width: 25%;
         }
        .print{
            background-color: #608cff;
            height: 1rem;
            margin-top: .5rem;
            color: #fff;
            border-radius: .2rem;
            line-height: 1rem;
        }
        .ready{
        	background-color: #ccc;
        }
    </style>
</head>
<body>
<header id="header" class="app-no-fixed">
 <div class="header-wrap">
    <div class="header-l"> <a href="seller.html"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1>扫描</h1>
    </div>
    <div class="header-r"></div>
  </div>
</header>
<div class="sstouch-main-layout">
  <div class="sstouch-order-list">
    <ul id="order-list">
    	<form id="product_info" >
    		<input type="hidden" id="product_id" name="product_id">
    		<input type="hidden" id='item_id' name="item_id">
        <li class="product_list">
            <div class="wid-30">商品名称</div>
            <div class="wid-70"><input type="text" id="product_name" name="product_name" class="input-p"></div>
        </li>
        <li class="product_list">
            <div class="wid-30">条码</div>
            <div class="wid-70"><input type="text" id='item_barcode' name="item_barcode" class="input-p ready" readonly></div>
        </li>
        <li class="product_list">
            <div class="wid-30">进货价</div>
            <div class="wid-70"><input type="text" id='item_cost_price' name="item_cost_price" class="input-p"></div>
        </li>
        <li class="product_list">
            <div class="wid-30">价格</div>
            <div class="wid-70"><input type="text" id='item_unit_price' name="item_unit_price" class="input-p"></div>
        </li>
        <li class="product_list">
            <div class="wid-30">会员价</div>
            <div class="wid-70"><input type="text" id="item_vip_price" name="item_vip_price" class="input-p"></div>
        </li>
        <li class="product_list">
            <div class="wid-30">税率</div>
            <div class="wid-70"><input type="text" id="item_rate" name="item_rate" class="input-p ready" ready></div>
        </li>
        <li class="product_list">
            <div class="wid-30">库存</div>
            <div class="wid-70"><input type="text" id="item_quantity" name="item_quantity" class="input-p"></div>
        </li>
        <li>
        	<div id='submit_p'>保存</div>
        </li>
<!--         <li class="product_list">
            <div class="wid-30">本店分类</div>
            <div class="wid-70"><input type="text" name="" class="input-p"></div>
        </li>
        <li class="product_list">
            <div class="wid-30">供应商</div>
            <div class="wid-70"><input type="text" name="" class="input-p"></div>
        </li>
 -->    	</form>
    </ul>
  </div>
</div>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/libs/sweetalert.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script>
    var product_id=getQueryString("product_id");
    var chain_id = getLocalStorage('chain_id');
    console.log(chain_id);
    if(!chain_id){
        location.href="chain_list.php";
    }
    $(function(){
        if (!ifLogin()){return}
        if (!product_id) {
            location.href="store_goods_list.html";
        }
        $.request({
            type: "post",
            url: SYS.CONFIG.admin_url+'?mdu=seller&ctl=Product_Base&met=getOneLists&typ=json',
            data: {product_id: product_id,chain_id:chain_id},
            dataType: "json",
            success: function(e) {
                if(e.status!=200){
                     $.sTip({
		                "title": '提示',
		                "content": e.msg,
		            });
		            return false;
                }
                var data =e.data.item;
               	$('#product_name').val(data.product_name);
               	$('#product_id').val(data.product_id);
               	$('#item_id').val(data.item_id);
               	$('#item_barcode').val(data.item_barcode);
               	$('#item_cost_price').val(data.item_cost_price);
               	$('#item_unit_price').val(data.item_unit_price);
               	$('#item_vip_price').val(data.item_vip_price);
               	$('#item_rate').val(data.item_rate);
               	$('#item_quantity').val(data.item_quantity);
                //更新
                $('#submit_p').click(function(){
                	var product_name   =$('#product_name').val();
		            var product_id     =$('#product_id').val();
		            var item_id        =$('#item_id').val();
		            var item_barcode   =$('#item_barcode').val();
		            var item_cost_price=$('#item_cost_price').val();
		            var item_unit_price=$('#item_unit_price').val();
		            var item_vip_price =$('#item_vip_price').val();
		            var item_rate      =$('#item_rate').val();
		            var item_quantity  =$('#item_quantity').val();
                    if(item_cost_price<0 || item_unit_price<0 || item_vip_price<0){
                        $.sTip({
                            'title':'警告',
                            "content": "值不能小于0",
                        });
                    }
                    if(!product_id || !item_id){
 						$.sTip({
                            'title':'警告',
                            "content": "缺少商品编号",
                        });
                    }
                    console.log(product_id)
                    console.log(item_id)
                    $.request({
                        type: "post",
                        url: SYS.CONFIG.admin_url+'?mdu=seller&ctl=Product_Base&met=editItem&typ=json',
                        data: {'product_id': product_id,'item_id':item_id,'product_name':product_name,'item_cost_price':item_cost_price,'item_unit_price':item_unit_price,'item_vip_price':item_vip_price,'item_quantity':item_quantity},
                        dataType: "json",
                        success: function(e) {
                        	$.sTip({
	                            'title':'警告',
	                            "content":  e.msg,
	                        });
                        }
                    });
                });
                //打印
                $('.print').click(function(){
                    swal({
                        title: "功能开发中！",
                        text: e.msg,
                        timer: 1000,
                        showConfirmButton: false
                    });
                });
            }
        });
    });

</script>
</body>
</html>

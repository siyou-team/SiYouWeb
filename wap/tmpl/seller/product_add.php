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
		    text-align: left;
        }
        #sub_add{
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
        .wid-60{
            width:60%;
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
        .product_list span{
            color:red;
        }
    </style>
</head>
<body>
<header id="header" class="app-no-fixed">
 <div class="header-wrap">
    <div class="header-l"> <a href="seller.html"> <i class="zc zc-back back"></i> </a> </div>
    <div class="header-title">
      <h1>快速新增</h1>
    </div>
    <div class="header-r"></div>
  </div>
</header>
<div class="sstouch-main-layout">
  <div class="sstouch-order-list">
    <ul id="order-list">
        <li class="product_list">
            <div class="wid-30">商品名称</div>
            <div class="wid-70">
                <input type="text" id="product_name" name="product_name" class="input-p">
                <span>*</span>
            </div>
        </li>
        <li class="product_list">
            <div class="wid-30">条码</div>
            <div class="wid-70">
                <input type="text" id='item_barcode' name="item_barcode" class="input-p" style="width:70%;">
                <img src="../../images/app-index/sys.png" id="scan" style="width:1rem;height:1rem;margin-top:.5rem;">
                <span>*</span>
            </div>
        </li>
        <li class="product_list">
            <div class="wid-30">进货价</div>
            <div class="wid-70"><input type="text" id='item_cost_price' name="item_cost_price" class="input-p"></div>
        </li>
        <li class="product_list">
            <div class="wid-30">价格</div>
            <div class="wid-70"><input type="text" id='item_unit_price' name="item_unit_price" class="input-p"><span>*</span></div>
        </li>
        <li class="product_list">
            <div class="wid-30">会员价</div>
            <div class="wid-70"><input type="text" id="item_vip_price" name="item_vip_price" class="input-p"><span>*</span></div>
        </li>
        <li class="product_list">
            <div class="wid-30">税率</div>
            <div class="wid-70"><input type="text" id="item_rate" name="item_rate" class="input-p"><span>*</span></div>
        </li>
        <li class="product_list">
            <div class="wid-30">库存</div>
            <div class="wid-70"><input type="text" id="item_quantity" name="item_quantity" class="input-p"><span>*</span></div>
        </li>
        <li class="product_list">
            <div class="wid-30">预警库存</div>
            <div class="wid-70"><input type="text" id="item_warn_quantity" name="item_warn_quantity" class="input-p"></div>
        </li>
        <li class="product_list">
            <div class="wid-30">本店分类</div>
            <div class="wid-70" id="cate_ids">

            </div>
        </li>
        <li class="product_list">
            <div class="wid-30">供应商</div>
            <div class="wid-70" id="product_supplier_id">

            </div>
        </li>
        <li class="product_list" style="height:4rem">
            <div class="wid-30">主图：</div>
            <div class="input-box wid-70"  style="height:4rem;line-height: 4rem;">
                <div class="sstouch-upload" style="width:4rem;height: 4rem; border:0px;">
                    <a href="javascript:void(0);">
                        <span>
                          <input type="file"  hidefocus="true" size="1" class="input-file no-follow" id="file_011" name="upfile" style="line-height: 4rem;">
                        </span>
                        <p><i class="icon-upload"></i></p>
                    </a>
                    <input type="hidden"  class=" no-follow" name="product_image" id="product_image" value="">
                </div>
            </div>
        </li>
        <li>
        	<div id='sub_add'>保存</div>
        </li>
    </ul>
  </div>
</div>

<script type="text/html" id="cate_tmp">
    <select name="category_id" id="category_id" class="input-p">
        <% for (var i in cate) { %>
            <option value="<%= cate[i].category_id %>"><%= cate[i].category_name_it %></option>
        <% } %>
    </select>
</script>
<script type="text/html" id="dis_tmp">
    <select name="product_supplier" id="product_supplier" class="input-p">
        <% for (var i in dis) { %>
        <option value="<%= dis[i].store_id %>"><%= dis[i].store_name %></option>
        <% } %>
    </select>
</script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/libs/lib.min.js"></script>
<script type="text/javascript" src="../../js/common.js"></script>
<script>

    $(function(){
        var chain_id = getLocalStorage('chain_id');
        if(!chain_id){
            location.href="chain_list.php";
        }
        if (!ifLogin()){return}
        $.request({
            type: "post",
            url: SYS.CONFIG.index_url+'?ctl=Store&met=storeCate&typ=json',
            data: {
                chain_id: chain_id,
            },
            dataType: "json",
            success: function(e) {
                if(e.status!=200){
                    $.sTip({
                        "title": '提示',
                        "content": e.msg,
                    });
                    return false;
                }else{
                    $('#cate_ids').html(template.render('cate_tmp', e.data));
                    $('#product_supplier_id').html(template.render('dis_tmp', e.data));
                }
            }
        });

        $('#sub_add').click(function(){
            var product_name       =$('#product_name').val();
            var item_barcode       =$('#item_barcode').val();
            var item_cost_price    =$('#item_cost_price').val();
            var item_unit_price    =$('#item_unit_price').val();
            var item_vip_price     =$('#item_vip_price').val();
            var item_rate          =$('#item_rate').val();
            var item_quantity      =$('#item_quantity').val();
            var item_warn_quantity =$('#item_warn_quantity').val();
            var product_image      =$('#product_image').val();
            var category_id        =$('#category_id').val();
            var product_supplier   =$('#product_supplier').val();
            if(!(product_name && item_barcode && item_unit_price && item_rate &&item_vip_price && item_quantity)){
                $.sTip({
                    "title": '提示',
                    "content": '存在必填项未填写',
                });
                return false;
            }
            $.request({
                type: "post",
                url: SYS.CONFIG.admin_url+'?mdu=seller&ctl=Product_Base&met=addProduct&typ=json',
                dataType: 'json',
                data: {
                    'chain_id': chain_id,
                    'product_name': product_name,
                    'item_barcode':item_barcode,
                    'item_cost_price': item_cost_price,
                    'item_unit_price':item_unit_price,
                    'item_vip_price': item_vip_price,
                    'item_rate':item_rate,
                    'item_quantity': item_quantity,
                    'item_warn_quantity':item_warn_quantity,
                    'product_image': product_image,
                    'category_id':category_id,
                    'product_supplier':product_supplier
                },
                success: function(e) {
                    if(e.status!=200){
                         $.sTip({
                           "title": '提示',
                           "content": e.msg,
                         });
                       return false;
                    }else{
                        $.sTip({
                            "title": '提示',
                            "content": e.msg,
                        });
                        return false;
                    }
                }
            });
        });

    });
    $('input[name="upfile"]').ajaxUploadImage({
        url : SYS.URL.upload,
        data:{},
        start :  function(element){
            element.parent().after('<div class="upload-loading"><i></i></div>');
            element.parent().siblings('.pic-thumb').remove();
        },
        success : function(element, result){
            //checkLogin(result.login);
            if (result.status != 200) {
                element.parent().siblings('.upload-loading').remove();
                $.sDialog({
                    skin:"red",
                    content:'图片尺寸过大！',
                    okBtn:false,
                    cancelBtn:false
                });
                return false;
            }
            if(result.data.state!="SUCCESS"){
                $.sTip({
                    "title": '提示',
                    "content": result.data.state,
                });
            }
            element.parent().after('<div class="pic-thumb"><img src="'+result.data.url+'"/></div>');
            element.parent().siblings('.upload-loading').remove();
            element.parents('a').next().val(result.data.url);
        }
    });

    function getAppQrcode(data){
        if(!data){
            $.sTip({
                "title": '提示',
                "content": '未获取到条形码',
            });
            return false;
        }else{
            $('#item_barcode').val(data);
        }
    }
    $('#scan').click(function(){
        appApi.scanQRCode();
    });
</script>
</body>
</html>

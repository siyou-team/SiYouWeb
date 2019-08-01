var leftVal = 0;
var ws = "";
$(function () {
    //init_ocx();
	WebSocketInit();
});

function WebSocketInit()
{
    if ("WebSocket" in window)
    {
        ws = new WebSocket("ws://127.0.0.1:8888");
        ws.onopen = function(){};
       
 	    ws.onclose = function()
        {
            //关闭 websocket
            alertError(__("请打开XyPos.exe，否则打印和客显将不能正常使用！"));
        };
    }
    else
    {
        alert(__("您的浏览器不支持 WebSocket!"));
    }
}

function PrintLodopFuncs(Json, json, ItemsHeaderType, type) 
{
	LODOP = getLodop(document.getElementById('LODOP_OB'), document.getElementById('LODOP_EM'));
	
	if (LODOP != undefined && LODOP != null) 
	{
		if (typeof (LODOP.VERSION) != "undefined") 
		{
			switch (ItemsHeaderType) 
			{
				case 1:
					for (var i = 0; i < shopInfo.TicketCount; i++) {
						QuickConsumption(Json, json, type);
						LODOP.PREVIEW();
						//LODOP.PRINT();
					}
					break;
				case 2:
					for (var i = 0; i < shopInfo.TicketCount; i++) {
						GoodsConsumption(Json, json, type);
						LODOP.PREVIEW();
						//LODOP.PRINT();
					}
					break;
				case 3:
					for (var i = 0; i < shopInfo.TicketCount; i++) {
						MemContinuedTime(Json, json, type);
						LODOP.PREVIEW();
						//LODOP.PRINT();
					}
					break;
				case 4:
					for (var i = 0; i < shopInfo.TicketCount; i++) {
						MemRecharge(Json, json, type);
						LODOP.PREVIEW();
						//LODOP.PRINT();
					}
					//LODOP.PRINT();
					break;
				case 5:
					for (var i = 0; i < shopInfo.TicketCount; i++) {
						GiftExchange(Json, json);
						LODOP.PREVIEW();
						//LODOP.PRINT();
					}
					break;
				case 6:
					for (var i = 0; i < shopInfo.TicketCount; i++) {
						CustomerReturns(Json, json);
						LODOP.PREVIEW();
						//LODOP.PRINT();
					}
					break;
				case 7:
					for (var i = 0; i < shopInfo.TicketCount; i++) {
						RegCard(Json, json);
						LODOP.PREVIEW();
						//LODOP.PRINT();
					}
					break;
			}
		}
	} else {
		alertError(__("getLodop出错!"));
	}
}

//计算偏移量居中
function CalcLeftVal(str) 
{
	var strLength = str.length;
	if (shopInfo.TicketSize == 580) 
	{
		if (strLength >= 14) {
			return 0;
		} 
		else {
			switch (strLength) 
			{
				case 1:  return 91;
				case 2:  return 84;
				case 3:  return 77;
				case 4:  return 70;
				case 5:  return 63;
				case 6:  return 56;
				case 7:  return 49;
				case 8:  return 42;
				case 9:  return 35;
				case 10: return 28;
				case 11: return 21;
				case 12: return 14;
				case 13: return 7;
				default: return 0;
			}
		}
	} else if (shopInfo.TicketSize == 800) {
		if (strLength >= 20) {
			return 0;
		} else {
			switch (strLength) {
				case 1:  return 133;
				case 2:  return 126;
				case 3:  return 119;
				case 4:  return 112;
				case 5:  return 105;
				case 6:  return 98;
				case 7:  return 91;
				case 8:  return 84;
				case 9:  return 77;
				case 10: return 70;
				case 11: return 63;
				case 12: return 56;
				case 13: return 49;
				case 14: return 42;
				case 15: return 35;
				case 16: return 28;
				case 17: return 21;
				case 18: return 14;
				case 19: return 7;
				default: return 0;
			}
		}
		return 112;
	}
}

//#region 快速消费打印
function QuickConsumption(Json, json, type)
{
    //#region 传统模板
    var hPos = 10,//小票上边距  
          pageWidth = shopInfo.TicketSize,//小票宽度  
          rowHeight = 15;//小票行距
    if (json.ShopTitle != "") {
        LODOP.ADD_PRINT_TEXT(hPos, CalcLeftVal(json.ShopTitle), pageWidth, rowHeight, json.ShopTitle);
        hPos += rowHeight;
    }
    if (type == 1) {
        LODOP.ADD_PRINT_TEXT(hPos, CalcLeftVal(__("快速消费（重打印）")), pageWidth, rowHeight, __("快速消费（重打印）"));
    } else {
        LODOP.ADD_PRINT_TEXT(hPos, CalcLeftVal(__("快速消费")), pageWidth, rowHeight, __("快速消费"));
    }
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("会员卡号")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.CardID);
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("会员姓名")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.CardName);
    hPos += rowHeight;
    hPos += rowHeight;

    LODOP.ADD_PRINT_LINE(hPos, 2, hPos, pageWidth, 2, 1);
    hPos += 5;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("消费金额")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.TotalMoney);
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("应付金额")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.DiscountMoney);
    hPos += rowHeight;
    if (Json.data[0].CardID != "0000" && Json.data[0].CardName != __("散客")) {
        LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("获得积分")+":");
        LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.TotalPoint);
        hPos += rowHeight;
    }
    LODOP.ADD_PRINT_LINE(hPos, 2, hPos, pageWidth, 2, 1);
    hPos += 5;

    //
    if (json.PayMoney > 0) {
        LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("余额支付")+":");
        LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.PayMoney);
        hPos += rowHeight;
    }
    if (json.CardID != "0000" && Json.CardName != __("散客") && json.PayPoint > 0) {
        LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("积分支付")+":");
        LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.PayPoint);
        hPos += rowHeight;
    }
    if (json.PayCash > 0) {
        LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("现金支付")+":");
        LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.PayCash);
        hPos += rowHeight;
    }
    if (json.PayUnion > 0) {
        LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("银联支付")+":");
        LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.PayUnion);
        hPos += rowHeight;
    }
    if (json.PayOther > 0) {
        LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("在线支付")+":");
        LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.PayOther);
        hPos += rowHeight;
    }
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("订单号")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 50, pageWidth, rowHeight, json.BillCode);
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("操作员")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 50, pageWidth, rowHeight, json.MasterName);
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("消费时间")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.CreateTime);
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("备注")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 40, pageWidth, rowHeight, json.Remark);
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("联系方式")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.Contact);
    hPos += rowHeight;
    if (pageWidth == 800) {
        LODOP.ADD_PRINT_TEXT(hPos, 1, 278, 180, json.Footer);
    } else {
        LODOP.ADD_PRINT_TEXT(hPos, 1, 180, 180, json.Footer);
    }
    hPos += 80;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("本店由 Siyou technology 提供技术支持"));
    LODOP.SET_PRINT_PAGESIZE(3, pageWidth, 45, __("快速消费"));
    //#endregion
}
//#endregion

//#region 商品消费打印
function GoodsConsumption(Json, json, type) 
{
    var hPos = 0,                         //小票上边距  
        pageWidth = shopInfo.TicketSize,  //小票宽度  
        rowHeight = 15;                   //小票行距
    
	//小票抬头
	if (json.ShopTitle != "") 
	{
        LODOP.ADD_PRINT_TEXT(hPos, CalcLeftVal(json.ShopTitle), pageWidth, rowHeight, json.ShopTitle);
        hPos += rowHeight;
    }

	LODOP.ADD_PRINT_TEXT(hPos, 0, "58mm", rowHeight, json.Address);        //地址
	//LODOP.SET_PRINT_STYLEA(0, "Alignment", 2);
	hPos += rowHeight;
	LODOP.ADD_PRINT_TEXT(hPos, CalcLeftVal(json.Address), pageWidth, rowHeight, "tel "+json.tel); //电话号码
	hPos += rowHeight;
	LODOP.ADD_PRINT_TEXT(hPos, CalcLeftVal(json.Address), pageWidth, rowHeight, __("P.IVA ")+json.tax); //税号

    hPos += rowHeight;
	hPos += 5;
    LODOP.ADD_PRINT_LINE(hPos, 2, hPos, pageWidth, 2, 1);
    
	var leftVal = 80;
    hPos += 5;
    for (var i = 0; i < json.rows1.length; i++) 
	{
        if (json.rows1[i].Name.length < 5 || (pageWidth == 800 && json.rows1[i].Name.length < 11)) {
            LODOP.ADD_PRINT_TEXT(hPos, 1, 140, rowHeight, json.rows1[i].Name);
        } else {
            LODOP.ADD_PRINT_TEXT(hPos, 1, 140, rowHeight, json.rows1[i].Name);
            //hPos += rowHeight;
        }
        LODOP.ADD_PRINT_TEXT(hPos, leftVal, 100, rowHeight, __("￥")+parseFloat(json.rows1[i].Sum));
		LODOP.SET_PRINT_STYLEA(0, "Alignment", 3);
        hPos += rowHeight;
    }

    hPos += 5;
    LODOP.ADD_PRINT_TEXT(hPos, 1, 100, rowHeight, __("消费金额"));
	LODOP.SET_PRINT_STYLEA(0, "Alignment", 1);
    LODOP.ADD_PRINT_TEXT(hPos, leftVal, 100, rowHeight, __("￥")+json.TotalMoney);
	LODOP.SET_PRINT_STYLEA(0, "Alignment", 3);
	
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, 100, rowHeight, __("应付金额"));
    LODOP.ADD_PRINT_TEXT(hPos, leftVal, 100, rowHeight, __("￥")+json.DiscountMoney);
	LODOP.SET_PRINT_STYLEA(0, "Alignment", 3);
	
    hPos += rowHeight;
    if (Json.data[0].CardID != "0000" && Json.data[0].CardName != __("散客")) 
	{
        LODOP.ADD_PRINT_TEXT(hPos, 1, 100, rowHeight, __("获得积分")+":");
        LODOP.ADD_PRINT_TEXT(hPos, leftVal, 100, rowHeight, json.TotalPoint);
		LODOP.SET_PRINT_STYLEA(0, "Alignment", 3);
        hPos += rowHeight;
    }

    if (json.PayMoney > 0) 
	{
        LODOP.ADD_PRINT_TEXT(hPos, 1, 100, rowHeight, __("余额支付")+":");
        LODOP.ADD_PRINT_TEXT(hPos, leftVal, 100, rowHeight, __("￥")+json.PayMoney);
		LODOP.SET_PRINT_STYLEA(0, "Alignment", 3);
        hPos += rowHeight;
    }
    if (json.CardID != "0000" && Json.CardName != __("散客") && json.PayPoint > 0) {
        LODOP.ADD_PRINT_TEXT(hPos, 1, 100, rowHeight, __("积分支付")+":");
        LODOP.ADD_PRINT_TEXT(hPos, leftVal, 100, rowHeight, __("￥")+json.PayPoint);
		LODOP.SET_PRINT_STYLEA(0, "Alignment", 3);
        hPos += rowHeight;
    }
    if (json.PayCash > 0) {
        LODOP.ADD_PRINT_TEXT(hPos, 1, 100, rowHeight, __("现金支付")+":");
        LODOP.ADD_PRINT_TEXT(hPos, leftVal, 100, rowHeight, __("￥")+json.PayCash);
		LODOP.SET_PRINT_STYLEA(0, "Alignment", 3);
        hPos += rowHeight;
    }
    if (json.PayUnion > 0) {
        LODOP.ADD_PRINT_TEXT(hPos, 1, 100, rowHeight, __("银联支付")+":");
        LODOP.ADD_PRINT_TEXT(hPos, leftVal, 100, rowHeight, __("￥")+json.PayUnion);
		LODOP.SET_PRINT_STYLEA(0, "Alignment", 3);
        hPos += rowHeight;
    }
	
	hPos += 5;
	LODOP.ADD_PRINT_LINE(hPos, 2, hPos, pageWidth, 2, 1);
	hPos += 5;
	
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("订单号")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 50, pageWidth, rowHeight, json.BillCode);
    
	hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("操作员")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.MasterName);
    
	hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("时间")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 40, pageWidth, rowHeight, json.CreateTime);
    
	hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("联系方式")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.Contact);
    
	hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("备注")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 40, pageWidth, rowHeight, json.Remark);
	
	hPos += 50;
	var orderNo = json.BillCode.substring(0,2)+"-" + json.BillCode.substring(12);
	LODOP.ADD_PRINT_TEXT(hPos, CalcLeftVal(orderNo), pageWidth, rowHeight, orderNo);
    
	/* hPos += rowHeight;
    if (pageWidth == 800) {
        LODOP.ADD_PRINT_TEXT(hPos, 1, 278, 180, json.Footer);
    } else {
        LODOP.ADD_PRINT_TEXT(hPos, 1, 180, 180, json.Footer);
    } */
    
	hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("本店由 Siyou technology 提供技术支持"));
    LODOP.SET_PRINT_PAGESIZE(3, pageWidth, 45, __("商品消费"));
    //#endregion
}
//#endregion


//#region 礼品兑换
function GiftExchange(Json, json)
{
    //#region 传统模板
    var hPos = 0,//小票上边距  
        pageWidth = shopInfo.TicketSize,//小票宽度  
        rowHeight = 15;//小票行距
    LODOP.ADD_PRINT_TEXT(hPos, CalcLeftVal(__("礼品兑换")), pageWidth, rowHeight, __("礼品兑换"));
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("会员卡号") + ":");
    LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.CardID);
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("会员姓名")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.CardName);
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("会员余额")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.Money);
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("会员积分")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.Point);
    hPos += rowHeight;
    LODOP.ADD_PRINT_LINE(hPos, 2, hPos, pageWidth, 2, 1);
    hPos += 5;
    var addlength_1 = 0;
    var addlength_2 = 0;
    if (pageWidth == 800) {
        addlength_1 = 70;
        addlength_2 = 120;
    }
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("礼品名称"));
    LODOP.ADD_PRINT_TEXT(hPos, 70 + addlength_1, pageWidth, rowHeight, __("数量"));
    LODOP.ADD_PRINT_TEXT(hPos, 110 + addlength_2, pageWidth, rowHeight, __("积分"));
    hPos += rowHeight;
    for (var i = 0; i < json.rows.length; i++) {
        if (json.rows[i].GiftName.length < 4 || (pageWidth == 800 && Json.rows[i].GiftName.length < 11)) {
            LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, json.rows[i].GiftName);
        } else {
            LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, json.rows[i].GiftName);
            hPos += rowHeight;
        }
        LODOP.ADD_PRINT_TEXT(hPos, 70 + addlength_1, pageWidth, rowHeight, json.rows[i].ExcNum);
        LODOP.ADD_PRINT_TEXT(hPos, 115 + addlength_2, pageWidth, rowHeight, json.rows[i].ExcPoint);
        hPos += rowHeight;
    }
    LODOP.ADD_PRINT_LINE(hPos, 2, hPos, pageWidth, 2, 1);
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("兑换数量")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.ExcNum);
    LODOP.ADD_PRINT_TEXT(hPos, 90, pageWidth, rowHeight, __("支付积分")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 150, pageWidth, rowHeight, json.ExcPoint);
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("订单号")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 50, pageWidth, rowHeight, json.BillCode);
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("操作员")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 50, pageWidth, rowHeight, json.MasterName);
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("消费时间")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.CreateTime);
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("备注")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 40, pageWidth, rowHeight, json.Remark);
    hPos += rowHeight;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("联系方式")+":");
    LODOP.ADD_PRINT_TEXT(hPos, 60, pageWidth, rowHeight, json.Contact);
    hPos += 80;
    LODOP.ADD_PRINT_TEXT(hPos, 1, pageWidth, rowHeight, __("本店由 Siyou technology 提供技术支持"));
    LODOP.SET_PRINT_PAGESIZE(3, pageWidth, 45, __("礼品兑换"));
    //#endregion
}



function BarcodePrinting(value,name,price) 
{
	LODOP = getLodop(document.getElementById('LODOP_OB'), document.getElementById('LODOP_EM'));
	var hPos = 10,        //小票上边距  
		pageWidth = 580,  //小票宽度  
		rowHeight = 20;   //小票行距
	
	if (typeof (LODOP.VERSION) != "undefined") 
	{
		LODOP.ADD_PRINT_BARCODE(hPos, 0, 200, 100, "128Auto", value);
		LODOP.SET_PRINT_PAGESIZE(3, pageWidth, 45, __("打印条形码"));

		hPos += 110;
		LODOP.ADD_PRINT_TEXT(hPos, 3, pageWidth, 260, "" + value + "");
		LODOP.SET_PRINT_STYLEA(0, "Alignment", 3);
		LODOP.SET_PRINT_STYLEA(0, "FontSize", 8);
		
		LODOP.SET_PRINT_STYLE("FontSize", 14);   //字体大小
		LODOP.ADD_PRINT_TEXT(hPos, 2, 200, 280, name);
		
		hPos += rowHeight;
		LODOP.SET_PRINT_STYLE("FontSize", 14); //字体大小
		LODOP.ADD_PRINT_TEXT(hPos, 3, 200, 300, __('￥'))
		LODOP.ADD_PRINT_TEXT(hPos, 50, 200, 300, price);
 
		LODOP.PREVIEW();
		//LODOP.PRINT();      
	}
}

function init_ocx()
{ 
	if(document.getElementById("ocx"))
	{
		document.getElementById("ocx").innerHTML = "<object id=\"order\" style=\"width: 0px;height: 0px\" classid=\"CLSID:B72CA6E3-F35B-4BF1-B0F0-456A2F84CE7C\" CODEBASE=\"order.CAB\"></object>";
	}else{
		var ocx = document.createElement("div");
		ocx.setAttribute("id","ocx");
		document.documentElement.appendChild(ocx);
		
		document.getElementById("ocx").innerHTML = "<object id=\"order\" style=\"width: 0px;height: 0px\" classid=\"CLSID:B72CA6E3-F35B-4BF1-B0F0-456A2F84CE7C\" CODEBASE=\"order.CAB\"></object>";
	} 		
}

function GoodsOrderPrint(Json, json, type)
{
	try{   
		var date = new Date();
		var time = date.format('yyyyMMddhms');
		var html = time+".txt";
		for (var i = 0; i < json.rows1.length; i++) 
		{		
			var n = i+1;
			var name = json.rows1[i].goods_name.replace('/', '~');
			//3/S/产品名称//产品数量/产品价格/1//
			html += 'xunyou3/S/'+name+'//'+json.rows1[i].goods_number+'/'+json.rows1[i].goods_price+'/'+n+'//';
			
			if(json.rows1[i].discount_amount > 0)
			{
				html += 'xunyou' + '4/'+json.rows1[i].discount_amount+'///0/0/1/';
			}
		}
		html += 'xunyou5/1/0.00////';
		var url = 'http://127.0.0.1/'+html;

		$.ajax({
            url: url,
            type: "get",
            async: true,
            data: {},
			dataType: 'json',
			success: function (data) {}
		});
	}catch(e){   
		alert("没有注册");
	} 
}

function ReturnOrderPrint(json)
{
	try{   
		var date = new Date();
		var time = date.format('yyyyMMddhms');
		var html = time+"R.txt";
		for (var i = 0; i < json.length; i++) 
		{			
			var n = i+1;
			var name = json[i].goods_name.replace('/', '~');
			//3/S/产品名称//产品数量/产品价格/1//
			html += 'xunyou3/R/'+name+'//'+json[i].return_quantity+'/'+json[i].return_price+'/'+n+'//';
		}
		html += 'xunyou5/1/0.00////';
		var url = 'http://127.0.0.1/'+html;

		$.ajax({
            url: url,
            type: "get",
            async: true,
            data: {},
			dataType: 'json',
			success: function (data) {}
		});
	}catch(e){   
		alert("没有注册");
	} 
}
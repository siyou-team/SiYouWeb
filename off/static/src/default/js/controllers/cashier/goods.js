var ws = "";
$(function () {
	WebSocketInit();
	
    GoodsCashier.init();
    $(".portfolioFilter a").on("click", function () {
        $(".portfolioFilter  .current").removeClass("current");
        $(this).addClass("current");
    });
})

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

var del = null;
var GoodsCashier = {
    oldPrice: 0, //改变前原单价
    Type: 0,     //产品类型
    TotalPage: 0,
    flag: false,
    GoodsClassIndex: 1,//当前商品分类索引
    GoodsClassdefaultSize: 3,
    GoodsClassMaxIndex: 0,
    PayTotalMoney: 0,//消费总额
    DiscountMoney: 0,//折后金额
    isAllCountPay: false,
    isReviseNumberModalHide: true,// 购物车数量和
    isCheckNumberModal: 0,
    edition: "",
    ShoppingCartRow: [],//购物车一行的数据  用于编辑时候计算积分
    AllGoodsMarkets: [],//所有商品营销 不包含会员生日营销
    MemBirthGoodsMarkets: [],//会员生日营销
    AllMarketGoods: [],//营销后商品及价格
    InStockGoodsList: [],//库存不足 需入库的商品信息
    IsClearGoodsList: 0,//是否需清空页面缓存的商品信息
    //会员信息
    memInfo: Object,
    SearchData: {
        pageIndex: 1,
        pageRows: 10,
        goods_cat_id: '',
        goods_type: -1,
        goodsCode: $("#goodsCode").val().trim()
    },
    activitySelectedInfo: new Object(),//选择的优惠集合
    activityArry: new Array(),//查询的优惠活动集合
    goodsData: [],
    realGoodsData: [],
    countData: [],
    goodsList: [],
    cucter: "",
    staffArry: new Array(),
    orderLog: {     
        orderData: [],  //订单详细数据     
        Id: '', //订单Id        
        IsResting: 1, //是否挂单      
        HandCode: '', //手牌号     
        staffId: '',  //提成员工Id        
        Mobile: '', //会员手机号      
        MemID: '', //会员       
        CardID: '0000', //会员卡号，默认为散客 0000   
        CardName: __('散客'), //会员姓名
        member_grade_discountrate: 1,
        member_grade_pointsrate: 0,       
        Remark: '', //备注        
        PayCash: 0, //现金支付        
        PayMoney: 0, //余额支付        
        PayOther: 0, //其他支付方式        
        PayPoint: 0, //积分支付        
        PayUnion: 0, //银联支付        
        PayPointNum: 0, //积分支付数量        
        TotalMoney: 0, //消费金额        
        DiscountMoney: 0, //折后金额        
        PayType: '', //支付方式
        PayOtherType: '', //总积分        
        TotalPoint: 0,        
        GoodsNum: 0, //产品数量        
        Volumeids: '', //优惠券ID       
        VolumeMoney: 0.00, //优惠金额
        isSMSSend: 0,      //勾选发送短信 
        OriginalMoney: 0,
        IsMarket: 0,
    },
    /*** 临时记录行数据**/
    tmpRow: {
        BatchCode: "",
        goods_id: 0,
        goods_code: "",
        goods_name: "",
        goods_type: "",
        Qty: 0,             //数量
        UnitPrice: 0,       //商品单价
        TotalMoney: 0,      //商品总金额
        goods_price: 0,     //折扣单价
        Sum: 0,             //折扣总金额
        PriceUnit: 0,       //计时单位
        PriceNum: 0,        //计时密度 
        StartTime: "",      //计时产品开始时间
        EndTime: "",        //计时产品结束时间
        goods_is_points: 0,         //是否积分
        member_grade_pointsrate: 0,    //积分比例
        Count: 0,           //有数量限制的商品数量限制
        Point: 0,           //积分数量
        Staff: [],           //提成员工
        StaffList: "",
        goods_cat_id: "",
        GoodsMarketingId: "",
		goods_cost:0 ,//商品进货价
		goods_discount:0
    },
    init: function () 
	{
        var obj = this;
        $('[data-toggle="popover"]').popover();

        var request = GetRequest();
        if (request.CardID != undefined) 
		{
            MemberSelect.memberInfo(request.CardID);
        }

        obj.loadGoodsData();
        obj.event();
        obj.bindCartTable();
 
        if (sysParameter.is_modify_price != 1) 
		{
            $("#lbl_Price").attr('readonly', 'readonly');
        }
 
        if(obj.TotalPage > 10)
		{
			$('#edt_PageInit').show();
		}else{
			$('#edt_PageInit').hide();
		}
		
        $('#edt_PageInit').page({
            leng: parseInt((obj.TotalPage + obj.SearchData.pageRows - 1) / obj.SearchData.pageRows),//分页总数
            activeClass: 'actives', //active 类样式定义
            clickBack: function (page) {
                obj.SearchData.pageIndex = page;
                obj.loadGoodsData();
            }
        });
		
		//快速增加产品操作
		$('#btn-add-goods').on('click', function () 
		{
			//getCatTree('goods_cat');
			$('#addGoodsModal').modal({ backdrop: 'static', keyboard: false });
			$("#addGoodsForm")[0].reset();
        });
		
		$("#addGoodsForm").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                goods_code: {
                    validators:
                        {
                            notEmpty: {
                                message: __("产品编号不能为空")
                            },
                            regexp: {
                                regexp: /^[\w\s]+$/,
                                message: __("产品编号只能为字母和数字")
                            },
                            stringLength: {
                                min: 2,
                                max: 50,
                                message: __('产品编号长度为2~50位')
                            }
                        }
                },
                /* goods_name: {
                    validators:
                        {
                            notEmpty: {
                                message: __("产品名称不能为空")
                            }

                        }
                }, */
                goods_price: {
                    validators:
                        {
                            notEmpty: {
                                message: __("零售价格不能为空")
                            },
                            regexp: {
                                regexp: /^(0(?:[.](?:[0-9]\d?|0[0-9]))|[0-9]\d*(?:[.]\d{1,2}|$))$/,
                                message: __('请输入数字并且小数点后2位')
                            },
                            between:
                            {
                                min: 0,
                                max: sysParameter.unit_price*10000,
                                message: __('零售价格最低为0且不能超过') + sysParameter.unit_price + __('万')
                            }
                        }
                }/* ,
                goods_cost: {
                    validators:
                        {
                            regexp: {
                                regexp: /^(0(?:[.](?:[0-9]\d?|0[0-9]))|[0-9]\d*(?:[.]\d{1,2}|$))$/,
                                message: __('请输入数字并且小数点后2位')
                            },
                            between:
                            {
                                min: 0,
                                max: sysParameter.unit_price * 10000,
                                message: __('参考进价最低为0且不能超过' )+ sysParameter.unit_price+ __('万')
                            }
                        }
                },
                goods_vip_price: {
                    validators:
                        {
                            regexp: {
                                regexp: /^(0(?:[.](?:[0-9]\d?|0[0-9]))|[0-9]\d*(?:[.]\d{1,2}|$))$/,
                                message: __('请输入数字并且小数点后2位')
                            },
                            between:
                            {
                                min: 0,
                                max: sysParameter.unit_price * 10000,
                                message: __('产品会员价最低为0且不能超过') + sysParameter.unit_price+ __('万')
                            }
                        }
                } */
            }
        }).on("success.form.bv", function (e) {
            e.preventDefault();
            var isSubmit = true;
            var data = $("#addGoodsForm").serializeObject();
            var isSubmit = true;
            if ($("#goods_code").val() == "") {
                alertError(__("产品编号不能输入为空"));
                isSubmit = false;
                return;
            }
 
           /*  if ($("#goods_cat").val() == null) 
			{
                alertError(__("请先添加产品类别"));
                isSubmit = false;
                return;
            } */
			
            if (isSubmit) 
			{
                
                var url = SYS.CONFIG.index_url + '?ctl=Goods_Base&met=add&typ=json';
				
                $.ajax({
					url: url,
					type: 'post',
					data: data,
					dataType: "json",
					success: function (data) 
					{
						if (data && data.status == 200) 
						{
							alertMessage(__("添加成功"));
							$('#addGoodsForm').data('bootstrapValidator').resetForm(true);//验证重置
							$('#addGoodsModal').modal('hide');
							obj.loadGoodsData();
							obj.goodsList[data.data.goods_id] = data.data;
							obj.goodsData.push(data.data);
							obj.addGoodsCart(data.data.goods_id,1);
						} else {
							alertError(data.msg);
						}
					}
				});
            }
        });
    },
    event: function () 
	{
        var obj = this;
 
        var a = new Object();
        $("#goodsCode").on('keyup', function (event) 
		{
            event = arguments.callee.caller.arguments[0] || window.event
            if (event.keyCode == 13) {
                obj.SearchData.goods_cat_id = "";
                obj.SearchData.pageIndex = 1;
                $("#Allcurrent").siblings().removeClass("current"); //siblings() 获得匹配集合中每个元素的同胞，通过选择器进行筛选是可选的。
                obj.loadGoodsData();
                $("#goodsCode").val("");
                obj.pageList();
            }
        });
 
        //付款模态框
        $("#edt_Pay").bind('click', function () {
            if (obj.orderLog.orderData < 1) {
                alertError(__("请选择商品"));
                return;
            }
            //判断库存
            obj.checkgoods_stock();
            if (!obj.flag) return;
 
            //初始化计算购物车
            obj.loadFooter();
            //计算优惠活动
            //obj.calcPayMoney();
            if (obj.orderLog.DiscountMoney > sysParameter.total_price * 10000) {
                alertError(__("单笔消费金额不能超过") + sysParameter.total_price + __("万")+'!');
                return false;
            }
            if (obj.memInfo != Object) {
                PayFuKuan.ConsumptionIdentification = 3;
                PayFuKuan.DiscountMoney = obj.orderLog.DiscountMoney;
                PayFuKuan.PayTotalMoney = obj.orderLog.TotalMoney;
                PayFuKuan.MemCardId = obj.memInfo.Id;
                PayFuKuan.MemCardPoint = obj.memInfo.member_points;
                PayFuKuan.MemCardMoney = obj.memInfo.member_money;
                PayFuKuan.activitySelectedInfoId = obj.activitySelectedInfo.Id;
                obj.orderLog.ActivityID = obj.activitySelectedInfo.Id;
                PayFuKuan.InitialAssignment();
            } else {
                PayFuKuan.ConsumptionIdentification = 3;
                PayFuKuan.DiscountMoney = obj.orderLog.DiscountMoney;
                PayFuKuan.PayTotalMoney = obj.orderLog.TotalMoney;
                PayFuKuan.MemCardId = "";
                PayFuKuan.MemCardPoint = 0;
                PayFuKuan.MemCardMoney = 0;
                PayFuKuan.activitySelectedInfoId = obj.activitySelectedInfo.Id;
                obj.orderLog.ActivityID = obj.activitySelectedInfo.Id;
                PayFuKuan.InitialAssignment();
            }
            obj.orderLog.FlowNo = "";
            obj.orderLog.Remark = $("#txtare_Remark").val();
             
            $('#PayCheckOutModal').modal({ show: true, backdrop: 'static' });
			
			try{
				ws.send(obj.orderLog.DiscountMoney);
			}catch(ex){
				alert(ex.message);
			}
			/* try{   
				var ocx = document.getElementById("TestOCX");
				ocx.SetPrice(obj.orderLog.DiscountMoney);//返回true or false
			}   
			catch(e)   
			{   
				//alert("没有注册");
			}  */
        });
		
        //搜索产品
        $("#edt_Search").bind('click', function () {
            obj.SearchData.goods_cat_id = "";
            $("#Allcurrent").siblings().removeClass("current"); //siblings() 获得匹配集合中每个元素的同胞，通过选择器进行筛选是可选的。
            obj.SearchData.pageIndex = 1;
            obj.loadGoodsData();
            obj.pageList();

        });
  
        //散客手牌号查询回车事件
        $("#edt_HandIdByUnfinished").bind('keydown', function (e) {
            var curKey = e.keyCode;
            if (curKey == 13) {
                e.preventDefault();
                $("#tbl_UnfinishedOrders").bootstrapTable('refresh');
            }
        });
 
        //绑定散客
        $("#edt_Sk").bind('click', function () {
            obj.TableEmpty();
        });
        //新增会员
        $("#edt_AddMem").bind('click', function () 
		{
            window.location.href = SYS.CONFIG.index_url + '?ctl=Member_Info&met=manage&typ=e&flag=1';
        });
         
        //清空操作
        $("#edt_ClearTable").bind('click', function () {
            obj.clearObJOrderLog(1);
        });

        //修改数量计算
        $('#edt_Qty').on('focus change keyup', function () {
            //如果是计时产品 则不计算合计
            if ($("#lbl_Price").attr("isTimeGoods") == 'true') {
                return;
            }
            if ($("#Revisecount").val() < 0) {
                return;
            }

            if (!isNaN($(this).val()) && $(this).val().trim() != "") {
                $("#lbl_TotalMoney").val(MoneyPrecision((parseFloat($(this).val()) * parseFloat($("#lbl_Price").val())).toFixed(2)));
                obj.ShoppingCartRow.Qty = $(this).val() - 0;
                obj.ShoppingCartRow.goods_price = $("#lbl_Price").val() - 0;
                var tmpPoint = obj.GetGoodsPoint(obj.ShoppingCartRow) - 0;
                $('#edt_Point').val(tmpPoint);
            } else {
                $('#edt_Point').html(__('￥') + 0.00);
                $("#lbl_TotalMoney").val(0.00);
            }
        });
        //修改单价计算
        $('#lbl_Price').on('focus change keyup', function () {
            if (obj.Type != 5) {
                if ($("#lbl_Price").val() > sysParameter.unit_price * 10000) {
                    $("#lbl_Price").val(obj.oldPrice);
                    alertError(__("价格不能超过") + sysParameter.unit_price + __("万"));
                }
            } else { //改变原单价 判断是否是套餐  套餐50万   其他20万
                if ($("#lbl_Price").val() > sysParameter.unit_price * 10000) {
                    $("#lbl_Price").val(obj.oldPrice);
                    alertError(__("价格不能超过") + sysParameter.unit_price + __("万"));
                }
            }
            //如果是计时产品 则不计算合计
            if ($("#lbl_Price").attr("isTimeGoods") == 'true') {
                return;
            }

            if (!isNaN($(this).val()) && $(this).val().trim() != "") {
                $("#lbl_TotalMoney").val(MoneyPrecision((parseFloat($(this).val()) * parseInt($("#edt_Qty").val())).toFixed(2)));
                obj.ShoppingCartRow.Qty = $("#edt_Qty").val() - 0;
                obj.ShoppingCartRow.goods_price = $(this).val() - 0;
                var tmpPoint = obj.GetGoodsPoint(obj.ShoppingCartRow) - 0;
                $('#edt_Point').val(tmpPoint);
            } else {
                $("#lbl_TotalMoney").val(0.00);
            }
        });

        //修改小计计算
        $('#lbl_TotalMoney').on('focus change keyup', function () {
            if ($("#lbl_TotalMoney").val() > sysParameter.total_price * 10000) {
                $("#lbl_TotalMoney").val(obj.oldPrice);
                alertError(__("商品小计不能超过") + sysParameter.total_price + __("万"));
            }
            //如果是计时产品 则不计算合计
            if ($("#lbl_Price").attr("isTimeGoods") == 'true') {
                return;
            }

            if (!isNaN($(this).val()) && $(this).val().trim() != "") {
                var totalPrice = parseFloat($(this).val());
                var unitPrice = parseFloat($("#lbl_Price").val());
                obj.ShoppingCartRow.Qty = Math.round((totalPrice / unitPrice) * 100) / 100;
                $("#edt_Qty").val(obj.ShoppingCartRow.Qty);

                var tmpPoint = obj.GetGoodsPoint(obj.ShoppingCartRow) - 0;
                $('#edt_Point').val(tmpPoint);
            }
        });

        //修改数量modal提交
        $("#ReviseNumberForm").bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon',
                invalid: 'glyphicon',
                validating: 'glyphicon'
            },
            fields: {
                goods_price: {
                    validators:
                    {
                        notEmpty: {
                            message: __("请输入单价")
                        },
                        regexp: {
                            regexp: /^(0|[1-9]\d*)(\.\d{1,3})?$/,
                            message: __("只能输入1~8位数(包括小数点后)")
                        }
                    }
                },
                Qty: {
                    validators:
                    {
                        notEmpty: {
                            message: __("请输入数量!")
                        },
                        regexp: {
                            regexp: /^[0-9]\d*(?:[.]\d{1,3}|$)$/,
                            message: __("数量只能输入大于等于0的整数且最多三位小数")
                        },
                        callback: {
                            message: __('超出可用数量'),
                            callback: function (value, validator) 
							{
                                if (1) 
								{
                                    var currtQty;
                                    var tmpQty = parseFloat($("#edt_Qty").val());
                                    for (var i = 0; i < obj.orderLog.orderData.length; i++) 
									{//判断是否是计次产品
                                        var item = obj.orderLog.orderData[i];
                                        var vKey = item.goods_type + "^" + item.goods_id;
                                        if (vKey == $("#ReviseNumberLabel").attr('atuoid')) {
                                            currtQty = item.Qty;
                                            if (vKey == (4 + "^" + item.goods_id)) {
                                                if ((tmpQty - 0) > item.Count) {
                                                    return false;
                                                }
                                            }
                                        }
                                    }
                                    for (var i in obj.goodsList) 
									{
                                        var item = obj.goodsList[i];
                                        var vKey = item.goods_type + "^" + item.goods_id;
                                        if (vKey == $("#ReviseNumberLabel").attr('atuoid')) 
										{
                                            if (item.goods_type == 1 || item.goods_type == 5) 
											{
                                                if (item.goods_stock >= 0) {
                                                    if ((tmpQty - 0) > (item.goods_stock + (currtQty - 0))) {
                                                        return false;
                                                    }
                                                }
                                            }

                                            if (item.goods_type == 5) {
                                                var ComboDetailJson = obj.goodsList[item.goods_id].combo_detail;//JSON.parse(obj.goodsList[item.goods_id].combo_detail);
                                                for (var i = 0; i < ComboDetailJson.length; i++) {
                                                    var json = ComboDetailJson[i];
                                                    var Id = json.Id;
                                                    var Qty = json.Qty;
                                                    var Type = json.goods_type;
                                                    if (Type == 1) {
                                                        if (obj.goodsList[Id].goods_stock + (Qty - 0) * (currtQty - 0) < (tmpQty - 0)) {
                                                            return false;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                return true;
                            }
                        }
                    }
                },
                TotalMoney: {
                    validators:
                    {
                        notEmpty: {
                            message: __("请输入商品小计")
                        },
                        regexp: {
                            regexp: /^(0|[1-9]\d*)(\.\d{1,3})?$/,
                            message: __("只能输入1~8位数(包括小数点后)")
                        }
                    }
                }
            }
        }).on("success.form.bv", function (e) {
            e.preventDefault();
            if (obj.isCheckNumberModal == 0) 
			{
                //GoodsCashierStaffInit.checkStaff();
                $.each(obj.orderLog.orderData, function (index, item) 
				{
                    var vKey = item.goods_type + "^" + item.goods_id;
                    if (vKey == $("#ReviseNumberLabel").attr('atuoid')) {
                        var tmpQty = parseFloat($("#edt_Qty").val()) - 0;
                        var tmpSum = parseFloat($("#edt_Qty").val()) * parseFloat($("#lbl_Price").val()) - 0;
                        var unitPrice = parseFloat($("#lbl_Price").val()) - 0;
                        if (item.goods_type != 3) 
						{
                            if (item.goods_type == 1 && obj.goodsList[item.goods_id] != null) 
							{
                                obj.goodsList[item.goods_id].goods_stock = accSub(accAdd(obj.goodsList[item.goods_id].goods_stock, (item.Qty - 0)), (tmpQty - 0));
                            }

                            if (item.goods_type == 5) {
                                var ComboDetailJson = obj.goodsList[item.goods_id].combo_detail;//JSON.parse(obj.goodsList[item.goods_id].combo_detail);
                                for (var i = 0; i < ComboDetailJson.length; i++) {
                                    var json = ComboDetailJson[i];
                                    var Id = json.Id;
                                    var Qty = json.Qty;
                                    var Type = json.goods_type;
                                    if (Type == 1) {
                                        obj.goodsList[Id].goods_stock = accSub(accAdd(obj.goodsList[Id].goods_stock, accMul((item.Qty - 0), Qty)), accMul((tmpQty - 0), Qty));
                                    }
                                }
                            }

                            item.Qty = tmpQty - 0;
                            item.Sum = tmpSum - 0;
                            item.goods_price = unitPrice;
                            item.UnitPrice = obj.goodsList[item.goods_id].goods_price;
                            item.TotalMoney = MoneyPrecision(accMul(tmpQty, parseFloat(item.UnitPrice))) - 0;
                            item.Point = obj.GetGoodsPoint(item) - 0;
                        }
                 
                    }
                });
                //加载订单数据
                obj.loadCartData();
                //加载脚部合计
                obj.loadFooter();
                //obj.calcPayMoney();
                $("#ReviseNumberForm")[0].reset();
                $('#ReviseNumberForm').data('bootstrapValidator').resetForm(true); //验证重置

                obj.ShowUpdateNumOrStaffCommission();
            }
            obj.isCheckNumberModal++;
        });
        $('#TempleStayModal').on('hide.bs.modal', function () {
            //挂单关闭
            $("#TempleStayForm")[0].reset();
            $('#TempleStayForm').data('bootstrapValidator').resetForm(true); //验证重置
        });
        //提成右框关闭
        $("#edt_ReviseNumberClose").bind('click', function () {
            $("#ReviseNumberForm")[0].reset();
            $('#ReviseNumberForm').data('bootstrapValidator').resetForm(true); //验证重置

            obj.ShowUpdateNumOrStaffCommission();
        });
    },
    //打印
    PrintXP: function (json, d, PrintTemplateList) {
        json.ShopTitle = shopInfo.PrintTitle;
		json.Address = shopInfo.Address;
		json.tel = shopInfo.tel;
		json.tax = shopInfo.tax;
			
        var data = $.extend({}, json);
        json.rows1 = []; // 普通商品/套餐 1 5 
        var Json = {};
        Json.data = [];
        Json.data.push(data);
        Json.rows1 = [];
        Json.rows1 = json.rows1;
		GoodsOrderPrint(Json, data, 2, 0);
    },
    //弹出框加载所有的会员信息
    MemModel: function () 
	{
        MemberSelect.memberModel(103);
    },
    //关闭支付界面
    closePayCheckOutModal: function () {
        var obj = this;
        $("#img-buffer").removeAttr("src");
        $("#PayCheckOutModal").modal("hide");
        $("#myModalPay").modal("hide");
        obj.clearObJOrderLog();
    },
    clearObJOrderLog: function (type) { //清空购物车模型
        var obj = this;
		
		if(type == 1){
			Layer.confirm({ message: __('是否确定清空购物车') + '' }).on(function (e)
			{
				if (!e) {return;}
				obj.clearCart(type);
			});
		}else{
			obj.clearCart(type);
		}
    },
	clearCart: function(type){
		var obj = this;
		$("#txtare_Remark").val('');
		obj.staffArry = new Array();
		obj.orderLog.Id = "";
		obj.orderLog.IsResting = 1;
		if (type == 1 && obj.orderLog.CardID != "0000" && obj.memInfo.CardID != undefined && obj.orderLog.CardID == obj.memInfo.CardID) {
			//obj.orderLog.BillCode = "";
		} else {
			obj.orderLog.BillCode = "";
		}

		obj.orderLog.HandCode = "";
		obj.orderLog.staffId = "";
		obj.orderLog.Remark = "";
		obj.orderLog.ActivityID = "";
		obj.orderLog.PayCash = 0;
		obj.orderLog.PayMoney = 0;
		obj.orderLog.PayOther = 0;
		obj.orderLog.PayPoint = 0;
		obj.orderLog.PayUnion = 0;
		obj.orderLog.PayPointNum = 0;
		obj.orderLog.TotalMoney = 0;
		obj.orderLog.DiscountMoney = 0;
		obj.orderLog.OriginalMoney = 0;
		obj.orderLog.PayType = "";
		obj.orderLog.PayOtherType = "";
		obj.orderLog.TotalPoint = 0;
		obj.orderLog.GoodsNum = 0;
		obj.orderLog.Volumeids = "";
		obj.orderLog.VolumeMoney = 0.00;
		for (var i = 0; i < obj.orderLog.orderData.length; i++) {
			var item = obj.orderLog.orderData[i];
			if (item.goods_type == 1 && obj.goodsList[item.goods_id] != null) {
				obj.goodsList[item.goods_id].goods_stock = obj.goodsList[item.goods_id].goods_stock + (item.Qty - 0);
			}

			if (item.goods_type == 5) {
				var ComboDetailJson = obj.goodsList[item.goods_id].combo_detail;//JSON.parse(obj.goodsList[item.goods_id].combo_detail);
				for (var i = 0; i < ComboDetailJson.length; i++) {
					var json = ComboDetailJson[i];
					var Id = json.Id;
					var Qty = json.Qty;
					var Type = json.goods_type;
					if (Type == 1) {
						obj.goodsList[Id].goods_stock = obj.goodsList[Id].goods_stock + (Qty - 0) * (item.Qty - 0);
					}
				}
			}
		}
		obj.orderLog.orderData = [];
		obj.loadCartData();
		obj.loadFooter();
	},
    //重新计算购物车
    calcBuyCart: function(){
        var obj = this;
        var row = {};
        $.each(obj.orderLog.orderData, function (index, item) 
		{
            if (item.goods_type != 3) 
			{
                item.goods_price = obj.CalculationSpecial(obj.goodsList[item.goods_id]);
                item.Sum = MoneyPrecision(accMul(item.Qty, item.goods_price));
                row.goods_price = item.goods_price;
                row.Qty = item.Qty;
                row.member_grade_pointsrate = obj.goodsList[item.goods_id].goods_points_type;
                row.goods_is_points = obj.goodsList[item.goods_id].goods_is_points;
                item.Point = obj.GetGoodsPoint(row);

				if(obj.MemInfo != Object && obj.memInfo.LevelInfo != null && item.goods_is_discount)
				{
					item.goods_discount = obj.memInfo.LevelInfo.member_grade_discountrate;
				}
            }

        });

        obj.loadFooter(); //加载
        obj.loadCartData();
    },
	/*
    * 清空临时行数据
    **/
    ClearTmpRow: function () {
        var obj = this;
        obj.tmpRow.goods_id = 0;
        obj.tmpRow.goods_code = "";
        obj.tmpRow.goods_name = "";
        obj.tmpRow.goods_type = ""; //OrderDetail.goods_type, 1、普通商品 | 2、服务类商品 | 3、计时场地 | 4、计次产品
        obj.tmpRow.UnitPrice = 0; //商品单价
        obj.tmpRow.TotalMoney = 0; //商品总金额
        obj.tmpRow.goods_price = 0;
        obj.tmpRow.PriceUnit = 0; //计时单位
        obj.tmpRow.PriceNum = 0; //计时密度 
        obj.tmpRow.Qty = 0;
        obj.tmpRow.Sum = 0;
        obj.tmpRow.StartTime = "";
        obj.tmpRow.EndTime = "";
        obj.tmpRow.goods_is_points = 0;
        obj.tmpRow.member_grade_pointsrate = 0;
        obj.tmpRow.Point = 0;
        obj.tmpRow.Count = 0;
        obj.tmpRow.Staff = [];
		obj.tmpRow.goods_cost = 0;
		obj.tmpRow.goods_discount = 0;
		obj.tmpRow.goods_tax_rate = 0;
    },
    //点击产品时加载到产品购物车 - bx
    addGoodsCart: function (goods_id, goods_type)
    {
        var obj = this;
        var isNew = true;
        var vKey = goods_type + "^" + goods_id;
        var Count = obj.goodsList[goods_id].goods_stock;
        var goodsInfo = {};
        var flg = true;

        flg = obj.CheckCartStock(goods_id, goods_type, Count);

        if (flg) 
		{
            //遍历购物车，是否存在产品；存在，数量+1
            for (var i = 0; i < obj.orderLog.orderData.length; i++) 
			{
                var tRow = obj.orderLog.orderData[i];
                if (vKey == (tRow.goods_type + "^" + tRow.goods_id)) 
				{
                    var f = obj.CheckCartStock(goods_id, tRow.goods_type, Count);
                    if (!f) 
					{
                        return;
                    }
                    obj.SetCartStock(goods_id, goods_type, 1);

                    tRow.Qty = (tRow.Qty - 0) + 1;
                    tRow.Sum = MoneyPrecision(accMul(tRow.Qty, tRow.goods_price)); //折后总价
                    tRow.TotalMoney = MoneyPrecision(accMul(tRow.Qty, tRow.UnitPrice)); //不打折总价
                    tRow.Point = obj.GetGoodsPoint(tRow);
                    tRow.Count = obj.goodsList[goods_id].goods_stock;
					tRow.goods_cost = obj.goodsList[goods_id].goods_cost*tRow.Qty-0;
					if(obj.MemInfo != Object && obj.memInfo.LevelInfo != null && obj.goodsList[goods_id].goods_is_discount)
					{
						tRow.goods_discount = obj.memInfo.LevelInfo.member_grade_discountrate;
					}
                    isNew = false;
                    break;
                }
            }
			
            if (isNew) 
			{ 
				//新增的情况
                obj.ClearTmpRow(); //清空模型然后在商品集合里面找对应的对象
                for (var i = 0; i < obj.goodsData.length; i++) 
				{ 	
					//找到这个商品对象
                    var tRow = obj.goodsData[i];
                    if (goods_id == (tRow.goods_id)) 
					{ 
						//在商品里面是Id 在模型里面是goods_id
                        goodsInfo = tRow;
                        break;
                    }
                }
				
                var f1 = obj.CheckCartStock(goods_id, goods_type, Count);
                if (!f1) 
				{
                    return;
                }
				
                obj.SetCartStock(goods_id, goods_type, 1);

                obj.tmpRow.goods_type = goods_type; //商品属性
                obj.tmpRow.goods_id = goodsInfo.goods_id;
                obj.tmpRow.goods_code = goodsInfo.goods_code;
                obj.tmpRow.goods_name = goodsInfo.goods_name;
                obj.tmpRow.Qty = 1;
                obj.tmpRow.UnitPrice = goodsInfo.goods_price; //商品单价
                obj.tmpRow.TotalMoney = goodsInfo.goods_price; //商品总金额
                obj.tmpRow.goods_price = obj.CalculationSpecial(goodsInfo); //折后单价 - wait edit
                obj.tmpRow.Sum = obj.tmpRow.goods_price; //折后总金额
                obj.tmpRow.goods_is_points = goodsInfo.goods_is_points;
                obj.tmpRow.member_grade_pointsrate = goodsInfo.goods_points_type;
                obj.tmpRow.Count = Count;
                obj.tmpRow.goods_cat_id = goodsInfo.goods_cat_id;
				obj.tmpRow.goods_cost = goodsInfo.goods_cost;
				if(obj.MemInfo != Object && obj.memInfo.LevelInfo != null && goodsInfo.goods_is_discount)
				{
					obj.tmpRow.goods_discount = obj.memInfo.LevelInfo.member_grade_discountrate;
				}
				obj.tmpRow.goods_tax_rate = goodsInfo.goods_tax_rate;
				
                obj.orderLog.orderData.push({
                    "goods_type": obj.tmpRow.goods_type,
                    "goods_id": obj.tmpRow.goods_id,
                    "goods_code": obj.tmpRow.goods_code,
                    "goods_name": obj.tmpRow.goods_name,
                    "Qty": obj.tmpRow.Qty,
                    "UnitPrice": obj.tmpRow.UnitPrice,
                    "goods_price": obj.tmpRow.goods_price,
                    "Sum": MoneyPrecision(obj.tmpRow.Sum),
                    "TotalMoney": MoneyPrecision(accMul(obj.tmpRow.Qty, obj.tmpRow.UnitPrice)),
                    "goods_is_points": obj.tmpRow.goods_is_points,
                    "member_grade_pointsrate": obj.tmpRow.member_grade_pointsrate,
                    "Point": obj.GetGoodsPoint(obj.tmpRow),
                    "Staff": obj.tmpRow.Staff,
                    "StaffList": "",
                    "Count": obj.goodsList[goods_id].goods_stock,
                    "goods_cat_id": obj.tmpRow.goods_cat_id,
                    "GoodsMarketingId": obj.tmpRow.GoodsMarketingId,
					"goods_cost": obj.tmpRow.goods_cost,
					"goods_discount": obj.tmpRow.goods_discount,
					"goods_tax_rate": obj.tmpRow.goods_tax_rate
                });
            }
            obj.loadFooter(); //加载
            //obj.calcPayMoney();
            obj.loadCartData(); //刷新购物车
            obj.orderLog.OriginalMoney = obj.orderLog.DiscountMoney;
        }
    },
    //加入购物车时验证库存 - bx
    CheckCartStock: function (goods_id, goods_type, count) 
	{
        var obj = this;
        var flg = true;
		
        if (goods_type == 1) 
		{
            if (count <= 0) 
			{
                /* flg = false;
                alertError("[" + obj.goodsList[goods_id].goods_name + "]"+__("库存不足,库存数为") + count + ","+__("请及时补充货源")); */
            }
        } else if (goods_type == 5) 
		{
            var ComboDetailJson = obj.goodsList[goods_id].combo_detail;//JSON.parse(obj.goodsList[goods_id].combo_detail);
            for (var i = 0; i < ComboDetailJson.length; i++) {
                var json = ComboDetailJson[i];
                var goods_id = json.goods_id;
                var Qty = json.quantity;
                var Type = json.goods_type;
                if (Type == 1) {
                    var goods_stock = 0;
                    var goods_name = "";
                    if (obj.goodsList[goods_id] == undefined || obj.goodsList[goods_id] == null) {
                        goods_stock = json.goods_stock - 0;
                        goods_name = json.goods_name;
                    } else {
                        goods_stock = obj.goodsList[goods_id].goods_stock - 0;
                        goods_name = obj.goodsList[goods_id].goods_name;
                    }
                    if (goods_stock < Qty) {
                        /* flg = false;
                        alertError("[" + obj.goodsList[goods_id].goosds_name + "]"+__("套餐中")+"[" + goods_name + "]"+__("库存不足,库存数为") + goods_stock + ","+__("请及时补充货源"));
                        break; */
                    }
                }
            }
        }
        return flg;
    },
    //加入购物车后计算库存 - bx
    SetCartStock: function (goods_id, goods_type, count) 
	{
        var obj = this;
        if (goods_type == 1) 
		{
            obj.goodsList[goods_id].goods_stock = obj.goodsList[goods_id].goods_stock - count;
        } else if (goods_type == 5) 
		{
            var ComboDetailJson = obj.goodsList[goods_id].combo_detail;//JSON.parse(obj.goodsList[goods_id].combo_detail);
            var details = [];
            for (var i = 0; i < ComboDetailJson.length; i++) {
                var json = ComboDetailJson[i];
                var Id = json.Id;
                var Qty = json.Qty - 0;
                var Type = json.goods_type;
                if (Type == 1) {
                    if (obj.goodsList[Id] != undefined && obj.goodsList[Id] != null) {
                        if (count > 0) {
                            if (obj.goodsList[Id].goods_stock - Qty >= count) {
                                obj.goodsList[Id].goods_stock = obj.goodsList[Id].goods_stock - Qty * count;
                            } else {
                                obj.goodsList[Id].goods_stock = 0;
                            }
                        } else {
                            obj.goodsList[Id].goods_stock = obj.goodsList[Id].goods_stock - Qty * count;
                        }

                    } else {
                        var num = (json.goods_stock - 0) - Qty * count;
                        num = num > 0 ? num : 0;
                        var detail = { "Id": Id, "Qty": Qty, "goods_type": Type, "goods_stock": num, "goods_name": json.goods_name };
                        details.push(detail);
                    }
                }
            }
            if (details.length > 0) {
                obj.goodsList[goods_id].combo_detail = JSON.stringify(details);
            }

            obj.goodsList[goods_id].goods_stock = obj.goodsList[goods_id].goods_stock - count;
        }
    },
    //购物车公共方法begin*************************************************
    //根据产品特价和产品折扣比例计算产品的优惠价  - bx
    CalculationSpecial: function (row) 
	{
        var obj = this;
        var res = 1;
		
        if (obj.orderLog.CardID != "0000" && obj.memInfo != Object && obj.memInfo.LevelInfo.member_grade_id != null) 
		{
            if (row.goods_vip_price != 0 && row.goods_vip_price != null) 
			{
                res = row.goods_vip_price;
            } else {
                var dis = obj.GetGoodsDiscount(row);
                res = accMul(row.goods_price, dis);
            }
        } else {
            res = row.goods_price;
        }
        /* var goods_id = row.goods_id == undefined ? row.goods_id : row.goods_id;
        res = obj.GetGoodsMarketPrice(goods_id, row.goods_cat_id, res);
        if (obj.AllMarketGoods[goods_id] == null) {
            row.GoodsMarketingId = "";
        } else {
            row.GoodsMarketingId = obj.AllMarketGoods[goods_id].MarketId;
        } */
        return res;
    },
    //根据会员等级折扣和折扣卡最低折扣计算产品的折扣比例
    GetGoodsDiscount: function (row) {
        var res = 1;
        var obj = this;
		
        //判断当前会员的等级是折扣卡，且产品打折
        if (obj.memInfo != Object && obj.memInfo.LevelInfo.member_grade_id != 0 && obj.memInfo.CardID != "0000" && row.goods_is_discount == 1) 
		{

            res = obj.memInfo.LevelInfo.member_grade_discountrate;
            //产品的折扣为0，表示按照会员的折扣计算,反之取大的值
            if (row.goods_min_rate != 0 && row.goods_min_rate <= 1) 
			{
                if (row.goods_min_rate > res) res = row.goods_min_rate;
            }
        }
        return res;
    },
    //购物车添加产品时，根据会员等级积分卡计算获得积分
    GetGoodsPoint: function (row) {
        var res = 0;
        var obj = this;
        //判断当前会员的等级是积分卡
        if (obj.memInfo != Object && obj.memInfo.LevelInfo.member_grade_id != 0 && obj.memInfo.CardID != "0000" && row.goods_is_points == 1) 
		{
            res = row.member_grade_pointsrate;
            if (row.member_grade_pointsrate == 0) 
			{
                res = accMul(accMul(row.goods_price, GoodsCashier.memInfo.LevelInfo.member_grade_pointsrate), row.Qty);
                res = PointPrecision(res);
            } else {
				
                res = accMul(row.Qty, res);
                res = PointPrecision(res);
            }
        }
        return res;
    },
    //购物车编辑产品时，根据会员等级积分卡计算获得积分
    GetGoodsPoint2: function (row, vQty, vPrice) {
        var res = 0;
        var obj = this;
        //判断当前会员的等级是积分卡
        if (obj.MemInfo != Object && obj.memInfo.LevelInfo != null
            && obj.memInfo.LevelInfo.IsPointCard == 1
            && obj.MemInfo.CardID != "0000" && row.goods_is_points == 1) {
            res = row.goods_points_type;
            if (row.member_grade_pointsrate == 0) {
                //按比会员等级比例计算
                res = accMul(vQty * vPrice, obj.memInfo.LevelInfo.member_grade_pointsrate);
            } else {
                res = accMul(vQty, res);
            }
            res = PointPrecision(res);
        }
        return res;
    },
    //加载购物车合计栏 并计算 无优惠情况下的积分和金额
    loadFooter: function () {
        var obj = this;
        var goods_typeNum = 0;
        var goods_typeArry = [];
        var isMarket = 0;
        //数量    小计折后金额    积分     合计金额  合计积分   
        var totalobj = { totalNum: 0, Sum: 0.00, Point: 0, TotalMoney: 0.00, TotalPoint: 0 };
        $.each(obj.orderLog.orderData, function (index, item) {
			
            goods_typeArry.push(item.goods_cat_id);//产品类别
            if (item.goods_type != 4) 
			{
                if (item.goods_type == 3) { //当是计时产品的时候 记数为1 个
                    totalobj.totalNum += 1;
                } else {
                    totalobj.totalNum += (item.Qty - 0); //数量tbl_CartData
                }
                totalobj.Sum += (item.Sum - 0); //折扣金额小计
                totalobj.Point += (item.Point - 0); //积分
                totalobj.TotalMoney += (item.TotalMoney - 0); //消费金额 
            }
            if (item.GoodsMarketingId != "") {
                isMarket = 1;
            }
        });
		
        $.each(goods_typeArry.sort(function (a, b) { return a - b; }), function (index, item1) {
			
            if (item1 != goods_typeArry[index - 1]) {
                goods_typeNum++;
            }
        });
        obj.orderLog.IsMarket = isMarket;
        obj.orderLog.GoodsNum = goods_typeNum;
        $("#span_GoodsTypeNum").html(goods_typeNum);
        $("#span_totalGoodsNum").html(Math.round(totalobj.totalNum * 100) / 100);
        //计算金额和积分***********************************************
        totalobj.Sum = MoneyPrecision(totalobj.Sum); //折后金额
        totalobj.TotalMoney = MoneyPrecision(totalobj.TotalMoney); //消费金额
        totalobj.Point = PointPrecision(totalobj.Point); //总积分
        totalobj.TotalPoint = totalobj.Point; //暂时合计积分是小计积分 
        obj.orderLog.TotalMoney = totalobj.TotalMoney;
        obj.orderLog.DiscountMoney = totalobj.Sum;
        obj.orderLog.TotalPoint = totalobj.TotalPoint;
        //$("#p_xj").html(obj.orderLog.DiscountMoney);  //计算小计
        //$("#p_jf").html(totalobj.TotalPoint);  //积分
        $("#p_hjje").html(MoneyPrecision(obj.orderLog.TotalMoney)); //合计金额
        $("#p_zhje").html(MoneyPrecision(obj.orderLog.DiscountMoney)); //折后金额
        $("#p_hjjf").html(PointPrecision(obj.orderLog.TotalPoint)); //合计积分
    },
    //购物车公共方法end****************************************************
    //重新加载购物车
    loadCartData: function () {
        var obj = this;
        $("#tbl_CartData").bootstrapTable('load', obj.orderLog.orderData);
    },
    //初始化购物车table
    bindCartTable: function () {
        var obj = this;
        $("#tbl_CartData").bootstrapTable({
            data: obj.orderLog.orderData,
            striped: true,                      //是否显示行间隔色
            pagination: false,                   //是否显示分页（*）
            singleSelect: true,
            queryParamsType: "undefined",
            sortName: 'CreateTime',
            sortOrder: 'desc',
            sidePagination: "client",           //分页方式：client客户端分页，server服务端分页（*）
            pageNumber: 1,                       //初始化加载第一页，默认第一页
            pageSize: 5,                       //每页的记录行数（*）
            showColumns: false,                  //是否显示所有的列
            minimumCountColumns: 2,             //最少允许的列数
            uniqueId: "Id",                     //每一行的唯一标识，一般为主键列
            editable: true,
            clickToSelect: true,
            columns: obj.getColumns(),
            /* onDblClickRow: function (row, $element, field) {
                obj.ShowCartDetail(row);
            }, */
			formatLoadingMessage: function(){
				return "";
			}
        });
    },
    getColumns: function () {
        var obj = this;
        var isHighVersionHide = 1/* AuthBtn.indexOf("CP_CPZX_CPZX_JSCP") >= 0 */ ? true : false;
        var colmuns = [
            { field: 'goods_id', title: __('商品id'), align: 'left', halign: 'left', visible: false },
            { field: 'goods_code', title: __('商品代码'), align: 'left', halign: 'left', visible: false },
            { field: 'goods_name', title: __('商品名称'), align: 'left', width: '30%', halign: 'left' },
            { field: 'Qty', align: 'left', halign: 'left', visible: false },
            {
                field: 'Number',
                title: __('数量'),
                align: 'left',
                halign: 'left',
                width: '8%',
                /* formatter: function (value, row, index) {
                    if (row.goods_type == 3)
                        return obj.GetDateFormat(row.Qty);
                    else
                        return row.Qty;
                } */
				formatter: function (value, row, index) {
                   return '<input type="number" min="1" value="' + row.Qty + '" onchange="GoodsCashier.validatorText(this,' + index + ','+row.goods_id+')"  class="form-control bdkd" />';
               }
            },
            { field: 'goods_discount', title: __('折扣'), align: 'left', width: '8%', halign: 'left', formatter: function (value, row, index) { 
				return '<input type="text" min="1" value="' + row.goods_discount + '" onchange="GoodsCashier.validatorDiscount(this,' + index + ')"  class="form-control bdkd" />'; } 
			},
            { field: 'goods_price', title: __('单价'), align: 'left', width: '8%', halign: 'left', formatter: function (value) { return '<font color="Red">'+ __("￥") + MoneyPrecision((value - 0).toFixed(2)) + '</font>'; } },
            { field: 'Sum', title: __('金额'), align: 'left', width: '8%', halign: 'left', formatter: function (value) { return '<font color="Red">'+ __("￥") + MoneyPrecision((value - 0).toFixed(2)) + '</font>'; } },
            { field: 'Point', title: __('积分'), align: 'left', halign: 'left', visible: false },
            { field: 'StaffList', title: __('提成员工'), align: 'left', halign: 'left', visible: false },
            { field: 'Staff', title: __('提成员工集合'), align: 'left', halign: 'left', visible: false },
            {
                field: '_o_',
                title: __('操作'),
                align: 'left',
                width: '15%',
                halign: 'left',
                formatter: function (value, row, index) {
                    var result = '<button type="button" onclick="GoodsCashier.CartDetail(\'' + row.goods_id + '\',\'' + row.goods_type + '\')" class="btn b-racius3 btn-default waves-effect btn-xs m-r-5"><i class="fa fa-eye" style=" font-size:14px; cursor:pointer;"></i></button>';
                    result += '<button type="button" onclick="GoodsCashier.deleteCartData(\'' + row.goods_id + '\',\'' + row.goods_type + '\');" class="btn b-racius3 btn-default waves-effect btn-xs m-r-5"><i class="fa fa-remove" style=" font-size:14px; cursor:pointer;"></i></button>';
                    return result;
                }
            }
        ];
        return colmuns;
    },
    CartDetail: function (goods_id, goods_type) {
        var obj = this;
        var vKey = goods_type + "^" + goods_id;
        var row = null;
        $.each(obj.orderLog.orderData, function (i, item) {
            if (vKey == (item.goods_type + "^" + item.goods_id)) {
                row = item;
                return;
            }
        });
        obj.ShowCartDetail(row);
    },
    ShowCartDetail: function (row) {
        var obj = this;
        var tmpQty = 0;
        var vKey = row.goods_type + "^" + row.goods_id;
        if (row.goods_type == 3) {
            tmpQty = row.Qty;
            $("#edt_Qty").attr('readonly', 'readonly');
            $("#lbl_Price").attr('readonly', 'readonly');
            $("#lbl_TotalMoney").attr('readonly', 'readonly');
            $("#lbl_Price").attr("isTimeGoods", true);
        } else if (row.goods_type == 4) {
            tmpQty = row.Qty;
            $("#lbl_Price").attr('readonly', 'readonly');
        } else {
            tmpQty = row.Qty;
            $("#lbl_Price").removeAttr("isTimeGoods");
            if (sysParameter.is_modify_price == 1) {
                $("#lbl_Price").removeAttr("readonly");
            } else {
                $("#lbl_Price").attr('readonly', 'readonly');
            }
            $("#edt_Qty").removeAttr("readonly");
        }
        $.extend(true, obj.ShoppingCartRow, row);

        $("#edt_Point").attr('readonly', 'readonly');
        $("#edt_Qty").val(tmpQty);
        $('#edt_Point').val(row.Point);
        $("#lbl_Price").val(row.goods_price);
        obj.oldPrice = MoneyPrecision(row.goods_price); //原单价
        obj.Type = row.goods_type; //产品类型
        $("#lbl_TotalMoney").val(MoneyPrecision((row.Sum - 0)));
        //汽车管理
        if (FuncList.length > 0) {
            for (var item in FuncList) {
                if (FuncList[item].ClassCode == 8) {
                    $("#lbl_TotalMoney").removeAttr('readonly');
                    break;
                } else {
                    $("#lbl_TotalMoney").attr('readonly', 'readonly');
                }
            }
            ;
        } else {
            $("#lbl_TotalMoney").attr('readonly', 'readonly');
        }
        $("#ReviseNumberLabel").html(__("商品信息--") + row.goods_name);
        $("#Revisecount").val(row.Count);
        $("#ReviseNumberLabel").attr('atuoid', vKey);
        //$("#edtStaff").val(row.StaffList);
        //obj.staffArry = row.Staff;
        //GoodsCashierStaffInit.Init();
        obj.ShowUpdateNumOrStaffCommission();
    },
    //购物车删除数据
    deleteCartData: function (goods_id, goods_type) {
        var obj = this;
        var vKey = goods_type + "^" + goods_id;
        for (var i = 0; i < obj.orderLog.orderData.length; i++) {
            var tRow = obj.orderLog.orderData[i];
            if (vKey == (tRow.goods_type + "^" + tRow.goods_id)) {
                obj.orderLog.orderData.splice(i, 1);
                obj.SetCartStock(goods_id, goods_type, 0 - tRow.Qty);
                break;
            }
        }
        obj.loadFooter();
        //obj.calcPayMoney();
        $("#tbl_CartData").bootstrapTable('load', obj.orderLog.orderData);
    },
    //分页加载产品
    loadGoodsData: function (type) {
        var obj = this;
        obj.SearchData.goodsCode = $("#goodsCode").val().trim();
		type = 0;

        obj.SearchData.searchType = type == 1 ? 1 : 0;
        $.ajax({
            url: SYS.CONFIG.index_url + '?ctl=Cashier_Goods&met=goodsLists&typ=json',
            type: "post",
            async: false,
            data: obj.SearchData,
			dataType: 'json',
            success: function (data) 
			{
				
                if (data && data.status == 200) 
				{
                    var goodsHtml = '';
                    $("#ul_GoodsList").html(goodsHtml);
                    
					var data = data.data;
					if (data.records > 0) 
					{
                        var rows = data.items;
                        obj.goodsData = data.items;
                        obj.realGoodsData = data.items;
						
                        for (var i = 0; i < obj.goodsData.length; i++) 
						{
                            var key = obj.goodsData[i].goods_id;
                            if (obj.IsClearGoodsList == 1) 
							{
                                obj.goodsList[key] = obj.goodsData[i];
                                if (obj.goodsList[key].goods_type == 5) 
								{
                                    var ComboDetailJson = obj.goodsList[key].combo_detail;//JSON.parse(obj.goodsList[key].combo_detail);
                                    for (var j = 0; j < ComboDetailJson.length; j++) {
                                        var json = ComboDetailJson[j];
                                        var gId = json.goods_id;
                                        if (json.goods_type == 1) {
                                            if (obj.goodsList[gId] != undefined && obj.goodsList[gId] != null) {
                                                obj.goodsList[gId].goods_stock = json.goods_stock - 0;
                                            }
                                        }
                                    }
                                }
                            } else {
                                if (obj.goodsList[key] == null) {
                                    obj.goodsList[key] = obj.goodsData[i];
                                }
                            }
                        }
						
                        obj.IsClearGoodsList = 0;
                        var tmpGType = "";
                        var tmpKcStr = "";
                        for (var item in rows) 
						{
							var oddClass = 'odd';
							if(item%2==0){
								oddClass = 'even'
							}

                            var imageUrl = (rows[item].goods_image == null || rows[item].goods_image.length < 1) ? SYS.CONFIG.static_url+"/images/default_goods.png" : (rows[item].goods_image);
							
							clickFunName = 'GoodsCashier.addGoodsCart(\'' + rows[item].goods_id + '\',\'' + rows[item].goods_type + '\')';
							
                            goodsHtml += '<div class="col-lg-6 col-md-6 col-sm-6 goods">';
                            goodsHtml += '<div class="goods-detail '+oddClass+'" onclick="' + clickFunName + '">';
 
                            goodsHtml += '<div class="goods-img"><a>';
                            goodsHtml += '<img src="' + imageUrl + ' " alt="'+__('商品默认图片')+'" width="60" />';
                            goodsHtml += '</a></div><p class="text_xz"><span class="">' + rows[item].goods_name + '</span></p><p class="text_xz text_20"><span class=" text-warning">'+ __("￥") + rows[item].goods_price + '</span></p><p class="text_xz text_20"><span class="">'+__('库存:') + rows[item].goods_stock + '</span></p>';
                            goodsHtml += '</div>';
                            goodsHtml += '</div>';
                        }
						
                        if (data.records == 1 && obj.SearchData.goodsCode != "") 
						{
							//如果查到单一商品，加入购物车列表
                            obj.addGoodsCart(rows[0].goods_id, rows[0].goods_type);
                        }
                    } else {
                        //通过条码未查询到商品，按普通查询
                        if (type == 1) {
                            obj.loadGoodsData();
                        }
                    }
                    $("#ul_GoodsList").html(goodsHtml);

                    GoodsCashier.TotalPage = data.records;
                }
                else {
                    alertError(data.msg);
                }
            }
        });
    },
    //显示套餐内库存不足的商品明细
    ShowStockDetail: function (id) {
        var obj = this;
        var ComboDetailJson = obj.goodsList[id].combo_detail;//JSON.parse(obj.goodsList[id].combo_detail);
        obj.InStockGoodsList = [];
        for (var i = 0; i < ComboDetailJson.length; i++) {
            var json = ComboDetailJson[i];
            var Id = json.Id;
            var Qty = json.Qty;
            var Type = json.goods_type;
            if (Type == 1) {
                var goods_stock = 0;
                if (obj.goodsList[Id] == undefined || obj.goodsList[Id] == null) {
                    goods_stock = json.goods_stock - 0;
                } else {
                    goods_stock = obj.goodsList[Id].goods_stock - 0;
                }
                if (goods_stock < Qty - 0) {
                    var goodsinfo = { goods_id: Id, goods_name: json.goods_name, Qty: Qty, goods_stock: goods_stock };
                    obj.InStockGoodsList.push(goodsinfo);
                }
            }
        }
        if (obj.InStockGoodsList.length > 0) {
            obj.bindNoStockTable();
            $("#NoStockModal").modal({ backdrop: 'static', keyboard: false });
        }

    },
    //初始化购物车table
    bindNoStockTable: function () {
        var obj = this;
        $("#tbl_NoStockGoodsData").bootstrapTable('destroy');
        $("#tbl_NoStockGoodsData").bootstrapTable({
            data: obj.InStockGoodsList,
            striped: true,                      //是否显示行间隔色
            pagination: false,                   //是否显示分页（*）
            singleSelect: true,
            queryParamsType: "undefined",
            //sortName: 'CreateTime',
            // sortOrder: 'desc',
            sidePagination: "client",           //分页方式：client客户端分页，server服务端分页（*）
            pageNumber: 1,                       //初始化加载第一页，默认第一页
            pageSize: 5,                       //每页的记录行数（*）
            showColumns: false,                  //是否显示所有的列
            minimumCountColumns: 2,             //最少允许的列数
            uniqueId: "Id",                     //每一行的唯一标识，一般为主键列
            editable: true,
            clickToSelect: true,
            columns: obj.getNoStockColumns(),
        });
    },
    getNoStockColumns: function () {
        var obj = this;
        var colmuns = [
            { field: 'goods_name', title: __('产品名称'), align: 'left', width: '40%', halign: 'left' },
            { field: 'Qty', title: __('所需库存'), align: 'left', width: '30%', halign: 'left' },
            { field: 'goods_stock', title: __('产品库存'), align: 'left', width: '30%', halign: 'left' }

        ];
        return colmuns;
    },
    //根据产品类别搜索
    search: function (GoodsClassId) {
        var obj = this;
        if (GoodsClassId == 1) {
            obj.SearchData.goods_type = 5;
            obj.SearchData.goods_cat_id = '';
        } else {
            obj.SearchData.goods_type = -1;
            if (GoodsClassId == 0) {
                obj.SearchData.goods_cat_id = '';
            } else {
                obj.SearchData.goods_cat_id = GoodsClassId;
            }
        }

        $("#goodsCode").val("");
        obj.SearchData.pageIndex = 1;
        obj.loadGoodsData();
        obj.pageList();
    },
    //分页 - bx
    pageList: function () 
	{
        var obj = this;
        if (obj.TotalPage > 10) {
            $('#edt_PageInit').show();
            $('#edt_PageInit').setLength(parseInt((obj.TotalPage + obj.SearchData.pageRows - 1) / obj.SearchData.pageRows));
        } else {
            $('#edt_PageInit').hide();
        }

    },
    //清空包括购物车和所选会员以及优惠活动
    TableEmpty: function () {
        var obj = this;
        obj.clearObJOrderLog();
        //MemberSelect.initMember();
    },
    //保存 消费
    saveGoodsCashierToSever: function ()
    {
        var obj = this;

        $.ajax({
            url: SYS.CONFIG.index_url + '?ctl=Cashier_Goods&met=saveGoodsConsume&typ=json',
            type: 'post',
            cache: false,
            data: obj.orderLog,
            dataType: "json",
            success: function (data)
            {
                if (data && data.status == 200)
                {
                    if ($("#Print_div").attr("class") == "active")
                    {
                        obj.PrintXP(data.data.printData, obj.orderLog, {});
                    }
                    var cardId = obj.orderLog.CardID;

                    alertMessage(data.msg);
                    obj.closePayCheckOutModal();
                    //清空会员信息
                    MemberSelect.initMember();
                    obj.SearchData.pageIndex = 1;
                    obj.IsClearGoodsList = 1;
                    obj.loadGoodsData();
                    obj.orderLog.orderData = [];
                    $("#tbl_CartData").bootstrapTable('load', obj.orderLog.orderData);
                    obj.pageList();
                }
                else {
                    alertError(data.msg);
                }
                $("#btnZhifu").removeAttr("disabled");
            }
        });
    },
    //提成重新设置********************************begin/
    //修改对应的数量和提成
    ShowUpdateNumOrStaffCommission: function () {
        var obj = this;
        obj.isCheckNumberModal = 0;
        $('#ReviseNumberModal').slideToggle(0);
    },
    //检查库存
    checkgoods_stock: function (flag) {
        var obj = this;
        obj.flag = true;
        
        if (1) {
            for (var i = 0; i < obj.orderLog.orderData.length; i++) {
                var tRow = obj.orderLog.orderData[i];
                if (tRow.goods_type == 1) {
                    var goods = obj.goodsList[tRow.goods_id];
                    if (goods == null) {
                        alertError(__("产品[") + tRow.goods_name + __("]不存在"));
                        obj.flag = false;
                        return;
                    }
                    if (goods.goods_stock < 0) {
                        //某某产品库存不足，库存数为***，请及时补充货源
                        /* alertError("[" + tRow.goods_name + __("]库存不足,库存数为") + goods.goods_stock + __(",请及时补充货源"));
                        obj.flag = false;
                        return; */
                    }
                }
            }
        }
    },
    //文本框change事件
    validatorText: function (val, index,goods_id) {
        var obj = this;
		
        if (/^[0-9]*[1-9][0-9]*$/.test($(val).val())) 
		{
            $("#tbl_CartData").bootstrapTable('updateCell', { index: index, field: 'Number', value: $(val).val() });
            obj.reload(goods_id);
            $(val).removeAttr('style');
            obj.flag = 1;
        }
        else {
            $(val).attr('style', 'border:1px solid red');
            obj.flag = 0;
        }
    },
    //table数据改变重新赋值
    reload: function (goods_id) 
	{
        var obj = this;
 
		var goods_vkey = goods_id;
		$.each(obj.orderLog.orderData, function (index, item) 
		{
            var vKey = /* item.goods_type + "^" + */ item.goods_id;
            if(vKey == goods_vkey)
			{
                var tmpQty = item.Number - 0;
                /* var tmpSum = item.Number * parseFloat(item.goods_price) - 0;
                var unitPrice = parseFloat(item.goods_price) - 0; */
				
				var unitPrice = parseFloat(item.UnitPrice) - 0;
				if(item.goods_discount > 0 && item.goods_discount < 1)
				{
					unitPrice = parseFloat(item.UnitPrice*item.goods_discount) - 0;
				}
				var tmpSum = item.Number * parseFloat(unitPrice) - 0;
				
				
                if (item.goods_type != 3) 
				{
                    if (item.goods_type == 1 && obj.goodsList[item.goods_id] != null) 
					{
                        obj.goodsList[item.goods_id].goods_stock = accSub(accAdd(obj.goodsList[item.goods_id].goods_stock, (item.Qty - 0)), (tmpQty - 0));
                    }

                    if (item.goods_type == 5) {
                        var ComboDetailJson = obj.goodsList[item.goods_id].combo_detail;//JSON.parse(obj.goodsList[item.goods_id].combo_detail);
                        for (var i = 0; i < ComboDetailJson.length; i++) {
                            var json = ComboDetailJson[i];
                            var Id = json.Id;
                            var Qty = json.Qty;
                            var Type = json.goods_type;
                            if (Type == 1) {
                                obj.goodsList[Id].goods_stock = accSub(accAdd(obj.goodsList[Id].goods_stock, accMul((item.Qty - 0), Qty)), accMul((tmpQty - 0), Qty));
                            }
                        }
                    }

                    item.Qty = tmpQty - 0;
                    item.Sum = tmpSum - 0;
                    item.goods_price = unitPrice;
                    item.UnitPrice = item.UnitPrice/* obj.goodsList[item.goods_id].goods_price */;
                    item.TotalMoney = MoneyPrecision(accMul(tmpQty, parseFloat(item.UnitPrice))) - 0;
                    item.Point = obj.GetGoodsPoint(item) - 0;
                }
         
            }
        });
        //加载订单数据
        obj.loadCartData();
        //加载脚部合计
        obj.loadFooter();
    },
	validatorDiscount: function (val, index) {
        var obj = this;

        if ($(val).val() >= 0 && $(val).val() <= 1) 
		{
            $("#tbl_CartData").bootstrapTable('updateCell', { index: index, field: 'goods_discount', value: $(val).val() });
            
			$.each(obj.orderLog.orderData, function (index, item) 
			{
				var vKey = item.goods_type + "^" + item.goods_id;
				if(vKey)
				{
					var tmpQty = item.Qty - 0;
					var unitPrice = parseFloat(item.UnitPrice) - 0;
					if(item.goods_discount > 0 && item.goods_discount < 1)
					{
						unitPrice = parseFloat(item.UnitPrice*item.goods_discount) - 0;
					}
					var tmpSum = item.Qty * parseFloat(unitPrice) - 0;
					if (item.goods_type != 3) 
					{
						if (item.goods_type == 1 && obj.goodsList[item.goods_id] != null) 
						{
							obj.goodsList[item.goods_id].goods_stock = accSub(accAdd(obj.goodsList[item.goods_id].goods_stock, (item.Qty - 0)), (tmpQty - 0));
						}

						if (item.goods_type == 5) {
							var ComboDetailJson = obj.goodsList[item.goods_id].combo_detail;//JSON.parse(obj.goodsList[item.goods_id].combo_detail);
							for (var i = 0; i < ComboDetailJson.length; i++) {
								var json = ComboDetailJson[i];
								var Id = json.Id;
								var Qty = json.Qty;
								var Type = json.goods_type;
								if (Type == 1) {
									obj.goodsList[Id].goods_stock = accSub(accAdd(obj.goodsList[Id].goods_stock, accMul((item.Qty - 0), Qty)), accMul((tmpQty - 0), Qty));
								}
							}
						}

						item.Qty = tmpQty - 0;
						item.Sum = tmpSum - 0;
						item.goods_price = unitPrice;
						item.TotalMoney = MoneyPrecision(accMul(tmpQty, parseFloat(item.UnitPrice))) - 0;
						item.Point = obj.GetGoodsPoint(item) - 0;
					}
			 
				}
			});
			
			//加载订单数据
			obj.loadCartData();
			//加载脚部合计
			obj.loadFooter();
			
            $(val).removeAttr('style');
            obj.flag = 1;
        }
        else {
            $(val).attr('style', 'border:1px solid red');
            obj.flag = 0;
        }
    }
};
jQuery(document).ready(function ($) {
    QuickCashier.init();
});

var QuickCashier = 
{
    PayTotalMoney: 0,//消费总额
    DiscountMoney: 0,//折后金额
    memInfo: Object,//会员信息
    PointPercent: 0.00,//积分获得比例
    GivePoint: "",//获得积分
    payLog: {
        PayOtherType: '',
        TotalMoney: 0.00,//累计金额
        DiscountMoney: 0.00,//折扣金额
        PayCash: 0.00,//现金支付
        PayMoney: 0,//余额
        PayOther: 0,//支付宝、微信金额
        PayPoint: 0,//积分
        PayUnion: 0,//银联
        PayPointNum: 0,//积分支付消耗积分
        PayType: '',//支付方式
        TotalPoint: 0.00,//积分总量
        Remark: '',//备注
    },
    init: function () 
	{
        var obj = this;
        obj.event();	
    },
    //事件
    event: function () 
	{
        var obj = this;
         
        //消费金额输入
        $("#edtMoney").bind('focus change keyup', function () {
            if ($("#edtMoney").val() > sysParameter.total_price * 10000) {
                $("#edtMoney").val(0.00)
                alertError(__("单笔消费限额不能超过") + sysParameter.total_price + "万");
            }
            obj.calcPoint();
        });
		
        //付款模态框
        $("#edt_Pay").on('click', function () 
		{
            window.parent.$("#btnZhifu").removeAttr("disabled");
            var tmpMoney = $("#edtMoney").val().trim();
            if (tmpMoney == "") {
                alertError(__("请输入消费金额"));
                $("#edtMoney").focus();
                return false;
            }

            obj.PayTotalMoney = parseFloat(tmpMoney);
            if (obj.PayTotalMoney > sysParameter.total_price * 10000) {
                alertError(__("单笔消费金额不能超过") + sysParameter.total_price * 10000 + __("万!"));
                $("#edtMoney").focus();
                return false;
            }
            tmpMoney = $("#edtDiscountMoney").val().trim();
            if (tmpMoney == "") {
                tmpMoney = 0;
            }
            obj.DiscountMoney = MoneyPrecision(tmpMoney);

            obj.payLog.Remark = $("#edtRemark").val();
            if (obj.memInfo != Object) {
                obj.GivePoint = $("#edtPoint").val();
                PayFuKuan.ConsumptionIdentification = 1;
                PayFuKuan.DiscountMoney = obj.DiscountMoney;
                PayFuKuan.PayTotalMoney = obj.PayTotalMoney;
                PayFuKuan.MemCardId = obj.memInfo.Id;
                PayFuKuan.MemCardPoint = obj.memInfo.Point;
                PayFuKuan.MemCardMoney = obj.memInfo.Money;
                PayFuKuan.InitialAssignment();
            } else {
                PayFuKuan.ConsumptionIdentification = 1;
                PayFuKuan.DiscountMoney = obj.DiscountMoney;
                PayFuKuan.PayTotalMoney = obj.PayTotalMoney;
                PayFuKuan.MemCardId = "";
                PayFuKuan.MemCardPoint = 0;
                PayFuKuan.MemCardMoney = 0;
                PayFuKuan.InitialAssignment();
            }
            $('#PayCheckOutModal').modal({ show: true, backdrop: 'static' });
        });
    },
    closePayCheckOutModal: function () {
        var obj = this;
        $("#PayCheckOutModal").modal('hide');
        obj.staffArry = new Array();
        obj.payLog.PayOtherType = '';
        obj.payLog.TotalMoney = 0.00;//累计金额
        obj.payLog.DiscountMoney = 0.00;//折扣金额
        obj.payLog.PayCash = 0.00;//现金支付
        obj.payLog.PayMoney = 0;//余额
        obj.payLog.PayOther = 0;//支付宝、微信金额
        obj.payLog.PayPoint = 0;//积分
        obj.payLog.PayUnion = 0;//银联
        obj.payLog.PayPointNum = 0;//积分支付消耗积分
        obj.payLog.PayType = '';//支付方式
        obj.payLog.TotalPoint = 0.00;//积分总量
        obj.payLog.Remark = '';//备注
    },
    //计算打折
    calcPoint: function () 
	{
        var obj = this;
        var LevelInfo = obj.memInfo.LevelInfo;
        var isMem = !$.isEmptyObject(LevelInfo);

        if (isMem) 
		{
            if (LevelInfo.member_grade_id > 0) 
			{
				//判断是否打折卡 如果是打折卡 按照折扣计算金额
				var discounyMoney = returnFloat($("#edtMoney").val() - 0);
				$("#edtDiscountMoney").val(MoneyPrecision(returnFloat(discounyMoney * returnFloat(LevelInfo.member_grade_discountrate))));
				var point = PointPrecision(discounyMoney * returnFloat(LevelInfo.member_grade_discountrate) * LevelInfo.member_grade_pointsrate);
				$("#edtPoint").val(point);
            }else{
				var discounyMoney = returnFloat($("#edtMoney").val() - 0);
				$("#edtDiscountMoney").val(MoneyPrecision(discounyMoney));
				var point = 0;
				$("#edtPoint").val(point);
			}
            if ($("#edt_Special").val() != null && $("#edt_Special").val().trim() != "") 
			{
                obj.calculateDiscountAmount(isMem);
            }
        }
        else {
            //散客
            var discounyMoney = returnFloat($("#edtMoney").val() - 0);
            $("#edtDiscountMoney").val(MoneyPrecision(returnFloat(discounyMoney)));
            if ($("#edt_Special").val() != null && $("#edt_Special").val().trim() != "") {
                obj.calculateDiscountAmount(isMem);
            }
        }
    },
    //打印
    PrintXP: function (json, PrintTemplateList) {

        if (true) {
            json.Activity = "";
            json.ShopTitle = shopInfo.PrintTitle;
            var Json = {};
            Json.data = [];
            Json.PrintTemplate = [];
            Json.data.push(json);
            Json.PrintTemplate.push(PrintTemplateList[0]);
            try {
                if (temp == undefined) {

                }
                else {
                    temp.print(JSON.stringify(json), PrintID.QuickConsume);
                }
            } catch (e) {
                if (PrintTemplateList[0] == undefined) {
                    PrintLodopFuncs(Json, json, 1, 0);
                }
                else {
                    PrintLodopFuncs(Json, json, PrintTemplateList[0].ItemsHeaderType, 0);
                }


            }
        }
    },
    //保存 快速消费
    SaveQuickToSever: function () 
	{	    
		var obj = this;
		obj.payLog.user_id = obj.memInfo.user_id;
		obj.payLog.user_name = obj.memInfo.user_account;
		obj.payLog.member_grade_id = obj.memInfo.member_grade_id;
		if(obj.memInfo.member_grade_id > 0)
		{
			obj.payLog.member_grade_discountrate = obj.memInfo.LevelInfo.member_grade_discountrate;
		}
		
        $.ajax({
            url: SYS.CONFIG.index_url + '?ctl=Cashier_Quick&met=saveQuickConsume&typ=json',
            type: 'post',
            data: obj.payLog,
            dataType: "json",
            success: function (data) 
			{
                if (data && data.status == 200) 
				{				
					var data = data.data;
                    if ($("#Print_div").attr("class") == "active") 
					{
                        //obj.PrintXP(data.printData, {});
                    }
                    $("#img-buffer").removeAttr("src");
                    $("#PayCheckOutModal").modal("hide");
                    $("#myModalPay").modal("hide");
 
					//清空会员信息                    
                    MemberSelect.initMember();
					obj.memInfo = Object;
                    alertMessage(__('操作成功'));
                    obj.refresh();
                }
                else {
                    alertError(__('操作失败'));
                }
                $("#btnZhifu").removeAttr("disabled");
            }
        });
    },
    //刷新
    refresh: function () 
	{
        $("#memberKey").val("");
        $("#consumptionForm")[0].reset();
        this.closePayCheckOutModal();
    }
}
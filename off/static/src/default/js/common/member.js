jQuery(document).ready(function ($) 
{
	MemberSelect.init();
});

//选择会员模块
var MemberSelect = {
    flag: 0,
    cardNo: "",
    init: function () 
	{
        var obj = this;
		$("#memberKey").focus();
		
        $("#btn-search").bind("click", function () {
            obj.cardNo = $("#cardNo").val().trim();
            obj.memberRefresh();
        });
		
        $("#cardNo").on("keyup", function () {
            e = arguments.callee.caller.arguments[0] || window.event
            if (e.keyCode == 13) {
                obj.cardNo = $("#cardNo").val().trim();
                obj.memberRefresh();
            }
        });
		
        $("#myModalMember").on("hide.bs.modal", function () {
            $("#cardNo").val('');
        });
		
		//查询会员信息
		$("#bth-member").click(function()
		{
			var name = $("#memberKey").val();
			if(name == "")
			{
				return ;
			}
			obj.flag = $('#memberKey').attr("data-flag");
			obj.memberModel();
		});
 
        $("#memberKey").on('focus change keyup', function () 
		{
            var name = $("#memberKey").val().trim();
            event = arguments.callee.caller.arguments[0] || window.event
            if (event.keyCode == 13 && name != "") 
			{
				obj.flag = $('#memberKey').attr("data-flag");
                obj.memberModel();
            }
        });
    },
    memberTable: function () 
	{
		var obj = this;
        var pageSize = 10;
        var table = $("#MemberCarData");
 
        $(table).bootstrapTable('destroy');
        $(table).bootstrapTable({
            url: SYS.CONFIG.index_url + '?ctl=Member_Info&met=memberLists&typ=json',
            method: 'get',
            toolbar: '#Member_toolbar',
            striped: true,
            pagination: true,
            singleSelect: true,
            queryParamsType: "undefined",
            queryParams: function queryParams(params) {
                var param = {
                    page: params.pageNumber,
                    rows: params.pageSize,
                    cardNo: (obj.cardNo == undefined ? "" : obj.cardNo),
                };
                return param;
            },
            sidePagination: "server",
            pageNumber: 1,
            pageSize: pageSize,
            pageList: [pageSize, 20, 50, 100],
            showColumns: false,
            minimumCountColumns: 2,
            uniqueId: "user_id",
            clickToSelect: true,
            columns: obj.memberColumns(),
            formatLoadingMessage: function(){
				return "";
			},
			responseHandler:function(res){
				var tableData = {};
				tableData.rows  = res.data.items;
				tableData.total = res.data.records;
				if(res.data.records == 1)
				{
					obj.MemberCardId(tableData.rows[0].user_id);
					return false;
				}
				
				$('#myModalMember').modal({ backdrop: 'static', keyboard: false });
				return tableData;
			}
        });
    },
    //会员列绑定
    memberColumns: function () 
	{
        var columns = [];
        columns = [
            { field: 'user_account', align: 'left', halign: 'left', title: '会员卡号', width: "10%" },
            { field: 'user_realname', title: __("会员姓名"), align: 'left', halign: 'left', width: "10%" },
            { field: 'user_mobile', title: __("手机号码"), align: 'left', halign: 'left', width: "10%" },
            { field: 'member_grade_name', title: __("等级"), align: 'left', halign: 'left', width: "10%" },
            { field: 'member_points', title: __("积分"), align: 'left', halign: 'left', width: "10%", edit: false },
            {
                field: '_o_', title: __("操作"), align: 'left', halign: 'left', width: "10%", formatter: function (value, row, index) {
                    var fo = '';
                    fo += "<a href='#' style='display:inline-block;color:#2085f8;height:20px;line-height:20px;width:100%;'  onclick='MemberSelect.MemberCardId(\"" + row.user_id + "\")'>"+__("选择")+"</a>";
                    return fo;
                }
        }];
		
        return columns;
    },
    //刷新会员列表
    memberRefresh: function () 
	{
		var obj = this;
		obj.memberTable();
    },
    //选择会员
    MemberCardId: function (user_id) 
	{		
        var obj = this;
		console.log(obj.flag);
        if (user_id == "" || user_id == null) {
            return;
        } else {
            $('#myModalMember').modal('hide');
			obj.memberInfo(user_id);
        }
    },
    //加载会员信息
    memberModel: function () 
	{
		var obj = this;
        var card = $.trim($("#memberKey").val());
        if (card == undefined || card == "") return;
 
        obj.cardNo = card;
		console.log(obj.cardNo);
        obj.memberTable();
        $('#cardNo').val(card);
    },
	memberInfo: function(user_id)
	{
		var obj = this;
		var flag = obj.flag;
		obj.initMember();
		if(user_id)
		{
			$.get(SYS.CONFIG.index_url + '?ctl=Member_Info&met=memberInfo&typ=json&user_id='+ user_id, function (res) 
			{
				if (res && res.status == 200)
				{
					var data = res.data.info;	
					$("#edt_Pay").attr('disabled', false);
					
					//会员标签
					var labelArry = res.data.label;						
					if (labelArry.length > 0) 
					{
						var tagHtml = "";
						$.each(labelArry, function (i, t) {
							t.member_label_color = (t.member_label_color == undefined || t.member_label_color == null || t.member_label_color == "" || t.member_label_color.length < 1) ? "background: #ffa012" :"background:" + t.member_label_color;
							tagHtml += '<li style="' + t.member_label_color + '">' + t.member_label_name + '</li>';
						});
						$("#tag_name").html(tagHtml);
					}
					
					$("#member_points").html(PointPrecision(data.member_points)); //会员积分
					$("#member_account").html(data.user_account);
					if(data.member_card == null)
					{
						data.member_card = data.user_account;
					}
					$("#member_card").html('NO.'+data.member_card); 
					
					//会员折扣信息
					if(res.data.level.member_grade_id)
					{
						var discount_str = res.data.level.member_grade_discountrate == 1 ? __("不打折") : ((res.data.level.member_grade_discountrate - 0) * 10 + __("折"));
						$("#member_grade_name").html(res.data.level.member_grade_name + "(" + discount_str + ")");
					}
 
					$("#user_birthday").html(data.user_birthday); //生日
					if (data.user_avatar != null && data.user_avatar != "") 
					{
						$("#avatar").attr('src', data.user_avatar);
					} else {
						$("#avatar").attr('src', SYS.CONFIG.static_url+"/images/infoPic.jpg");
					}
 
					//会员手机号
					if (data.user_mobile.length == 11) 
					{
						$("#user_mobile").html(data.user_mobile.replace(/^(\d{3})\d{4}(\d+)/, "$1****$2"));
					} else {
						$("#user_mobile").html(data.user_mobile);
					}
					$("#div_MemInfo").show(); //最后一起显示
					
					if(flag == 102)
					{
						QuickCashier.memInfo = res.data.info;
						QuickCashier.memInfo.LevelInfo = res.data.level;
						QuickCashier.PointPercent = res.data.level.member_grade_pointsrate;
						QuickCashier.memInfo.Money = data.member_money;
						QuickCashier.memInfo.Point = data.member_points;
						QuickCashier.calcPoint();
						QuickCashier.payLog.MemID = data.user_id;
						QuickCashier.payLog.CardID = data.user_account;	
					}
					if(flag == 103)
					{
						console.log(flag);
						if ((user_id != GoodsCashier.orderLog.CardID && GoodsCashier.orderLog.CardID != "0000") || GoodsCashier.orderLog.BillCode != null) {
							GoodsCashier.TableEmpty();
						}
						
						GoodsCashier.memInfo = res.data.info;
						GoodsCashier.memInfo.LevelInfo = res.data.level; //关键性的会员等级数据
							
						GoodsCashier.loadFooter();
						GoodsCashier.orderLog.MemID = data.user_id;
						GoodsCashier.orderLog.CardID = data.user_account;
						GoodsCashier.orderLog.CardName = data.user_realname;
						GoodsCashier.orderLog.Mobile = data.user_mobile;
						GoodsCashier.orderLog.member_grade_discountrate =GoodsCashier.memInfo.LevelInfo.member_grade_discountrate;
						GoodsCashier.orderLog.member_grade_pointsrate = GoodsCashier.memInfo.LevelInfo.member_grade_pointsrate;

						if (GoodsCashier.orderLog.orderData.length > 0) 
						{
							GoodsCashier.calcBuyCart();
						}							
					}
					
					if(flag == 107)
					{
						PointsExchange.bindMemInfo(res.data);
					}
					
					if(flag == 108)
					{
						PointsManage.bindMemInfo(res.data);
					}
				}
			},'json');
		}
	},
	initMember: function()
	{
		$("#member_account").html("");
        $("#tag_name").html("");
        $("#member_grade_name").html('');
        $("#member_card").html('');
        $("#user_birthday").html('');
        $("#user_mobile").html('');
        $("#member_points").html('');
	}
}
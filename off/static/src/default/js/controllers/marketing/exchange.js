jQuery(document).ready(function ($) 
{
    PointsExchange.init();
});

var PointsExchange = {
    flag: 1,
    memInfo: Object,
    user_id: 0,
    giftsData: [],
    giftList: [],
    postGiftData: {},
    init: function () 
	{
        var obj = this;
        obj.event();
        obj.getTableGift();
    },
    event: function () 
	{
        var obj = this;
        obj.getGiftList(); //礼品列表Table
        
		//选择礼品
        $("#btn-gift").on('click', function () 
		{
            $("#btn-exchange").removeAttr("disabled");
            if(obj.user_id != "") 
			{
				$('#giftModal').modal({ backdrop: 'static', keyboard: false });
            } else {
                alertError(__("请选择会员"));
            }
        });
  		
        //礼品模态框关闭
        $("#giftModal").on('hide.bs.modal', function () 
		{        
            $("#giftForm")[0].reset(); //关闭
        });
		
		//选择礼品
		$("#btn-confirm").on('click', function () {
            obj.loadCartData();
        });

		//兑换礼品
        $("#btn-exchange").on('click', function () {
            $("#btn-exchange").attr("disabled", "disabled");
            obj.exchange();
        });

        //礼品查询
        $("#btn-gift-search").on('click', function (e) {
            $("#giftModalData").bootstrapTable('refresh');
        });
    },
    getTableGift: function ()
	{
		//绑定要兑换的礼品数据		
        var obj = this;
        $("#tableWrapper").bootstrapTable({
            editable: true,
            clickToSelect: false,
            uniqueId: "points_gift_id",
            data: [],
            formatLoadingMessage: function(){return "";},
            columns: obj.getColmuns(),
        });
    },
    //绑定列
    getColmuns: function () 
	{
        var colmuns = [
           { field: 'points_gift_code', title: __('礼品编号'), align: 'left', halign: 'left', width: "15%", edit: false },
           { field: 'points_gift_name', title: __('礼品名称'), align: 'left', halign: 'left', width: "40%", edit: false },
           {
               field: 'quantity', title: __('数量'), align: 'left', halign: 'left', width: "20%", formatter: function (value, row, index) {
                   return '<input type="number" min="1" value="' + value + '" onchange="PointsExchange.validatorText(this,' + index + ')"  class="form-control bdkd" />';
               }
           },
           {
               field: 'points_gift_points', title: __('兑换所需积分'), align: 'left', halign: 'left', width: "15%", edit: false, formatter: function (value, row, index) {
                   return ("<span style='color:red'>￥" + returnFloat(row.quantity * row.points_gift_points) + "</span>")
               }
           },
           {
               field: '_o_', title: __('操作'), align: 'left', halign: 'left', width: "10%", edit: false, formatter: function (value, row, index) {
                   var fo = '';
                   fo += '<span style="cursor:pointer" class="remove" onclick="PointsExchange.removeRow(\'' + row.points_gift_id + '\')"> <i class="fa fa-trash-o"></i> '+__('删除')+'</span>';
                   return fo;
               }
           }];
        return colmuns;
    },
    //删除要兑换的礼品
    removeRow: function (points_gift_id) 
	{
        var obj = this;
        obj.flag = 1;
        var delIndex = obj.contains(obj.giftsData, "" + points_gift_id + "");
        if (delIndex == -1) {
            alertError(__("未找到数据,删除失败"));
            return false;
        }
        obj.giftsData.splice(delIndex, 1);
        $("#tableWrapper").bootstrapTable('load', obj.giftsData);
        obj.reload();
    },
    //礼品数量计算辅助方法
    contains: function (arr, obj) {
        var i = arr.length;
        var index = -1;
        while (i--) {
            if (arr[i].points_gift_id == obj) {
                index = i;
                return index;
            }
        }
        return index;

    },
    //兑换礼品
    exchange: function () {
        var d = {};
        var obj = this;
        obj.postGiftData.remark = $("#remark").val();
		obj.postGiftData.user_id = obj.user_id;
        d.gifts = obj.giftList;
        d.postGiftData = obj.postGiftData;
        
		if (d.gifts.length < 1) {
            alertError(__("请选择要兑换的礼品！"));
            return;
        }
        if (obj.flag == 0) {
            alertError(__("兑换的数量数据格式错误！"));
            return;
        }

        $.ajax({
            url: SYS.CONFIG.index_url + '?ctl=Marketing_Points&met=addGiftOrder&typ=json',
            type: 'post',
            data: d,
			dataType:'json',
            success: function (data) 
			{
                if (data && data.status == 200)
				{
                    alertMessage(__("兑换成功"));
                    obj.refresh();
                } else {
                    alertError(data.msg);
					obj.refresh();
                }
				
                $("#btn-exchange").removeAttr("disabled");
            }
        });

    },
    //文本框change事件
    validatorText: function (val, index) {
        var obj = this;
        if (/^[0-9]*[1-9][0-9]*$/.test($(val).val())) {
            $("#tableWrapper").bootstrapTable('updateCell', { index: index, field: 'quantity', value: $(val).val() });
            obj.reload();
            $(val).removeAttr('style');
            obj.flag = 1;
        }
        else {
            $(val).attr('style', 'border:1px solid red');
            obj.flag = 0;
        }
    },
    //table数据改变重新赋值
    reload: function () {
        var obj = this;
        obj.giftList = [];
        var rows = $("#tableWrapper").bootstrapTable('getData');
        var totalPoint = 0.00;
        var totalNum = 0;
        $.each(rows, function (index, item) 
		{
            obj.giftList.push({
                points_gift_id: item.points_gift_id,
                points_gift_code: item.points_gift_code,
                points_gift_name: item.points_gift_name,
                points_gift_points: item.points_gift_points,
                quantity: item.quantity
            });
            totalNum += parseInt(item.quantity);
            totalPoint += parseFloat(returnFloat(item.points_gift_points * item.quantity));
        });
        obj.postGiftData.quantity = totalNum;
        obj.postGiftData.total_points = totalPoint;
        $("#exchange_num").html("<span style='color:red'>" + totalNum + "</span>");
        $("#exchange_points").html("<span style='color:red'>" + totalPoint + "</span>");

    },
    getGiftList: function () 
	{
        var obj = this;
		var pageSize = 10;
		$('#giftModalData').bootstrapTable('destroy').bootstrapTable({
            url: SYS.CONFIG.index_url + '?ctl=Marketing_Points&met=lists&typ=json',
            method: 'get',
            toolbar: "#toolbar",
            striped: true,
            pagination: true,
            singleSelect: false,
            queryParamsType: "undefined",
            queryParams: function queryParams(params) {
                var param = {
                    pageIndex: params.pageNumber,
                    pageRows: params.pageSize, 
					gift_code: $("#gift_code").val().trim()					
                };
                return param;
            },
            sidePagination: "server",
            pageNumber: 1,
            pageSize: pageSize,
            pageList: [2],
            showColumns: false,
            minimumCountColumns: 2,
            uniqueId: "points_gift_id",
            editable: true,
            clickToSelect: true,
            columns: obj.getGiftColumns(),
			responseHandler:function(res){
				var tableData = {};
				tableData.rows  = res.data.items;
				tableData.total = res.data.records;
				return tableData;
			},
			formatLoadingMessage: function(){
                return "";
            }
        });
    },
	//绑定礼品列
    getGiftColumns: function () {
        var columns = [
            { checkbox: true, halign: 'center', align: 'center', width: '5%', edit: false },
            { field: 'points_gift_name', align: 'left', title: __('礼品名称'), halign: 'left', width: "35%", edit: false },
            { field: 'points_gift_code', title: __('礼品编码'), align: 'left', halign: 'left', width: "30%", edit: false },
            { field: 'points_gift_stock', title: __('库存'), align: 'left', halign: 'left', width: "30%", edit: false },
            {
                field: 'points_gift_points', title: __('所需积分'), align: 'left', halign: 'left', width: "30%", edit: false,
            },
        ];
        return columns;
    },
    //确定选择的礼品
    loadCartData: function () {
        var obj = this;
        var rows = $("#giftModalData").bootstrapTable('getAllSelections');
        if (rows.length < 1) {
            alertError("请选择礼品");
            return false;
        };
        if (obj.giftsData.length > 0) {
            for (var item in rows) {
                var index = obj.contains(obj.giftsData, rows[item].points_gift_id);
                if (index != -1) {
                    obj.giftsData[index].quantity = obj.giftsData[index].quantity - 0.00 + 1;
                }
                else {
                    rows[item].quantity = 1;
                    obj.giftsData.push(rows[item]);

                }
            }
        }
        else {
            $.each(rows, function (i, t) {
                t.quantity = 1;
                obj.giftsData.push(t);
            });
        }
        $("#tableWrapper").bootstrapTable('load', obj.giftsData);
        obj.reload();
        $("#giftModal").modal('hide');
    },
	//获取会员数据
	bindMemInfo: function(res){
		var obj = this;		
		obj.memInfo = res.info;
		obj.user_id = res.info.user_id;
	},
	refresh: function(){
		var obj = this;
		obj.giftsData = [];
        obj.giftList = [];                   
        obj.memInfo = Object;
		obj.user_id = 0;
        $("#tableWrapper").bootstrapTable('load', obj.giftsData);
        obj.reload();
        $("#remark").val('');
		$("#memberKey").val('');
		MemberSelect.initMember();
	}
}
$(function () {
    GoodsAnalysis.init();
    GoodsAnalysis.GoodsEcharData(10);
})
//最近7天1，本月2，上月3，最近三个月4，其他时间5
var timer = 1;
var GoodsAnalysis = {
    timetype: 1,      //商品销售量时间标识
    ismember: 1,      //类型（总销售1，会员2.非会员3）标识
    hyxssjtype: 1,
    hyxskSaleshtype: 1,
    hyxsBtime: "",
    hyxsEtime: "",
    btime: "",
    etime: "",
    top: 1,
    ordertype: 1,
    Days: 7,
    order: 'order by totalnum desc',
    init: function () 
	{     
        var obj = this;
        $("#EveryDayConsumption").addClass(" in active");
        $(".btn-purple").removeClass("btn-custom");
      
        $("li a").on("click", function () 
		{
            var a = $("li a:eq(0)").attr("href");
            var b = $("li a:eq(1)").attr("href");
            var c = $("li a:eq(2)").attr("href");
            var e = $("li a:eq(3)").attr("href");
            var f= $("li a:eq(4)").attr("href");
            var d = $(this).attr("href");
            if (a == d) {
                $(a).addClass(" in active");
                $(b).removeClass("in");
                $(f).removeClass("in");
                $(c).removeClass("in");
                $(e).removeClass("in");
            }
            if (b == d) {              
                $(b).addClass(" in active");
                $(a).removeClass("in");
                $(f).removeClass("in");
                $(c).removeClass("in");
                $(e).removeClass("in");
            }
            else if (c == d) {
                $(c).addClass(" in active");
                $(a).removeClass("in");
                $(b).removeClass("in");
                $(e).removeClass("in");
                $(f).removeClass("in");
            }
            else if (e == d) {
                $(e).addClass("in active");
                $(a).removeClass("in");
                $(b).removeClass("in");
                $(c).removeClass("in");
                $(f).removeClass("in");
            }
            else if (f == d) {
                $(f).addClass("in active");
                $(a).removeClass("in");
                $(b).removeClass("in");
                $(c).removeClass("in");
                $(e).removeClass("in");
            }
        });
        $('#myTab li:eq(0) a').tab('show');
        $('#myTabTwo li:eq(0) a').tab('show');
       
        $('#myTab a').click(function (e) {
            $(this).tab('show')
            if ($(this).attr("href") == "#GoodsFX") {
                $('#datatable-responsive').bootstrapTable('destroy');
                obj.TimeFlag = 1;
                $("#DayGoodsClassFX").removeClass("btn-custom");
                $("#ThisMonthClassFX").addClass("btn-custom");
                $("#LastMonthClassFX").addClass("btn-custom");
                $("#LastTreeMonthClassFX").addClass("btn-custom");
                $("#LastTime2FX").addClass("btn-custom");
                GoodsFx.init();
            } else if ($(this).attr("href") == "#GoodsConsumption") {
                GoodsConsumSummary.init();
            } else if ($(this).attr("href") == "#EveryDayConsumption") 
			{
                $("#today").click();
            }
            else {
                obj.GoodsEcharData(10);
            }
        })
        $(".box1_a").on('click', function () {
            $(this).addClass('box1_a1');
            $(this).siblings().removeClass('box1_a1');
        });
        $(".box1_a2").on('click', function () {
            $(this).addClass('box1_a3');
            $(this).siblings().removeClass('box1_a3');
        });
        $(".a_link2").on('click', function () {
            $(this).addClass('a_link1');
            $(this).siblings().removeClass('a_link1');
        });
        $(".a_link3").on('click', function () {
            $(this).addClass('a_link4');
            $(this).siblings().removeClass('a_link4');
        });
        $('#myTabTwo a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
 
        //时间赋值
        var today = new Date();
        var Today = today.format("yyyy-MM-dd");
        $('#B_time').daterangepicker({
            format: 'YYYY-MM-DD',
            separator: __(' 至 '),
            opens: 'right',    // 日期选择框的弹出位置
            start: "", //开始时间，在这时间之前都不可选
            end: "",//结束时间，在这时间之后都不可选
            showDropdowns: true,
        });
        $('#B_time').val(Today + __(' 至 ') + Today);
 
        $('#B_time2').daterangepicker({
            format: 'YYYY-MM-DD',
            separator: __(' 至 '),
            opens: 'right',    // 日期选择框的弹出位置
            start: "", //开始时间，在这时间之前都不可选
            end: "",//结束时间，在这时间之后都不可选
            showDropdowns: true,
        });
        $('#B_time2').val(Today + __(" 至 ") + Today);
        obj.Event();

        $("#goodsTime5").click(function () {
            $("#Input_data1").css('display', 'block');

            $("#day").addClass("btn-custom");
            $("#week").addClass("btn-custom");
            $("#month").addClass("btn-custom");
            $("#year").addClass("btn-custom");
            $("#goodsTime5").removeClass("btn-custom");
        });
         
        $("#B_time").on('change', function () {
            $("#rdoTotalGoods").attr("disabled", false);
            $("#rdoMember").attr("disabled", false);
            $("#rdoNonMember").attr("disabled", false);
        });
        
        //每日销售预览-时间类型切换
        $("#time1,#time2,#time3,#time4").on('click', function () 
		{
			var id = $(this).attr("id");
			var timetype = 1*(id.substr(4,1));
            $("#time1").addClass("btn-custom");
            $("#time2").addClass("btn-custom");
            $("#time3").addClass("btn-custom");
            $("#time4").addClass("btn-custom");
            $("#time5").addClass("btn-custom");
			$("#"+id).removeClass("btn-custom");

            $("#Input_data").hide();
            $("#rdoTotalsales").prop("checked", "checked");
            timer = timetype;
            obj.hyxskSaleshtype = 1;
            obj.hyxssjtype = timetype;
            obj.Comprehensive();
        });
        $("#time1").click();
         
        //出现时间及绑定时间
        $("#time5").click(function () {
            $("#Input_data").css('display', 'block');
            $("#today").addClass("btn-custom");
            $("#btn_PreMonth").addClass("btn-custom");
            $("#btn_NextMonth").addClass("btn-custom");
            $("#RecentMarch").addClass("btn-custom");
            $("#time5").removeClass("btn-custom");
        });
        var sDay = new Date();
        sDay.setDate(sDay.getDate() - 7);
        var FristDay = sDay.format("yyyy-MM-dd");
        var today = new Date();
        var Today = today.format("yyyy-MM-dd");
        $('#ipt_BTime').daterangepicker({
            format: 'YYYY-MM-DD',
            separator: __(' 至 '),
            opens: 'right',    // 日期选择框的弹出位置
            start: "", //开始时间，在这时间之前都不可选
            end: "",//结束时间，在这时间之后都不可选
            showDropdowns: true,
        });
        $('#ipt_BTime').val(Today + __(" 至 ") + Today);
        //其他时间 点击查询事件
        $("#Data_input").on('click', function () {
            $("#rdoTotalsales").prop("checked", "checked");
            obj.hyxsBtime = $("#ipt_BTime").val().split(__(' 至 '))[0] == "" ? "" : $("#ipt_BTime").val().split(__(' 至 '))[0] + " 00:00:00";//消费开始时间
            obj.hyxsEtime = $("#ipt_BTime").val().split(__(' 至 '))[1] == undefined ? "" : $("#ipt_BTime").val().split(__(' 至 '))[1] + " 23:59:59";//消费结束时间
            timer = 5;
            obj.hyxskSaleshtype = 1;
            obj.hyxssjtype = 5;
            obj.Comprehensive();
        });
        //1、今日的点击事件,2、本月的点击事件,3、上月的,4、最近三个月,5、其他时间
        $("#rdoTotalsales").click(function () {
            //总销售
            obj.getTimeType(timer,1);
            obj.Comprehensive();
        });

        $("#rdoMemberCard").click(function () {
            //会员
            obj.getTimeType(timer,2);
            obj.Comprehensive();
        });

        $("#rdoSK").click(function () {
            //非会员
            obj.getTimeType(timer,3);
            obj.Comprehensive();
        });

        $("#B_time").on('change', function () {

            $("#rdoTotalsales").attr("disabled", false);
            $("#rdoMemberCard").attr("disabled", false);
            $("#rdoSK").attr("disabled", false);
        });
    },
    Event: function () {
        var obj = this;
        
		//商品销售量-时间类型切换
        $("#goodsTime1,#goodsTime2,#goodsTime3,#goodsTime4").on("click", function () 
		{
			var id = $(this).attr("id");
			var timetype = 1*(id.substr(9,1));
			
			$("#goodsTime1").addClass("btn-custom");
			$("#goodsTime2").addClass("btn-custom");
			$("#goodsTime3").addClass("btn-custom");
			$("#goodsTime4").addClass("btn-custom");
			$("#goodsTime5").addClass("btn-custom");		
			$('#'+id).removeClass("btn-custom");

			$("#Input_data1").hide();
			$("#rdoTotalGoods").prop("checked", "checked");
			obj.ismember = 1;
			obj.timetype = timetype;
			obj.getTopGoods();
        });
		 
        //其他时间
        $("#GoodsRefrsh").on("click", function () {

            obj.timetype = 5;
            //var btime = new Date($("#B_time").val());
            //var etime = new Date($("#E_time").val());
            //obj.btime = btime.format("yyyy-MM-dd 00:00:00");
            //obj.etime = etime.format("yyyy-MM-dd 23:59:59");
            obj.btime = $("#B_time").val().split(__(' 至 '))[0] == "" ? "" : $("#B_time").val().split(__(' 至 '))[0] + " 00:00:00";//消费开始时间
            obj.etime = $("#B_time").val().split(__(' 至 '))[1] == undefined ? "" : $("#B_time").val().split(__(' 至 '))[1] + " 23:59:59";//消费结束时间
            var DayNum = Math.ceil(((new Date(obj.etime).getTime() - new Date(obj.btime).getTime()) / (24 * 60 * 60 * 1000)));
            obj.Days = DayNum;
            //var dateNow = new Date(Date.now()).format("yyyy-MM-dd 23:59:59");
            obj.getTopGoods();
        });

        //商品销量排行榜
        $("#top1,#top2,#top3,#top4,#top5").on("click", function () 
		{
			var id = $(this).attr("id");
            $("#top1").addClass("btn-custom");
            $("#top2").addClass("btn-custom");
            $("#top3").addClass("btn-custom");
			$("#top4").addClass("btn-custom");
            $("#top5").addClass("btn-custom");
			
			$("#"+id).removeClass("btn-custom");
            obj.top = 1*(id.substr(3,1));
			obj.getTopGoods();
        });
         
        //按金额显示
        $("#TotalMoney").on("click", function () {
            $("#TotalMoney").attr("class", "btn btn-warning");
            $("#TotalNum").attr("class", "btn btn-deafault");
            obj.ordertype = 1;
            obj.order = "order by totalMoney desc";
            obj.getTopGoods();
        });

        //按数量显示
        $("#TotalNum").on("click", function () {
            $("#TotalNum").attr("class", "btn btn-warning");
            $("#TotalMoney").attr("class", "btn btn-deafault");
            obj.ordertype = 2;
            obj.order = "order by totalNum desc";
            obj.getTopGoods();
        });

        //总销售
        $('#rdoTotalGoods').on('click', function () {
            obj.ismember = 1;
            obj.getTopGoods();
        });
        //会员
        $('#rdoMember').on('click', function () {
            obj.ismember = 2;
            obj.getTopGoods();
        });
        //非会员
        $('#rdoNonMember').on('click', function () {
            obj.ismember = 3;
            obj.getTopGoods();
        });
    },
    //每日销售概览table 判断时间返回值
    JudgListTable: function (tmptime, List) {
        var html = "";
        var AddMember = 0;
        var TotalConsumption = 0;
        var PurchasePrice = 0;
        var Profit = 0;
        var Freight = 0;
        html = "<tr><td>" + tmptime + "</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
        if (List != null && List.length > 0) {
            for (var i = 0; i < List.length; i++) {
                if (List[i].CreateTime.substring(0, 10) == tmptime) {
                    AddMember = List[i].AddMember;
                    TotalConsumption += (List[i].TotalConsumption == null ? 0 : List[i].TotalConsumption);
                    PurchasePrice += (List[i].PurchasePrice == null ? 0 : List[i].PurchasePrice);
                    Profit += (List[i].Profit == null ? 0 : List[i].Profit);
                    Freight += (List[i].Freight == null ? 0 : List[i].Freight);
                }
                html = "<tr><td>" + tmptime + "</td><td>" + AddMember + "</td><td>" + TotalConsumption.toFixed(2) + "</td>";
                html += "<td>" + PurchasePrice.toFixed(2) + "</td><td>" + Profit.toFixed(2) + "</td><td>" + Freight + "</td></tr>"
            }
        }
        return html;
    },

    Comprehensive: function () {
        var obj = this;
        obj.TotalMoneyEchar();
    },
    //图表数据
    TotalMoneyEchar: function () {
        var obj = this;
        var ShopID = shopInfo.IsMasterShop == 1 ? "" : shopInfo.Id;
        var btime;
        var etime;
        obj.timelist = new Array();
        var date = new Date();
        if (obj.hyxssjtype == 5) 
		{
            //其他时间
            //开始时间    结束时间
            var btime = new Date($("#ipt_BTime").val().split(__(' 至 '))[0] == "" ? "" : $("#ipt_BTime").val().split(__(' 至 '))[0] + " 00:00:00");//消费开始时间
            var etime = new Date($("#ipt_BTime").val().split(__(' 至 '))[1] == undefined ? "" : $("#ipt_BTime").val().split(__(' 至 '))[1] + " 23:59:59");//消费结束时间
            while ((etime.getTime() - btime.getTime()) >= 0) {
                var year = btime.getFullYear();
                var month = (btime.getMonth() + 1).toString().length == 1 ? "0" + (btime.getMonth() + 1).toString() : btime.getMonth() + 1;
                var day = btime.getDate().toString().length == 1 ? "0" + btime.getDate() : btime.getDate();
                obj.timelist.push(year + "-" + month + "-" + day);
                btime.setDate(btime.getDate() + 1);
            }
        }
        var myChartBar = echarts.init(document.getElementById('SaleEcharData'));
        var optionsBar = {
            color: ['#72CAFC', '#FF00FF'],
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                selectedMode: false,
                data: [__("销售金额")]
            },
            xAxis: [
                {
                    type: 'category',
                    data: []
                }
            ],
            yAxis: [
                {
                    type: 'value',
                    axisLabel: {
                        formatter: '{value}'
                    }
                }
            ],
            series: [
                {
                    name: __('销售金额'),
                    type: 'line',
                    data: []
                }
            ]
        };
       
        var listday = new Array();
        var html = " <thead><tr><th>" + __('日期') + "</th><th>" + __('消费笔数') + "</th><th>" + __('销售金额') + "</th><th>"+__("商品成本")+"</th><th>"+__("毛利润")+"</th></tr></thead>";
        $.ajax({
            url: SYS.CONFIG.index_url + '?ctl=Report_Goods&met=salesList&typ=json',
            type: 'get',
            data: {
				timetype: obj.hyxssjtype, 
				ismember: obj.hyxskSaleshtype, 
				begintime: obj.hyxsBtime, 
				endtime: obj.hyxsEtime 
			},
            async: true,
			dataType: 'json',
            success: function (data) {
                if (data && data.status == 200) 
				{
					if (data.data.totalMoney == null) 
					{
                            $("#TotalSales").html(0);
                    }
                    if (data.data.totalNum == null) {
                        $("#sumProfit").html(0);
                    }
                    if (data.data.totalMoney != null && data.data.totalNum != null) 
					{
                        $("#TotalSales").html(data.data.totalMoney);
                        $("#sumProfit").html(data.data.totalNum);
                    }
					
					data.List = data.data.lists;
                    if (data.List.length > 0) 
					{
                        var categories = [];
                        var MonthCharge = [];
                        var MonthProfit = [];
                        var tmptime = "";
                        var list = data.List.filter(function (item) {
                            return item.CreateTime != __("总计");
                        })
                        $.each(list, function (index, item) {
                            categories.push(item.CreateTime);
                            MonthCharge.push(item.TotalConsumption);
                            //MonthProfit.push(item.Profit);
                        });
                        optionsBar.xAxis[0].data = categories;
                        optionsBar.series[0].data = MonthCharge;
                        //optionsBar.series[1].data = MonthProfit;
                        myChartBar.setOption(optionsBar);
                        myChartBar.hideLoading();
                        $.each(data.List, function (i, t) {
                            html += "<tr><td>" + t.CreateTime + "</td><td>" +t.totalNum + "</td><td>" + (t.TotalConsumption == null ? 0 : t.TotalConsumption) + "</td>";
                            html += "<td>" + (t.totalCost == null ? 0 : t.totalCost) + "</td><td>" + (t.profit == null ? 0 : t.profit) + "</td></tr>"
							html += "</tr>";

                        });
                        $("#SalesTable_list").html(html);
                    } else {
                        $("#SalesTable_list").html(html);
                    }
                } else {

                }
            }
        });
    },
    //商品销量图表
    GoodsEcharData: function (top) {
        var html = "<thead><tr class='well'><th>" + __('排名') + "</th><th>" + __('商品名称') + "</th><th>" + __('销售数量') + "</th><th>" + __('销售总额') + "</th></tr></thead>"
        var obj = this;
        var topNum = top;
        var myChartBar = echarts.init(document.getElementById('GoodsEcahrData'));
        var optionsBar = {
            title: {
                x: 'center',
                text: __('会员消费排行top') + topNum,
            },
            color: ['#72CAFC'],
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: []
            },
            calculable: false,
            xAxis: [
                {
                    type: 'category',
                    data: [],
                    axisLabel: {
                        //interval: 0,
                        rotate: 0,//倾斜度 -90 至 90 默认为0  
                    }
                }
            ],
            yAxis: [
                {
                    type: 'value',
                    axisLabel: {
                        formatter: '{value}'
                    }
                }
            ],
            series: [
                {
                    name: __('商品数据'),
                    type: 'bar',
                    data: []
                }
            ]
        };
        $.ajax({
            url: SYS.CONFIG.index_url + '?ctl=Report_Goods&met=salesAnalysisList&typ=json',
            type: 'get',
            data: {
				timetype: obj.timetype, 
				ismember: obj.ismember, 
				begintime: obj.btime, 
				endtime: obj.etime, 
				top: topNum, 
				order: obj.order, 
			},
            async: true,
			dataType: 'json',
            success: function (data) { 
                if (data && data.status == 200) 
				{
					data.List = data.data;
                    if (data.List.length > 0) {
                        //商品销售量table    
                        $("#Goods_list").show();
                        var totalNum = 0;
                        var totalMoney = 0;
                        for (var item in data.List) {
                            html += "<tr><td>" + (parseInt(item) + 1) + "</td><td>" + data.List[item].GoodsName + "</td>" + "</td>"
                            html += "<td>" + data.List[item].TotalNum + "</td><td>" + data.List[item].TotalMoney.toFixed(2) + "</tr>";
                            totalNum = totalNum + parseInt(data.List[item].TotalNum);
                            totalMoney = totalMoney + parseFloat(data.List[item].TotalMoney.toFixed(2));
                        }
                        html += "<tr><td>合计：</td><td></td><td>" + totalNum + "</td><td>" + totalMoney.toFixed(2) + "</td></tr>";
                        $("#Goods_list").html(html);

                        $("#GoodsEcahrData").show();
                        var categories = "[";
                        var MonthCharge = "[";
                        if (obj.ordertype == 1) {
                            for (var item in data.List) {
                                if (item > 0) {
                                    categories += ",";
                                    MonthCharge += ",";
                                }
								//var goodsName = data.List[item].GoodsName.substring(0,10)+'...';
								var num = item*1+1;
                                categories += "\"" + num + "\"";
                                MonthCharge += data.List[item].TotalMoney;
                            }
                        } else {
                            for (var item in data.List) {
                                if (item > 0) {
                                    categories += ",";
                                    MonthCharge += ",";
                                }
								//var goodsName = data.List[item].GoodsName.substring(0,10)+'...';
								var num = item*1+1;
                                categories += "\"" + num + "\"";
                                MonthCharge += data.List[item].TotalNum;
                            }
                        }
                        categories += "]";
                        MonthCharge += "]";
                        optionsBar.xAxis[0].data = eval('(' + categories + ')');
                        optionsBar.series[0].data = eval('(' + MonthCharge + ')');
                        myChartBar.setOption(optionsBar);
                        myChartBar.hideLoading();
                    } else {
                        $("#GoodsEcahrData").hide();
                        $("#Goods_list").html(html);
                    }
                } else {

                }
            }
        });
    },
    DateDiff: function (sDate1, sDate2) {
        var obj = this;
        var aDate, oDate1, oDate2, iDays;
        aDate = sDate1.split("-");
        oDate1 = new Date(aDate[1] + '-' + aDate[2] + '-' + aDate[0]);  //转换为yyyy-MM-dd格式
        aDate = sDate2.split("-");
        oDate2 = new Date(aDate[1] + '-' + aDate[2] + '-' + aDate[0]);
        iDays = parseInt(Math.abs(oDate1 - oDate2) / 1000 / 60 / 60 / 24) + 1; //把相差的毫秒数转换为天数
        return iDays;  //返回相差天数
    },
	getTimeType: function(timer,ismember)
	{
		var obj = this;
		obj.hyxskSaleshtype = ismember;
		obj.hyxssjtype = timer;
        if (timer == 5) 
		{
            obj.hyxsBtime = $("#ipt_BTime").val().split(__(' 至 '))[0] == "" ? "" : $("#ipt_BTime").val().split(__(' 至 '))[0] + " 00:00:00";//消费开始时间
            obj.hyxsEtime = $("#ipt_BTime").val().split(__(' 至 '))[1] == undefined ? "" : $("#ipt_BTime").val().split(__(' 至 '))[1] + " 23:59:59";//消费结束时间
        }
	},
	getTopGoods: function()
	{
		var obj = this;
		var topVal = obj.top;
		switch(topVal)
		{
			case 1: obj.GoodsEcharData(10);break;
			case 2: obj.GoodsEcharData(20);break;
			case 3: obj.GoodsEcharData(30);break;
			case 4: obj.GoodsEcharData(50);break;
			case 5: obj.GoodsEcharData(100);break;
		}
	}
}
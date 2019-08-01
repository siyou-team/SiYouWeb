var MemberAnalysis = {};
lbl_SmsCount, lbl_Consume, Data_inputfx
$(function () {
    MemberAnalysis.init();
});

MemberAnalysis = {
    type: 1,
    begintime: "",
    endtime: "",
    hyxftype: 1,
    hyxfbegintime: "",
    hyxfendtime: "",
    hyfxbtime: "",
    hyfxetime: "",
    day: "",
    InitVariable: {
        btime: "",
        etime: ""
    },
    mrdzdBtime: "",
    mrdzdEtime: "",
    timelist: new Array(),
    init: function () 
	{
        var obj = this;
        $(".btn-purple").removeClass("btn-custom");
 
        //头部菜单切换
        $('#myTab a').click(function (e) 
		{
            $(".btn-purple").removeClass("btn-custom");
            $(".btn-primary").addClass("btn-custom");
            $(".btn-warning").addClass("btn-custom");
            $("#edt_ShopSearch").removeClass("btn-custom");
            $(".btn-success").addClass("btn-custom");
			
            $(this).tab('show');
            if ($(this).attr("href") == "#Member") 
			{
                $("#Input_data2").css('display', 'none');
                obj.hyxftype = 1;
                obj.OninitSex();
            }
            else {
                $("#Input_data1").css('display', 'none');
                obj.type = 1;
                obj.Oninit();
            }
        });

        obj.Oninit();
        $("#Input_data1").collapse({ toggle: false });
		
        $('#B_time').daterangepicker({
            format: 'YYYY-MM-DD',
            separator: __(' 至 '),
            opens: 'right',    // 日期选择框的弹出位置
            start: "",         //开始时间，在这时间之前都不可选
            end: "",           //结束时间，在这时间之后都不可选
            showDropdowns: true,
        });
        
		//今天 消费时间赋值
        var today = new Date();
        var Today = today.format("yyyy-MM-dd");
        $('#B_time').val(Today + __(" 至 ") + Today);
		
		$('#B_time2').daterangepicker({
            format: 'YYYY-MM-DD',
            separator: __(' 至 '),
            opens: 'right',    // 日期选择框的弹出位置
            start: "",         //开始时间，在这时间之前都不可选
            end: "",           //结束时间，在这时间之后都不可选
            showDropdowns: true,
        });
        $('#B_time2').val(Today + __(" 至 ") + Today);


        //会员消费 最近时间
        $("#LastTime2").click(function () {
            $("#Input_data2").css('display', 'block');

            $(".btn-success").removeClass("btn-custom");
            $(".btn-purple").addClass("btn-custom");
            $(".btn-primary").addClass("btn-custom");
            $(".btn-warning").addClass("btn-custom");
        });
        
		obj.event();
    },
	event: function()
	{
		var obj = this;
		$("#time1,#time2,#time3,#time4,#time5").on('click', function () 
		{
			var id = $(this).attr("id");
			var timetype = 1*(id.substr(4,1));
            $("#time1").addClass("btn-custom");
            $("#time2").addClass("btn-custom");
            $("#time3").addClass("btn-custom");
            $("#time4").addClass("btn-custom");
            $("#time5").addClass("btn-custom");
			$("#"+id).removeClass("btn-custom");
 
			if(id == 'time5')
			{
				$("#Input_data1").css('display', 'block');
			}else{
				$("#Input_data1").hide();
				obj.ConsumptionSummary(timetype);
			}
			
        });
		
		$("#mtime1,#mtime2,#mtime3,#mtime4,#mtime5").on('click', function () 
		{
			var id = $(this).attr("id");
			var timetype = 1*(id.substr(5,1));
            $("#mtime1").addClass("btn-custom");
            $("#mtime2").addClass("btn-custom");
            $("#mtime3").addClass("btn-custom");
            $("#mtime4").addClass("btn-custom");
            $("#mtime5").addClass("btn-custom");
			$("#"+id).removeClass("btn-custom");

			obj.ConsumptionSummary(timetype);
			if(id == 'mtime5')
			{
				$("#Input_data2").css('display', 'block');
			}else{
				$("#Input_data2").hide();
				obj.SexConsumptionSummary(timetype);
			}
        });
	},
    //消费概要 起始方法
    Oninit: function () {
        var obj = this;
        obj.SevenEchart();
    },
    //会员消费饼图
    SevenEchart: function () {
        $("#MemberEcharData").show();
        $("#MemberEcharData").attr("style", "height: 300px; width: 400px;");
        var obj = this;
        var ptChartArea = echarts.init(document.getElementById('MemberEcharData'));
        optionsArea = {
            color: ['#50BCFA', '#FD6E74'],
            title: {
                text: '',
                x: 'center'
            },
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c}({d}%)"
            },
            legend: {
                orient: 'horizontal',
                y: 'top',
                selectedMode: false,
                data: [__('会员'), __('非会员')]
            },
            toolbox: {
                show: true,
            },
            calculable: false,
            series: [
                {
                    name: __('交易'),
                    type: 'pie',
                    radius: '55%',
                    center: ['50%', '50%'],
                    itemStyle: {
                        normal: {
                            label: {
                                show: true,
                                formatter: '{b} : {d}%'
                            }
                        }
                    },
                    data: []
                }
            ]
        };
		
		//获取会员消费饼状图 - bx
        $.ajax({ 
            url: SYS.CONFIG.index_url + '?ctl=Report_Member&met=getMemberConsumption&typ=json',
            type: 'post',
            data: {
				timetype: obj.type, 
				begintime: obj.begintime, 
				endtime: obj.endtime 
			},
			dataType: 'json',
            async: true,
            success: function (data) 
			{             
                if (data && data.status == 200) 
				{
					data.List = data.data;
                    if (data.List.length > 0) 
					{
                        //会员消费  非会员消费
                        if (data.List[0] != undefined && data.List[0].name == "非会员") {
                            if (data.List[0].totalMoney == null) {
                                data.List[0].totalMoney = 0;
                            }
                            $("#UnTotalMoney").html(__("￥") + data.List[0].totalMoney.toFixed(2));
                            $("#UnTotalSum").html(data.List[0].totalNum + __("笔"));
                            if (data.List[0].avgMoney == null) {
                                data.List[0].avgMoney = 0;
                            }
                            $("#UnSevenAvgMoney").html(__("￥") + data.List[0].avgMoney.toFixed(2));
                            if (data.List[0].avgProfit == null) {
                                data.List[0].avgProfit = 0;
                            }
                            $("#UnSevenAvgProfit").html(__("￥") + data.List[0].avgProfit.toFixed(2));
                        } else if (data.List[1] != undefined && data.List[1].name == "非会员") {
                            if (data.List[1].totalMoney == null) {
                                data.List[1].totalMoney = 0;
                            }
                            $("#UnTotalMoney").html(__("￥") + data.List[1].totalMoney.toFixed(2));
                            $("#UnTotalSum").html(data.List[1].totalNum + __("笔"));
                            if (data.List[1].avgMoney == null) {
                                data.List[1].avgMoney = 0;
                            }
                            $("#UnSevenAvgMoney").html(__("￥") + data.List[1].avgMoney.toFixed(2));
                            if (data.List[1].avgMoney == null) {
                                data.List[1].avgMoney = 0;
                            }
                            $("#UnSevenAvgProfit").html(__("￥") + data.List[1].SevenAvgProfit.toFixed(2));
                        } else {
                            $("#UnTotalMoney").html(__("￥0"));
                            $("#UnTotalSum").html(__("0笔"));
                            $("#UnSevenAvgMoney").html(__("￥0"));
                            $("#UnSevenAvgProfit").html(__("￥0"));
                        }
                        if (data.List[0] != undefined && data.List[0].name == "会员") {
                            if (data.List[0].totalMoney == null) {
                                data.List[0].totalMoney = 0;
                            }
                            $("#totalMoney").html(__("￥") + data.List[0].totalMoney.toFixed(2));
                            $("#totalNum").html(data.List[0].totalNum + __("笔"));
                            if (data.List[0].avgMoney == null) {
                                data.List[0].avgMoney = 0;
                            }
                            $("#SevenAvgMoney").html(__("￥") + data.List[0].avgMoney.toFixed(2));
                            if (data.List[0].avgProfit == null) {
                                data.List[0].avgProfit = 0;
                            }
                            $("#SevenAvgProfit").html(__("￥") + data.List[0].SevenAvgProfit.toFixed(2));
                        } else if (data.List[1] != undefined && data.List[1].name == "会员") {
                            if (data.List[1].totalMoney == null) {
                                data.List[1].totalMoney = 0;
                            }
                            $("#totalMoney").html(__("￥") + data.List[1].totalMoney.toFixed(2));
                            $("#totalNum").html(data.List[1].totalNum + __("笔"));
                            if (data.List[1].avgMoney == null) {
                                data.List[1].avgMoney = 0;
                            }
                            $("#SevenAvgMoney").html(__("￥") + data.List[1].avgMoney.toFixed(2));
                            if (data.List[1].avgProfit == null) {
                                data.List[1].avgProfit = 0;
                            }
                            $("#SevenAvgProfit").html(__("￥") + data.List[1].avgProfit.toFixed(2));
                        } else {
                            $("#totalMoney").html(__("￥0"));
                            $("#totalNum").html(__("0笔"));
                            $("#SevenAvgMoney").html(__("￥0"));
                            $("#SevenAvgProfit").html(__("￥0"));
                        }

                        var categories_x = "[";
                        for (var i = 0; i < data.List.length; i++) {
                            if (i > 0) {
                                categories_x += ",";
                            }
                            categories_x += "{ value:" + data.List[i].totalMoney + ",name:'" + data.List[i].name + "'}";
                        }
                        categories_x += "]";
                        optionsArea.series[0].data = eval('(' + categories_x + ')');
                        ptChartArea.setOption(optionsArea);
                        ptChartArea.hideLoading();
                    } else {
                        $("#MemberEcharData").show();
                        $("#MemberEcharData").attr("style", " background:url(../../Assets/images/NoData.jpg) no-repeat");

                        $("#UnTotalMoney").html(__("￥0"));
                        $("#UnTotalSum").html(__("0笔"));
                        $("#UnSevenAvgMoney").html(__("￥0"));
                        $("#UnSevenAvgProfit").html(__("￥0"));
                        $("#totalMoney").html(__("￥0"));
                        $("#totalNum").html(__("0笔"));
                        $("#SevenAvgMoney").html(__("￥0"));
                        $("#SevenAvgProfit").html(__("￥0"));
                    }
                } else {
                    $("#MemberEcharData").hide();
                }
            }
        });
    },
    //消费概要
    ConsumptionSummary: function (timetype) {
        var obj = this;
        obj.type = timetype;
        if (timetype == 5) 
		{
            obj.begintime = $("#B_time").val().split(__(' 至 '))[0] == "" ? "" : $("#B_time").val().split(__(' 至 '))[0] + " 00:00:00";//消费开始时间
            obj.endtime = $("#B_time").val().split(__(' 至 '))[1] == undefined ? "" : $("#B_time").val().split(__(' 至 '))[1] + " 23:59:59";//消费结束时间

        }
        obj.Oninit();
    },
    //会员消费 起始方法
    OninitSex: function () {
        var obj = this;
        obj.SexEchart();
    },
    //男士女士饼图
    SexEchart: function () {
        $("#hyxfEcharData").show();
        $("#hyxfEcharData").attr("style", "height: 300px; width: 400px;");
        var obj = this;
        var shopID = shopInfo.IsMasterShop == 1 ? "" : shopInfo.Id
        var ptChartAreahyxf = echarts.init(document.getElementById('hyxfEcharData'));
        optionsAreahyxf = {
            color: ['#50BCFA', '#FD6E74'],
            title: {
                text: '',
                x: 'center'
            },
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c}({d}%)"
            },
            legend: {
                orient: 'horizontal',
                y: 'top',
                selectedMode: false,
                data: [__('男士'), __('女士')]
            },
            toolbox: {
                show: true,
            },
            calculable: false,
            series: [
                {
                    name: __('交易'),
                    type: 'pie',
                    radius: '55%',
                    center: ['50%', '50%'],
                    itemStyle: {
                        normal: {
                            label: {
                                show: true,
                                formatter: '{b} : {d}%'
                            }
                        }
                    },
                    data: []
                }
            ]
        };
        $.ajax({
            url: SYS.CONFIG.index_url + '?ctl=Report_Member&met=getGenderConsumption&typ=json',
            type: 'get',
            data: {
				timetype: obj.hyxftype, 
				begintime: obj.hyxfbegintime, 
				endtime: obj.hyxfendtime 
			},
            async: true,
			dataType: 'json',
            success: function (data) 
			{
                if (data && data.status == 200) {
					data.List = data.data;
                    if (data.List.length > 0) {
                        //男士女士消费
                        if (data.List[0] != undefined && data.List[0].gender == "男士") {
                            if (data.List[0].totalMoney == null) {
                                data.List[0].totalMoney = 0;
                            }
                            $("#hyxfTotalMoney").html(__("￥") + data.List[0].totalMoney.toFixed(2));
                            $("#hyxfTotalSum").html(data.List[0].totalNum + __("笔"));
                            if (data.List[0].avgMoney == null) {
                                data.List[0].avgMoney = 0;
                            }
                            $("#hyxfAvgMoney").html(__("￥") + data.List[0].avgMoney.toFixed(2));
                            if (data.List[0].avgProfit == null) {
                                data.List[0].avgProfit = 0;
                            }
                            $("#hyxfAvgProfit").html(__("￥") + data.List[0].avgProfit.toFixed(2));

                        } else if (data.List[1] != undefined && data.List[1].gender == "男士") {
                            if (data.List[1].totalMoney == null) {
                                data.List[1].totalMoney = 0;
                            }
                            $("#hyxfTotalMoney").html(__("￥") + data.List[1].totalMoney.toFixed(2));
                            $("#hyxfTotalSum").html(data.List[1].totalNum + __("笔"));
                            if (data.List[1].avgMoney == null) {
                                data.List[1].avgMoney = 0;
                            }
                            $("#hyxfAvgMoney").html(__("￥") + data.List[1].avgMoney.toFixed(2));
                            if (data.List[1].avgProfit == null) {
                                data.List[1].avgProfit = 0;
                            }
                            $("#hyxfAvgProfit").html(__("￥") + data.List[1].avgProfit.toFixed(2));
                        } else {
                            $("#hyxfTotalMoney").html(__("￥0"));
                            $("#hyxfTotalSum").html(__("0笔"));
                            $("#hyxfAvgMoney").html(__("￥0"));
                            $("#hyxfAvgProfit").html(__("￥0"));
                        }

                        if (data.List[0] != undefined && data.List[0].gender == "女士") {
                            if (data.List[0].totalMoney == null) {
                                data.List[0].totalMoney = 0;
                            }
                            $("#hyxfSexTotalMoney").html(__("￥") + data.List[0].totalMoney.toFixed(2));
                            $("#hyxfSexTotalSum").html(data.List[0].totalNum + __("笔"));
                            if (data.List[0].avgMoney == null) {
                                data.List[0].avgMoney = 0;
                            }
                            $("#hyxfSexAvgMoney").html(__("￥") + data.List[0].avgMoney.toFixed(2));
                            if (data.List[0].avgProfit == null) {
                                data.List[0].avgProfit = 0;
                            }
                            $("#hyxfSexAvgProfit").html(__("￥") + data.List[0].avgProfit.toFixed(2));
                        } else if (data.List[1] != undefined && data.List[1].gender == "女士") {
                            if (data.List[1].totalMoney == null) {
                                data.List[1].totalMoney = 0;
                            }
                            $("#hyxfSexTotalMoney").html(__("￥") + data.List[1].totalMoney.toFixed(2));
                            $("#hyxfSexTotalSum").html(data.List[1].totalNum + __("笔"));
                            if (data.List[1].avgMoney == null) {
                                data.List[1].avgMoney = 0;
                            }
                            $("#hyxfSexAvgMoney").html(__("￥") + data.List[1].avgMoney.toFixed(2));
                            if (data.List[1].avgProfit == null) {
                                data.List[1].avgProfit = 0;
                            }
                            $("#hyxfSexAvgProfit").html(__("￥") + data.List[1].avgProfit.toFixed(2));
                        } else {
                            $("#hyxfSexTotalMoney").html(__("￥0"));
                            $("#hyxfSexTotalSum").html(__("0笔"));
                            $("#hyxfSexAvgMoney").html(__("￥0"));
                            $("#hyxfSexAvgProfit").html(__("￥0"));

                        }
                        $("#hyxfEcharData").show();
                        var categories_x = "[";
                        for (var i = 0; i < data.List.length; i++) {
                            if (i > 0) {
                                categories_x += ",";
                            }
                            categories_x += "{ value:" + data.List[i].totalMoney + ",name:'" + __(data.List[i].gender) + "'}";
                        }
                        categories_x += "]";
                        optionsAreahyxf.series[0].data = eval('(' + categories_x + ')');
                        ptChartAreahyxf.setOption(optionsAreahyxf);
                        ptChartAreahyxf.hideLoading();
                    } else {
                        $("#hyxfEcharData").show();
                        $("#hyxfEcharData").attr("style", " background:url(../../Assets/images/NoData.jpg) no-repeat;height: 300px; width: 400px;");

                        $("#hyxfTotalMoney").html(__("￥0"));
                        $("#hyxfTotalSum").html(__("0笔"));
                        $("#hyxfAvgMoney").html(__("￥0"));
                        $("#hyxfAvgProfit").html(__("￥0"));
                        $("#hyxfSexTotalMoney").html(__("￥0"));
                        $("#hyxfSexTotalSum").html(__("0笔"));
                        $("#hyxfSexAvgMoney").html(__("￥0"));
                        $("#hyxfSexAvgProfit").html(__("￥0"));
                    }
                } else {
                    $("#hyxfEcharData").hide();
                }
            }
        });
    },
    //会员消费
    SexConsumptionSummary: function (timetype) {
        var obj = this;
        obj.hyxftype = timetype;
        if (timetype != 5) {
            $("#Input_data1").collapse('hide');

        } else {
            obj.hyxfbegintime = $("#B_time2").val().split(__(' 至 '))[0] == "" ? "" : $("#B_time2").val().split(__(' 至 '))[0] + " 00:00:00";//消费开始时间
            obj.hyxfendtime = $("#B_time2").val().split(__(' 至 '))[1] == undefined ? "" : $("#B_time2").val().split(__(' 至 '))[1] + " 23:59:59";//消费结束时间

        }
        obj.OninitSex();
    }
}
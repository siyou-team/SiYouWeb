var echartContainer = document.getElementById('lineArea');
    
//用于使chart自适应高度和宽度,通过窗体高宽计算容器高宽
var resizeEchartContainer = function () 
{
    echartContainer.style.width = echartContainer.innerWidth + 'px';
    echartContainer.style.height = echartContainer.innerHeight + 'px';
};

function getEchart(timetype)
{
	//设置容器高宽
	resizeEchartContainer();
	myChartLine = echarts.init(echartContainer);
	var optionsLine = {
		color: ['#73BF00'],
		toolbox: {
			show : true,
			feature : {
				magicType : {show: true, type: ['line', 'bar']},
				restore : {show: true},
				saveAsImage : {show: true}
			}
		},
		title: {
			text: __('销售额')
		},
		tooltip: {
			trigger: "item",
			formatter: "{b} : {c}"
		},
		xAxis: [
				{
					type: 'category',
					boundaryGap: false,
					splitLine: { show: false },
					data: []
				}
		],
		yAxis: [
				{
					type: 'value',
					axisLabel: {
						formatter: '{value} ' 
					}
				}
		],
		series: [
		{
			name: __('销售额情况'),
			type: 'line',
			itemStyle: { normal: { areaStyle: { type: 'default' } } },
			data: [],
			markLine : {
                data : [
                    {type : 'average', name: '平均值'}
                ]
            }
		}]
	}
		
	$.ajax({
		url: SYS.CONFIG.index_url + '?ctl=Report_Goods&met=salesList&typ=json',
		type: 'post',
		data: {
			timetype: timetype, 
			ismember: 1, 
			order_type:0
		},
		async: true,
		dataType: 'json',
		success: function (data) 
		{ 
			//近七天消费
			var categories = [];
			var timesArry = [];
			$.each(data.data.lists,function (index, item) 
			{
				if(item.CreateTime != __('总计'))
				{
					categories.push(item.TotalConsumption);
					timesArry.push(item.CreateTime);
				}
			});

			optionsLine.series[0].data = categories;
			optionsLine.xAxis[0].data = timesArry;
			myChartLine.setOption(optionsLine);
			myChartLine.hideLoading();	
		}
	})
}
$("#timeChange button").click(function(){
	var id = $(this).attr("id");
	var timetype = 1*id;
	$(this).removeClass("btn-custom").siblings().addClass("btn-custom");
	
	getEchart(timetype);
})
jQuery(document).ready(function ($) 
{
    getEchart(1);
});
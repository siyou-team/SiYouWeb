$(function (){ 
    var id = getQueryString("id");
    //渲染页面
    $.request({
       url:ApiUrl+"/index.php?act=red_packet&op=index",
       type:"get",
       data:{id:id},
       dataType:"json",
       success:function(result){
          var data = result.data;
          if(result.status != 200){
			  $.sDialog({
                content: result.msg + '~',
                okBtn:false,
                cancelBtnText:__('去首页看看'),
                cancelFn: function() { location.href = WapSiteUrl; }
            });
          }else{
			  //var html = template.render('packet_detail', data);
			  //$("packet_detail").html(html);
		  }
       }
    });

	$('#rush_get').click(function(){//领取红包
        if(ifLogin()){
			$.request({
			   url:ApiUrl+"/index.php?act=member_redpacket&op=getpack",
			   type:"get",
			   data:{id:id},
			   dataType:"json",
			   success:function(result){
				  var data = result.data;
				  if(result.status != 200){
					  //更改样式
					  document.getElementById('chaihongbao').style.display="none";
					  document.getElementById('fenxiang').style.display="block";
					  $.sDialog({
						content: result.msg,
						okBtn:false,
						cancelBtnText:__('查看我的红包'),
						cancelFn: function() { location.href = WapSiteUrl+'/tmpl/member/redpacket_list.html'; }
					 });
				  }else{
					  //更改样式
					  document.getElementById('chaihongbao').style.display="none";
					  document.getElementById('fenxiang').style.display="block";
					  $.sDialog({
						content:__('恭喜您获得')+data.packet_price+__('元')+__('红包~'),
						okBtn:false,
						cancelBtnText:__('手气不错'),
						cancelFn: function() { location.href = WapSiteUrl+'/tmpl/member/redpacket_list.html'; }
					 });
				  }
			   }
			});
		}

	});

});
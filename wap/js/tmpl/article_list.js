//qianyistore v5
$(function(){
	var ac_id = getQueryString('ac_id')
	
	if (ac_id=='') {
    	window.location.href = WapSiteUrl + '/index.html';
    	return;
	}
	else {
		$.request({
			url:SYS.CONFIG.URL.cms.category,
			type:'post',
			data:{category_id:ac_id},
			jsonp:'jsonp_callback',
			dataType:'json',
			success:function(result){
				var data = result;
				//data.WapSiteUrl = WapSiteUrl;
				var html = template.render('article-class', data);
				$("#article-show-class").html(html);
			}
		});

		$.request({
			url:SYS.CONFIG.URL.cms.lists,
			type:'post',
			data:{category_id:ac_id},
			jsonp:'jsonp_callback',
			dataType:'json',
			success:function(result){
				var data = result.data;
				$("#art_name ,#art_title").html(data.category_name);
				//data.WapSiteUrl = WapSiteUrl;
				//console.log(data);
				var html = template.render('article-list', data);
				$("#article-content").html(html);
			}
		});
	}	
});
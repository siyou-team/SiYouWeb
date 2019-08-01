//v3-b11
$(function(){
	var ac_id = getQueryString('ac_id')
	
	if (ac_id=='') {
    	window.location.href = WapSiteUrl + '/index.html';
    	return;
	}
	else {
		$.request({
			url:SYS.CONFIG.URL.cms.category,
			type:'get',
			data:{category_id:ac_id},
			jsonp:'jsonp_callback',
			dataType:'json',
			success:function(result){
				var data = result.data;
				data.WapSiteUrl = WapSiteUrl;
				var html = template.render('article-class', data);
				$("#article-content").html(html);
			}
		});
	}	
});
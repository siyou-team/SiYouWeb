//v5. 2 qianyistore
$(function(){
	var article_id = getQueryString('article_id')
	
	if (article_id=='') {
    	window.location.href = WapSiteUrl + '/index.html';
    	return;
	}
	else {
		$.request({
			url:SYS.CONFIG.URL.cms.get,
			type:'post',
			data:{article_id:article_id},
			jsonp:'jsonp_callback',
			dataType:'json',
			success:function(result){
				var data = result.data;
				var html = template.render('article', data);
                $("#art_name ,#art_title").html(data.category_name);
				$("#article-content").html(html);
				$(".article-content").html(data.article_content);
			}
		});
	}	
});
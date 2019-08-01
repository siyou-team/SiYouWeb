$(function(){
	$.request({
		url:ApiUrl+"/index.php?act=goods_class&category_id="+getQueryString("category_id"),
		type:'get',
		dataType:'json',
		success:function(result){
			var html = template.render('category2', result.data);
			$("#content").append(html);
			var category_item = new Array();
			$(".category-seciond-item").click(function (){
				var category_id = $(this).attr('category_id');
				var self = this;
				if(contains(category_item,category_id)){
					$(this).toggleClass("open-sitem");
					return false;
				}
						
				$.request({
					url:ApiUrl+"/index.php?act=goods_class&category_id="+category_id,
					type:'get',
					dataType:'json',
					success:function(result){
						category_item.push(category_id);
						if(result){
							result.data.category_id = category_id;
							var html = template.render('category3', result.data);
							$(self).append(html);
							$(self).addClass('open-sitem');
						
							$('.product_list').click(function(){	
								location.href = WapSiteUrl+"/tmpl/product_list.html?category_id="+$(this).attr('category_id');
							});							
						}else{
							location.href = WapSiteUrl+"/tmpl/product_list.html?category_id="+category_id;
						}		
					}
				});
			});

		}
	});
});
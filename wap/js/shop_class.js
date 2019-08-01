

$(function() {
    $.request({
        url:SYS.URL.store.category,
        type:'get',
        dataType:'json',
        success:function(result){
            var data = result.data;
            data.WapSiteUrl = WapSiteUrl;
            var html = template.render('category-one', data);
            $("#categroy-cnt").html(html);
        }
    });
});
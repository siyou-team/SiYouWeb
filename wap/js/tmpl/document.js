$(function(){
    var headTitle = document.title;
    var html = '<div class="header-wrap">'
                    +'<div class="header-l">'
                    +'<a href="javascript:history.go(-1)">'
					+'<i class="zc zc-back back"></i>'
					+'</a></div>'
                    +'<h1>'+headTitle+'</h1>'
                +'</div>';
    //渲染页面
    $("#header").html(html);
    
    $.getJSON(ApiUrl + '/index.php?act=document&op=agreement', function(result){
        $("#document").html(result.data.doc_content);
    });
});
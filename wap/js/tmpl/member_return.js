$(function(){
    var key = getLocalStorage('ukey');
    //渲染list
    var load_class = new ssScrollLoad();
    load_class.loadInit({
        url:SYS.URL.user.return_lists,
        getparam:{},
        tmplid:'return-list-tmpl',
        containerobj:$("#return-list"),
        iIntervalId:true,
        data:{WapSiteUrl:WapSiteUrl},
        callback:function(){
            $('.delay-btn').click(function(){
                return_id = $(this).attr('return_id');
            });
        }
    });
});

$(function(){
    if (!ifLogin()){return}


    //渲染list
    var load_class = new ssScrollLoad();
    load_class.loadInit({
        'url':SYS.URL.user.browser_lists,
        'getparam':{},
        'tmplid':'viewlist_data',
        'containerobj':$("#viewlist"),
        'iIntervalId':true,
        'data':{WapSiteUrl:WapSiteUrl}
    });

    $("#clearbtn").click(function(){
        $.request({
            type: 'post',
            url: SYS.URL.user.browser_remove,
            data: {},
            dataType: 'json',
            async: false,
            success: function(result) {
                if (result.status == 200) {
                    //$.sDialog({skin: "green", content: "清空成功", okBtn: false, cancelBtn: false});
                    location.href = WapSiteUrl+'/tmpl/member/views_list.html';
                }else{
                    $.sDialog({skin: "red", content: result.msg, okBtn: false, cancelBtn: false});
                }
            }
        });
    });
});


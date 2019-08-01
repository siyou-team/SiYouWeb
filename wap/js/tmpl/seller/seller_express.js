$(function() {
    var showtype=getQueryString("showtype");
    if (!ifLogin()){return}
    function s() {
        $.request({
            type: "post",
            url: SYS.CONFIG.URL.seller.lists_express_logistics,
            data: {},
            dataType: "json",
            success: function(e) {
                //checkLogin(e.login);  
                var t = template.render("saddress_list", e.data);
                $("#address_list").empty();
                $("#address_list").append(t);

                $("#header-nav").click(function() {
                    $(".btn-l").click()
                });
                $(".btn-l").click(function() {
                    $.sDialog({
                        skin: "block",
                        content: __("确定保存？"),
                        okBtn: true,
                        cancelBtn: true,
                        okFn: function() {
                            saveexpress();
                        }
                    })
                })
            } 
        })
    }
    s();
    function saveexpress() {
        var logistics_id = [];
        $("input[name='defaultexpress']:checked").each(function(){
            if($(this).is(":checked")){
                logistics_id.push($(this).val());
            }
        })

        if(logistics_id.length < 1) {
            $.sDialog({
                skin: "block",
                content: __("请至少选择一个物流公司!"),
                okBtn: true,
                cancelBtn: false
            })
        } else {
            $.request({
                type    : "post",
                url     : SYS.CONFIG.URL.seller.enabled_express_logistics,
                data    : {
                    logistics_id: logistics_id
                },
                dataType: "json",
                success : function (e) {
                    if (e && e.status == 200) {
                        $.sDialog({
                            skin     : "block",
                            content  : __("物流保存成功!"),
                            okBtn    : true,
                            cancelBtn: true,
                            okFn     : function () {
                                s();
                            }
                        })

                    } else {

                        $.sDialog({
                            skin     : "block",
                            content  : __("物流保存失败!"),
                            okBtn    : true,
                            cancelBtn: true,
                            okFn     : function () {
                                s();
                            }
                        })

                    }
                }
            })
        }
    }
});
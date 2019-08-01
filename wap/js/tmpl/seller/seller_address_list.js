$(function() {
    var showtype=getQueryString("showtype");
    if (!ifLogin()){return}

    function listAddress() {
        $.request({
            type: "post",
            url: SYS.CONFIG.URL.seller.lists_shipping_address,
            data: {},
            dataType: "json",
            success: function(e) {

                if (e.status == 250) {
                    return false
                }
                var items = e.data;
                var t = template.render("saddress_list", items);
                $("#address_list").empty();
                $("#address_list").append(t);

                $(".deladdress").click(function() {
                    var e = $(this).data("ss_id");
                    $.sDialog({
                        skin: "block",
                        content: __("确认删除吗？"),
                        okBtn: true,
                        cancelBtn: true,
                        okFn: function() {
                            delAddress(e)
                        }
                    })
                })
            }
        })
    }
    listAddress();
    function delAddress(a) {
        $.request({
            type: "post",
            url: SYS.CONFIG.URL.seller.del_shipping_address,
            data: {
                ss_id: a,
            },
            dataType: "json",
            success: function(e) {
                checkLogin(e.login);
                if (e) {
                    $.sDialog({
                        skin: "block",
                        content: __("地址删除成功!"),
                        okBtn: true,
                        cancelBtn: true,
                        okFn: function() {
                            listAddress()
                        }
                    })

                }
            }
        })
    }
});
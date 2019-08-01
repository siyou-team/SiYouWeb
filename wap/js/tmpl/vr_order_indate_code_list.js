$(function() {
    if (!ifLogin()){return}

    var order_id = getQueryString("order_id");

    var isEmpty = function(o) {
        if (typeof o != "object")
            return ! o;
        for (var i in o)
            return false;
        return true;
    };

    $.request({
        type: 'post',
        url: SYS.URL.user.lists_chain_code,
        data:{order_id:order_id},
        dataType:'json',
        success:function(result) {
            if (200 == result.status) {
                data = result.data
            }
            if (data.items.length <= 0) {
                data.err = data.msg || __('暂无可用的兑换码列表');
            }


            template.helper('toDateString', function (ts) {
                var d = new Date(parseInt(ts) * 1000);
                var s = '';
                s += d.getFullYear() + '年';
                s += (d.getMonth() + 1) + '月';
                s += d.getDate() + '日 ';
                s += d.getHours() + ':';
                s += d.getMinutes();
                return s;
            });

            var html = template.render('order-indatecode-tmpl', data);
            $("#order-indatecode").html(html);
        }
    });

});

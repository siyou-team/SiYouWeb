$(function() {
    if (!ifLogin()){return}

    var order_id = getQueryString("order_id");
    $.request({
        type: 'post',
        url: SYS.URL.delivery_info,
        data:{order_id:order_id},
        dataType:'json',
        success:function(result) {

            if (200 == result.status)
            {
                var data = result && result.data;
            }
            else
            {
                data = {};
                data.err = result.msg;
            }

            var html = template.render('order-delivery-tmpl', data);
            $("#order-delivery").html(html);
        }
    });

});

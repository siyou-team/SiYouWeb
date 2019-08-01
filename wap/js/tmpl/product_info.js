$(function() {
    if (SYS.EVALUATION_ENABLE)
    {
        $('#goodsEvaluation').parent().removeClass('hide');
    }

    var item_id = getQueryString("item_id");
    $.request({
        url: SYS.URL.product.info,
        data: {item_id: item_id},
        type: "get",
        success: function(result) {
            $(".fixed-tab-pannel").html(result.data.product_detail);
        }
    });

    $('#goodsDetail').click(function(){
        window.location.href = WapSiteUrl+'/tmpl/product_detail.html?item_id=' + item_id;
    });
    $('#goodsBody').click(function(){
        window.location.href = WapSiteUrl+'/tmpl/product_info.html?item_id=' + item_id;
    });
    $('#goodsEvaluation').click(function(){
        window.location.href = WapSiteUrl+'/tmpl/product_eval_list.html?item_id=' + item_id;
    });
});
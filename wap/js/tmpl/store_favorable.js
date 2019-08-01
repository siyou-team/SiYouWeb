$(function() {
    var store_id = getQueryString("store_id");
    var key = getLocalStorage('ukey');

    // 初始化页面
    $.request({
        type: 'post',
        url: SYS.URL.store.info,
        data: {store_id: store_id,action:'intro'},
        dataType: 'json',
        success: function(result) {
            var data = result.data;
            //渲染店铺分类
            var html = template.render('store_intro_tpl', data);
            $("#store_intro").html(html);


            //显示收藏按钮
            if (data.analytics.store_collect) {
                $("#store_notcollect").hide();
                $("#store_collected").show();
            }else{
                $("#store_notcollect").show();
                $("#store_collected").hide();
            }
        }
    });


    $(document).on('input propertychange',"#amount",function() {
        //
        $('#real_amount').html(sprintf('%.2f', $("#amount").val()));
    });

    //提交
    $(document).on('click', '#save_btn', function(){
        $.request({
            type: 'post',
            url: SYS.URL.pay.favorable,
            data: {store_id: store_id, pdr_amount:$("#amount").val()},
            dataType: 'json',
            success: function(result) {
              if(result.status==200){

                //location.href = './member/rechargeinfo.html?pay_sn='+result.data.pay_sn;

                toPay(result.data.pay_sn, 'member_buy', 'pay');
              }else{
                errorTipsShow("<p>"+result.msg+"<p>");
              }
            }
        });

    });
});

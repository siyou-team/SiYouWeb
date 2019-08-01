$(function(){

    var id = getLocalStorage('uid');
    var key = getLocalStorage('ukey');

    if (key && id) {
        $.request({
            type:'post',
            url: SYS.URL.user.resource,
            data:{},
            dataType:'json',
            success:function(result){
                if(result.status == 200){
                    $('#user_points').html(result.data.user_points);
                    $('#user_redpack').html(result.data.user_redpack);
                }else{

                }
            }
        });
        $.request({
            type:'post',
            url: SYS.URL.user.voucherNum,
            data: {},
            dataType:'json',
            success:function(result){
                if(result.status == 200){
                    $('#user_voucher').html(result.data.voucher_num);
                }else{

                }
            }
        });
    }




    var rows = 3;
    var page = 1;
    //var hasmore = true;



    //兑换优惠券
    $(document).on('click','.get_voucher',function(){
        var obj = $(this).parents('li');
        var activity_id = obj.attr('activity_id');
        exchange(activity_id);
    });

    //兑换操作
    function exchange(activity_id){
        getFreeVoucher(activity_id);
    }

    //获取优惠券列表
    function get_list() {
        $('.loading').remove();
        $.getJSON(SYS.URL.point.index, {page:page,rows:rows}, function(result){
                if(!result && result.status == 250) {
                    result = [];
                    result.data = [];
                    result.data.voucherlist = [];
                } else {
                    result.data.voucherlist = result.data.items;
                }
                $('.loading').remove();
                var html = template.render('home_body', result);
                $("#points_body").after(html);
                hasmore = result.hasmore;
            }
        );
    }
    get_list();
});



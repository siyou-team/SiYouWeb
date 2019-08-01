$(function(){
    if (!ifLogin()){return}

    $.getJSON(SYS.URL.pay.asset, {}, function(result){
        //checkLogin(result.login);
        $('#predepoit').html(result.data.user_money+ __('元'));
        $('#rcb').html(result.data.user_recharge_card+ __('元'));
        $('#voucher').html(result.data.voucher+ __('张'));
        $('#redpacket').html(parseInt('0' + result.data.user_redpacket)+ __('个'));
        $('#point').html(result.data.user_points+ __('分'));
        $('#sp').html(result.data.user_sp_total+ __('个'));
        $('#bp').html(result.data.user_bp+ __('个'));
    });
});
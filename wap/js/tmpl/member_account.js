$(function() {
    // if (!ifLogin()){return}


    if (isWeixin())
    {
        //$('.J_logoutBtn').hide();
    }

    $.request({
        type:'get',
        url:SYS.URL.account.get_mobile_info,
        data:{},
        dataType:'json',
        success:function(result){
            if(result.status == 200){

                if (-1 != $.inArray(User_BindConnectModel.MOBILE, result.data.bind_type_row)) {
            		$('#mobile_link').attr('href','member_mobile_modify.html');
            		$('#mobile_value').html(result.data.mobile);
            	}
            }else{
            }
        }
    });

    $.request({
        type:'get',
        url:SYS.URL.pay.get_pay_passwd,
        data:{},
        dataType:'json',
        success:function(result){
            if(result.status == 250){
                $('#paypwd_tips').html(__('未设置'));

                //url直接直接设置为非手机验证修改密码
                $('#paypwd_url').attr('href', 'member_paypwd_step0.html');

            }else{
            }
        }
    });

    var key = getLocalStorage('ukey');
    $('#logoutbtn').click(function(){
        var username = getLocalStorage('username');
        var key = getLocalStorage('ukey');
        var client = 'wap';

        $.request({
            type:'post',
            url:SYS.URL.logout,
            data:{username:username,client:client},
            success:function(result){
                if(200 == result.status){
                    delLocalStorage('username');
                    delLocalStorage('uid');
                    delLocalStorage('ukey');
                    delLocalStorage('rid');
                    delLocalStorage('cart_count');
                    delLocalStorage('as');

                    delCookie('username');
                    delCookie('uid');
                    delCookie('ukey');
                    delCookie('rid');
                    delCookie('cart_count');
                    delCookie('as');

                    location.href = WapSiteUrl;
                }
            }
        });
    });
});

$(function() {

    var e = getLocalStorage("ukey");

    if (!e) {
        window.location.href = WapSiteUrl + "/tmpl/member/login.html";
        return
    }
    var pay_sn=getQueryString('pay_sn');
    $.ajax({
        type:'post',
        url: SYS.URL.pay.lists,
        data:{key:e,pay_sn:pay_sn, mp_flag: isWeixin()?1:0},
        dataType:'json',
        success:function(result){
            if(result.status == 200){
                var data = result.data;
                data.ApiUrl = ApiUrl;
                data.key = e;
                data.pay_url = SYS.URL.pay.pay;

                template.helper('p2f', function(s) {
                    return (parseFloat(s) || 0).toFixed(2);
                });


                $.each(result.data.pay_info.payment_list, function(i,val){
                    //是否在微信中
                    if (result.data.pay_info.payment_list[i] && isWeixin() &&  0 == result.data.pay_info.payment_list[i].payment_channel_wechat)
                    {
                        result.data.pay_info.payment_list.splice(i,1);
                    }
                    else
                    {
                    }
                });

                $.each(result.data.pay_info.payment_list, function(i,val){
                    if (-1 != $.inArray(result.data.pay_info.payment_list[i].payment_channel_code, ['alipay', 'wx_native', 'unionpay', 'tenpay']))
                    {
                    }
                    else
                    {
                        result.data.pay_info.payment_list.splice(i,1);
                    }
                });


                var html = template.render('rechargeinfo-tmpl', data);
                $("#rechargeinfo").html(html);
            }
            else{
                alert(result.msg);
                location.href="member.html?act=member";
            }
        }
    });




});
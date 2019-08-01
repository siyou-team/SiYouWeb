$(function() {
    var html = '<div id="footnav" class="footnav clearfix"><ul>'
         + '<li><a href="' + WapSiteUrl + '/tmpl/seller/seller.html"><i><img src="'+WapSiteUrl+'/images/app_new/seller_home.png" style="width:100%;" class="footer_img1"><img src="'+WapSiteUrl+'/images/app_new/seller_home.png" style="width:100%;" class="footer_img2"></i><p>' + __('商家中心') + '</p></a></li>'
         + '<li><a href="' + WapSiteUrl + '/tmpl/seller/product_add.html"><i><img src="'+WapSiteUrl+'/images/app_new/add.png" style="width:100%;" class="footer_img1"><img src="'+WapSiteUrl+'/images/app_new/add.png" style="width:100%;" class="footer_img2"></i><p>' + __('快速新增') + '</p></a></li>'
          + '<li><a href="' + WapSiteUrl + '/tmpl/seller/store_goods_list.html"><i><img src="'+WapSiteUrl+'/images/app_new/product_lists.png" style="width:100%;" class="footer_img1"><img src="'+WapSiteUrl+'/images/app_new/product_lists.png" style="width:100%;" class="footer_img2"></i><p>' + __('商品管理') +  '</p></a></li>'
          + '<li><a href="' + WapSiteUrl + '/tmpl/member/chat_list.html"><i ><img src="'+WapSiteUrl+'/images/app_new/message.jpg" style="width:100%;" class="footer_img1"><img src="'+WapSiteUrl+'/images/app_new/message.jpg" style="width:100%;" class="footer_img2"></i><p>' + __('消息') +  '</p></a></li>'
          + '<li class="hide"><a href="' + WapSiteUrl + '/tmpl/seller/store_goods_add.html"><i class="zc zc-shangpinfabu"></i><p>' + __('发布商品')
          +  '</p></a></li></ul>'
          + '</div>';
    $("#footer").html(html);
    if(typeof(navigate_id) == 'undefined'){navigate_id="1";}

    var eiq=navigate_id-1;
    $('.footnav ul li').find('.footer_img2').addClass('hide');//默认给所有img2加隐藏类
    $('.footnav ul li').eq(eiq).find('.footer_img1').addClass('hide');//默认给首页展示
    $('.footnav ul li').eq(eiq).find('.footer_img2').removeClass('hide');//默认删除首页隐藏类
    $('.footnav ul li').eq(eiq).css('border-bottom','4px solid #3958ba');

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

                    location.href = WapSiteUrl + "/tmpl/seller/seller.html"
                }
            }
        });
    });
});

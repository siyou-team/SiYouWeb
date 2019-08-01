$(function (){
    if (window.suteshopApp && !isWeixin())
    {

    }
    else
    {
        var cart_count = 0;
        cart_count = getLocalStorage('cart_count');
        if (getQueryString('ukey') != '') {
            var key = getQueryString('ukey');
            var username = getQueryString('username');
            setLocalStorage('ukey', key);
            setLocalStorage('username', username);
        } else {
            var key = getLocalStorage('ukey');
        }
        var html = '<div class="sstouch-footer-wrap posr fixed-Width">'
            +'<div class="nav-text">';
        if(key){
            html += '<a href="'+WapSiteUrl+'/tmpl/member/member.php">' + __('My xiyou') +'</a>'
                + '<a id="logoutbtn" href="javascript:void(0);">' + __('注销') + '</a>'
                + '<a href="'+WapSiteUrl+'/tmpl/member/member_feedback.php">' + __('反馈') + '</a>'
                + '<a href="' + WapSiteUrl + '/tmpl/article_list.php?ac_id=2">' + __('帮助') + '</a>';

        } else {
            html += '<a href="'+WapSiteUrl+'/tmpl/member/login.php">' + __('登录') + '</a>'
                + '<a href="'+WapSiteUrl+'/tmpl/member/register.php">' + __('注册') + '</a>'
                + '<a href="'+WapSiteUrl+'/tmpl/member/login.php">' + __('反馈') + '</a>'
                + '<a href="' + WapSiteUrl + '/tmpl/article_list.php?ac_id=2">' + __('帮助') + '</a>';
        }
        html += '<a href="javascript:void(0);" class="gotop">' + __('返回顶部') + '</a>' + "</div>" + '<!--<div class="copyright">' + 'Copyright&nbsp;&copy;&nbsp;2005-2016 <a href="javascript:void(0);">www.shopsuite.cn</a>版权所有' + "</div>--></div>";

        if (cart_count > 0) {
            var fnav = '<div id="footnav" class="footnav clearfix"><ul>'
                +'<li><a href="'+WapSiteUrl+'/index.php"><i><img src="'+WapSiteUrl+'/images/app-index/home.png"  style="width:100%;"  id="foot-home"></i><p>' + __('首页') + '</p></a></li>'
                +'<li><a href="'+WapSiteUrl+'/tmpl/member/favorites.php"><span id="cart_count"><i ><img src="'+WapSiteUrl+'/images/app-index/like.png"  style="width:100%;"  id="foot-like"></i></span><p>' + __('收藏') + '</p></a></li>'
                +'<li class="hide"><a href="'+WapSiteUrl+'/tmpl/search.php"><i class="zc zc-search"></i><p>' + __('搜索') +'</p></a></li>'
                +'<li><a href="'+WapSiteUrl+'/tmpl/product_first_categroy.php"><i><img src="'+WapSiteUrl+'/images/app-index/products.png"  style="width:100%;" id="foot-products"></i><p>' + __('分类') + '</p></a></li>'
                +'<li><a href="'+WapSiteUrl+'/tmpl/member/member.php"><i class="zc zc-member"></i><p>' + __('用户') + '</p></a></li></ul>'
                +'</div>';
        } else {
            var fnav = '<div id="footnav" class="footnav clearfix"><ul>'
                +'<li><a href="'+WapSiteUrl+'/index.php"><i><img src="'+WapSiteUrl+'/images/app-index/home.png"  style="width:100%;"  id="foot-home"></i><p>' + __('首页') + '</p></a></li>'
                +'<li class="hide"><a href="'+WapSiteUrl+'/tmpl/search.php"><i class="zc zc-search"></i><p>' + __('搜索') + '</p></a></li>'
                +'<li><a href="'+WapSiteUrl+'/tmpl/member/favorites.php"><span id="cart_count"><i ><img src="'+WapSiteUrl+'/images/app-index/like.png" style="width:100%;" id="foot-like"></i></span><p>' + __('收藏') + '</p></a></li>'
                +'<li><a href="'+WapSiteUrl+'/tmpl/product_first_categroy.php"><i>' + '<img src="'+WapSiteUrl+'/images/app-index/products.png"  style="width:100%;" id="foot-products"></i><p>' + __('分类') + '</p></a></li>'
                +'<li><a href="'+WapSiteUrl+'/tmpl/member/member.php"><i><img src="'+WapSiteUrl+'/images/app-index/ren.png"  style="width:100%;" id="foot-my"></i><p>' + __('用户') + '</p></a></li></ul>'
                +'</div>';
        }
        //$("#footer").html(html+fnav);
        $("#footer").html(fnav);
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
        if(typeof(navigate_id) == 'undefined'){navigate_id="0";}
        //当前页面
        if(navigate_id == "1"){
            $(".footnav .zc-home").parents().addClass("current");
            $("#foot-home").attr("src",WapSiteUrl+'/images/app-index/home1.png');
            //$(".footnav .zc-home").attr('class','home2');
        }else if(navigate_id == "2"){
            $(".footnav .zc-categroy").parent().addClass("current");
            $("#foot-like").attr("src",WapSiteUrl+'/images/app-index/like1.png');

            //$(".footnav.zc-categroy").attr('class','categroy2');
        }else if(navigate_id == "3"){
            $(".footnav .zc-search").parent().addClass("current");
            //$(".footnav .zc-search").attr('class','search2');
        }else if(navigate_id == "4"){
            $(".footnav .zc-cart").parent().parent().addClass("current");
            $("#foot-products").attr("src",WapSiteUrl+'/images/app-index/products1.png');
            //$(".footnav .zc-cart").attr('class','cart2');
        }else if(navigate_id == "5"){
            $(".footnav .zc-member").parent().addClass("current");
            $("#foot-my").attr("src",WapSiteUrl+'/images/app-index/ren1.png');
            //$(".footnav .zc-member").attr('class','member2');
        }
    }
});
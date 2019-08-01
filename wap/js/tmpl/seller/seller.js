$(function(){
    if (!ifLogin()){return}
    if (getQueryString('ukey') != '') {
        var key = getQueryString('ukey');
        var user_nickname = getQueryString('username');
        setLocalStorage('ukey', key);
        setLocalStorage('username', user_nickname);
    } else {
        var key = getLocalStorage('ukey');
        var user_nickname = getLocalStorage('username');
    }
    var rid = getLocalStorage('rid');
    if(rid==2){
        $('.chain_lists').removeClass('hide')
    }

    var chain_id=getQueryString('chain_id');
    if(chain_id){
        setLocalStorage('chain_id', chain_id);
    }else{
        chain_id = getLocalStorage('chain_id')
    }

    $("#clean_cache").click(cleanStorage);

    if(key){
        $.request({
            type:'post',
            url: SYS.URL.seller.dashboard,
            data:{chain_id:chain_id},
            dataType:'json',
            success:function(result){
                if(typeof(result.data.chain_base) != 'undefined'){
                    var store_name= result.data.chain_base.chain_name;
                }else{
                    var store_name= result.data.store_info.store_name;
                }
                $('#day_num').html(result.data.order.day_num);
                $('#month_num').html(result.data.order.month_num);
                $('#chain_num').html(result.data.order.day_num_on)
                $('#total_num').html(result.data.order.day_num_down);

                //checkSellerLogin(result.login);
                var html = ''
                    + '<div class="member-info">'
                        + '<div class="user-avatar"><img src="' + result.data.store_info.store_logo + '"/></div>'
                        + '<div class="user-name hide"><span>'+result.data.seller_info.user_nickname+'</span></div>'
                        + '<div class="store-name"><span style="font-weight: 800;">'+store_name+'</span></div>'
                    + '</div>'
                    + '<div class="member-collect">'
                        + '<span><a href="javascript:;"><em style="font-weight: 800;">' + result.data.order.yestoday_num + '</em><p>'+ __('昨日订单数') + '</p></a></span>'
                        + '<span><a href="javascript:;"><em style="font-weight: 800;">' +result.data.order.month_num + '</em><p>'+ __('当月订单数') + '</p></a></span>'
                        + '<span><a href="javascript:;"><em style="font-weight: 800;">' +result.data.order.pay_amount + '</em><p>'+ __('成交总金额') + '</p></a></span>'
                    + '</div>';
                $(".member-top").html(html);

                //订单管理
                // var html = ''
                //     + '<li><a href="store_orders_list.html?data-state=2010">'+ (result.data.order.wait_pay_num > 0 ? '<em>' + result.data.order.wait_pay_num + '</em>' : '') +'<i class="zc zc-daifukuan"></i><p>'+ __('待付款') + '</p></a></li>'
                //     + '<li><a href="store_orders_list.html?data-state=2020,2030">' + (result.data.order.wait_shipping_num > 0 ? '<em>' + result.data.order.wait_shipping_num + '</em>' : '') + '<i class="zc zc-daishouhuo"></i><p>'+ __('待发货') + '</p></a></li>'
                //     + '<li><a href="store_orders_list.html?data-state=2040">' + (result.data.order.ship_num > 0 ? '' : '') + '<i class="zc zc-yifahuo"></i><p>'+ __('已发货') + '</p></a></li>'
                //     + '<li><a href="store_orders_list.html?data-state=2060">' + (result.data.return.un_fin_num > 0 ? '<em>' + result.data.return.un_fin_num + '</em>' : '') + '<i class="zc zc-dingdanwancheng"></i><p>'+ __('已完成') + '</p></a></li>';
                // $("#order_ul").html(html);
                var html = ''
                    + '<li><a href="store_orders_list.html?data-state=2010"><i><img src="'+WapSiteUrl+'/images/appstore/order_1.png" style="width:100%;" id="foot-like"></i><p>'+ __('待付款') + '</p></a></li>'
                    + '<li><a href="store_orders_list.html?data-state=2020,2030"><i><img src="'+WapSiteUrl+'/images/appstore/order_2.png" style="width:100%;" id="foot-like"></i><p>'+ __('待发货') + '</p></a></li>'
                    + '<li><a href="store_orders_list.html?data-state=2040"><i><img src="'+WapSiteUrl+'/images/appstore/order_3.png" style="width:100%;" id="foot-like"></i><p>'+ __('已发货') + '</p></a></li>'
                    + '<li><a href="store_orders_list.html?data-state=2060"><i><img src="'+WapSiteUrl+'/images/appstore/order_4.png" style="width:100%;" id="foot-like"></i><p>'+ __('已完成') + '</p></a></li>';
                $("#order_ul").html(html);

                //商品管理
			var html = ''
				+ '<li style="width:33%"><a href="store_goods_list.html?showtype=1001">' + (result.data.product.normal_num > 0 ? '<em style="background-color: #00b3ee">' + result.data.product.normal_num + '</em>' : '') + '<i class="zc zc-chushou"></i><p>'+ __('出售中') + '</p></a></li>'
				+ '<li style="width:33%"><a href="store_goods_list.html?showtype=1002">' + (result.data.product.off_num > 0 ? '<em style="background-color: #00b3ee">' + result.data.product.off_num + '</em>' : '') + '<i class="zc zc-cangkuzhong"></i><p>'+ __('仓库中') + '</p></a></li>'
				+ '<li style="width:33%"><a href="store_goods_list.html?showtype=1000">' + (result.data.product.illegal_num > 0 ? '<em>' + result.data.product.illegal_num + '</em>' : '') + '<i class="zc zc-weiguishangpin"></i><p>'+ __('违规商品') + '</p></a></li>'
				+ '<li class="hide"><a href="store_goods_add.html"><i class="zc zc-shangpinfabu"></i><p>'+ __('发布商品') + '</p></a></li>'
                $("#goods_ul").html(html);

                 //统计结算
                var html = ''
                    + '<li><div><p style="font-size:18px;color:red;font-weight:bold;">11111</p><p>'+ __('营业总额') + '</p></div></li><li><div><p style="font-size:18px;color:red;font-weight:bold;">2222</p><p>'+ __('30天销量') + '</p></div></li><li><div><p style="font-size:18px;color:red;font-weight:bold;">3333</p><p>'+ __('有效订单量') + '</p></div></li><li><div><p style="font-size:18px;color:red;font-weight:bold;">444</p><p>'+ __('结算金额') + '</p></div></li>'
                $("#asset_ul").html(html);


                if( result.data.store_info && result.data.store_info.store_type == 1002 ) {
                    var html = ''
                    + '<dt><a href="supplier_distributor_list.html">'
                    + ' <h3><i class="zc zc-dianpu" style="color: #e50dbb;font-size: 0.8rem;opacity: 0.6"></i>'+ __('我的客户') + '</h3>'
                    + '<h5><i class="zc zc-arrow-r arrow-r"></i></h5></a></dt>';
                }

                if( result.data.store_info && result.data.store_info.store_type == 1001 ) {
                     var html = ''
                    + '<dt><a href="supplier_distributor_index.html">'
                    + ' <h3><i class="zc zc-dianpu" style="color: #e50dbb;font-size: 0.8rem;opacity: 0.6"></i>'+ __('我的供应商') + '</h3>'
                    + '<h5><i class="zc zc-arrow-r arrow-r"></i></h5></a></dt>';
                }

                $("#distributor").html(html);

                return false;
            }




        });
    } else {
        delLocalStorage('ukey');
        delLocalStorage('username');
        delLocalStorage('store_name');
        var html = ''
            + '<div class="member-info">'
                + '<a href="../member/login.html" class="default-avatar" style="display:block;"></a>'
                + '<a href="../member/login.html" class="to-login">'+ __('点击登录') + '</a>'
            + '</div>'
            + '<div class="member-collect">'
                + '<span>'
                    + '<a href="../member/login.html">'
                        + '<em>0</em>'
                        + '<p>'+ __('昨日销量') + '</p>'
                    + '</a>'
                + '</span>'
                + '<span>'
                    + '<a href="../member/login.html">'
                        + '<em>0</em>'
                        + '<p>'+ __('当月销量') + '</p>'
                    + '</a>'
                + '</span>'
                + '<span>'
                    + '<a href="../member/login.html">'
                        + '<em>0</em>'
                        + '<p>'+ __('出售中') + '</p>'
                    + '</a>'
                + '</span>'
            + '</div>';
        $(".member-top").html(html);

        //订单管理
        var html = ''
            + '<li><a href="../member/login.html"><i class="zc zc-daifukuan"></i><p>'+ __('待付款') + '</p></a></li>'
            + '<li><a href="../member/login.html"><i class="zc zc-daishouhuo"></i><p>'+ __('待发货') + '</p></a></li>'
            + '<li><a href="../member/login.html"><i class="zc zc-daiziti"></i><p>'+ __('待自提') + '</p></a></li>'
            + '<li><a href="../member/login.html"><i class="zc zc-quxiaodingdan-2"></i><p>'+ __('已取消') + '</p></a></li>'
        $("#order_ul").html(html);

       //商品管理
        var html = ''
			+ '<li style="width:33%"><a href="../member/login.html"><i><img src="'+WapSiteUrl+'/images/appstore/pro_1.png" style="width:100%;" id="foot-like"></i><p>'+ __('出售中') + '</p></a></li>'
			+ '<li style="width:33%"><a href="../member/login.html"><i><img src="'+WapSiteUrl+'/images/appstore/pro_2.png" style="width:100%;" id="foot-like"></i><p>'+ __('仓库中') + '</p></a></li><li stle="width:33%">'
			+ '<a href="../member/login.html"><i><img src="'+WapSiteUrl+'/images/appstore/pro_3.png" style="width:100%;" id="foot-like"></i><p>'+ __('违规商品') + '</p></a></li>'
			+ '<li style="width:33%"><a href="../member/login.html"><i class="zc zc-shangpinfabu"></i><p>'+ __('发布商品') + '</p></a></li>'
			$("#goods_ul").html(html);
        return false;
    }

    //滚动header固定到顶部
    $.scrollTransparent();

});

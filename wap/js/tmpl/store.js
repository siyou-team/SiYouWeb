var _wap_wx = 0;
if (isWeixin())
{
    _wap_wx = 1;
    loadJs("https://res.wx.qq.com/open/js/jweixin-1.2.0.js");
}

//处理商品上新返回的数据
function tidyStoreNewGoodsData(goodsData){
    if (goodsData.items.length <= 0) {
        return goodsData;
    }
    var obj = $('#newgoods').find('[addtimetext="'+goodsData.items[0].product_sale_time+'"]');
    var curr_date = '';
    $.each(goodsData.items,function(index,item){
        if (curr_date != item.product_sale_time && obj.html() == null) {
            goodsData.items[index].product_sale_time = item.product_sale_time;
            curr_date = item.product_sale_time;
        }
    });
    return goodsData;
}

$(function() {
    var key = getLocalStorage('ukey');
    var store_id = getQueryString("store_id");
    if(!store_id){
        window.location.href = WapSiteUrl+'/index.html';
    }
    $("#goods_search").attr('href','store_search.html?store_id='+store_id);
    $("#store_categroy").attr('href','store_search.html?store_id='+store_id);
    $("#store_intro").attr('href','store_intro.html?store_id='+store_id);

    //显示轮播
    function  slidersShow(){
        $('#store_sliders').each(function() {
            if ($(this).find('.item').length < 2) {
                return;
            }
            Swipe(this, {
                startSlide: 2,
                speed: 400,
                auto: 3000,
                continuous: true,
                disableScroll: false,
                stopPropagation: false,
                callback: function(index, elem) {},
                transitionEnd: function(index, elem) {}
            });
        });
    }

    //加载店铺详情
    $.request({
        type: 'post',
        url: SYS.URL.store.info,
        data: {store_id: store_id},
        dataType: 'json',
        success: function(result) {
            var data = result.data;
            //显示页面title
            var title = data.base.store_name + ' - ';
            document.title = title;


            if (data.base.store_o2o_flag)
            {
            }
            else
            {
                $('.store_voucher').removeClass('hide');
                $('.store_pay_url').addClass('hide')


                $("#store_voucher").attr('href', './store_search.html?store_id=' + data.base.store_id);
            }

            $("#store_pay_url").attr('href', './store_favorable.html?store_id=' + data.base.store_id);

            //店铺banner
            var html = template.render('store_banner_tpl', data);
            $("#store_banner").html(html);
            //显示收藏按钮
            if (data.analytics.store_collect) {
                $("#store_notcollect").hide();
                $("#store_collected").show();
            }else{
                $("#store_notcollect").show();
                $("#store_collected").hide();
            }
            //banner 背景图
            if (data.info.mobile_store_banner) {
                $('.store-top-bg .img').css('background-image', 'url('+data.info.mobile_store_banner +')');
            }else{//输出随机的背景图
                var topBgs = [];
                topBgs[0] = WapSiteUrl + "/images/store_h_bg_01.jpg";
                topBgs[1] = WapSiteUrl + "/images/store_h_bg_02.jpg";
                topBgs[2] = WapSiteUrl + "/images/store_h_bg_03.jpg";
                topBgs[3] = WapSiteUrl + "/images/store_h_bg_04.jpg";
                topBgs[4] = WapSiteUrl + "/images/store_h_bg_05.jpg";
                var randomBgIndex = Math.round( Math.random() * 4 );
                $('.store-top-bg .img').css('background-image', 'url('+ topBgs[randomBgIndex] +')');
            }
            //店铺轮播图
            if (data.info.mobile_store_slide && data.info.mobile_store_slide.length > 0) {
                console.log(data.info.mobile_store_slide.length);

                var html = template.render('store_sliders_tpl', data);
                $("#store_sliders").html(html);
                slidersShow();
            }else{
                $("#store_sliders").parent().hide();
            }
            //联系客服
            $('#store_kefu').click(function(e){
                e.preventDefault();

                //是否有手机号，有则直接拨打 store_kefu
                if (data.info.store_tel)
                {

                    window.location.href = 'tel:' + result.data.info.store_tel;

                }
                else
                {

                    if (typeof data.info.im_chat != 'undefined' && data.info.im_chat) {
                        window.location.href = WapSiteUrl+'/tmpl/member/chat_info.html?t_id=' + result.data.info.member_id;
                    }else{
                        window.location.href = "http://wpa.qq.com/msgrd?v=3&uin=" + result.data.info.store_qq + "&site=qq&menu=yes";
                    }
                }

            });
            //店主推荐
            var html = template.render('goods_recommend_tpl', data);
            $("#goods_recommend").html(html);

            if (_wap_wx) {
                $.ajax({
                    url: SYS.URL.wx.config,
                    data: {
                        href: location.href, item_name: data.base.store_name, product_image:data.base.store_logo, product_tips:data.base.store_name, _pjax:1, fancybox:1
                    },
                    dataType: 'script',
                    success: function (result) {

                        wx.ready(function () {
                            var img_url = '';

                            var uid = getLocalStorage('uid');
                            var link = location.href;

                            if (uid)
                            {
                                link = link +  '&FX=' + uid;
                            }
                            else
                            {

                            }


                            if(data.base.store_logo.indexOf("https") == 0 || data.base.store_logo.indexOf("http"))
                            {
                                img_url = data.base.store_logo;
                            }
                            else
                            {
                                if(SYS.HTTPS)
                                {
                                    img_url = "http:" + data.base.store_logo;
                                }
                                else
                                {
                                    img_url = "https:" + data.base.store_logo;
                                }
                            }


                            wx.onMenuShareTimeline({
                                title: data.base.store_name, //分享标题
                                link: link, //分享链接
                                imgUrl: img_url, //分享图标
                                success: function () {
                                },
                                cancel: function () {
                                }
                            });

                            wx.onMenuShareAppMessage({
                                title: data.base.store_name, //分享标题
                                desc: data.base.store_name, //分享描述
                                link: link, //分享链接
                                imgUrl: img_url, //分享图标
                                type: 'link',
                                dataUrl: '',
                                success: function () {
                                },
                                cancel: function () {
                                }
                            });

                            wx.onMenuShareQQ({
                                title: data.base.store_name, //分享标题
                                desc: data.base.store_name, //分享描述
                                link: link, //分享链接
                                imgUrl: img_url, //分享图标
                                success: function () {
                                },
                                cancel: function () {
                                }
                            });

                            wx.onMenuShareWeibo({
                                title: data.base.store_name, //分享标题
                                desc: data.base.store_name, //分享描述
                                link: link, //分享链接
                                imgUrl: img_url, //分享图标
                                success: function () {
                                },
                                cancel: function () {
                                }
                            });

                            wx.onMenuShareQZone({
                                title: data.base.store_name, //分享标题
                                desc: data.base.store_name, //分享描述
                                link: link, //分享链接
                                imgUrl: img_url, //分享图标
                                success: function () {
                                },
                                cancel: function () {
                                }
                            });

                            /*
                             wx.openAddress({
                             success : function(result){

                             //此处获取到地址信息，可做自己的业务操作
                             alert('收货人姓名' + result.userName);
                             alert('收货人电话' + result.telNumber);
                             alert('邮编' + result.postalCode);
                             alert('国标收货地址第一级地址' + result.provinceName);
                             alert('国标收货地址第二级地址' + result.cityName);
                             alert('国标收货地址第三级地址' + result.countryName);
                             alert('详细收货地址信息' + result.detailInfo);
                             alert('收货地址国家码' + result.nationalCode);
                             }
                             });
                             */


                        });

                        _wap_wx = 0;
                    }
                });
            }
        }
    });

    //加载商品排行
    $('#goods_rank_tab').find('a').click(function(){

        $('#goods_rank_tab').find('li').removeClass('selected');
        $(this).parent().addClass('selected').siblings().removeClass("selected");

        var data_type = $(this).attr('data-type');
        var ordertype = data_type;
        var shownum = 3;

        $("[shopsuite_type='goodsranklist']").hide();
        $("#goodsrank_"+data_type).show();

        //如果已加载过数据则不重复加载
        if ($("#goodsrank_"+data_type).html()) {
            return;
        }

        //加载商品列表
        $.request({
            type: 'post',
            url: SYS.URL.product.lists,
            data: {store_id: store_id, sidx:ordertype, sord:'DESC', num:shownum},
            dataType: 'json',
            success: function(result) {
                if (result.status == 200) {
                    var html = template.render('goodsrank_'+data_type+'_tpl', result.data);
                    $("#goodsrank_"+data_type).html(html);
                }
            }
        });
    });
    $('#goods_rank_tab').find("a[data-type='product_favorite_num']").trigger('click');


    //加载商品上新
    function getStoreNewGoods(){

        var product_tag_ids = new Array();
        product_tag_ids.push(StateCode.PRODUCT_TAG_NEW);

        var param = {};
        param.store_id = store_id;
        param.product_tag_ids = product_tag_ids;

        var load_class_newgoods = new ssScrollLoad();
        load_class_newgoods.loadInit({'url':SYS.URL.product.lists,'getparam':param,'tmplid':'newgoods_tpl','containerobj':$("#newgoods"),'iIntervalId':true,'resulthandle':'tidyStoreNewGoodsData'});
    }

    //加载店铺促销活动
    function getStoreActivity(){

        $.request({
            type: 'post',
            url: SYS.URL.store.activity,
            data: {store_id: store_id},
            dataType: 'json',
            success: function(result) {
                result.data.store_id = store_id;
                var html = template.render('storeactivity_tpl', result.data);
                $("#storeactivity_con").html(html);
            }
        });
    }

    //导航
    $("#nav_tab").find('a').click(function(){
        $('#nav_tab').find('li').removeClass('selected');
        $(this).parent().addClass('selected').siblings().removeClass("selected");
        $("#storeindex_con,#allgoods_con,#newgoods_con,#storeactivity_con").hide();
        window.scrollTo(0,0);

        var data_type = $(this).attr('data-type');
        switch (data_type){
            case 'storeindex':
                $("#storeindex_con").show();
                slidersShow();
                break;
            case 'allgoods':
                if (!$("#allgoods_con").html()) {
                    $("#allgoods_con").load('store_goods_list.html',function(){
                        $(".goods-search-list-nav").addClass('posr');
                        $(".goods-search-list-nav").css("top","0");
                        $("#sort_inner").css("position","static");
                    });
                }
                $("#allgoods_con").show();
                break;
            case 'newgoods':
                if (!$("#newgoods").html()) {
                    getStoreNewGoods();
                }
                $("#newgoods_con").show();
                break;
            case 'storeactivity':
                if (!$("#storeactivity_con").html()) {
                    getStoreActivity();
                }
                $("#storeactivity_con").show();
                break;
        }
    });

    //免费领取优惠券
    $("#store_voucher").click(function(){
        return;

        if (!$("#store_voucher_con").html()) {
            $.request({
                type: 'post',
                url:  SYS.URL.point.voucher,
                data: {store_id: store_id, gettype: 'free'},
                dataType: 'json',
                async: false,
                success: function(result) {
                    if (result.status == 200) {
                        var html = template.render('store_voucher_con_tpl', result.data);
                        $("#store_voucher_con").html(html);
                    }
                }
            });
        }
        //从下到上动态显示隐藏内容
        $.animationUp({'valve':''});
    });
    //领店铺优惠券
    $('#store_voucher_con').on('click', '[shopsuite_type="getvoucher"]', function(){
        getFreeVoucher($(this).attr('data-tid'));
    });

    //收藏店铺
    $(document).on('click', "#store_notcollect", function() {
        //添加收藏
        var f_result = favoriteStore(store_id);
        if (f_result) {
            $("#store_notcollect").hide();
            $("#store_collected").show();
            var t;
            var favornum = (t = parseInt($("#store_favornum_hide").val())) > 0?t+1:1;
            $('#store_favornum').html(favornum);
            $('#store_favornum_hide').val(favornum);
        }
    });
    //取消店铺收藏
    $(document).on('click', "#store_collected", function() {
        //取消收藏
        var f_result = dropFavoriteStore(store_id);
        if (f_result) {
            $("#store_collected").hide();
            $("#store_notcollect").show();
            var t;
            var favornum = (t = parseInt($("#store_favornum_hide").val())) > 1?t-1:0;
            $('#store_favornum').html(favornum);
            $('#store_favornum_hide').val(favornum);
        }
    });

});

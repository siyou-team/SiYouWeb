$(function(){

    //if (!ifLogin()){return}

    if (getQueryString('ukey') != '') {
        var key = getQueryString('ukey');
        var username = getQueryString('username');
        setLocalStorage('ukey', key);
        setLocalStorage('username', username);
    } else {
        var key = getLocalStorage('ukey');
    }

    var role_id = getLocalStorage('rid');

    if (2 == role_id)
    {
        $('#seller_center').removeClass('hide');
    }
    else if (3 == role_id)
    {
        $('#chain_center').removeClass('hide');
    }
    else if (1 == role_id)
    {
        $('#plantform_center').removeClass('hide');
    }
    else
    {
        $('.store_apply').removeClass('hide');
    }

	//qianyistore v5.2 第三方登录后返回上回访问页面
	var redirect_uri = getLocalStorage('redirect_uri');
	if(redirect_uri && getQueryString('info') == 'hao'){
	    window.location.href = WapSiteUrl + redirect_uri;
    }

    $("#clean_cache").click(cleanStorage);


	if(key){
        var html ='<div class="member-top">'
            +'<div class="member-collect">'
            // +'<a href="register.html"><div class="member-create">Create an account</div></a>'
            // +'<a href="login.html"><div class="member-log">Log in</div></a>'
            +'</div>'
            +'</div>';
        //渲染页面
        $(".member-top").html(html);
        // $.request({
        //     type:'post',
        //     url:SYS.URL.user.overview,
        //     data:{},
        //     dataType:'json',
        //     //jsonp:'jsonp_callback',
        //
        //      // 此处的参数会覆盖‘全局配置’中的设置
        //      ajaxCache: {
        //          // 业务逻辑判断请求是否缓存， res为ajax返回结果, options 为 $.ajax 的参数
        //          cacheValidate: function (res, options) {
        //              return res.status === 200; // 满足某个条件才缓存
        //          },
        //          storageType: 'localStorage', //选填，‘localStorage’ or 'sessionStorage', 默认‘localStorage’
        //          timeout: SYS.CACHE_EXPIRE/12, //选填， 单位秒。默认1小时,
        //          forceRefresh: false //选填，默认false 是否强制刷新请求。本次请求不读取缓存，同时如果请求成功会更新缓存。应用场景如：下拉刷新
        //      },
        //
        //     success:function(result){
        //         ////checkLogin(result.login);
        //         var user_role_name = result.data.user_role.user_role_name;
        //
        //         if (user_role_name)
        //         {
        //           user_role_name = sprintf('<sup>%s</sup>', user_role_name)
        //         }
        //         else
        //         {
        //           user_role_name = sprintf('<a class="role-upgrade" href="javascript:void(0)" style="color:#fff" data-role="1">%s</a>', '<sup>' + __('升级') + '</sup>')
        //         }
        //
        //
        //         var avatar = result.data.member_info.user_avatar.replace(/http:\/\//, "\/\/").replace(/https:\/\//, "\/\/");
        //
        //         var html = '<div class="member-info">'
        //             + '<div class="user-avatar"> <a href="member_info.html"><img src="' + avatar + '"/></a></div>'
        //             + '<div class="user-name"> <span>'+result.data.member_info.user_nickname+'<sup>' + result.data.member_info.user_level_name + '</sup></span> </div>'
        //             + '</div>'
        //             + '<div class="member-collect"><span><a href="favorites.html"><em>' + result.data.member_info.favorites_goods + '</em>'
        //             + '<p>' + __('商品收藏') + '</p>'
        //             + '</a> </span><span><a href="favorites_store.html"><em>' +result.data.member_info.favorites_store + '</em>'
        //             + '<p>' + __('店铺收藏') + '</p>'
        //             + '</a> </span><span><a href="views_list.html"><i class="goods-browse"></i>'
        //             + '<p>' + __('我的足迹') + '</p>'
        //             + '</a> </span></div>';
        //         //渲染页面
        //
        //         $(".member-top").html(html);
        //
        //         var html = '<li><a href="order_list.html?data-state=2010">'+ (result.data.member_info.order_nopay_count > 0 ? '<em></em>' : '') +'<i class="zc zc-daifukuan"></i><p>' + __('待付款') + '</p></a></li>'
        //             + '<li><a href="order_list.html?data-state=2040">' + (result.data.member_info.order_noreceipt_count > 0 ? '<em></em>' : '') + '<i class="zc zc-daishouhuo"></i><p>' + __('待收货') + '</p></a></li>'
        //             //+ '<li><a href="order_list.html?data-state=2080">' + (result.data.member_info.order_notakes_count > 0 ? '<em></em>' : '') + '<i class="zc zc-daiziti"></i><p>待自提</p></a></li>'
        //             + '<li class="evaluation-enable"><a href="order_list.html?data-state=state_noeval">' + (result.data.member_info.order_noeval_count > 0 ? '<em></em>' : '') + '<i class="zc zc-daipingjia"></i><p>' + __('待评价') + '</p></a></li>'
        //             + '<li><a href="member_return.html">' + (result.data.member_info.return > 0 ? '<em></em>' : '') + '<i class="zc zc-tuihuanhuo"></i><p>' + __('退货退款') + '</p></a></li>';
        //         //渲染页面
        //
        //         $("#order_ul").html(html);
        //
        //         if (SYS.VIRTUAL_ENABLE && $("#service_order_ul").length > 0)
        //         {
        //             //$('#service_container').removeClass('hide');
        //             //$('#service_container').show();
        //
        //             var html = '<li><a href="vr_order_list.html?data-state=2010">'+ (result.data.member_info.order_nopay_count > 0 ? '<em></em>' : '') +'<i class="zc zc-daifukuan"></i><p>' + __('待付款') + '</p></a></li>'
        //                 + '<li><a href="vr_order_list.html?data-state=2040">' + (result.data.member_info.order_noreceipt_count > 0 ? '<em></em>' : '') + '<i class="zc zc-daishouhuo"></i><p>' + __('待服务') + '</p></a></li>'
        //                     //+ '<li><a href="vr_order_list.html?data-state=2080">' + (result.data.member_info.order_notakes_count > 0 ? '<em></em>' : '') + '<i class="zc zc-daiziti"></i><p>待自提</p></a></li>'
        //                 + '<li class="evaluation-enable"><a href="vr_order_list.html?data-state=state_noeval">' + (result.data.member_info.order_noeval_count > 0 ? '<em></em>' : '') + '<i class="zc zc-daipingjia"></i><p>' + __('待评价') + '</p></a></li>'
        //                 + '<li class=""><a href="member_return.html">' + (result.data.member_info.order_noeval_count > 0 ? '<em></em>' : '') + '<i class="zc zc-tuihuanhuo"></i><p>' + __('退订服务') + '</p></a></li>'
        //             //渲染页面
        //             $("#service_order_ul").html(html);
        //         }
        //
        //         var html = '<li><a href="predepositlog_list.html"><i class="zc zc-yue"></i><p>' + __('预存款') + '</p></a></li>'
        //             + '<li><a href="rechargecardlog_list.html"><i class="zc zc-qiachongzhi"></i><p>' + __('充值卡') + '</p></a></li>'
        //             + '<li><a href="voucher_list.html"><i class="zc zc-youhuiquan"></i><p>' + __('优惠券') + '</p></a></li>'
        //             //+ '<li><a href="redpacket_list.html"><i class="zc zc-hongbao"></i><p>红包</p></a></li>'
        //             + '<li><a href="pointslog_list.html"><i class="zc zc-jifen"></i><p>' + __('积分') + '</p></a></li>'
        //                 //+ '<li><a href="../exchange/sp/sp_list.html"><i class="zc zc-youhuiquan"></i><p>众宝</p></a></li>'
        //                // + '<li><a href="../exchange/bp/bp_list.html"><i class="zc zc-youhuiquan"></i><p>金宝</p></a></li>'
        //             ;
        //         $('#asset_ul').html(html);
        //         return false;
        //     }
        // });
        if( 2 == role_id || 1 == role_id){
            var html = '<dt><a href="../seller/seller.html" style="">'
                + '<img class="point" src="../../images/app-index/2-5.png">'  
                + '<div class="app-myspan">' + __('商家中心') + '<i class="zc zc-arrow-r arrow-r"></i></div> </a></dt>';
            $('#categroy-child-list').append( html );
        }

	} else {
	    // var html = '<div class="member-info">'
	    //     + '<a href="login.html" class="default-avatar" style="display:block;"></a>'
	    //     + '<a href="login.html" class="to-login">' + __('点击登录') + '</a>'
	    //     + '</div>'
	    //     + '<div class="member-collect"><span><a href="login.html"><i class="favorite-goods"></i>'
	    //     + '<p>' + __('商品收藏') + '</p>'
	    //     + '</a> </span><span class="multishop-enable"><a href="login.html"><i class="favorite-store"></i>'
	    //     + '<p>' + __('店铺收藏') + '</p>'
	    //     + '</a> </span><span><a href="login.html"><i class="goods-browse"></i>'
	    //     + '<p>' + __('我的足迹') + '</p>'
	    //     + '</a> </span></div>';
        var html ='<div class="member-top">'
            +'<div class="member-collect">'
            +'<a href="register.html"><div class="member-create">'+__('注册')+'</div></a>'
            +'<a href="login.html"><div class="member-log">' + __('登录') + '</div></a>'
            +'</div>'
            +'</div>';
	    //渲染页面
	    $(".member-top").html(html);

        var html = '<li><a href="login.html"><i class="zc zc-daifukuan"></i><p>' + __('待付款') + '</p></a></li>'
        + '<li><a href="login.html"><i class="zc zc-daishouhuo"></i><p>' + __('待收货') + '</p></a></li>'
        /*+ '<li><a href="login.html"><i class="zc zc-daiziti"></i><p>待自提</p></a></li>'*/
        + '<li class="evaluation-enable"><a href="login.html"><i class="zc zc-daipingjia"></i><p>' + __('待评价') + '</p></a></li>'
        + '<li><a href="login.html"><i class="zc zc-tuihuanhuo"></i><p>' + __('退款/退货') + '</p></a></li>';
        //渲染页面
        //$("#order_ul").html(html);

	 var html = '<li><a href="predepositlog_list.html"><i class="zc zc-yue"></i><p>' + __('余额') + '</p></a></li>' + '<li><a href="rechargecardlog_list.html"><i class="zc zc-qiachongzhi"></i><p>' + __('充值卡') + '</p></a></li>' + '<li><a href="voucher_list.html"><i class="zc zc-youhuiquan"></i><p>' + __('优惠券') + '</p></a></li>' /* + '<li><a href="redpacket_list.html"><i class="zc zc-hongbao"></i><p>红包</p></a></li>' */+ '<li><a href="pointslog_list.html"><i class="zc zc-jifen"></i><p>'+ __('积分') + '</p></a></li>'
         /* + '<li><a href="../exchange/sp/sp_list.html"><i class="zc zc-youhuiquan"></i><p>众宝</p></a></li>'
         + '<li><a href="../exchange/bp/bp_list.html"><i class="zc zc-youhuiquan"></i><p>金宝</p></a></li>' */;
        $("#asset_ul").html(html);
        return false;
	}

	  //滚动header固定到顶部
	  $.scrollTransparent();


  var upgrade_url = SYS.CONFIG.account_url + "?ctl=User_Account&met=upgrade&typ=json";
  $(document).on('click', ".role-upgrade", function(){
    var user_is_sp = $(this).data('role');

    if (parseInt(user_is_sp))
    {


      $(document).dialog({
        type : 'confirm',
        closeBtnShow: true,
        content: __('确认升级服务商？'),
        onClickConfirmBtn: function(){
          $.request({
            type: "POST",
            url: upgrade_url,
            data:{role:'sp'},
            dataType:'json',
            async: false,
            error: function() {
              alert(__("升级失败！"));
            },
            success: function(data) {
              if (data.status == 200)
              {
                var result = data.data;
              }
              else
              {
                alert(data.msg);
              }
            }
          });

        },
        onClickCancelBtn : function(){
        },
        onClickCloseBtn  : function(){
        }
      });
    }
  });

});
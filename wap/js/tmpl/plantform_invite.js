$(function(){
    if (!ifLogin()){return}
 
    $.request({
        type:'post',
        url:SYS.URL.fx.index,
        data:{},
        dataType:'json',
        //jsonp:'callback',
        success:function(result){
            if(result.data.user_directseller_shop){
                var shop_name = result.data.user_directseller_shop;
                if(!result.data.directseller)
                    var shop_url = 'plantform_invite.html';
                else
                    var shop_url = 'plantform_store.html?uid='+result.data.base.user_id;
            }else{
                var shop_name = __('尚未设置');
                var shop_url = 'plantform_invite.html';
            }

          var user_role_name = result.data.user_role.user_role_name;

          if (user_role_name)
          {
            user_role_name = sprintf('<sup>%s</sup>', user_role_name);
          }
          else
          {
              if (SYS.PLANTFORM_SP_PRIZE_ENABLE)
              {
                  user_role_name = sprintf('<a class="role-upgrade" href="javascript:void(0)" style="color:#fff" data-role="1">%s</a>', '<sup>' + __('升级') + '</sup>')
              }
          }



            var shop_name = __('点击此处，产生推广二维码');
            var shop_url = 'directseller_shop.html';
            var shop_url = 'member_invite.html';
            var avatar = result.data.member_info.user_avatar.replace(/http:\/\//, "\/\/").replace(/https:\/\//, "\/\/");

            var html = '<div class="member-info">'
                + '<div class="user-avatar"> <img src="' + avatar + '"/> </div>'
                + '<div class="user-name"> <span>' + result.data.member_info.user_nickname + '' + user_role_name + '</span> </div>'
                + '</div>' + '<div class="member-collect"><span style="width: 100%;"><a href="' + shop_url + '"><em style="line-height: 2rem;">' + shop_name + '</em>'
                // + '<p>确认收货7天以后到账</p>'
                + '</a> </span></div>';

            //渲染页面
            $(".member-top").html(html);

            var html = '<li style="width:50%;display: none;"><a href="directseller_order.html?status=finish">' + '<p class="number">' + result.data.finish_nums + '</p><p>'+__('完成订单')+'</p></a></li>'
                + '<li style="width:50%; height:5rem;"><a class="br" href="plantform_invite_user.html">' + '<p class="number">' + result.data.all_num + '</p><p>'+__('累计邀请')+'</p></a></li>'
                + '<li style="width:50%; height:5rem;"><a href="plantform_invite_user.html?act=month">' + '<p class="number">' + result.data.month_num + '</p><p>'+__('本月新增邀请')+'</p></a></li>'
                + '<li style="width:50%;display: none;"><a class="br" href="directseller_goods.html">' + '<p class="number">' + result.data.product_num + '</p><p>'+__('推广商品')+'</p></a></li>'
                + '<li style="width:50%;height:5rem;display: none;"><a class="br" href="plantform_invite_order.html">' + '<p class="number">' + result.data.order_num + '</p><p>'+__('推广订单')+'</p></a></li>'
                + '<li style="width:50%;height:5rem;"><a href="member_invite1.html">' + '<p class="number">' + result.data.user_commission_now + '</p><p>'+__('结算佣金')+'</p></a></li>'
                + '<li style="width:50%; height:5rem;"><a class="br" href="plantform_invite_withdraw.html">' + '<p class="number">' + result.data.user_commission_now + '</p><p>'+__('佣金提现')+'</p></a></li>';
            //渲染页面
            
            $("#order_ul").html(html);
            

            return false;
        }
    });
	
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
    }})

});
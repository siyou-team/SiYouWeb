if (getQueryString('ukey') != '')
{
    var key = getQueryString('ukey');
}
else
{
    var key = getLocalStorage('ukey');
}
var chain_id = getQueryString("chain_id");

var rows = pagesize;
var page = 1;
var hasmore = true;
$(function(){
    //加载店铺详情
    $.request({
        type: 'post',
        url: SYS.URL.store.getChain,
        data: {chain_id: chain_id},
        dataType: 'json',
        success: function(result) {
            var data = result.data;
            //显示页面title
            var title = data.chain_name + ' - ' + __('门店首页');
            document.title = title;
            var chain_info = data;

            //门店banner
            $('#chain_banner').find('img').attr('src',chain_info.chain_img);
            //门店详情
            var html = '<div class="store-avatar"><img src="'+ image_thumb(chain_info.chain_img, 70)+'"></div>';
            html += '<div class="detail-item02">';
            html += '<dl class="discount"><dt class="discount-text">' + __('店铺名称：') + '</dt><dd class="discount-address"><span>'+chain_info.chain_name+'</span></dd></dl>';
            html += '<dl class="discount"><dt class="discount-text">' + __('门店地址：') + '</dt><dd class="discount-address"><span>'+chain_info.chain_district_info + chain_info.chain_address+'</span></dd></dl>';
            html += '<dl class="discount"><dt class="discount-text">' + __('联系电话：') + '</dt><dd class="discount-address"><span>'+chain_info.chain_mobile+'</span></dd></dl>';
            html += '<dl class="discount"><dt class="discount-text">' + __('营业时间：') + '</dt><dd class="discount-time"><span>'+chain_info.chain_opening_hours + __('至') +chain_info.chain_close_hours +'</span></dd></dl>';
            html += '</div>';
            $('.chain_info').html(html);

            getStoreVoucher(result.data.store_id)
        }
    });
    //加载门店商品
    get_list();

    function getStoreVoucher(store_id){
        $.request({
            type: 'post',
            url: SYS.URL.point.voucher,
            data: {store_id: 1001},
            dataType: 'json',
            success: function(result) {
                var voucher_list = result.data.items;
                if(voucher_list.length > 0){
                    var _sample = '';
                    for(var i=0;i<voucher_list.length;i++){
                        if(i>1)break;
                        _sample += '<li><span class="coupon"></span> <span class="coupon-name">满'+voucher_list[i].activity_rule.requirement.buy.subtotal+'减'+voucher_list[i].activity_rule.voucher_price+'</span> <span class="coupon coupon-right"></span></li>';
                    }
                    $('#show_voucher').find('.detail-coupon').html(_sample);

                    var v_html = template.render('chain_voucher_tpl', result.data);
                    $("#voucher_list").html(v_html);
                    $.animationLeft({
                        valve: '#show_voucher',
                        wrapper: '#main-container',
                        scroll: '#voucher_list'
                    });
                }else{
                    $('#show_voucher').hide();
                }
            }
        });
    };
    $('.nctouch-bottom-mask-close .closed').on('click', function () {
        $('#main-container').removeClass('up').addClass('down');
    });

    //商品自动加载
    $(window).scroll(function(){
        if(($(window).scrollTop() + $(window).height() > $(document).height()-1)){
            get_list();
        }
    });

    //领取代金券
    $('#voucher_list').on('click','span.goto-receive',function(){
        if (!ifLogin()) {return}

        var actid = parseInt($(this).parents('li').attr('t_id'));
        getFreeVoucher(actid);


    });

    //立即购买
    $("#product_list").on('click','div.buy-now',function(){
        var obj = $(this);
        var goods_storage = parseInt(obj.attr('data-storage')) || 0;
        var goods_id = parseInt(obj.parents('li').attr('goods_id'));
        var kind_id = obj.data('kind_id');
        var is_virtual = kind_id != StateCode.PRODUCT_KIND_ENTITY
        cart_buy(goods_storage, goods_id, is_virtual);
    });
});


//获取列表
function get_list() {
    $('.loading').remove();
    if (!hasmore) {
        return false;
    }
    hasmore = false;
    param = {};
    param.rows = rows;
    param.page = page;
    param.chain_id = chain_id;

    $.request({
        url: SYS.URL.store.listsChainItems,
        data: param,
        dataType: 'json',
        success : function(result){
            if(!result) {
                result = [];
                result.data = [];
                result.data.items = [];
            }
            $('.loading').remove();
            page++;

            //门店商品
            var g_html = template.render('chain_goods_tpl', result.data);
            $("#product_list").append(g_html);

            hasmore = result.hasmore;
        }
    });
}

//立即购买
function cart_buy(goods_storage,goods_id, is_virtual) {
    if (!ifLogin()){
        return;
    }

    if (goods_storage < 1) {
        $.sDialog({
            skin: "red",
            content: __('库存不足！'),
            okBtn: false,
            cancelBtn: false
        });
        return;
    }
    var json = {};
    json.key = key;
    json.item_id = goods_id;
    json.quantity = 1;
    if (is_virtual) {
        location.href = WapSiteUrl + '/tmpl/order/vr_buy_step1.html?item_id=' + json.item_id + '&quantity=' + json.quantity + '&if_chain=1&chain_id=' + window.chain_id;
    } else {
        location.href = WapSiteUrl + '/tmpl/order/buy_step1.html?item_id=' + json.item_id + '&buynum=' + json.quantity + '&if_chain=1&chain_id=' + window.chain_id;
    }
    /*$.request({
        type: 'post',
        url: SYS.URL.cart.checkout,
        data: json,
        dataType: 'json',
        success: function (result)
        {
            if (result.status != 200)
            {
                $.sDialog({
                    skin: "red",
                    content: result.msg,
                    okBtn: false,
                    cancelBtn: false
                });
            }
            else
            {

            }
        }
    });*/

}
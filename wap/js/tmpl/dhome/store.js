var key = getLocalStorage('ukey');
var chain_id = getQueryString("chain_id");
var store_id = getQueryString("store_id");
var cate_id = getQueryString("cate_id");
var keyword = getQueryString("keyword");
var curr_lng = getLocalStorage('curr_lng');
var curr_lat = getLocalStorage('curr_lat');
var G_List = [];

var page = pagesize;
var curpage = 1;
var hasmore = true;

$(function(){
    //加载店铺详情
    $.ajax({
        type: 'get',
        url: SYS.URL.store.info,
        data: {chain_id: chain_id, store_id: store_id,curr_lng:curr_lng,curr_lat:curr_lat, 'action':'intro', 'store_category':1},
        dataType: 'json',
        success: function(result) {
            var data = result.data;

            //显示页面title
            var title = data.base.store_name + ' - ' + __('门店首页');
            document.title = title;

            var chain_info = data.base;
            //var voucher_list = data.voucher_list;
            var voucher_list = [];
            var class_list = data.category;

            //门店详情
            var html = '<img class="st-img" src="'+chain_info.store_logo+'">';
            html += '<div class="st-txt">';
            html += '<div class="st-txt-inner clearfix">';
            html += '<h2 class="st-txt-h2">'+chain_info.store_name+'</h2>';
            html += '</div>';
            html += '<p class="st-txt-p1"></p>';
            if(chain_info.transport_freight > 0){
                html += '<p class="st-txt-p1"><span class="st-txt-span">' + __('基础运费')+chain_info.transport_freight+__('元') + '</span></p>';
            }else{
                html += '<p class="st-txt-p1"><span class="st-txt-span">' + __('免配送费') + '</span></p>';
            }
            html += '</div>';
            if(voucher_list.length > 0){
                html += '<div class="st-tx2"></div>';
            }else{
                html += '<div class="s-dp-info sdi">' + __('店铺信息') + '</div>';
            }
            $('#chain_info').append(html);

            var mhtml = '<li class="za clearfix">';
            mhtml += '<div class="a19 clearfix"><span class="z3">' + __('商品数量') + '：</span><var class="z4">'+chain_info.goods_amount+__('件')+ '</var></div>';
            mhtml += '<div class="a19 clearfix"><span class="z3">' + __('月销单量') + '：</span><var class="z4">'+chain_info.order_amount+ __('单') + '</var></div>';
            mhtml += '<div class="a19 clearfix"><span class="z3">' + __('营业时间') + '：</span><var class="z4">'+chain_info.chain_opening_hours+'</var></div>';
            mhtml += '<div class="a19 clearfix"><span class="z3">' + __('门店地址') + '：</span><var class="z4">'+chain_info.area_info+' '+chain_info.chain_address+'</var></div>';
            mhtml += '<div class="a19 clearfix"><span class="z3">' + __('门店电话') + '：</span><a href="tel:'+chain_info.chain_phone+'" class="telPhone">'+chain_info.chain_phone+'</a></div>';
            mhtml += '</li>';
            $('#chain_more_info').html(mhtml);

            //门店优惠券
            if(voucher_list.length > 0){
                var _sample = '';
                for(var i=0;i<voucher_list.length;i++){
                    _sample += '<li class="clearfix"><div class="cp1"><div class="cp2"><div class="cp3">';
                    _sample += '<div class="cp-txt1"><var class="cp-txt1-g">' + __('满')+voucher_list[i].voucher_t_limit+__('减')+voucher_list[i].voucher_t_price+'</var></div>';
                    _sample += '<div class="cp-txt2">'+voucher_list[i].voucher_t_start_date+'-'+voucher_list[i].voucher_t_end_date+'</div>';
                    _sample += '</div></div></div>';
                    _sample += '<div class="cp4"><span><var class="cp-txt3">'+voucher_list[i].voucher_t_price+'</var> <span class="cp-txt4">元</span></span></div>';
                    _sample += '<div class="cp5"><div class="cp6">';
                    _sample += '<div class="cp-txt5 get_voucher" voucher_id="'+voucher_list[i].voucher_t_id+'" each_limit="'+voucher_list[i].voucher_t_eachlimit+'">' + __('领券') + '</div>';
                    _sample += '</div></div></li>';
                }
                $('#show_voucher').find('.coupon-ul').html(_sample);
            }else{
                $('#show_voucher').hide();
            }

            //门店分类
            var chtml = '';

            if(parseInt(cate_id) > 0){
                chtml += '<li class="zm"><strong class="zp t2 k"><var class="zv">' + __('全部分类') + '</var></strong></li>';
            }else{
                chtml += '<li class="zm zu02"><strong class="zp t2 k"><var class="zv">' + __('全部分类') + '</var></strong></li>';
            }
            if(class_list.length > 0){
                var clength = class_list.length;
                for (var i = 0; i < clength; i++) {
                    if(cate_id == class_list[i].store_product_cat_id){
                        chtml += '<li class="zm zu" c_data="'+class_list[i].store_product_cat_id+'">';
                        chtml += '<strong class="zp t2 k"><var class="zv">'+class_list[i].store_product_cat_name+'</var></strong>';
                        if(!class_list[i].sub){
                            class_list[i].sub = [];
                        }
                        if(class_list[i].sub.length > 0){
                            var c_len = class_list[i].sub.length;
                            var c_class = class_list[i].sub;
                            for (var j = 0; j < c_len; j++) {
                                chtml += '<span class="zp02 t3 hide" c_data="'+c_class[j].store_product_cat_id+'">'+c_class[j].store_product_cat_name+'</span>';
                            }
                        }
                        chtml += '</li>';
                    }else{
                        chtml += '<li class="zm" c_data="'+class_list[i].store_product_cat_id+'">';
                        chtml += '<strong class="zp t2 k"><var class="zv">'+class_list[i].store_product_cat_name+'</var></strong>';
                        if(!class_list[i].sub){
                            class_list[i].sub = [];
                        }
                        if(class_list[i].sub.length > 0){
                            var c_len = class_list[i].sub.length;
                            var c_class = class_list[i].sub;
                            for (var j = 0; j < c_len; j++) {
                                chtml += '<span class="zp02 t3 hide" c_data="'+c_class[j].store_product_cat_id+'">'+c_class[j].store_product_cat_name+'</span>';
                            }
                        }
                        chtml += '</li>';
                    }
                }
            }

            $('#goods_class_list').html(chtml);

        }
    });
    get_list();

    //商品自动加载
    $(window).scroll(function(){
        if(($(window).scrollTop() + $(window).height() > $(document).height()-1)){
            get_list();
        }
    });

    $('.tc-search').on('click',function(){
        window.location = WapSiteUrl + "/tmpl/dhome/search.html?chain_id="+chain_id;
    });
    $('#chain_info').on('click',function(){
        if($('#main_content').css('display') == 'block'){
            var obj = $('#chain_info').parents('div.store-box');
            if(obj.height() > $(window).height()){
                obj.css({'overflow-y':'scroll','position':'absolute'});
            }else{
                obj.css({'min-height':$(window).height()});
            }
            $('#main_content').toggle();
            $('.sc-box').toggle();
        }
    });
    $('#going_shopping').on('click',function(){
        if($('#main_content').css('display') == 'none')
        {
            $('#main_content').toggle();
            $('.sc-box').toggle();
        }
    });
    $('#goods_class_list').on('click','li>strong',function(){
        var obj = $(this).parent();
        var child_count = obj.find('span').length;
        if(child_count > 0){
            obj.siblings().removeClass('zu');
            obj.siblings().removeClass('zu02');
            obj.siblings().find('span.t4').removeClass('t4').addClass('t3');
            obj.siblings().find('span').addClass('hide');
            if(!obj.find('var').hasClass('zv')){
                obj.find('var').addClass('zv');
            }
            obj.find('span').removeClass('hide');
            obj.addClass('zu');
        }else{
            obj.siblings().removeClass('zu');
            obj.siblings().removeClass('zu02');
            obj.siblings().find('span.t4').removeClass('t4').addClass('t3');
            obj.siblings().find('span').addClass('hide');
            obj.addClass('zu02');
        }
        cate_id = parseInt(obj.attr('c_data'));
        $("#goods_list").html('');
        curpage = 1;
        hasmore = true;
        get_list();
    });
    $('#goods_class_list').on('click','li>span',function(){
        var curr = $(this);
        var obj = curr.parent();
        curr.siblings().removeClass('t4');
        curr.siblings().addClass('t3');
        curr.removeClass('t3');
        curr.addClass('t4');
        obj.find('var').removeClass('zv');
        cate_id = parseInt(curr.attr('c_data'));
        $("#goods_list").html('');
        curpage = 1;
        hasmore = true;
        get_list();
    });
});


//获取列表
function get_list() {
    //var c_id = parseInt(cate_id);
    var c_id = cate_id ? cate_id : 0;

    /*
    if(G_List[c_id] && page == 1){
        redCache(c_id);
        return false;
    }
    */

    if (!hasmore) {
        return false;
    }
    hasmore = false;
    param = {};
    param.rows = page;
    param.page = curpage;
    param.chain_id = chain_id;
    param.store_category_ids = [c_id];

    $.ajax({
        url: SYS.URL.product.lists + window.location.search.replace('?','&'),
        data: param,
        dataType: 'json',
        async: false,
        success : function(result){
            if(!result) {
                result = [];
                result.data = [];
                result.data.items = [];
            }
            curpage++;

            //var curr_class_text = result.data.cate_info.name+'('+result.data.cate_info.amount+')';
            var curr_class_text = 11+'('+11+')';
            $("#goods_class_list").next('div.curr_class').find('div').html(curr_class_text);
            //门店商品
            var g_html = template.render('chain_goods_tpl', result);
            console.info(g_html);
            $("#goods_list").append(g_html);
            hasmore = result.hasmore;
            update_goods();
            if(curpage == 2){
                G_List[c_id] = result;
            }
        }
    });
}

function redCache(c_id){
    var result = G_List[c_id];
    var curr_class_text = result.data.cate_info.name+'('+result.data.cate_info.amount+')';
    $("#goods_class_list").next('div.curr_class').find('div').html(curr_class_text);

    var g_html = template.render('chain_goods_tpl', result);
    $("#goods_list").append(g_html);
    curpage++;
    hasmore = result.hasmore;
    update_goods();
}

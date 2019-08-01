var key = getLocalStorage("ukey");
var myPoints = 0;
var myLevel = 0;

var rows = 12;
var page = 1;
var hasmore = true;

$(function(){


    if (true) {
        $("#page_diy_contents").load('./diy.html',function(){
            var page_id = 2002;
            loadSpecial(page_id);

            $("#page_diy_contents").show();

            get_list();
        });
    }



    /*if(key){
        $.ajax({
            type:'post',
            url: SYS.URL.point.voucher,
            data:{key:key},
            dataType:'json',
            success:function(result){
                var voucher_list = result.data.items;
                // myPoints = member_info.member_points;
                // myLevel = member_info.level;
            }
        });
    }*/
    $(window).scroll(function(){
        if(($(window).scrollTop() + $(window).height() > $(document).height()-1)){
            get_list();
        }
    });
});


//兑换优惠券
$(document).on('click','.get_voucher',function(){
    var obj = $(this).parents('li');
    var activity_id = obj.attr('activity_id');
    exchange(activity_id);
    /*if(!key){
        location.href = '../tmpl/member/login.html';
        return false;
    }
    var url = ApiUrl+"/index11.php?act=member_points&op=voucherexchange";
    var obj = $(this).parents('li');
    var voucher_id = obj.attr('voucher_id');
    var voucher_t_price = obj.attr('voucher_t_price');
    var voucher_t_limit = obj.attr('voucher_t_limit');
    var voucher_t_end_date = obj.attr('voucher_t_end_date');
    var voucher_t_points = parseInt(obj.attr('voucher_t_points'));
    var voucher_t_giveout = parseInt(obj.attr('voucher_t_giveout'));
    var voucher_t_eachlimit = obj.attr('voucher_t_eachlimit');
    var voucher_t_total = parseInt(obj.attr('voucher_t_total'));
    var voucher_t_mgradelimit = parseInt(obj.attr('voucher_t_mgradelimit'));

    var d_html = '';
    if(voucher_t_giveout < voucher_t_total){
        if(voucher_t_points > myPoints){
            alert('您的积分不足，暂时不能兑换该优惠券');return false;
        }
        if(voucher_t_mgradelimit > myLevel){
            alert('您的会员级别不够，暂时不能兑换该优惠券');return false;
        }
        d_html += '<dl><dt>您正在使用<span class="ml5 mr5">'+voucher_t_points+'</span>积分&nbsp;兑换&nbsp;1&nbsp;张<br>';
        d_html += '官方自营'+voucher_t_price+'元店铺优惠券（<em>满'+voucher_t_limit+'减'+voucher_t_price+'</em>）</dt>';
        d_html += '<dd>店铺优惠券有效期至'+voucher_t_end_date+'</dd>';
        var limit_count = '不限量';
        if(voucher_t_eachlimit > 0){
            limit_count = voucher_t_eachlimit+'张';
        }
        d_html += '<dd>每个ID领取'+limit_count+'</dd></dl>';
        exchange(voucher_id,d_html);
    }else{
        d_html += '优惠券已兑换完';
        alert(d_html);return false;
    }*/
});

//兑换操作
function exchange(activity_id){
    getFreeVoucher(activity_id);
}

//获取列表
function get_list() {
    $('.loading').remove();
    if (!hasmore) {
        return false;
    }
    hasmore = false;
    $.getJSON(SYS.URL.point.voucher, {page:page,rows:rows}, function(result){
        if(!result) {
            result = [];
            result.datas = [];
            result.datas.voucherlist = [];
        }
        $('.loading').remove();
        page++;
        result.hasmore = result.data.page >= result.data.total ? false : true;
        var html = template.render('voucher_body', result);
        $(".integral-part").append(html);
        hasmore = result.hasmore;
        }
    );
}